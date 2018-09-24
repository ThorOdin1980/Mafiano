  <?php
  if(basename($_SERVER['PHP_SELF']) == "gjengrediger.inc.php") { header("Location: index.php"); exit; } else {
  
  echo "
  <script>
  function Lagre() { 
  var N = window.btoa($('#R_Navn').val()); 
  var B = window.btoa($('#R_Bilde').val()); 
  var I = window.btoa($('#R_Info').val()); 
  $('#SB_Midten2').load('post.php?GjengHus=Hovedkvarter&N='+N+'&B='+B+'&I='+I); 
  $('html, body').animate({scrollTop:100}, 'slow');

  }
  </script>
  ";
  
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">$G_NavnEr</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Okonomi');\">( Økonomi )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Krim');\">( Krim )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Medlemmer');\">( Medlemmer )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Hovedkvarter');\">( Hovedkvarter )</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/klubben.jpg\"></td></tr>
  ";

  if($i['stilling'] == 'Boss') {
  if(isset($_GET['N']) && $i['stilling'] == 'Boss') {
  $P_Navn = Fiks_Space(Bare_BS(base64_decode($_GET['N'])));
  $P_Avatar = mysql_real_escape_string(htmlspecialchars(base64_decode($_GET['B'])));
  $P_Info = mysql_real_escape_string(htmlspecialchars(base64_decode($_GET['I'])));
  if(empty($P_Avatar)) { $P_Avatar == 'http://www.mafiano.no/Bilder/gjeng.jpg'; }
  if(empty($P_Navn) || $P_Navn == ' ') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig gjengnavn.</span></td></tr>"; }
  elseif(strlen($P_Navn) > '24' || strlen($P_Navn) < '5') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Gjengnavn maksimum 24 tegn, minimum 5 tegn.</span></td></tr>"; }
  elseif(strlen($P_Avatar) > '300' || strlen($P_Avatar) < '3') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Gjengbilde maksimum 300 tegn, minimum 3 tegn.</span></td></tr>"; } 
  elseif(strlen($P_Info) < '2') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Gjenginfo minimum 2 tegn.</span></td></tr>"; }  // strlen($P_Info) >= '15000' || 
  elseif($P_Navn != $G_NavnEr) { 
  $SeGjeng = mysql_query("SELECT * FROM Gjenger WHERE Gjeng_Navn='$P_Navn'");
  if(mysql_num_rows($SeGjeng) == '0') {  

  mysql_query("UPDATE Gjenger SET Gjeng_Navn='$P_Navn',bilde='$P_Avatar',tekst='$P_Info' WHERE id='$G_Id'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET gjeng='$P_Navn' WHERE gjeng='$G_NavnEr'");

  mysql_query("UPDATE Invite_diverse SET Invitert_av_bedrift='$P_Navn' WHERE Invitert_av_bedrift='$G_NavnEr'");

  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Informasjon lagret.</span></td></tr>";
  } else {
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Gjengnavnet er opptatt.</span></td></tr>";
  }} else {

  mysql_query("UPDATE Gjenger SET bilde='$P_Avatar',tekst='$P_Info' WHERE id='$G_Id'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Informasjon lagret.</span></td></tr>";
  }}
  if(empty($P_Navn)) { $G_1 = $G_NavnEr; } else { $G_1 = $P_Navn; }
  if(empty($P_Avatar)) { $G_2 = $G_Bilde; } else { $G_2 = base64_decode($_GET['B']); }
  if(empty($P_Info)) { $G_3 = $G_Infoe; } else { $G_3 = base64_decode($_GET['I']); }
  echo "<tr class=\"Vanlig_1\">
  <td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"R_Navn\" value=\"$G_1\">
  <input type=\"text\" id=\"R_Bilde\" value=\"$G_2\">
  <textarea id=\"R_Info\">$G_3</textarea>
  <p class=\"Post\" onclick=\"Lagre()\">Lagre</p></td></tr>";
  }
  
  // Bedrifter gjengen eier

  $G_But = mysql_query("SELECT * FROM Butikker WHERE Butikk_Gjeng='$G_NavnEr'");
  $A_But = mysql_num_rows($G_But);

  $G_Kf = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Gjeng='$G_NavnEr'");
  $A_Kf = mysql_num_rows($G_Kf);
  $AntallMakt = $A_But + $A_Kf;
  $Buti_Prosent = ($AntallMakt / '60') * '100';
  if($Buti_Prosent <= '0') { $Buti_Prosent = '0'; }

  // Antall medlemmer i gjengen

  $Medlemmer = mysql_num_rows(mysql_query("SELECT * FROM Gjeng_medlemmer WHERE gjeng_id='$G_Id'"));
  $Med_Prosent = ($Medlemmer / $i['plass_til']) * '100';

  // Antall drap gjengen har opp imot alle andre
  $Total_Drap = mysql_fetch_object(mysql_query("SELECT SUM(drap) AS Drap FROM Gjenger WHERE id LIKE '%'"));
  $TotalDrap = $Total_Drap->Drap;
  $Drap_Prosent = ($i['drap'] / $TotalDrap) * '100';
  if($Drap_Prosent <= '0') { $Drap_Prosent = '0'; }

  echo "
  <tr class=\"Vanlig_1\"><td class=\"Linje\" style=\"padding:5px;\">
  <table style=\"font-family: Arial; font-size: 12px;\">
  <tr><td style=\"text-align:center; font-weight:bold;\">Gjeng informasjon $GjengER</td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".floor($i['GjengTilstand'])."%; overflow:hidden;\"><p>Gjenghus: ".floor($i['GjengTilstand'])."%</p></div></div></td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: $Buti_Prosent%; overflow:hidden;\"><p>Bedrifter: ".VerdiSum($AntallMakt,'stk')."</p></div></div></td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: $Med_Prosent%; overflow:hidden;\"><p>Medlemmer: ".VerdiSum($Medlemmer,'stk').", totalplass ".VerdiSum($i['plass_til'],'personer')."</p></div></div></td></tr>
  </table>
  </td></tr>
  <tr class=\"Vanlig_1\"><td class=\"Linje\" style=\"padding:5px;\">
  <table style=\"font-family: Arial; font-size: 12px;\">
  <tr><td style=\"text-align:center; font-weight:bold;\">Måling imot totalsummen fra alle gjengene</td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: 5%; overflow:hidden;\"><p>Kriger vunnet - UNDER UTVIKLING</p></div></div></td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: $Drap_Prosent%; overflow:hidden;\"><p>Drap: ".VerdiSum($i['drap'],'stk')."</p></div></div></td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: 5%; overflow:hidden;\"><p>Inntekt - UNDER UTVIKLING</p></div></div></td></tr>
  </table>
  </td></tr>

  </table></div>";

  }
  ?>
  <style>
  .LinjeTo { padding:3px; border-bottom-style: solid; border-bottom-width: 1px; border-color:#000000; font-size:11px; }
  .Send .PostEn { width:150px; text-align:center; margin:2px 7px 0 7px; background-color:#444444; color:#b6e122; font-size:11px; font-weight:bold; padding:3px; filter:alpha(opacity=50); opacity:0.5; }
  .Send .PostEn:hover { cursor:pointer; filter:alpha(opacity=90); opacity:0.9; }
  .Send .tekst:hover { cursor:pointer; filter:alpha(opacity=90); opacity:0.9; }
  .Send .AddOn { filter:alpha(opacity=90); opacity:0.9; }
  </style>
  <?php
  if(basename($_SERVER['PHP_SELF']) == "gjengdonering.inc.php") { header("Location: index.php"); exit; } else {
  if($i['stilling'] == 'Medlem') {

  echo " 
  <script>
  function sendit() {
  if($('#V_Type').val() == 'Penger' || $('#V_Type').val() == 'Poeng' || $('#V_Type').val() == 'Bombechips') { 
  if($('#Summen').val() == '' || $('#Summen').val() == 'Sum') { alert('Summen mangler.'); } else {
  Type = encodeURI($('#V_Type').val()); 
  Sum = encodeURI($('#Summen').val());
  $('#SB_Midten2').load('post.php?GjengHus=Okonomi&Valg='+Type+'&Val='+Sum);
  }} else { alert('Du må velge hva du skal donere til gjengen.'); }}
  </script>";

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">$G_NavnEr</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Okonomi');\">( Økonomi )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Krim');\">( Krim )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Medlemmer');\">( Medlemmer )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Hovedkvarter');\">( Hovedkvarter )</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/Bank-4.jpg\"></td></tr>
  ";

  if(isset($_GET['Valg']) && $i['stilling'] == 'Medlem') { 
  if($_GET['Valg'] == 'Penger' || $_GET['Valg'] == 'Poeng' || $_GET['Valg'] == 'Bombechips') { 
  $Valg = Mysql_Klar($_GET['Valg']);
  $Sum =  Bare_Siffer(Mysql_Klar($_GET['Val']));
  if($Valg == 'Penger') { $Col = "Gjeng_Penger"; $ColTo = "penger"; $ColTre = "penger_don"; $Tall = floor($rad_B['penger']); $Var = "kr"; }
  elseif($Valg == 'Poeng') { $Col = "Gjeng_Poeng"; $ColTo = "turns"; $ColTre = "poeng_don"; $Tall = floor($rad_B['turns']); $Var = "poeng"; }
  elseif($Valg == 'Bombechips') { $Col = "Gjeng_Bombechips"; $ColTo = "bombechips"; $ColTre = "bombechips_don"; $Tall = floor($rad_B['bombechips']); $Var = "bombechips"; }
  if(empty($Sum)) { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Du må fylle inn summen.</span></td></tr>"; }
  elseif($Sum > '10000000000') { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Summen er for høy.</span></td></tr>"; } 
  elseif($Sum < '1') { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Summen er for lav.</span></td></tr>"; } 
  elseif($Sum > $Tall) { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok $Var.</span></td></tr>"; } else { 
  $SumVis = VerdiSum($Sum,$Var);
  $OppEn = "$Col=`$Col`+'$Sum'";
  $OppTo = "$ColTo=`$ColTo`-'$Sum'";
  $OppTre = "$ColTre=`$ColTre`+'$Sum'";
  mysql_query("UPDATE brukere SET $OppTo,aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE Gjeng_medlemmer SET $OppTre WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("INSERT INTO `Gjeng_donering` (brukernavn,gjengid,sum,dato,stamp) VALUES ('$brukernavn','$G_Id','$SumVis','$FullDato','$Timestamp')");
  mysql_query("UPDATE Gjenger SET $OppEn WHERE id='$G_Id'");
  echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_1\">Du har donert $SumVis..</span></td></tr>";
  }} else { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>"; }}

  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" colspan=\"3\" style=\"padding-bottom:9px;\">
  <select id=\"V_Type\"><option>Penger</option><option>Poeng</option><option>Bombechips</option></select>
  <input id=\"Summen\" type=\"text\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\">
  <p class=\"Post\" onclick=\"sendit();\">Doner!</p>
  </td></tr>
  <tr style=\"height:20px;\"><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Dato</td><td class=\"R_4\">Donering</td></tr>";
  $Don = mysql_query("SELECT * FROM Gjeng_donering WHERE gjengid='$G_Id' ORDER BY stamp DESC LIMIT 20");
  while($ITT = mysql_fetch_assoc($Don)) { 
  echo "<tr class=\"Vanlig_1\"><td class=\"LinjeTo Plassering\">".BrukerURL($ITT['brukernavn'])."</td><td class=\"LinjeTo Plassering\">".$ITT['dato']."</td><td class=\"LinjeTo Plassering\">".$ITT['sum']."</td></tr>";
  }
  echo "</table></div>";

  
  }}
  ?>
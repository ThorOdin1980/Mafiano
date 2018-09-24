  <?php
  if(basename($_SERVER['PHP_SELF']) == "Trav.inc.php") { header("Location: index.php"); exit; } else {
  
  echo "
  <script>
  var _images = ['../casino/Bla.gif', '../casino/Bla_T1.gif', '../casino/Bla_T2.gif', '../casino/Bla_T3.gif', '../casino/Bla_T4.gif', '../casino/Bla_V1.gif', '../casino/Bla_V2.gif', '../casino/Bla_V3.gif', '../casino/Gul.gif', '../casino/Gul_T1.gif','../casino/Gul_T2.gif', '../casino/Gul_T3.gif', '../casino/Gul_T4.gif', '../casino/Gul_V1.gif', '../casino/Gul_V2.gif', '../casino/Gul_V3.gif', '../casino/Lilla.gif', '../casino/Lilla_T1.gif', '../casino/Lilla_T2.gif','../casino/Lilla_V1.gif','../casino/Lilla_V2.gif', '../casino/Lilla_V3.gif', '../casino/Rod.gif', '../casino/Rod_T1.gif', '../casino/Rod_T2.gif', '../casino/Rod_T3.gif', '../casino/Rod_V1.gif', '../casino/Rod_V2.gif', '../casino/Svart.gif','../casino/Svart_T1.gif','../casino/Svart_T2.gif', '../casino/Svart_T3.gif', '../casino/Svart_V1.gif', '../casino/Svart_V2.gif'];
  var gotime = _images.length;
  $.each(_images,function(e) { $(new Image()).load(function() { if (--gotime < 1) begin(); }).attr('src',this); });
  function Starto() { 
  var Sats = $('#Sats').val();
  var Valgo = $('#V_Finger').val();
  if(Sats == '' || Sats == '0' || Sats == 'Sats') { alert('Du må plotte inn en sum.'); } 
  else if(Valgo == 'Bla' || Valgo == 'Svart' || Valgo == 'Rod' || Valgo == 'Gul' || Valgo == 'Lilla') { 
  var Sats = encodeURI(Sats);
  var Valgo = encodeURI(Valgo);
  $('#SB_Midten2').load('post.php?du_valgte=Trav&startTrav='+Sats+'&type='+Valgo); 
  } else {
  alert('Ugyldig valg.');
  }}
  </script>
  ";
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Travbanen</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kasino')\">( Tilbake til kasino )</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/veddelopsbanen.jpg\"></td></tr>";
  
  if(isset($_GET['startTrav'])) { 
  $innsats = Bare_Siffer(Mysql_Klar($_GET['startTrav']));
  $valgi = Mysql_Klar($_GET['type']);
  
  if(empty($innsats)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Beløpet mangler.</span></td></tr>"; $vedde_bilde_1 = 'Bla'; $vedde_bilde_2 = 'Svart'; $vedde_bilde_3 = 'Rod'; $vedde_bilde_4 = 'Gul'; $vedde_bilde_5 = 'Lilla'; }
  elseif($innsats < '1000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 1.000 kr.</span></td></tr>"; $vedde_bilde_1 = 'Bla'; $vedde_bilde_2 = 'Svart'; $vedde_bilde_3 = 'Rod'; $vedde_bilde_4 = 'Gul'; $vedde_bilde_5 = 'Lilla'; }
  elseif($innsats > '1000000000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Maksimum 10.00.000.000 kr.</span></td></tr>"; $vedde_bilde_1 = 'Bla'; $vedde_bilde_2 = 'Svart'; $vedde_bilde_3 = 'Rod'; $vedde_bilde_4 = 'Gul'; $vedde_bilde_5 = 'Lilla'; }
  elseif($innsats > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; $vedde_bilde_1 = 'Bla'; $vedde_bilde_2 = 'Svart'; $vedde_bilde_3 = 'Rod'; $vedde_bilde_4 = 'Gul'; $vedde_bilde_5 = 'Lilla'; } 
  elseif($valgi == 'Bla' || $valgi == 'Svart' || $valgi == 'Rod' || $valgi == 'Gul' || $valgi == 'Lilla') {  
  
  $Hest_vinner = array("Bla","Svart","Rod","Gul","Lilla");
  $Hest_vinner = $Hest_vinner[array_rand($Hest_vinner)];
        
  if($Hest_vinner == 'Bla') { $vedde_bilde_1 = array("Bla_V1","Bla_V2","Bla_V3"); $vedde_bilde_2 = array("Svart_T1","Svart_T2","Svart_T3"); $vedde_bilde_3 = array("Rod_T1","Rod_T2","Rod_T3"); $vedde_bilde_4 = array("Gul_T1","Gul_T2","Gul_T3","Gul_T4"); $vedde_bilde_5 = array("Lilla_T1","Lilla_T2"); } 
  elseif($Hest_vinner == 'Svart') { $vedde_bilde_1 = array("Bla_T1","Bla_T2","Bla_T3","Bla_T4"); $vedde_bilde_2 = array("Svart_V1","Svart_V2"); $vedde_bilde_3 = array("Rod_T1","Rod_T2","Rod_T3"); $vedde_bilde_4 = array("Gul_T1","Gul_T2","Gul_T3","Gul_T4"); $vedde_bilde_5 = array("Lilla_T1","Lilla_T2"); }
  elseif($Hest_vinner == 'Rod') { $vedde_bilde_1 = array("Bla_T1","Bla_T2","Bla_T3","Bla_T4"); $vedde_bilde_2 = array("Svart_T1","Svart_T2","Svart_T3"); $vedde_bilde_3 = array("Rod_V1","Rod_V2"); $vedde_bilde_4 = array("Gul_T1","Gul_T2","Gul_T3","Gul_T4"); $vedde_bilde_5 = array("Lilla_T1","Lilla_T2"); }
  elseif($Hest_vinner == 'Gul') { $vedde_bilde_1 = array("Bla_T1","Bla_T2","Bla_T3","Bla_T4"); $vedde_bilde_2 = array("Svart_T1","Svart_T2","Svart_T3"); $vedde_bilde_3 = array("Rod_T1","Rod_T2","Rod_T3"); $vedde_bilde_4 = array("Gul_V1","Gul_V2","Gul_V3"); $vedde_bilde_5 = array("Lilla_T1","Lilla_T2"); }
  elseif($Hest_vinner == 'Lilla') { $vedde_bilde_1 = array("Bla_T1","Bla_T2","Bla_T3","Bla_T4"); $vedde_bilde_2 = array("Svart_T1","Svart_T2","Svart_T3"); $vedde_bilde_3 = array("Rod_T1","Rod_T2","Rod_T3"); $vedde_bilde_4 = array("Gul_T1","Gul_T2","Gul_T3","Gul_T4"); $vedde_bilde_5 = array("Lilla_V1","Lilla_V2","Lilla_V3"); }
        
  $vedde_bilde_1 = $vedde_bilde_1[array_rand($vedde_bilde_1)];
  $vedde_bilde_2 = $vedde_bilde_2[array_rand($vedde_bilde_2)];
  $vedde_bilde_3 = $vedde_bilde_3[array_rand($vedde_bilde_3)];
  $vedde_bilde_4 = $vedde_bilde_4[array_rand($vedde_bilde_4)];
  $vedde_bilde_5 = $vedde_bilde_5[array_rand($vedde_bilde_5)];

  if($valgi == $Hest_vinner) { 
  $gevinst_er = floor($innsats * '3.5');
  $ny_sum_spenn = floor($rad_B['penger'] + $gevinst_er);

  mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  } else {
  $ny_sum_spenn = floor($rad_B['penger'] - $innsats);

  mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  }
  
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig valg $valgi.</span></td></tr>"; $vedde_bilde_1 = 'Bla'; $vedde_bilde_2 = 'Svart'; $vedde_bilde_3 = 'Rod'; $vedde_bilde_4 = 'Gul'; $vedde_bilde_5 = 'Lilla'; }
  } else { $vedde_bilde_1 = 'Bla'; $vedde_bilde_2 = 'Svart'; $vedde_bilde_3 = 'Rod'; $vedde_bilde_4 = 'Gul'; $vedde_bilde_5 = 'Lilla'; }
    
  echo "
  <tr class=\"Vanlig_1\"><td class=\"Linje Plassering\">
  <img src=\"../casino/$vedde_bilde_1.gif\">
  <img src=\"../casino/$vedde_bilde_2.gif\">
  <img src=\"../casino/$vedde_bilde_3.gif\">
  <img src=\"../casino/$vedde_bilde_4.gif\">
  <img src=\"../casino/$vedde_bilde_5.gif\">
  </td></tr>
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Sats\" value=\"Sats\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sats')this.value='';\" onblur=\"if(this.value=='')this.value='Sats';\">
  <select id=\"V_Finger\"><option value=\"Bla\">Blå hest</option><option value=\"Svart\">Svart hest</option><option value=\"Rod\">Rød hest</option><option value=\"Gul\">Gul hest</option><option value=\"Lilla\">Lilla hest</option></select>
  <p class=\"Post\" onclick=\"Starto();\">Start spill!</p>
  </td></tr>";
    
  echo "</table></div>";
  }
  ?>
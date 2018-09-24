  <?php
  if(basename($_SERVER['PHP_SELF']) == "SteinSaksPapir.inc.php") { header("Location: index.php"); exit; } else {
  
  echo "
  <script>
  var _images = ['../Design/Papir.jpg', '../Design/Papir2.jpg', '../Design/Saks.jpg', '../Design/Saks2.jpg', '../Design/Stein.jpg', '../Design/Stein2.jpg'];
  var gotime = _images.length;
  $.each(_images,function(e) { $(new Image()).load(function() { if (--gotime < 1) begin(); }).attr('src',this); });
    
  function Starto() { 
  var Sats = $('#Sats').val();
  var Valgo = $('#V_Finger').val();
  if(Sats == '' || Sats == '0' || Sats == 'Sats') { alert('Du må plotte inn en sum.'); } 
  else if(Valgo == 'Stein' || Valgo == 'Saks' || Valgo == 'Papir') { 
  var Sats = encodeURI(Sats);
  var Valgo = encodeURI(Valgo);
  $('#SB_Midten2').load('post.php?du_valgte=SSP&startSSP='+Sats+'&type='+Valgo); 
  } else {
  alert('Ugyldig valg.');
  }}
  </script>
  ";
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Stein saks papir</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kasino')\">( Tilbake til kasino )</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/steinsakspapir.jpg\"></td></tr>";
  
  if($_GET['startSSP']) { 
  $innsats = Bare_Siffer(Mysql_Klar($_GET['startSSP']));
  $valgi = Mysql_Klar($_GET['type']);
  
  if(empty($innsats)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Beløpet mangler.</span></td></tr>"; }
  elseif($innsats < '1000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 1.000 kr.</span></td></tr>"; }
  elseif($innsats > '1000000000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Maksimum 10.00.000.000 kr.</span></td></tr>"; }
  elseif($innsats > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; } 
  elseif($valgi == 'Saks' || $valgi == 'Papir' || $valgi == 'Stein') {  
        
  $sjekk = '1';
  $random = rand(1,3);
  $sotti_pros = floor($innsats / '100' * '70');
  $tjent_sum = $sotti_pros;
  $ny_sum_vinn = floor($rad_B['penger'] + $tjent_sum);
  $ny_sum_tap = floor($rad_B['penger'] - $innsats);
        
  if($random == '1') { $motstander = 'Stein2.png'; $motstander2 = "Stein"; } elseif($random == '2') { $motstander = 'Saks2.png'; $motstander2 = "Saks"; } elseif($random == '3') { $motstander = 'Papir2.png'; $motstander2 = "Papir"; }
  if($valgi == 'Stein' && $motstander == 'Saks2.png') { $svar = 'VANT'; } elseif($valgi == 'Saks' && $motstander == 'Papir2.png') { $svar = 'VANT'; } elseif($valgi == 'Papir' && $motstander == 'Stein2.png') { $svar = 'VANT'; }
  if($valgi == 'Stein' && $motstander == 'Papir2.png') { $svar = 'TAPTE'; } elseif($valgi == 'Saks' && $motstander == 'Stein2.png') { $svar = 'TAPTE'; } elseif($valgi == 'Papir' && $motstander == 'Saks2.png') { $svar = 'TAPTE'; }
  if($valgi == 'Stein' && $motstander == 'Stein2.png') { $svar = 'UAVGJORT'; } elseif($valgi == 'Saks' && $motstander == 'Saks2.png') { $svar = 'UAVGJORT'; } elseif($valgi == 'Papir' && $motstander == 'Papir2.png') { $svar = 'UAVGJORT'; }
  
  if($svar == 'VANT') {
 
  mysql_query("INSERT INTO SspLogg (DuFikk,DataFikk,DuSatset,Svar,Dato,Bruker,Timestamp,Gevinst) VALUES('$valgi','$motstander2','$innsats','Vant','$AnnenDato','$brukernavn','$Timestamp','$tjent_sum')");

  mysql_query("UPDATE brukere SET penger='$ny_sum_vinn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $Sumo = VerdiSum($tjent_sum,'kr');
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du vant $Sumo.</span></td></tr>";
  } elseif($svar == 'TAPTE') {
 
  mysql_query("INSERT INTO SspLogg (DuFikk,DataFikk,DuSatset,Svar,Dato,Bruker,Timestamp,Gevinst) VALUES('$valgi','$motstander2','$innsats','Tapte','$AnnenDato','$brukernavn','$Timestamp','0')"); 

  mysql_query("UPDATE brukere SET penger='$ny_sum_tap',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $Sumo = VerdiSum($innsats,'kr');
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du tapte $Sumo.</span></td></tr>";
  } elseif($svar == 'UAVGJORT') {
 
  mysql_query("INSERT INTO SspLogg (DuFikk,DataFikk,DuSatset,Svar,Dato,Bruker,Timestamp,Gevinst) VALUES('$valgi','$motstander2','$innsats','Uavgjort','$AnnenDato','$brukernavn','$Timestamp','0')");  
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Det ble uavgjort, du tapte ingen penger.</span></td></tr>";
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>"; }}}
  
  if(empty($innsats)) { $Satsen = 'Sats'; } else { $Satsen = $innsats; }
  if(empty($motstander)) { $motstander = 'bilde.jpg'; }
  if(empty($valgi)) { $valgi = 'bilde'; }
  if($sjekk != '1') { $valgi = 'bilde'; }
  
  echo "
  <tr class=\"Vanlig_1\"><td class=\"Linje Plassering\"><img src=\"../Design/".$valgi.".jpg\"><img src=\"../Design/".$motstander."\"></td></tr>
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Sats\" value=\"$Satsen\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sats')this.value='';\" onblur=\"if(this.value=='')this.value='Sats';\">
  <select id=\"V_Finger\"><option>Stein</option><option>Saks</option><option>Papir</option></select>
  <p class=\"Post\" onclick=\"Starto();\">Start spill!</p>
  </td></tr>";
    
  echo "</table></div>";
  }
  ?>
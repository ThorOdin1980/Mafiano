  <?php
  if(basename($_SERVER['PHP_SELF']) == "Terning.inc.php") { header("Location: index.php"); exit; } else {
  
  echo "
  <script>
  var _images = ['../casino/0.jpg', '../casino/1.gif', '../casino/2.gif', '../casino/3.gif', '../casino/4.gif', '../casino/5.gif', '../casino/6.gif'];
  var gotime = _images.length;
  $.each(_images,function(e) { $(new Image()).load(function() { if (--gotime < 1) begin(); }).attr('src',this); });
    
  function Starto() { 
  var Sats = $('#Sats').val();
  if(Sats == '' || Sats == '0' || Sats == 'Sats') { alert('Du må plotte inn en sum.'); } else { 
  var Sats = encodeURI(Sats);
  $('#SB_Midten2').load('post.php?du_valgte=Terning&start='+Sats); 
  }}
  </script>
  ";
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Kast terning</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kasino')\">( Tilbake til kasino )</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/Gambling-3.jpg\"></td></tr>";
  
  if($_GET['start']) { 
  $innsats = Bare_Siffer(Mysql_Klar($_GET['start']));
  if(empty($innsats)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Beløpet mangler.</span></td></tr>"; }
  elseif($innsats < '1000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 1.000 kr.</span></td></tr>"; }
  elseif($innsats > '1000000000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Maksimum 10.00.000.000 kr.</span></td></tr>"; }
  elseif($innsats > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; } else { 
  
  $En = rand(1,6); $To = rand(1,6); $Tre = rand(1,6); $Fire = rand(1,6);
  $B_1 = "$En.gif"; $B_2 = "$To.gif"; $B_3 = "$Tre.gif"; $B_4 = "$Fire.gif";
  $Ter = array("$En","$To","$Tre","$Fire");
  sort($Ter);
  
  if(($Ter['0'] == $Ter['1']) && ($Ter['1'] == $Ter['2']) && ($Ter['2'] == $Ter['3'])) { $NySum = floor($rad_B['penger'] + ($innsats * '4')); $Svar = "Fire like"; $Gevinst = VerdiSum(floor($innsats * '4'),'kr'); }
  elseif((($Ter['0'] == $Ter['1']) && ($Ter['1'] == $Ter['2'])) || (($Ter['1'] == $Ter['2']) && ($Ter['2'] == $Ter['3']))) { $NySum = floor($rad_B['penger'] + ($innsats * '3')); $Svar = "Tre like"; $Gevinst = VerdiSum(floor($innsats * '3'),'kr'); }
  elseif(($Ter['0'] == '1' && $Ter['1'] == '2' && $Ter['2'] == '3' && $Ter['3'] == '4') || ($Ter['0'] == '2' && $Ter['1'] == '3' && $Ter['2'] == '4' && $Ter['3'] == '5') || ($Ter['0'] == '3' && $Ter['1'] == '4' && $Ter['2'] == '5' && $Ter['3'] == '6')) { $NySum = floor($rad_B['penger'] + ($innsats * '2')); $Svar = "Stigende rekke"; $Gevinst = VerdiSum(floor($innsats * '2'),'kr'); }
  elseif(($Ter['0'] == $Ter['1']) && ($Ter['2'] == $Ter['3'])) { $NySum = floor($rad_B['penger'] + $innsats); $Svar = "To par"; $Gevinst = VerdiSum($innsats,'kr'); }
  elseif(($Ter['0'] == $Ter['1']) || ($Ter['1'] == $Ter['2']) || ($Ter['2'] == $Ter['3'])) { $NySum = floor($rad_B['penger'] - ($innsats / '2')); $Svar = "Et par"; $Gevinst = VerdiSum(floor($innsats / '2'),'kr'); } 
  else { $NySum = floor($rad_B['penger'] - $innsats); $Svar = "Ingen kombinasjoner"; $Gevinst = "0"; }
  $Satse = VerdiSum($innsats,'kr');
 
  mysql_query("INSERT INTO TerningLogg (Bruker,Stamp,Dato,Svar,Sats,Gevinst) VALUES('$brukernavn','$Timestamp','$AnnenDato','$Svar','$Satse','$Gevinst')"); 

  mysql_query("UPDATE brukere SET penger='$NySum',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  }}
  
  if(empty($B_1) || empty($B_2) || empty($B_3) || empty($B_4)) { $B_1 = "0.jpg"; $B_2 = "0.jpg"; $B_3 = "0.jpg"; $B_4 = "0.jpg"; }
  
  echo "
  <tr class=\"Vanlig_1\"><td class=\"Linje Plassering\"><img style=\"width:70px; height:70px;\" src=\"../casino/$B_1\"><img style=\"width:70px; height:70px;\" src=\"../casino/$B_2\"><img style=\"width:70px; height:70px;\" src=\"../casino/$B_3\"><img style=\"width:70px; height:70px;\" src=\"../casino/$B_4\"></td></tr>
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Sats\" value=\"Sats\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sats')this.value='';\" onblur=\"if(this.value=='')this.value='Sats';\">
  <p class=\"Post\" onclick=\"Starto();\">Start spill!</p>
  </td></tr>";
    
  echo "</table></div>";
  }
  ?>
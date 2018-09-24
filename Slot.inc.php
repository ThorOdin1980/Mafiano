  <?php
  if(basename($_SERVER['PHP_SELF']) == "Slot.inc.php") { header("Location: index.php"); exit; } else {
  
  echo "
  <script>
  var _images = ['../casino/a1.gif', '../casino/a2.gif', '../casino/a3.gif', '../casino/a4.gif', '../casino/b1.gif', '../casino/b2.gif', '../casino/b3.gif', '../casino/b4.gif', '../casino/k1.gif', '../casino/k2.gif','../casino/k3.gif', '../casino/k4.gif', '../casino/s1.gif', '../casino/s2.gif', '../casino/s3.gif', '../casino/s4.gif'];
  var gotime = _images.length;
  $.each(_images,function(e) { $(new Image()).load(function() { if (--gotime < 1) begin(); }).attr('src',this); });
  function Starto() { 
  var Sats = $('#Sats').val();
  if(Sats == '' || Sats == '0' || Sats == 'Sats') { alert('Du må plotte inn en sum.'); } else {
  var Sats = encodeURI(Sats);
  $('#SB_Midten2').load('post.php?du_valgte=Slot&Sats='+Sats); 
  }}
  </script>
  ";
  
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Slot automat</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kasino')\">( Tilbake til kasino )</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/slotmaskin.jpg\"></td></tr>";
  
  if(isset($_GET['Sats'])) { 
  $innsats = Bare_Siffer(Mysql_Klar($_GET['Sats']));
  
  if(empty($innsats)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Beløpet mangler.</span></td></tr>"; $b_1 = 'M'; $b_2 = 'M'; $b_3 = 'M'; $b_4 = 'M'; }
  elseif($innsats < '1000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 1.000 kr.</span></td></tr>"; $b_1 = 'M'; $b_2 = 'M'; $b_3 = 'M'; $b_4 = 'M'; }
  elseif($innsats > '1000000000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Maksimum 10.00.000.000 kr.</span></td></tr>"; $b_1 = 'M'; $b_2 = 'M'; $b_3 = 'M'; $b_4 = 'M'; }
  elseif($innsats > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; $b_1 = 'M'; $b_2 = 'M'; $b_3 = 'M'; $b_4 = 'M'; } else { 
  
  $frukt = array('b','b','b','b','b','s','s','s','s','s','s','s','s','a','a','a','a','a','a','a','a','a','a','a','k','k','k','k','k','k','k','k','k','k','k','k','k');
  $bildenr = array(1,2,3,4);
  $key = array_rand($bildenr); $b1 = $bildenr[$key]; unset ($bildenr[$key]);
  $key = array_rand($bildenr); $b2 = $bildenr[$key]; unset ($bildenr[$key]);
  $key = array_rand($bildenr); $b3 = $bildenr[$key]; unset ($bildenr[$key]);
  $key = array_rand($bildenr); $b4 = $bildenr[$key];
  $key = array_rand($frukt); $nr1 = $frukt[$key]; unset ($frukt[$key]);
  $key = array_rand($frukt); $nr2 = $frukt[$key]; unset ($frukt[$key]);
  $key = array_rand($frukt); $nr3 = $frukt[$key]; unset ($frukt[$key]);
  $key = array_rand($frukt); $nr4 = $frukt[$key];
  
  if($nr1 == $nr2 && $nr1 == $nr3 && $nr1 == $nr4) { $vinn = true;
  if($nr2 == 'k') { $get = floor($innsats * 2.5); } 
  elseif($nr2 == 's') { $get = floor($innsats * 7.5); } 
  elseif($nr2 == 'a') { $get = floor($innsats * 3.5); }
  elseif($nr2 == 'b') { $get = floor($innsats * 15); }} 
  elseif($nr1 == $nr2 && $nr1 == $nr3){ $vinn = true; $like = 3; } 
  elseif($nr2 == $nr3 && $nr3 == $nr4) { $vinn = true; $like = 3; }
  if($like == 3) {
  if($nr2 == 'k') { $get = floor($innsats * 2); } 
  elseif($nr2 == 's') { $get = floor($innsats * 5); } 
  elseif($nr2 == 'a') { $get = floor($innsats * 3); } 
  elseif($nr2 == 'b') { $get = floor($innsats * 7); }
  }
  if($vinn) { $NySum = floor($rad_B['penger'] + $get);  mysql_query("UPDATE brukere SET penger='$NySum',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); } 
  elseif(!$vinn) { $NySum = floor($rad_B['penger'] - $innsats);  mysql_query("UPDATE brukere SET penger='$NySum',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); }
  
  $b_1 = $nr1.$b1; 
  $b_2 = $nr2.$b2; 
  $b_3 = $nr3.$b3; 
  $b_4 = $nr4.$b4; 

  }} else { $b_1 = 'M'; $b_2 = 'M'; $b_3 = 'M'; $b_4 = 'M'; }

    
  echo "
  <tr class=\"Vanlig_1\"><td class=\"Linje Plassering\">
  <img src=\"../casino/".$b_1.".gif\">
  <img src=\"../casino/$b_2.gif\">
  <img src=\"../casino/$b_2.gif\">
  <img src=\"../casino/$b_3.gif\">
  </td></tr>
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Sats\" value=\"Sats\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sats')this.value='';\" onblur=\"if(this.value=='')this.value='Sats';\">
  <p class=\"Post\" onclick=\"Starto();\">Start spill!</p>
  </td></tr>";
    
  echo "</table></div>";
  }
  ?>
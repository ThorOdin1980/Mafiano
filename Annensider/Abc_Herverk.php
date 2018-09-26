  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script> 
  function Herverk(Valg) { var Valg = Valg.replace(/[^0-9]/g, ''); if(Valg == '') { alert('Ugyldig valg'); } else { document.getElementById('number').value=Valg;document.getElementById('VerkHer').submit(); }} 
  </script>
  
  <?
  if(empty($brukernavn)) { header("Location: index.php"); }
  elseif(SjekkPlassering($brukernavn) == 'klar') { 
  
  // Funksjoner til herverk
  function BSjangs($Alt) { global $herverk_gjort; if($Alt == '1') { $Arr = array('1','2','4','6','8'); } elseif($Alt == '2') { $Arr = array('7','9','12','15','18'); } elseif($Alt == '3') { $Arr = array('17','20','23','26','29'); } elseif($Alt == '4') { $Arr = array('28','31','34','37','40'); } elseif($Alt == '5') { $Arr = array('39','43','47','51','55'); } if($herverk_gjort <= $Arr['0']) { $V = "Ingen ( 0% )"; } if($herverk_gjort >= $Arr['1']) { $V = "Liten ( 10% )"; } if($herverk_gjort >= $Arr['2']) { $V = "Middels ( 30% )"; } if($herverk_gjort >= $Arr['3']) { $V = "Stor ( 50% )"; } if($herverk_gjort >= $Arr['4']) { $V = "Veldig Stor ( 70% )"; } return $V; }
  function GainPros($R) { if($R == "1") { $P = '2.5'; } elseif($R == "2") { $P = '1.9'; } elseif($R == "3") { $P = '1.5'; } elseif($R == "4") { $P = '1.0'; } elseif($R == "5") { $P = '0.8'; } elseif($R == "6") { $P = '0.2'; } elseif($R == "7") { $P = '0.1'; } elseif($R == "8") { $P = '0.08'; } elseif($R == "9") { $P = '0.02'; } elseif($R == "10") { $P = '0.01'; } elseif($R == "11") { $P = '0.009'; } elseif($R == "12") { $P = '0.005'; } elseif($R == "13") { $P = '0.004'; } elseif($R == "14") { $P = '0.003'; } elseif($R == "15") { $P = '0.002'; } elseif($R == "16") { $P = '0.001'; } elseif($R == "17") { $P = '0.0009'; } return $P; }
  
  $HerVent = $herverk_tiden - $Timestamp;
    
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\"><form method=\"post\" id=\"VerkHer\"><input type=\"hidden\" id=\"number\" name=\"number\"></form>
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Hærverk</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/herverk2.jpg\"></td></tr>
  ";
  
  if($herverk_tiden > $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du må vente <font id=\"HerVents\" class=\"TellNed\">$HerVent</font> sekunder.</span></td></tr>"; } 
  elseif(isset($_POST['number'])) { 
  $Valgt = Bare_Siffer(Mysql_Klar($_POST['number']));
  if(empty($Valgt)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>"; } 
  elseif($Valgt > '0' && $Valgt < '6') { 
  include 'Abc_herverk_funksjon'.$Valgt.'.php'; 
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>";  }
  } else {
  
  echo "
  <tr style=\"height:20px;\"><td class=\"R_4\">Oppgave</td><td class=\"R_4\">Fortjeneste</td><td class=\"R_4\">Sjangs</td></tr>
  <tr onclick=\"Herverk('5');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Ødelegg en bedrift</td><td class=\"Linje Plassering\">12 - 15 bombechips</td><td class=\"Linje Plassering\">".BSjangs('5')."</td></tr>
  <tr onclick=\"Herverk('4');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Tenn på en plantasje</td><td class=\"Linje Plassering\">9 - 12 bombechips</td><td class=\"Linje Plassering\">".BSjangs('4')."</td></tr>
  <tr onclick=\"Herverk('3');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Ødelegg et fly</td><td class=\"Linje Plassering\">6 - 9 bombechips</td><td class=\"Linje Plassering\">".BSjangs('3')."</td></tr>
  <tr onclick=\"Herverk('2');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Synk en båt</td><td class=\"Linje Plassering\">3 - 6 bombechips</td><td class=\"Linje Plassering\">".BSjangs('2')."</td></tr>
  <tr onclick=\"Herverk('1');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Vrak en bil</td><td class=\"Linje Plassering\">1 - 3 bombechips</td><td class=\"Linje Plassering\">".BSjangs('1')."</td></tr>
  ";
  
  }
  
  echo "</table></div>";
  
  }
  ?>
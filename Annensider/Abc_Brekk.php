<?php


if(botcheck_timecheck($_SESSION['id'], $db))  {
    $botcheck = TRUE;

    // Show botcheck form

    ?>
    <div class="content">
        <div class="heading">Antibotsjekk</div>
        <div class="text">Din tur for antibotsjekk. Velg alle bildene med en <b>bil</b> i.</div>   
        <div class="form">
            <div class="botcheck_images">
                <?php for ($i = 1; $i < 10; $i++) { ?>
                <div class="botcheck_image">
                    <label>
                        <input type="checkbox">
                        <img src="http://placeimg.com/150/150/arch/sepia">
                    </label>
                </div>
                <?php
                }
                ?>
                <div class="clear"></div>
            </div>

            <button class="form_big" name="done">Trykk når du er ferdig</button>

        </div>
    </div>

    <?php

} else {
    $botcheck = FALSE;
}

if($botcheck == FALSE) {

?>
  <script> function Brekk(Valg) { var Valg = Valg.replace(/[^0-9]/g, ''); if(Valg == '') { alert('Ugyldig valg'); } else { document.getElementById('number').value=Valg;document.getElementById('Brekk').submit(); }} </script>
  <?
  if(empty($brukernavn)) { header("Location: index.php"); }
  elseif(SjekkPlassering($brukernavn) == 'klar') { 

  // Funksjoner til brekk
  function BSjangs($Alt) { global $brekk_gjort; if($Alt == '1') { $Arr = array('1','2','4','6','8'); } elseif($Alt == '2') { $Arr = array('5','6','8','10','12'); } elseif($Alt == '3') { $Arr = array('11','12','14','16','18'); } elseif($Alt == '4') { $Arr = array('17','18','20','22','24'); } elseif($Alt == '5') { $Arr = array('23','24','26','28','30'); } elseif($Alt == '6') { $Arr = array('29','30','32','34','36'); } elseif($Alt == '7') { $Arr = array('35','36','39','42','45'); } elseif($Alt == '8') { $Arr = array('44','45','48','51','54'); } elseif($Alt == '9') { $Arr = array('53','54','58','62','66'); } elseif($Alt == '10') { $Arr = array('65','66','70','74','78'); } elseif($Alt == '11') { $Arr = array('77','78','82','86','90'); } elseif($Alt == '12') { $Arr = array('89','90','95','100','105'); } elseif($Alt == '13') { $Arr = array('104','105','110','115','120'); } elseif($Alt == '14') { $Arr = array('119','120','125','130','135'); } elseif($Alt == '15') { $Arr = array('134','135','142','149','156'); } if($brekk_gjort <= $Arr['0']) { $V = "Ingen ( 0% )"; } if($brekk_gjort >= $Arr['1']) { $V = "Liten ( 10% )"; } if($brekk_gjort >= $Arr['2']) { $V = "Passe ( 30% )"; } if($brekk_gjort >= $Arr['3']) { $V = "Stor ( 50% )"; } if($brekk_gjort >= $Arr['4']) { $V = "Veldig stor ( 70% )"; } return $V; }
  function GainPros($R) { if($R == "1") { $P = '3.0'; } elseif($R == "2") { $P = '2.6'; } elseif($R == "3") { $P = '2.0'; } elseif($R == "4") { $P = '1.3'; } elseif($R == "5") { $P = '1.0'; } elseif($R == "6") { $P = '0.8'; } elseif($R == "7") { $P = '0.4'; } elseif($R == "8") { $P = '0.1'; } elseif($R == "9") { $P = '0.06'; } elseif($R == "10") { $P = '0.04'; } elseif($R == "11") { $P = '0.02'; } elseif($R == "12") { $P = '0.006'; } elseif($R == "13") { $P = '0.005'; } elseif($R == "14") { $P = '0.004'; } elseif($R == "15") { $P = '0.003'; } elseif($R == "16") { $P = '0.002'; } elseif($R == "17") { $P = '0.001'; } return $P; }
  
  $BrekkVent = $brekk_tid - $Timestamp;

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\"><form method=\"post\" id=\"Brekk\"><input type=\"hidden\" id=\"number\" name=\"number\"></form>
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Brekk</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/brekk.jpg\"></td></tr>
  ";
  
  if($brekk_tid > $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente <font id=\"BrekkVents\" class=\"TellNed\">$BrekkVent</font> sekunder.</span></td></tr>"; } 
  elseif(isset($_POST['number'])) { 
  $Valgt = Bare_Siffer(Mysql_Klar($_POST['number']));
  if(empty($Valgt)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>"; } 
  elseif($Valgt > '0' && $Valgt < '16') { 
  include 'Abc_brekk_funksjon'.$Valgt.'.php'; 
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>";  }
  } else {
  
  echo "
  <tr style=\"height:20px;\"><td class=\"R_4\">Oppgave</td><td class=\"R_4\">Fortjeneste</td><td class=\"R_4\">Sjangs</td></tr>
  <tr onclick=\"Brekk('15');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Nokas tellesentral</td><td class=\"Linje Plassering\">3.000 - 4.000 kr</td><td class=\"Linje Plassering\">".BSjangs('15')."</td></tr>
  <tr onclick=\"Brekk('14');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Gisseldrama</td><td class=\"Linje Plassering\">2.800 - 3.800 kr</td><td class=\"Linje Plassering\">".BSjangs('14')."</td></tr>
  <tr onclick=\"Brekk('13');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Hack PayPal</td><td class=\"Linje Plassering\">2.600 - 3.600 kr</td><td class=\"Linje Plassering\">".BSjangs('13')."</td></tr>
  <tr onclick=\"Brekk('12');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Robb bilforretning</td><td class=\"Linje Plassering\">2.400 - 3.400 kr</td><td class=\"Linje Plassering\">".BSjangs('12')."</td></tr>
  <tr onclick=\"Brekk('11');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Megakupp på Mega</td><td class=\"Linje Plassering\">2.200 - 3.200 kr</td><td class=\"Linje Plassering\">".BSjangs('11')."</td></tr>
  <tr onclick=\"Brekk('10');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Ran bankboks</td><td class=\"Linje Plassering\">2.000 - 3.000 kr</td><td class=\"Linje Plassering\">".BSjangs('10')."</td></tr>
  <tr onclick=\"Brekk('9');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Stjel fra gullsmeden</td><td class=\"Linje Plassering\">1.800 - 2.800 kr</td><td class=\"Linje Plassering\">".BSjangs('9')."</td></tr>
  <tr onclick=\"Brekk('8');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Kidnapp naboen</td><td class=\"Linje Plassering\">1.600 - 2.600 kr</td><td class=\"Linje Plassering\">".BSjangs('8')."</td></tr>
  <tr onclick=\"Brekk('7');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Tøm kassa på 7-Eleven</td><td class=\"Linje Plassering\">1.400 - 2.400 kr</td><td class=\"Linje Plassering\">".BSjangs('7')."</td></tr>
  <tr onclick=\"Brekk('6');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Spreng safèn til prix</td><td class=\"Linje Plassering\">1.200 - 2.200 kr</td><td class=\"Linje Plassering\">".BSjangs('6')."</td></tr>
  <tr onclick=\"Brekk('5');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Ran kassa på kinoen</td><td class=\"Linje Plassering\">1.000 - 2.000 kr</td><td class=\"Linje Plassering\">".BSjangs('5')."</td></tr>
  <tr onclick=\"Brekk('4');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Innbrudd i hus</td><td class=\"Linje Plassering\">800 - 1.800 kr</td><td class=\"Linje Plassering\">".BSjangs('4')."</td></tr>
  <tr onclick=\"Brekk('3');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Ran taxisjofør</td><td class=\"Linje Plassering\">600 - 1.600 kr</td><td class=\"Linje Plassering\">".BSjangs('3')."</td></tr>
  <tr onclick=\"Brekk('2');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Nasking</td><td class=\"Linje Plassering\">400 - 1.400 kr</td><td class=\"Linje Plassering\">".BSjangs('2')."</td></tr>
  <tr onclick=\"Brekk('1');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Stjel fra Muhammed</td><td class=\"Linje Plassering\">200 - 1.200 kr</td><td class=\"Linje Plassering\">".BSjangs('1')."</td></tr>
  ";

  }

  echo "</table></div>";
  
  }
  

} // NO need for botcheck
  ?>
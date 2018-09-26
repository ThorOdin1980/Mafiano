  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script> 
  function Gta(Valg) { var Valg = Valg.replace(/[^0-9]/g, ''); if(Valg == '') { alert('Ugyldig valg'); } else { document.getElementById('number').value=Valg;document.getElementById('Gta').submit(); }} 
  function GtaTo() { var Navn = document.getElementById('stjel_fra').value; if(Navn == '' || Navn == 'Stjel bilen til en valgt spiller') { alert('Fyll inn ett brukernavn.'); } else { document.getElementById('Gta2').submit(); }}
  </script>
  <?
  if(empty($brukernavn)) { header("Location: index.php"); }
  elseif(SjekkPlassering($brukernavn) == 'klar') { 

  // Funksjoner til biltyveri
  function BSjangs($Alt) { global $biler_gjort; if($Alt == '1') { $Arr = array('1','2','3','6','9','12'); } elseif($Alt == '2') { $Arr = array('11','12','16','20','24','28'); } elseif($Alt == '3') { $Arr = array('27','28','33','38','43','48'); } elseif($Alt == '4') { $Arr = array('47','48','54','60','66','72'); } elseif($Alt == '5') { $Arr = array('71','72','79','86','93','100'); } if($biler_gjort <= $Arr['0']) { $V = "Ingen ( 0% )"; } if($biler_gjort >= $Arr['1']) { $V = "Liten ( 10% )"; } if($biler_gjort >= $Arr['2']) { $V = "Flaks ( 20% )"; } if($biler_gjort >= $Arr['3']) { $V = "Middels ( 35% )"; } if($biler_gjort >= $Arr['4']) { $V = "Stor ( 50% )"; } if($biler_gjort >= $Arr['5']) { $V = "Veldig stor ( 70% )"; } return $V; }
  function GainPros($R) { if($R == "1") { $P = '3.2'; } elseif($R == "2") { $P = '2.7'; } elseif($R == "3") { $P = '2.3'; } elseif($R == "4") { $P = '1.6'; } elseif($R == "5") { $P = '1.3'; } elseif($R == "6") { $P = '0.9'; } elseif($R == "7") { $P = '0.5'; } elseif($R == "8") { $P = '0.2'; } elseif($R == "9") { $P = '0.07'; } elseif($R == "10") { $P = '0.04'; } elseif($R == "11") { $P = '0.03'; } elseif($R == "12") { $P = '0.007'; } elseif($R == "13") { $P = '0.006'; } elseif($R == "14") { $P = '0.005'; } elseif($R == "15") { $P = '0.004'; } elseif($R == "16") { $P = '0.003'; } elseif($R == "17") { $P = '0.002'; } return $P; }
  function Hestekrefter($Merke) { if($Merke == 'Opel Calibra') { $HK = '160'; } elseif($Merke == 'Audi TT') { $HK = '225'; } elseif($Merke == 'Suziki XL-7') { $HK = '109'; } elseif($Merke == 'Suzuki XL-7') { $HK = '109'; } elseif($Merke == 'Toyota Supera') { $HK = '235'; } elseif($Merke == 'Toyota Supra') { $HK = '235'; } elseif($Merke == 'Nissan Skyline GT-R') { $HK = '250'; } elseif($Merke == 'Peugot 307 SW') { $HK = '90'; } elseif($Merke == 'Saab 9-5') { $HK = '120'; } elseif($Merke == 'Nissan 100 NX') { $HK = '100'; } elseif($Merke == 'Honda Civic 1,6') { $HK = '125'; } elseif($Merke == 'Lada Niva') { $HK = '80'; } elseif($Merke == 'Chrysler Neon') { $HK = '133'; } elseif($Merke == 'Ford Escort 1,4') { $HK = '87'; } elseif($Merke == 'Volvo 240') { $HK = '85'; } elseif($Merke == 'Mazda RX-8') { $HK = '240'; } elseif($Merke == 'Volkswagen golf 1,8 GT') { $HK = '90'; } elseif($Merke == 'Mercedes-Benz SLK') { $HK = '170'; } elseif($Merke == 'Range Rover 3.0 Td6') { $HK = '180'; } elseif($Merke == 'Porsche 944') { $HK = '200'; } elseif($Merke == 'Bmw 3-serie') { $HK = '160'; } elseif($Merke == 'Jaguar XKR 4,2') { $HK = '300'; } else { $HK = '0'; } return $HK; }

  $GtaVent = $bil_tid - $Timestamp;
  
  $Form = "
  <tr style=\"height:20px;\"><td class=\"R_4\">Oppgave</td><td class=\"R_4\">Bilverdi</td><td class=\"R_4\">Sjangs</td></tr>
  <tr onclick=\"Gta('5');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Bilbutikken</td><td class=\"Linje Plassering\">90.000 - 600.000 kr</td><td class=\"Linje Plassering\">".BSjangs('5')."</td></tr>
  <tr onclick=\"Gta('4');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Bilforretning</td><td class=\"Linje Plassering\">80.000 - 310.000 kr</td><td class=\"Linje Plassering\">".BSjangs('4')."</td></tr>
  <tr onclick=\"Gta('3');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Lokal gate</td><td class=\"Linje Plassering\">60.000 - 210.000 kr</td><td class=\"Linje Plassering\">".BSjangs('3')."</td></tr>
  <tr onclick=\"Gta('2');\" class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Parkeringsplass</td><td class=\"Linje Plassering\">40.000 - 80.000 kr</td><td class=\"Linje Plassering\">".BSjangs('2')."</td></tr>
  <tr onclick=\"Gta('1');\" class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Bruktbil</td><td class=\"Linje Plassering\">20.000 - 50.000 kr</td><td class=\"Linje Plassering\">".BSjangs('1')."</td></tr>
  <tr class=\"Vanlig_2\" colspan=\"3\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <form method=\"post\" id=\"Gta2\"><input type=\"text\" name=\"stjel_fra\" id=\"stjel_fra\" value=\"Stjel bilen til en valgt spiller\" maxlength=\"30\" onFocus=\"if(this.value=='Stjel bilen til en valgt spiller')this.value='';\" onblur=\"if(this.value=='')this.value='Stjel bilen til en valgt spiller';\"></form>
  <p class=\"Post\" onclick=\"GtaTo();\">Stjel bil!</p>
  </td></tr>
  ";
  

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\"><form method=\"post\" id=\"Gta\"><input type=\"hidden\" id=\"number\" name=\"number\"></form>
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Biltyveri</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/biltyveri.jpg\"></td></tr>
  ";
  
  if($bil_tid > $Timestamp) {
    echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du må vente <font id=\"GtaVents\" class=\"TellNed\">$GtaVent</font> sekunder.</span></td></tr>";
  } 
  elseif(isset($_POST['stjel_fra'])) { 
    $StjelFra = Mysql_Klar($_POST['stjel_fra']);
  if(empty($StjelFra)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>";
  echo $Form;
} 
  elseif(strlen($StjelFra) > '30') {
    echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukernavnet er for langt.</span></td></tr>";
    echo $Form;
  } else { 

  $SjekkBruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$StjelFra'");
  if(mysql_num_rows($SjekkBruker) == 0) {
    echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Finner ikke brukeren.</span></td></tr>";
    echo $Form;
  } else { 
  $SInfo = mysql_fetch_assoc($SjekkBruker);
  if($SInfo['liv'] < '1') {
    echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukeren er død, du kan ikke stjele fra døde spillere.</span></td></tr>";
    echo $Form;
  } 
  elseif($SInfo['brukernavn'] == $brukernavn) {
    echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du kan ikke stjele fra din egen bruker.</span></td></tr>";
    echo $Form;
  } else { 
  $StjelFra = $SInfo['brukernavn'];
  include "Annensider/Abc_bil_gta_funksjon.php";
  }}}}
  elseif(isset($_POST['number'])) { 
  $Valgt = Bare_Siffer(Mysql_Klar($_POST['number']));
  if(empty($Valgt)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>"; } 
  elseif($Valgt > '0' && $Valgt < '6') { 
  include 'Abc_bil_gta_funksjon'.$Valgt.'.php';
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>";  }
  } else { echo $Form; }

  echo "</table></div>";
  
  }
  ?>
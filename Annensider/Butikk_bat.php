  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else { 
  
  $Butikken = strtoupper($I['Butikk_Type']);
  $Varer = explode('<br>', $I['Butikk_varer']);
  $Triton = explode(',', $Varer['0']);
  $Mariah = explode(',', $Varer['1']);
  $SeaRay = explode(',', $Varer['2']);
  $FORBINA = explode(',', $Varer['3']);
  $Mediterrane = explode(',', $Varer['4']);
  $Meridian = explode(',', $Varer['5']);

  $KjopBat = ""; $EndrePris = ""; $Konto = ""; $Rep = ""; $SelgButikk = "";
  
  if($_POST['du_valgte'] == 'KjopBat') { 
  $Antall = Bare_Siffer(Mysql_Klar($_POST['vBat']));
  $box = $_POST['box1']; $box_count = count($box);
  if($Antall == '2' || $Antall == '4' || $Antall == '6' || $Antall == '8' || $Antall == '10' || $Antall == '20' || $Antall == '30') { 
  if($box_count > '6') { $KjopBat = PrintTeksten('Det er ikke flere en seks forsjellige båter.','2','Feilet','2'); } else { 
  $Pris = '0'; 
  $BeskEn = Bare_Siffer($Triton['0']); 
  $BeskTo = Bare_Siffer($Mariah['0']); 
  $BeskTre = Bare_Siffer($SeaRay['0']); 
  $BeskFire = Bare_Siffer($FORBINA['0']); 
  $BeskFem = Bare_Siffer($Mediterrane['0']); 
  $BeskSeks = Bare_Siffer($Meridian['0']); 
  $P_1 = VerdiSum(Bare_Siffer($Triton['1']),'kr'); 
  $P_2 = VerdiSum(Bare_Siffer($Mariah['1']),'kr'); 
  $P_3 = VerdiSum(Bare_Siffer($SeaRay['1']),'kr'); 
  $P_4 = VerdiSum(Bare_Siffer($FORBINA['1']),'kr'); 
  $P_5 = VerdiSum(Bare_Siffer($Mediterrane['1']),'kr');
  $P_6 = VerdiSum(Bare_Siffer($Meridian['1']),'kr');
  foreach($box as $var) {
  if($var == 'Triton 225') { $Pris = $Pris + ('300000' * $Antall); $BeskEn = $BeskEn + $Antall; }
  elseif($var == 'Mariah SC25') { $Pris = $Pris + ('500000' * $Antall); $BeskTo = $BeskTo + $Antall; }
  elseif($var == 'Sea Ray 275') { $Pris = $Pris + ('1000000' * $Antall); $BeskTre = $BeskTre + $Antall; } 
  elseif($var == 'FORBINA 36') { $Pris = $Pris + ('2000000' * $Antall); $BeskFire = $BeskFire + $Antall; }
  elseif($var == 'Mediterranèe 43') { $Pris = $Pris + ('3000000' * $Antall); $BeskFem = $BeskFem + $Antall; }
  elseif($var == 'Meridian 459') { $Pris = $Pris + ('5000000' * $Antall); $BeskSeks = $BeskSeks + $Antall; }} $Pris = floor($Pris);
  if($Pris > $I['Butikk_Konto']) { $KjopBat = PrintTeksten('Du har ikke nok penger på kontoen.','2','Feilet','2'); } else {
  $NySum = floor($I['Butikk_Konto'] - $Pris);
  $PrisVis = VerdiSum($Pris,'kr');
  $NyVar = "Triton: $BeskEn,$P_1<br>Mariah: $BeskTo,$P_2<br>Sea Ray: $BeskTre,$P_3<br>FORBINA: $BeskFire,$P_4<br>Mediterranèe: $BeskFem,$P_5<br>Meridian: $BeskSeks,$P_6<br>";

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_Konto='$NySum',Butikk_varer='$NyVar',Butikk_utgift=`Butikk_utgift`+'$Pris' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $KjopBat = PrintTeksten("Du har handlet båter for $PrisVis.",'2','Vellykket','2'); }
  }}else { $KjopBat = PrintTeksten('Du må velge antallet du skal handle.','2','Feilet','2'); }
  }
  elseif($_POST['du_valgte'] == 'EndrePris') { 
  $Endre = Mysql_Klar($_POST['vPris']);
  $box = $_POST['box2']; $box_count = count($box);
  if($Endre == '+ 200.000 kr' || $Endre == '+ 300.000 kr' || $Endre == '+ 400.000 kr' || $Endre == '+ 500.000 kr' || $Endre == '+ 600.000 kr' || $Endre == '+ 700.000 kr' || $Endre == '+ 800.000 kr' || $Endre == '+ 900.000 kr' || $Endre == '- 200.000 kr' || $Endre == '- 300.000 kr' || $Endre == '- 400.000 kr' || $Endre == '- 500.000 kr' || $Endre == '- 600.000 kr' || $Endre == '- 700.000 kr' || $Endre == '- 800.000 kr' || $Endre == '- 900.000 kr') {
  $BeskEn = Bare_Siffer($Triton['0']); 
  $BeskTo = Bare_Siffer($Mariah['0']); 
  $BeskTre = Bare_Siffer($SeaRay['0']); 
  $BeskFire = Bare_Siffer($FORBINA['0']); 
  $BeskFem = Bare_Siffer($Mediterrane['0']); 
  $BeskSeks = Bare_Siffer($Meridian['0']); 
  $P_1 = Bare_Siffer($Triton['1']); 
  $P_2 = Bare_Siffer($Mariah['1']); 
  $P_3 = Bare_Siffer($SeaRay['1']); 
  $P_4 = Bare_Siffer($FORBINA['1']); 
  $P_5 = Bare_Siffer($Mediterrane['1']);
  $P_6 = Bare_Siffer($Meridian['1']);
  $PlussEll = substr($Endre, 0, 1) . '';  
  $Endre = Bare_Siffer($Endre);
  foreach($box as $var) { 
  if($var == 'Triton 225') { if($PlussEll == '-') { $P_1 = floor($P_1 - $Endre); if($P_1 < '100') { $P_1 = '100'; }} else { $P_1 = floor($P_1 + $Endre); }}
  elseif($var == 'Mariah SC25') {if($PlussEll == '-') { $P_2 = floor($P_2 - $Endre); if($P_2 < '100') { $P_2 = '100'; }} else { $P_2 = floor($P_2 + $Endre); }}
  elseif($var == 'Sea Ray 275') {if($PlussEll == '-') { $P_3 = floor($P_3 - $Endre); if($P_3 < '100') { $P_3 = '100'; }} else { $P_3 = floor($P_3 + $Endre); }}
  elseif($var == 'FORBINA 36') {if($PlussEll == '-') { $P_4 = floor($P_4 - $Endre); if($P_4 < '100') { $P_4 = '100'; }} else { $P_4 = floor($P_4 + $Endre); }}
  elseif($var == 'Mediterranèe 43') {if($PlussEll == '-') { $P_5 = floor($P_5 - $Endre); if($P_5 < '100') { $P_5 = '100'; } } else { $P_5 = floor($P_5 + $Endre); }}
  elseif($var == 'Meridian 459') {if($PlussEll == '-') { $P_6 = floor($P_6 - $Endre); if($P_6 < '100') { $P_6 = '100'; } } else { $P_6 = floor($P_6 + $Endre); }}}
  $NyVar = "Triton: $BeskEn,$P_1<br>Mariah: $BeskTo,$P_2<br>Sea Ray: $BeskTre,$P_3<br>FORBINA: $BeskFire,$P_4<br>Mediterranèe: $BeskFem,$P_5<br>Meridian: $BeskSeks,$P_6<br>";

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_varer='$NyVar' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $EndrePris = PrintTeksten("Du har endret prisen.",'2','Vellykket','2');
  } else { $EndrePris = PrintTeksten('Du må velge en sum.','2','Feilet','2'); }
  }elseif($_POST['du_valgte'] == 'SettInn') { 
  $sum = Bare_Siffer(Mysql_Klar($_POST['sum']));
  if(empty($sum)) { $Konto = PrintTeksten('Du må skrive inn en sum.','2','Feilet','3'); } else { 
  if($sum > '100000000000') { $Konto = PrintTeksten('Summen er for høy.','2','Feilet','3'); } else { 
  if($sum < '100') { $Konto = PrintTeksten('Du kan kan minimum sette inn 100 kr.','2','Feilet','3'); } else { 
  if($sum > $penger) { $Konto = PrintTeksten('Du har ikke nok penger kontant.','2','Feilet','3'); } else {
  $NySumCash = floor($penger - $sum);
  $NyKontoSum = floor($I['Butikk_Konto'] + $sum);
  $SumInn = VerdiSum($sum,'kr');

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',penger='$NySumCash' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_Konto='$NyKontoSum' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $Konto = PrintTeksten("Du har satt inn $SumInn.",'2','Vellykket','3');
  }}}}}elseif($_POST['du_valgte'] == 'TaUt') { 
  $sum = Bare_Siffer(Mysql_Klar($_POST['sum']));
  if(empty($sum)) { $Konto = PrintTeksten('Du må skrive inn en sum.','2','Feilet','3'); } else { 
  if($sum > '100000000000') { $Konto = PrintTeksten('Summen er for høy.','2','Feilet','3'); } else { 
  if($sum < '100') { $Konto = PrintTeksten('Du kan kan minimum ta ut 100 kr.','2','Feilet','3'); } else { 
  if($sum > $I['Butikk_Konto']) { $Konto = PrintTeksten('Du har ikke nok penger på kontoen.','2','Feilet','3'); } else {
  $NySumCash = floor($penger + $sum);
  $NyKontoSum = floor($I['Butikk_Konto'] - $sum);
  $SumUt = VerdiSum($sum,'kr');

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',penger='$NySumCash' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_Konto='$NyKontoSum' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $Konto = PrintTeksten("Du har tatt ut $SumUt.",'2','Vellykket','3');
  }}}}}elseif($_POST['du_valgte'] == 'Reparer') { 
  $Prosent = Bare_Siffer(Mysql_Klar($_POST['vButikken']));
  if($I['Butikk_skade'] == '100') { $Rep = PrintTeksten("Butikken er alt 100 prosent.",'2','Feilet','2'); } else {
  if(empty($Prosent)) { $Rep = PrintTeksten("Du må velge hvor mange prosent du vil reparere.",'2','Feilet','2'); } else { 
  if($Prosent == '10' || $Prosent == '20' || $Prosent == '30') { 
  $Pris = $Prosent * '20000';
  $NySumSpenn = floor($I['Butikk_Konto'] - $Pris);
  $NyPros = floor($I['Butikk_skade'] + $Prosent);
  $SumKoster = VerdiSum($Pris,'kr');
  if($Pris > $I['Butikk_Konto']) { $Rep = PrintTeksten("Det er ikke nok penger i butikk kontoen.",'2','Feilet','2'); } else { 
  if($NyPros > '100') { $NyPros = '100'; }

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_Konto='$NySumSpenn',Butikk_skade='$NyPros' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $Rep = PrintTeksten("Du har reparert bygget, det kostet $SumKoster.",'2','Vellykket','2');
  }} else { $Rep = PrintTeksten("Ugyldig valg.",'2','Feilet','2'); }}}}
  elseif($_POST['du_valgte'] == 'SelgButikk') {
  $TilBruker = Mysql_Klar($_POST['S_Til']);
  $PengSum = Bare_Siffer(Mysql_Klar($_POST['S_Penger']));
  $PoengSum = Bare_Siffer(Mysql_Klar($_POST['S_Poeng']));
  if(empty($TilBruker)) { $SelgButikk = PrintTeksten("Hvem butikken skal selges til mangler.",'2','Feilet','2'); }
  elseif(empty($PengSum)) { $SelgButikk = PrintTeksten("Du må skrive inn hvor mye penger du skal ha.",'2','Feilet','2'); }
  elseif(empty($PoengSum)) { $SelgButikk = PrintTeksten("Du må skrive inn hvor mye poeng du skal ha.",'2','Feilet','2'); }
  elseif($PengSum < '1000000') { $SelgButikk = PrintTeksten("Butikken kan ikke selges for under 1.000.000 kr.",'2','Feilet','2'); }
  elseif($PoengSum < '100') { $SelgButikk = PrintTeksten("Butikken kan ikke selges for under 100 poeng.",'2','Feilet','2'); }
  elseif($PengSum > '10000000000') { $SelgButikk = PrintTeksten("Butikken kan ikke selges for mer en 10.000.000.000 kr.",'2','Feilet','2'); }
  elseif($PoengSum > '30000') { $SelgButikk = PrintTeksten("Butikken kan ikke selges for mer en 30.000 poeng.",'2','Feilet','2'); } else { 

  $Hent = mysql_query("SELECT * FROM brukere WHERE brukernavn='$TilBruker'");
  if(mysql_num_rows($Hent) == '0') { $SelgButikk = PrintTeksten("$TilBruker eksisterer ikke.",'2','Feilet','2'); } else { 
  $H = mysql_fetch_assoc($Hent); 
  if($brukernavn == $H['brukernavn']) { $SelgButikk = PrintTeksten("Du kan ikke selge butikken til deg selv.",'2','Feilet','2'); } 
  elseif($H['liv'] < '1') { $SelgButikk = PrintTeksten("".$H['brukernavn']." er død.",'2','Feilet','2'); } else { 
  
  $SelgButikk = PrintTeksten("Du kan snart selge butikken.",'2','Feilet','2');
  }}}}
  
  if(empty($_POST['vBat'])) { $DD1 = 'Ingen'; $D1 = '<b>Kjøp båt:</b> Ingen'; } else { $D1 = "<b>Kjøp båt:</b> ".$_POST['vBat']; $DD1 = $_POST['vBat']; }
  if(empty($_POST['vPris'])) { $DD2 = 'Ingen'; $D2 = '<b>Pris:</b> Ingen'; } else { $D2 = "<b>Pris:</b> ".$_POST['vPris']; $DD2 = $_POST['vPris']; }
  if(empty($_POST['sum'])) { $D3 = 'sum'; } else { $D3 = $_POST['sum']; }
  if(empty($_POST['vButikken'])) { $DD4 = 'Ingen'; $D4 = '<b>Reparer:</b> Ingen'; } else { $D4 = "<b>Reparer:</b> ".$_POST['vButikken']; $DD4 = $_POST['vButikken']; }
  if(empty($_POST['S_Til'])) { $S_Til = 'Selg til'; } else { $S_Til = $_POST['S_Til']; }
  if(empty($_POST['S_Penger'])) { $S_Penger = 'Pengesum'; } else { $S_Penger = $_POST['S_Penger']; }
  if(empty($_POST['S_Poeng'])) { $S_Poeng = 'Poengsum'; } else { $S_Poeng = $_POST['S_Poeng']; }

  
  
  $Fortjeneste = $I['Butikk_inntekt'] - $I['Butikk_utgift'];
  if($Fortjeneste == '0') { $Fortjeneste = '<b>0 kr</b>'; } 
  elseif($Fortjeneste < '0') { $Fortjeneste = "<font color=\"#FF0000\"><b>".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }
  elseif($Fortjeneste > '0') { $Fortjeneste = "<font color=\"#33CC33\"><b>+".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }
  
  echo "
  <div class=\"Div_masta\"><form method=\"post\" id=\"BatD\">
  <input type=\"hidden\" name=\"vBat\" id=\"vBat\" value=\"$DD1\"/>
  <input type=\"hidden\" name=\"vPris\" id=\"vPris\" value=\"$DD2\"/>
  <input type=\"hidden\" name=\"vButikken\" id=\"vButikken\" value=\"$DD4\"/>
  <input type=\"hidden\" name=\"du_valgte\" id=\"du_valgte\" value=\"\"/>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">KJØP BÅT</td></tr>";
  echo $KjopBat;
  echo "
  <tr><td class=\"R_4\">Båt</td><td class=\"R_4\">Pris</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Triton 225\">Triton 225</td><td class=\"R_2\">300.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Mariah SC25\">Mariah SC25</td><td class=\"R_2\">500.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Sea Ray 275\">Sea Ray 275</td><td class=\"R_2\">1.000.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"FORBINA 36\">FORBINA 36</td><td class=\"R_2\">2.000.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Mediterranèe 43\">Mediterranèe 43</td><td class=\"R_2\">3.000.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Meridian 459\">Meridian 459</td><td class=\"R_2\">5.000.000</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisBat')\">
  <div id=\"Kjøp båt\">$D1</div>
  <div id=\"VisBat\" class=\"D_BoksTo\">
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp båt','2 stk','vBat')\">---> To båter</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp båt','4 stk','vBat')\">---> Fire båter</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp båt','6 stk','vBat')\">---> Seks båter</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp båt','8 stk','vBat')\">---> Åtte båter</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp båt','10 stk','vBat')\">---> Ti båter</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp båt','20 stk','vBat')\">---> Tjue båter</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp båt','30 stk','vBat')\">---> Tretti båter</div></div>
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='KjopBat';document.getElementById('BatD').submit()\">KJØP</td></tr>
  </table>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">DINE BÅTER</td></tr>";
  echo $EndrePris;
  echo "
  <tr><td class=\"R_4\">Båt</td><td class=\"R_4\">Selges for</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Triton 225\">Triton 225 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Triton['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Triton['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Mariah SC25\">Mariah SC25 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Mariah['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Mariah['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Sea Ray 275\">Sea Ray 275 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($SeaRay['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($SeaRay['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"FORBINA 36\">FORBINA 36 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($FORBINA['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($FORBINA['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Mediterranèe 43\">Mediterranèe 43 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Mediterrane['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Mediterrane['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Meridian 459\">Meridian 459 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Meridian['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Meridian['1']),'')."</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('DineBater')\">
  <div id=\"Pris\">$D2</div>
  <div id=\"DineBater\" class=\"D_BoksTo\">
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 200.000 kr','vPris')\">---> Pluss 200.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 300.000 kr','vPris')\">---> Pluss 300.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 400.000 kr','vPris')\">---> Pluss 400.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 500.000 kr','vPris')\">---> Pluss 500.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 600.000 kr','vPris')\">---> Pluss 600.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 700.000 kr','vPris')\">---> Pluss 700.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 800.000 kr','vPris')\">---> Pluss 800.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 900.000 kr','vPris')\">---> Pluss 900.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 200.000 kr','vPris')\">---> Minus 200.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 300.000 kr','vPris')\">---> Minus 300.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 400.000 kr','vPris')\">---> Minus 400.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 500.000 kr','vPris')\">---> Minus 500.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 600.000 kr','vPris')\">---> Minus 600.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 700.000 kr','vPris')\">---> Minus 700.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 800.000 kr','vPris')\">---> Minus 800.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 900.000 kr','vPris')\">---> Minus 900.000 kr</div>
  </div>
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='EndrePris';document.getElementById('BatD').submit()\">ENDRE</td></tr>
  </table>
  </div>
  <div class=\"Div_masta\">
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"3\">ØKONOMI</td></tr>";
  echo $Konto;
  echo "
  <tr><td class=\"R_1\" colspan=\"3\">Kontobalanse: <b>".VerdiSum($I['Butikk_Konto'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Båtkjøp (ut): <b>".VerdiSum($I['Butikk_utgift'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Båtsalg (inn): <b>".VerdiSum($I['Butikk_inntekt'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Fortjeneste: ".$Fortjeneste."</td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Antall salg: <b>".VerdiSum($I['Butikk_salg'],'stk')."</b></td></tr>
  <tr><td class=\"R_1\"><input class=\"textbox2\" type=\"text\" name=\"sum\" value=\"$D3\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='sum')this.value='';\" onblur=\"if(this.value=='')this.value='sum';\"></td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='SettInn';document.getElementById('BatD').submit()\">SETT INN</td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='TaUt';document.getElementById('BatD').submit()\">TA UT</td></tr>
  </table>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">BUTIKKEN</td></tr>";
  echo $Rep;
  echo "
  <tr><td class=\"R_4\">Butikk</td><td class=\"R_4\">Info</td></tr>
  <tr><td class=\"R_1\">Butikk tillstand</td><td class=\"R_2\">".VerdiSum(floor($I['Butikk_skade']),'%')."</td></tr>
  <tr><td class=\"R_1\">Butikk herverk</td><td class=\"R_2\">".VerdiSum($I['Butikk_herverk'],'stk')."</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('DittBygg')\">
  <div id=\"Reparer\">$D4</div>
  <div id=\"DittBygg\" class=\"D_BoksTo\">
  <div class=\"D_Over\" onclick=\"VisValg('Reparer','10%','vButikken')\">---> 10% - 200.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Reparer','20%','vButikken')\">---> 20% - 400.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Reparer','30%','vButikken')\">---> 30% - 600.000 kr</div>
  </div>
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Reparer';document.getElementById('BatD').submit()\">UTFØR</td></tr>
  </table>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">SELG BUTIKK</td></tr>";
  echo $SelgButikk;
  echo "
  <tr><td class=\"R_1\"><input class=\"textbox3\" type=\"text\" name=\"S_Til\" value=\"$S_Til\" onFocus=\"if(this.value=='Selg til')this.value='';\" onblur=\"if(this.value=='')this.value='Selg til';\"></td></tr>
  <tr><td class=\"R_1\"><input class=\"textbox3\" type=\"text\" name=\"S_Penger\" value=\"$S_Penger\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Pengesum')this.value='';\" onblur=\"if(this.value=='')this.value='Pengesum';\"></td></tr>
  <tr><td class=\"R_1\"><input class=\"textbox3\" type=\"text\" name=\"S_Poeng\" value=\"$S_Poeng\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Poengsum')this.value='';\" onblur=\"if(this.value=='')this.value='Poengsum';\"></td></tr>
  <tr><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='SelgButikk';document.getElementById('BatD').submit()\">SELG</td></tr>
  </table>
  </form></div>
  ";
  


  }
  ?>
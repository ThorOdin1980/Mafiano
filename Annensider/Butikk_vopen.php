  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else { 
  
  $Butikken = strtoupper($I['Butikk_Type']);
  $Varer = explode('<br>', $I['Butikk_varer']);
  $en = explode(',', $Varer['0']);
  $to = explode(',', $Varer['1']);
  $tre = explode(',', $Varer['2']);
  $fire = explode(',', $Varer['3']);
  $fem = explode(',', $Varer['4']);
  $seks = explode(',', $Varer['5']);
  $sju = explode(',', $Varer['6']);
  $atte = explode(',', $Varer['7']);
  $ni = explode(',', $Varer['8']);


  $KjopVopen = ""; $EndrePris = ""; $Konto = ""; $Rep = "";
  
  if($_POST['du_valgte'] == 'KjopVopen') { 
  $Antall = Bare_Siffer(Mysql_Klar($_POST['vVopen']));
  $box = $_POST['box1']; $box_count = count($box);
  if($Antall == '3' || $Antall == '5' || $Antall == '10' || $Antall == '20' || $Antall == '30' || $Antall == '40' || $Antall == '50' || $Antall == '60' || $Antall == '70') { 
  if($box_count > '9') { $KjopVopen = PrintTeksten('Det er ikke flere en ni forsjellige våpen.','2','Feilet','2'); } else { 
  $Pris = '0'; 
  $BeskEn = Bare_Siffer($en['0']); 
  $BeskTo = Bare_Siffer($to['0']); 
  $BeskTre = Bare_Siffer($tre['0']); 
  $BeskFire = Bare_Siffer($fire['0']); 
  $BeskFem = Bare_Siffer($fem['0']); 
  $BeskSeks = Bare_Siffer($seks['0']); 
  $BeskSju = Bare_Siffer($sju['0']); 
  $BeskAtte = Bare_Siffer($atte['0']); 
  $BeskNi = Bare_Siffer($ni['0']); 
  $P_1 = VerdiSum(Bare_Siffer($en['1']),'kr'); 
  $P_2 = VerdiSum(Bare_Siffer($to['1']),'kr'); 
  $P_3 = VerdiSum(Bare_Siffer($tre['1']),'kr'); 
  $P_4 = VerdiSum(Bare_Siffer($fire['1']),'kr'); 
  $P_5 = VerdiSum(Bare_Siffer($fem['1']),'kr');
  $P_6 = VerdiSum(Bare_Siffer($seks['1']),'kr'); 
  $P_7 = VerdiSum(Bare_Siffer($sju['1']),'kr'); 
  $P_8 = VerdiSum(Bare_Siffer($atte['1']),'kr'); 
  $P_9 = VerdiSum(Bare_Siffer($ni['1']),'kr'); 
  
  foreach($box as $var) {
  if($var == 'Hammer') { $Pris = $Pris + ('2000' * $Antall); $BeskEn = $BeskEn + $Antall; }
  elseif($var == 'Balltre') { $Pris = $Pris + ('5000' * $Antall); $BeskTo = $BeskTo + $Antall; }
  elseif($var == 'Knokejern') { $Pris = $Pris + ('10000' * $Antall); $BeskTre = $BeskTre + $Antall; } 
  elseif($var == 'Kniv') { $Pris = $Pris + ('20000' * $Antall); $BeskFire = $BeskFire + $Antall; }
  elseif($var == 'Glock 17') { $Pris = $Pris + ('30000' * $Antall); $BeskFem = $BeskFem + $Antall; }
  elseif($var == 'Desert Eagle') { $Pris = $Pris + ('70000' * $Antall); $BeskSeks = $BeskSeks + $Antall; }
  elseif($var == 'Uzi smg') { $Pris = $Pris + ('90000' * $Antall); $BeskSju = $BeskSju + $Antall; }
  elseif($var == 'Ak-47') { $Pris = $Pris + ('450000' * $Antall); $BeskAtte = $BeskAtte + $Antall; }
  elseif($var == 'Steyr aug a1') { $Pris = $Pris + ('2000000' * $Antall); $BeskNi = $BeskNi + $Antall; }} $Pris = floor($Pris);
  if($Pris > $I['Butikk_Konto']) { $KjopVopen = PrintTeksten('Du har ikke nok penger på kontoen.','2','Feilet','2'); } else {
  $NySum = floor($I['Butikk_Konto'] - $Pris);
  $PrisVis = VerdiSum($Pris,'kr');
  $NyVar = "Hammer: $BeskEn,$P_1<br>Balltre: $BeskTo,$P_2<br>Knokejern: $BeskTre,$P_3<br>Kniv: $BeskFire,$P_4<br>Glock: $BeskFem,$P_5<br>Desert Eagle: $BeskSeks,$P_6<br>Uzi smg: $BeskSju,$P_7<br>Ak: $BeskAtte,$P_8<br>Steyr: $BeskNi,$P_9<br>";

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_Konto='$NySum',Butikk_varer='$NyVar',Butikk_utgift=`Butikk_utgift`+'$Pris' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $KjopVopen = PrintTeksten("Du har handlet våpen for $PrisVis.",'2','Vellykket','2'); }
  }}else { $KjopVopen = PrintTeksten('Du må velge antallet du skal handle.','2','Feilet','2'); }
  }
  elseif($_POST['du_valgte'] == 'EndrePris') { 
  $Endre = Mysql_Klar($_POST['vPris']);
  $box = $_POST['box2']; $box_count = count($box);
  if($Endre == '+ 3.000 kr' || $Endre == '+ 4.000 kr' || $Endre == '+ 5.000 kr' || $Endre == '+ 6.000 kr' || $Endre == '+ 7.000 kr' || $Endre == '+ 8.000 kr' || $Endre == '+ 9.000 kr' || $Endre == '+ 10.000 kr' || $Endre == '- 3.000 kr' || $Endre == '- 4.000 kr' || $Endre == '- 5.000 kr' || $Endre == '- 6.000 kr' || $Endre == '- 7.000 kr' || $Endre == '- 8.000 kr' || $Endre == '- 9.000 kr' || $Endre == '- 10.000 kr') {
  $BeskEn = Bare_Siffer($en['0']); 
  $BeskTo = Bare_Siffer($to['0']); 
  $BeskTre = Bare_Siffer($tre['0']); 
  $BeskFire = Bare_Siffer($fire['0']); 
  $BeskFem = Bare_Siffer($fem['0']); 
  $BeskSeks = Bare_Siffer($seks['0']); 
  $BeskSju = Bare_Siffer($sju['0']); 
  $BeskAtte = Bare_Siffer($atte['0']); 
  $BeskNi = Bare_Siffer($ni['0']); 
  $P_1 = Bare_Siffer($en['1']); 
  $P_2 = Bare_Siffer($to['1']); 
  $P_3 = Bare_Siffer($tre['1']); 
  $P_4 = Bare_Siffer($fire['1']); 
  $P_5 = Bare_Siffer($fem['1']);
  $P_6 = Bare_Siffer($seks['1']); 
  $P_7 = Bare_Siffer($sju['1']); 
  $P_8 = Bare_Siffer($atte['1']); 
  $P_9 = Bare_Siffer($ni['1']); 
  $PlussEll = substr($Endre, 0, 1) . '';  
  $Endre = Bare_Siffer($Endre);
  foreach($box as $var) { 
  if($var == 'Hammer') { if($PlussEll == '-') { $P_1 = floor($P_1 - $Endre); if($P_1 < '100') { $P_1 = '100'; }} else { $P_1 = floor($P_1 + $Endre); }}
  elseif($var == 'Balltre') {if($PlussEll == '-') { $P_2 = floor($P_2 - $Endre); if($P_2 < '100') { $P_2 = '100'; }} else { $P_2 = floor($P_2 + $Endre); }}
  elseif($var == 'Knokejern') {if($PlussEll == '-') { $P_3 = floor($P_3 - $Endre); if($P_3 < '100') { $P_3 = '100'; }} else { $P_3 = floor($P_3 + $Endre); }}
  elseif($var == 'Kniv') {if($PlussEll == '-') { $P_4 = floor($P_4 - $Endre); if($P_4 < '100') { $P_4 = '100'; }} else { $P_4 = floor($P_4 + $Endre); }}
  elseif($var == 'Glock 17') {if($PlussEll == '-') { $P_5 = floor($P_5 - $Endre); if($P_5 < '100') { $P_5 = '100'; } } else { $P_5 = floor($P_5 + $Endre); }}
  elseif($var == 'Desert Eagle') {if($PlussEll == '-') { $P_6 = floor($P_6 - $Endre); if($P_6 < '100') { $P_6 = '100'; } } else { $P_6 = floor($P_6 + $Endre); }}
  elseif($var == 'Uzi smg') {if($PlussEll == '-') { $P_7 = floor($P_7 - $Endre); if($P_7 < '100') { $P_7 = '100'; } } else { $P_7 = floor($P_7 + $Endre); }}
  elseif($var == 'Ak-47') {if($PlussEll == '-') { $P_8 = floor($P_8 - $Endre); if($P_8 < '100') { $P_8 = '100'; } } else { $P_8 = floor($P_8 + $Endre); }}
  elseif($var == 'Steyr aug a1') {if($PlussEll == '-') { $P_9 = floor($P_9 - $Endre); if($P_9 < '100') { $P_9 = '100'; } } else { $P_9 = floor($P_9 + $Endre); }}}
  $NyVar = "Hammer: $BeskEn,$P_1<br>Balltre: $BeskTo,$P_2<br>Knokejern: $BeskTre,$P_3<br>Kniv: $BeskFire,$P_4<br>Glock: $BeskFem,$P_5<br>Desert Eagle: $BeskSeks,$P_6<br>Uzi smg: $BeskSju,$P_7<br>Ak: $BeskAtte,$P_8<br>Steyr: $BeskNi,$P_9<br>";

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
  
  if(empty($_POST['vVopen'])) { $DD1 = 'Ingen'; $D1 = '<b>Kjøp våpen:</b> Ingen'; } else { $D1 = "<b>Kjøp våpen:</b> ".$_POST['vVopen']; $DD1 = $_POST['vVopen']; }
  if(empty($_POST['vPris'])) { $DD2 = 'Ingen'; $D2 = '<b>Pris:</b> Ingen'; } else { $D2 = "<b>Pris:</b> ".$_POST['vPris']; $DD2 = $_POST['vPris']; }
  if(empty($_POST['sum'])) { $D3 = 'sum'; } else { $D3 = $_POST['sum']; }
  if(empty($_POST['vButikken'])) { $DD4 = 'Ingen'; $D4 = '<b>Reparer:</b> Ingen'; } else { $D4 = "<b>Reparer:</b> ".$_POST['vButikken']; $DD4 = $_POST['vButikken']; }
  
  $Fortjeneste = $I['Butikk_inntekt'] - $I['Butikk_utgift'];
  if($Fortjeneste == '0') { $Fortjeneste = '<b>0 kr</b>'; } 
  elseif($Fortjeneste < '0') { $Fortjeneste = "<font color=\"#FF0000\"><b>".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }
  elseif($Fortjeneste > '0') { $Fortjeneste = "<font color=\"#33CC33\"><b>+".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }
  
  echo "
  <div class=\"Div_masta\"><form method=\"post\" id=\"VopenD\">
  <input type=\"hidden\" name=\"vVopen\" id=\"vVopen\" value=\"$DD1\"/>
  <input type=\"hidden\" name=\"vPris\" id=\"vPris\" value=\"$DD2\"/>
  <input type=\"hidden\" name=\"vButikken\" id=\"vButikken\" value=\"$DD4\"/>
  <input type=\"hidden\" name=\"du_valgte\" id=\"du_valgte\" value=\"\"/>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">KJØP VÅPEN</td></tr>";
  echo $KjopVopen;
  echo "
  <tr><td class=\"R_4\">Våpen</td><td class=\"R_4\">Pris</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Hammer\">Hammer</td><td class=\"R_2\">2.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Balltre\">Balltre</td><td class=\"R_2\">5.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Knokejern\">Knokejern</td><td class=\"R_2\">10.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Kniv\">Kniv</td><td class=\"R_2\">20.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Glock 17\">Glock 17</td><td class=\"R_2\">30.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Desert Eagle\">Desert Eagle</td><td class=\"R_2\">70.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Uzi smg\">Uzi smg</td><td class=\"R_2\">90.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Ak-47\">Ak-47</td><td class=\"R_2\">450.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Steyr aug a1\">Steyr aug a1</td><td class=\"R_2\">2.000.000</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisVopen')\">
  <div id=\"Kjøp våpen\">$D1</div>
  <div id=\"VisVopen\" class=\"D_BoksTo\">
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','3 stk','vVopen')\">---> Tre stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','5 stk','vVopen')\">---> Fem stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','10 stk','vVopen')\">---> Ti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','20 stk','vVopen')\">---> Tjue stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','30 stk','vVopen')\">---> Tretti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','40 stk','vVopen')\">---> Førti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','50 stk','vVopen')\">---> Femti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','60 stk','vVopen')\">---> Seksti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp våpen','70 stk','vVopen')\">---> Søtti stk</div></div>
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='KjopVopen';document.getElementById('VopenD').submit()\">KJØP</td></tr>
  </table>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">DINE VÅPEN</td></tr>";
  echo $EndrePris;
  echo "
  <tr><td class=\"R_4\">Våpen</td><td class=\"R_4\">Selges for</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Hammer\">Hammer <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($en['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($en['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Balltre\">Balltre <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($to['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($to['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Knokejern\">Knokejern <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($tre['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($tre['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Kniv\">Kniv <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fire['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fire['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Glock 17\">Glock 17 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fem['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fem['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Desert Eagle\">Desert Eagle <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($seks['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($seks['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Uzi smg\">Uzi smg <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($sju['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($sju['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Ak-47\">Ak-47 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($atte['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($atte['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Steyr aug a1\">Steyr aug a1 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($ni['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($ni['1']),'')."</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('DineVopen')\">
  <div id=\"Pris\">$D2</div>
  <div id=\"DineVopen\" class=\"D_BoksTo\">
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 3.000 kr','vPris')\">---> Pluss 3.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 4.000 kr','vPris')\">---> Pluss 4.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 5.000 kr','vPris')\">---> Pluss 5.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 6.000 kr','vPris')\">---> Pluss 6.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 7.000 kr','vPris')\">---> Pluss 7.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 8.000 kr','vPris')\">---> Pluss 8.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 9.000 kr','vPris')\">---> Pluss 9.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','+ 10.000 kr','vPris')\">---> Pluss 10.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 3.000 kr','vPris')\">---> Minus 3.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 4.000 kr','vPris')\">---> Minus 4.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 5.000 kr','vPris')\">---> Minus 5.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 6.000 kr','vPris')\">---> Minus 6.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 7.000 kr','vPris')\">---> Minus 7.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 8.000 kr','vPris')\">---> Minus 8.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 9.000 kr','vPris')\">---> Minus 9.000 kr</div>
  <div class=\"D_Over\" onclick=\"VisValg('Pris','- 10.000 kr','vPris')\">---> Minus 10.000 kr</div>
  </div>
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='EndrePris';document.getElementById('VopenD').submit()\">ENDRE</td></tr>
  </table>
  </div>
  <div class=\"Div_masta\">
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"3\">ØKONOMI</td></tr>";
  echo $Konto;
  echo "
  <tr><td class=\"R_1\" colspan=\"3\">Kontobalanse: <b>".VerdiSum($I['Butikk_Konto'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Våpenkjøp (ut): <b>".VerdiSum($I['Butikk_utgift'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Våpensalg (inn): <b>".VerdiSum($I['Butikk_inntekt'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Fortjeneste: ".$Fortjeneste."</td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Antall salg: <b>".VerdiSum($I['Butikk_salg'],'stk')."</b></td></tr>
  <tr><td class=\"R_1\"><input class=\"textbox2\" type=\"text\" name=\"sum\" value=\"$D3\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='sum')this.value='';\" onblur=\"if(this.value=='')this.value='sum';\"></td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='SettInn';document.getElementById('VopenD').submit()\">SETT INN</td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='TaUt';document.getElementById('VopenD').submit()\">TA UT</td></tr>
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
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Reparer';document.getElementById('VopenD').submit()\">UTFØR</td></tr>
  </table>
  </form></div>
  ";
  


  }
  ?>
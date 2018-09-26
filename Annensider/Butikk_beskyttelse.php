  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else { 
  
  $Butikken = strtoupper($I['Butikk_Type']);
  $Varer = explode('<br>', $I['Butikk_varer']);
  $Hette = explode(',', $Varer['0']);
  $Hund = explode(',', $Varer['1']);
  $Vest = explode(',', $Varer['2']);
  $Livvakt = explode(',', $Varer['3']);
  $Bil = explode(',', $Varer['4']);
  
  $KjopBesk = ""; $EndrePris = ""; $Konto = ""; $Rep = "";
  
  if($_POST['du_valgte'] == 'KjopBesk') { 
  $Antall = Bare_Siffer(Mysql_Klar($_POST['vBesk']));
  $box = $_POST['box1']; $box_count = count($box);
  if($Antall == '3' || $Antall == '5' || $Antall == '10' || $Antall == '20' || $Antall == '30' || $Antall == '40' || $Antall == '50' || $Antall == '60' || $Antall == '70') { 
  if($box_count > '5') { $KjopBesk = PrintTeksten('Det er ikke flere en fem forsjellige beskyttelser.','2','Feilet','2'); } else { 
  $Pris = '0'; 
  $BeskEn = Bare_Siffer($Hette['0']); 
  $BeskTo = Bare_Siffer($Hund['0']); 
  $BeskTre = Bare_Siffer($Vest['0']); 
  $BeskFire = Bare_Siffer($Livvakt['0']); 
  $BeskFem = Bare_Siffer($Bil['0']); 
  $P_1 = VerdiSum(Bare_Siffer($Hette['1']),'kr'); 
  $P_2 = VerdiSum(Bare_Siffer($Hund['1']),'kr'); 
  $P_3 = VerdiSum(Bare_Siffer($Vest['1']),'kr'); 
  $P_4 = VerdiSum(Bare_Siffer($Livvakt['1']),'kr'); 
  $P_5 = VerdiSum(Bare_Siffer($Bil['1']),'kr');
  foreach($box as $var) {
  if($var == 'Finnlandshette') { $Pris = $Pris + ('10000' * $Antall); $BeskEn = $BeskEn + $Antall; }
  elseif($var == 'Hund') { $Pris = $Pris + ('20000' * $Antall); $BeskTo = $BeskTo + $Antall; }
  elseif($var == 'Skuddsikker vest') { $Pris = $Pris + ('50000' * $Antall); $BeskTre = $BeskTre + $Antall; } 
  elseif($var == 'Livvakt') { $Pris = $Pris + ('200000' * $Antall); $BeskFire = $BeskFire + $Antall; }
  elseif($var == 'Skuddsikker bil') { $Pris = $Pris + ('1500000' * $Antall); $BeskFem = $BeskFem + $Antall; }} $Pris = floor($Pris);
  if($Pris > $I['Butikk_Konto']) { $KjopBesk = PrintTeksten('Du har ikke nok penger på kontoen.','2','Feilet','2'); } else {
  $NySum = floor($I['Butikk_Konto'] - $Pris);
  $PrisVis = VerdiSum($Pris,'kr');
  $NyVar = "Hette: $BeskEn,$P_1<br>Hund: $BeskTo,$P_2<br>Vest: $BeskTre,$P_3<br>Livvakt: $BeskFire,$P_4<br>Bil: $BeskFem,$P_5<br>";

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_Konto='$NySum',Butikk_varer='$NyVar',Butikk_utgift=`Butikk_utgift`+'$Pris' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $KjopBesk = PrintTeksten("Du har handlet beskyttelse for $PrisVis.",'2','Vellykket','2'); }
  }}else { $KjopBesk = PrintTeksten('Du må velge antallet du skal handle.','2','Feilet','2'); }
  }
  elseif($_POST['du_valgte'] == 'EndrePris') { 
  $Endre = Mysql_Klar($_POST['vPris']);
  $box = $_POST['box2']; $box_count = count($box);
  if($Endre == '+ 3.000 kr' || $Endre == '+ 4.000 kr' || $Endre == '+ 5.000 kr' || $Endre == '+ 6.000 kr' || $Endre == '+ 7.000 kr' || $Endre == '+ 8.000 kr' || $Endre == '+ 9.000 kr' || $Endre == '+ 10.000 kr' || $Endre == '- 3.000 kr' || $Endre == '- 4.000 kr' || $Endre == '- 5.000 kr' || $Endre == '- 6.000 kr' || $Endre == '- 7.000 kr' || $Endre == '- 8.000 kr' || $Endre == '- 9.000 kr' || $Endre == '- 10.000 kr') {
  $BeskEn = Bare_Siffer($Hette['0']); 
  $BeskTo = Bare_Siffer($Hund['0']); 
  $BeskTre = Bare_Siffer($Vest['0']); 
  $BeskFire = Bare_Siffer($Livvakt['0']); 
  $BeskFem = Bare_Siffer($Bil['0']); 
  $P_1 = Bare_Siffer($Hette['1']); 
  $P_2 = Bare_Siffer($Hund['1']); 
  $P_3 = Bare_Siffer($Vest['1']); 
  $P_4 = Bare_Siffer($Livvakt['1']); 
  $P_5 = Bare_Siffer($Bil['1']);
  $PlussEll = substr($Endre, 0, 1) . '';  
  $Endre = Bare_Siffer($Endre);
  foreach($box as $var) { 
  if($var == 'Finnlandshette') { if($PlussEll == '-') { $P_1 = floor($P_1 - $Endre); if($P_1 < '100') { $P_1 = '100'; }} else { $P_1 = floor($P_1 + $Endre); }}
  elseif($var == 'Hund') {if($PlussEll == '-') { $P_2 = floor($P_2 - $Endre); if($P_2 < '100') { $P_2 = '100'; }} else { $P_2 = floor($P_2 + $Endre); }}
  elseif($var == 'Skuddsikker vest') {if($PlussEll == '-') { $P_3 = floor($P_3 - $Endre); if($P_3 < '100') { $P_3 = '100'; }} else { $P_3 = floor($P_3 + $Endre); }}
  elseif($var == 'Livvakt') {if($PlussEll == '-') { $P_4 = floor($P_4 - $Endre); if($P_4 < '100') { $P_4 = '100'; }} else { $P_4 = floor($P_4 + $Endre); }}
  elseif($var == 'Skuddsikker bil') {if($PlussEll == '-') { $P_5 = floor($P_5 - $Endre); if($P_5 < '100') { $P_5 = '100'; } } else { $P_5 = floor($P_5 + $Endre); }}}
  $NyVar = "Hette: $BeskEn,$P_1<br>Hund: $BeskTo,$P_2<br>Vest: $BeskTre,$P_3<br>Livvakt: $BeskFire,$P_4<br>Bil: $BeskFem,$P_5<br>";

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

  if(empty($_POST['vBesk'])) { $DD1 = 'Ingen'; $D1 = '<b>Kjøp:</b> Ingen'; } else { $D1 = "<b>Kjøp:</b> ".$_POST['vBesk']; $DD1 = $_POST['vBesk']; }
  if(empty($_POST['vPris'])) { $DD2 = 'Ingen'; $D2 = '<b>Pris:</b> Ingen'; } else { $D2 = "<b>Pris:</b> ".$_POST['vPris']; $DD2 = $_POST['vPris']; }
  if(empty($_POST['sum'])) { $D3 = 'sum'; } else { $D3 = $_POST['sum']; }
  if(empty($_POST['vButikken'])) { $DD4 = 'Ingen'; $D4 = '<b>Reparer:</b> Ingen'; } else { $D4 = "<b>Reparer:</b> ".$_POST['vButikken']; $DD4 = $_POST['vButikken']; }
  
  $Fortjeneste = $I['Butikk_inntekt'] - $I['Butikk_utgift'];
  if($Fortjeneste == '0') { $Fortjeneste = '<b>0 kr</b>'; } 
  elseif($Fortjeneste < '0') { $Fortjeneste = "<font color=\"#FF0000\"><b>".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }
  elseif($Fortjeneste > '0') { $Fortjeneste = "<font color=\"#33CC33\"><b>+".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }
  
  echo "
  <div class=\"Div_masta\"><form method=\"post\" id=\"BeskD\">
  <input type=\"hidden\" name=\"vBesk\" id=\"vBesk\" value=\"$DD1\"/>
  <input type=\"hidden\" name=\"vPris\" id=\"vPris\" value=\"$DD2\"/>
  <input type=\"hidden\" name=\"vButikken\" id=\"vButikken\" value=\"$DD4\"/>
  <input type=\"hidden\" name=\"du_valgte\" id=\"du_valgte\" value=\"\"/>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">KJØP BESKYTTELSE</td></tr>";
  echo $KjopBesk;
  echo "
  <tr><td class=\"R_4\">Beskyttelse</td><td class=\"R_4\">Pris</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Finnlandshette\">Finnlandshette</td><td class=\"R_2\">10.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Hund\">Hund</td><td class=\"R_2\">20.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Skuddsikker vest\">Skuddsikker vest</td><td class=\"R_2\">50.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Livvakt\">Livvakt</td><td class=\"R_2\">200.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Skuddsikker bil\">Skuddsikker bil</td><td class=\"R_2\">1.500.000</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisBesk')\">
  <div id=\"Kjøp\">$D1</div>
  <div id=\"VisBesk\" class=\"D_BoksTo\">
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','3 stk','vBesk')\">---> Tre stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','5 stk','vBesk')\">---> Fem stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','10 stk','vBesk')\">---> Ti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','20 stk','vBesk')\">---> Tjue stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','30 stk','vBesk')\">---> Tretti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','40 stk','vBesk')\">---> Førti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','50 stk','vBesk')\">---> Femti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','60 stk','vBesk')\">---> Seksti stk</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp','70 stk','vBesk')\">---> Søtti stk</div></div>
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='KjopBesk';document.getElementById('BeskD').submit()\">KJØP</td></tr>
  </table>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">DINE BESKYTTELSER</td></tr>";
  echo $EndrePris;
  echo "
  <tr><td class=\"R_4\">Beskyttelse</td><td class=\"R_4\">Selges for</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Finnlandshette\">Finnlandshette <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Hette['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Hette['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Hund\">Hund <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Hund['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Hund['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Skuddsikker vest\">Skuddsikker vest <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Vest['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Vest['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Livvakt\">Livvakt <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Livvakt['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Livvakt['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Skuddsikker bil\">Skuddsikker bil <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Bil['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Bil['1']),'')."</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('DineBesk')\">
  <div id=\"Pris\">$D2</div>
  <div id=\"DineBesk\" class=\"D_BoksTo\">
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
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='EndrePris';document.getElementById('BeskD').submit()\">ENDRE</td></tr>
  </table>
  </div>
  <div class=\"Div_masta\">
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"3\">ØKONOMI</td></tr>";
  echo $Konto;
  echo "
  <tr><td class=\"R_1\" colspan=\"3\">Kontobalanse: <b>".VerdiSum($I['Butikk_Konto'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Kjøp (ut): <b>".VerdiSum($I['Butikk_utgift'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Salg (inn): <b>".VerdiSum($I['Butikk_inntekt'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Fortjeneste: ".$Fortjeneste."</td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Antall salg: <b>".VerdiSum($I['Butikk_salg'],'stk')."</b></td></tr>
  <tr><td class=\"R_1\"><input class=\"textbox2\" type=\"text\" name=\"sum\" value=\"$D3\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='sum')this.value='';\" onblur=\"if(this.value=='')this.value='sum';\"></td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='SettInn';document.getElementById('BeskD').submit()\">SETT INN</td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='TaUt';document.getElementById('BeskD').submit()\">TA UT</td></tr>
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
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Reparer';document.getElementById('BeskD').submit()\">UTFØR</td></tr>
  </table>
  </form></div>
  ";
  


  }
  ?>
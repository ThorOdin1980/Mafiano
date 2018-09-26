  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else { 
  
  $Butikken = strtoupper($I['Butikk_Type']);
  $Varer = explode('<br>', $I['Butikk_varer']);
  $Aerostar = explode(',', $Varer['0']);
  $Mitsubishi = explode(',', $Varer['1']);
  $CessnaSkyhawk = explode(',', $Varer['2']);
  $Cessna = explode(',', $Varer['3']);
  $Citation = explode(',', $Varer['4']);
  
  $KjopFly = ""; $EndrePris = ""; $Konto = ""; $Rep = "";
  
  if($_POST['du_valgte'] == 'KjopFly') { 
  $AntallFly = Bare_Siffer(Mysql_Klar($_POST['vFly']));
  $box = $_POST['box1']; $box_count = count($box);
  if($AntallFly == '2' || $AntallFly == '4' || $AntallFly == '6' || $AntallFly == '8' || $AntallFly == '10' || $AntallFly == '20' || $AntallFly == '30') { 
  if($box_count > '5') { $KjopFly = PrintTeksten('Det er ikke flere en fem forsjellige fly.','2','Feilet','2'); } else { 
  $Pris = '0'; $FlyEn = Bare_Siffer($Aerostar['0']); $FlyTo = Bare_Siffer($Mitsubishi['0']); $FlyTre = Bare_Siffer($CessnaSkyhawk['0']); $FlyFire = Bare_Siffer($Cessna['0']); $FlyFem = Bare_Siffer($Citation['0']); 
  $P_1 = VerdiSum(Bare_Siffer($Aerostar['1']),'kr'); $P_2 = VerdiSum(Bare_Siffer($Mitsubishi['1']),'kr'); $P_3 = VerdiSum(Bare_Siffer($CessnaSkyhawk['1']),'kr'); $P_4 = VerdiSum(Bare_Siffer($Cessna['1']),'kr'); $P_5 = VerdiSum(Bare_Siffer($Citation['1']),'kr');
  foreach($box as $var) {if($var == 'Aerostar 601P') { $Pris = $Pris + ('3000000' * $AntallFly); $FlyEn = $FlyEn + $AntallFly; }elseif($var == 'Mitsubishi MU-2K') { $Pris = $Pris + ('4300000' * $AntallFly); $FlyTo = $FlyTo + $AntallFly; }elseif($var == 'Cessna Skyhawk') { $Pris = $Pris + ('6600000' * $AntallFly); $FlyTre = $FlyTre + $AntallFly; }elseif($var == 'Cessna 208') { $Pris = $Pris + ('14500000' * $AntallFly); $FlyFire = $FlyFire + $AntallFly; }elseif($var == 'Citation V Ultra') { $Pris = $Pris + ('25000000' * $AntallFly); $FlyFem = $FlyFem + $AntallFly; }} $Pris = floor($Pris);
  if($Pris > $I['Butikk_Konto']) { $KjopFly = PrintTeksten('Du har ikke nok penger på fly kontoen.','2','Feilet','2'); } else {
  $NySum = floor($I['Butikk_Konto'] - $Pris);
  $PrisVis = VerdiSum($Pris,'kr');
  $NyVar = "Aerostar: $FlyEn,$P_1<br>Mitsubishi: $FlyTo,$P_2<br>Cessna Skyhawk: $FlyTre,$P_3<br>Cessna: $FlyFire,$P_4<br>Citation V Ultra: $FlyFem,$P_5<br>";

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE Butikker SET Butikk_Konto='$NySum',Butikk_varer='$NyVar',Butikk_utgift=`Butikk_utgift`+'$Pris' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'");
  $KjopFly = PrintTeksten("Du har handlet fly for $PrisVis.",'2','Vellykket','2'); }
  }} else { $KjopFly = PrintTeksten('Du må velge antall fly du skal kjøpe.','2','Feilet','2'); }
  }elseif($_POST['du_valgte'] == 'EndrePris') { 
  $FlyEndre = Mysql_Klar($_POST['vPris']);
  $box = $_POST['box2']; $box_count = count($box);
  if($FlyEndre == '+ 200.000 kr' || $FlyEndre == '+ 300.000 kr' || $FlyEndre == '+ 400.000 kr' || $FlyEndre == '+ 500.000 kr' || $FlyEndre == '+ 600.000 kr' || $FlyEndre == '+ 700.000 kr' || $FlyEndre == '+ 800.000 kr' || $FlyEndre == '+ 900.000 kr' || $FlyEndre == '- 200.000 kr' || $FlyEndre == '- 300.000 kr' || $FlyEndre == '- 400.000 kr' || $FlyEndre == '- 500.000 kr' || $FlyEndre == '- 600.000 kr' || $FlyEndre == '- 700.000 kr' || $FlyEndre == '- 800.000 kr' || $FlyEndre == '- 900.000 kr') {
  $FlyEn = Bare_Siffer($Aerostar['0']); $FlyTo = Bare_Siffer($Mitsubishi['0']); $FlyTre = Bare_Siffer($CessnaSkyhawk['0']); $FlyFire = Bare_Siffer($Cessna['0']); $FlyFem = Bare_Siffer($Citation['0']); 
  $P_1 = Bare_Siffer($Aerostar['1']); $P_2 = Bare_Siffer($Mitsubishi['1']); $P_3 = Bare_Siffer($CessnaSkyhawk['1']); $P_4 = Bare_Siffer($Cessna['1']); $P_5 = Bare_Siffer($Citation['1']);
  $PlussEll = substr($FlyEndre, 0, 1) . '';  
  $FlyEndre = Bare_Siffer($FlyEndre);
  foreach($box as $var) { 
  if($var == 'Aerostar 601P') { if($PlussEll == '-') { $P_1 = floor($P_1 - $FlyEndre); if($P_1 < '100') { $P_1 = '100'; }} else { $P_1 = floor($P_1 + $FlyEndre); }}
  elseif($var == 'Mitsubishi MU-2K') {if($PlussEll == '-') { $P_2 = floor($P_2 - $FlyEndre); if($P_2 < '100') { $P_2 = '100'; }} else { $P_2 = floor($P_2 + $FlyEndre); }}
  elseif($var == 'Cessna Skyhawk') {if($PlussEll == '-') { $P_3 = floor($P_3 - $FlyEndre); if($P_3 < '100') { $P_3 = '100'; }} else { $P_3 = floor($P_3 + $FlyEndre); }}
  elseif($var == 'Cessna 208') {if($PlussEll == '-') { $P_4 = floor($P_4 - $FlyEndre); if($P_4 < '100') { $P_4 = '100'; }} else { $P_4 = floor($P_4 + $FlyEndre); }}
  elseif($var == 'Citation V Ultra') {if($PlussEll == '-') { $P_5 = floor($P_5 - $FlyEndre); if($P_5 < '100') { $P_5 = '100'; } } else { $P_5 = floor($P_5 + $FlyEndre); }}}
  $NyVar = "Aerostar: $FlyEn,$P_1<br>Mitsubishi: $FlyTo,$P_2<br>Cessna Skyhawk: $FlyTre,$P_3<br>Cessna: $FlyFire,$P_4<br>Citation V Ultra: $FlyFem,$P_5<br>";

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
  $Konto = PrintTeksten("Du har tatt ut $SumUt.",'2','Vellykket','2');
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
  
  $Fortjeneste = $I['Butikk_inntekt'] - $I['Butikk_utgift'];
  if($Fortjeneste == '0') { $Fortjeneste = '<b>0 kr</b>'; } 
  elseif($Fortjeneste < '0') { $Fortjeneste = "<font color=\"#FF0000\"><b>".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }
  elseif($Fortjeneste > '0') { $Fortjeneste = "<font color=\"#33CC33\"><b>+".VerdiSum(floor($Fortjeneste),'kr')."</b></font>"; }

   
  if(empty($_POST['vFly'])) { $DD1 = 'Ingen'; $D1 = '<b>Kjøp fly:</b> Ingen'; } else { $D1 = "<b>Kjøp fly:</b> ".$_POST['vFly']; $DD1 = $_POST['vFly']; }
  if(empty($_POST['vPris'])) { $DD2 = 'Ingen'; $D2 = '<b>Pris:</b> Ingen'; } else { $D2 = "<b>Pris:</b> ".$_POST['vPris']; $DD2 = $_POST['vPris']; }
  if(empty($_POST['sum'])) { $D3 = 'sum'; } else { $D3 = $_POST['sum']; }
  if(empty($_POST['vButikken'])) { $DD4 = 'Ingen'; $D4 = '<b>Reparer:</b> Ingen'; } else { $D4 = "<b>Reparer:</b> ".$_POST['vButikken']; $DD4 = $_POST['vButikken']; }

  echo "
  <div class=\"Div_masta\"><form method=\"post\" id=\"FlyD\">
  <input type=\"hidden\" name=\"vFly\" id=\"vFly\" value=\"$DD1\"/>
  <input type=\"hidden\" name=\"vPris\" id=\"vPris\" value=\"$DD2\"/>
  <input type=\"hidden\" name=\"vButikken\" id=\"vButikken\" value=\"$DD4\"/>
  <input type=\"hidden\" name=\"du_valgte\" id=\"du_valgte\" value=\"\"/>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">KJØP FLY</td></tr>";
  echo $KjopFly;
  echo "
  <tr><td class=\"R_4\">Fly</td><td class=\"R_4\">Pris</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Aerostar 601P\">Aerostar 601P</td><td class=\"R_2\">3.000.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Mitsubishi MU-2K\">Mitsubishi MU-2K</td><td class=\"R_2\">4.300.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Cessna Skyhawk\">Cessna Skyhawk</td><td class=\"R_2\">6.600.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Cessna 208\">Cessna 208</td><td class=\"R_2\">14.500.000</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Citation V Ultra\">Citation V Ultra</td><td class=\"R_2\">25.000.000</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisFly')\">
  <div id=\"Kjøp fly\">$D1</div>
  <div id=\"VisFly\" class=\"D_BoksTo\">
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp fly','2 stk','vFly')\">---> To fly</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp fly','4 stk','vFly')\">---> Fire fly</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp fly','6 stk','vFly')\">---> Seks fly</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp fly','8 stk','vFly')\">---> Åtte fly</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp fly','10 stk','vFly')\">---> Ti fly</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp fly','20 stk','vFly')\">---> Tjue fly</div>
  <div class=\"D_Over\" onclick=\"VisValg('Kjøp fly','30 stk','vFly')\">---> Tretti fly</div></div>
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='KjopFly';document.getElementById('FlyD').submit()\">KJØP</td></tr>
  </table>
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"2\">DINE FLY</td></tr>";
  echo $EndrePris;
  echo "
  <tr><td class=\"R_4\">Fly</td><td class=\"R_4\">Selges for</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Aerostar 601P\">Aerostar 601P <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Aerostar['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Aerostar['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Mitsubishi MU-2K\">Mitsubishi MU-2K <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Mitsubishi['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Mitsubishi['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Cessna Skyhawk\">Cessna Skyhawk <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($CessnaSkyhawk['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($CessnaSkyhawk['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Cessna 208\">Cessna 208 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Cessna['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Cessna['1']),'')."</td></tr>
  <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Citation V Ultra\">Citation V Ultra <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($Citation['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($Citation['1']),'')."</td></tr>
  <tr><td class=\"R_1\" onclick=\"VisAlternativer('DineFly')\">
  <div id=\"Pris\">$D2</div>
  <div id=\"DineFly\" class=\"D_BoksTo\">
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
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='EndrePris';document.getElementById('FlyD').submit()\">ENDRE</td></tr>
  </table>
  </div>
  <div class=\"Div_masta\">
  <table class=\"Rute_2\" id=\"Rute_2\">
  <tr><td class=\"R_0\" colspan=\"3\">ØKONOMI</td></tr>";
  echo $Konto;
  echo "
  <tr><td class=\"R_1\" colspan=\"3\">Kontobalanse: <b>".VerdiSum($I['Butikk_Konto'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Flykjøp (ut): <b>".VerdiSum($I['Butikk_utgift'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Flysalg (inn): <b>".VerdiSum($I['Butikk_inntekt'],'kr')."</b></td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Fortjeneste: ".$Fortjeneste."</td></tr>
  <tr><td class=\"R_1\" colspan=\"3\">Antall salg: <b>".VerdiSum($I['Butikk_salg'],'stk')."</b></td></tr>
  <tr><td class=\"R_1\"><input class=\"textbox2\" type=\"text\" name=\"sum\" value=\"$D3\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='sum')this.value='';\" onblur=\"if(this.value=='')this.value='sum';\"></td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='SettInn';document.getElementById('FlyD').submit()\">SETT INN</td>
  <td class=\"R_7\" style=\"width:50px;\" onclick=\"document.getElementById('du_valgte').value='TaUt';document.getElementById('FlyD').submit()\">TA UT</td></tr>
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
  </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Reparer';document.getElementById('FlyD').submit()\">UTFØR</td></tr>
  </table>
  </form></div>
  ";
  


  }
  ?>
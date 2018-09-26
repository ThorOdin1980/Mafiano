  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style>
  .LinjeTo { padding:3px; border-bottom-style: solid; border-bottom-width: 1px; border-color:#000000; font-size:11px; }
  </style>
  <?
  if(SjekkPlassering($brukernavn) == 'klar') { 
  if (date('H') == '00') { include("mn_rentesjekk.php"); }

  function igaar($Dato) { $Dag = Bare_Siffer($Dato); $Monde = Bare_Bokstaver($Dato); $Dag = $Dag - '1'; if($Dag >= '1') { if($Dag < '10') { $Dag = '0'.$Dag; } $Data = "$Dag. $Monde"; } else { if($Monde == 'Jan') { $TidMonde = "Dec"; $TidDag = "31"; }elseif($Monde == 'Feb') { $TidMonde = "Jan"; $TidDag = "31"; }elseif($Monde == 'Mar') { $TidMonde = "Feb"; $TidDag = "28"; }elseif($Monde == 'Apr') { $TidMonde = "Mar"; $TidDag = "31"; }elseif($Monde == 'Mai') { $TidMonde = "Apr"; $TidDag = "30"; }elseif($Monde == 'Jun') { $TidMonde = "Mai"; $TidDag = "31"; }elseif($Monde == 'Jul') { $TidMonde = "Jun"; $TidDag = "30"; }elseif($Monde == 'Aug') { $TidMonde = "Jul"; $TidDag = "31"; }elseif($Monde == 'Sep') { $TidMonde = "Aug"; $TidDag = "31"; }elseif($Monde == 'Oct') { $TidMonde = "Sep"; $TidDag = "30"; }elseif($Monde == 'Nov') { $TidMonde = "Oct"; $TidDag = "31"; }elseif($Monde == 'Dec') { $TidMonde = "Nov"; $TidDag = "30"; } if($Dag < '10') { $TidDag = '0'.$TidDag; } $Data = "$TidDag. $TidMonde"; } return $Data; }

  // Html
  echo "<div class=\"Div_masta\"><form method=\"post\" id=\"bank1\"><div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Banken</span></div><div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/bankbilde-2.jpg\"></div>";

  // Post
  if(isset($_POST['action']) && $_POST['action'] == "sett_inn") { 
  $sum = Bare_Siffer(Mysql_Klar($_POST['sett_inn']));
  $NyPengUte = floor($penger - $sum); 
  $NyPengBank = floor($bank + $sum); 
  $SumVis = VerdiSum($sum,'kr');
  if(empty($sum)) { echo PrintTeksten('Beløpet mangler.','1','Feilet'); } 
  elseif($sum > $penger) { echo PrintTeksten('Du har ikke så mye penger.','1','Feilet'); }
  elseif($sum > '10000000000') { echo PrintTeksten('Summen er for høy.','1','Feilet'); }
  elseif(!is_numeric($sum)) { echo PrintTeksten('Kun siffer i feltet.','1','Feilet'); } 
  elseif($NyPengUte < '0') { echo PrintTeksten('Vennligst prøv på nytt.','1','Feilet'); } else { 
  mysql_query("UPDATE brukere SET bank='$NyPengBank',penger='$NyPengUte',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
  echo PrintTeksten("Du har satt inn $SumVis.","1","Vellykket");
  }}
  elseif(isset($_POST['action']) && $_POST['action'] == "ta_ut") { 
  $sum = Bare_Siffer(Mysql_Klar($_POST['sett_inn']));
  $NyPengUte = floor($penger + $sum); 
  $NyPengBank = floor($bank - $sum); 
  $SumVis = VerdiSum($sum,'kr');
  if(empty($sum)) { echo PrintTeksten('Beløpet mangler.','1','Feilet'); }
  elseif($sum > $bank) { echo PrintTeksten('Du har ikke så mye penger i banken.','1','Feilet'); }
  elseif($sum > '10000000000') { echo PrintTeksten('Summen er for høy.','1','Feilet'); }
  elseif(!is_numeric($sum)) { echo PrintTeksten('Kun siffer i feltet.','1','Feilet'); }
  elseif($NyPengBank < '0') { echo PrintTeksten('Vennligst prøv på nytt.','1','Feilet'); } else { 
  mysql_query("UPDATE brukere SET bank='$NyPengBank',penger='$NyPengUte',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
  echo PrintTeksten("Du har tatt ut $SumVis.","1","Vellykket");
  }}
  elseif(isset($_POST['send_til']) || isset($_POST['send_sum'])) { 
  $mottaker = Mysql_Klar($_POST['send_til']);
  $sum = Bare_Siffer($_POST['send_sum']);
  if($type == 'A' || $type == 'm') { echo PrintTeksten('Banktransaksjoner er sperret for Crew medlemmer.','1','Feilet'); } 
  elseif(empty($mottaker)) { echo PrintTeksten("Brukernavn mangler.","1","Feilet"); }
  elseif(empty($sum)) { echo PrintTeksten("Beløpet mangler.","1","Feilet"); }
  elseif($sum > $bank) { echo PrintTeksten('Beløpet overstiger saldoen din.','1','Feilet'); }
  elseif($sum > '10000000000') { echo PrintTeksten('Summen er for høy.','1','Feilet'); }
  elseif($sum < '1000') { echo PrintTeksten('Summen er for lav, minimum 1000 kr.','1','Feilet'); }
  elseif(!is_numeric($sum)) { echo PrintTeksten('Kun siffer i feltet.','1','Feilet'); } else { 
  $Hent = mysql_query("SELECT * FROM brukere WHERE brukernavn='$mottaker'");
  $H = mysql_fetch_assoc($Hent); 
  $Motaker = $H['brukernavn'];
  $MotakerLenke = BrukerURL($Motaker); 
  if(mysql_num_rows($Hent) == 0) { echo PrintTeksten("$mottaker eksisterer ikke.","1","Feilet"); } 
  elseif($brukernavn == $Motaker) { echo PrintTeksten('Overføring til egen bruker er ikke mulig.','1','Feilet'); }
  elseif($H['liv'] < '1') { echo PrintTeksten("$MotakerLenke er død, overføring avlyst.","1","Feilet"); } else { 
  $TiPros = $sum / '100' * '10';
  $NySum = $sum - $TiPros;
  $Mot_Sum = floor($H['penger'] + $NySum);
  $Din_Sum = floor($bank - $sum);
  if($Din_Sum < '0') { PrintTeksten('Vennligst prøv igjen.','1','Feilet'); } else { 
  mysql_query("INSERT INTO `bank_overforinger` (senders_brukernavn,motakers_brukernavn,sum,dato,timestampen) VALUES ('$brukernavn','$Motaker','$sum','$AnnenDato','$Timestamp')");
  mysql_query("UPDATE brukere SET penger='$Mot_Sum' WHERE brukernavn='$Motaker'");
  mysql_query("UPDATE brukere SET bank='$Din_Sum',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $SumVis = VerdiSum($sum,'kr');
  echo PrintTeksten("$SumVis er nå overført til $MotakerLenke.","1","Vellykket");
  }}}}
        
  if(empty($_POST['sett_inn'])) { $summen_boks_1 = ''; } else { $summen_boks_1 = mysql_real_escape_string($_POST['sett_inn']); }
  if(empty($_POST['send_sum'])) { $summen_boks_2 = ''; } else { $summen_boks_2 = mysql_real_escape_string($_POST['send_sum']); }
  if(empty($_POST['send_til'])) { $summen_boks_3 = ''; } else { $summen_boks_3 = mysql_real_escape_string($_POST['send_til']); }
  
  echo "
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bankbalanse</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".number_format($bank, 0, ",", ".")."</span></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Beløp</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"sett_inn\" value=\"$summen_boks_1\" maxlength=\"10\" onKeyPress=\"return numbersonly(this, event)\"><input type=\"hidden\" name=\"action\" id=\"du_valgte\" /></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='sett_inn';document.getElementById('bank1').submit()\"><p class=\"pan_str_2\">SETT INN</p></div>
  <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='ta_ut';document.getElementById('bank1').submit()\"><p class=\"pan_str_2\">TA UT</p></div>
  </form><form method=\"post\" id=\"Send\">
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"send_til\" maxlength=\"30\" value=\"$summen_boks_3\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Beløp</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"send_sum\" maxlength=\"10\" value=\"$summen_boks_2\" onKeyPress=\"return numbersonly(this, event)\"></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Send').submit()\"><p class=\"pan_str_2\">OVERFØR</p></div>
  </form>
  <div class=\"Div_MELDING\"><span style=\"width: 480px; float: left; margin-left:5px; color:#FFFFFF; font-size:13px; filter:alpha(opacity=60); opacity:0.6;\">
  <table style=\"font-family: Arial; font-size: 12px; width:480px;\">
  <tr style=\"height:20px;\"><td class=\"R_4\">Til bruker</td><td class=\"R_4\">Dato</td><td class=\"R_4\">Sum sendt</td></tr>
  ";


  $Sen = mysql_query("SELECT * FROM bank_overforinger WHERE senders_brukernavn='$brukernavn' ORDER BY `timestampen` DESC LIMIT 0, 30");
  if(mysql_num_rows($Sen) == '0') {  echo "<tr class=\"Vanlig_1\"><td class=\"LinjeTo Plassering\" colspan=\"3\">Finner ingen loggføringer hos din bruker</td></tr>"; } else {
  while($i = mysql_fetch_assoc($Sen)) { 
  $Dagen = substr($i['dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "I dag -"; } elseif($Dagen == $Dag2) { $Sjekk = "I går -"; } elseif($Dagen == $Dag3) { $Sjekk = "I forgårs -"; } else { $Sjekk = ''; }
  echo "<tr class=\"Vanlig_1\"><td class=\"LinjeTo Plassering\">".BrukerURL($i['motakers_brukernavn'])."</td><td class=\"LinjeTo Plassering\">$Sjekk ".$i['dato']."</td><td class=\"LinjeTo Plassering\">".VerdiSum($i['sum'],'kr')."</td></tr>";
  }}
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Fra bruker</td><td class=\"R_4\">Dato</td><td class=\"R_4\">Sum mottatt</td></tr>";


  $Sene = mysql_query("SELECT * FROM bank_overforinger WHERE motakers_brukernavn='$brukernavn' ORDER BY `timestampen` DESC LIMIT 0, 30");
  if(mysql_num_rows($Sene) == '0') { echo "<tr class=\"Vanlig_1\"><td class=\"LinjeTo Plassering\" colspan=\"3\">Finner ingen loggføringer hos din bruker</td></tr>"; } else {
  while($i = mysql_fetch_assoc($Sene)) { 
  $Dagen = substr($i['dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "I dag -"; } elseif($Dagen == $Dag2) { $Sjekk = "I går -"; } elseif($Dagen == $Dag3) { $Sjekk = "I forgårs -"; } else { $Sjekk = ''; }
  echo "<tr class=\"Vanlig_1\"><td class=\"LinjeTo Plassering\">".BrukerURL($i['senders_brukernavn'])."</td><td class=\"LinjeTo Plassering\">$Sjekk ".$i['dato']."</td><td class=\"LinjeTo Plassering\">".VerdiSum($i['sum'],'kr')."</td></tr>";
  }}
  
  echo "
  </table>
  
  </span>
  </div>
  
  </div>";
     
  }
  ?>


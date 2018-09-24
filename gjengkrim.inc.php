  <style>
  .Send img { float:left; margin:2px 0 0 7px; }
  .Send img:first-child { margin-top:7px; }
  
  .Bomb { float:left; width:464px; }
  .Bomb p:first-child { float:left; }
  .Bomb p:first-child:hover { font-weight:bold; cursor:pointer; }
  .Bomb p:last-child{ float:right; font-weight:bold; }

  </style>
  <?php
  if(basename($_SERVER['PHP_SELF']) == "gjengkrim.inc.php") { header("Location: index.php"); exit; } else {
  
  // Gjeng oppdrag utfort
  if($i['AngrepsPros'] >= '100') { $Antall = floor($i['AngrepsPros'] / '100'); $Minus = $Antall * 100; $Ang = floor($i['AngrepsPros'] - $Minus); if($Antall == '1') { $Kla = 'klar'; } else { $Kla = 'klare'; } $Teksti = VerdiSum($Antall,$Kla); } else { $Ang = floor($i['AngrepsPros']); $Teksti = "Ingen angrep klare"; $Antall = '0'; }
  $TotalPros = mysql_fetch_object(mysql_query("SELECT SUM(`OppdragUtfort`) AS totalt FROM Gjeng_medlemmer WHERE gjeng_id='$G_Id'"));
  $TotalPros = $TotalPros->totalt;
  $DinPros = floor($i['OppdragUtfort'] / $TotalPros * '100');
  $DenneGjeng = Krypt_Tall($G_Id);
  $SjekkInk = "MLSG8SkkkkA";
 
  // Til krig
  function Finner($DinBy,$HansBy,$Bruker) { global $Timestamp; if($DinBy != $HansBy) { $Svar = "Feil by"; } else {  $Kidnappet = mysql_query("SELECT * FROM kidnapping WHERE offer='$Bruker'"); if(mysql_num_rows($Kidnappet) >= '1') { $Svar = "Kidnappet"; } else { $Sykehus = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$Bruker' AND timestampen_ute > $Timestamp"); if(mysql_num_rows($Sykehus) >= '1') { $Svar = "Sykehus"; } else {  $Bunker = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$Bruker' AND godtatt_elle LIKE '1' AND timestamp_ute > $Timestamp"); if(mysql_num_rows($Bunker) >= '1') { $Svar = "Bunker"; } else {  $Fengsel = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$Bruker' AND timestamp_over > $Timestamp"); if(mysql_num_rows($Fengsel) >= '1') { $Svar = "Fengsel"; } else { $Svar = 'Fant'; }}}}} return $Svar; }
  function DinStyrke($Rank,$Utfort,$Respekt,$Drap,$Liv) { $Respekt = floor(($Respekt + '100000') / '100000'); $Rank = floor(($Rank / '100') + '1'); $Drap = floor($Drap + '2'); $Utfort = floor($Utfort + '400'); $FakEn = floor($Utfort + ($Utfort / '100' * $Rank)); $FakEn = floor($FakEn + ($FakEn / '100' * $Drap)); $FakEn = floor($FakEn + ($FakEn / '100' * $Respekt)); $Skade = floor(('100' - $Liv) / '2'); if($Skade >= '1') { $FakEn = floor($FakEn - ($FakEn / '100' * $Skade)); } else { $FakEn = $FakEn; } return $FakEn; }
  function RankprosTo($RankNiva,$Rankpros) { if($RankNiva > '1') { $M = $RankNiva * '100'; $M = $M - '100'; } else { $M = '0'; } $T = $Rankpros - $M; return $T; }
  function GjengStyrke($GjengID) { 

  $Gjeng = mysql_fetch_assoc(mysql_query("SELECT * FROM Gjenger WHERE id='$GjengID'")); $Gjengnavn = $Gjeng['Gjeng_Navn'];
  $MedInfo = mysql_fetch_object(mysql_query("SELECT SUM(`Angrep`) AS EAngrep,SUM(`Forsvar`) AS EForsvar,COUNT(`id`) AS EAntall FROM Gjeng_medlemmer WHERE gjeng_id='$GjengID'"));
  $Medlemmer = mysql_query("SELECT * FROM brukere WHERE gjeng='$Gjengnavn'");

  // Hovedfaktor totale styrken til alle medlemmer i gjengen
  $Hovedfaktor = '10'; while($i = mysql_fetch_assoc($Medlemmer)) { $Hovedfaktor = $Hovedfaktor + DinStyrke($i['rankpros'],($i['brekk_gjort'] + $i['biler_gjort'] + $i['plan_ran'] + $i['bryt_ut_antall'] + $i['kid_antall'] + $i['presse_antall'] + $i['herverk_gjort']),$i['respekt'],$i['drap'],$i['liv']); } $Hovedfaktor = floor($Hovedfaktor);

  // Prosentfaktor en: angrep,forsvar,gjengmedlemmer
  $FaktorEn = floor(($MedInfo->EAngrep + $MedInfo->EForsvar + '2') * $MedInfo->EAntall);
  
  // Prosentfaktor to: antall drap
  $FaktorTo = floor($Gjeng['Drap'] + '2');
  
  // Prosentfaktor tre: gjengst�rrelse
  if($Gjeng['antall_gjenger'] == '1') { $FaktorTre = '10'; } elseif($Gjeng['antall_gjenger'] == '2') { $FaktorTre = '25'; } elseif($Gjeng['antall_gjenger'] == '3') { $FaktorTre = '50'; } else { $FaktorTre = '10'; }
  
  // Bedrifter gjengen eier
 $Bedrifter = mysql_query("SELECT * FROM Butikker WHERE Butikk_Gjeng='$Gjengnavn'");  $Fabrikker = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Gjeng='$Gjengnavn'");
  $FaktorNull = floor(mysql_num_rows($Bedrifter) + mysql_num_rows($Fabrikker) + '2');
  
  // Minus skade p� huset
  $Skade = floor('100' - $Gjeng['GjengTilstand']);
  $Styrke = floor(($Hovedfaktor / '100' * $FaktorEn) + ($Hovedfaktor / '100' * $FaktorTo) + ($Hovedfaktor / '100' * $FaktorTre) + $Hovedfaktor);
  $Styrke = floor(($Styrke / '100' * $FaktorNull) + $Styrke);
  if($Skade >= '1') { $Kalk = floor($Styrke - ($Styrke / '100' * $Skade)); } else { $Kalk = $Styrke; }  
  return $Kalk;
  }

  // Ventetider
  $FeilVentEr = $Timestamp + '80';
  $VentEr = $Timestamp + '80';
  $SekVente = $i['Ventetid'] - $Timestamp;
  
  // Sjekker om du f�r hjelp
  $HjelpEn = array("Nei","Ja","Nei","Ja","Nei","Nei","Ja","Nei","Ja","Nei");
  $HjelpEn = $HjelpEn[array_rand($HjelpEn)];
  
  // Sjekker om ham f�r hjelp
  $HjelpTo = array("Nei","Ja","Nei","Ja","Nei","Nei","Ja","Nei","Ja","Nei");
  $HjelpTo = $HjelpTo[array_rand($HjelpTo)];
  
  echo "
  <script>
  function Angrip() { if($('#AngripBruker').val() == '' || $('#AngripBruker').val() == 'Brukernavn') { alert('Du har ikke valgt et offer.'); } else if($('#AngripAlt').val() == 'Ran spiller' || $('#AngripAlt').val() == 'Saboter spiller') { var valgt = Array(); valgt.push($('#AngripAlt').val()); valgt.push($('#AngripBruker').val()); var valgt = encodeURI(valgt); $('#SB_Midten2').load('post.php?GjengHus=Krim&Krig='+valgt); $('html, body').animate({scrollTop:100}, 'slow'); } else { alert('Ugyldig valg.'); }}
  
  function Bomb() { 
  if($('#AngripHus').val() == 'Bomb 1' || $('#AngripHus').val() == 'Bomb 2' || $('#AngripHus').val() == 'Bomb 3' || $('#AngripHus').val() == 'Bomb 4') { 
  var valgt = Array();
  valgt.push($('#AngripHus').val());
  valgt.push('Null');
  var valgt = encodeURI(valgt);
  $('#SB_Midten2').load('post.php?GjengHus=Krim&Krig='+valgt);
  $('html, body').animate({scrollTop:100}, 'slow');
  } else { alert('Ugyldig valg.'); }
  }

  </script>
  ";
    
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">$G_NavnEr</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Okonomi');\">( Økonomi )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Krim');\">( Krim )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Medlemmer');\">( Medlemmer )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Hovedkvarter');\">( Hovedkvarter )</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/Gjengran.jpg\"></td></tr>
  ";

  // Starter krig
  if($_GET['Angrep'] && $Antall >= '1' && $i['stilling'] == 'Boss') { 
  $MotGjeng = Dekrypt_Tall(Mysql_Klar(Bare_Bokstaver($_GET['Angrep'])));
  if(empty($MotGjeng)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig post.</span></td></tr>"; } 
  elseif($MotGjeng == $G_Id) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke starte et angrep mot din egen gjeng.</span></td></tr>"; } 
  elseif($MotGjeng == '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke starte et angrep mot MafiaNo Crew.</span></td></tr>"; } else {

  $Sjekk = mysql_query("SELECT Gjeng_Navn FROM Gjenger WHERE id='$MotGjeng'");
  if(mysql_num_rows($Sjekk) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke gjengen.</span></td></tr>"; } else { 
  $SjekkTo = mysql_query("SELECT id FROM Gjeng_krig WHERE Angreps_ID='$G_Id' OR Offer_ID='$G_Id'");
  if(mysql_num_rows($SjekkTo) >= '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Gjengen din er i krig, kan derfor ikke starte ny krig.</span></td></tr>"; } else { 
  $aN = mysql_fetch_assoc($Sjekk);
  $NyProsi = floor($i['AngrepsPros'] - '100');
  $KrigsLengde = $Timestamp + '3700';
  $GjengMmmm = $aN['Gjeng_Navn'];
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Gjeng_krig` (Angreps_ID,Offer_ID,Dato,Stamp,StartetAv,KrigOver,GjengAng,GjengMot) VALUES ('$G_Id','$MotGjeng','$FullDato','$Timestamp','$brukernavn','$KrigsLengde','$G_NavnEr','$GjengMmmm')");
  mysql_query("UPDATE Gjenger SET AngrepsPros='$NyProsi' WHERE id='$G_Id'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har startet et angrep mot ".$aN['Gjeng_Navn'].".</span></td></tr>"; 
  }}}}
  
  // Krig igang
  elseif($_GET['Krig']) { 
  $Postet = Mysql_Klar($_GET['Krig']);
  $Postet = explode(",",$Postet); 
  
  // Sjekk om du er i krig

  $KrigElle = mysql_query("SELECT * FROM Gjeng_krig WHERE Angreps_ID='$G_Id' OR Offer_ID='$G_Id'");
  if(mysql_num_rows($KrigElle) >= '1') {  
  $KrIE = mysql_fetch_assoc($KrigElle);
  $KrigsID = $KrIE['id'];
  if($KrIE['Angreps_ID'] == $G_Id) { $Motstand = $KrIE['Offer_ID']; $KrigOk = "A_Stilling"; $KrigOkMot = "O_Stilling"; } else { $Motstand = $KrIE['Angreps_ID']; $KrigOk = "O_Stilling"; $KrigOkMot = "A_Stilling"; }

  // Sjekk om du m� vente
  if($i['Ventetid'] > $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente <font id=\"KrigVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>"; } else {
  
  // Angrep mot spillere
  if($Postet['0'] == 'Ran spiller' || $Postet['0'] == 'Saboter spiller') { 
  $BrukeFinn = $Postet['1'];
  $Offer = mysql_query("SELECT brukere.* FROM brukere INNER JOIN Gjeng_medlemmer ON Gjeng_medlemmer.brukernavn=brukere.brukernavn AND Gjeng_medlemmer.gjeng_id='$Motstand' WHERE brukere.brukernavn='$BrukeFinn'");
  if(mysql_num_rows($Offer) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke brukeren i rivalgjengen.</span></td></tr>"; } else { 
  $O_Info = mysql_fetch_assoc($Offer);
  $BrukeFinn = $O_Info['brukernavn'];
  $MotGjeng = $O_Info['gjeng']; 
  $OffernsID = $O_Info['brukerid']; 
  if($O_Info['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren $BrukeFinn er død</span></td></tr>"; } else {

  $StrafferSF = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$BrukeFinn' AND StampOver > '$Timestamp'");  
  if(mysql_num_rows($StrafferSF) >= '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$BrukeFinn soner en straff.</span></td></tr>"; } else { 
  $FinnEll = Finner($Land,$O_Info['land'],$O_Info['brukernavn']);
  if($FinnEll == 'Fant') { 
  $DinStyrke = DinStyrke($rad_B['rankpros'],($rad_B['brekk_gjort'] + $rad_B['biler_gjort'] + $rad_B['plan_ran'] + $rad_B['bryt_ut_antall'] + $rad_B['kid_antall'] + $rad_B['presse_antall'] + $rad_B['herverk_gjort']),$rad_B['respekt'],$rad_B['drap'],$rad_B['liv']);
  $OffStyrke = DinStyrke($O_Info['rankpros'],($O_Info['brekk_gjort'] + $O_Info['biler_gjort'] + $O_Info['plan_ran'] + $O_Info['bryt_ut_antall'] + $O_Info['kid_antall'] + $O_Info['presse_antall'] + $O_Info['herverk_gjort']),$O_Info['respekt'],$O_Info['drap'],$O_Info['liv']);
  
  // Du er sterkere
  if($DinStyrke > $OffStyrke) { 
  if($HjelpTo == 'Ja') { 
  $GjengMot = array();
  $GjengMotIder = array("$OffernsID");

  $HentMedEn = mysql_query("SELECT * FROM brukere WHERE gjeng='$MotGjeng' AND brukernavn NOT LIKE '$BrukeFinn' AND land='$Land'");  
  if(mysql_num_rows($HentMedEn) == '0') { array_push($GjengMot, 'Ingen'); } else { while($i = mysql_fetch_assoc($HentMedEn)) { array_push($GjengMotIder, $i['brukerid']); array_push($GjengMot, $i['brukernavn']); $OffStyrke = $OffStyrke + DinStyrke($i['rankpros'],($i['brekk_gjort'] + $i['biler_gjort'] + $i['plan_ran'] + $i['bryt_ut_antall'] + $i['kid_antall'] + $i['presse_antall'] + $i['herverk_gjort']),$i['respekt'],$i['drap'],$i['liv']); }}
  $GjengMot = implode(",",$GjengMot); 
  if($GjengMot == 'Ingen') { 
  // Start vinn siden han ikke har gjengmedlemmer i samme by
  include "GjengkrigRanVell.inc.php"; 
  // Lukk vinn siden han ikke har gjengmedlemmer i samme by
  } else { 
  
  $GjengAng = array();
  $AngripIdenE = $rad_B['brukerid'];
  $GjengAngIder = array("$AngripIdenE");

  $HentMedEn = mysql_query("SELECT * FROM brukere WHERE gjeng='$G_NavnEr' AND brukernavn NOT LIKE '$brukernavn' AND land='$Land'");  
  if(mysql_num_rows($HentMedEn) == '0') { array_push($GjengAng, 'Ingen'); } else { while($i = mysql_fetch_assoc($HentMedEn)) { array_push($GjengAngIder, $i['brukerid']); array_push($GjengAng, $i['brukernavn']); $DinStyrke = $DinStyrke + DinStyrke($i['rankpros'],($i['brekk_gjort'] + $i['biler_gjort'] + $i['plan_ran'] + $i['bryt_ut_antall'] + $i['kid_antall'] + $i['presse_antall'] + $i['herverk_gjort']),$i['respekt'],$i['drap'],$i['liv']); }}
  $GjengAng = implode(",",$GjengAng); 
  if($GjengAng == 'Ingen') { 
  if($DinStyrke > $OffStyrke) { 
  $MeldSend = "$brukernavn angrep deg, du klarte ikke � ta ham alene s� du kalte inn $GjengMot men det stoppet ikke $brukernavn, han banka driten ut av dere alle alene.";
  $DinMeld = "$BrukeFinn kalte inn forsterkninger: $GjengMot. Men du gikk imot dem og kom seirende ut.";

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','$MeldSend','Ja')");

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$VentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOk=`$KrigOk`+'1.1' WHERE id='$KrigsID'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $GjengMotIder = implode(",",$GjengMotIder); 
  mysql_query("UPDATE brukere SET liv=`liv`-'0.6' WHERE brukerid IN ($GjengMotIder)");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$DinMeld</span></td></tr>";  
  } else { 

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$FeilVentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOkMot=`$KrigOkMot`+'0.3' WHERE id='$KrigsID'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv',liv=`liv`-'2' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du fikk juling av $GjengMot.</span></td></tr>";  
  }} else { 
  if($DinStyrke > $OffStyrke) { 
  $MeldSend = "$brukernavn angrep deg, du klarte ikke � ta ham alene s� du kalte inn $GjengMot men da kalte $brukernavn p� $GjengAng. $G_NavnEr vant slaget.";
  $DinMeld = "$BrukeFinn kalte inn forsterkninger: $GjengMot. Du ble redd å ringte derfor til: $GjengAng. Dere banka driten ut av dem.";

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','$MeldSend','Ja')");

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$VentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOk=`$KrigOk`+'1.1' WHERE id='$KrigsID'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $GjengMotIder = implode(",",$GjengMotIder); 
  mysql_query("UPDATE brukere SET liv=`liv`-'0.6' WHERE brukerid IN ($GjengMotIder)");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$DinMeld</span></td></tr>";  
  } else { 

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$FeilVentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOkMot=`$KrigOkMot`+'0.4' WHERE id='$KrigsID'");
  $GjengAngIder = implode(",",$GjengAngIder); 
  mysql_query("UPDATE brukere SET liv=`liv`-'0.3' WHERE brukerid IN ($GjengAngIder)");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$BrukeFinn var ikke alene han var sammen med $GjengMot, heldigvis var $GjengAng like ved. Det ble avfyrt skudd, dere ble skadet.</span></td></tr>";  
  }}}} else { 
  // Start vinn siden du er sterkere
  include "GjengkrigRanVell.inc.php";
  // Lukk vinn siden du er sterkere
  }} else { if($HjelpEn == 'Ja') { 
  $GjengAng = array();

  $HentMedEn = mysql_query("SELECT * FROM brukere WHERE gjeng='$G_NavnEr' AND brukernavn NOT LIKE '$brukernavn' AND land='$Land'");  
  if(mysql_num_rows($HentMedEn) == '0') { array_push($GjengAng, 'Ingen'); } else { while($i = mysql_fetch_assoc($HentMedEn)) { array_push($GjengAng, $i['brukernavn']);}}
  $GjengAng = implode(",",$GjengAng); 
  if($GjengAng == 'Ingen') { 
  // Start tap verdier siden du ikke har gjengmedlemer i samme by
  include "GjengkrigRanFei.inc.php"; 
  // Lukk tap verdier siden du ikke har gjengmedlemer i samme by
  } else { 

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$VentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOk=`$KrigOk`+'0.6' WHERE id='$KrigsID'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du havnet i salgsmål med $BrukeFinn, han hadde overtaket men $GjengAng kom til unsetning og hjalp deg. $BrukeFinn stakk fra stedet.</span></td></tr>";  
  }} else { 
  // Start tap verdier siden du er svakere
  include "GjengkrigRanFei.inc.php";
  // Lukk tap verdier siden du er svakere
  }}} else { 

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$FeilVentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOkMot=`$KrigOkMot`+'0.1' WHERE id='$KrigsID'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du fant ikke $BrukeFinn.</span></td></tr>";
  }}}}}
  
  // Angrep med bomber
  elseif($Postet['0'] == 'Bomb 1' || $Postet['0'] == 'Bomb 2' || $Postet['0'] == 'Bomb 3' || $Postet['0'] == 'Bomb 4') { 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan snart bruke bomber.</span></td></tr>";
  }
  
  }}}

  echo "<tr class=\"Viktig_0\"><td class=\"Linje\" style=\"padding:5px;\"><table style=\"font-family: Arial; font-size: 12px;\">
  <tr><td style=\"text-align:center; font-weight:bold;\">Oppdrag</td></tr>
  <tr><td style=\"text-align:center;\">Vellykket herverk på en av butikkene til en rival.<br>Vellykket biltyveri på en gjengmedlem i en annen gjeng.<br>Vellykket voldtekt på en medlem av en rivalgjeng.<br>Vellykket kidnapping på en medlem i en annen gjeng.<br>Vellykket utpressing på en medlem i en rivalgjeng.<br><br></td></tr>
  <tr><td style=\"text-align:center; font-weight:bold;\">Prosentbarer</td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: $Ang%; overflow:hidden;\"><p>Planlagt angrep: $Teksti</p></div></div></td></tr>
  <tr><td style=\"filter:alpha(opacity=60); opacity:0.6;\"><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: $DinPros%; overflow:hidden;\"><p>Oppdrag du har bidrat med: $DinPros%</p></div></div></td></tr></table></td></tr>";
  
  // Sjekker om du gjengen er i krig

  $KrigEll = mysql_query("SELECT * FROM Gjeng_krig WHERE Angreps_ID='$G_Id' OR Offer_ID='$G_Id'");
  if(mysql_num_rows($KrigEll) >= '1' && $brukernavn == 'Havers') {  
  $KrI = mysql_fetch_assoc($KrigEll);
  $KrigOver = $KrI['KrigOver'] - $Timestamp;
  if($KrI['Angreps_ID'] == $G_Id) { $Motstander = $KrI['Offer_ID']; $MotNavne = $KrI['GjengMot']; } else { $Motstander = $KrI['Angreps_ID']; $MotNavne = $KrI['GjengAng']; }

  // Stilling
  if($KrI['A_Stilling'] == $KrI['O_Stilling']) { $KrigOvertak = "Stillingen er likt mellom <font style=\"font-weight:bold;\">".$KrI['GjengAng']."</font> og <font style=\"font-weight:bold;\">".$KrI['GjengMot']."</font>."; }
  elseif($KrI['A_Stilling'] > $KrI['O_Stilling']) { $LederScore = $KrI['A_Stilling'] - $KrI['O_Stilling']; $KrigOvertak = "<font style=\"font-weight:bold;\">".$KrI['GjengAng']."</font> leder med ( <font style=\"font-weight:bold;\">$LederScore poeng</font> ) over <font style=\"font-weight:bold;\">".$KrI['GjengMot']."</font>."; }
  else { $LederScore = $KrI['O_Stilling'] - $KrI['A_Stilling']; $KrigOvertak = "<font style=\"font-weight:bold;\">".$KrI['GjengMot']."</font> leder med ( <font style=\"font-weight:bold;\">$LederScore poeng</font> ) over <font style=\"font-weight:bold;\">".$KrI['GjengAng']."</font>."; }

  // Hent medlemmer av den andre gjengen
  $Mede = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE gjeng_id='$Motstander'");
  $MotMedlemmer = "";
  while($Medii = mysql_fetch_assoc($Mede)) { $MotMedlemmer = $MotMedlemmer."<option>".$Medii['brukernavn']."</option>"; }
 


  echo "<tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <span class=\"tekst\" style=\"text-align:center; font-size:12px;\">
  Krigen ble startet <font style=\"font-weight:bold;\">".$KrI['Dato']."</font> av <font style=\"font-weight:bold;\">".BrukerUrl($KrI['StartetAv'])."</font> fra <font style=\"font-weight:bold;\">".$KrI['GjengAng']."</font>.<br>
  Vinneren vil bli kåret om <font id=\"KrigOver\" class=\"TellNed\" style=\"font-weight:bold;\">$KrigOver</font> sekunder.<br><br>$KrigOvertak<br><br><hr><br>
  
  
  ".$KrI['GjengAng']." sin styrke er ".VerdiSum(GjengStyrke($KrI['Angreps_ID'],''))."<br>
  ".$KrI['GjengMot']." sin styrke er ".VerdiSum(GjengStyrke($KrI['Offer_ID']),'')."<br><b>Hvis styrken når null så kolapser gjengen.</b>

  </span>
  <img src=\"../Bilder/KrigEN.jpg\">
  <select id=\"AngripBruker\">$MotMedlemmer</select>
  <select id=\"AngripAlt\"><option>Ran spiller</option><option>Saboter spiller</option></select>
  <p class=\"Post\" onclick=\"Angrip();\">Utfør!</p>
  <img src=\"../Bilder/KrigTO.jpg\">
  <span class=\"tekst\" style=\"text-align:center; font-size:12px;\">$G_NavnEr har ".VerdiSum($G_Bombs,'bombechips')." på lageret.
  <span class=\"Bomb\">&nbsp;</span>
  <span class=\"Bomb\"><p>Plasser bombe i $MotNavne sin bank</p><p>2.000 bc</p></span>
  <span class=\"Bomb\"><p>Tidsinnstilt bombing av gjenghuset til $MotNavne</p><p>2.300 bc</p></span>
  <span class=\"Bomb\"><p>Bomb $MotNavne sitt krimpanel</p><p>3.500 bc</p></span>
  <span class=\"Bomb\">&nbsp;</span>
  <span class=\"Bomb\"><p>Kontrolert forsvarsbombe</p><p>2.400 bc</p></span>
  <span class=\"Bomb\"><p>Gainerbombing reparerer gjenghuset med 25%</p><p>5.000 bc</p></span>
  </span>
  <img src=\"../Bilder/KrigTre.jpg\">
  <p class=\"Post\" onclick=\"Angrip();\">Utfør!</p>
  </td></tr>
  ";

  }
  // Sjekker om du kan starte krig
  elseif($Antall >= '1' && $i['stilling'] == 'Boss' && $brukernavn == 'Havers') { 
  
  echo "
  <script>
  function StartKrig() { 
  if($('#V_Gjeng').val() == '') { alert('Ugyldig valg'); } 
  else if($('#V_Gjeng').val() == '$DenneGjeng') { alert('Du kan ikke starte et angrep mot din egen gjeng.'); } else { 
  var GjengID = encodeURI($('#V_Gjeng').val()); 
  $('#SB_Midten2').load('post.php?GjengHus=Krim&Angrep='+GjengID);
  $('html, body').animate({scrollTop:100}, 'slow');
  }}
  </script>
  ";
  

  $GjengALT = mysql_query("SELECT Gjeng_Navn,id FROM Gjenger WHERE id NOT LIKE '$G_Id' AND id NOT LIKE '1'");
  while($i = mysql_fetch_assoc($GjengALT)) { $IDen =  Krypt_Tall($i['id']); $Alt = $Alt."<option value=\"$IDen\">".$i['Gjeng_Navn']."</option>"; }
  echo "
  <tr class=\"Vanlig_1\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <select id=\"V_Gjeng\">$Alt</select>
  <span class=\"tekst\">
  <b>Infomasjon:</b><br>
  Det kan være lurt å planlegge angrepet på forhånd slik at medlemmene av gjengen din vet hva slags oppgave de har når angrepet er igang.
  Styrken til rival gjengen avhenger av gjengtype,gjengmedlemmer,bedrifter,drap og kriger gjengen har deltatt i.<br><br>
  <b>1:</b> Gjengen din får muligheten til å angripe,rane,sabotere og voldta medlemmene i den valgte gjengen. Det er lurt å søke opp plasseringen til spillerene i rival gjengen.<br><br>
  <b>2:</b> Medlemmene av gjengen din kan skade gjenghuset til rivalene, antall skade-prosent som blir påført avhenger av styrken til rivalgjengen. Styrken til rivalgjengen synker ved stadig angrep mot medlemmene i gjengen.<br><br>
  <b>3:</b> Hvis rival gjengen eier noen bedrifter så har medlemmene dine også mulighet til å bombe bedriftene med forsjellige bomber.<br><br>
  Det er lurt å plassere spillere strategisk.<br><br>
  Om gjengen din skulle være så heldig at rivalgjengen blir nedlagt/ødelagt så overtar din gjeng økonomien til den nedlagte gjengen. Gjengen din blir også forbedret og utviklet, 'Enkel gjeng' er det laveste nivået en gjeng er i.
  </span>
  <p class=\"Post\" onclick=\"StartKrig();\">Start angrep</p>
  </td></tr>
  ";
  }
  
  echo "</table></div>";

  }
  ?>
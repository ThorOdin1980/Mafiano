  <?php
  if(basename($_SERVER['PHP_SELF']) == "Auksjon.inc.php") { header("Location: index.php"); exit; } else {
  
  if(($rad_B['type'] == 'A' || $rad_B['type'] == 'm') && $brukernavn != 'Havers') { 
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Handel</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/Auction.jpg\"></td></tr>
  <tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Stengt for moderator og administrator.</span></td></tr>
  </table></div>
  ";
  
  
  } else {
  
  function Hestekrefter($Merke) { if($Merke == 'Opel Calibra') { $HK = '160'; } elseif($Merke == 'Audi TT') { $HK = '225'; } elseif($Merke == 'Suziki XL-7') { $HK = '109'; } elseif($Merke == 'Suzuki XL-7') { $HK = '109'; } elseif($Merke == 'Toyota Supera') { $HK = '235'; } elseif($Merke == 'Toyota Supra') { $HK = '235'; } elseif($Merke == 'Nissan Skyline GT-R') { $HK = '250'; } elseif($Merke == 'Peugot 307 SW') { $HK = '90'; } elseif($Merke == 'Saab 9-5') { $HK = '120'; } elseif($Merke == 'Nissan 100 NX') { $HK = '100'; } elseif($Merke == 'Honda Civic 1,6') { $HK = '125'; } elseif($Merke == 'Lada Niva') { $HK = '80'; } elseif($Merke == 'Chrysler Neon') { $HK = '133'; } elseif($Merke == 'Ford Escort 1,4') { $HK = '87'; } elseif($Merke == 'Volvo 240') { $HK = '85'; } elseif($Merke == 'Mazda RX-8') { $HK = '240'; } elseif($Merke == 'Volkswagen golf 1,8 GT') { $HK = '90'; } elseif($Merke == 'Mercedes-Benz SLK') { $HK = '170'; } elseif($Merke == 'Range Rover 3.0 Td6') { $HK = '180'; } elseif($Merke == 'Porsche 944') { $HK = '200'; } elseif($Merke == 'Bmw 3-serie') { $HK = '160'; } elseif($Merke == 'Jaguar XKR 4,2') { $HK = '300'; } else { $HK = '0'; } return $HK; }

  // Vopen og beskyttelse

  $TellVope = '0'; $TellBesk = '0';
  $Ho = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn'"); 
  if(mysql_num_rows($Ho) >= '1') { while($V = mysql_fetch_assoc($Ho)) { if($V['type'] == '1') { $TellVope++; $Vopenliste = $Vopenliste."<option value=\"".Krypt_Tall($V['id'])."\">".$V['utstyr']." - ".$V['skytereningen']."% trent</option>"; } else { $TellBesk++; $Beskliste = $Beskliste."<option value=\"".Krypt_Tall($V['id'])."\">".$V['utstyr']."</option>"; }}}
  if($TellVope == '0') { $Vopenliste = "<option value=\"0\">Du eier ingen våpen</option>"; }
  if($TellBesk == '0') { $Beskliste = "<option value=\"0\">Du eier ingen beskyttelser</option>"; }

  // Dine butikker

  $TellButtikk = '0'; 
  $Bu = mysql_query("SELECT * FROM Butikker WHERE Butikk_eier LIKE '$brukernavn'"); 
  if(mysql_num_rows($Bu) >= '1') { while ($BuI = mysql_fetch_assoc($Bu)) { $TellButikk++; $Butikkliste = $Butikkliste."<option value=\"".Krypt_Tall($BuI['id'])."\">".$BuI['Butikk_Navn']." - ".$BuI['Butikk_Type']." - ".$BuI['Butikk_Land']."</option>"; }}
  if( $TellButikk == '0') { $Butikkliste = "<option value=\"0\">Du eier ingen butikker</option>"; }

  // Dine kulefabrikker
 
  $TellKf = '0';
  $Kf = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Eier='$brukernavn'"); 
  if(mysql_num_rows($Kf) >= '1') { while($KfI = mysql_fetch_assoc($Kf)) { $TellKf++; $Kfliste = $Kfliste."<option value=\"".Krypt_Tall($KfI['id'])."\">".$KfI['KF_Fabrikk']."</option>"; }}
  if($TellKf == '0') { $Kfliste = "<option value=\"0\">Du eier ingen kulefabrikker</option>"; }

  // Dine biler

  $TellBil = '0';
  $Bil = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND TransportEll < '$tiden' ORDER BY `timestampen` DESC LIMIT 100");
  if(mysql_num_rows($Bil) >= '1') { while ($BiI = mysql_fetch_assoc($Bil)) { $TellBil++; 
  if($BiI['skade'] <= '0') { $Skade = '0%'; } else { $Skade = floor($BiI['skade'])."%"; }
  $Billiste = $Billiste."<option value=\"".Krypt_Tall($BiI['id'])."\">".$BiI['bilmerke']." ( ".Hestekrefter($BiI['bilmerke'])." HK ) ( $Skade skade ) - Plass: ".$BiI['land']." - Stjelt fra: ".$BiI['stjelt_fra']."</option>"; }}
  if($TellBil == '0') { $Billiste = "<option value=\"0\">Du har ingen biler klare</option>"; }
  
  // Fly og b�ter

  $TellFly = '0'; $TellBot = '0';
  $Fl = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn'");
  if(mysql_num_rows($Fl) >= '1') { while($FlI = mysql_fetch_assoc($Fl)) { if($FlI['Frakt_er'] == '1') { $TellFly++; $Flyliste = $Flyliste."<option value=\"".Krypt_Tall($FlI['id'])."\">".$FlI['Frakt_navn']."</option>"; } else { $TellBot++; $Botliste = $Botliste."<option value=\"".Krypt_Tall($FlI['id'])."\">".$FlI['Frakt_navn']."</option>"; }}}
  if($TellFly == '0') { $Flyliste = "<option value=\"0\">Du eier ingen fly</option>"; }
  if($TellBot == '0') { $Botliste = "<option value=\"0\">Du eier ingen båter</option>"; }
  
  echo "
  <script>
  $('Select').click(function() {
  var Rad = $('#V_Type').val();
  if(Rad == 'Poeng' || Rad == 'Respekt' || Rad == 'Bombechips' || Rad == 'Kuler') { $('.Sjul').hide(); $('#V_Antall').show(); }
  else if(Rad == 'Våpen') { $('.Sjul').hide(); $('#V_Vopen').show(); }
  else if(Rad == 'Beskyttelse') { $('.Sjul').hide(); $('#V_Beskyttelse').show(); }
  else if(Rad == 'Gjeng') { $('.Sjul').hide(); $('#V_Gjeng').show(); }
  else if(Rad == 'Butikk') { $('.Sjul').hide(); $('#V_Butikk').show(); }
  else if(Rad == 'Kulefabrikk') { $('.Sjul').hide(); $('#V_Fabrikk').show(); }
  else if(Rad == 'Biler') { $('.Sjul').hide(); $('#V_Biler').show(); }
  else if(Rad == 'Fly') { $('.Sjul').hide(); $('#V_Fly').show(); }
  else if(Rad == 'Båter') { $('.Sjul').hide(); $('#V_Bot').show(); } else { $('.Sjul').hide(); }
  });
  
  function Auksjon() { 
  if($('#V_Til').val() == '') { alert('Selg til mangler.'); } 
  else if($('#V_Pris').val() == 'Pris' || $('#V_Pris').val() == '0' || $('#V_Pris').val() == '') { alert('Pris mangler.'); }
  else if($('#V_Type').val() == 'Poeng' || $('#V_Type').val() == 'Respekt' || $('#V_Type').val() == 'Bombechips' || $('#V_Type').val() == 'Kuler' || $('#V_Type').val() == 'Våpen' || $('#V_Type').val() == 'Beskyttelse' || $('#V_Type').val() == 'Gjeng' || $('#V_Type').val() == 'Butikk' || $('#V_Type').val() == 'Kulefabrikk' || $('#V_Type').val() == 'Biler' || $('#V_Type').val() == 'Fly' || $('#V_Type').val() == 'Båter') { 
  var Info = Array();
  if($('#V_Type').val() == 'Poeng' || $('#V_Type').val() == 'Respekt' || $('#V_Type').val() == 'Bombechips' || $('#V_Type').val() == 'Kuler') { 
  if($('#V_Antall').val() == '' || $('#V_Antall').val() == 'Antall' || $('#V_Antall').val() == '0') { alert('Du har glemt å fylle inn antallet du ønsker å selge.'); } else { Info.push($('#V_Til').val(),$('#V_Pris').val(),$('#V_Type').val(),$('#V_Antall').val()); var Info = encodeURI(Info); $('#SB_Midten2').load('post.php?du_valgte=Auksjoner&Selg='+Info); }}
  else if($('#V_Type').val() == 'Våpen' || $('#V_Type').val() == 'Beskyttelse' || $('#V_Type').val() == 'Gjeng' || $('#V_Type').val() == 'Butikk' || $('#V_Type').val() == 'Kulefabrikk' || $('#V_Type').val() == 'Biler' || $('#V_Type').val() == 'Fly' || $('#V_Type').val() == 'Båter') { 
  if($('#V_Type').val() == 'Våpen') { var vareID = $('#V_Vopen').val(); }
  else if($('#V_Type').val() == 'Beskyttelse') { var vareID = $('#V_Beskyttelse').val(); }
  else if($('#V_Type').val() == 'Gjeng') { var vareID = $('#V_Gjeng').val(); }
  else if($('#V_Type').val() == 'Butikk') { var vareID = $('#V_Butikk').val(); }
  else if($('#V_Type').val() == 'Kulefabrikk') { var vareID = $('#V_Fabrikk').val(); }
  else if($('#V_Type').val() == 'Biler') { var vareID = $('#V_Biler').val(); }
  else if($('#V_Type').val() == 'Fly') { var vareID = $('#V_Fly').val(); }
  else if($('#V_Type').val() == 'Båter') { var vareID = $('#V_Bot').val(); } else { var vareID = '0'; }
  if(vareID == '0') { alert('Finner ikke varen.'); } else { Info.push($('#V_Til').val(),$('#V_Pris').val(),$('#V_Type').val(),'0',vareID); var Info = encodeURI(Info); $('#SB_Midten2').load('post.php?du_valgte=Auksjoner&Selg='+Info); }
  }}}
  
  function Kjop(id) { 
  if(confirm('Sikker på at du vil kjøpe denne varen?')) { 
  if(id == '') { alert('Ugyldig vare id.'); } else { 
  var id = encodeURI(id);
  $('#SB_Midten2').load('post.php?du_valgte=Auksjoner&Kjop='+id); 
  $('html, body').animate({scrollTop:100}, 'slow');
  }}}
  
  function Trekk(id) { 
  if(id == '') { alert('Ugyldig vare id.'); } else { 
  var id = encodeURI(id);
  $('#SB_Midten2').load('post.php?du_valgte=Auksjoner&Trekk='+id); 
  }}
  
  </script>
  ";

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Handel</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/Auction.jpg\"></td></tr>";
  
  // Trek tilbake
  if($_GET['Trekk']) { 
  $VareID = Dekrypt_Tall(Bare_Bokstaver(Mysql_Klar($_GET['Trekk'])));
  if(empty($VareID)) { echo "<script>alert('Finner ikke varen.');</script>"; } else { 

  $Finn = mysql_query("SELECT * FROM Auksjon WHERE id='$VareID' AND Selger='$brukernavn'");
  if(mysql_num_rows($Finn) == 0) { echo "<script>alert('Finner ikke varen.');</script>"; } else { 
  $Bla = mysql_fetch_assoc($Finn); 
  if($Bla['Stamp'] != '0') { 
  mysql_query("UPDATE Auksjon SET Stamp='0' WHERE Selger='$brukernavn' AND id='$VareID'");
  echo "<script>alert('Du må trykke en gang til for å få tilbake varen. Grunnen til at det er slik er for å ungå vare dobbling.');</script>";
  } else { 
  if($Bla['Vare'] == 'Poeng' || $Bla['Vare'] == 'Respekt' || $Bla['Vare'] == 'Bombechips' || $Bla['Vare'] == 'Kuler') { 
  if($Bla['Vare'] == 'Poeng') { $Tilbake = floor($rad_B['turns'] + $Bla['Antall']); $OPP = "turns="; $ek = 'poeng'; }
  elseif($Bla['Vare'] == 'Respekt') { $Tilbake = floor($rad_B['respekt'] + $Bla['Antall']); $OPP = "respekt="; $ek = 'respekt'; }
  elseif($Bla['Vare'] == 'Bombechips') { $Tilbake = floor($rad_B['bombechips'] + $Bla['Antall']); $OPP = "bombechips="; $ek = 'bombechips'; }
  elseif($Bla['Vare'] == 'Kuler') { $Tilbake = floor($rad_B['kuler'] + $Bla['Antall']); $OPP = "kuler="; $ek = 'kuler'; }
  $Meld = "Du har fått tilbake ".VerdiSum($Bla['Antall'],$ek).", varen er nå slettet";
  mysql_query("UPDATE brukere SET $OPP'$Tilbake',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("DELETE FROM Auksjon WHERE id='$VareID' AND Selger='$brukernavn'");
  echo "<script>alert('$Meld');</script>";
  } else { 
  mysql_query("DELETE FROM Auksjon WHERE id='$VareID' AND Selger='$brukernavn'");
  echo "<script>alert('Varen er fjernet.');</script>";
  }}}}}

  // Kjop
  elseif($_GET['Kjop']) { 
  $VareID = Dekrypt_Tall(Bare_Bokstaver(Mysql_Klar($_GET['Kjop'])));
  if(empty($VareID)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke varen.</span></td></tr>"; } else { 

  $Finn = mysql_query("SELECT * FROM Auksjon WHERE id='$VareID'");
  if(mysql_num_rows($Finn) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke varen.</span></td></tr>"; } else { 
  $Bla = mysql_fetch_assoc($Finn); 
  $Selger = $Bla['Selger'];
  $Produkt = $Bla['VareID'];

  if($Bla['Til'] == '-Ingen-') { $MentFor = $brukernavn; } else { $MentFor = $Bla['Til']; }
  if($Bla['Selger'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke kjøpe din egen vare.</span></td></tr>"; } 
  elseif($MentFor != $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke kjøpe denne varen.</span></td></tr>"; }
  elseif($Bla['Stamp'] == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke handle denne varen, den er trekt tilbake.</span></td></tr>"; } else {

  // Variabel for loggf�ring
  $Promp = strtolower($Bla['Vare']);
  if($Promp == 'poeng' || $Promp == 'respekt' || $Promp == 'bombechips' || $Promp == 'kuler') { $LoggInfo = "<font style=\"color:#FFFFFF; font-size:10px;\">".VerdiSum($Bla['Antall'],$Promp)."</font><br>Pris: ".VerdiSum($Bla['Pris'],'kr'); } else { $LoggInfo = "<font style=\"color:#FFFFFF; font-size:10px;\">".$Bla['VareInfo']."</font><br>Pris: ".VerdiSum($Bla['Pris'],'kr'); }

  // Handel vist det er poeng,respekt,bombechips eller kuler
  if($Bla['Vare'] == 'Poeng' || $Bla['Vare'] == 'Respekt' || $Bla['Vare'] == 'Bombechips' || $Bla['Vare'] == 'Kuler') { 
  if($Bla['Pris'] > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; } else { 
  $NySumSpenn = floor($rad_B['penger'] - $Bla['Pris']);
  $TiPros = $Bla['Pris'] / '100' * '10';
  $SumFa = floor($Bla['Pris'] - $TiPros);
  $Vart = strtolower($Bla['Vare']);
  $Meld = "Du solgte ".VerdiSum($Bla['Antall'],$Vart)." for ".VerdiSum($Bla['Pris'],'kr').", MafiaNo tok ti prosent av den summen i skatt.";
  if($Bla['Vare'] == 'Poeng') { $NySum = floor($rad_B['turns'] + $Bla['Antall']); $Opp = "turns="; }
  elseif($Bla['Vare'] == 'Respekt') { $NySum = floor($rad_B['respekt'] + $Bla['Antall']);  $Opp = "respekt="; }
  elseif($Bla['Vare'] == 'Bombechips') { $NySum = floor($rad_B['bombechips'] + $Bla['Antall']);  $Opp = "bombechips="; }
  elseif($Bla['Vare'] == 'Kuler') { $NySum = floor($rad_B['kuler'] + $Bla['Antall']);  $Opp = "kuler="; }

  mysql_query("UPDATE brukere SET $Opp'$NySum',penger='$NySumSpenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET penger=`penger`+'$SumFa' WHERE brukernavn='$Selger'");
  mysql_query("DELETE FROM Auksjon WHERE id='$VareID'");
  mysql_query("INSERT INTO AuksjonLogg (Dato,Stamp,Selger,Kjoper,VareID,Info) VALUES ('$AnnenDato','$Timestamp','$Selger','$brukernavn','0','$LoggInfo')");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Selger','$Timestamp','$AnnenDato','Auksjonshus','$Meld','Ja')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har kjøpt ".VerdiSum($Bla['Antall'],$Vart)." for ".VerdiSum($Bla['Pris'],'kr').".</span></td></tr>";
  }}
  
  // Handel vist det er v�pen eller beskyttelse
  elseif($Bla['Vare'] == 'Våpen' || $Bla['Vare'] == 'Beskyttelse') { 

  $Ho = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$Selger' AND id='$Produkt'"); 
  if(mysql_num_rows($Ho) == 0) { mysql_query("DELETE FROM Auksjon WHERE id='$VareID'"); echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">".BrukerUrl($Selger)." har ikke lengere varen.</span></td></tr>"; } else { 
  $VareInfo = mysql_fetch_assoc($Ho); 
  $Utstyr = $VareInfo['utstyr'];
  $Ho2 = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND utstyr='$Utstyr'"); 
  if(mysql_num_rows($Ho2) >= '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har det utstyret fra før av.</span></td></tr>"; }
  elseif($Bla['Pris'] > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; } else { 
  $NySumSpenn = floor($rad_B['penger'] - $Bla['Pris']);
  $TiPros = $Bla['Pris'] / '100' * '10';
  $SumFa = floor($Bla['Pris'] - $TiPros);
  $Meld = "Du solgte $Utstyr for ".VerdiSum($Bla['Pris'],'kr').", MafiaNo tok ti prosent av den summen i skatt.";
  mysql_query("UPDATE brukere SET penger='$NySumSpenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET penger=`penger`+'$SumFa' WHERE brukernavn='$Selger'");
  mysql_query("DELETE FROM Auksjon WHERE id='$VareID'");
  mysql_query("UPDATE vapen_beskyttelse SET brukernavn='$brukernavn',forbruk_nr='0' WHERE brukernavn='$Selger' AND id='$Produkt'");
  mysql_query("INSERT INTO AuksjonLogg (Dato,Stamp,Selger,Kjoper,VareID,Info) VALUES ('$AnnenDato','$Timestamp','$Selger','$brukernavn','$Produkt','$LoggInfo')");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Selger','$Timestamp','$AnnenDato','Auksjonshus','$Meld','Ja')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har kjøpt $Utstyr for ".VerdiSum($Bla['Pris'],'kr').".</span></td></tr>";
  }}}

  // Handel vist det er bil,fly eller b�t
  elseif($Bla['Vare'] == 'Biler' || $Bla['Vare'] == 'Fly' || $Bla['Vare'] == 'Båter') { 
  if($Bla['Vare'] == 'Biler') { $Sporring = "SELECT * FROM garage WHERE eier='$Selger' AND id='$Produkt'"; } else { $Sporring = "SELECT * FROM fly_osv WHERE Frakt_eier='$Selger' AND id='$Produkt'"; }

  $Spor = mysql_query($Sporring);
  if(mysql_num_rows($Spor) == '0') { mysql_query("DELETE FROM Auksjon WHERE id='$VareID'"); echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">".BrukerUrl($Selger)." har ikke lengere varen.</span></td></tr>"; } 
  elseif($Bla['Pris'] > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; } else { 
  $VareInfo = mysql_fetch_assoc($Spor); 
  if($Bla['Vare'] == 'Biler') { $VareKjopt = $VareInfo['bilmerke'];  mysql_query("DELETE FROM Undergrunn_varer WHERE vare_eier='$Selger' AND varer_ligger_hos='$Produkt'");  mysql_query("UPDATE garage SET eier='$brukernavn',TransportEll='0' WHERE eier='$Selger' AND id='$Produkt'"); } else { $VareKjopt = $VareInfo['Frakt_navn'];  mysql_query("UPDATE fly_osv SET Frakt_eier='$brukernavn',PlassBrukt='0' WHERE Frakt_eier='$Selger' AND id='$Produkt'")or die(mysql_error()); }
  $NySumSpenn = floor($rad_B['penger'] - $Bla['Pris']);
  $TiPros = $Bla['Pris'] / '100' * '10';
  $SumFa = floor($Bla['Pris'] - $TiPros);
  $Meld = "Du solgte $VareKjopt for ".VerdiSum($Bla['Pris'],'kr').", MafiaNo tok ti prosent av den summen i skatt.";
  mysql_query("UPDATE brukere SET penger='$NySumSpenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET penger=`penger`+'$SumFa' WHERE brukernavn='$Selger'");
  mysql_query("DELETE FROM Auksjon WHERE id='$VareID'");
  mysql_query("INSERT INTO AuksjonLogg (Dato,Stamp,Selger,Kjoper,VareID,Info) VALUES ('$AnnenDato','$Timestamp','$Selger','$brukernavn','$Produkt','$LoggInfo')");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Selger','$Timestamp','$AnnenDato','Auksjonshus','$Meld','Ja')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har kjøpt $VareKjopt for ".VerdiSum($Bla['Pris'],'kr').".</span></td></tr>";
  }}

  // Handel vist det er gjeng,butikk,kulefabrikk
  elseif($Bla['Vare'] == 'Gjeng' || $Bla['Vare'] == 'Butikk' || $Bla['Vare'] == 'Kulefabrikk') { 

  if($Bla['Vare'] == 'Gjeng') { $Sporring = "SELECT * FROM Gjeng_medlemmer WHERE brukernavn='$Selger' AND stilling='Boss' AND gjeng_id='$Produkt'"; }
  elseif($Bla['Vare'] == 'Butikk') {  $Sporring = "SELECT * FROM Butikker WHERE Butikk_eier='$Selger' AND id='$Produkt'"; $Oppda = "UPDATE Butikker SET Butikk_eier='$brukernavn',Butikk_skade='100' WHERE Butikk_eier='$Selger' AND id='$Produkt'"; }
  elseif($Bla['Vare'] == 'Kulefabrikk') {  $Sporring = "SELECT * FROM Kulefabrikker WHERE KF_Eier='$Selger' AND id='$Produkt'"; $Oppda = "UPDATE Kulefabrikker SET KF_Eier='$brukernavn' WHERE KF_Eier='$Selger' AND id='$Produkt'"; }
  
  $Spor = mysql_query($Sporring);
  if(mysql_num_rows($Spor) == '0') {  mysql_query("DELETE FROM Auksjon WHERE id='$VareID'"); echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">".BrukerUrl($Selger)." har ikke lengere varen.</span></td></tr>"; } 
  elseif($Bla['Pris'] > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; } else { 
  $VareInfo = mysql_fetch_assoc($Spor); 
  
  $NySumSpenn = floor($rad_B['penger'] - $Bla['Pris']);
  $TiPros = $Bla['Pris'] / '100' * '10';
  $SumFa = floor($Bla['Pris'] - $TiPros);
  $Handlet = strtolower($Bla['Vare']);

  $Meld = "Du solgte en $Handlet for ".VerdiSum($Bla['Pris'],'kr').", MafiaNo tok ti prosent av den summen i skatt.";
  if($Bla['Vare'] == 'Gjeng') { 

  $SjekkGjeng = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE brukernavn='$brukernavn'");
  if(mysql_num_rows($SjekkGjeng) >= '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må forlate ".$rad_B['gjeng']." først.</span></td></tr>"; } else { 
  $HentGjeng = mysql_query("SELECT * FROM Gjenger WHERE id='$Produkt'");
  if(mysql_num_rows($HentGjeng) == '0') { mysql_query("DELETE FROM Auksjon WHERE id='$VareID'"); echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Gjengen eksisterer ikke lengere.</span></td></tr>"; } else { 
  $GjengI = mysql_fetch_assoc($HentGjeng); 
  $G_Navn = $GjengI['Gjeng_Navn'];
  mysql_query("UPDATE Gjeng_medlemmer SET brukernavn='$brukernavn',ansatt_dato='$FullDato',ansatt_stamp='$Timestamp',penger_don='0',poeng_don='0',bombechips_don='0',Drap='0',Forsvar='0',Angrep='0',OppdragUtfort='0' WHERE brukernavn='$Selger' AND stilling='Boss' AND gjeng_id='$Produkt'")or die("MySQL ERROR: ".mysql_error());;
  mysql_query("UPDATE brukere SET penger='$NySumSpenn',gjeng='$G_Navn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET penger=`penger`+'$SumFa',gjeng='' WHERE brukernavn='$Selger'");
  mysql_query("DELETE FROM Auksjon WHERE id='$VareID'");
  mysql_query("INSERT INTO AuksjonLogg (Dato,Stamp,Selger,Kjoper,VareID,Info) VALUES ('$AnnenDato','$Timestamp','$Selger','$brukernavn','$Produkt','$LoggInfo')");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Selger','$Timestamp','$AnnenDato','Auksjonshus','$Meld','Ja')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har kjøpt gjengleder stilling for ".VerdiSum($Bla['Pris'],'kr').".</span></td></tr>";
  }}} else { 
  mysql_query($Oppda);

  mysql_query("UPDATE brukere SET penger='$NySumSpenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET penger=`penger`+'$SumFa' WHERE brukernavn='$Selger'");
  mysql_query("DELETE FROM Auksjon WHERE id='$VareID'");
  mysql_query("INSERT INTO AuksjonLogg (Dato,Stamp,Selger,Kjoper,VareID,Info) VALUES ('$AnnenDato','$Timestamp','$Selger','$brukernavn','$Produkt','$LoggInfo')");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Selger','$Timestamp','$AnnenDato','Auksjonshus','$Meld','Ja')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har kjøpt en $Handlet for ".VerdiSum($Bla['Pris'],'kr').".</span></td></tr>";
  }}}
  
  }}}}
  
  // Selg
  elseif($_GET['Selg']) { 
  $Info = Mysql_Klar($_GET['Selg']); $Info = explode(",",$Info); 
  $Til = $Info['0'];
  $Pris = Bare_Siffer($Info['1']);
  $Vare = Bare_Bokstaver($Info['2']);
  $Antall = Bare_Siffer($Info['3']);
  if($Vare == 'Gjeng') { $VareID = $Info['4']; } else { $VareID = Dekrypt_Tall(Bare_Bokstaver($Info['4'])); }
  if(empty($Til) || $Til == "Selg til") { $Til = "-Ingen-"; }
  if(empty($Til)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Selg til mangler.</span></td></tr>"; }
  elseif(empty($Pris) || $Pris == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Pris mangler.</span></td></tr>"; }
  elseif($Pris > '10000000000' || $Pris < '100000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 100.000 kr, maximum 10.000.000.000 kr.</span></td></tr>"; }
  elseif($Vare == 'Poeng' || $Vare == 'Respekt' || $Vare == 'Bombechips' || $Vare == 'Kuler' || $Vare == 'VAtildeyenpen' || $Vare == 'Beskyttelse' || $Vare == 'Gjeng' || $Vare == 'Butikk' || $Vare == 'Kulefabrikk' || $Vare == 'Biler' || $Vare == 'Fly' || $Vare == 'BAtildeyenter') { 
  
  // Selg poeng, respekt, bombechips, kuler
  if($Vare == 'Poeng' || $Vare == 'Respekt' || $Vare == 'Bombechips' || $Vare == 'Kuler') { 
  if($Vare == 'Poeng') { $DuHar = floor($rad_B['turns']); $col = "turns="; $Valuta = 'poeng'; }
  elseif($Vare == 'Respekt') { $DuHar = floor($rad_B['respekt']); $col = "respekt="; $Valuta = 'respekt'; }
  elseif($Vare == 'Bombechips') { $DuHar = floor($rad_B['bombechips']); $col = "bombechips="; $Valuta = 'bombechips'; }
  elseif($Vare == 'Kuler') { $DuHar = floor($rad_B['kuler']); $col = "kuler="; $Valuta = 'kuler'; }
  $NySum = floor($DuHar - $Antall);
  if(empty($Antall) || $Antall == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Antallet du skal selge mangler</span></td></tr>"; }
  elseif($Antall < '5') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 5 i antall.</span></td></tr>"; }
  elseif($Antall > $DuHar) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke så mye.</span></td></tr>"; }
  elseif($Til == "-Ingen-") { 

  mysql_query("UPDATE brukere SET $col'$NySum',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til) VALUES ('$Pris','$Vare','$Antall','0','$Timestamp','$AnnenDato','$brukernavn','$Til')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har lagt ut ".VerdiSum($Antall,$Valuta)." for salg.</span></td></tr>";
  } else { 

  $S_Bruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Til'");
  if(mysql_num_rows($S_Bruker) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren eksisterer ikke.</span></td></tr>"; } else { 
  $H = mysql_fetch_assoc($S_Bruker); 
  if($H['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke selge til deg selv.</span></td></tr>"; } 
  elseif($H['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren er død.</span></td></tr>"; } else { 
  $Til = $H['brukernavn'];

  mysql_query("UPDATE brukere SET $col'$NySum',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til) VALUES ('$Pris','$Vare','$Antall','0','$Timestamp','$AnnenDato','$brukernavn','$Til')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har sendt salgs forespørselen til ".BrukerURL($Til).".</span></td></tr>";
  }}}} 
  
  // Selg vopen og beskyttelse
  elseif($Vare == 'VAtildeyenpen' || $Vare == 'Beskyttelse') { 
  if($Vare == 'VAtildeyenpen') { $Ra = '1'; $Vare = 'Våpen'; } 
  elseif($Vare == 'Beskyttelse') { $Ra = '2'; }

  $Finn = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND id='$VareID' AND type='$Ra'"); 
  if(mysql_num_rows($Finn) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke varen på din bruker</span></td></tr>"; } 
  elseif(mysql_num_rows(mysql_query("SELECT * FROM Auksjon WHERE Selger='$brukernavn' AND Vare='$Vare' AND VareID='$VareID'"))) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Denne varen ligger alt ute for salg.</span></td></tr>"; }
  elseif($Til == "-Ingen-") { 
  $Bla = mysql_fetch_assoc($Finn); 
  if($Vare == 'Våpen') { $VareInfo = $Bla['utstyr']." - ".$Bla['skytereningen']."% trent"; } else { $VareInfo = $Bla['utstyr']; }

  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til,VareInfo) VALUES ('$Pris','$Vare','0','$VareID','$Timestamp','$AnnenDato','$brukernavn','$Til','$VareInfo')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har lagt ut ".$Bla['utstyr']." for salg.</span></td></tr>";
  } else { 
  $Bla = mysql_fetch_assoc($Finn); 

  $S_Bruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Til'");
  if(mysql_num_rows($S_Bruker) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren eksisterer ikke.</span></td></tr>"; } else { 
  $H = mysql_fetch_assoc($S_Bruker); 
  if($H['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke selge til deg selv.</span></td></tr>"; } 
  elseif($H['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren er død.</span></td></tr>"; } else { 
  if($Vare == 'Våpen') { $VareInfo = $Bla['utstyr']." - ".$Bla['skytereningen']."% trent"; } else { $VareInfo = $Bla['utstyr']; }
  $Til = $H['brukernavn'];

  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til,VareInfo) VALUES ('$Pris','$Vare','0','$VareID','$Timestamp','$AnnenDato','$brukernavn','$Til','$VareInfo')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har sendt salgs forespørselen til ".BrukerURL($Til).".</span></td></tr>";
  }}}}
  
  // Selg butikk og fabrikk
  elseif($Vare == 'Gjeng' || $Vare == 'Butikk' || $Vare == 'Kulefabrikk') {  
  if($Vare == 'Gjeng') { $ $Sporring = "SELECT * FROM Gjeng_medlemmer WHERE brukernavn='$brukernavn' AND stilling='Boss'"; }
  elseif($Vare == 'Butikk') {  $Sporring = "SELECT * FROM Butikker WHERE Butikk_eier='$brukernavn' AND id='$VareID'"; }
  elseif($Vare == 'Kulefabrikk') {  $Sporring = "SELECT * FROM Kulefabrikker WHERE KF_Eier='$brukernavn' AND id='$VareID'"; }
  $Finn = mysql_query($Sporring); 
  if(mysql_num_rows($Finn) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke varen på din bruker</span></td></tr>"; } else { 
  $Bla = mysql_fetch_assoc($Finn); 
  if($Vare == 'Gjeng') { $VareID = $Bla['gjeng_id']; $Spor = "SELECT * FROM Auksjon WHERE Vare='$Vare' AND VareID='$VareID'"; } else { $Spor = "SELECT * FROM Auksjon WHERE Selger='$brukernavn' AND Vare='$Vare' AND VareID='$VareID'"; }

  if(mysql_num_rows(mysql_query($Spor))) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Denne varen ligger alt ute for salg.</span></td></tr>"; } else { 
  if($Vare == 'Gjeng') {  $Gjengledere = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE gjeng_id='$VareID' AND stilling='Boss'"); if(mysql_num_rows($Gjengledere) >= '2') { $VareInfo = "Gjeng: ".$rad_B['gjeng']."<br>Du blir deleier"; } else { $VareInfo = "Gjeng: ".$rad_B['gjeng']; }}
  elseif($Vare == 'Butikk') { $VareInfo = "Butikk: ".$Bla['Butikk_Navn']." ( ".$Bla['Butikk_Type']." )<br>Plass: ".$Bla['Butikk_Land']; }
  elseif($Vare == 'Kulefabrikk') { $VareInfo = "Kulefabrikk: ".$Bla['KF_Fabrikk']."<br>Plass: ".$Bla['KF_Sted']; }
  if($Til == "-Ingen-") { 

  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til,VareInfo) VALUES ('$Pris','$Vare','0','$VareID','$Timestamp','$AnnenDato','$brukernavn','$Til','$VareInfo')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har lagt ut $Navn for salg.</span></td></tr>";
  } else { 

  $S_Bruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Til'");
  if(mysql_num_rows($S_Bruker) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren eksisterer ikke.</span></td></tr>"; } else { 
  $H = mysql_fetch_assoc($S_Bruker); 
  if($H['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke selge til deg selv.</span></td></tr>"; } 
  elseif($H['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren er død.</span></td></tr>"; } else { 
  $Til = $H['brukernavn'];

  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til,VareInfo) VALUES ('$Pris','$Vare','0','$VareID','$Timestamp','$AnnenDato','$brukernavn','$Til','$VareInfo')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har sendt salgs forespørselen til ".BrukerURL($Til).".</span></td></tr>";
  }}}}}}
  
  // Selg bil, bot, fly
  elseif($Vare == 'Biler' || $Vare == 'Fly' || $Vare == 'BAtildeyenter') {  
  if($Vare == 'Biler') { $Sporring = "SELECT * FROM garage WHERE eier='$brukernavn' AND TransportEll < '$tiden' AND id='$VareID'"; $VareTo = "Biler"; }
  elseif($Vare == 'Fly') { $Sporring = "SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND id='$VareID' AND Frakt_er='1'"; $VareTo = "Fly"; }
  elseif($Vare == 'BAtildeyenter') { $Sporring = "SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND id='$VareID' AND Frakt_er='2'"; $VareTo = "Båter"; }

  $Spor = mysql_query($Sporring);
  if(mysql_num_rows($Spor) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke varen på din bruker</span></td></tr>"; } 
  elseif(mysql_num_rows(mysql_query("SELECT * FROM Auksjon WHERE Selger='$brukernavn' AND Vare='$VareTo' AND VareID='$VareID'"))) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Denne varen ligger alt ute for salg.</span></td></tr>"; } else { 
  $Bla = mysql_fetch_assoc($Spor); 
  if($Vare == 'Biler') { if($Bla['skade'] <= '0') { $Skade = '0%'; } else { $Skade = floor($Bla['skade'])."%"; } $VareInfo = $Bla['bilmerke']." ( ".Hestekrefter($Bla['bilmerke'])." HK ) ( $Skade skade )<br>Stjelt: ".$Bla['stjelt_fra']." - Plass: ".$Bla['land']; $Navn = $Bla['bilmerke']; }
  elseif($Vare == 'Fly') { $VareInfo = "Fly: ".$Bla['Frakt_navn']; $Navn = $Bla['Frakt_navn']; }
  elseif($Vare == 'BAtildeyenter') { $VareInfo = "Båt: ".$Bla['Frakt_navn']; $Navn = $Bla['Frakt_navn']; }
  if($Til == "-Ingen-") { 

  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til,VareInfo) VALUES ('$Pris','$VareTo','0','$VareID','$Timestamp','$AnnenDato','$brukernavn','$Til','$VareInfo')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har lagt ut $Navn for salg.</span></td></tr>";
  } else { 

  $S_Bruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Til'");
  if(mysql_num_rows($S_Bruker) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren eksisterer ikke.</span></td></tr>"; } else { 
  $H = mysql_fetch_assoc($S_Bruker); 
  if($H['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke selge til deg selv.</span></td></tr>"; } 
  elseif($H['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren er død.</span></td></tr>"; } else { 
  $Til = $H['brukernavn'];
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Auksjon` (Pris,Vare,Antall,VareID,Stamp,Dato,Selger,Til,VareInfo) VALUES ('$Pris','$VareTo','0','$VareID','$Timestamp','$AnnenDato','$brukernavn','$Til','$VareInfo')")or die(mysql_error());
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har sendt salgs forespørselen til ".BrukerURL($Til).".</span></td></tr>";
  }}}}}
    
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig vare.</span></td></tr>"; }
  }
  
  if(empty($rad_B['gjeng'])) { $Gjenge = "Finner ikke gjeng"; } else { $Gjenge = $rad_B['gjeng']; }
  
  echo "
  <tr class=\"Vanlig_2\" id=\"SendMeld\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input id=\"V_Til\" type=\"text\" value=\"Selg til\" onFocus=\"if(this.value=='Selg til')this.value='';\" onblur=\"if(this.value=='')this.value='Selg til';\">
  <input id=\"V_Pris\" type=\"text\" value=\"Pris\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Pris')this.value='';\" onblur=\"if(this.value=='')this.value='Pris';\">
  <select id=\"V_Type\"><option>Poeng</option><option>Respekt</option><option>Bombechips</option><option>Kuler</option><option style=\"margin-top:5px;\">Våpen</option><option>Beskyttelse</option><option style=\"margin-top:5px;\">Gjeng</option><option>Butikk</option><option>Kulefabrikk</option><option style=\"margin-top:5px;\">Biler</option><option>Fly</option><option>Båter</option></select>
  <select id=\"V_Vopen\" class=\"Sjul\">$Vopenliste</select>
  <select id=\"V_Beskyttelse\" class=\"Sjul\">$Beskliste</select>
  <select id=\"V_Butikk\" class=\"Sjul\">$Butikkliste</select>
  <select id=\"V_Fabrikk\" class=\"Sjul\">$Kfliste</select>
  <select id=\"V_Biler\" class=\"Sjul\">$Billiste</select>
  <select id=\"V_Fly\" class=\"Sjul\">$Flyliste</select>
  <select id=\"V_Bot\" class=\"Sjul\">$Botliste</select>
  <input id=\"V_Antall\" class=\"Sjul\" type=\"text\" value=\"Antall\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Antall')this.value='';\" onblur=\"if(this.value=='')this.value='Antall';\">
  <input id=\"V_Gjeng\" class=\"Sjul\" type=\"text\" value=\"$Gjenge\" disabled=\"disabled\">
  <p class=\"Post\" onclick=\"Auksjon()\">Legg ut for salg!</p>
  </td></tr></table></div>";


  $Opp = mysql_query("SELECT * FROM Auksjon WHERE Til='-Ingen-' AND Stamp NOT LIKE '0' ORDER BY `Stamp` DESC LIMIT 700");
  $Tell = '0'; while($i = mysql_fetch_assoc($Opp)) { $Tell++; 
  $Dagen = substr($i['Dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Vare = strtolower($i['Vare']);
  if($Vare == 'poeng' || $Vare == 'respekt' || $Vare == 'bombechips' || $Vare == 'kuler') { 
  $VareVis = "<font style=\"color:#FFFFFF; font-size:10px;\">".VerdiSum($i['Antall'],$Vare)."</font><br>Pris: ".VerdiSum($i['Pris'],'kr');
  } else { $VareVis = "<font style=\"color:#FFFFFF; font-size:10px;\">".$i['VareInfo']."</font><br>Pris: ".VerdiSum($i['Pris'],'kr'); }
  $IdEn = Krypt_Tall($i['id']);
  $Logg = $Logg."<tr class=\"$Klasse Ekstra\" onclick=\"Kjop('$IdEn')\"><td class=\"Linje Plassering\">".BrukerURL($i['Selger'])."</td><td class=\"Linje Plassering\">$VareVis</td><td class=\"Linje Plassering\">$Sjekk".$i['Dato']."</td></tr>"; 
  }
    
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Salgsliste</span></td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Selger</td><td class=\"R_4\">Vare</td><td class=\"R_4\">Lagt ut</td></tr>$Logg";
  echo "</table></div>";
  

  $OpptO = mysql_query("SELECT * FROM Auksjon WHERE Til='$brukernavn' AND Stamp NOT LIKE '0' ORDER BY `Stamp` DESC LIMIT 700");
  $Tell = '0'; while($i = mysql_fetch_assoc($OpptO)) { $Tell++; 
  $Dagen = substr($i['Dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Vare = strtolower($i['Vare']);
  if($Vare == 'poeng' || $Vare == 'respekt' || $Vare == 'bombechips' || $Vare == 'kuler') { 
  $VareVis = "<font style=\"color:#FFFFFF; font-size:10px;\">".VerdiSum($i['Antall'],$Vare)."</font><br>Pris: ".VerdiSum($i['Pris'],'kr');
  } else { $VareVis = "<font style=\"color:#FFFFFF; font-size:10px;\">".$i['VareInfo']."</font><br>Pris: ".VerdiSum($i['Pris'],'kr'); }
  $IdEn = Krypt_Tall($i['id']);
  $LoggTo = $LoggTo."<tr class=\"$Klasse Ekstra\" onclick=\"Kjop('$IdEn')\"><td class=\"Linje Plassering\">".BrukerURL($i['Selger'])."</td><td class=\"Linje Plassering\">$VareVis</td><td class=\"Linje Plassering\">$Sjekk".$i['Dato']."</td></tr>"; 
  }
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Mottatte forespørsler</span></td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Selger</td><td class=\"R_4\">Vare</td><td class=\"R_4\">Lagt ut</td></tr>$LoggTo";
  echo "</table></div>";
  

  $Opptre = mysql_query("SELECT * FROM Auksjon WHERE Selger='$brukernavn' ORDER BY `Stamp` DESC LIMIT 700");
  $Tell = '0'; while($i = mysql_fetch_assoc($Opptre)) { $Tell++; 
  $Dagen = substr($i['Dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Vare = strtolower($i['Vare']);
  if($Vare == 'poeng' || $Vare == 'respekt' || $Vare == 'bombechips' || $Vare == 'kuler') { 
  $VareVis = "<font style=\"color:#FFFFFF; font-size:10px;\">".VerdiSum($i['Antall'],$Vare)."</font><br>Pris: ".VerdiSum($i['Pris'],'kr');
  } else { $VareVis = "<font style=\"color:#FFFFFF; font-size:10px;\">".$i['VareInfo']."</font><br>Pris: ".VerdiSum($i['Pris'],'kr'); }
  $IdEn = Krypt_Tall($i['id']);
  $LoggTre = $LoggTre."<tr class=\"$Klasse Ekstra\" onclick=\"Trekk('$IdEn')\"><td class=\"Linje Plassering\">".BrukerURL($i['Selger'])."</td><td class=\"Linje Plassering\">$VareVis</td><td class=\"Linje Plassering\">$Sjekk".$i['Dato']."</td></tr>"; 
  }
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Dine varer tilsalgs</span></td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Selges ut til</td><td class=\"R_4\">Vare</td><td class=\"R_4\">Lagt ut</td></tr>$LoggTre";
  echo "</table></div>";
  
  }}
  ?>
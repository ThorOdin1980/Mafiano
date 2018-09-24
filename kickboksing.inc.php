  <?php
  if(basename($_SERVER['PHP_SELF']) == "kickboksing.inc.php") { header("Location: index.php"); exit; } else {
  
  
  
  // Noen funksjoner
  function KickLevel($L) { $L = floor($L); if($L >= '10') { $R = 'Amøbe'; } if($L >= '15') { $R = 'Pyse'; } if($L >= '20') { $R = 'Eplekjekk'; } if($L >= '25') { $R = 'Amatør'; } if($L >= '30') { $R = 'Pøbel'; } if($L >= '35') { $R = 'Tøff'; } if($L >= '40') { $R = 'Råtøff'; } if($L >= '45') { $R = 'Flink'; } if($L >= '50') { $R = 'Erfaren'; } if($L >= '55') { $R = 'Fighter'; } if($L >= '60') { $R = 'Dreven fighter'; } if($L >= '65') { $R = 'Plugg'; } if($L >= '70') { $R = 'Hardbarka'; } if($L >= '75') { $R = 'Slosskjempe'; } if($L >= '85') { $R = 'Harbarka slosskjempe'; } if($L >= '95') { $R = 'Brutal fighter'; } return $R; }
  function KampSnitt($vinn,$ant) { $Snitt = ($vinn / $ant) * '100'; return $Snitt; }
  function KickBilde($L,$K) { if($K == 'Gutt') { if($L >= '70') { $B = "trent_kick_mann"; } elseif($L >= '30') { $B = "bra_kick_mann"; } else { $B = "feit_kick_mann"; }} elseif($K == 'Jente') { if($L >= '70') { $B = "trent_kick_dame"; } elseif($L >= '30') { $B = "passe_kick_dame"; } else { $B = "feit_kick_dame"; }} return $B; }
  function Gain($Lvl) { $Lvl = floor($Lvl); if($Lvl >= '90') { $G = '1.0'; } elseif($Lvl >= '80') { $G = '0.9'; } elseif($Lvl >= '70') { $G = '0.8'; } elseif($Lvl >= '60') { $G = '0.7'; } elseif($Lvl >= '50') { $G = '0.6'; } elseif($Lvl >= '40') { $G = '0.5'; } elseif($Lvl >= '30') { $G = '0.4'; } elseif($Lvl >= '20') { $G = '0.3'; } elseif($Lvl >= '10') { $G = '0.2'; } else { $G = '0.1'; } return $G; }
  function Vinner($Lvl_1,$Skills_1,$Lvl_2,$Skills_2) { $Lvl_1 = floor($Lvl_1); $Lvl_2 = floor($Lvl_2); $Skills_1 = floor($Skills_1); $Skills_2 = floor($Skills_2); if($Lvl_1 == $Lvl_2) { if($Skills_1 > $Skills_2) { $Vinner = 'Deg'; } else { $Vinner = 'Motstander'; }} elseif($Lvl_1 > $Lvl_2) { $Vinner = 'Deg'; } else { $Vinner = 'Motstander'; } return $Vinner; }
  function EnergiBar($Lvl) { $Lvl = floor($Lvl); if($Lvl >= '100000') { $R = $Lvl / '10000'; } elseif($Lvl >= '10000') { $R = $Lvl / '1000'; } elseif($Lvl >= '1000') { $R = $Lvl / '100'; } elseif($Lvl >= '100') { $R = $Lvl / '10'; } else { $R = $Lvl; } return $R; }
  function EnergiNiva($Lvl) { $Lvl = floor($Lvl); if($Lvl >= '100000') { $R = 'Fantastisk'; } elseif($Lvl >= '10000') { $R = 'Veldig bra'; } elseif($Lvl >= '1000') { $R = 'Bra'; } elseif($Lvl >= '100') { $R = 'Passe'; } else { $R = 'Dårlig'; } return $R; }

  if((date("H") == '00' || date("H") == '03' || date("H") == '06' || date("H") == '09' || date("H") == '12' || date("H") == '15' || date("H") == '18' || date("H") == '21')) { 

  $Up = mysql_query("SELECT * FROM Kickrunde WHERE Arena LIKE '%'");
  while($UpI = mysql_fetch_assoc($Up)) {  
  if($Timestamp > $UpI['Stamp']) {
  if($UpI['Arena'] == 'Gatekamp') { include "GatekampUp.inc.php"; }
  elseif($UpI['Arena'] == 'Rank arena') { include "RankarenaUp.inc.php"; }
  elseif($UpI['Arena'] == 'Respekt arena') { include "RespektarenaUp.inc.php"; }
  elseif($UpI['Arena'] == 'Boost arena') { include "BoostarenaUp.inc.php"; }
  }}}
  
  if($rad_B['rank_nivaa'] < '3') { 
  if($Kjon == 'Gutt') { $Krav = 'Bråkmaker'; } else { $Krav = 'Forførerske'; }
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Kickboksing</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/kickboxing.jpg\"></td></tr>
  <tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente til du har oppnåd ranken $Krav.</span></td></tr>
  </table></div>
  ";
  } else { 

  $Sjekk = mysql_query("SELECT * FROM Kickboksing WHERE Bruker='$brukernavn'");
  if(mysql_num_rows($Sjekk) > '0') { 
  $i = mysql_fetch_assoc($Sjekk);
  $Trenstamp = $i['Trenstamp'];
  $Fightstamp = $i['Figthstamp'];
  $DittKallenavn = $i['Kallenavn'];

  if($_GET['Turnering']) { 

  echo "
  <script>
  function Utfordre(Arena,Ft) { 
  var Arena = encodeURI(Arena);
  var Ft = encodeURI(Ft);
  $('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena='+Arena+'&Ft='+Ft);
  $('html, body').animate({scrollTop:100}, 'slow');
  }
  </script>
  ";

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"6\"><span style=\"float:left; line-height:30px;\">Kickboksing</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True')\">( Kamper )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing')\">( Trening )</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"6\"><img border=\"0\" src=\"../Bilder/kickboxing.jpg\"></td></tr>";
  
  if($_GET['Ft']) {
  $Ft = Dekrypt_Tall(Mysql_Klar($_GET['Ft']));
  $Arenaen = Mysql_Klar($_GET['Arena']);
  if(empty($Ft)) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ugyldig valg</span></td></tr>"; } else { 

  $Deg = mysql_query("SELECT * FROM KickListe WHERE Brukernavn='$brukernavn' AND Arena='$Arenaen'");
  if(mysql_num_rows($Deg) == '0') { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du er ikke med i turneringen, bli med i turneringen på bunnen av siden.</span></td></tr>"; } else {
  $Sjekk = mysql_query("SELECT KickListe.*,Kickboksing.Skills,Kickboksing.Level FROM KickListe INNER JOIN Kickboksing ON KickListe.Brukernavn=Kickboksing.Bruker WHERE KickListe.Arena='$Arenaen' AND KickListe.id='$Ft'");
  if(mysql_num_rows($Sjekk) == '0') { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke fighteren.</span></td></tr>"; } else {
  $Sloss = mysql_fetch_assoc($Sjekk);
  $SlossVent = $Fightstamp - $Timestamp;
  $TiPros = floor($Sloss['Sum'] / '100' * '10');
  
  if($Sloss['Brukernavn'] == $brukernavn) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke utfordre deg selv.</span></td></tr>"; } 
  elseif($Fightstamp > $Timestamp) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente <font id=\"SlossVent\" class=\"TellNed\">$SlossVent</font> sekunder før du kan sloss.</span></td></tr>"; }
  elseif($TiPros > $rad_B['penger']) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger på hånda.</span></td></tr>"; } else {
  if(Vinner($i['Level'],$i['Skills'],$Sloss['Level'],$Sloss['Skills']) == 'Deg') { 
  
  // Du vinner
  $Cash = floor($rad_B['penger'] + $TiPros);
  $NySkill = $i['Skills'] + Gain($Sloss['Level']);
  $NyStamp = $Timestamp + '90';
  $ListeCash = floor($Sloss['Sum'] - $TiPros);
  $Motstander = $Sloss['Brukernavn'];
  $DuGainer = Gain($Sloss['Level']);
    
  mysql_query("UPDATE brukere SET penger='$Cash',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE Kickboksing SET Kamper=`Kamper`+'1',Vunnet=`Vunnet`+'1',Skills='$NySkill',Figthstamp='$NyStamp' WHERE Bruker='$brukernavn'");
  mysql_query("UPDATE Kickboksing SET Kamper=`Kamper`+'1',Tapt=`Tapt`+'1' WHERE Bruker='$Motstander'");
  mysql_query("UPDATE KickListe SET Vinn=`Vinn`+'1',Rang=`Rang`+'$DuGainer' WHERE Brukernavn='$brukernavn'");
  mysql_query("UPDATE KickListe SET Tap=`Tap`+'1',Sum='$ListeCash',Rang=`Rang`-'0.2' WHERE Brukernavn='$Motstander'");
  echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du vant, pengene er plassert på din bruker.</span></td></tr>";
  } else { 
 
  // Du taper
  $Cash = floor($rad_B['penger'] - $TiPros);
  $NyStamp = $Timestamp + '90';
  $NySkill = $Sloss['Skills'] + Gain($i['Level']);
  $ListeCash = floor($Sloss['Sum'] + $TiPros);
  $LCS = VerdiSum($ListeCash,'kr');
  $Motstander = $Sloss['Brukernavn'];
  $HanGainer = Gain($i['Level']);

  
  mysql_query("UPDATE brukere SET penger='$Cash',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE Kickboksing SET Kamper=`Kamper`+'1',Tapt=`Tapt`+'1',Figthstamp='$NyStamp' WHERE Bruker='$brukernavn'");
  mysql_query("UPDATE Kickboksing SET Kamper=`Kamper`+'1',Vunnet=`Vunnet`+'1',Skills='$NySkill' WHERE Bruker='$Motstander'");
  mysql_query("UPDATE KickListe SET Tap=`Tap`+'1',Rang=`Rang`-'0.2' WHERE Brukernavn='$brukernavn'");
  mysql_query("UPDATE KickListe SET Vinn=`Vinn`+'1',Sum='$ListeCash',Rang=`Rang`+'$HanGainer' WHERE Brukernavn='$Motstander'");
  echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du tapte.</span></td></tr>";
  }}}}}}
  elseif($_GET['LeggUt']) { 
  $Arenaen = Mysql_Klar($_GET['Arena']);
  $Summen = Bare_Siffer(Mysql_Klar($_GET['LeggUt']));
  if($Arenaen == 'Boost arena' || $Arenaen == 'Rank arena' || $Arenaen == 'Respekt arena' || $Arenaen == 'Gatekamp' || $Arenaen == 'MN Arena' || $Arenaen == 'Blodkamp') { 
  $DineMedlajer = $i['Gull'] + $i['Solv'] + $i['Bronsje'];
  if($Arenaen == 'Boost arena') { $Medaljer = '20'; }
  elseif($Arenaen == 'Rank arena') { $Medaljer = '4'; }
  elseif($Arenaen == 'Respekt arena') { $Medaljer = '6'; } 
  elseif($Arenaen == 'MN Arena') { $Medaljer = '2'; } else { $Medaljer = '0'; }

  $Se = mysql_query("SELECT * FROM KickListe WHERE Brukernavn='$brukernavn'");
  if(mysql_num_rows($Se) > '0') { $SeI = mysql_fetch_assoc($Se); echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du ligger alt ute på ".$SeI['Arena'].".</span></td></tr>"; }
  elseif($Medaljer > $DineMedlajer) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må ha $Medaljer medaljer for å delta her.</span></td></tr>"; }
  elseif(empty($Summen)) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Summen mangler.</span></td></tr>"; } 
  elseif($Summen > '999999999' || $Summen < '100000') { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 100.000 kr og maksimum 999.999.999 kr.</span></td></tr>"; }
  elseif($Summen > $rad_B['penger']) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger på hånda.</span></td></tr>"; } else {
  $NySpenn = floor($rad_B['penger'] - $Summen);
  mysql_query("INSERT INTO `KickListe` (Brukernavn,Bruker,Dato,Stamp,Sum,Arena) VALUES ('$brukernavn','".$i['Kallenavn']."','$AnnenDato','$Timestamp','$Summen','$Arenaen')");
  mysql_query("UPDATE brukere SET penger='$NySpenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har lagt deg ut på listen.</span></td></tr>";
  }}}
  
  echo "
  <tr class=\"R_8\" height=\"45px\"><td class=\"Turnering\" colspan=\"6\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena=Boost+arena')\">Boost arena</td></td></tr>
  ";
  // When rankarena is done add onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena=Rank+arena')\"
  echo "
  <tr class=\"R_8\" height=\"35px\"><td class=\"Turnering\" colspan=\"3\" width=\"244px\"  >Rank arena (Dekativert)</td><td class=\"Turnering\" colspan=\"3\" width=\"244px\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena=Respekt+arena')\">Respekt arena</td></tr>
  <tr class=\"R_8\" height=\"25px\"><td class=\"Turnering\" colspan=\"2\" width=\"33.33%\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena=Gatekamp')\">Gatekamp</td><td class=\"Turnering\" colspan=\"2\" width=\"33.33%\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena=MN+Arena')\">MN Arena</td><td class=\"Turnering\" colspan=\"2\" width=\"33.33%\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena=Blodkamp')\">Blodkamp</td></tr>
  </table></div>";
  
  if($_GET['Arena']) { 
  $Arena = Mysql_Klar($_GET['Arena']);
  if($Arena == 'Boost arena' || $Arena == 'Rank arena' || $Arena == 'Respekt arena' || $Arena == 'Gatekamp' || $Arena == 'MN Arena' || $Arena == 'Blodkamp') { 

  $GetListe = mysql_query("SELECT * FROM KickListe WHERE Arena='$Arena' ORDER BY Rang DESC");
  
  if($Arena == 'MN Arena') { $List = "<tr><td colspan=\"4\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Under utvikling.</span></td></tr>"; }
  elseif($Arena == 'Blodkamp') { $List = "<tr><td colspan=\"4\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Under utvikling.</span></td></tr>"; }
  elseif(mysql_num_rows($GetListe) == '0') { $List = "<tr><td colspan=\"4\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Det er ingen på listen.</span></td></tr>"; } else {
  $Tell = '0';
  while($Li = mysql_fetch_assoc($GetListe)) { 
  $Tell++;
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  $TiPros = $Li['Sum'] / '100' * '10';
  $FakeID = Krypt_Tall($Li['id']);
  $List = $List."<tr class=\"$Klasse Ekstra\" onclick=\"Utfordre('$Arena','$FakeID')\"><td class=\"Linje Plassering\">$Tell</td><td class=\"Linje Plassering\">".$Li['Bruker']."</td><td class=\"Linje Plassering\">".VerdiSum($TiPros,'kr')."</td><td class=\"Linje Plassering\">".$Li['Dato']."</td></tr>";

  }}
  
  // Html
  if(empty($Klasse)) { $Klasse = 'Vanlig_1'; } elseif($Klasse == 'Vanlig_1') { $Klasse = 'Vanlig_2'; } elseif($Klasse == 'Vanlig_2') { $Klasse = 'Vanlig_1'; }
  
  echo "
  <script>
  $('#LeggUtFighter').click(function() { 
  if($('#SumFighterTotal').val() == '' || $('#SumFighterTotal').val() == 'Sum') { alert('Summen mangler.'); } else {
  if($('#SumFighterTotal').val().length > 9) { alert('Maksimum 999.999.999 kr'); }
  else if ($('#SumFighterTotal').val().length < 6) { alert('Minimum 100.000 kr'); } else {
  var Sum = encodeURI($('#SumFighterTotal').val());
  var Side = encodeURI('".$Arena."');
  $('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True&Arena='+Side+'&LeggUt='+Sum);
  $('html, body').animate({scrollTop:100}, 'slow');
  }}});
  </script>
  ";
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"4\"><span style=\"float:left; line-height:30px;\">$Arena</span></td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">#</td><td class=\"R_4\">Figther</td><td class=\"R_4\">Sum</td><td class=\"R_4\">Dato</td></tr>";
  echo $List;
  if($Arena == 'Gatekamp' || $Arena == 'Respekt arena' || $Arena == 'Rank arena' || $Arena == 'Boost arena') { echo "<tr class=\"$Klasse\"><td colspan=\"4\" class=\"Linje Send\" style=\"padding-bottom:9px;\"><input type=\"text\" id=\"SumFighterTotal\" value=\"Sum\" maxlength=\"9\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"><p class=\"Post\" id=\"LeggUtFighter\">Legg til figther!</p></td></tr>"; }
  echo "</table></div>";
  
  }}
  
  } else {
  
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Kickboksing</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Turnering=True')\">( Kamper )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kickboksing')\">( Trening )</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/kickboxing.jpg\"></td></tr>";
  
  if($_GET['Tren'] == 'energi') { 
  $SekVente = $Trenstamp - $Timestamp;
  if($Trenstamp > $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente <font id=\"KickVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>"; } else { 
  $NySkills = $i['Skills'] + '5.5';
  $TidVente = $Timestamp + '200';

  mysql_query("UPDATE Kickboksing SET Skills='$NySkills',Trenstamp='$TidVente' WHERE Bruker='$brukernavn'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $SekVente = $TidVente - $Timestamp;
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har startet treningen, den varer i <font id=\"KickVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>";
  }}
  elseif($_GET['Tren'] && $i['Level'] < '100') { 
  $Trene = Mysql_Klar($_GET['Tren']);
  $SekVente = $Trenstamp - $Timestamp;
  if($Trenstamp > $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente <font id=\"KickVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>"; }
  elseif($Trene == '2Min' || $Trene == '6Min' || $Trene == '12Min') { 
  if($Trene == '2Min') { $Gain = '0.2'; $Venta = '120'; } elseif($Trene == '6Min') { $Gain = '0.4'; $Venta = '360'; } elseif($Trene == '12Min') { $Gain = '0.6'; $Venta = '720'; }
  $NyLevl = $i['Level'] + $Gain;
  $TidVente = $Timestamp + $Venta;
  if($NyLevl >= '100') { $NyLevl = '100'; }

  mysql_query("UPDATE Kickboksing SET Level='$NyLevl',Trenstamp='$TidVente' WHERE Bruker='$brukernavn'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $SekVente = $TidVente - $Timestamp;
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har startet treningen, den varer i <font id=\"KickVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>";
  }}
  
  echo "
  <script> 
  $('.Post').click(function() {
  var Iden = this.id; 
  if(Iden == '2Min' || Iden == '6Min' || Iden == '12Min' || Iden == 'energi') {
  var Iden = encodeURI(Iden);
  $('#SB_Midten2').load('post.php?du_valgte=Kickboksing&Tren='+Iden);
  }});
  </script>";
  
  echo "
  <tr><td class=\"R_8\"><span style=\"width: 480px; float: left; margin:5px; color:#FFFFFF; font-size:13px; filter:alpha(opacity=60); opacity:0.6;\">
  <img style=\"float:left; margin-left:2px;\" src=\"../Bilder/".KickBilde($i['Level'],$Kjon).".jpg\"><span class=\"KickInfo\">
  <span><p>".$i['Kallenavn']."</p><p>".$i['Registrert']."</p></span><span>Kamper: ".VerdiSum($i['Kamper'],'stk')."<br>Kamper vunnet: ".VerdiSum($i['Vunnet'],'stk')."<br>Kamper tapt: ".VerdiSum($i['Tapt'],'stk')."</span><span>Gull medlajer: ".VerdiSum($i['Gull'],'stk')."<br>Sølv medlajer: ".VerdiSum($i['Solv'],'stk')."<br>Bronsje medlajer: ".VerdiSum($i['Bronsje'],'stk')."</span><span style=\"height:70px;\"><b>Siste plasseringer</b></span></span>
  <table style=\"font-family: Arial; font-size: 12px;\">
  <tr><td><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".KampSnitt($i['Vunnet'],$i['Kamper'])."%; overflow:hidden;\"><p>Snitt (kamper vunnet)</p></div></div></td></tr>
  <tr><td><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".EnergiBar($i['Skills'])."%; overflow:hidden;\"><p>Energi: ".EnergiNiva($i['Skills'])."</p></div></div></td></tr>
  <tr><td><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".floor($i['Level'])."%; overflow:hidden;\"><p>Nivå: ".KickLevel($i['Level'])."</p></div></div></td></tr>
  </table>";
  if($i['Level'] < '100') { echo "<p class=\"Post\" id=\"12Min\">Tren 12 min - 06%</p><p class=\"Post\" id=\"6Min\">Tren 6 min - 04%</p><p class=\"Post\" id=\"2Min\">Tren 2 min - 02%</p>"; } else { echo "<p class=\"Post\" id=\"energi\">Tren energi</p>"; }
  echo "</span></tr></td></table></div>";



  }} else { 
  
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Kickboksing</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/kickboxing.jpg\"></td></tr>
  ";
  
  if($_GET['BliMedlem']) {
  $Kallenavn = Bare_BS(Mysql_Klar($_GET['BliMedlem']));
  if($rad_B['penger'] < '600000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger på hånda</span></td></tr>"; } 
  elseif(mysql_num_rows(mysql_query("SELECT * FROM Kickboksing WHERE Kallenavn='$Kallenavn'")) > '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Kallenavn er alt ibruk, velg et annet kallenavn.</span></td></tr>"; } else {
  $NySpenn = floor($rad_B['penger'] - '600000');
  mysql_query("INSERT INTO `Kickboksing` (Bruker,Kallenavn,Registrert,Stamp) VALUES ('$brukernavn','$Kallenavn','$AnnenDato','$Timestamp')");
  mysql_query("UPDATE brukere SET penger='$NySpenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "
  <script> 
  $(document).ready( function() { $('#SB_Midten2').load('post.php?du_valgte=Kickboksing'); });
  </script>";
  }}
  
  echo "
  <script>
  function Send() { 
  if($('#Kallenavn').val() == 'Kallenavn' || $('#Kallenavn').val() == '') { alert('Du må plotte inn ett kallenavn.'); } 
  else if($('#Kallenavn').val().length > 25) { alert('Kallenavnet er for langt.'); } else { 
  var Kallenavn = encodeURI($('#Kallenavn').val());
  $('#SB_Midten2').load('post.php?du_valgte=Kickboksing&BliMedlem='+Kallenavn);
  }}
  </script>
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Kallenavn\" value=\"Kallenavn\" maxlength=\"24\" onFocus=\"if(this.value=='Kallenavn')this.value='';\" onblur=\"if(this.value=='')this.value='Kallenavn';\">
  <p class=\"Post\" onclick=\"Send()\">600.000 kr - Bli medlem!</p>
  </td></tr></table></div>";

  }}
  
  }
  ?>
  <style>
  .B_ramme { float: left;width: 480px; margin:5px; filter:alpha(opacity=60); opacity:0.6; }
  .Bane_Info { float:left; margin-left:5px; width:258px; height:106px; background-color: #434343; padding-left:5px; }
  .Bane_Info p { float:left; width:243px; margin-top:2px; background-color: #CCCCCC; padding-top:2px; padding-bottom:2px; padding-left:5px; padding-right:5px; font-size:11px; }
  .Bane_Info p:first-child { margin-top:5px; }
  .Bane_Info p font { float:right; font-weight:bold; text-align:right; }
  </style>
  
  <?php
  if(basename($_SERVER['PHP_SELF']) == "Bilrace.inc.php") { header("Location: index.php"); exit; } else {
  
  // Noen funksjoner
  function EmneFlink($L,$S) { $L = floor($L); if($L >= '5') { $R = 'Pysete'; } if($L >= '10') { $R = 'Prøvekanin'; } if($L >= '20') { $R = 'Passe'; } if($L >= '30') { $R = 'Duger'; } if($L >= '40') { $R = 'Erfaren'; } if($L >= '50') { $R = 'Flink'; } if($L >= '60') { $R = 'Dreven'; } if($L >= '70') { $R = 'Mester'; } if($L >= '80') { $R = 'Unik'; } if($L >= '90') { $R = "Turbo sjåfør"; } if($L >= '100') { $R = "Turbo sjåfør - <span style=\"font-size:9px; vertical-align: middle;\">( Erfaring: $S )</span>"; } return $R; }
  function KampSnitt($vinn,$ant) { $Snitt = ($vinn / $ant) * '100'; return $Snitt; }
  function Hestekrefter($Merke) { if($Merke == 'Opel Calibra') { $HK = '160'; } elseif($Merke == 'Audi TT') { $HK = '225'; } elseif($Merke == 'Suziki XL-7') { $HK = '109'; } elseif($Merke == 'Suzuki XL-7') { $HK = '109'; } elseif($Merke == 'Toyota Supera') { $HK = '235'; } elseif($Merke == 'Toyota Supra') { $HK = '235'; } elseif($Merke == 'Nissan Skyline GT-R') { $HK = '250'; } elseif($Merke == 'Peugot 307 SW') { $HK = '90'; } elseif($Merke == 'Saab 9-5') { $HK = '120'; } elseif($Merke == 'Nissan 100 NX') { $HK = '100'; } elseif($Merke == 'Honda Civic 1,6') { $HK = '125'; } elseif($Merke == 'Lada Niva') { $HK = '80'; } elseif($Merke == 'Chrysler Neon') { $HK = '133'; } elseif($Merke == 'Ford Escort 1,4') { $HK = '87'; } elseif($Merke == 'Volvo 240') { $HK = '85'; } elseif($Merke == 'Mazda RX-8') { $HK = '240'; } elseif($Merke == 'Volkswagen golf 1,8 GT') { $HK = '90'; } elseif($Merke == 'Mercedes-Benz SLK') { $HK = '170'; } elseif($Merke == 'Range Rover 3.0 Td6') { $HK = '180'; } elseif($Merke == 'Porsche 944') { $HK = '200'; } elseif($Merke == 'Bmw 3-serie') { $HK = '160'; } elseif($Merke == 'Jaguar XKR 4,2') { $HK = '300'; } else { $HK = '0'; } return $HK; }
  function FinnVinner($Lvl,$Score,$Merke,$Baneniva,$Krasj) { $Skills = floor(($Lvl + $Score) + rand(2,10)); if($Baneniva >= '50') { $Baneniva = '50'; } if($Merke == 'Opel Calibra') { $HK = '16'; } elseif($Merke == 'Audi TT') { $HK = '22'; } elseif($Merke == 'Suziki XL-7') { $HK = '10'; } elseif($Merke == 'Suzuki XL-7') { $HK = '10'; } elseif($Merke == 'Toyota Supera') { $HK = '23'; } elseif($Merke == 'Toyota Supra') { $HK = '23'; } elseif($Merke == 'Nissan Skyline GT-R') { $HK = '25'; } elseif($Merke == 'Peugot 307 SW') { $HK = '9'; } elseif($Merke == 'Saab 9-5') { $HK = '12'; } elseif($Merke == 'Nissan 100 NX') { $HK = '10'; } elseif($Merke == 'Honda Civic 1,6') { $HK = '12'; } elseif($Merke == 'Lada Niva') { $HK = '8'; } elseif($Merke == 'Chrysler Neon') { $HK = '13'; } elseif($Merke == 'Ford Escort 1,4') { $HK = '8'; } elseif($Merke == 'Volvo 240') { $HK = '8'; } elseif($Merke == 'Mazda RX-8') { $HK = '24'; } elseif($Merke == 'Volkswagen golf 1,8 GT') { $HK = '9'; } elseif($Merke == 'Mercedes-Benz SLK') { $HK = '17'; } elseif($Merke == 'Range Rover 3.0 Td6') { $HK = '18'; } elseif($Merke == 'Porsche 944') { $HK = '20'; } elseif($Merke == 'Bmw 3-serie') { $HK = '16'; } elseif($Merke == 'Jaguar XKR 4,2') { $HK = '30'; } else { $HK = '2'; } $HK = floor($HK * '3');  $Dele = floor($Baneniva + $HK); $Pros = floor(($Skills / '100') * $Dele); $Skills = floor($Pros + $Skills); if($HK == '2') { $Skade = array("Mangler bil","Mangler bil"); } elseif($Krasj >= '95') { $Skade = array("Starter ikke","Starter ikke"); } elseif($Krasj >= '80') { $Skade = array("Bra","Ut","Ut","Ut","Ut","Ut","Ut","Ut","Ut","Bra"); } elseif($Krasj >= '50') { $Skade = array("Bra","Ut","Bra","Ut","Ut","Ut","Ut","Bra","Ut","Bra"); } elseif($Krasj >= '30') { $Skade = array("Bra","Ut","Bra","Ut","Bra","Bra","Ut","Bra","Ut","Bra"); } elseif($Krasj >= '10') { $Skade = array("Bra","Bra","Bra","Ut","Bra","Bra","Ut","Bra","Bra","Bra"); } else { $Skade = array("Bra","Bra"); } $Skade = $Skade[array_rand($Skade)]; if($Skade != 'Bra') { return $Skade; } else { return $Skills; }}
  function BaneSkills($Bane,$Verdier) { $Verdi = explode(",",$Verdier); if($Bane == 'Arntunet') { $r = $Verdi['0']; } elseif($Bane == 'Vinter treffet') { $r = $Verdi['1']; } elseif($Bane == 'Grus runden') { $r = $Verdi['2']; } elseif($Bane == 'Landmark') { $r = $Verdi['3']; } elseif($Bane == 'Garagen') { $r = $Verdi['4']; } elseif($Bane == 'Drift track') { $r = $Verdi['5']; } elseif($Bane == '10 runder') { $r = $Verdi['6']; } elseif($Bane == 'Pro track') { $r = $Verdi['7']; } elseif($Bane == 'Gardermoen') { $r = $Verdi['8']; } elseif($Bane == 'Bykamp') { $r = $Verdi['9']; } elseif($Bane == 'Cobra race') { $r = $Verdi['10']; } elseif($Bane == '2km race') { $r = $Verdi['11']; } return $r; }
  function NyBaneSkill($Bane,$Verdier,$Pluss) { $Verdi = explode(",",$Verdier); if($Bane == 'Arntunet') { $Verdi['0'] = $Verdi['0'] + $Pluss; } elseif($Bane == 'Vinter treffet') { $Verdi['1'] = $Verdi['1'] + $Pluss; } elseif($Bane == 'Grus runden') { $Verdi['2'] = $Verdi['2'] + $Pluss; } elseif($Bane == 'Landmark') { $Verdi['3'] = $Verdi['3'] + $Pluss; } elseif($Bane == 'Garagen') { $Verdi['4'] = $Verdi['4'] + $Pluss; } elseif($Bane == 'Drift track') { $Verdi['5'] = $Verdi['5'] + $Pluss; } elseif($Bane == '10 runder') { $Verdi['6'] = $Verdi['6'] + $Pluss; } elseif($Bane == 'Pro track') { $Verdi['7'] = $Verdi['7'] + $Pluss; } elseif($Bane == 'Gardermoen') { $Verdi['8'] = $Verdi['8'] + $Pluss; } elseif($Bane == 'Bykamp') { $Verdi['9'] = $Verdi['9'] + $Pluss; } elseif($Bane == 'Cobra race') { $Verdi['10'] = $Verdi['10'] + $Pluss; } elseif($Bane == '2km race') { $Verdi['11'] = $Verdi['11'] + $Pluss; } return implode(",",$Verdi); }
  function Vurdering($Skill,$Total) { $Skill = floor($Skill); $Total = floor($Total); $Snitt = floor(($Skill / $Total) * '100'); return $Snitt."%"; }


  $Sjekk = mysql_query("SELECT * FROM Bilrace WHERE Brukernavn='$brukernavn'");
  if(mysql_num_rows($Sjekk) > '0') { 
  $i = mysql_fetch_assoc($Sjekk);
  $Trenstamp = $i['Trenstamp'];
  $BilID = $i['BilID'];
  
  if($BilID == 'Ingen') { $BilEr = 'Ingen bil'; } else { 
  
  $HBil = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND id='$BilID'");
  if(mysql_num_rows($HBil) == '0') { $BilEr = 'Du har ikke bilen lengere'; } else { 
  $GBil = mysql_fetch_assoc($HBil);
  $Hester = Hestekrefter($GBil['bilmerke'])." Hestekrefter";
  
  if($GBil['TransportEll'] > $Timestamp) { $BilEr = "".$GBil['bilmerke']." <font style=\"font-size:10px; color:#e40404;\">(fraktes)</font><br><font style=\"font-size:12px;\">$Hester</font>"; }
  elseif($GBil['skade'] > '0') { $BilEr = "".$GBil['bilmerke']." <font style=\"font-size:10px; color:#e40404;\">(skadet)</font><br><font style=\"font-size:12px;\">$Hester</font>"; } 
  else { $BilEr = "".$GBil['bilmerke']."<br><font style=\"font-size:12px;\">$Hester</font>"; }
  
  }}
  

  if($_GET['RaceTrack']) { 
  
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Bilrace</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bilrace&RaceTrack=True')\">( Arrangement )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bilrace')\">( Trening )</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/Bilrace.jpg\"></td></tr>";
  
  if($_GET['Sats']) { 
  $Areni = Mysql_Klar($_GET['Arena']);
  $Satse = Bare_Siffer(Mysql_Klar($_GET['Sats']));
  if(($Areni == 'Rally' || $Areni == 'Drift' || $Areni == 'Drag') && !empty($Satse)) {

  $ListeSjekk = mysql_query("SELECT * FROM BilListe WHERE Brukernavn='$brukernavn'");
  $BilSjekk = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND id='$BilID' AND TransportEll < '$Timestamp'");
  if(mysql_num_rows($ListeSjekk) > '0') { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du ligger alt ute på et race.</span></td></tr>"; } 
  elseif(mysql_num_rows($BilSjekk) == '0') { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Finner ikke bilen din, kansje den transporteres.</span></td></tr>"; } 
  elseif($Satse > '9999999' || $Satse < '1000') { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 1.000 kr, maksimum 9.900.000 kr.</span></td></tr>"; }
  elseif(($Satse + '150000') > $rad_B['penger']) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger på hånda.</span></td></tr>"; }
  elseif('100' > $rad_B['respekt']) { echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok respekt.</span></td></tr>"; } else {
  $NySpenn = floor($rad_B['penger'] - ($Satse + '150000'));
  $NyRespekt = floor($rad_B['respekt'] - '100');
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('$brukernavn','$Satse','$AnnenDato','$Timestamp','$Areni')")or die(mysql_error());
  mysql_query("UPDATE brukere SET penger='$NySpenn',respekt='$NyRespekt',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td colspan=\"6\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du er nå påmeldt.</span></td></tr>";
  }}}
  
  echo "
  <tr class=\"R_8\" height=\"25px\"><td class=\"Turnering\" width=\"33.33%\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bilrace&RaceTrack=True&Arena=Rally')\">Rally</td><td class=\"Turnering\" width=\"33.33%\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bilrace&RaceTrack=True&Arena=Drift')\">Drift</td><td class=\"Turnering\" width=\"33.33%\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bilrace&RaceTrack=True&Arena=Drag')\">Drag</td></tr>
  </table></div>";
  
  if($_GET['Arena']) { 
  $Arena = Mysql_Klar($_GET['Arena']);
  if($Arena == 'Rally' || $Arena == 'Drift' || $Arena == 'Drag') { 
  
  // Til vurdering
  if($Arena == 'Rally') { $LvlM = 'Bilrace.RallyLvl'; $ScoM = 'Bilrace.RallyScore'; }
  elseif($Arena == 'Drift') { $LvlM = 'Bilrace.DriftLvl'; $ScoM = 'Bilrace.DriftScore'; }
  elseif($Arena == 'Drag') { $LvlM = 'Bilrace.DragLvl'; $ScoM = 'Bilrace.DragScore'; }
  
  // Hent bane

  $Bane = mysql_query("SELECT * FROM BilRunde WHERE Arena='$Arena'");
  $Binf = mysql_fetch_assoc($Bane);
  $StartTid = $Binf['StampStart'] - $Timestamp;

  if($Binf['Bane'] == 'Arntunet') { $Track = '../Design/RallyEn.jpg'; }
  elseif($Binf['Bane'] == 'Vinter treffet') { $Track = '../Design/RallyTo.jpg'; }
  elseif($Binf['Bane'] == 'Grus runden') { $Track = '../Design/RallyTre.jpg'; }
  elseif($Binf['Bane'] == 'Landmark') { $Track = '../Design/RallyFire.jpg'; }
  elseif($Binf['Bane'] == 'Garagen') { $Track = '../Design/DriftEn.jpg'; }
  elseif($Binf['Bane'] == 'Drift track') { $Track = '../Design/DriftTo.jpg'; }
  elseif($Binf['Bane'] == '10 runder') { $Track = '../Design/DriftTre.jpg'; }
  elseif($Binf['Bane'] == 'Pro track') { $Track = '../Design/DriftFire.jpg'; }
  elseif($Binf['Bane'] == 'Gardermoen') { $Track = '../Design/DragEn.jpg'; }
  elseif($Binf['Bane'] == 'Bykamp') { $Track = '../Design/DragTo.jpg'; }
  elseif($Binf['Bane'] == 'Cobra race') { $Track = '../Design/DragTre.jpg'; }
  elseif($Binf['Bane'] == '2km race') { $Track = '../Design/DragFire.jpg'; }

  echo "
  <script>
  $('#LeggRace').click(function() { 
  if($('#SumTotal').val() == '' || $('#SumTotal').val() == 'Sats en sum på deg selv') { alert('Du må satse en sum.'); } else {
  if($('#SumTotal').val().length > 7) { alert('Maksimum 9.999.999 kr'); }
  else if($('#SumTotal').val().length < 4) { alert('Minimum 1.000 kr'); } else {
  var Arenaen = encodeURI('".$Arena."');
  var Sats = encodeURI($('#SumTotal').val());
  $('#SB_Midten2').load('post.php?du_valgte=Bilrace&RaceTrack=True&Arena='+Arenaen+'&Sats='+Sats);
  $('html, body').animate({scrollTop:100}, 'slow');
  }}});
  </script>";
  
  $HentRace = mysql_query("SELECT BilListe.*,Bilrace.Kallenavn,Bilrace.Baner,$LvlM AS Lvl,$ScoM AS Score,Bilrace.BilID,garage.bilmerke,garage.skade FROM BilListe INNER JOIN Bilrace ON BilListe.Brukernavn=Bilrace.Brukernavn LEFT JOIN garage ON garage.id=Bilrace.BilID WHERE BilListe.Alto='$Arena' ORDER BY BilListe.Stamp ASC");
  if(mysql_num_rows($HentRace) == '0') { $List = "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Det er ingen påmeldt.</span></td></tr>"; } else {
  $Tell = '0';
  $ResPott = floor((mysql_num_rows($HentRace) * '100') + '700');
  $CashPott = floor((mysql_num_rows($HentRace) * '150000') + '3000000');    
  while($ki = mysql_fetch_assoc($HentRace)) { $Skills = FinnVinner($ki['Lvl'],$ki['Score'],$ki['bilmerke'],BaneSkills($Binf['Bane'],$ki['Baner']),$ki['skade']); $Total = $Total + $Skills; }
  
  if(mysql_data_seek($HentRace,0)) {
  while($Li = mysql_fetch_assoc($HentRace)) { 
  $Tell++;
  $CashPott = floor($CashPott + $Li['Sats']);
  $Vurder = Vurdering(FinnVinner($Li['Lvl'],$Li['Score'],$Li['bilmerke'],BaneSkills($Binf['Bane'],$Li['Baner']),$Li['skade']),$Total);
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  if(empty($Li['bilmerke'])) { $BilBruk = 'Mangler bil'; } else { $BilBruk = $Li['bilmerke']; }
  $List = $List."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".$Li['Kallenavn']."</td><td class=\"Linje Plassering\">$BilBruk</td><td class=\"Linje Plassering\">$Vurder</td><td class=\"Linje Plassering\">".$Li['Dato']."</td></tr>";
  }}}
  
  // Start race
  if($Timestamp > $Binf['StampStart']) { 
  
  // Setter diverse varriabler
  if($Arena == 'Rally') { $LvlE = 'Bilrace.RallyLvl'; $ScoE = 'Bilrace.RallyScore'; $UpEn = "RallyScore"; $NyBane = array("Arntunet","Vinter treffet","Grus runden","Landmark"); }
  elseif($Arena == 'Drift') { $LvlE = 'Bilrace.DriftLvl'; $ScoE = 'Bilrace.DriftScore'; $UpEn = "DriftScore"; $NyBane = array("Garagen","Drift track","10 runder","Pro track"); }
  elseif($Arena == 'Drag') { $LvlE = 'Bilrace.DragLvl'; $ScoE = 'Bilrace.DragScore'; $UpEn = "DragScore"; $NyBane = array("Gardermoen","Bykamp","Cobra race","2km race"); }
  $NyBane = $NyBane[array_rand($NyBane)];
  $StampStart = $Timestamp + '10000';
  $Tell = '0';

  $OppRace = mysql_query("SELECT Bilrace.Brukernavn,$LvlE AS Lvl,$ScoE AS Score,garage.bilmerke,garage.skade,Bilrace.Baner FROM BilListe INNER JOIN Bilrace ON BilListe.Brukernavn=Bilrace.Brukernavn LEFT JOIN garage ON garage.id=Bilrace.BilID AND garage.eier=Bilrace.brukernavn WHERE BilListe.Alto='$Arena'") or die(mysql_error());
  if(mysql_num_rows($OppRace) >= '1') {
  
  // Kan inkludere alt under
  while($in = mysql_fetch_assoc($OppRace)) { $Nick = $in['Brukernavn']; $Skills = FinnVinner($in['Lvl'],$in['Score'],$in['bilmerke'],BaneSkills($Binf['Bane'],$in['Baner']),$in['skade']); if($Skills == 'Mangler bil' || $Skills == 'Starter ikke' || $Skills == 'Ut') { $Skills = $Skills; } else { $Skills = $Timestamp + $Skills; } mysql_query("UPDATE BilListe SET Beregn='$Skills' WHERE Brukernavn='$Nick'"); }
  $Avgjor = mysql_query("SELECT BilListe.*,Bilrace.Baner FROM BilListe INNER JOIN Bilrace ON BilListe.Brukernavn=Bilrace.Brukernavn WHERE BilListe.Alto='$Arena' ORDER BY BilListe.Beregn DESC");
  while($Del = mysql_fetch_assoc($Avgjor)) { 
  $Nick = $Del['Brukernavn'];


  if($Del['Beregn'] == 'Mangler bil') { $Meld = 'Du fant ikke bilen din på banen, den har kansje blitt stjelt.'; $VinTap = "Tap=`Tap`+'1'"; $Pluss = "0"; $Medlaje = ""; $BanPluss = "0"; $Sporring = "rankpros=`rankpros`+'0.1'"; }
  elseif($Del['Beregn'] == 'Starter ikke') { $Meld = 'Bilen din startet ikke engang.'; $VinTap = "Tap=`Tap`+'1'"; $Pluss = "0"; $Medlaje = ""; $BanPluss = "0"; $Sporring = "rankpros=`rankpros`+'0.1'"; }
  elseif($Del['Beregn'] == 'Ut') { $Meld = 'Du kjørte av banen og rett inn i et tre.'; $VinTap = "Tap=`Tap`+'1'"; $Pluss = "1"; $Medlaje = ""; $BanPluss = "1"; $Sporring = "rankpros=`rankpros`+'0.2'"; } else { 
  $Tell++;
  if($Tell == '1') { $Meld = "Du kom på $Tell plass, du vant ".VerdiSum($CashPott,'kr').",".VerdiSum($ResPott,'respekt').". Du fikk også tilbake det dobbelte av det du satset siden du vant."; $VinTap = "Vinn=`Vinn`+'1'"; $Pluss = "4"; $Medlaje = ",Gull=`Gull`+'1'"; $CashPott = $CashPott + ($Del['Sats'] + '2'); $BanPluss = "4"; $Sporring = "penger=`penger`+'$CashPott',respekt=`respekt`+'$ResPott',rankpros=`rankpros`+'0.9'"; }
  elseif($Tell == '2') { $Meld = "Du kom på $Tell plass, du vant sølv medlajen, du vant 2.000.000 kr og 800 respekt."; $VinTap = "Vinn=`Vinn`+'1'"; $Pluss = "3"; $Medlaje = ",Solv=`Solv`+'1'"; $BanPluss = "3"; $Sporring = "penger=`penger`+'2000000',respekt=`respekt`+'800',rankpros=`rankpros`+'0.7'"; }
  elseif($Tell == '3') { $Meld = "Du kom på $Tell plass, du vant bronsje medlajen, du vant 1.000.000 kr og 500 respekt."; $VinTap = "Vinn=`Vinn`+'1'"; $Pluss = "2"; $Medlaje = ",Bronsje=`Bronsje`+'1'"; $BanPluss = "2"; $Sporring = "penger=`penger`+'1000000',respekt=`respekt`+'500',rankpros=`rankpros`+'0.4'"; } else { $Meld = "Du kom på $Tell plass."; $VinTap = "Tap=`Tap`+'1'"; $Pluss = "1"; $Medlaje = ""; $BanPluss = "1"; $Sporring = "rankpros=`rankpros`+'0.3'"; }
  
  }
  
  // Oppdaterer her

  $NyBaneSkill = NyBaneSkill($Binf['Bane'],$Del['Baner'],$BanPluss);
  mysql_query("UPDATE Bilrace SET $UpEn=`$UpEn`+'$Pluss',$VinTap,Baner='$NyBaneSkill'$Medlaje WHERE Brukernavn='$Nick'");
  mysql_query("UPDATE brukere SET $Sporring WHERE brukernavn='$Nick'");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Nick','$Timestamp','$AnnenDato','Race informasjon','$Meld','Ja')");
  
  }
  
  // Oppdater databaser med nytt race

  mysql_query("DELETE FROM BilListe WHERE Alto='$Arena'");
  mysql_query("UPDATE BilRunde SET Bane='$NyBane',StampStart='$StampStart',StampEndret='$Timestamp',RundNR=`RundNR`+'1' WHERE Arena='$Arena'");
  if($Arena == 'Rally') { 
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Dirty krystal','1022000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Larsi','1005300','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Sondre','1003000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Eskild','1000060','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Tuva','1000025','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Jake the ripper','1000000','$AnnenDato','$Timestamp','$Arena')");  
  }
  elseif($Arena == 'Drift') { 
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Steady Gun Gina','1200001','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Gunnar','1050000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Crime Valentina','1000000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Poofhead','1000000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Vic Gazebo','1040000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Skipppi Sherbert','1000530','$AnnenDato','$Timestamp','$Arena')");
  }
  elseif($Arena == 'Drag') { 
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Ragnhild','1000040','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Adam','1020000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Carlito Ciabetta','1004000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Gooblecute','2000000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Luigi Scarface','1000000','$AnnenDato','$Timestamp','$Arena')");
  mysql_query("INSERT INTO `BilListe` (Brukernavn,Sats,Dato,Stamp,Alto) VALUES ('Kinmatsu','1000000','$AnnenDato','$Timestamp','$Arena')");
  }
  
  // Kan inkludere alt over
  
  
  }}

  
  // Html
  if(empty($Klasse)) { $Klasse = 'Vanlig_1'; } elseif($Klasse == 'Vanlig_1') { $Klasse = 'Vanlig_2'; } elseif($Klasse == 'Vanlig_2') { $Klasse = 'Vanlig_1'; }
  
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"4\"><span style=\"float:left; line-height:30px;\">$Arena</span></td></tr>";
  echo "<tr><td class=\"R_8\" colspan=\"4\"><span class=\"B_ramme\"><img style=\"float:left;\" border=\"0\" src=\"$Track\"><span class=\"Bane_Info\"><p>Bane <font>".$Binf['Bane']."</font></p><p>Deltakere<font>".VerdiSum(mysql_num_rows($HentRace),'personer')."</font></p><p>Løp starter om<font id=\"BaneStart\" class=\"TellNed\">$StartTid</font></p><p style=\"height:32px;\">Pott<font>".VerdiSum($CashPott,'kroner')."<br>".VerdiSum($ResPott,'respekt')."</font></p></span></span></td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Sjåfør</td><td class=\"R_4\">Bil</td><td class=\"R_4\">Vurdering</td><td class=\"R_4\">Dato</td></tr>$List";
  echo "<tr class=\"$Klasse\"><td colspan=\"4\" class=\"Linje Send\" style=\"padding-bottom:9px;\"><input type=\"text\" id=\"SumTotal\" value=\"Sats en sum på deg selv\" maxlength=\"9\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sats en sum på deg selv')this.value='';\" onblur=\"if(this.value=='')this.value='Sats en sum på deg selv';\"><p class=\"Post\" id=\"LeggRace\">Inngang: 150.000 kr samt 100 respekt - Bli med!</p></td></tr>";
  echo "</table></div>";
  
  }}
  
  } else {

  // Dine biler

  $TellBil = '0';
  $Bil = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND TransportEll < '$Timestamp' AND skade='0' ORDER BY `timestampen` DESC LIMIT 100");
  if(mysql_num_rows($Bil) >= '1') { while ($BiI = mysql_fetch_assoc($Bil)) { $TellBil++; $Billiste = $Billiste."<option value=\"".Krypt_Tall($BiI['id'])."\">".$BiI['bilmerke']."</option>"; }}
  if($TellBil == '0') { $Billiste = "<option value=\"Feilfrie\">Du har ingen feilfrie biler</option>"; }

  echo "
  <script> 
  $('Select').change(function() {  
  var Rad = $('Select').val();
  if(Rad != 'Feilfrie') {
  var Rad = encodeURI(Rad);
  $('#SB_Midten2').load('post.php?du_valgte=Bilrace&EndreBil='+Rad);
  }});
  
  
  $('.Post').click(function() {
  var Iden = this.id; 
  if(Iden == 'drag' || Iden == 'drift' || Iden == 'rally') {
  var Iden = encodeURI(Iden);
  $('#SB_Midten2').load('post.php?du_valgte=Bilrace&Tren='+Iden);
  }});
  </script>";

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Bilrace</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bilrace&RaceTrack=True')\">( Arrangement )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bilrace')\">( Trening )</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/Bilrace.jpg\"></td></tr>";
  
  if($_GET['Tren']) { 
  $Trene = Mysql_Klar($_GET['Tren']);
  $SekVente = $Trenstamp - $Timestamp;
  if($Trenstamp > $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente <font id=\"RaceVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>"; }
  elseif($Trene == 'drag' || $Trene == 'drift' || $Trene == 'rally') { 
  if($Trene == 'drag') { $Var = $i['DragLvl']; $Oppdater = "DragLvl="; $VarTo = $i['DragScore']; $OppdaterTo = "DragScore="; } 
  elseif($Trene == 'drift') { $Var = $i['DriftLvl']; $Oppdater = "DriftLvl="; $VarTo = $i['DriftScore']; $OppdaterTo = "DriftScore="; } 
  elseif($Trene == 'rally') { $Var = $i['RallyLvl']; $Oppdater = "RallyLvl="; $VarTo = $i['RallyScore']; $OppdaterTo = "RallyScore="; }
  if($Var >= '100') {  
  $VarTo = $VarTo + '0.3';
  $OppdaterTo = $OppdaterTo."'$VarTo'";
  $TidVente = $Timestamp + '150';

  mysql_query("UPDATE Bilrace SET $OppdaterTo,Trenstamp='$TidVente' WHERE Brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $SekVente = $TidVente - $Timestamp;
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har startet engergi treningen, den varer i <font id=\"RaceVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>";
  } else {
  $Var = floor($Var + '1');
  if($Var >= '100') { $Var = '100'; }
  $Oppdater = $Oppdater."'$Var'";
  $TidVente = $Timestamp + '90';

  mysql_query("UPDATE Bilrace SET $Oppdater,Trenstamp='$TidVente' WHERE Brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  $SekVente = $TidVente - $Timestamp;
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har startet treningen, den varer i <font id=\"RaceVent\" class=\"TellNed\">$SekVente</font> sekunder.</span></td></tr>";
  }}}
  elseif($_GET['EndreBil']) { 
  $AddBil = Dekrypt_Tall(Bare_Bokstaver(Mysql_Klar($_GET['EndreBil'])));
  if(!empty($AddBil)) {

  $HHBil = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND id='$AddBil'");
  if(mysql_num_rows($HHBil) != '0') {
  $GGBil = mysql_fetch_assoc($HHBil);
  $Krefter = Hestekrefter($GGBil['bilmerke'])." Hestekrefter";
  if($GGBil['TransportEll'] > $Timestamp) { $BilEr = "".$GBil['bilmerke']." <font style=\"font-size:10px; color:#e40404;\">(fraktes)</font><br><font style=\"font-size:12px;\">$Krefter</font>"; }
  elseif($GGBil['skade'] > '0') { $BilEr = "".$GBil['bilmerke']." <font style=\"font-size:10px; color:#e40404;\">(skadet)</font><br><font style=\"font-size:12px;\">$Krefter</font>"; } 
  else { $BilEr = "".$GGBil['bilmerke']."<br><font style=\"font-size:12px;\">$Krefter</font>"; }
  mysql_query("UPDATE Bilrace SET BilID='$AddBil' WHERE Brukernavn='$brukernavn'");
  }}}
  
  echo "
  <tr><td class=\"R_8\"><span style=\"width: 480px; float: left; margin:5px; color:#FFFFFF; font-size:13px; filter:alpha(opacity=60); opacity:0.6;\">
  <img style=\"float:left; margin-left:2px;\" src=\"../Bilder/RaceEn.jpg\"><span class=\"KickInfo\">
  <span><p>".$i['Kallenavn']."</p><p>".$i['Dato']."</p></span><span>Race: ".VerdiSum(($i['Vinn']+$i['Tap']),'stk')."<br>Race vunnet: ".VerdiSum($i['Vinn'],'stk')."<br>Race tapt: ".VerdiSum($i['Tap'],'stk')."</span><span>Gull medlajer: ".VerdiSum($i['Gull'],'stk')."<br>Sølv medlajer: ".VerdiSum($i['Solv'],'stk')."<br>Bronsje medlajer: ".VerdiSum($i['Bronsje'],'stk')."</span>
  <span style=\"height:70px;\">
  <select style=\"float:left; width:254px;\" id=\"VBilo\"><option value=\"Feilfrie\">Velg bil</option>$Billiste</select>
  <div style=\"float:left; width:254px; margin-top:10px; text-align:center; font-size:14px; font-weight:bold;\">$BilEr</div>
  </span></span>
  <table style=\"font-family: Arial; font-size: 12px;\">
  <tr><td><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".KampSnitt($i['Vinn'],($i['Vinn']+$i['Tap']))."%; overflow:hidden;\"><p>Snitt (race vunnet)</p></div></div></td></tr>
  <tr><td><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".floor($i['RallyLvl'])."%; overflow:hidden;\"><p>Rally nivå: ".EmneFlink($i['RallyLvl'],$i['RallyScore'])."</p></div></div></td></tr>
  <tr><td><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".floor($i['DriftLvl'])."%; overflow:hidden;\"><p>Drift nivå: ".EmneFlink($i['DriftLvl'],$i['DriftScore'])."</p></div></div></td></tr>
  <tr><td><div class=\"progressbarTo\"><div class=\"progress\" style=\"width: ".floor($i['DragLvl'])."%; overflow:hidden;\"><p>Drag nivå: ".EmneFlink($i['DragLvl'],$i['DragScore'])."</p></div></div></td></tr>
  </table>
  <p class=\"Post\" id=\"drag\">Tren drag</p><p class=\"Post\" id=\"drift\">Tren drifting</p><p class=\"Post\" id=\"rally\">Tren rally</p>
  </span></tr></td></table></div>";
  }
  } else { 
  
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Bilrace</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/Bilrace.jpg\"></td></tr>";
  
  if($_GET['BliMedlem']) {
  $Kallenavn = Bare_BS(Mysql_Klar($_GET['BliMedlem']));
  if($rad_B['penger'] < '100000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger på hånda</span></td></tr>"; } 
  elseif(mysql_num_rows(mysql_query("SELECT * FROM Bilrace WHERE Kallenavn='$Kallenavn'")) > '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Kallenavn er alt ibruk, velg et annet kallenavn.</span></td></tr>"; } else {
  $NySpenn = floor($rad_B['penger'] - '100000');
  mysql_query("INSERT INTO `Bilrace` (Brukernavn,Kallenavn,Stamp,Dato) VALUES ('$brukernavn','$Kallenavn','$Timestamp','$AnnenDato')");
  mysql_query("UPDATE brukere SET penger='$NySpenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "
  <script> 
  $(document).ready( function() { $('#SB_Midten2').load('post.php?du_valgte=Bilrace'); });
  </script>";
  }}
  
  echo "
  <script>
  function Send() { 
  if($('#Kallenavn').val() == 'Kallenavn' || $('#Kallenavn').val() == '') { alert('Du må plotte inn ett kallenavn.'); } 
  else if($('#Kallenavn').val().length > 25) { alert('Kallenavnet er for langt.'); }
  else if($('#Kallenavn').val().length < 3) { alert('Kallenavnet er for kort.'); } else { 
  var Kallenavn = encodeURI($('#Kallenavn').val());
  $('#SB_Midten2').load('post.php?du_valgte=Bilrace&BliMedlem='+Kallenavn);
  }}
  </script>
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Kallenavn\" value=\"Kallenavn\" maxlength=\"24\" onFocus=\"if(this.value=='Kallenavn')this.value='';\" onblur=\"if(this.value=='')this.value='Kallenavn';\">
  <p class=\"Post\" onclick=\"Send()\">100.000 kr - Bli medlem!</p>
  </td></tr></table></div>";
  
  }
  
  }
  ?>
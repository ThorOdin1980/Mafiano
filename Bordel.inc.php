  <style>
  .OpptattNa { font-weight:bold; color:#e40404; }
  .KlarNa { font-weight:bold; color:#3c943c; }
  </style>
  <?php
  if(basename($_SERVER['PHP_SELF']) == "Bordel.inc.php") { header("Location: index.php"); exit; } else {
  
  // Funksjoner
  function HorSkils($tall) { if($tall >= '320') { $tall = 'Proff ( Grad: 4 )'; } elseif($tall >= '300') { $tall = 'Proff ( Grad: 3 )'; } elseif($tall >= '280') { $tall = 'Proff ( Grad: 2 )'; } elseif($tall >= '260') { $tall = 'Proff ( Grad: 1 )'; } elseif($tall >= '240') { $tall = 'Nesten proff ( Grad: 3 )'; } elseif($tall >= '220') { $tall = 'Nesten proff ( Grad: 2 )'; } elseif($tall >= '200') { $tall = 'Nesten proff ( Grad: 1 )'; } elseif($tall >= '180') { $tall = 'Ekstremt flink ( Grad: 3 )'; } elseif($tall >= '160') { $tall = 'Ekstremt flink ( Grad: 2 )'; } elseif($tall >= '140') { $tall = 'Ekstremt flink ( Grad: 1 )'; } elseif($tall >= '120') { $tall = 'Veldig flink ( Grad: 3 )'; } elseif($tall >= '100') { $tall = 'Veldig flink ( Grad: 3 )'; } elseif($tall >= '80') {  $tall = 'Veldig flink ( Grad: 1 )'; } elseif($tall >= '60') {  $tall = 'Flink ( Grad: 3 )'; } elseif($tall >= '40') {  $tall = 'Flink ( Grad: 2 )'; } elseif($tall >= '20') {  $tall = 'Flink ( Grad: 1 )'; } elseif($tall >= '10') {  $tall = 'Nybegynner ( Grad: 2 )'; } elseif($tall >= '0') {   $tall = 'Nybegynner ( Grad: 1 )'; } return $tall; }
  function HorVerdi($Pult) { $DinVerdi = floor(($Pult + '2.5') * '100'); return $DinVerdi; }

  // Sjekker om du er hore

  $Hore = mysql_query("SELECT * FROM Bordell WHERE Bruker='$brukernavn'");
  $Kunde = mysql_query("SELECT * FROM Bordell_Kunder WHERE Bruker='$brukernavn'");

  $SjekkAntall = mysql_num_rows($Hore) + mysql_num_rows($Kunde);
  if($SjekkAntall  >= '1') { $StartKnapp = ''; } else { $StartKnapp = "<span class=\"Opprett\" onclick=\"$('html,body').animate({scrollTop: $('#StartArbeid').offset().top},'slow');\">( Start arbeid )</span>"; }

  echo "
  <script>
  function HorVirksom() { 
  var Kjon = $('#V_Soker').val();
  var Tidslengde = $('#V_Tidslengde').val();
  if(Kjon == 'Begge' || Kjon == 'Mann' || Kjon == 'Dame') { 
  if(Tidslengde == '1 Time' || Tidslengde == '2 Timer' || Tidslengde == '3 Timer' || Tidslengde == '4 Timer' || Tidslengde == '5 Timer' || Tidslengde == '6 Timer' || Tidslengde == '7 Timer') { 
  var Kjon = encodeURI(Kjon);
  var Tidslengde = encodeURI(Tidslengde);
  $('#SB_Midten2').load('post.php?du_valgte=Bordel&Start='+Kjon+'&Tid='+Tidslengde); 
  $('html, body').animate({scrollTop:100}, 'slow');
  } else { alert('Ugyldig tidslengde.'); }
  } else { alert('Ugyldig kjønn.'); }
  }
  </script>
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Bordell - $Land</span>$StartKnapp</td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/Horehus.jpg\"></td></tr>";
  
  if(mysql_num_rows($Hore) > '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du er hore</span></td></tr>"; } 
  elseif(mysql_num_rows($Kunde) > '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du er horekunde.</span></td></tr>"; } else { 
  
  // Start som hore
  if($_GET['Start']) { 
  $S_Kjonn = Mysql_Klar($_GET['Start']);
  $S_Lengde = Bare_Siffer(Mysql_Klar($_GET['Tid']));
  if(empty($S_Kjonn)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du har ikke valgt kjønn.</span></td></tr>"; }
  elseif(empty($S_Kjonn)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du har ikke valgt tidslengde.</span></td></tr>"; }
  elseif($S_Kjonn == 'Begge' || $S_Kjonn == 'Mann' || $S_Kjonn == 'Dame') {  
  if($S_Lengde >= '1' && $S_Lengde < '8') {   
  $Tidsfrist = $Timestamp + ($S_Lengde * '3600');

  mysql_query("INSERT INTO Bordell (Bruker,Stamp,Dato,Tidslengde,Land,RettetMot) VALUES ('$brukernavn','$Timestamp','$AnnenDato','$Tidsfrist','$Land','$S_Kjonn')");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<script>$('#SB_Midten2').load('post.php?du_valgte=Bordel');</script>";
  exit;
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig tidslengde.</span></td></tr>"; }
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig kjønn.</span></td></tr>"; }
  }
  

  $Horer = mysql_query("SELECT Bordell.*,brukere.horer_pult,brukere.Kjon FROM Bordell LEFT JOIN brukere ON (Bordell.Bruker=brukere.brukernavn) WHERE Bordell.Land='$Land' AND Bordell.Tidslengde > '$Timestamp' ORDER BY Bordell.Stamp");
  if(mysql_num_rows($Horer) >= '1') { $Tell = '0';
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Hore</td><td class=\"R_4\">Status</td><td class=\"R_4\">Dato</td></tr>";
  while($I = mysql_fetch_assoc($Horer)) { 
  $Tell++;
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  
  $Slutter = $I['Tidslengde'] - $Timestamp;
  $TelleID = $Tell * '33';
  if($I['Tidslengde'] == '9999999999') { $SlutterTell = 'aldri'; } else { $SlutterTell = "om ( <font id=\"$TelleID\" class=\"TellNed\">$Slutter</font> sek )"; }

  if($I['RettetMot'] == 'Mann') { $Kjo = "Gutt"; $KjoTo = "menn"; } else { $Kjo = "Jente"; $KjoTo = "damer"; }
  
  if($I['Status'] == 'Opptatt') { $KlarEll = "<span class=\"OpptattNa\">Opptatt</span>"; }
  elseif($I['RettetMot'] == 'Begge' || $Kjo == $rad_B['Kjon']) { $KlarEll = "<span class=\"KlarNa\">Klar</span>"; } else { $KlarEll = "<span class=\"OpptattNa\">Søker $KjoTo</span>"; }
  
  echo "<tr class=\"$Klasse Ekstra\" onclick=\"alert('test');\"><td class=\"Linje Plassering\">".BrukerURL($I['Bruker'])."<br>".HorSkils($I['horer_pult'])."<br>Pris ( ".VerdiSum(HorVerdi($I['horer_pult']),'kr')." )</td><td class=\"Linje Plassering\">$KlarEll</td><td class=\"Linje Plassering\">".$I['Dato']."<br>Horen slutter $SlutterTell</td></tr>";
  }}

  if(empty($Klasse) || $Klasse == 'Vanlig_1') { $Klasse = 'Vanlig_2'; } else { $Klasse = 'Vanlig_1'; }

  echo "
  <tr class=\"$Klasse\" id=\"StartArbeid\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <span class=\"tekst\">Din verdi: <b>".VerdiSum(HorVerdi($rad_B['horer_pult']),'kr')."</b></span>
  <select id=\"V_Soker\"><option value=\"Begge\">Søker begge kjønn</option><option value=\"Mann\">Søker mann</option><option value=\"Dame\">Søker dame</option></select>
  <select id=\"V_Tidslengde\"><option>1 Time</option><option>2 Timer</option><option>3 Timer</option><option>4 Timer</option><option>5 Timer</option><option>6 Timer</option><option>7 Timer</option></select>
  <p class=\"Post\" onclick=\"HorVirksom();\">Start arbeid!</p>
  </td></tr></table></div>";

  }
 
  }
  ?>
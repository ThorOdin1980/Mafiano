  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(SjekkPlassering($brukernavn) == 'klar') { 
  echo "<div class=\"Div_masta\"><form method=\"post\" id=\"$submit_knapp_3\"><div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">START FIRMA / BEDRIFT</span></div><div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/butikk.jpg\"></div>";
 

  $B = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land'");

  $K = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Sted='$land'");
  $Antall = mysql_num_rows($B) + mysql_num_rows($K);
  
  if($Antall == '5') { echo PrintTeksten("Det er ingen ledige plasser.",'1','Feilet'); } else {
  
  $Butikker = array(); if(mysql_num_rows($B) >= '1') { while($I = mysql_fetch_assoc($B)) { array_push($Butikker, $I['Butikk_Type']); }} if(mysql_num_rows($K) >= '1') { array_push($Butikker, 'Kulefabrikk'); }
  if(empty($_POST['Butikk_Navn'])) { $En = ''; } else { $En = $_POST['Butikk_Navn']; }
  if(empty($_POST['Gjelder_P']) || $_POST['Gjelder_P'] == 'Ingen') { $To = 'Ingen'; $Tre = 'Velg alternativ'; } else { $Tre = "<b>Velg alternativ:</b> ".$_POST['Gjelder_P'];  $To = $_POST['Gjelder_P']; }

  if(isset($_POST['Butikk_Navn'])) { 
  if($Antall == '5') { echo PrintTeksten("Det er ingen ledige bedrifter.",'1','Feilet'); } 
  elseif(empty($_POST['Butikk_Navn'])) { echo PrintTeksten("Mangler butikkens navn.",'1','Feilet'); } 
  elseif(empty($_POST['Gjelder_P'])) { echo PrintTeksten("Mangler butikk type.",'1','Feilet'); } else { 
  $B_Navn = Mysql_Klar($_POST['Butikk_Navn']);
  $B_Type = Mysql_Klar($_POST['Gjelder_P']);
  if($B_Type == 'Kulefabrikk' || $B_Type == 'Båter' || $B_Type == 'Fly' || $B_Type == 'Våpen' || $B_Type == 'Beskyttelse') { 
  if($B_Type == 'Kulefabrikk') { 
  if(mysql_num_rows($K) >= '1') { echo PrintTeksten("Kulefabrikken er allerede tatt.",'1','Feilet'); } else { 
  if($penger < '70000000') { echo PrintTeksten("Du har ikke nok penger.",'1','Feilet'); } 
  else { 
  $NySpenn = floor($penger - '70000000');
  
  mysql_query("INSERT INTO `Kulefabrikker` (KF_Fabrikk, KF_Eier, KF_Opprettet_Dato, KF_Opprettet_Stamp, KF_Brukt_Totalt, KF_Sted) VALUES ('$B_Navn','$brukernavn','$FullDato','$tiden','70000000','$land')");
  
  mysql_query("UPDATE brukere SET penger='$NySpenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
  echo PrintTeksten("Gratulerer med kulefabrikk.",'1','Vellykket');
  }}} else { 

  $Sjekk = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE '$B_Type'");
  if(mysql_num_rows($Sjekk) >= '1') { echo PrintTeksten("Det er ikke plass til en slik butikk til.",'1','Feilet'); } else { 
  if($penger < '50000000') { echo PrintTeksten("Du har ikke nok penger.",'1','Feilet'); } 
  else { 
  if($B_Type == 'Båter') { $Var = "Triton: 5,600000<br>Mariah: 5,900000<br>Sea Ray: 5,1600000<br>FORBINA: 5,2000000<br>Mediterranèe: 5,4000000<br>Meridian: 5,6000000<br>"; } 
  elseif($B_Type == 'Fly') { $Var = "Aerostar: 5,3630000<br>Mitsubishi: 5,5160000<br>Cessna Skyhawk: 5,7200816<br>Cessna: 5,15440000<br>Citation V Ultra: 5,28170000<br>"; }
  elseif($B_Type == 'Våpen') { $Var = "Hammer: 20,20100<br>Balltre: 20,20100<br>Knokejern: 20,20100<br>Kniv: 20,30000<br>Glock: 20,40000<br>Desert Eagle: 20,80000<br>Uzi smg: 20,100000<br>Ak: 20,460000<br>Steyr: 20,2000000<br>"; }
  elseif($B_Type == 'Beskyttelse') { $Var = "Hette: 20,20.000 kr<br>Hund: 20,48.000 kr<br>Vest: 20,90.000 kr<br>Livvakt: 20,230.000 kr<br>Bil: 20,1.510.000 kr<br>"; }
  $NySpenn = floor($penger - '50000000');

  mysql_query("INSERT INTO `Butikker` (Butikk_Navn,Butikk_Type,Butikk_Startet_Dato,Butikk_Startet_Stamp,Butikk_Land,Butikk_eier,Butikk_varer) VALUES ('$B_Navn','$B_Type','$FullDato','$tiden','$land','$brukernavn','$Var')");

  mysql_query("UPDATE brukere SET penger='$NySpenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
  echo PrintTeksten("Gratulerer med butikk.",'1','Vellykket');
  }}}} else { echo PrintTeksten("Ugyldig butikk type.",'1','Feilet'); }
  }}
        
  echo "
  <input type=\"hidden\" name=\"Gjelder_P\" id=\"Gjelder_P\" value=\"$To\"/>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Butikk-navn</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Butikk_Navn\" maxlength=\"25\" value=\"$En\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Type</span></div>
  <div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('Typer')\">
  <div id=\"Velg alternativ\" class=\"Span_str_9\">$Tre</div><div id=\"Typer\" class=\"D_Boks\">";
  
  if(!in_array('Kulefabrikk', $Butikker, true)) { echo "<div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Kulefabrikk','Gjelder_P')\">---> Kulefabrikk - 70.000.000 kr</div>"; }
  if(!in_array('Båter', $Butikker, true)) { echo "<div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Båter','Gjelder_P')\">---> Båt butikk 50.000.000 kr</div>"; }
  if(!in_array('Fly', $Butikker, true)) { echo "<div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Fly','Gjelder_P')\">---> Fly butikk 50.000.000 kr</div>"; }
  if(!in_array('Våpen', $Butikker, true)) { echo "<div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Våpen','Gjelder_P')\">---> Våpen butikk 50.000.000 kr</div>"; }
  if(!in_array('Beskyttelse', $Butikker, true)) { echo "<div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Beskyttelse','Gjelder_P')\">---> Beskyttelses butikk 50.000.000 kr</div>";  }

  echo "
  </div></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('$submit_knapp_3').submit()\"><p class=\"pan_str_2\">START</p></div>
  ";
  
  }
  echo "</form></div>";
  }
  ?>

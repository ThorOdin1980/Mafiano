  <?php
  if(basename($_SERVER['PHP_SELF']) == "GatekampUp.inc.php") { header("Location: index.php"); exit; } else {
  
  // Oppdater Gatekamp

  $Gatekamp = mysql_query("SELECT * FROM KickListe WHERE Arena='Gatekamp' ORDER BY Rang DESC");
  if(mysql_num_rows($Gatekamp) >= '5') { 
  $Tell = '0';
  
  while($A = mysql_fetch_assoc($Gatekamp)) {
  $Tell++;
  $FaTilbake = floor($A['Sum']);
  $Brukeren = $A['Brukernavn'];
  
  if($Tell == '1') { 
  $Melding = "Du vant gull medlajen, du hadde ".VerdiSum($FaTilbake,'kr')." på kickbokseren din, de har blitt plassert på din bruker.\n\nSom vinner av gull medlajen vant du 5.000.000 kr, 2.000 respekt, 1 rankprosent, 1.500 bombechips.";
  $FaTilbake = floor($FaTilbake + '5000000');

  mysql_query("UPDATE brukere SET penger=`penger`+'$FaTilbake',respekt=`respekt`+'2000',rankpros=`rankpros`+'1',bombechips=`bombechips`+'1500' WHERE brukernavn='$Brukeren'"); 
  mysql_query("UPDATE Kickboksing SET Gull=`Gull`+'1' WHERE Bruker='$Brukeren'");
  }
  elseif($Tell == '2') { 
  $Melding = "Du vant sølv medlajen, du hadde ".VerdiSum($FaTilbake,'kr')." på kickbokseren din, de har blitt plassert på din bruker.\n\nSom vinner av sølv medlajen vant du 4.000.000 kr, 1.500 respekt, 1 rankprosent, 1.000 bombechips.";
  $FaTilbake = floor($FaTilbake + '4000000');

  mysql_query("UPDATE brukere SET penger=`penger`+'$FaTilbake',respekt=`respekt`+'1500',rankpros=`rankpros`+'1',bombechips=`bombechips`+'1000' WHERE brukernavn='$Brukeren'"); 
  mysql_query("UPDATE Kickboksing SET Solv=`Solv`+'1' WHERE Bruker='$Brukeren'");
  }
  elseif($Tell == '3') { 
  $Melding = "Du vant bronsje medlajen, du hadde ".VerdiSum($FaTilbake,'kr')." på kickbokseren din, de har blitt plassert på din bruker.\n\nSom vinner av bronsje medlajen vant du 3.000.000 kr, 1.000 respekt, 1 rankprosent, 500 bombechips.";
  $FaTilbake = floor($FaTilbake + '3000000');

  mysql_query("UPDATE brukere SET penger=`penger`+'$FaTilbake',respekt=`respekt`+'1000',rankpros=`rankpros`+'1',bombechips=`bombechips`+'500' WHERE brukernavn='$Brukeren'"); 
  mysql_query("UPDATE Kickboksing SET Bronsje=`Bronsje`+'1' WHERE Bruker='$Brukeren'");
  } else {  
  $Melding = "Du kom på $Tell plass, du hadde ".VerdiSum($FaTilbake,'kr')." på kickbokseren din, de har blitt plassert på din bruker.";

  mysql_query("UPDATE brukere SET penger=`penger`+'$FaTilbake',respekt=`respekt`+'10',rankpros=`rankpros`+'0.1' WHERE brukernavn='$Brukeren'"); 
  }

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Brukeren','$Timestamp','$AnnenDato','Runde over','$Melding','Ja')");
  }


  mysql_query("DELETE FROM KickListe WHERE Arena='Gatekamp'");
  $StampBlir = $Timestamp + '5000';
  mysql_query("UPDATE Kickrunde SET Stamp='$StampBlir' WHERE Arena='Gatekamp'"); 
  mysql_query("INSERT INTO KickListe (Brukernavn,Bruker,Dato,Stamp,Sum,Arena,Rang) VALUES ('Steady Gun Gina','Sandman','$AnnenDato','$Timestamp','300000','Gatekamp','201')");
  mysql_query("INSERT INTO KickListe (Brukernavn,Bruker,Dato,Stamp,Sum,Arena,Rang) VALUES ('Poofhead','Mad Max','$AnnenDato','$Timestamp','500000','Gatekamp','203')");
  mysql_query("INSERT INTO KickListe (Brukernavn,Bruker,Dato,Stamp,Sum,Arena,Rang) VALUES ('Kinmatsu','Tigerscott','$AnnenDato','$Timestamp','900000','Gatekamp','205')");
  mysql_query("INSERT INTO KickListe (Brukernavn,Bruker,Dato,Stamp,Sum,Arena,Rang) VALUES ('Fiskern','Flintstone','$AnnenDato','$Timestamp','2000000','Gatekamp','207')");
  
  // Oppdrag flytt Dirty krystal til en annen by
  if(date("H") == '00' || date("H") == '09' || date("H") == '15' || date("H") == '18') { $RandBy = array("Drammen","Lillehammer","Hamar","Alta","Bergen","Oslo","Stavanger","Trondheim","Kristiansand","Sandefjord"); $RandBy = $RandBy[array_rand($RandBy)]; mysql_query("UPDATE brukere SET land='$RandBy',aktiv_eller='$Aktiv',timestamp_inne='$Timestamp',sistinne='$tid $nbsp $dato',liv='100' WHERE brukernavn='Dirty krystal'"); }
  
  }
  }
  ?>
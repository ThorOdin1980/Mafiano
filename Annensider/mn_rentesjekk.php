<?php


$tidsjekken = ($tiden-86400); //
$sjekken = date('d');
$rentefot = "0.2"; // % renter


$rentsql = "SELECT * 
FROM `renter` 
ORDER BY `id` DESC
LIMIT 0 , 1";

$doit = @mysql_query($rentsql) or die(mysql_error());
	if (mysql_num_rows($doit) != 1) {
	$sjekki[datoindex] = 0;	
	}else {
	$sjekki = mysql_fetch_array($doit);
	}
	
if ($sjekki[datoindex] != $sjekken) {  // gi ut renter 
	$mersql2 = mysql_query("INSERT INTO `renter` (`tid`, `datoindex`) VALUES ('".time()."', '$sjekken')") or die(mysql_error());
	$re_id = mysql_insert_id();
/**************/
/*RENTER start*/
/**************/
	$sql="SELECT `brukerid`, `brukernavn`, `bank` 
FROM `brukere` 
WHERE `timestamp_inne` > '$tidsjekken' ORDER BY `brukernavn` ASC";
	$brukeren = @mysql_query($sql) or die(mysql_error());

		while ($row = mysql_fetch_array($brukeren)) {
	
		$pengerhar = $row[bank];
		$pengerfor = ($pengerhar * $rentefot);
		$pengerfor = ($pengerfor / 100);
		$naapeng = number_format(($pengerfor + $pengerhar),0,'','');
			if($pengerfor > 5000) { // vill kun gi renter til de som får mer en 5,000 i renter
			$mysqldo= mysql_query("UPDATE `brukere` SET `bank` = '$naapeng' WHERE `brukerid` = '$row[brukerid]'");
			$r_spillere[] = array('bruker' => $row[brukernavn], 'peng' => $pengerfor);

			$tell = ($tell + $pengerfor);
			}
		}
	mysql_free_result($brukeren);
	$tell = number_format($tell,0,'','');
	$mysqldo= mysql_query("UPDATE `renter` SET `mye_utgitt` = '$tell' WHERE `id` = '$re_id'");

	// renter utgitt ... starter med og sende pm'er'
	

		foreach ($r_spillere as $dene) {
		mysql_query("INSERT INTO pm_system 
(fra_bruker,
til_bruker,
timestampen,
dato_sendt,
tittel,
melding,
fra_game_ell) VALUES (
'Game',
'$dene[bruker]',
'$tiden',
'$tid $nbsp $dato',
'Renter',
'Du har mottatt " . number_format($dene[peng],0,',','.') . "kr (" . $rentefot . "%) i renter.',
'Ja')");
		}


	




/****************/
/*RENTER stopp  */
/****************/
	}





















?>
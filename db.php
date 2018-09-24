<?php
ob_start();
date_default_timezone_set('Europe/Oslo');


$tid = date("H:i:s");
$dato = date("d. M");
$aar = date("Y");
$nbsp = '//';
$tiden = time();

$host_db_Xx = 'localhost'; 
$bruker_db_Xx = 'mafiano_old';
$passord_db_Xx = 'bauervapor';
$navn_db_Xx = 'mafiano_old';
$url_Xx = "http://mafiano.no/";                                                 
$web_navn_Xx = "http://mafiano.no/";
$sonny_mail_Xx = "";

$tilkobling_Xx = mysql_pconnect("$host_db_Xx","$bruker_db_Xx","$passord_db_Xx") or die ("Kunne ikke koble til server. Prøv igjen senere.");
$db_Xx = mysql_select_db("$navn_db_Xx", $tilkobling_Xx) or die("Kunne ikke velge server.");

?>
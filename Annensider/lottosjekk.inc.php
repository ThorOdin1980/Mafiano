<?php



if(basename($_SERVER['PHP_SELF']) == "lottosjekk.inc.php") {
header("Location: index.php");
exit;
}


$timestamp = time();
$sistmove =  date("H:i:s")." // ".date("d. M"); 

$sqlan = mysql_query('SELECT * FROM `lottorunde` ORDER BY `lottorunde`.`id` DESC LIMIT 0 , 1') or die(mysql_error());
$antall = mysql_num_rows($sqlan);
if ($antall == 0) {

$sqlan = mysql_query("INSERT INTO `lottorunde` (`rundeid` ,`startet` ) VALUES ('$timestamp', '$sistmove')") or die(mysql_error());
$sqlan = mysql_query('SELECT * FROM `lottorunde` ORDER BY `lottorunde`.`id` DESC LIMIT 0 , 1') or die(mysql_error());
}
$lottorunde = mysql_fetch_array($sqlan);
if (($lottorunde[rundeid] + $rundetid) <= $timestamp) {

$sqlan = mysql_query("INSERT INTO `lottorunde` (`rundeid` ,`startet` ) VALUES ('$timestamp', '$sistmove')") or die(mysql_error());
$sqlanda = mysql_query("SELECT * FROM `lottokupp` WHERE `lottoid` = '$lottorunde[rundeid]'") or die(mysql_error());
$akupps = mysql_num_rows($sqlanda);
if ($akupps > 0) {
while ($row = mysql_fetch_array($sqlanda)) {
$aid[] = $row[id];
$anick[] = $row[nick];
}
$randit = array_rand($aid ,1);
$aaid = $aid[$randit];
$aanick = $anick[$randit];

$saafeq = @mysql_query("SELECT * FROM `brukere` WHERE `brukernavn` = '$aanick'") or die(mysql_error());
$vinner = mysql_fetch_array($saafeq);
$potten = ($loddpris * $akupps);
$potten = $potten + '7000000';
$pengerhar = $vinner[penger];
$pengerfor = floor($potten * $rentefot);
$pengerfor = floor($pengerfor / 100);
$pengernaa = floor($pengerfor + $pengerhar);
$tittel = "Lottovinner";
$melding = "Ditt lodd nr. $aaid vant denne lotto runden, du vant " . number_format($pengerfor) . " kr.";

mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$aanick','$tiden','$tid $nbsp $dato','$tittel','$melding','Ja')");

$mysqdoa="UPDATE `brukere` SET `penger` = '$pengernaa' WHERE `brukernavn` = '$aanick'";
$seea = @mysql_query($mysqdoa) or die(mysql_error());

$sqlan = mysql_query("INSERT INTO `lottovinn` (`vunnet` ,`nick`, `tid` ) VALUES ('" . number_format($pengerfor,0,'','') . "', '$aanick', '$sistmove')") or die(mysql_error());
}

mysql_query("DELETE FROM `lottokupp` WHERE `lottoid` = '$lottorunde[rundeid]'") or die(mysql_error());
$sqlana = mysql_query('SELECT * FROM `lottorunde` ORDER BY `lottorunde`.`id` DESC LIMIT 0 , 1') or die(mysql_error());
$lottorunde = mysql_fetch_array($sqlana);
}
$sekkigjen = ($lottorunde[rundeid] + $rundetid) - ($timestamp);

$sqlanda = mysql_query("SELECT `id` , `nick`, `tid` FROM `lottokupp` WHERE `lottoid` = '$lottorunde[rundeid]'") or die(mysql_error());
$anlottokupp = mysql_num_rows($sqlanda);
$echodine = "0";
$dinelodd = "0";
$anspillere = "0";
$potten = number_format(($anlottokupp * $loddpris) + '7000000');
if ($anlottokupp == 0) {
$anlottokupp = '0';
$dinelodd = "0";
$echodine = "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ingen lodd.</span></div>";
}else {
$echodine = "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ingen lodd.</span></div>";
while ($row = mysql_fetch_array($sqlanda)) {
$arspillere[] = $row[nick];
if ($row[nick] == $br) {
if ($echodine == "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ingen lodd.</span></div>") {

$echodine = "
<div class=\"Div_bunn_1\">&nbsp;&nbsp;Runde-nr: $lottorunde[id]</div>
<div class=\"Div_bunn_1\">&nbsp;&nbsp;Lodd: $row[id]</div>
<div class=\"Div_bunn_1\">&nbsp;&nbsp;$row[tid]</div>
<div class=\"Div_bunn_2\">&nbsp;</div>
";

}else {
$echodine = " 
$echodine
<div class=\"Div_bunn_1\">&nbsp;&nbsp;Runde-nr: $lottorunde[id]</div>
<div class=\"Div_bunn_1\">&nbsp;&nbsp;Lodd: $row[id]</div>
<div class=\"Div_bunn_1\">&nbsp;&nbsp;$row[tid]</div>
<div class=\"Div_bunn_2\">&nbsp;</div>
";
}
$dinelodd++;	
}
}

foreach ($arspillere as $rownick) {
if (!$nicklist[$rownick]) {
$anspillere++;
$nicklist[$rownick] = $rownick;
}	
}
unset($nicklist);	

	
}






?>
<?php
header("Content-type: image/png");
if(empty($_REQUEST['b'])) { session_unset(); session_destroy(); header("Location: login.php"); exit; } else {
if(empty($_REQUEST['k'])) { session_unset(); session_destroy(); header("Location: login.php"); exit; } else {
// lag et bilde utfra profilbilde.png og sjekk h�yde og bredde

if($_REQUEST['k'] == 'Gutt' || $_REQUEST['k'] == 'Jente') { 

if($_REQUEST['k'] == 'Gutt') { $bilde = 'Mann.png'; }
if($_REQUEST['k'] == 'Jente') { $bilde = 'Dame.png'; }
$im = imagecreatefrompng($bilde);
// lager en farge
$color = imagecolorallocate($im, 48, 48, 48);
// Tekstst�rrelse
$tekstsize = 14;
// brukernavnet som skal st� p� bildet
$tekst = $_REQUEST['b'];
// Skriver det ut P� bildet
imagettftext($im, $tekstsize, 0, 8, 240, $color, 'arial.ttf', $tekst);
//Skriver ut bildet
imagepng($im);
imagedestroy ($im);
} else { session_unset(); session_destroy(); header("Location: login.php"); exit; }
}}
?>

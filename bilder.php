<?php
header("Content-type: image/png");
if(empty($_REQUEST['b'])) { session_unset(); session_destroy(); header("Location: login.php"); exit; } else {
if(empty($_REQUEST['k'])) { session_unset(); session_destroy(); header("Location: login.php"); exit; } else {
// lag et bilde utfra profilbilde.png og sjekk høyde og bredde

if($_REQUEST['k'] == 'Gutt' || $_REQUEST['k'] == 'Jente') { 

if($_REQUEST['k'] == 'Gutt') { $bilde = 'Mann.png'; }
if($_REQUEST['k'] == 'Jente') { $bilde = 'Dame.png'; }
$im = imagecreatefrompng($bilde);
// lager en farge
$color = imagecolorallocate($im, 48, 48, 48);
// Tekststørrelse
$tekstsize = 14;
// brukernavnet som skal stå på bildet
$tekst = $_REQUEST['b'];
// Skriver det ut PÅ bildet
imagettftext($im, $tekstsize, 0, 8, 240, $color, 'arial.ttf', $tekst);
//Skriver ut bildet
imagepng($im);
imagedestroy ($im);
} else { session_unset(); session_destroy(); header("Location: login.php"); exit; }
}}
?>

<?php
header("Content-type: image/png");
if(empty($_REQUEST['b'])) { header("Location: index.php"); } else {
// lag et bilde utfra profilbilde.png og sjekk høyde og bredde

$im = imagecreatefrompng('gjeng_medlem2.png');
// lager en farge
$color = imagecolorallocate($im, 48, 48, 48);
// Tekststørrelse
$tekstsize = 7;
// brukernavnet som skal stå på bildet
$tekst = $_REQUEST['b'];

if(strlen($tekst) >= '10') { $tekst = substr($tekst, 0, 10) . '...'; }

// Skriver det ut PÅ bildet
imagettftext($im, $tekstsize, 0, 5, 75, $color, 'arial.ttf', $tekst);
//Skriver ut bildet
imagepng($im);
imagedestroy ($im);
}
?>
<?php
if(!defined('view') or isset($_SESSION['id'])) { $output .= $noaccess; } else {

$output .= '
<div class="content">
	<div class="heading">Kontakt oss</div>
	<div class="image"><img src="/common/gfx/function_images/login.png"></div>
	<div class="text">Logg inn og send en melding til Havers for å komme i kontakt med innehaver av spillet.</div>
</div>';
}
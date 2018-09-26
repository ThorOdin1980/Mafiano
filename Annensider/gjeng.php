        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        $Gjengnavn = htmlspecialchars(mysql_real_escape_string($_REQUEST['navn']));
        if(empty($Gjengnavn)) { header("Location: game.php?side=hoved"); } else { 
        
      
        $Hent_gjeng = mysql_query("SELECT * FROM Gjenger WHERE Gjeng_Navn='$Gjengnavn'");
        if (mysql_num_rows($Hent_gjeng) == '0') { Header("Location: game.php?side=hoved"); } else {
        $gjeng_info = mysql_fetch_assoc($Hent_gjeng);
        $Gjeng_Navn = $gjeng_info['Gjeng_Navn'];
        $Gjeng_Id = $gjeng_info['id'];
        $Gjeng_Penger = $gjeng_info['Gjeng_Penger'];
        $Gjeng_Bombechips = $gjeng_info['Gjeng_Bombechips'];
        $Gjeng_Poeng = $gjeng_info['Gjeng_Poeng'];
        $Gjeng_Bilde = $gjeng_info['bilde'];
        $Gjeng_Tekst = $gjeng_info['tekst'];
        $Gjeng_Grunnlagt_dato = $gjeng_info['Dato_Startet'];
        $Gjeng_Grunnlagt_stamp = $gjeng_info['Stamp_Startet'];
        $Gjeng_Kriger_vunnet = $gjeng_info['kriger_vunnet'];
        $Gjeng_utpressinger = $gjeng_info['utpressinger'];
        $Gjeng_krav = $gjeng_info['rank_krav'];
        $Gjeng_ta_inn_ell = $gjeng_info['tar_inn_ell'];

        // Gjeng størrelse
        if($gjeng_info['antall_gjenger'] == '1') {     $GjengSTR = "Enkel"; } 
        elseif($gjeng_info['antall_gjenger'] == '2') { $GjengSTR = "Dyade"; }
        elseif($gjeng_info['antall_gjenger'] == '3') { $GjengSTR = "Triade"; }
        // Gjeng størrelse

        
        if(empty($Gjeng_Bilde)) {
                $bilde_er = "<div class=\"Div_bilde\"><p align=\"center\"><img border=\"0\" src=\"http://www.mafiano.me/Bilder/gjeng.jpg\"></p></div>";
        } else {
                $bilde_er = "<div class=\"Div_MELDING\"><p align=\"center\"><img src=\"$Gjeng_Bilde\" style=\"max-width:480px; max-height: 250px;\" border=\"0\" ></p></div>";
        }

        $tiden_blir_da = $tiden - $Gjeng_Grunnlagt_stamp;
        
        function calc_tid($sek) { 
        if ($sek < 1) { return "0 sek"; } else { 
        
        $dager = floor((($sek / 60) / 60)); $b = ($hours * 3600); 
        $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); 
        $mins  = floor(($sek - $b) / 60); 
        $a = ($hours * 3600) + ($mins * 60); 
        $seks = $sek - $a; $ret = ""; 
        
        if ($hours > 0) { $ret = $hours . " timer "; } 
        if ($mins > 0) { $ret = $ret . $mins . " min "; } 
        $ret = $ret . $seks . " sek"; return $ret; }}
        
        $Gjeng_Medlemmer = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE gjeng_id LIKE '$Gjeng_Id' ORDER BY 'ansatt_stamp'");
        $AntallMed = mysql_num_rows($Gjeng_Medlemmer);
        
        if($AntallMed >= '0') {  $GjengSTR2 = "en kriminell organisasjon"; } 
        if($AntallMed >= '5') {  $GjengSTR2 = "en liten kriminell organisasjon"; }
        if($AntallMed >= '10') { $GjengSTR2 = "en middels stor kriminell organisasjon"; }
        if($AntallMed >= '15') { $GjengSTR2 = "en stor kriminell organisasjon"; }
        if($AntallMed >= '20') { $GjengSTR2 = "en farlig stor kriminell organisasjon"; }
        if($AntallMed >= '25') { $GjengSTR2 = "en dødelig stor kriminell organisasjon"; }

        if($gjeng_info['drap'] >= '0') { $FryktEN = "Ingen drapsglede"; }
        if($gjeng_info['drap'] >= '2') { $FryktEN = "Drap er siste utvei"; }
        if($gjeng_info['drap'] >= '10') { $FryktEN = "Minimal drapsglede"; }
        if($gjeng_info['drap'] >= '20') { $FryktEN = "Dreper med glede"; }
        if($gjeng_info['drap'] >= '30') { $FryktEN = "Dreper daglig"; }

        if($gjeng_info['kriger_vunnet'] >= '0') {  $FryktTO = "gjengen har ikke deltatt i krig."; }
        if($gjeng_info['kriger_vunnet'] >= '1') {  $FryktTO = "gjengen har vunnet en krig."; }
        if($gjeng_info['kriger_vunnet'] >= '2') {  $FryktTO = "gjengen har vunnet to kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '3') {  $FryktTO = "gjengen har vunnet tre kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '4') {  $FryktTO = "gjengen har vunnet fire kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '5') {  $FryktTO = "gjengen har vunnet fem kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '6') {  $FryktTO = "gjengen har vunnet seks kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '7') {  $FryktTO = "gjengen har vunnet sju kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '8') {  $FryktTO = "gjengen har vunnet åtte kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '9') {  $FryktTO = "gjengen har vunnet ni kriger."; }
        if($gjeng_info['kriger_vunnet'] >= '10') { $FryktTO = "gjengen er krigsherrer, taper aldri."; }

        
        function bbkoder ($str) {
        $bbkoder = array(
        '/\[center\](.*?)\[\/center\]/is',
        '/\[film\](.*?)\[\/film\]/is',
        '/\[mar2\](.*?)\[\/mar\]/is',
        '/\[mar\](.*?)\[\/mar\]/is',
        '/\[k\](.*?)\[\/k\]/is',
        '/\[b\](.*?)\[\/b\]/is',                               
        '/\[i\](.*?)\[\/i\]/is',                               
        '/\[u\](.*?)\[\/u\]/is',
        '/\[p\](.*?)\[\/p\]/is',
        '/\[img\](.*?)\[\/img\]/is',
        '/\[img=(.*?)\]/is',
        '/\[hr\]/is',
        '/\[farge=(.*?)\](.*?)\[\/farge\]/is',
        '/\[navn\](.*?)\[\/navn\]/is',
        '/\[size=(.*?)\](.*?)\[\/size\]/is',
        '/\[ramme=(.*?)\](.*?)\[\/ramme\]/is',
        '/\:wow:/is',
        '/\:rofl:/is',
        '/\:sover:/is',
        '/\:le:/is',
        '/\:luv:/is',
        '/\:plis:/is',
        '/\:lol:/is',
        '/\:hm:/is',
        '/\:unfear:/is',
        '/\:bigeye:/is',
        '/\:tatt:/is',
        '/\:blåveis:/is',
        '/\:forvirret:/is',
        '/\:spam:/is'
        );
  
        $erstatt = array(
        '<center>$1</center>',
        '<embed src="$1" width="425" height="350"></embed>',
        '<marquee behavior="alternate">$1</marquee>',
        '<marquee>$1</marquee>',
        '<em>$1</em>',
        '<b>$1</b>',
        '<i>$1</i>',
        '<u>$1</u>',
        '<p>$1</p>',
        '<img src="$1" style="max-width:480px; max-height=500px;" />',
        '<img src="$1" style="max-width:480px; max-height=500px;" />',
        '<hr color="#000000" />',
        '<span style="color: $1">$2</span>',
        '<a href="http://www.mafiano.me/game.php?side=bruker&id=$1">$1</a>',
        '<font size="$1">$2</font>',
        '<fieldset style="border:2px solid #000000; width: 440;"><legend>$1</legend>$2</fieldset>',
        '<img border="0" src="smilies/wow.gif">',
	    '<img border="0" src="smilies/rofl.gif">',
        '<img border="0" src="smilies/sover.gif">',
        '<img border="0" src="smilies/le.gif">',
	    '<img border="0" src="smilies/luv.gif">',
        '<img border="0" src="smilies/plis.gif">',
        '<img border="0" src="smilies/lol.gif">',
	    '<img border="0" src="smilies/hm.gif">',
        '<img border="0" src="smilies/unfear.gif">',
        '<img border="0" src="smilies/bigeye.gif">',
	    '<img border="0" src="smilies/tatt.gif">',
        '<img border="0" src="smilies/blåveis.gif">',
        '<img border="0" src="smilies/forvirret.gif">',
	    '<img border="0" src="smilies/spam.gif">'
        );
        $str = preg_replace ($bbkoder, $erstatt, $str);
        return nl2br($str);  
        }
        $tekst = bbkoder($Gjeng_Tekst);  
        $tekst_2 = wordwrap($tekst, 60, "\n", true);
        
        // Finn ut hvor mange prosent gjengen styrer av bedrifter
        
      
        $HentButikker = mysql_query("SELECT * FROM Butikker WHERE Butikk_Gjeng='$Gjengnavn'");
        $AntallButikker = mysql_num_rows($HentButikker);
      
        $HentKulefabrikker = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Gjeng='$Gjengnavn'");
        $AntallKulefabrikker = mysql_num_rows($HentKulefabrikker) * '3';
        // Trenger aviser også men venter med det til jeg har laget aviser
        $AntallMakt = $AntallButikker + $AntallKulefabrikker;
        $ProsentStyring = floor('100' / '132' * $AntallMakt);

        if($ProsentStyring <= '0') { $MaktSYK = 'NULL'; } else { $MaktSYK = $ProsentStyring; }
        
        echo "
        <div class=\"Div_masta\">";
        
        $hva_skal_vises = mysql_real_escape_string($_REQUEST['RullanSaFronda']);
        if(!empty($hva_skal_vises)) { 
        if($type == 'A' || $type == 'm') { 
        if($hva_skal_vises == 'Gjeng' || $hva_skal_vises == 'Medlemmer') { 
        switch ($hva_skal_vises) {
        case "Gjeng": include "Annensider/Abc_gjeng_info.php"; break;
        case "Medlemmer": include "Annensider/Abc_gjeng_meds.php"; break;
        default: echo "";
        }}}}
        
        echo "
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">GJENGPROFIL</span></div>
        ".$bilde_er."
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gjeng</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$Gjeng_Navn.".</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gjeng styre</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">"; $it_neger = '0';  $Hent_styret = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE stilling = 'Boss' AND gjeng_id LIKE '$Gjeng_Id'"); while($styre_info = mysql_fetch_assoc($Hent_styret)) { $bruker_boss = $styre_info['brukernavn']; $it_neger++; if($it_neger >= '2') { echo ", <a href=\"game.php?side=Bruker&navn=".urlencode($bruker_boss)."\">".htmlspecialchars($bruker_boss)."</a>"; } else { echo "<a href=\"game.php?side=Bruker&navn=".urlencode($bruker_boss)."\">".htmlspecialchars($bruker_boss)."</a>"; }} echo ".</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Størrelse</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$GjengSTR gjeng, $GjengSTR2.</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Frykt nivå</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$FryktEN, $FryktTO</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Business drift</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">Styrer $MaktSYK prosent av mafianos forretninger.</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Grunnlagt</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$Gjeng_Grunnlagt_dato, det er ( ".calc_tid($tiden_blir_da)." ) siden.</span></div>";
        if($type == 'A' || $type == 'm') { 
        $GjengnavnUrl = urlencode($Gjengnavn);
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Informasjon</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"gjeng_infor\" onchange=\"window.open(this.options[this.selectedIndex].value,'_parent')\">
        <option>Velg hva du skal se</option>
        <option value=\"http://www.mafiano.no/game.php?side=Gjeng&navn=$GjengnavnUrl&RullanSaFronda=Gjeng\">Gjeng informasjon</option>
        <option value=\"http://www.mafiano.no/game.php?side=Gjeng&navn=$GjengnavnUrl&RullanSaFronda=Medlemmer\">Rediger medlemmer</option>
        <option value=\"http://www.mafiano.no/game.php?side=Gjeng&navn=$GjengnavnUrl&RullanSaFronda=Forum\">Rediger forum</option>
        </select></div>"; 
        } 
        echo "
        <div class=\"Div_MELDING\"><span class=\"Span_str_10\">".$tekst_2."</span></div>
        <div class=\"Div_MELDING\">
        ";
      
        $ikor = '0';
        if (mysql_num_rows($Gjeng_Medlemmer) == 0) { echo '<img style="Margin-left:5px;" border="0" src="ingen.png">'; } else { 
        while ($Medlem_info = mysql_fetch_assoc($Gjeng_Medlemmer)) {
        $ikor++;
        if($ikor >= '6') { $marg = "Margin-top:5px;"; } else { $marg = ''; }        
			$gjeng_medlem_info = mysql_query("SELECT * FROM `brukere` WHERE `brukernavn`='".$Medlem_info['brukernavn']."'");
			$gjeng_medlem_info = mysql_fetch_array($gjeng_medlem_info);
			
        echo '<a href="game.php?side=Bruker&navn='.urlencode($Medlem_info['brukernavn']).'"><img style="Margin-left:5px; '.$marg.'" width="92" height="82" border="0" src="'.$gjeng_medlem_info['profilbilde'].'"></a>';
        }}
        echo "
        </div>
        </div>
        ";
        
        }}}}
        ?>
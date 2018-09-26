        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        function calc_tid($sek) {if ($sek < 1) { return "0 sek"; }else { $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); $mins  = floor(($sek - $b) / 60); $a = ($hours * 3600) + ($mins * 60); $seks = $sek - $a; $ret = ""; if ($hours > 0) { $ret = $hours . " timer "; } if ($mins > 0) { $ret = $ret . $mins . " min "; } $ret = $ret . $seks . " sek"; return $ret; }}
        function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }
        function calc_skils($tall) { if($tall >= '320') {     $tall = 'Proff ( Grad: 4 )'; } elseif($tall >= '300') { $tall = 'Proff ( Grad: 3 )'; } elseif($tall >= '280') { $tall = 'Proff ( Grad: 2 )'; } elseif($tall >= '260') { $tall = 'Proff ( Grad: 1 )'; } elseif($tall >= '240') { $tall = 'Nesten proff ( Grad: 3 )'; } elseif($tall >= '220') { $tall = 'Nesten proff ( Grad: 2 )'; } elseif($tall >= '200') { $tall = 'Nesten proff ( Grad: 1 )'; } elseif($tall >= '180') { $tall = 'Ekstremt flink ( Grad: 3 )'; } elseif($tall >= '160') { $tall = 'Ekstremt flink ( Grad: 2 )'; } elseif($tall >= '140') { $tall = 'Ekstremt flink ( Grad: 1 )'; } elseif($tall >= '120') { $tall = 'Veldig flink ( Grad: 3 )'; } elseif($tall >= '100') { $tall = 'Veldig flink ( Grad: 3 )'; } elseif($tall >= '80') {  $tall = 'Veldig flink ( Grad: 1 )'; } elseif($tall >= '60') {  $tall = 'Flink ( Grad: 3 )'; } elseif($tall >= '40') {  $tall = 'Flink ( Grad: 2 )'; } elseif($tall >= '20') {  $tall = 'Flink ( Grad: 1 )'; } elseif($tall >= '10') {  $tall = 'Nybegynner ( Grad: 2 )'; } elseif($tall >= '0') {   $tall = 'Nybegynner ( Grad: 1 )'; } return $tall; }
  
        if($kjoonn == 'Gutt') { $din_kat = 'Mann'; } else { $din_kat = 'Dame'; }
        $horer_pult2 = $horer_pult + '2.5';
        $prisen_blir = $horer_pult2 * '100';

        $knulle_id = rengjor_tall(mysql_real_escape_string($_REQUEST['Banger']));
        $antall = rengjor_tall(mysql_real_escape_string($_REQUEST['s']));
        if(empty($antall)) { 
        $antall = '0';
        } else { 
        $antall = $antall - '1';
        }

      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
      
        $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=Sykehus"); } else { 
 
        // sjekker om du sitter i bunker
      
        $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
        if (mysql_num_rows($bunker_ell) >= '1') { header("Location: game.php?side=bunker"); } else {

        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=Fengsel"); } else {

      
        $sjekk_knulle_status = mysql_query("SELECT * FROM Horehus_Knull WHERE Knull_brukernavn='$brukernavn'");
        if (mysql_num_rows($sjekk_knulle_status) >= '1') {  
                
        // DU DRIVER Å KNULLER KAN INKLUDERES
        
        $Info_Bang = mysql_fetch_assoc($sjekk_knulle_status);
        $KK_Behandling = $Info_Bang['Knull_behandling'];
        $KK_Stilling = $Info_Bang['Knull_stilling'];
        $KK_Dato = $Info_Bang['Knull_dato'];
        $KK_Stamp = $Info_Bang['Knull_stamp'];
        $KK_StampOver = $Info_Bang['Knull_stamp_over'];
        $KK_HorehusId = $Info_Bang['Knull_horehus_id'];
        $KK_Sum = $Info_Bang['Knull_sum'];
        $KK_HvorLenge = ( $KK_StampOver - $KK_Stamp ) / '60';
        
        
        $Hent_Horehus = mysql_query("SELECT * FROM Horehus WHERE id='$KK_HorehusId'");
        $Info_Bang_2 = mysql_fetch_assoc($Hent_Horehus);
        $KK_HoreNavn = $Info_Bang_2['Bang_hore_er'];
        $KK_HoreKjonn = $Info_Bang_2['Bang_kjonn'];

        if($KK_Behandling == 'Bondage') { } 
        elseif($KK_Behandling == 'Vennelig') { }
        elseif($KK_Behandling == 'Voldtek') { }
     
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">HOREHUS</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Horehus.jpg\" width=\"490\" height=\"200\"></div>
        <div class=\"Div_MELDING\">
        <span class=\"Span_str_0\">Informasjon</span><br>
        <span class=\"Span_str_8\">Du startet seksuel aktivitet på følgende tidspunkt ".$KK_Dato.", du betalte hora ".number_format($KK_Sum, 0, ",", ".").". kroner for å ha sex i ".$KK_HvorLenge." minutter. 
        Personen du har samleie med heter <a href=\"game.php?side=Bruker&navn=".urlencode($KK_HoreNavn)."\">".htmlspecialchars($KK_HoreNavn)."</a> og er en ".strtolower($KK_HoreKjonn).".<br><br>Mer informasjon om det som skal skje kommer etterpå.
        </span><br>
        <span class=\"Span_str_8\">&nbsp;</span>
        </div></div>";
        
        // DU DRIVER Å KNULLER KAN INKLUDERES

        
        } else {
      
        $sjekk_horehus = mysql_query("SELECT * FROM Horehus WHERE Bang_hore_er='$brukernavn'");
        if (mysql_num_rows($sjekk_horehus) >= '1') {  
        include "Horehus_knuller_deg.php";
        } else {
        if(!empty($knulle_id)) { 
        include "Horehus_knull_hore.php";
        } else {
        include "Horehus_velg_hore.php";
        }}}}}}}}
        ?>
        
        
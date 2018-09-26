        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 

        function calc_tid($sek) {
        if ($sek < 1) {
        return "0 sek";
        }else {
        $hours = floor((($sek / 60) / 60));
        $b = ($hours * 3600);
        $mins  = floor(($sek - $b) / 60);
        $a = ($hours * 3600) + ($mins * 60);
        $seks = $sek - $a;
        $ret = "";
        if ($hours > 0) {
        $ret = $hours . " timer ";
        }
        if ($mins > 0) {
        $ret = $ret . $mins . " minutter ";
        }	
        $ret = $ret . $seks . " sekunder";
        return $ret;
        }}
        
        $tiden_seks_2ka = $tiden - $KF_INFO['KF_Opprettet_Stamp'];
        
        if(empty($KF_INFO['KF_Prod_Stamp'])) { $prod_tekst_blir_tda = 'Du kan produsere kuler om du har nok av de forsjellige råvarene, lykke til med første produksjon.'; } 
        elseif($KF_INFO['KF_Prod_Stamp'] > $tiden) { $prod_tekst_blir_tda = 'Du må vente '.calc_tid($tiden_seks_3ka).' før du kan produsere fler kuler.'; } 
        else { $prod_tekst_blir_tda = 'Du kan produsere kuler om du har nok av de forsjellige råvarene.'; }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_mellomledd ">&nbsp;</div>
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">INFORMASJON</span></div>
        <div class="Div_MELDING">
        <span class="Span_str_0">Fabrikk informasjon</span><br>
        <span class="Span_str_8">
        Fabrikk: <?=$KF_INFO['KF_Fabrikk'];?>.<br>
        Opprettet: <?=$KF_INFO['KF_Opprettet_Dato'];?>, det er ( <? echo calc_tid($tiden_seks_2ka); ?> ) siden.<br>
        Sted: Kulene blir solgt ut i <?=$KF_INFO['KF_Sted'];?>.<br>
        Gjeng samarbeid: <?=$KF_INFO['KF_Gjeng'];?>.<br>
        Utsalg: En enkelt kule selges ut for <? echo number_format($KF_INFO['KF_SlagsPris'], 0, ",", "."); ?> kr.<br>
        Fabrikk konto: <? echo number_format($KF_INFO['KF_Konto'], 0, ",", "."); ?> kr.<br>
        </span><br>
        <span class="Span_str_0">Lager informasjon</span><br>
        <span class="Span_str_8">
        Kuler: Det er <? echo number_format($KF_INFO['KF_Kuler'], 0, ",", "."); ?> kuler på lageret.<br>
        Bly: Det er <? echo number_format($KF_INFO['KF_bly'], 0, ",", "."); ?> kg bly på lageret.<br>
        Stål: Det er <? echo number_format($KF_INFO['KF_staal'], 0, ",", "."); ?> kg stål på lageret.<br>
        Krutt: Det er <? echo number_format($KF_INFO['KF_krutt'], 0, ",", "."); ?> kg krutt på lageret.<br>
        </span><br>
        <span class="Span_str_0">Produksjons priser</span><br>
        <span class="Span_str_8">
        Bly: En kilo bly koster <? echo number_format($KF_INFO['KF_bly_pris'], 0, ",", "."); ?> kr.<br>
        Stål: En kilo stål koster <? echo number_format($KF_INFO['KF_staal_pris'], 0, ",", "."); ?> kr.<br>
        Krutt: En kilo krutt koster <? echo number_format($KF_INFO['KF_krutt_pris'], 0, ",", "."); ?> kr.<br>
        Maskin: <? echo number_format($KF_INFO['KF_Prod_Pris'], 0, ",", "."); ?> kr per produksjon.<br>
        </span><br>
        <span class="Span_str_0">Produksjon tilstand</span><br>
        <span class="Span_str_8">
        <?=$prod_tekst_blir_tda;?>
        </span><br>
        <span class="Span_str_0">Statistikk</span><br>
        <span class="Span_str_8">
        Penger brukt: <? echo number_format($KF_INFO['KF_Brukt_Totalt'], 0, ",", "."); ?> kr.<br>
        Penger tjent: <? echo number_format($KF_INFO['KF_Tjent_Totalt'], 0, ",", "."); ?> kr.<br>
        Kuler solgt: <? echo number_format($KF_INFO['KF_KulerSolgt'], 0, ",", "."); ?> stk.<br>
        Største handel: <?=number_format($KF_INFO['KF_StorHandel'], 0, ",", ".");?> kuler solgt.<br>
        Antall salg: Det har blitt kjøpt kuler <? echo number_format($KF_INFO['KF_AntallSalg'], 0, ",", "."); ?> ganger.<br>
        </span><br>
        <span class="Span_str_8">&nbsp;</span>
        </div>
        <?
        }}
        ?>
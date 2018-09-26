        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        if(empty($gjeng)) { header("Location: index.php"); } else { 
        if($Din_stilling == 'Boss') {
         
        if(empty($Gjeng_Bilde)) { $bilde_er = "<div class=\"Div_bilde\"><p align=\"center\"><img border=\"0\" src=\"http://www.mafiano.no/Bilder/gjeng.jpg\"></p></div>"; } else { $bilde_er = "<div class=\"Div_MELDING\"><p align=\"center\"><img style=\"max-width:480px; max-height: 250px;\" border=\"0\" src=\"$Gjeng_Bilde\"></p></div>"; }

        if($Gjeng_ta_inn_ell == '1') { $tar_inn_ell = "<option value=\"1\">Tar inn medlemmer nå</option><option value=\"2\">Tar ikke inn medlemmer nå</option>"; } else { $tar_inn_ell = "<option value=\"2\">Tar ikke inn medlemmer nå</option><option value=\"1\">Tar inn medlemmer nå</option>"; }
        if($Gjeng_krav == '1') {      $krav_blir = "<option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; } 
        elseif($Gjeng_krav == '2') {  $krav_blir = "<option value=\"2\">Lærling / Luremus</option><option value=\"1\">Uteligger</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '3') {  $krav_blir = "<option value=\"3\">Bråkmaker / Forførerske</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '4') {  $krav_blir = "<option value=\"4\">Kriminell / Kriminell</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '5') {  $krav_blir = "<option value=\"5\">Gangster / Gangsterinne</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '6') {  $krav_blir = "<option value=\"6\">Attentatmann / Attentatdame</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '7') {  $krav_blir = "<option value=\"7\">Torpedo / Morderske</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '8') {  $krav_blir = "<option value=\"8\">Kaptein / Kaptein</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '9') {  $krav_blir = "<option value=\"9\">Narko Baron / Baronesse</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '10') { $krav_blir = "<option value=\"10\">Sjef / Sjef</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '11') { $krav_blir = "<option value=\"11\">Gudfar / Gudmor</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '12') { $krav_blir = "<option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"13\">Don / Grevinne</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '13') { $krav_blir = "<option value=\"13\">Don / Grevinne</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"14\">Leg.Don / Herskerinne</option>"; }
        elseif($Gjeng_krav == '14') { $krav_blir = "<option value=\"14\">Leg.Don / Herskerinne</option><option value=\"1\">Uteligger</option><option value=\"2\">Lærling / Luremus</option><option value=\"3\">Bråkmaker / Forførerske</option><option value=\"4\">Kriminell / Kriminell</option><option value=\"5\">Gangster / Gangsterinne</option><option value=\"6\">Attentatmann / Attentatdame</option><option value=\"7\">Torpedo / Morderske</option><option value=\"8\">Kaptein / Kaptein</option><option value=\"9\">Narko Baron / Baronesse</option><option value=\"10\">Sjef / Sjef</option><option value=\"11\">Gudfar / Gudmor</option><option value=\"12\">Leg.Gudfar / Leg.Gudmor</option><option value=\"13\">Don / Grevinne</option>"; }

        function Fiks_Post_Gjengnavn($navn){ $navn = htmlspecialchars($navn); $navn = ereg_replace("[^A-Za-z0-9 ]", "", $navn); if(strlen($navn) > '20') { $navn = substr($navn, 0, 20) . ''; } return $navn; }
        function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }
        function calc_tid($sek) { if ($sek < 1) { return "0 sek"; }else { $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); $mins  = floor(($sek - $b) / 60); $a = ($hours * 3600) + ($mins * 60); $seks = $sek - $a; $ret = ""; if ($hours > 0) { $ret = $hours . " timer "; } if ($mins > 0) { $ret = $ret . $mins . " min "; } $ret = $ret . $seks . " sek"; return $ret; }}


        echo "
        <div class=\"Div_masta\"><form method=\"post\" id=\"LAGRE\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">REDIGER GJENGEN</span><input type=\"hidden\" name=\"action\" id=\"du_valgte\" /></div>
        ".$bilde_er."
        ";
        
        $Spleising_Ja = rengjor_tall(mysql_real_escape_string($_REQUEST['Spleis']));
        $Spleising_Nope = rengjor_tall(mysql_real_escape_string($_REQUEST['SpleisNope']));

        if(!empty($Spleising_Ja)) { 
        
      
        $Sjekk_spleis = mysql_query("SELECT * FROM Gjeng_spleising WHERE til_gjeng_id='$Din_gjeng_id' AND id='$Spleising_Ja' AND stamp_over > '$tiden'");
        if (mysql_num_rows($Sjekk_spleis) >= '1') {
        $Spleis_info2 = mysql_fetch_assoc($Sjekk_spleis);
        $Gjengens_id_22 = $Spleis_info2['fra_gjeng_id'];
        $Dato_spurt_22 = $Spleis_info2['dato_spurt'];
        $Stamp_spurt_22 = $Spleis_info2['dato_stamp'];
        $Stilling_blir_22 = $Spleis_info2['stilling_blir'];
        $Medlemmer_blir_22 = $Spleis_info2['medlemmer_blir'];
        $Stamp_over_22 = $Spleis_info2['stamp_over'];
        
        $Finn_gjeng11 = mysql_query("SELECT * FROM Gjenger WHERE id='$Gjengens_id_22'");
        if (mysql_num_rows($Finn_gjeng11) >= '1') { 
        $Gjeng_info_2 = mysql_fetch_assoc($Finn_gjeng11);

        // Informasjon om gjengen som har sendt deg forespørslen
        $Gjeng_navn_22 = $Gjeng_info_2['Gjeng_Navn'];
        $Gjeng_penger_22 = $Gjeng_info_2['Gjeng_Penger'];
        $Gjeng_poeng_22 = $Gjeng_info_2['Gjeng_Poeng'];
        $Gjeng_bombechips_22 = $Gjeng_info_2['Gjeng_Bombechips'];
        $Gjeng_kriger_vunnget_22 = $Gjeng_info_2['kriger_vunnet'];
        $Gjeng_utpress_22 = $Gjeng_info_2['utpressinger'];
        $Gjeng_antall_gjenger_22 = $Gjeng_info_2['antall_gjenger'];
        $Gjeng_plass_til_22 = $Gjeng_info_2['plass_til'];
        $Gjeng_drap_22 = $Gjeng_info_2['drap'];


        $Ny_1 = floor($Gjeng_penger_22 + $Gjeng_Penger);
        $Ny_2 = floor($Gjeng_poeng_22 + $Gjeng_Poeng);
        $Ny_3 = floor($Gjeng_bombechips_22 + $Gjeng_Bombechips);
        $Ny_4 = floor($Gjeng_kriger_vunnget_22 + $Gjeng_Kriger_vunnet);
        $Ny_5 = floor($Gjeng_utpress_22 + $Gjeng_utpressinger);
        $Ny_6 = floor($Gjeng_antall_gjenger_22 + $Gjeng_antall_gjenger);
        $Ny_7 = floor($Gjeng_plass_til_22 + $Gjeng_plass_til);
        $Ny_8 = floor($Gjeng_drap_22 + $Gjeng_drap);

        if($Ny_6 < '3') { 
        
      
        mysql_query("UPDATE Gjenger SET Gjeng_Penger='$Ny_1',Gjeng_Poeng='$Ny_2',Gjeng_Bombechips='$Ny_3',kriger_vunnet='$Ny_4',utpressinger='$Ny_5',antall_gjenger='$Ny_6',plass_til='$Ny_7',drap='$Ny_8' WHERE id='$Din_gjeng_id'");
        mysql_query("DELETE FROM Gjeng_spleising WHERE til_gjeng_id='$Din_gjeng_id' AND id='$Spleising_Ja'");
        mysql_query("DELETE FROM Gjenger WHERE id='$Gjengens_id_22'");
      
        
        // fikser med medlemmene
        if($Medlemmer_blir_22 == 'BlirMed') {
        mysql_query("UPDATE brukere SET gjeng='$Gjeng_Navn' WHERE gjeng LIKE '$Gjeng_navn_22'");
        mysql_query("UPDATE Gjeng_medlemmer SET gjeng_id='$Din_gjeng_id',ansatt_dato='$tid $nbsp $dato',ansatt_stamp='$tiden',penger_don='0',poeng_don='0',bombechips_don='0' WHERE gjeng_id='$Gjengens_id_22' AND stilling LIKE 'Medlem'");
        } else { 
        mysql_query("UPDATE brukere SET gjeng='' WHERE gjeng LIKE '$Gjeng_navn_22'");
        mysql_query("DELETE FROM Gjeng_medlemmer WHERE gjeng_id='$Gjengens_id_22' AND stilling='Medlem'");
        }
        
        // Fikser med bossene
        if($Stilling_blir_22 == 'Delt') {
        mysql_query("UPDATE brukere SET gjeng='$Gjeng_Navn' WHERE gjeng LIKE '$Gjeng_navn_22'");
        mysql_query("UPDATE Gjeng_medlemmer SET gjeng_id='$Din_gjeng_id',ansatt_dato='$tid $nbsp $dato',ansatt_stamp='$tiden',penger_don='0',poeng_don='0',bombechips_don='0' WHERE gjeng_id='$Gjengens_id_22' AND stilling LIKE 'Boss'");
        } else { 
        mysql_query("UPDATE brukere SET gjeng='$Gjeng_Navn' WHERE gjeng LIKE '$Gjeng_navn_22'");
        mysql_query("UPDATE Gjeng_medlemmer SET stilling='Medlem',gjeng_id='$Din_gjeng_id',ansatt_dato='$tid $nbsp $dato',ansatt_stamp='$tiden',penger_don='0',poeng_don='0',bombechips_don='0' WHERE gjeng_id='$Gjengens_id_22' AND stilling LIKE 'Boss'");
        }
      
        mysql_query("DELETE FROM Invite_diverse WHERE Invitert_type='Gjeng' AND Invitert_bedrift_id='$Din_gjeng_id'");
        mysql_query("DELETE FROM Invite_diverse WHERE Invitert_type='Gjeng' AND Invitert_bedrift_id='$Gjengens_id_22'");
        
        echo '<div class="Div_MELDING"><span class="Span_str_6">Spleising utørt.</span></div>';

        
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Gjengene deres kan desverre ikke spleises fordi total summen på antall gjenger dere har spleiset dere med er for stor.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Gjengen eksisterer desverre ikke lengere.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke godta en spleising som ikke eksisterer.</span></div>'; }
        
        } else {
        if(!empty($Spleising_Nope)) { 
      
        $Sjekk_spleis = mysql_query("SELECT * FROM Gjeng_spleising WHERE til_gjeng_id='$Din_gjeng_id' AND id='$Spleising_Nope' AND stamp_over > '$tiden'");
        if (mysql_num_rows($Sjekk_spleis) >= '1') {
        mysql_query("DELETE FROM Gjeng_spleising WHERE til_gjeng_id='$Din_gjeng_id' AND id='$Spleising_Nope' AND stamp_over > '$tiden'");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har avslått spleisingen.</span></div>';
        } else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke avslå en spleising som ikke eksisterer.</span></div>';
        }} else {

        
        
        if(isset($_POST['action']) && $_POST['action'] == "Rediger") { 
        $Post_Gjengnavn = Fiks_Post_Gjengnavn(mysql_real_escape_string($_POST['Gjengnavn']));
        $Post_Avatar = htmlspecialchars(mysql_real_escape_string($_POST['avatar']));
        $Post_Inntak = htmlspecialchars(mysql_real_escape_string($_POST['Inntak']));
        $Post_Krav = htmlspecialchars(mysql_real_escape_string($_POST['krav']));
        $Post_Tekst = htmlspecialchars(mysql_real_escape_string($_POST['fri_tekst']));

        if($Post_Gjengnavn == $Gjeng_Navn && $Post_Avatar == $Gjeng_Bilde && $Post_Inntak == $Gjeng_ta_inn_ell && $Post_Krav == $Gjeng_krav && $Post_Tekst == $Gjeng_Tekst) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">All informasjonen er lik, ingenting er endret.</span></div>';
        } else {
        if(empty($Post_Gjengnavn) || empty($Post_Inntak) || empty($Post_Krav)) { 
        echo '<div class="Div_MELDING">';
        if(empty($Post_Gjengnavn)) { echo '<span class="Span_str_5">Du har ikke skrevet inn et gjengnavn.</span>'; }
        if(empty($Post_Inntak)) { echo '<span class="Span_str_5">Du har ikke valgt om du skal ta inn medlemmer eller ikke.</span>'; }
        if(empty($Post_Krav)) { echo '<span class="Span_str_5">Du har ikke valgt et rank krav.</span>'; }
        echo "</div>";
        } else { 
        if($Post_Inntak == '1' || $Post_Inntak == '2') {
        if($Post_Krav == '1' || $Post_Krav == '2' || $Post_Krav == '3' || $Post_Krav == '4' || $Post_Krav == '5' || $Post_Krav == '6' || $Post_Krav == '7' || $Post_Krav == '8' || $Post_Krav == '9' || $Post_Krav == '10' || $Post_Krav == '11' || $Post_Krav == '12' || $Post_Krav == '13' || $Post_Krav == '14') { 
        if(strlen($Post_Tekst) > '20000') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Gjeng teksten er for lang.</span></div>';
        } else { 
        if(strlen($Post_Avatar) > '300') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Avatar lenken er for lang.</span></div>';
        } else { 
        echo '<div class="Div_MELDING">';
      
        if($Post_Gjengnavn != $Gjeng_Navn) { $Sjekk_GjengNavn = mysql_query("SELECT * FROM Gjenger WHERE Gjeng_Navn='$Post_Gjengnavn'"); if(mysql_num_rows($Sjekk_GjengNavn) >= '1') { echo '<span class="Span_str_5">Gjengnavnet er allerede brukt av en annen gjeng.</span>'; } else { mysql_query("UPDATE Gjenger SET Gjeng_Navn='$Post_Gjengnavn' WHERE id='$Din_gjeng_id'"); mysql_query("UPDATE brukere SET gjeng='$Post_Gjengnavn' WHERE gjeng='$Gjeng_Navn'");  mysql_query("UPDATE forum_traader SET startet_gjeng='$Post_Gjengnavn' WHERE startet_gjeng='$gjeng'");  echo '<span class="Span_str_6">Gjengnavnet er endret.</span>'; }}
        if($Post_Avatar != $Gjeng_Bilde) { mysql_query("UPDATE Gjenger SET bilde='$Post_Avatar' WHERE id='$Din_gjeng_id'"); echo '<span class="Span_str_6">Avatar lenken er endret.</span>'; }
        if($Post_Inntak != $Gjeng_ta_inn_ell) { mysql_query("UPDATE Gjenger SET tar_inn_ell='$Post_Inntak' WHERE id='$Din_gjeng_id'"); echo '<span class="Span_str_6">Intakk av medlemmer er endret.</span>'; }
        if($Post_Krav != $Gjeng_krav) { mysql_query("UPDATE Gjenger SET rank_krav='$Post_Krav' WHERE id='$Din_gjeng_id'"); echo '<span class="Span_str_6">Rank kravet er endret.</span>'; }
        if($Post_Tekst != $Gjeng_Tekst) { mysql_query("UPDATE Gjenger SET tekst='$Post_Tekst' WHERE id='$Din_gjeng_id'"); echo '<span class="Span_str_6">Gjeng teksten er endret.</span>'; }
        echo "</div>";
        }}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig valg.</span></div>';
        }} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig valg.</span></div>';
        }}}} elseif(isset($_POST['action']) && $_POST['action'] == "Spleising") { 
        $Valgt_Gjeng = rengjor_tall(htmlspecialchars(mysql_real_escape_string($_POST['GjengNavn_TTT'])));
        $Valgt_Stilling = htmlspecialchars(mysql_real_escape_string($_POST['DinStilling_TTT']));
        $Valg_for_medlemmer = htmlspecialchars(mysql_real_escape_string($_POST['Medlemmer_TTT']));

      
        $Spleis_sjekk = mysql_query("SELECT * FROM Gjeng_spleising WHERE fra_gjeng_id='$Din_gjeng_id' AND stamp_over > '$tiden'");
        if (mysql_num_rows($Spleis_sjekk) >= '1') {
        $Spleis_info = mysql_fetch_assoc($Spleis_sjekk);
        $Til_Avtalt_Id = $Spleis_info['til_gjeng_id'];
        $Avtale_stamp_over = $Spleis_info['stamp_over'];
        $innen_sek_omme = $Avtale_stamp_over - $tiden;
      
        $Avtalt_gjeng_er = mysql_query("SELECT * FROM Gjenger WHERE id='$Til_Avtalt_Id'");
        if (mysql_num_rows($Avtalt_gjeng_er) == '0') { 
        mysql_query("DELETE FROM Gjeng_spleising WHERE fra_gjeng_id='$Din_gjeng_id'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har egentlig spurt om å spleise gjeng med noen allerede, gjengen du skulle spleise med eksisterer desverre ikke lengere så spillet avslutter spleisingen nå.</span></div>";
        } else {
        $Avtalt_gjeng_Info = mysql_fetch_assoc($Avtalt_gjeng_er);
        $Til_Gjengnavn = $Avtalt_gjeng_Info['Gjeng_Navn']; 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har allerede spurt ".$Til_Gjengnavn.", vist gjengen ikke godtar spleisingen innen <span id=\"tell\">".$innen_sek_omme."</span> sek blir spleisingen avbrutt.</span></div>";
        }} else { 
        if($Gjeng_Penger < '10000000') {
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har desverre ikke nok penger i gjeng kontoen din til å starte en spleising.</span></div>";
        } else { 
        if(empty($Valgt_Gjeng) || empty($Valgt_Stilling) || empty($Valg_for_medlemmer)) { 
        echo '<div class="Div_MELDING">';
        if(empty($Valgt_Gjeng)) { echo '<span class="Span_str_5">Du har ikke valgt hvilken gjeng du ønsker å spleise deg sammen med.</span>'; }
        if(empty($Valgt_Stilling)) { echo '<span class="Span_str_5">Du har ikke valgt hvilken stilling du skal ha etter spleisingen.</span>'; }
        if(empty($Valg_for_medlemmer)) { echo '<span class="Span_str_5">Du har ikke valgt hva som skal skje med med medlemmene i gjengen din.</span>'; }
        echo '</div>';
        } else { 
      
        $Finn_gjeng = mysql_query("SELECT * FROM Gjenger WHERE id='$Valgt_Gjeng'");
        if (mysql_num_rows($Finn_gjeng) >= '1') { 
        $Avtalt_gjeng_Info = mysql_fetch_assoc($Finn_gjeng);
        $Til_Gjengnavn = $Avtalt_gjeng_Info['Gjeng_Navn']; 
        $Til_Gjengid = $Avtalt_gjeng_Info['id']; 
        if($Til_Gjengid == $Din_gjeng_id) { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke spleise gjengen din med din egen gjeng, funker ikke å endre kildekoden.</span></div>";
        } else { 
        if($Valgt_Stilling == 'Delt' || $Valgt_Stilling == 'Overlater') {
        if($Valg_for_medlemmer == 'BlirMed' || $Valg_for_medlemmer == 'StikkAv') {
        $ny_suM_gjeng_Spenn = floor($Gjeng_Penger - '10000000');
        $stamp_over = $tiden + '3600';
      
        mysql_query("INSERT INTO `Gjeng_spleising` (fra_gjeng_id, til_gjeng_id, dato_spurt, dato_stamp, stilling_blir, medlemmer_blir, stamp_over) VALUES ('$Din_gjeng_id','$Til_Gjengid','$tid $nbsp $dato','$tiden','$Valgt_Stilling','$Valg_for_medlemmer','$stamp_over')");
        mysql_query("UPDATE Gjenger SET Gjeng_Penger='$ny_suM_gjeng_Spenn' WHERE id='$Din_gjeng_id'");
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du har startet en spleising med ".$Til_Gjengnavn.", det kostet 10 millioner kroner. Vist den andre gjengen ikke godtar spleisingen innen en time vil forespørselen bli avbrutt.</span></div>";
        } else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ugyldig valg.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ugyldig valg.</span></div>";
        }}} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Gjengen du valgte eksisterer ikke.</span></div>";
        }}}}}
        
        
        // Lukker spleising
        }}
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gjeng</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Gjengnavn\" maxlength=\"20\"  value=\"$Gjeng_Navn\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Avatar</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"avatar\" maxlength=\"300\"  value=\"$Gjeng_Bilde\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Inntak?</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Inntak\" size=\"1\">".$tar_inn_ell."</select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Inntaks krav</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"krav\" size=\"1\">".$krav_blir."</select></div>
        <div class=\"Div_venstre_side_2\"></div>
        <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"fri_tekst\">$Gjeng_Tekst</textarea></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('du_valgte').value='Rediger';document.getElementById('LAGRE').submit()\"><p class=\"pan_str_2\">LAGRE</p></div>
        ";
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">SPLEIS GJENG</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Kostnad</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">Spleising av gjeng koster ti millioner kroner</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg gjeng</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"GjengNavn_TTT\" size=\"1\">
        ";
        
      
        $ikke_pal = '0';
        $Hent_Alle_Gjenger = mysql_query("SELECT * FROM Gjenger WHERE Gjeng_Navn NOT LIKE '$gjeng' ORDER BY `Stamp_Startet` ASC");
        if (mysql_num_rows($Hent_Alle_Gjenger) >= '1') { 
        while($Gjen_LLL_Navn = mysql_fetch_assoc($Hent_Alle_Gjenger)) { 
        $ikke_pal++;
        if($ikke_pal < '10') { $ikke_pal = "0$ikke_pal"; }
        $FuKA_ID_2 = $Gjen_LLL_Navn['id'];
        echo "<option value=\"$FuKA_ID_2\">".$ikke_pal.": ".htmlspecialchars($Gjen_LLL_Navn['Gjeng_Navn'])."</option>";
        }}
        ;
        
        echo "
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Stilling</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"DinStilling_TTT\" size=\"1\"><option value=\"Delt\">Delt gjengledelse, du får boss stilling.</option><option value=\"Overlater\">Overlater styringen til den andre gjengen.</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Medlemmer</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Medlemmer_TTT\" size=\"1\"><option value=\"BlirMed\">Alle medlemmene blir overført til den nye gjengen.</option><option value=\"StikkAv\">Medlemmene blir kastet ut.</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('du_valgte').value='Spleising';document.getElementById('LAGRE').submit()\"><p class=\"pan_str_2\">START SPLEISING</p></div></form>
        ";
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">TILBUD OM GJENGSPLEISING</span></div>
        ";
        
      
        $Hent_Spleisinger = mysql_query("SELECT * FROM Gjeng_spleising WHERE til_gjeng_id='$Din_gjeng_id' AND stamp_over > '$tiden' ORDER BY `dato_stamp` ASC");
        if (mysql_num_rows($Hent_Spleisinger) == '0') {  
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ingen tilbud.</span></div>";
        } else {
        while($Spleis_info = mysql_fetch_assoc($Hent_Spleisinger)) {
        $Id_spleis = $Spleis_info['id'];
        $Gjengens_id = $Spleis_info['fra_gjeng_id'];
        $Dato_spurt = $Spleis_info['dato_spurt'];
        $Stamp_spurt = $Spleis_info['dato_stamp'];
        $Stilling_blir = $Spleis_info['stilling_blir'];
        $Medlemmer_blir = $Spleis_info['medlemmer_blir'];
        $Stamp_over = $Spleis_info['stamp_over'];

        $sek_siden = $tiden - $Stamp_spurt;
        $sek_utloper = $Stamp_over - $tiden;

        $Hent_Gjeng_Skit = mysql_query("SELECT * FROM Gjenger WHERE id='$Gjengens_id'");
        $Hent_Gjeng_Skit = mysql_fetch_assoc($Hent_Gjeng_Skit);

        if($Stilling_blir == 'Delt') { $stilling_er = "Gjenglederen ønsker å styre gjengen sammen med deg"; } else { $stilling_er = "Gjenglederen vil at du skal styre gjengen"; }
        if($Medlemmer_blir == 'BlirMed') { $medlemmer_er = "Medlemmene fra den andre gjengen blir overført til din gjeng"; } else { $medlemmer_er = "Medlemmene fra den andre gjengen blir ikke med"; }
        
        echo "
        <div class=\"Div_Porno_0\">
        <span class=\"Span_str_8\">
        <b>Gjeng:</b> <a href=\"game.php?side=Gjeng&navn=".urlencode($Hent_Gjeng_Skit['Gjeng_Navn'])."\">".$Hent_Gjeng_Skit['Gjeng_Navn']."</a><br>
        <b>Dato motatt:</b> ".$Dato_spurt.", det er ( ".calc_tid($sek_siden)." ) siden<br>
        <b>Stilling info:</b> ".$stilling_er."<br>
        <b>Medlemmes info:</b> ".$medlemmer_er."<br>
        <b>Forespørslen utløper om:</b> ".$sek_utloper." sekunder<br>
        <span style=\"float:right;\"><b><a href=\"game.php?side=Gjengpanel&Gangsta=Rediger&Spleis=".$Id_spleis."\">GODTA</a></b> - <b><a href=\"game.php?side=Gjengpanel&Gangsta=Rediger&SpleisNope=".$Id_spleis."\">AVSLÅ</a></b></span></span><br>
        </div>";

        }}
        
        echo "
        </div>
        ";
        
        
        } else { header("Location: game.php?side=Gjengpanel"); }}}}
        ?>
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
      
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
        
        
        // Sjekker om du har høy nok rank
        if($rank_niva >= '5') {
        
        // Sjekker om du produserer film
      
        $film_sjekk_om = mysql_query("SELECT * FROM filmer_produser WHERE ditt_brukernavn='$brukernavn'");
        if (mysql_num_rows($film_sjekk_om) == '0') { $steg = '0'; } else { 
        
        // Setter varriablene
        $row = mysql_fetch_assoc($film_sjekk_om);
        $steg = $row['film_igang'];
        $hovedrolle_K2 = $row['hovedrolle'];
        $middelsrolle_K2 = $row['middelsrolle'];
        $litenrolle_K2 = $row['litenrolle'];
        $statister_K2 = $row['statister'];
        $filming_K2 = $row['filming'];
        $vis_K2 = $row['vis'];
        $markeds_K2 = $row['markeds'];
        $genere_K2 = $row['genere'];
        $film_pris_K2 = $row['film_pris'];
        $tittel_pris_K2 = $row['tittel'];
        $tidslengde_K2 = $row['tidslengde_film'];
        $dato_startet_K2 = $row['dato_startet'];

        }}
        
        // Statuser
        if($antall_film_prod >= '0') {  $produsent_status = 'Ingen vet hvem du er.'; } 
        if($antall_film_prod >= '1') {  $produsent_status = 'To-tre personener kjenner til deg.'; } 
        if($antall_film_prod >= '3') {  $produsent_status = 'Nabolaget vet hvem du er.'; } 
        if($antall_film_prod >= '5') {  $produsent_status = 'Hele fylket har hørt om deg.'; } 
        if($antall_film_prod >= '7') {  $produsent_status = 'Nesten hele Norge har hørt om deg.'; }
        if($antall_film_prod >= '9') {  $produsent_status = 'Både befolkningen i Norge og Svergie vet om deg'; }
        if($antall_film_prod >= '11') { $produsent_status = 'Både befolkningen i Norge, Svergie, Danmark vet om deg'; }
        if($antall_film_prod >= '13') { $produsent_status = 'Hele scandinavia vet om deg'; }
        if($antall_film_prod >= '15') { $produsent_status = 'Hele scandinavia forguder deg.'; } 
        if($antall_film_prod >= '17') { $produsent_status = 'Det går rykter om deg i Europa.'; } 
        if($antall_film_prod >= '19') { $produsent_status = 'Sju-åtte land i Europa vet om deg.'; } 
        if($antall_film_prod >= '21') { $produsent_status = 'Du er kjent i nesten hele Europa.'; } 
        if($antall_film_prod >= '23') { $produsent_status = 'Europa begynner å like deg.'; } 
        if($antall_film_prod >= '25') { $produsent_status = 'Europa liker deg som produsent'; } 
        if($antall_film_prod >= '27') { $produsent_status = 'Hele Europa ser på deg som en av de beste produsentene'; } 
        if($antall_film_prod >= '29') { $produsent_status = 'Europa ser på deg som den beste film produsent.'; } 
        if($antall_film_prod >= '31') { $produsent_status = 'Det går rykter om deg i Usa.'; } 
        if($antall_film_prod >= '33') { $produsent_status = 'Det går rykter om deg i både Usa og Canada.'; }
        if($antall_film_prod >= '35') { $produsent_status = 'Canada og usa har hørt om filmene dine.'; } 
        if($antall_film_prod >= '37') { $produsent_status = 'Hele Canada og usa er fan av filmene dine.'; } 
        if($antall_film_prod >= '39') { $produsent_status = 'Filmene dine blir statig vekk vist på tv i hele verden.'; } 
        if($antall_film_prod >= '41') { $produsent_status = 'Hele verden vet snart om deg.'; } 
        if($antall_film_prod >= '43') { $produsent_status = 'Hele verden har hørt om deg men de er litt skeptiske enda.'; } 
        if($antall_film_prod >= '45') { $produsent_status = 'Hele verden godtar deg som film produsent.'; } 
        if($antall_film_prod >= '47') { $produsent_status = 'Hele verden liker filmene du produserer.'; } 
        if($antall_film_prod >= '49') { $produsent_status = 'Hele verden forguder dine filmer'; } 

        if(empty($genere_K2)) { $teskt_tok_vises = 'PRODUSER FILM'; } else { $teskt_tok_vises2 = strtoupper($genere_K2); $teskt_tok_vises = "PRODUSER EN FILM - $teskt_tok_vises2"; }

        
        ?>
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2"><?=$teskt_tok_vises;?></span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/film.jpg"></div>
        <?
        if($rank_niva < '5') {
        if($kjoonn == 'Gutt') { $ranken_du_ha = 'Gangster'; } else { $ranken_du_ha = 'Gangsterinne'; }
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du må ha en høyere eller lik rank som '.$ranken_du_ha.' for å produsere filmer.</span></div>'; 
        } else {
        if($film_tid > $tiden) { $ventetiden_blir = $film_tid - $tiden; } else { $ventetiden_blir = '0'; } 
        if($film_tid > $tiden) { echo "<div class=Div_MELDING><span class=Span_str_5>Du kan ikke produsere en film før <span id='tell'>$ventetiden_blir</span> sekunder er omme.</span></div>"; } else {
        if($steg == '0') { include "Abc_produserfilm_steg_0.php"; }
        if($steg == '1') { if(isset($_POST['hovedrolle'])) { include "Abc_produserfilm_steg_1_kode.php"; } include "Abc_produserfilm_steg_1.php"; }
        if($steg == '2') { 
        if(isset($_POST['action'])) { include "Abc_produserfilm_steg_2_kode.php"; } else { include "Abc_produserfilm_steg_2.php"; }}}

        }
        ?>
        </div>
        <?
        // Lukker Toppen
        }}}}}
        ?>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <?
     if (empty($brukernavn)) { header("Location: index.php"); } else {
     
     $ny_sum_penger_blir = $penger - '900';
     $ny_reise_ventetid = $tiden + '900';
   
     mysql_query("UPDATE brukere SET penger='$ny_sum_penger_blir',land='$valgt_sted',reise_tid='$ny_reise_ventetid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
     mysql_query("UPDATE fly_osv SET Frakt_sted='$valgt_sted' WHERE Frakt_eier='$brukernavn' AND id LIKE '$valgt_fly_id'"); 
     $Fly_Tekst_svar = array("Du krasjet nesten i $valgt_sted flytårn.","Flyet sank drastisk i lufthøyde under turen, skade i motoren.","Motoren på flyet streiket i 10 sekunder med du klarte å komme deg til $valgt_sted forde.","Du holdt på å styrte flyet ditt men heldigvis klarte du å rette det opp igjen.","Flyet ditt havarerte over $valgt_sted by, men du klarte å lande flyet med litt flaks.");
     $Fly_Tekst_svar = $Fly_Tekst_svar[array_rand($Fly_Tekst_svar)];
   
     echo '<div class="Div_MELDING">';
     echo '<span class="Span_str_6">'.$Fly_Tekst_svar.'</span>';
     echo '</div>';
     }
     ?>
        
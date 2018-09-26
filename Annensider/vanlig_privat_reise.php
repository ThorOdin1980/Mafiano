     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <?
     if (empty($brukernavn)) { header("Location: index.php"); } else {
     
     $ny_sum_penger_blir = $penger - '900';
     $ny_reise_ventetid = $tiden + '900';
   
     mysql_query("UPDATE brukere SET penger='$ny_sum_penger_blir',land='$valgt_sted',reise_tid='$ny_reise_ventetid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
     mysql_query("UPDATE fly_osv SET Frakt_sted='$valgt_sted' WHERE Frakt_eier='$brukernavn' AND id LIKE '$valgt_fly_id'"); 
   
     echo '<div class="Div_MELDING">';
     echo '<span class="Span_str_6">Du har reist til '.$valgt_sted.' med privat flyet ditt.</span>';
     echo '</div>';
     }
     ?>
        
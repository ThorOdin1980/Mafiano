        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        
        if($bryt_ut_antall >= '0')  { $klare_bryt_eller = array("NEI"); }
        if($bryt_ut_antall >= '4')  { $klare_bryt_eller = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '6')  { $klare_bryt_eller = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '8')  { $klare_bryt_eller = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '10')  { $klare_bryt_eller = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '12') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '14') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '16') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","JA","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '18') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","JA","JA","NEI","NEI"); }
          
        ?>
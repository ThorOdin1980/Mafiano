        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        
        if($bryt_ut_antall >= '0')  { $klare_bryt_eller = array("NEI"); }
        if($bryt_ut_antall >= '16')  { $klare_bryt_eller = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '18')  { $klare_bryt_eller = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '20')  { $klare_bryt_eller = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '22')  { $klare_bryt_eller = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '24') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '26') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '28') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","JA","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '30') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","JA","JA","NEI","NEI"); }
          
        ?>
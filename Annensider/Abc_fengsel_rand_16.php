        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        
        if($bryt_ut_antall >= '0')  { $klare_bryt_eller = array("NEI"); }
        if($bryt_ut_antall >= '32')  { $klare_bryt_eller = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '34')  { $klare_bryt_eller = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '36')  { $klare_bryt_eller = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '38')  { $klare_bryt_eller = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '40') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '42') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '44') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","JA","NEI","NEI","NEI"); }
        if($bryt_ut_antall >= '46') { $klare_bryt_eller = array("JA","JA","JA","JA","JA","JA","JA","JA","NEI","NEI"); }
          
        ?>
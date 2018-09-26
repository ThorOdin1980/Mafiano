        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
         
        if($hovedrolle_K2 == 'Kirsten Dunst') {     $svar_1 = 'Drama_Action_Komedie'; }
        if($hovedrolle_K2 == 'Salma Hayek') {       $svar_1 = 'Drama_Action'; }
        if($hovedrolle_K2 == 'Quentin Tarantino') { $svar_1 = 'Action_Grøsser'; }
        if($hovedrolle_K2 == 'Woody Harrelson') {   $svar_1 = 'Drama_Komedie'; }
        if($hovedrolle_K2 == 'Jennifer Aniston') {  $svar_1 = 'Drama_Komedie'; }
        if($hovedrolle_K2 == 'Sandra Bullock') {    $svar_1 = 'Komedie_Action'; }
        if($hovedrolle_K2 == 'Joe Pesci') {         $svar_1 = 'Action_Komedie'; }
        if($hovedrolle_K2 == 'Jim Carrey') {        $svar_1 = 'Komedie'; }
        if($hovedrolle_K2 == 'Tom Cruise') {        $svar_1 = 'Action'; }  
        if($hovedrolle_K2 == 'Pierce Brosnan') {    $svar_1 = 'Action_Drama'; }
        if($hovedrolle_K2 == 'Vin Diesel') {        $svar_1 = 'Action_Komedie'; }
        if($hovedrolle_K2 == 'Bruce willis') {      $svar_1 = 'Action'; }
        if($hovedrolle_K2 == 'Wesley Snipes') {     $svar_1 = 'Action_Komedie'; }   
        if($hovedrolle_K2 == 'Mel Gibson') {        $svar_1 = 'Drama_Action'; }
        if($hovedrolle_K2 == 'Will Smith') {        $svar_1 = 'Drama_Action_Komedie'; }
        if($hovedrolle_K2 == 'Sylvester Stallone') {$svar_1 = 'Action'; }   
        if($hovedrolle_K2 == 'Samuel L. Jackson') { $svar_1 = 'Drama_Action_Komedie'; }
        if($hovedrolle_K2 == 'Al Pacino') {         $svar_1 = 'Grøsser_Action'; }   
        if($hovedrolle_K2 == 'John Travolta') {     $svar_1 = 'Action'; }
        if($hovedrolle_K2 == 'Nicolas Cage') {      $svar_1 = 'Drama_Action_Komedie'; }   
        
        if($middelsrolle_K2 == 'Cillian Murphy') {   $svar_2 = 'Drama_Grøsser'; }
        if($middelsrolle_K2 == 'Sarah Michelle') {   $svar_2 = 'Drama_Komedie'; }
        if($middelsrolle_K2 == 'Don Cheadle') {      $svar_2 = 'Action_Drama'; }
        if($middelsrolle_K2 == 'Martin Lawrence') {  $svar_2 = 'Action_Komedie'; }
        if($middelsrolle_K2 == 'Anthony Anderson') { $svar_2 = 'Action_Komedie'; }
        if($middelsrolle_K2 == 'Taylor Momsen') {    $svar_2 = 'Drama_Grøsser_Action'; }
        if($middelsrolle_K2 == 'Jeffrey Tambor') {   $svar_2 = 'Drama_Komedie'; }
        if($middelsrolle_K2 == 'Andy Dick') {        $svar_2 = 'Drama_Komedie'; }
        if($middelsrolle_K2 == 'Jack Black') {       $svar_2 = 'Action_Drama_Komedie'; }       
        if($middelsrolle_K2 == 'Duane Whitaker') {   $svar_2 = 'Grøsser_Drama'; }
        if($middelsrolle_K2 == 'Rosanna Arquette') { $svar_2 = 'Action_Drama_Grøsser'; }
        if($middelsrolle_K2 == 'Tim Robbins') {      $svar_2 = 'Action_Drama_Grøsser_Komedie'; }        
        if($middelsrolle_K2 == 'Vince Vaughn') {     $svar_2 = 'Action_Komedie'; }
        if($middelsrolle_K2 == 'Owen Wilson') {      $svar_2 = 'Action_Komedie'; }
        if($middelsrolle_K2 == 'Ben Stiller') {      $svar_2 = 'Komedie'; }    
        if($middelsrolle_K2 == 'Renée Zellweger') {  $svar_2 = 'Komedie_Drama_Grøsser'; }    
        
        if($litenrolle_K2 == 'Ralph Fiennes') {   $svar_3 = 'Grøsser_Drama'; }
        if($litenrolle_K2 == 'David Herman') {    $svar_3 = 'Grøsser_Drama'; }
        if($litenrolle_K2 == 'Dempsey Pappion') { $svar_3 = 'Action_Drama_Komedie'; }
        if($litenrolle_K2 == 'Nigel Harbach') {   $svar_3 = 'Action_Drama_Grøsser_Komedie'; }
        if($litenrolle_K2 == 'Miranda R') {       $svar_3 = 'Action_Drama_Grøsser_Komedie'; }
        if($litenrolle_K2 == 'Anjelica Huston') { $svar_3 = 'Drama_Grøsser'; }
        if($litenrolle_K2 == 'Stacey Travis') {   $svar_3 = 'Drama_Action_Grøsser_Komedie'; }
        if($litenrolle_K2 == 'Gloria Garayua') {  $svar_3 = 'Action_Drama'; }
        if($litenrolle_K2 == 'William Sadler') {  $svar_3 = 'Drama_Grøsser'; }
        if($litenrolle_K2 == 'Diya Mirza') {      $svar_3 = 'Action_Komedie_Drama'; }
        if($litenrolle_K2 == 'Bill Young') {      $svar_3 = 'Drama_Grøsser'; }
        if($litenrolle_K2 == 'Monica Bellucci') { $svar_3 = 'Action_Komedie_Drama'; }
        if($litenrolle_K2 == 'Steve Bastoni') {   $svar_3 = 'Action_Drama_Grøsser'; }
        if($litenrolle_K2 == 'Jessica Biel') {    $svar_3 = 'Action_Drama_Komedie'; }
        if($litenrolle_K2 == 'Sonny Chiba') {     $svar_3 = 'Action_Drama_Komedie_Grøsser'; }
        if($litenrolle_K2 == 'Vivica A. Fox') {   $svar_3 = 'Action_Komedie'; }                
        if($litenrolle_K2 == 'Jessica Simpson') { $svar_3 = 'Action_Komedie_Drama'; }
        if($litenrolle_K2 == 'Johnny Knoxville') {$svar_3 = 'Komedie'; }
        if($litenrolle_K2 == 'Seann William') {   $svar_3 = 'Komedie_Drama_Action'; }
        
        }
        ?>
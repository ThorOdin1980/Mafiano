<?php
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
  echo "<div class=\"Div_masta\"><div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">DINE FIRMA / BEDRIFTER</span></div>";
  
  // Dine kulefabrikker
 $Kfw = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Eier='$brukernavn'");
 if(mysql_num_rows($Kfw) >= '1') {
    while($Kf = mysql_fetch_assoc($Kfw)) {
      $FakeID = Krypt_Tall($Kf['id']);
      echo "<div class=\"Div_submeny_1\" onclick='document.location.href=\"game.php?side=DinKulefabrikk&valgt=$FakeID\"'>
      <span class=\"Span_str_3\">KULEFABRIKK</span><br>
      <span class=\"Span_str_4\">Fabrikk: ".$Kf['KF_Fabrikk']."<br>
      Opprettet: ".$Kf['KF_Opprettet_Dato']."<br><br>
      Sted: ".$Kf['KF_Sted']."<br>Kontobalanse: ".VerdiSum($Kf['KF_Konto'],'kr')."</span></div>";
    }
  }

  // Dine butikker
 $Bu = mysql_query("SELECT * FROM Butikker WHERE Butikk_eier LIKE '$brukernavn'"); 
  if(mysql_num_rows($Bu) >= '1') {
    while ($BuI = mysql_fetch_assoc($Bu)) { 
  
      if($BuI['Butikk_skade'] >= '100') {
        $Skade = "<span style=\"color:#3c943c; font-weight:bold;\">(100%)</span>";
      } else {
        $Skade = "<span style=\"color:#cc3f01; font-weight:bold;\">(".floor($BuI['Butikk_skade'])."%)</span>";
      }
      
  $FakeID = Krypt_Tall($BuI['id']); echo "<div class=\"Div_submeny_1\" onclick='document.location.href=\"game.php?side=DinButikk&valgt=$FakeID\"'><span class=\"Span_str_3\">BUTIKK</span><br><span class=\"Span_str_4\">Butikk: ".$BuI['Butikk_Navn']." $Skade<br>Opprettet: ".$BuI['Butikk_Startet_Dato']."<br><br>Sted: ".$BuI['Butikk_Land']."<br>Kontobalanse: ".VerdiSum($BuI['Butikk_Konto'],'kr')."<br></span></div>"; }}

  echo "</div>";   
  }
  ?>
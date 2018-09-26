  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(SjekkPlassering($brukernavn) == 'klar') { 

  $B_ID = mysql_real_escape_string($_REQUEST['valgt']);
  if(empty($B_ID)) { header("Location: game.php?side=hoved"); } else { 
  $Bu_ID = Dekrypt_Tall($B_ID);


  $Butikk = mysql_query("SELECT * FROM Butikker WHERE Butikk_eier LIKE '$brukernavn' AND id LIKE '$Bu_ID'");
  if(mysql_num_rows($Butikk) == '0') { header("Location: game.php?side=hoved"); } else {
  $I = mysql_fetch_assoc($Butikk);

  if($I['Butikk_Gjeng'] != $gjeng) { 
  if(!empty($gjeng)) { 

  mysql_query("UPDATE Butikker SET Butikk_Gjeng='$gjeng' WHERE Butikk_eier='$brukernavn' AND id LIKE '$Bu_ID'"); }}


  if($I['Butikk_Type'] == 'Fly') { include "Butikk_fly.php"; }
  elseif($I['Butikk_Type'] == 'Våpen') { include "Butikk_vopen.php"; }
  elseif($I['Butikk_Type'] == 'Beskyttelse') { include "Butikk_beskyttelse.php"; }
  elseif($I['Butikk_Type'] == 'Båter') { include "Butikk_bat.php"; }
  else { header("Location: game.php?side=Hoved"); }

  }}}
  ?>
        
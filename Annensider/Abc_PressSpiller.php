  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); }
  elseif(SjekkPlassering($brukernavn) == 'klar') { 

  $RankOver = $rank_niva + '1';
  $LikRank = $rank_niva;
  $RankLavere = $rank_niva - '1';
    

  $Folkemengde = mysql_query("SELECT brukernavn FROM brukere WHERE land='$land'");
  if(mysql_num_rows($Folkemengde) == '0') { echo "test"; $Mengde = array('0','0','0'); } else { $Over = '0'; $Lik = '0'; $Unner = '0';
  while($I = mysql_fetch_assoc($Folkemengde)) { 
  
  if($RankOver == $I['rank_nivaa']) { $Over++; }
  elseif($LikRank == $I['rank_nivaa']) { $Lik++; }
  elseif($RankLavere == $I['rank_nivaa']) { $Unner++; }
  
  }
  $Mengde = array("$Over","$Lik","$Unner");
  }

  $GtaVent = $bil_tid - $Timestamp;
  


  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Utpress</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/utpressing.jpg\"></td></tr>
  ";
  
  echo "
  <tr style=\"height:20px;\"><td class=\"R_4\">Press</td><td class=\"R_4\">Fortjeneste</td><td class=\"R_4\">Folkemengde</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">En rank over</td><td class=\"Linje Plassering\">Høy</td><td class=\"Linje Plassering\">".VerdiSum($Mengde['0'],'spillere')."</td></tr>
  <tr class=\"Vanlig_2 Ekstra\"><td class=\"Linje Plassering\">Lik rank</td><td class=\"Linje Plassering\">Passe</td><td class=\"Linje Plassering\">".VerdiSum($Mengde['1'],'spillere')."</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">En rank unner</td><td class=\"Linje Plassering\">Lav</td><td class=\"Linje Plassering\">".VerdiSum($Mengde['2'],'spillere')."</td></tr>
  <tr class=\"Vanlig_2\" colspan=\"3\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" name=\"stjel_fra\" id=\"stjel_fra\" value=\"Press en spesefik spiller\" maxlength=\"30\" onFocus=\"if(this.value=='Press en spesefik spiller')this.value='';\" onblur=\"if(this.value=='')this.value='Press en spesefik spiller';\">
  <p class=\"Post\">Press!</p>
  </td></tr>
  ";
  

  echo "</table></div>";
  
  }
  ?>
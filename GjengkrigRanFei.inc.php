  <?php
  if(basename($_SERVER['PHP_SELF']) == "GjengkrigRanFei.inc.php") { header("Location: index.php"); exit; } else {
  if($SjekkInk == 'MLSG8SkkkkA') { 
  
  $Verd = array();
  if($rad_B['liv'] > '11') { array_push($Verd, 'liv'); }
  if($rad_B['kuler'] > '10000') { array_push($Verd, 'kuler'); }
  if($rad_B['bombechips'] > '10000') { array_push($Verd, 'bombechips'); }
  if($rad_B['penger'] > '1000') { array_push($Verd, 'penger'); }
  if($rad_B['respekt'] > '1000') { array_push($Verd, 'respekt'); }
  if(RankprosTo($rad_B['rank_nivaa'],$rad_B['rankpros']) >= '20') { array_push($Verd, 'rankprosent'); }
  
  $Verd = $Verd[array_rand($Verd)];
  if($Verd == 'liv') { $Meld = array("Du ble utsatt for en brann, du tapte liv.","$BrukeFinn slo deg ned, du tapte liv.","$BrukeFinn fant frem en stein og knuste den i hue ditt, du tapte liv. ","Det ble håndgemeng byen, du fikk juling og mistet liv.","$BrukeFinn fakka deg opp, du tapte liv."); $Tap = floor($rad_B['liv'] - rand(2,6)); $Opp = "liv='$Tap'";
  } elseif($Verd == 'kuler') { $Meld = array("Det ble oppjør i byen, du mistet en del kuler.","$BrukeFinn pakka deg sammen og kastet deg i en konteiner, du mistet mange kuler.","Du og $BrukeFinn sloss, buksa revnet og en del av kulene dine ble tapt."); $Tap = floor($rad_B['kuler'] - rand(900,9000)); $Opp = "kuler='$Tap'";
  } elseif($Verd == 'bombechips') { $Meld = array("Du ble ranet for bombechips.","Du fant ikke fram, du mistet også en del bombechips."); $Tap = floor($rad_B['bombechips'] - rand(900,2000)); $Opp = "bombechips='$Tap'";
  } elseif($Verd == 'penger') { $Meld = array("En kjenning av $BrukeFinn ranet deg for penger.","En kriminell vennebande av $BrukeFinn ranet deg for penger."); $Ta = floor($rad_B['penger'] / '100' * '4'); $Tap = floor($rad_B['penger'] - $Ta); $Opp = "penger='$Tap'";
  } elseif($Verd == 'respekt') { $Meld = array("$BrukeFinn voldtok deg, du tapte respekt.","$BrukeFinn og noen venner krenket deg, du turte ikke å gjøre noe, du tapte respekt.","$BrukeFinn pisset på deg, du tapte respekt."); $Ta = floor($rad_B['respekt'] / '100' * '4'); $Tap = floor($rad_B['respekt'] - $Ta); $Opp = "respekt='$Tap'";
  } elseif($Verd == 'rankprosent') { $Meld = array("$BrukeFinn fjernet rankprosent fra brukeren din.","$BrukeFinn nedjusterte rankprosenten din."); $Tap = floor($rad_B['rankpros'] - rand(2,6)); $Opp = "respekt='$Tap'"; }
  
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$FeilVentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOkMot=`$KrigOkMot`+'0.4' WHERE id='$KrigsID'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv',$Opp WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  
  }}
  ?>
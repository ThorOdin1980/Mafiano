  <?php
  if(basename($_SERVER['PHP_SELF']) == "GjengkrigRanVell.inc.php") { header("Location: index.php"); exit; } else {
  if($SjekkInk == 'MLSG8SkkkkA') { 
  
  if($Postet['0'] == 'Ran spiller') { 
  $Verd = array();
  if($O_Info['respekt'] >= '1000') { $ResTa = floor($O_Info['respekt'] / '100' * '5'); $DinRes = floor($rad_B['respekt'] + $ResTa); $HansRep = floor($O_Info['respekt'] - $ResTa); $D_1 = ",respekt='$DinRes'"; $H_1 = ",respekt='$HansRep'"; array_push($Verd, 'respekt'); } else { $D_1 = ""; $H_1 = ""; }
  if($O_Info['penger'] >= '1000') { $PenTa = floor($O_Info['penger'] / '100' * '7'); $DinPen = floor($rad_B['penger'] + $PenTa); $HansPen = floor($O_Info['penger'] - $PenTa); $D_2 = ",penger='$DinPen'"; $H_2 = ",penger='$HansPen'"; array_push($Verd, 'penger'); } else { $D_2 = ""; $H_2 = ""; }
  if($O_Info['bombechips'] >= '1000') { $BomTa = floor($O_Info['bombechips'] / '100' * '10'); $DinBom = floor($rad_B['bombechips'] + $BomTa); $HansBom = floor($O_Info['bombechips'] - $BomTa); $D_3 = ",bombechips='$DinBom'"; $H_3 = ",bombechips='$HansBom'"; array_push($Verd, 'bombechips'); } else { $D_3 = ""; $H_3 = ""; }
  if($O_Info['kuler'] >= '1000') { $KulTa = floor($O_Info['kuler'] / '100' * '13'); $DinKul = floor($rad_B['kuler'] + $KulTa); $HansKul = floor($O_Info['kuler'] - $KulTa); $D_4 = ",kuler='$DinKul'"; $H_4 = ",kuler='$HansKul'"; array_push($Verd, 'kuler'); } else { $D_4 = ""; $H_4 = ""; }
  if($O_Info['liv'] >= '7') { $LivTa = floor($O_Info['liv'] / '100' * '3'); $HansLiv = floor($O_Info['liv'] - $LivTa); $H_5 = ",liv='$HansLiv'"; } else { $H_5 = ""; }
  $OppEn = "aktiv_eller='$Aktiv'"."$D_1$D_2$D_3$D_4";
  $OppTo = "aktiv_eller=`aktiv_eller`"."$H_1$H_2$H_3$H_4$H_5";
  $Verd = implode(",",$Verd); 

  $Sjekk_Hette = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='2' AND forbruk_nr >= '1' AND utstyr LIKE 'Finnlandshette'");
  if(mysql_num_rows($Sjekk_Hette) == '0') { $Meld = "$brukernavn ranet deg for $Verd."; } else { $Meld = "En spiller med finlandshette fra en rivalgjeng ranet deg for $Verd."; }

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','$Meld','Ja')");

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$VentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOk=`$KrigOk`+'0.5' WHERE id='$KrigsID'");
  mysql_query("UPDATE brukere SET $OppEn WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET $OppTo WHERE brukernavn='$BrukeFinn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du ranet $BrukeFinn for $Verd.</span></td></tr>";
  }elseif($Postet['0'] == 'Saboter spiller') { 
  $Verd = array();

  $Plantasje = mysql_query("SELECT * FROM plantasje WHERE brukernavn='$BrukeFinn' AND Sysselsatte >= '100' AND Tomt >= '100'");
  $Kickboksing = mysql_query("SELECT * FROM Kickboksing WHERE Bruker='$BrukeFinn' AND Level >= '80'");
  $Garage = mysql_query("SELECT * FROM garage WHERE eier='$BrukeFinn'");
  array_push($Verd, 'Fengsel');
  if(RankprosTo($O_Info['rank_nivaa'],$O_Info['rankpros']) >= '20') { array_push($Verd, 'Rankprosent'); }
  if(mysql_num_rows($Plantasje) >= '1') { array_push($Verd, 'Plantasje'); }
  if(mysql_num_rows($Kickboksing) >= '1') { array_push($Verd, 'Kickboksing'); }
  if(mysql_num_rows($Garage) >= '1') { array_push($Verd, 'Garage'); }
  $Verd = $Verd[array_rand($Verd)];
  if($Verd == 'Fengsel') { $Straff = $Timestamp + '240'; mysql_query("DELETE FROM fengsel WHERE brukernavn='$BrukeFinn'"); mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$BrukeFinn','Vold','4','4000000','$Straff','$Timestamp','$Land')");  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','En medlem av $G_NavnEr har ringt en venn i politiet, politimannen buret deg inn.','Ja')"); $Meld = "Du ringte din venn i politiet og fikk $BrukeFinn arrestert for vold.";
  } elseif($Verd == 'Rankprosent') { $Minus = floor($O_Info['rankpros'] - rand(1,5));  mysql_query("UPDATE brukere SET rankpros='$Minus' WHERE brukernavn='$BrukeFinn'");  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','En medlem av $G_NavnEr har sabotert brukeren din for rankprosent.','Ja')"); $Meld = "Du saboterte $BrukeFinn for rankprosent.";
  } elseif($Verd == 'Plantasje') { $P_Info = mysql_fetch_assoc($Plantasje); $ArbTa = floor($P_Info['Sysselsatte'] / '100' * '3'); $TomTa = floor($P_Info['Tomt'] / '100' * '4'); $NyArb = floor($P_Info['Sysselsatte'] - $ArbTa); $NyTom = floor($P_Info['Tomt'] - $TomTa);  mysql_query("UPDATE plantasje SET Tomt='$NyTom',Sysselsatte='$NyArb' WHERE brukernavn='$BrukeFinn'"); $Sjekk_Hette = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='2' AND forbruk_nr >= '1' AND utstyr LIKE 'Finnlandshette'");if(mysql_num_rows($Sjekk_Hette) == '0') { $Melde = "$brukernavn saboterte plantasjen din."; } else { $Melde = "En spiller med finlandshette fra $G_NavnEr saboterte plantasjen din."; }  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','$Melde','Ja')"); $Meld = "Du saboterte $BrukeFinn sin plantasje.";
  } elseif($Verd == 'Kickboksing') { $Ki_Info = mysql_fetch_assoc($Kickboksing); $Minus = floor($Ki_Info['Level'] - rand(2,5));  mysql_query("UPDATE Kickboksing SET Level='$Minus' WHERE Bruker='$BrukeFinn'"); $Sjekk_Hette = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='2' AND forbruk_nr >= '1' AND utstyr LIKE 'Finnlandshette'"); if(mysql_num_rows($Sjekk_Hette) == '0') { $Melde = "$brukernavn saboterte kickboksing brukeren din."; } else { $Melde = "En spiller med finlandshette fra $G_NavnEr saboterte kickboksing brukeren din."; }  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','$Melde','Ja')"); $Meld = "Du saboterte $BrukeFinn sin kickboksing bruker.";
  } elseif($Verd == 'Garage') { $rANd = rand(1,3);  mysql_query("DELETE FROM garage WHERE eier='$BrukeFinn' LIMIT $rANd"); $Sjekk_Hette = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='2' AND forbruk_nr >= '1' AND utstyr LIKE 'Finnlandshette'"); if(mysql_num_rows($Sjekk_Hette) == '0') { $Melde = "$brukernavn var i garagen din og destruerte biler."; } else { $Melde = "En spiller med finlandshette fra $G_NavnEr saboterte noen av bilene dine."; }  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BrukeFinn','$Timestamp','$AnnenDato','Gjengkrig','$Melde','Ja')"); $Meld = "Du saboterte noen av $BrukeFinn sine biler."; }

  mysql_query("UPDATE Gjeng_medlemmer SET Ventetid='$VentEr' WHERE brukernavn='$brukernavn' AND gjeng_id='$G_Id'");
  mysql_query("UPDATE Gjeng_krig SET $KrigOk=`$KrigOk`+'0.5' WHERE id='$KrigsID'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  
  
  }}
  ?>
  <?php
  if(basename($_SERVER['PHP_SELF']) == "Blackjack.inc.php") { header("Location: index.php"); exit; }
  elseif(1 == 1) {
  ?>
  <div class="Div_masta">
  <table class="Rute_1">
  <tr>
  <td class="R_0">
  <span style="float:left; line-height:30px;">Blackjack</span>
  <span class="Opprett" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kasino')">( Tilbake til kasino )</span>
  </td>
  </tr>
  <tr>
  <td class="R_4"><img border="0" src="../Bilder/Blackjack.jpg">
  </td>
  </tr>
  <tr class="Vanlig_2">
  <td class="Linje Send" style="padding-bottom:9px;">
  <p>Blackjack er deaktivert grunnet bug.</p>
  </td></tr></table></div>

  <?php
  } else {
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Blackjack</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kasino')\">( Tilbake til kasino )</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/Blackjack.jpg\"></td></tr>";
  

  $Bj = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn'");
  if(mysql_num_rows($Bj) > '0') { 
  
   // Verdier
   $Tall_1 = '0'; // Din kort total sum
   $Tall_2 = '0'; // Dealer kort total sum
   $Tall_3 = '0';
   $skal_slettes = 'NEI';
   $ess = 'ess';
   $RAND_Tall_1 = '0';
   $RAND_Tall_2 = '0';
   $RAND_Tall_3 = '0';
  
   // Funksjoner
   function Kortverdi($kortet_er){ $Sjekk_1 = ereg_replace("[^0-9]", "",$kortet_er); if($kortet_er == 'Hjerter-ess' || $kortet_er == 'Klover-ess' || $kortet_er == 'Spar-ess' || $kortet_er == 'Ruter-ess') { $verdi_paa_kort = '11'; } elseif($kortet_er == 'Hjerter-knekt' || $kortet_er == 'Klover-knekt' || $kortet_er == 'Spar-knekt' || $kortet_er == 'Ruter-knekt') { $verdi_paa_kort = '10'; } elseif($kortet_er == 'Hjerter-dron' || $kortet_er == 'Klover-dron' || $kortet_er == 'Spar-dron' || $kortet_er == 'Ruter-dron') { $verdi_paa_kort = '10'; } elseif($kortet_er == 'Hjerter-konge' || $kortet_er == 'Klover-konge' || $kortet_er == 'Spar-konge' || $kortet_er == 'Ruter-konge') { $verdi_paa_kort = '10'; } elseif($Sjekk_1 == '2' || $Sjekk_1 == '3' || $Sjekk_1 == '4' || $Sjekk_1 == '5' || $Sjekk_1 == '6' || $Sjekk_1 == '7' || $Sjekk_1 == '8' || $Sjekk_1 == '9' || $Sjekk_1 == '10') { $verdi_paa_kort = $Sjekk_1; } else { $verdi_paa_kort = '0'; } $kortet_er = $verdi_paa_kort; return $kortet_er; }
  
   // Henter kort
 
   $Dine_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'NEI' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
   $Dealer_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'JA' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
   $Dine_BJ_Kort_Ess = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'NEI' AND B_ibruk LIKE 'JA' AND B_kort LIKE '%".$ess."%'");
   $Dealer_BJ_Kort_Ess = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'JA' AND B_ibruk LIKE 'JA' AND B_kort LIKE '%".$ess."%'");
  
   // Antall kort og ess
   $Antall_ess_du_har = mysql_num_rows($Dine_BJ_Kort_Ess);
   $Antall_ess_dealer_har = mysql_num_rows($Dealer_BJ_Kort_Ess);
   $X_antall_kort_du_har = mysql_num_rows($Dine_BJ_Kort);
   $X_antall_kort_pc_har = mysql_num_rows($Dealer_BJ_Kort);
        
   // Henter totalsummene
   while($Dine_kort_sjekk = mysql_fetch_assoc($Dine_BJ_Kort)) { $kortet_er = $Dine_kort_sjekk['B_kort'];  $sats_er = $Dine_kort_sjekk['B_satset']; $staa_ell = $Dine_kort_sjekk['B_staa']; $verdi_paa_kort = Kortverdi($kortet_er); $Tall_1 = $Tall_1 + $verdi_paa_kort; }
   while($Dealer_kort_sjekk = mysql_fetch_assoc($Dealer_BJ_Kort)) { $kortet_er_2 = $Dealer_kort_sjekk['B_kort']; $verdi_paa_kort_2 = Kortverdi($kortet_er_2); $Tall_2 = $Tall_2 + $verdi_paa_kort_2; } 
        
   // Finner ut kortverdiene
   if($Tall_1 > '21') { while ($Antall_ess_du_har > $RAND_Tall_1) { $RAND_Tall_1++; $Tall_1 = $Tall_1 - '10'; if($Tall_1 <= '21') { break; }}}
   if($Tall_2 > '21') { while ($Antall_ess_dealer_har > $RAND_Tall_2) { $RAND_Tall_2++; $Tall_2 = $Tall_2 - '10'; if($Tall_2 <= '21') { break; }}}
  
   if($staa_ell == 'JA') {
   if($Tall_2 == $Tall_1) {
   $ny_sum_spenn = floor($rad_B['penger'] + $sats_er);
   echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Det ble push, du fikk tilbake ".number_format($sats_er, 0, ",", ".")." kr.</span></td></tr>";
  
   mysql_query("INSERT INTO BjLogg (Brukernavn,Dato,Stamp,Satset,DinSumKort,DealerSumKort,Svar,Gevinst) VALUES('$brukernavn','$AnnenDato','$Timestamp','$sats_er','$Tall_1','$Tall_2','Push','0')");
 
   mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
   $skal_slettes = 'JA';
   }elseif($Tall_2 > '21') {
   $ny_sum_spenn_blir = floor($sats_er * '2'); 
   $ny_sum_spenn = floor($rad_B['penger'] + $ny_sum_spenn_blir);
   echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Dealeren brøt, du vant ".number_format($ny_sum_spenn_blir, 0, ",", ".")." kr.</span></td></tr>";
  
   mysql_query("INSERT INTO BjLogg (Brukernavn,Dato,Stamp,Satset,DinSumKort,DealerSumKort,Svar,Gevinst) VALUES('$brukernavn','$AnnenDato','$Timestamp','$sats_er','$Tall_1','$Tall_2','Dealeren brøt','$ny_sum_spenn_blir')");
 
   mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
   $skal_slettes = 'JA';
   }elseif($Tall_2 > $Tall_1) { 
   echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Dealeren fikk ".$Tall_2.", du tapte ".number_format($sats_er, 0, ",", ".")." kr.</span></td></tr>";
  
   mysql_query("INSERT INTO BjLogg (Brukernavn,Dato,Stamp,Satset,DinSumKort,DealerSumKort,Svar,Gevinst) VALUES('$brukernavn','$AnnenDato','$Timestamp','$sats_er','$Tall_1','$Tall_2','Dealer vant','0')");
 
   mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
   $skal_slettes = 'JA'; 
   }elseif($Tall_2 < $Tall_1) { 
   $ny_sum_spenn_blir = floor($sats_er * '2'); 
   $ny_sum_spenn = floor($rad_B['penger'] + $ny_sum_spenn_blir);
   echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Dealeren fikk en lavere totalsum, du vant ".number_format($ny_sum_spenn_blir, 0, ",", ".")." kr.</span></td></tr>";
  
   mysql_query("INSERT INTO BjLogg (Brukernavn,Dato,Stamp,Satset,DinSumKort,DealerSumKort,Svar,Gevinst) VALUES('$brukernavn','$AnnenDato','$Timestamp','$sats_er','$Tall_1','$Tall_2','Dealer tapte','$ny_sum_spenn_blir')");
 
   mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
   $skal_slettes = 'JA'; }
   } else { 
   if($X_antall_kort_du_har == '2' && $X_antall_kort_pc_har == '2' && $Tall_1 == '21') {
   $ny_sum_spenn_blir = floor($sats_er * '3'); 
   $ny_sum_spenn = floor($rad_B['penger'] + $ny_sum_spenn_blir);
   echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du fikk 21 p� f�rste forsøk, du vant ".number_format($ny_sum_spenn_blir, 0, ",", ".")." kr.</span></td></tr>";
  
   mysql_query("INSERT INTO BjLogg (Brukernavn,Dato,Stamp,Satset,DinSumKort,DealerSumKort,Svar,Gevinst) VALUES('$brukernavn','$AnnenDato','$Timestamp','$sats_er','$Tall_1','0','21 p� første trekk','$ny_sum_spenn_blir')");
 
   mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
   $skal_slettes = 'JA';
   } else { 
   if($_GET['action']) { 
   $du_valgte = mysql_real_escape_string($_GET['action']);   
   if($du_valgte == 'STA') {  
   if($Tall_2 >= $Tall_1) { 
 
   mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
 
   mysql_query("UPDATE Blackjack SET B_staa='JA' WHERE B_brukernavn='$brukernavn'");
   echo "<script> $('#SB_Midten2').load('post.php?du_valgte=Blackjack'); </script>";
   } else {    
 
   $Hent_inn_ekstra_kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_ibruk LIKE 'NEI' ORDER BY `B_timestamp` ASC");
   while($Dealer_fler_kort = mysql_fetch_assoc($Hent_inn_ekstra_kort)) { 
   $kortet_blir_2ka = $Dealer_fler_kort['B_kort'];
   $id_blir_2ka = $Dealer_fler_kort['id'];
   $verdi_paa_kort_2ka = Kortverdi($kortet_blir_2ka); 
   $Tall_2 = $Tall_2 + $verdi_paa_kort_2ka;
   mysql_query("UPDATE Blackjack SET B_ibruk='JA',B_dealer='JA' WHERE id='$id_blir_2ka'");   
   if($Tall_2 > '21') { while ($Antall_ess_dealer_har > $RAND_Tall_2) { $RAND_Tall_2++; $Tall_2 = $Tall_2 - '10'; if($Tall_2 <= '21') { break; }}}
   if($Tall_2 > '21') {  if($kortet_blir_2ka == 'Hjerter-ess' || $kortet_blir_2ka == 'Klover-ess' || $kortet_blir_2ka == 'Spar-ess' || $kortet_blir_2ka == 'Ruter-ess') { $Tall_2 = $Tall_2 - '10'; }}        
   if($Tall_2 > $Tall_1 || $Tall_2 >= '21' || $Tall_2 == $Tall_1) { break; }}
   mysql_query("UPDATE Blackjack SET B_staa='JA' WHERE B_brukernavn='$brukernavn'");
   echo "<script> $('#SB_Midten2').load('post.php?du_valgte=Blackjack'); </script>"; }
   } elseif($du_valgte == 'VIDERE') { 
 
   $VELG_ETT_KORT_ID = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_ibruk LIKE 'NEI' ORDER BY `B_timestamp` ASC LIMIT 1");
   $VELG_ETT_KORT_ID = mysql_fetch_assoc($VELG_ETT_KORT_ID);
   $KORT_ID = $VELG_ETT_KORT_ID['id'];
   $KORT_BILDE = $VELG_ETT_KORT_ID['B_kort'];
   mysql_query("UPDATE Blackjack SET B_ibruk='JA',B_dealer='NEI' WHERE id='$KORT_ID'");
 
   mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
   $verdi_paa_kortET_2 = Kortverdi($KORT_BILDE); 
   $Tall_1 = $Tall_1 + $verdi_paa_kortET_2;
   if($KORT_BILDE == 'Hjerter-ess' || $KORT_BILDE == 'Klover-ess' || $KORT_BILDE == 'Spar-ess' || $KORT_BILDE == 'Ruter-ess') { $Antall_ess_du_har = $Antall_ess_du_har + '1'; }
   if($Tall_1 > '21') { while ($Antall_ess_du_har > $RAND_Tall_1) { $RAND_Tall_1++; $Tall_1 = $Tall_1 - '10'; if($Tall_1 <= '21') { break; }}}  
   if($Tall_1 > '21') {
  
   mysql_query("INSERT INTO BjLogg (Brukernavn,Dato,Stamp,Satset,DinSumKort,DealerSumKort,Svar,Gevinst) VALUES('$brukernavn','$AnnenDato','$Timestamp','$sats_er','$Tall_1','0','Spiller brøt','0')"); 
 
   mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
   $skal_slettes = 'JA';
   echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du fikk over 21 og tapte ".number_format($sats_er, 0, ",", ".")." kr.</span></td></tr>";
   } elseif($Tall_1 == '21') { 
   $ny_sum_spenn_blir = floor($sats_er * '3'); 
   $ny_sum_spenn = floor($rad_B['penger'] + $ny_sum_spenn_blir);
  
   mysql_query("INSERT INTO BjLogg (Brukernavn,Dato,Stamp,Satset,DinSumKort,DealerSumKort,Svar,Gevinst) VALUES('$brukernavn','$AnnenDato','$Timestamp','$sats_er','$Tall_1','0','Spiller fikk 21','$ny_sum_spenn_blir')");
 
   mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
   $skal_slettes = 'JA';
   echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du fikk 21, du vant ".number_format($ny_sum_spenn_blir, 0, ",", ".")." kr.</span></td></tr>";
   }}}}}
  
   // Viser kortene
 
   $Dine_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'NEI' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
   $Dealer_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'JA' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
   while($Dealer_kort = mysql_fetch_assoc($Dealer_BJ_Kort)) { $Tall_3++; if($Tall_3 == '2' && $X_antall_kort_pc_har == '2' && $staa_ell == 'NEI') { $V_En = $V_En.'<img src="../kortstokk/HJERTER/top_kort.jpg">'; } else { $V_En = $V_En.'<img src="../kortstokk/HJERTER/'.$Dealer_kort['B_kort'].'.jpg">'; }}
   while($Dine_kort = mysql_fetch_assoc($Dine_BJ_Kort)) { $V_To = $V_To.'<img src="../kortstokk/HJERTER/'.$Dine_kort['B_kort'].'.jpg">'; }

   echo "<tr class=\"Vanlig_1\"><td class=\"Linje Plassering\">$V_En</td></tr><tr class=\"Vanlig_2\"><td class=\"Linje Plassering\">$V_To</td></tr>";
   
   if($skal_slettes != 'JA') { echo "<tr class=\"Vanlig_1\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\"><p style=\"float:left;\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Blackjack&action=STA');\" class=\"PostEn\">Stå</p><p style=\"float:right;\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Blackjack&action=VIDERE');\" class=\"PostEn\">Nytt kort</p></td></tr>"; }
  
   // Skal du slette litt db ell
   if($skal_slettes == 'JA') {
 
   mysql_query("DELETE FROM Blackjack WHERE B_brukernavn = '$brukernavn'") or die(mysql_error());
   }
  
  // Start ny runde
  } else {
  
  echo "
  <script>
  function StartBj() { 
  var Sats = $('#SatsBj').val();
  if(Sats == '' || Sats == '0' || Sats == 'Sats') { alert('Du må plotte inn en sum.'); } else { 
  var Sats = encodeURI(Sats);
  $('#SB_Midten2').load('post.php?du_valgte=Blackjack&StartBj='+Sats); 
  }}
  </script>
  ";
  
  // Start
  if($_GET['StartBj']) { 
  $Sum = Bare_Siffer(Mysql_Klar($_GET['StartBj']));
  if(empty($Sum)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må plotte inn en sum.</span></td></tr>"; }
  elseif($Sum > $rad_B['penger']) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke nok penger på hånda.</span></td></tr>"; }
  elseif($Sum < '1000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Minimum 1.000 kr.</span></td></tr>"; }
  elseif($Sum > '1000000000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Maksimum 1.000.000.000 kr.</span></td></tr>"; } else { 

  $NyCash = floor($rad_B['penger'] - $Sum);
  $Bilde = array("Hjerter-ess","Hjerter-2","Hjerter-3","Hjerter-4","Hjerter-5","Hjerter-6","Hjerter-7","Hjerter-8","Hjerter-9","Hjerter-10","Hjerter-knekt","Hjerter-dron","Hjerter-konge","Klover-ess","Klover-2","Klover-3","Klover-4","Klover-5","Klover-6","Klover-7","Klover-8","Klover-9","Klover-10","Klover-knekt","Klover-dron","Klover-konge","Ruter-ess","Ruter-2","Ruter-3","Ruter-4","Ruter-5","Ruter-6","Ruter-7","Ruter-8","Ruter-9","Ruter-10","Ruter-knekt","Ruter-dron","Ruter-konge","Spar-ess","Spar-2","Spar-3","Spar-4","Spar-5","Spar-6","Spar-7","Spar-8","Spar-9","Spar-10","Spar-knekt","Spar-dron","Spar-konge");
  $Ran = array_rand($Bilde, 20); $K_1 = $Bilde[$Ran[0]]; $K_2 = $Bilde[$Ran[1]]; $K_3 = $Bilde[$Ran[2]]; $K_4 = $Bilde[$Ran[3]]; $K_5 = $Bilde[$Ran[4]]; $K_6 = $Bilde[$Ran[5]]; $K_7 = $Bilde[$Ran[6]]; $K_8 = $Bilde[$Ran[7]]; $K_9 = $Bilde[$Ran[8]]; $K_10 = $Bilde[$Ran[9]]; $K_11 = $Bilde[$Ran[10]]; $K_12 = $Bilde[$Ran[11]]; $K_13 = $Bilde[$Ran[12]]; $K_14 = $Bilde[$Ran[13]]; $K_15 = $Bilde[$Ran[14]]; $K_16 = $Bilde[$Ran[15]]; $K_17 = $Bilde[$Ran[16]]; $K_18 = $Bilde[$Ran[17]]; $K_19 = $Bilde[$Ran[18]]; $K_20 = $Bilde[$Ran[19]]; 
  $tid_1 = $Timestamp + '1'; $tid_2 = $Timestamp + '2'; $tid_3 = $Timestamp + '3'; $tid_4 = $Timestamp + '4'; $tid_5 = $Timestamp + '5'; $tid_6 = $Timestamp + '6'; $tid_7 = $Timestamp + '7'; $tid_8 = $Timestamp + '8'; $tid_9 = $Timestamp + '9'; $tid_10 = $Timestamp + '10'; $tid_11 = $Timestamp + '11'; $tid_12 = $Timestamp + '12'; $tid_13 = $Timestamp + '13'; $tid_14 = $Timestamp + '14'; $tid_15 = $Timestamp + '15'; $tid_16 = $Timestamp + '16'; $tid_17 = $Timestamp + '17'; $tid_18 = $Timestamp + '18'; $tid_19 = $Timestamp + '19'; $tid_20 = $Timestamp + '20';  
  

  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_1','NEI','$tid_1','$Sum','JA')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_2','NEI','$tid_2','$Sum','JA')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_3','JA','$tid_3','$Sum','JA')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_4','JA','$tid_4','$Sum','JA')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_5','','$tid_5','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_6','','$tid_6','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_7','','$tid_7','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_8','','$tid_8','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_9','','$tid_9','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_10','','$tid_10','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_11','','$tid_11','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_12','','$tid_12','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_13','','$tid_13','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_14','','$tid_14','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_15','','$tid_15','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_16','','$tid_16','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_17','','$tid_17','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_18','','$tid_18','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_19','','$tid_19','$Sum','NEI')");
  mysql_query("INSERT INTO `Blackjack` (B_brukernavn,B_kort,B_dealer,B_timestamp,B_satset,B_ibruk) VALUES ('$brukernavn','$K_20','','$tid_20','$Sum','NEI')");

  mysql_query("UPDATE brukere SET penger='$NyCash',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  
  echo "<script> $('#SB_Midten2').load('post.php?du_valgte=Blackjack'); </script>";
  
  }}

  
  echo "
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"SatsBj\" value=\"Sats\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sats')this.value='';\" onblur=\"if(this.value=='')this.value='Sats';\">
  <p class=\"Post\" onclick=\"StartBj();\">Start spill!</p>
  </td></tr>";
  }
  
  echo "</table></div>";
  }
  ?>
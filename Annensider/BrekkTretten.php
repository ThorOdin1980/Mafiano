          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <?
          if (empty($brukernavn)) { header("Location: login.php"); }
          
          // VELGER OM DU SKAL KLARE DET ELLER FEILE
          if ($brekk_gjort <= '104') { $klare_svar = array("NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
          if ($brekk_gjort >= '105') { $klare_svar = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
          if ($brekk_gjort >= '110') { $klare_svar = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
          if ($brekk_gjort >= '115') { $klare_svar = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); }
          if ($brekk_gjort >= '120') { $klare_svar = array("JA","JA","JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI"); }
          
          $klare_svar = $klare_svar[array_rand($klare_svar)];

          if($klare_svar == 'JA') {
          $penger_tjen = rand (2600, 3600); 
          $penger_tjen_vis = number_format($penger_tjen, 0, ",", ".");
          $tekst_svar = array("Du kruste igjennom brannmuren og overføre så $penger_tjen_vis kroner til din konto.","Du knuste paypal sitt systemt og stakk av med $penger_tjen_vis kroner.","Vellykket, du kom unna med $penger_tjen_vis kroner.","Du hacket paypal, du fikk overført $penger_tjen_vis kroner.");
          $tekst_svar = $tekst_svar[array_rand($tekst_svar)];
          include "brekk_prosent.php";
          $ny_rank_prosent_brekk = $rankpros + $brekk_prosent_s;
          $ny_sum_penger = $penger + $penger_tjen;
          $brekk_mellomtid = $tiden + '180';
          $brekk_ny_gjort = $brekk_gjort + '1';
        
          mysql_query("UPDATE brukere SET brekk_tid='$brekk_mellomtid',brekk_gjort='$brekk_ny_gjort',penger='$ny_sum_penger',rankpros='$ny_rank_prosent_brekk',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
          echo "<div id=\"SBL_GodkjentTo\">$tekst_svar</div>";
          } else {
          $hendelse_svar = array("Fengsel","Respekt","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Respekt","Ikkeno","Ikkeno","Ikkeno","Fengsel");
          $hendelse_svar = $hendelse_svar[array_rand($hendelse_svar)];
          if($hendelse_svar == 'Fengsel') {
          $tekst_svar = array("Paypal sørget for å få deg arrestert.","Paypal sitt sikkerhets system fanget opp ipen din, du er arrestert.","Purken busta deg.","Du ble arrestert.","Paypals eier ebay fant ut at det var deg, de fikk deg arrestert.","Du ble tatt av en politibetjent.");
          $tekst_svar = $tekst_svar[array_rand($tekst_svar)];
          $brekk_mellomtid = $tiden + '180';
          $brekk_ny_gjort = $brekk_gjort + '1';
          $fengsel_straff = $tiden + '180';
        
          mysql_query("UPDATE brukere SET brekk_tid='$brekk_mellomtid',brekk_gjort='$brekk_ny_gjort',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
          mysql_query("INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$brukernavn','Hacking','3','$tid $nbsp $dato','$tiden','','Grovt hackeforsøk mot paypal.','$land')") OR die(mysql_error());
          mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Hacking','3','3000000','$fengsel_straff','$tiden','$land')") OR die(mysql_error());
          echo "<div id=\"SBL_ErrorTo\">$tekst_svar</div>";
          }
          if($hendelse_svar == 'Ikkeno') {
          $tekst_svar = array("Paypal sin hacker knuste deg på første forsøk.","Du klarte ikke å hacke paypal.","Nettverket ditt fungerte ikke.","Total fiasko.","Du kom igjenom systemet men pcen din crasha.","Du feilet.","Du klarte ikke å hacke paypal.");
          $tekst_svar = $tekst_svar[array_rand($tekst_svar)];
          $brekk_mellomtid = $tiden + '180';
          $brekk_ny_gjort = $brekk_gjort + '1';
        
          mysql_query("UPDATE brukere SET brekk_tid='$brekk_mellomtid',brekk_gjort='$brekk_ny_gjort',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
          echo "<div id=\"SBL_ErrorTo\">$tekst_svar</div>";
          }
          if($hendelse_svar == 'Respekt') {
          $tekst_svar = array("Pcen din crasha, du løftet så pcen opp og kastet den ut av vinduet. Pcen din traff en mann i hue, du økte derfor i respekt.","Nettverket ble borte, i rent sinne gikk du ut på gata å slo ned en sivil, du gikk opp i respekt.");
          $tekst_svar = $tekst_svar[array_rand($tekst_svar)];
          $brekk_mellomtid = $tiden + '180';
          $brekk_ny_gjort = $brekk_gjort + '1';
          $brekk_ny_respekt = $respekt + '60';
        
          mysql_query("UPDATE brukere SET respekt='$brekk_ny_respekt',brekk_tid='$brekk_mellomtid',brekk_gjort='$brekk_ny_gjort',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
          echo "<div id=\"SBL_GodkjentTo\">$tekst_svar</div>";
          }}
          ?>
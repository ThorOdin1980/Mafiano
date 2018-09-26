        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($brukernavn)) { header("Location: index.php"); }
        if(empty($_POST['action'])) {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har ikke valgt hva du skal gjøre.</span>';
        echo '</div>';
        include "Abc_produserfilm_steg_2.php";
        } else {
        $sjekk_hva_du_valgte = mysql_real_escape_string($_POST['action']);
        if($sjekk_hva_du_valgte == 'produser' || $sjekk_hva_du_valgte == 'avslutt') { 
        if($sjekk_hva_du_valgte == 'produser') {
        if($film_pris_K2 > $penger) { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har ikke nok penger på hånda til å produsere denne filmen.</span>';
        echo '</div>';
        include "Abc_produserfilm_steg_2.php";
        } else { 

        include "film_sjekk_skuespillere_1.php"; 

        // Sjekker om alle tre passer sammen
        if (preg_match("/$genere_K2/", "$svar_1")) { $kansje_bra_1 = '1'; } else { $kansje_bra_1 = '0'; }
        if (preg_match("/$genere_K2/", "$svar_2")) { $kansje_bra_2 = '1'; } else { $kansje_bra_2 = '0'; }
        if (preg_match("/$genere_K2/", "$svar_3")) { $kansje_bra_3 = '1'; } else { $kansje_bra_3 = '0'; }
        
        // Setter sammen tallet som sier om skuespillerene passer sammen
        $kansje_bra_sjekk = $kansje_bra_1 + $kansje_bra_2 + $kansje_bra_3;
      
           // Start skuespiller tilbakemeldingen
           if($kansje_bra_sjekk == '3') { 
           $prosent_1 = '3'; 
           $tekst_1 = array("Du har skils når det gjelder å velge skuspillere, meget bra.","Skuspillerene passet til sjangeren $genere_K2, bra valg.","Alle tre skuspillerene passet bra til sjangeren $genere_K2.","Du valgte tre skuspillere som passer til sjangeren $genere_K2, bra gjort.");
           $tekst_1 = $tekst_1[array_rand($tekst_1)];
           }
           if($kansje_bra_sjekk == '2') { 
           $prosent_1 = '2'; 
           $tekst_1 = array("Du gjorde et greit valg innen valg av skuspillere men du kunne gjort det bedere, greit valg.","Skuspillerene passet greit til sjangeren $genere_K2.","Bare to av skuspillerene passet bra til sjangeren $genere_K2.","Du valgte to skuspillere som passet til sjangeren, ok valg.");
           $tekst_1 = $tekst_1[array_rand($tekst_1)];
           }
           if($kansje_bra_sjekk == '1') { 
           $prosent_1 = '1'; 
           $tekst_1 = array("Du valgte kun en skuspiller som passet til sjangeren $genere_K2, bedere lykke neste gang.","Du er ikke akkuratt så god til å velge skuspillere, du valgte kun en skuspiller som passet til filmen.","Bare en skuspiller gjorde en superbra jobb i filmen din.","Du valgte en skuspiller som passet til sjangeren $genere_K2, prøv å tenk deg litt mer om neste gang når du velger skuspillere.");
           $tekst_1 = $tekst_1[array_rand($tekst_1)];
           }
           if($kansje_bra_sjekk == '0') { 
           $prosent_1 = '0'; 
           $tekst_1 = array("Du valgte tre skuspillere som ikke passet til sjangeren $genere_K2, du suger i å velge skuspillere.","Du er ikke akkuratt en gud når det gjelder å velge skuspillere en film innen sjangeren $genere_K2.","Ingen av skuspillerene dine passet til filmen din.","Du gjorde et dårlig valg innen valget om skuspillere til filmen din.");
           $tekst_1 = $tekst_1[array_rand($tekst_1)];
           }
           // Slutt skuespiller tilbakemeldingen 
       
              // Sjekker filmens tittel
              if($genere_K2 == 'Action')  { if (preg_match("/$tittel_pris_K2/", "Drap,Mafia,Gangster,Blodbad,Terminator,Mission,Imposibol,Killing,Arnold,Oslo,Massemorder,Enemy,Public,Spider,Die,Hard,Smerte,Max,Payne,Red,Eye")) { $kansje_bra_2 = '1.2'; } else { $kansje_bra_2 = '0.2'; }}
              if($genere_K2 == 'Komedie') { if (preg_match("/$tittel_pris_K2/", "Pie,American,Guru,Blodbad,Pirates,Carabin,Teen,Movie,Ville,Veier,Boretslaget,Titan,Festen,Morromann,Shriek,Simpsons,Futurama,Kongen,Prinsen,Dildo,Team")) { $kansje_bra_2 = '1.2'; } else { $kansje_bra_2 = '0.2'; }}
              if($genere_K2 == 'Grøsser') { if (preg_match("/$tittel_pris_K2/", "Drap,Texas,Kniv,Blodbad,Murder,Killer,Forbannelsen,Killing,Arnold,Drapet,Massemorder,Enemy,Public,Spider,Die,Hard,Smerte,Max,Payne,Red,Eye")) { $kansje_bra_2 = '1.2'; } else { $kansje_bra_2 = '0.2'; }}
              if($genere_K2 == 'Drama')   { if (preg_match("/$tittel_pris_K2/", "Gråtende,Mannen,Tårene,Falt,Bryllupet,Wedding,The,Undergang,Cry,Trøste")) { $kansje_bra_2 = '1.2'; } else { $kansje_bra_2 = '0.2'; }}
              // Lukker sjekk tittel
       
          // Sjekker hvor mange dvd filmer du skal selge          
          if($markeds_K2 == '1 million dvder') { 
          if($antall_film_prod == '0') { $antall_solgte_dvd = rand(200000, 500000); } 
          if($antall_film_prod == '1') { $antall_solgte_dvd = rand(230000, 620000); } 
          if($antall_film_prod == '2') { $antall_solgte_dvd = rand(260000, 700000); } 
          if($antall_film_prod == '3') { $antall_solgte_dvd = rand(300000, 900000); } 
          if($antall_film_prod == '4') { $antall_solgte_dvd = rand(400000, 1000000); } 
          if($antall_film_prod == '5') { $antall_solgte_dvd = rand(500000, 1000000); } 
          if($antall_film_prod == '6') { $antall_solgte_dvd = rand(600000, 1000000); } 
          if($antall_film_prod == '7') { $antall_solgte_dvd = rand(700000, 1000000); } 
          if($antall_film_prod == '8') { $antall_solgte_dvd = rand(800000, 1000000); } 
          if($antall_film_prod >= '9') { $antall_solgte_dvd = rand(900000, 1000000); } 
          }
          if($markeds_K2 == '2 millioner dvder') { 
          if($antall_film_prod == '0') { $antall_solgte_dvd = rand(200000, 500000); } 
          if($antall_film_prod == '1') { $antall_solgte_dvd = rand(230000, 620000); } 
          if($antall_film_prod == '2') { $antall_solgte_dvd = rand(260000, 700000); } 
          if($antall_film_prod == '3') { $antall_solgte_dvd = rand(300000, 900000); } 
          if($antall_film_prod == '4') { $antall_solgte_dvd = rand(400000, 1000000); } 
          if($antall_film_prod == '5') { $antall_solgte_dvd = rand(500000, 1000000); } 
          if($antall_film_prod == '6') { $antall_solgte_dvd = rand(600000, 1000000); } 
          if($antall_film_prod == '7') { $antall_solgte_dvd = rand(700000, 1000000); } 
          if($antall_film_prod == '8') { $antall_solgte_dvd = rand(800000, 1000000); } 
          if($antall_film_prod == '9') { $antall_solgte_dvd = rand(900000, 1000000); } 
          if($antall_film_prod == '10') { $antall_solgte_dvd = rand(1000000, 1200000); } 
          if($antall_film_prod == '11') { $antall_solgte_dvd = rand(1100000, 1300000); } 
          if($antall_film_prod == '12') { $antall_solgte_dvd = rand(1200000, 1400000); } 
          if($antall_film_prod == '13') { $antall_solgte_dvd = rand(1300000, 1500000); } 
          if($antall_film_prod == '14') { $antall_solgte_dvd = rand(1400000, 1600000); } 
          if($antall_film_prod == '15') { $antall_solgte_dvd = rand(1500000, 1700000); }
          if($antall_film_prod == '13') { $antall_solgte_dvd = rand(1600000, 1800000); } 
          if($antall_film_prod == '14') { $antall_solgte_dvd = rand(1700000, 1900000); } 
          if($antall_film_prod >= '15') { $antall_solgte_dvd = rand(1800000, 2000000); }  
          }
          if($markeds_K2 == '6 millioner dvder') { 
          if($antall_film_prod == '0') { $antall_solgte_dvd = rand(200000, 500000); } 
          if($antall_film_prod == '1') { $antall_solgte_dvd = rand(230000, 620000); } 
          if($antall_film_prod == '2') { $antall_solgte_dvd = rand(260000, 700000); } 
          if($antall_film_prod == '3') { $antall_solgte_dvd = rand(300000, 900000); } 
          if($antall_film_prod == '4') { $antall_solgte_dvd = rand(400000, 1000000); } 
          if($antall_film_prod == '5') { $antall_solgte_dvd = rand(500000, 1000000); } 
          if($antall_film_prod == '6') { $antall_solgte_dvd = rand(600000, 1000000); } 
          if($antall_film_prod == '7') { $antall_solgte_dvd = rand(700000, 1000000); } 
          if($antall_film_prod == '8') { $antall_solgte_dvd = rand(800000, 1000000); } 
          if($antall_film_prod == '9') { $antall_solgte_dvd = rand(900000, 1000000); } 
          if($antall_film_prod == '10') { $antall_solgte_dvd = rand(1000000, 1200000); } 
          if($antall_film_prod == '11') { $antall_solgte_dvd = rand(1100000, 1300000); } 
          if($antall_film_prod == '12') { $antall_solgte_dvd = rand(1200000, 1400000); } 
          if($antall_film_prod == '13') { $antall_solgte_dvd = rand(1300000, 1500000); } 
          if($antall_film_prod == '14') { $antall_solgte_dvd = rand(1400000, 1600000); } 
          if($antall_film_prod == '15') { $antall_solgte_dvd = rand(1500000, 1700000); }
          if($antall_film_prod == '13') { $antall_solgte_dvd = rand(1600000, 1800000); } 
          if($antall_film_prod == '14') { $antall_solgte_dvd = rand(1700000, 1900000); } 
          if($antall_film_prod == '15') { $antall_solgte_dvd = rand(1800000, 2000000); }
          if($antall_film_prod == '16') { $antall_solgte_dvd = rand(1000000, 1700000); } 
          if($antall_film_prod == '17') { $antall_solgte_dvd = rand(1500000, 2000000); } 
          if($antall_film_prod == '18') { $antall_solgte_dvd = rand(1900000, 2500000); } 
          if($antall_film_prod == '19') { $antall_solgte_dvd = rand(2400000, 3000000); } 
          if($antall_film_prod == '20') { $antall_solgte_dvd = rand(2900000, 4500000); } 
          if($antall_film_prod == '21') { $antall_solgte_dvd = rand(3400000, 5000000); }
          if($antall_film_prod == '22') { $antall_solgte_dvd = rand(3900000, 5200000); } 
          if($antall_film_prod == '23') { $antall_solgte_dvd = rand(4500000, 5600000); } 
          if($antall_film_prod >= '24') { $antall_solgte_dvd = rand(5000000, 6000000); }  
          }
          if($markeds_K2 == '9 millioner dvder') { 
          if($antall_film_prod == '0') { $antall_solgte_dvd = rand(200000, 500000); } 
          if($antall_film_prod == '1') { $antall_solgte_dvd = rand(230000, 620000); } 
          if($antall_film_prod == '2') { $antall_solgte_dvd = rand(260000, 700000); } 
          if($antall_film_prod == '3') { $antall_solgte_dvd = rand(300000, 900000); } 
          if($antall_film_prod == '4') { $antall_solgte_dvd = rand(400000, 1000000); } 
          if($antall_film_prod == '5') { $antall_solgte_dvd = rand(500000, 1000000); } 
          if($antall_film_prod == '6') { $antall_solgte_dvd = rand(600000, 1000000); } 
          if($antall_film_prod == '7') { $antall_solgte_dvd = rand(700000, 1000000); } 
          if($antall_film_prod == '8') { $antall_solgte_dvd = rand(800000, 1000000); } 
          if($antall_film_prod == '9') { $antall_solgte_dvd = rand(900000, 1000000); } 
          if($antall_film_prod == '10') { $antall_solgte_dvd = rand(1000000, 1200000); } 
          if($antall_film_prod == '11') { $antall_solgte_dvd = rand(1100000, 1300000); } 
          if($antall_film_prod == '12') { $antall_solgte_dvd = rand(1200000, 1400000); } 
          if($antall_film_prod == '13') { $antall_solgte_dvd = rand(1300000, 1500000); } 
          if($antall_film_prod == '14') { $antall_solgte_dvd = rand(1400000, 1600000); } 
          if($antall_film_prod == '15') { $antall_solgte_dvd = rand(1500000, 1700000); }
          if($antall_film_prod == '13') { $antall_solgte_dvd = rand(1600000, 1800000); } 
          if($antall_film_prod == '14') { $antall_solgte_dvd = rand(1700000, 1900000); } 
          if($antall_film_prod == '15') { $antall_solgte_dvd = rand(1800000, 2000000); }
          if($antall_film_prod == '16') { $antall_solgte_dvd = rand(1000000, 1700000); } 
          if($antall_film_prod == '17') { $antall_solgte_dvd = rand(1500000, 2000000); } 
          if($antall_film_prod == '18') { $antall_solgte_dvd = rand(1900000, 2500000); } 
          if($antall_film_prod == '19') { $antall_solgte_dvd = rand(2400000, 3000000); } 
          if($antall_film_prod == '20') { $antall_solgte_dvd = rand(2900000, 4500000); } 
          if($antall_film_prod == '21') { $antall_solgte_dvd = rand(3400000, 5000000); }
          if($antall_film_prod == '22') { $antall_solgte_dvd = rand(3900000, 5200000); } 
          if($antall_film_prod == '23') { $antall_solgte_dvd = rand(4500000, 5600000); } 
          if($antall_film_prod == '24') { $antall_solgte_dvd = rand(5000000, 6000000); }
          if($antall_film_prod == '25') { $antall_solgte_dvd = rand(5500000, 7000000); } 
          if($antall_film_prod == '26') { $antall_solgte_dvd = rand(6000000, 7300000); } 
          if($antall_film_prod == '27') { $antall_solgte_dvd = rand(7000000, 7800000); }
          if($antall_film_prod == '28') { $antall_solgte_dvd = rand(7200000, 8000000); } 
          if($antall_film_prod == '29') { $antall_solgte_dvd = rand(7300000, 8300000); } 
          if($antall_film_prod == '30') { $antall_solgte_dvd = rand(7900000, 8640000); } 
          if($antall_film_prod == '31') { $antall_solgte_dvd = rand(8000000, 8900000); } 
          if($antall_film_prod >= '32') { $antall_solgte_dvd = rand(8500000, 9000000); } 
          }
          
          // Sjekker hvor mye du skal tjene
          if($antall_solgte_dvd >= '200000') { $kansje_bra_3 = '0.3'; }
          if($antall_solgte_dvd >= '250000') { $kansje_bra_3 = '0.4'; }
          if($antall_solgte_dvd >= '300000') { $kansje_bra_3 = '0.5'; }
          if($antall_solgte_dvd >= '350000') { $kansje_bra_3 = '0.6'; }
          if($antall_solgte_dvd >= '400000') { $kansje_bra_3 = '0.7'; }
          if($antall_solgte_dvd >= '450000') { $kansje_bra_3 = '0.8'; }
          if($antall_solgte_dvd >= '500000') { $kansje_bra_3 = '0.9'; }
          if($antall_solgte_dvd >= '550000') { $kansje_bra_3 = '1.0'; }
          if($antall_solgte_dvd >= '600000') { $kansje_bra_3 = '1.2'; }
          if($antall_solgte_dvd >= '650000') { $kansje_bra_3 = '1.3'; }
          if($antall_solgte_dvd >= '700000') { $kansje_bra_3 = '1.4'; }
          if($antall_solgte_dvd >= '750000') { $kansje_bra_3 = '1.5'; }
          if($antall_solgte_dvd >= '800000') { $kansje_bra_3 = '1.7'; }
          if($antall_solgte_dvd >= '850000') { $kansje_bra_3 = '2.0'; }
          if($antall_solgte_dvd >= '900000') { $kansje_bra_3 = '2.3'; }
          if($antall_solgte_dvd >= '950000') { $kansje_bra_3 = '2.5'; }
          if($antall_solgte_dvd >= '1000000') { $kansje_bra_3 = '2.7'; }
          if($antall_solgte_dvd >= '1500000') { $kansje_bra_3 = '2.9'; }
          if($antall_solgte_dvd >= '2000000') { $kansje_bra_3 = '3.1'; }
          if($antall_solgte_dvd >= '2500000') { $kansje_bra_3 = '3.3'; }
          if($antall_solgte_dvd >= '3000000') { $kansje_bra_3 = '3.5'; }
          if($antall_solgte_dvd >= '3500000') { $kansje_bra_3 = '3.7'; }
          if($antall_solgte_dvd >= '4000000') { $kansje_bra_3 = '3.8'; }
          if($antall_solgte_dvd >= '4500000') { $kansje_bra_3 = '3.9'; }
          if($antall_solgte_dvd >= '5000000') { $kansje_bra_3 = '4.1'; }
          if($antall_solgte_dvd >= '5500000') { $kansje_bra_3 = '4.3'; }
          if($antall_solgte_dvd >= '6000000') { $kansje_bra_3 = '4.9'; }
          if($antall_solgte_dvd >= '6500000') { $kansje_bra_3 = '5.1'; }
          if($antall_solgte_dvd >= '7000000') { $kansje_bra_3 = '5.3'; }
          if($antall_solgte_dvd >= '7500000') { $kansje_bra_3 = '5.5'; }
          if($antall_solgte_dvd >= '8000000') { $kansje_bra_3 = '6.4'; }
          if($antall_solgte_dvd >= '8500000') { $kansje_bra_3 = '7.1'; }
          
        if($statister_K2 == '100 forsjellige statister') { $kansje_bra_4 = array("0.0","0.1","0.2"); $tekst_2 = array("Folk gjennkjente noen av statistene dine, de likte ikke at du ikke hadde større variasnjon.","Folk flest gjennkjente mange av statistene dine i flere forsjellige roller, dårlig inntrykk på filmen din.","Statistene dine var lett gjennkjennlige folk så samme statist i flere roller, serene likte ikke det.","Alle som så filmen din gjennkjente flere statister i flere forsjellige roller, dårlig inntrykk på filmen din.","Statistene dine var lett gjennkjennlig i flere forsjellige roller og dette likte ikke seerene."); }
        if($statister_K2 == '200 forsjellige statister') { $kansje_bra_4 = array("0.2","0.3","0.4"); $tekst_2 = array("Det var et fåtall av personene som hadde sett filmen din som gjennkjente noen statister i flere forsjellige roller, ikke så veldig bra intrykk på filmen.","En av ti personer gjennkjente en statist i flere roller, dårlig inntrykk på filmen din.","Folk flest gjennkjente statistene i flere forsjellige roller, om du hadde hatt en større variasjon av statister så hadde det vært mer lønsomt."); }
        if($statister_K2 == '300 forsjellige statister') { $kansje_bra_4 = array("0.3","0.4","0.5"); $tekst_2 = array("Det var ett fåtall av statistene dine som måtte spille flere roller, dette er ikke bra du skulle hatt fler statister for og få mer ut av film produksjonen.","Det gikk greit å varriere tre hundre statister i filmen din, ingen gjenkjente en statistk i fler roller, bra gjort.","Statistene dine ble ikke gjennkjent i flere roller, bra plassering og sminking av statister."); }
        if($statister_K2 == '400 forsjellige statister') { $kansje_bra_4 = array("0.4","0.5","0.6"); $tekst_2 = array("En av statistene dine var lett gjennkjennlig i fler roller, du skulle ikke ha brukt en statist i fler roller du skulle heller ha ansatt fler statister for og få best mulig resultat.","Alle de fire hundre statistene dine gjorde en superbra jobb.","Du fikk maksimalt utbydde innen filmingen av statister, bra jobba.","Fire hundre statister jobbet skit bra i filmen din."); }
        if($statister_K2 == '500 forsjellige statister') { $kansje_bra_4 = array("0.5","0.6","0.7"); $tekst_2 = array("Du fikk bra tilbakemelding innen valg av antall statister, bra gjort.","Ingen statister ble gjennkjent i filmen din, bra filming er grunnlaget for dette.","Statistene dine presterte til det maksimale for og gjøre filmen din best mulig, bra gjort.","Fem hundre statister gjorde en perfekt jobb uten å bli gjennkjent i dobbeltroller, bra gjort."); }
        if($statister_K2 == '600 forsjellige statister') { $kansje_bra_4 = array("0.6","0.7","0.8"); $tekst_2 = array("Seks hundre forsjellige statister gjorde en bra jobb i filmen din.","Alle statistene dine gjorde en bra jobb under filmingen.","Ingen av statistene dine ble gjennkjent i flere roller, bra utført filming."); }
        if($statister_K2 == '700 forsjellige statister') { $kansje_bra_4 = array("0.7","0.8","0.9"); $tekst_2 = array("Alle statistene hadde en passe bra innsats under filmingen din.","Det var lurt av deg å ansette sju hundre statister, godt valg.","Du ansatte så mange statister at det ikke var nødvendig å bruke en av statistene i flere roller, bra gjort.","Fire hundre menn og tre hundre damer jobbet i filmen din som statister, alle gjorde en skit bra jobb."); }
        if($statister_K2 == '800 forsjellige statister') { $kansje_bra_4 = array("0.8","0.9","1.0"); $tekst_2 = array("Du ansatte åtte hundre statister til å jobbe for deg, det var et lurt valg å ansette så mange statister for det ga deg et bra resultat.","En variasjon på 800 hundre statister gjorde susen, bra gjort $brukernavn.","800 hundre statister jobbet for å få filmen din best mulig, bra gjort.","Du ansatte åtte hundre statsiter til filmen din, alle gjorde en bra jobb."); }
        if($statister_K2 == '900 forsjellige statister') { $kansje_bra_4 = array("0.9","1.0","1.1"); $tekst_2 = array("Ni hundre statister jobbet for deg, ingen statister ble gjennkjent i flere roller.","Så flinke statister skal du lete lenge etter, bra valg av x antall statister.","Statistene dine gjorde en unik jobb under filmingen, bedere resultat kunne du ikke ha fått.","Statistene dine gjorde en super-jobb, du kunne ikke fått noe bedere resultat en dette."); }
        $kansje_bra_4 = $kansje_bra_4[array_rand($kansje_bra_4)]; 
        $tekst_2 = $tekst_2[array_rand($tekst_2)];
          
         // Kjøns tilbakemeldinger
         if($kjoonn == 'Gutt') {
         $sjekk_kjon_0 = 'en';
         $sjekk_kjon_1 = 'mann';
         $sjekk_kjon_2 = 'mannen';
         $sjekk_kjon_3 = 'jentene';
         $sjekk_kjon_4 = 'damene';
         $sjekk_kjon_5 = 'homofile';
         $sjekk_kjon_6 = 'mannlig';
         $sjekk_kjon_7 = 'gangster';
         $sjekk_kjon_8 = 'muskuløs';
         $sjekk_kjon_9 = 'mennene';
         $sjekk_kjon_10 = 'gud';
         $sjekk_kjon_11 = 'venn';
         } else {
         $sjekk_kjon_0 = 'ei';
         $sjekk_kjon_1 = 'dame';
         $sjekk_kjon_2 = 'damen';
         $sjekk_kjon_3 = 'guttene';
         $sjekk_kjon_4 = 'mennene';
         $sjekk_kjon_5 = 'lespiske';
         $sjekk_kjon_6 = 'kvinlig';
         $sjekk_kjon_7 = 'gangsterinne';
         $sjekk_kjon_8 = 'muskuløs';
         $sjekk_kjon_9 = 'damene';
         $sjekk_kjon_10 = 'gudinne';
         $sjekk_kjon_11 = 'venninne';
         } 
         
          
         if($vis_K2 == 'Vis i scandinavia') { 
         if($antall_film_prod >= '0') { $kansje_bra_5 = array("0.0","0.1","0.2"); $antall_kino_seere = rand(20000, 90000);  $tekst_3 = array("Det var $antall_kino_seere personer som gikk på kino får å se filmen din.","Det var $antall_kino_seere personer i scandinavia som så filmen din på kino.","Det kom $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '1') { $kansje_bra_5 = array("0.1","0.2","0.3"); $antall_kino_seere = rand(30000, 100000); $tekst_3 = array("Statistikken viser at det var $antall_kino_seere personer i scandinavia som så filmen din.","Det ble solgt $antall_kino_seere kinobiletter til filmen din i scandinavia."); }
         if($antall_film_prod >= '2') { $kansje_bra_5 = array("0.2","0.3","0.4"); $antall_kino_seere = rand(40000, 110000); $tekst_3 = array("$antall_kino_seere personer fra scandinavia så filmen din på kino.","Beregningene tilsier at det ble solgt $antall_kino_seere kinobiletter i scandinavia."); }
         if($antall_film_prod >= '3') { $kansje_bra_5 = array("0.3","0.4","0.5"); $antall_kino_seere = rand(50000, 120000); $tekst_3 = array("Antall film elskere i scandinavia begyner å øke, du solgte $antall_kino_seere kinobiletter i scandinavia.","Det var $antall_kino_seere mennesker fra scandinavia som så filmen din på kino.");  }
         if($antall_film_prod >= '4') { $kansje_bra_5 = array("0.4","0.5","0.6"); $antall_kino_seere = rand(60000, 130000); $tekst_3 = array("Filmen din solgte $antall_kino_seere kinobiletter i scandinavia.","Filmen din solgte rundt $antall_kino_seere kinobiletter.");  }
         if($antall_film_prod >= '5') { $kansje_bra_5 = array("0.5","0.6","0.7"); $antall_kino_seere = rand(70000, 140000); $tekst_3 = array("Antall film elskere i scandinavia begyner å øke, du solgte $antall_kino_seere kinobiletter i scandinavia.","Det var $antall_kino_seere mennesker fra scandinavia som så filmen din på kino.");  }
         if($antall_film_prod >= '6') { $kansje_bra_5 = array("0.6","0.7","0.8"); $antall_kino_seere = rand(80000, 150000); $tekst_3 = array("Det var $antall_kino_seere personer som gikk på kino får å se filmen din.","Du var $antall_kino_seere personer i scandinavia som så filmen din på kino.","Det kom $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '7') { $kansje_bra_5 = array("0.7","0.8","0.9"); $antall_kino_seere = rand(90000, 160000); $tekst_3 = array("$antall_kino_seere personer fra scandinavia så filmen din på kino.","Beregningene tilsier at det ble solgt $antall_kino_seere kinobiletter i scandinavia."); }
         if($antall_film_prod >= '8') { $kansje_bra_5 = array("0.8","0.9","1.0"); $antall_kino_seere = rand(100000, 170000);  $tekst_3 = array("$antall_kino_seere personer kom for å se filmen din på kino.","Det kom $antall_kino_seere forsjellige personer for å se filmen din på kino."); }
         if($antall_film_prod >= '9') { $kansje_bra_5 = array("0.9","1.0","1.1"); $antall_kino_seere = rand(110000, 180000);  $tekst_3 = array("Det var $antall_kino_seere unike seere som kom for å se filmen din på kino."); }
         if($antall_film_prod >= '10') { $kansje_bra_5 = array("1.0","1.1","1.2"); $antall_kino_seere = rand(130000, 200000); $tekst_3 = array("Det var $antall_kino_seere mennesker fra scandinavia som så filmen din på kino, begyner å bli bra detta."); }
         if($antall_film_prod >= '11') { $kansje_bra_5 = array("1.1","1.2","1.3"); $antall_kino_seere = rand(150000, 210000); $tekst_3 = array("Antall filmelskere i scandinavia begyner å øke, du solgte $antall_kino_seere kinobiletter i scandinavia.","Det var $antall_kino_seere mennesker fra scandinavia som så filmen din på kino."); }
         if($antall_film_prod >= '12') { $kansje_bra_5 = array("1.2","1.3","1.4"); $antall_kino_seere = rand(170000, 220000); $tekst_3 = array("Filmen din solgte $antall_kino_seere kinobiletter i scandinavia.","Filmen din solgte rundt $antall_kino_seere kinobiletter."); }
         if($antall_film_prod >= '13') { $kansje_bra_5 = array("1.3","1.4","1.5"); $antall_kino_seere = rand(180000, 250000); $tekst_3 = array("Du solgte bra med kinobiletter i scandinavia, du burde gå videre til å vise filmen din i hele europa."); }
         if($antall_film_prod >= '14') { $kansje_bra_5 = array("1.4","1.5","1.6"); $antall_kino_seere = rand(200000, 300000); $tekst_3 = array("Du burde slutte å vise filmen din i scandinavia og heller vise den i europa.","For å få mest mulig inntekt burde du gå videre å vise filmen din i hele europa."); }
         } 
         if($vis_K2 == 'Vis i europa') {
         if($antall_film_prod >= '0') { $kansje_bra_5 = array("0.0","0.1","0.2"); $antall_kino_seere = rand(20000, 90000);  $tekst_3 = array("Du lanserte filmen din i hele europa, det var et dumt valg for det kom bare $antall_kino_seere personer for å se filmen din på kino.","Det kom bare $antall_kino_seere personer for å se filmen din, du skulle ikke ha lansert filmen i hele europa."); }
         if($antall_film_prod >= '1') { $kansje_bra_5 = array("0.1","0.2","0.3"); $antall_kino_seere = rand(30000, 100000); $tekst_3 = array("Du satser for stort du burde ikke lansere filmen din i hele europa du burde vise den i scandinavia.","Du skulle heller vist filmen din i scandinavia og ikke hele europa for det ville ha gitt bedere resultat."); }
         if($antall_film_prod >= '2') { $kansje_bra_5 = array("0.2","0.3","0.4"); $antall_kino_seere = rand(40000, 110000); $tekst_3 = array("Du burde vente med å lansere filmene dine i europa ettersom du ikke er så veldig kjent enda."); }
         if($antall_film_prod >= '3') { $kansje_bra_5 = array("0.3","0.4","0.5"); $antall_kino_seere = rand(50000, 120000); $tekst_3 = array("Du fikk et dårlig resultat innen solgte kinobiletter i europa når man tenker på hvor mange personer som bor i europa, hold deg til scandinavia litt til du."); }
         if($antall_film_prod >= '4') { $kansje_bra_5 = array("0.4","0.5","0.6"); $antall_kino_seere = rand(60000, 130000); $tekst_3 = array("Du lanserte filmen din i hele europa, det var et dumt valg for det kom bare $antall_kino_seere personer for å se filmen din på kino.","Det kom bare $antall_kino_seere personer for å se filmen din, du skulle ikke ha lansert filmen i hele europa."); }
         if($antall_film_prod >= '5') { $kansje_bra_5 = array("0.5","0.6","0.7"); $antall_kino_seere = rand(70000, 140000); $tekst_3 = array("Du satser for stort du burde ikke lansere filmen din i hele europa du burde vise den i scandinavia.","Du skulle heller vist filmen din i scandinavia og ikke hele europa for det ville ha gitt bedere resultat."); }
         if($antall_film_prod >= '6') { $kansje_bra_5 = array("0.6","0.7","0.8"); $antall_kino_seere = rand(80000, 150000); $tekst_3 = array("Filmen din solgte dårlig med kinobiletter i europa forhold til antall folk som befinner seg i europa, men om filmen kun hadde vært lansert i scandinavia så hadde dette vært et bra resultat."); }
         if($antall_film_prod >= '7') { $kansje_bra_5 = array("0.7","0.8","0.9"); $antall_kino_seere = rand(90000, 160000);   $tekst_3 = array("Filmen din ble sett av $antall_kino_seere seere."); }
         if($antall_film_prod >= '8') { $kansje_bra_5 = array("0.8","0.9","1.0"); $antall_kino_seere = rand(100000, 170000);  $tekst_3 = array("Det kom $antall_kino_seere personer på premiæren."); }
         if($antall_film_prod >= '9') { $kansje_bra_5 = array("0.9","1.0","1.1"); $antall_kino_seere = rand(110000, 180000);  $tekst_3 = array("Filmen din solgte $antall_kino_seere biletter på premiæren."); }
         if($antall_film_prod >= '10') { $kansje_bra_5 = array("1.0","1.1","1.2"); $antall_kino_seere = rand(130000, 200000); $tekst_3 = array("Det var $antall_kino_seere personer som gikk på kino får å se filmen din.","Filmen din solgte $antall_kino_seere kinobiletter."); }
         if($antall_film_prod >= '11') { $kansje_bra_5 = array("1.1","1.2","1.3"); $antall_kino_seere = rand(150000, 210000); $tekst_3 = array("Statistikken viser at det var $antall_kino_seere personer i europa som så filmen din."); }
         if($antall_film_prod >= '12') { $kansje_bra_5 = array("1.2","1.3","1.4"); $antall_kino_seere = rand(170000, 220000); $tekst_3 = array("Du burde faktisk holde deg til visninger på kino i scandinavia noen ganger til for å få mest ut av bilettsalget i europa."); }
         if($antall_film_prod >= '13') { $kansje_bra_5 = array("1.3","1.4","1.5"); $antall_kino_seere = rand(180000, 250000); $tekst_3 = array("Du solgte rundt $antall_kino_seere kinobiletter i europa.","For å være presis så var det akuratt $antall_kino_seere personer som så filmen din på førpremiæren."); }
         if($antall_film_prod >= '14') { $kansje_bra_5 = array("1.4","1.5","1.6"); $antall_kino_seere = rand(200000, 300000); $tekst_3 = array("$antall_kino_seere personer kom for å se filmen din på kino.","Antall folk i europa som så filmen din på kino var $antall_kino_seere."); }
         if($antall_film_prod >= '15') { $kansje_bra_5 = array("1.5","1.6","1.7"); $antall_kino_seere = rand(220000, 320000); $tekst_3 = array("I europa solgte du $antall_kino_seere kinobiletter."); }
         if($antall_film_prod >= '16') { $kansje_bra_5 = array("1.6","1.7","1.8"); $antall_kino_seere = rand(240000, 340000); $tekst_3 = array("Det var $antall_kino_seere mennesker rundt omkring i europa som så filmen din på kino, begyner å bli bra detta.","Det var $antall_kino_seere personer som gikk på kino får å se filmen din."); }
         if($antall_film_prod >= '17') { $kansje_bra_5 = array("1.7","1.8","1.9"); $antall_kino_seere = rand(260000, 360000); $tekst_3 = array("Det kom $antall_kino_seere personer for å se filmen din på kino.","Antall fans øker stort i europa, du solgte $antall_kino_seere kinobiletter i totalt."); }
         if($antall_film_prod >= '18') { $kansje_bra_5 = array("1.8","1.9","2.0"); $antall_kino_seere = rand(280000, 380000); $tekst_3 = array("Det gikk okei innen bilettsalget, du solgte en sum som tilsvarer $antall_kino_seere biletter.","Filmen din solgte $antall_kino_seere biletter på premiæren."); }
         if($antall_film_prod >= '19') { $kansje_bra_5 = array("1.9","2.0","2.1"); $antall_kino_seere = rand(300000, 400000); $tekst_3 = array("Beregningene tilsier at det ble solgt $antall_kino_seere kinobiletter i europa.","Det var et passe salg av kinobiletter, det var cirka $antall_kino_seere jenter å gutter som så filmen din."); }
         if($antall_film_prod >= '20') { $kansje_bra_5 = array("2.0","2.1","2.2"); $antall_kino_seere = rand(350000, 450000); $tekst_3 = array("Du solgte bra med kinobiletter i europa, det var rundt $antall_kino_seere kinobiletter som ble solgt."); }
         if($antall_film_prod >= '21') { $kansje_bra_5 = array("2.1","2.2","2.3"); $antall_kino_seere = rand(400000, 500000); $tekst_3 = array("Veldig bra produsert, du solgte $antall_kino_seere biletter i europa.","Folk flest elsket at det var $sjekk_kjon_0 $sjekk_kjon_8 $sjekk_kjon_1 som produserte filmen, det kom $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '22') { $kansje_bra_5 = array("2.2","2.3","2.4"); $antall_kino_seere = rand(450000, 550000); $tekst_3 = array("Du solgte rundt $antall_kino_seere kinobiletter i europa.","Produseringen av filmen var vellykket i europa for statistikken viser at det faktisk var $antall_kino_seere personer som så filmen din på premiæren."); }
         if($antall_film_prod >= '23') { $kansje_bra_5 = array("2.3","2.4","2.5"); $antall_kino_seere = rand(500000, 600000); $tekst_3 = array("For å være presis så var det akuratt $antall_kino_seere personer som så filmen din på førpremiæren."); }
         if($antall_film_prod >= '24') { $kansje_bra_5 = array("2.4","2.5","2.6"); $antall_kino_seere = rand(550000, 650000); $tekst_3 = array("Ryktene om deg spres rundt i verden stadig vekk, om fire til fem produseringener til er i boks så burde du skifte over til verdensmarkede.","Film produseringen din begynner å bli skit bra for resultatet på antall folk som kom for å se filmen din på kino var $antall_kino_seere."); }
         if($antall_film_prod >= '25') { $kansje_bra_5 = array("2.5","2.6","2.7"); $antall_kino_seere = rand(600000, 700000); $tekst_3 = array("Filmen din er elskbar for filmen din solgte bra med kinobiletter i europa."); }
         if($antall_film_prod >= '26') { $kansje_bra_5 = array("2.6","2.7","2.8"); $antall_kino_seere = rand(650000, 750000); $tekst_3 = array("Filmen din ble sett av $antall_kino_seere personer på kino, du kan snart gå over til å vise filmen din i hele verden."); }
         if($antall_film_prod >= '27') { $kansje_bra_5 = array("2.7","2.8","2.9"); $antall_kino_seere = rand(700000, 800000); $tekst_3 = array("Folk flest elsket at det var $sjekk_kjon_0 $sjekk_kjon_8 $sjekk_kjon_1 som produserte filmen, det kom $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '28') { $kansje_bra_5 = array("2.8","2.9","3.0"); $antall_kino_seere = rand(750000, 850000); $tekst_3 = array("Du solgte $antall_kino_seere billetter rundt omkring i europa.","Seerene likte at det var $sjekk_kjon_0 $sjekk_kjon_1 som sto bak produseringen av en så bra film, det kom faktisk $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '29') { $kansje_bra_5 = array("2.9","3.0","3.1"); $antall_kino_seere = rand(800000, 900000); $tekst_3 = array("Du burde slutte å vise filmen din i europa og heller satse på hele verden.","Verden venter på deg så hvorfor vise filmen kun i europa."); }
         } 
         if($vis_K2 == 'Vis globalt') {
         if($antall_film_prod >= '0') { $kansje_bra_5 = array("0.0","0.1","0.2"); $antall_kino_seere = rand(20000, 90000);   $tekst_3 = array("Du har for mye tro på deg selv når du prøver deg på verdensbasis med en gang.","Du burde ikke vise filmen din i hele verden faktisk så burde du ikke engang vise filmen din i europa."); }
         if($antall_film_prod >= '1') { $kansje_bra_5 = array("0.1","0.2","0.3"); $antall_kino_seere = rand(30000, 100000);  $tekst_3 = array("Du burde skjønne at det ikke kommer mange for å se filmen din når du såvidt har begynt med produsering av filmer.","Du burde ikke produsere en film på verdens markede når du såvidt har begynt å produsere filmer, start med scandinavia du."); }
         if($antall_film_prod >= '2') { $kansje_bra_5 = array("0.2","0.3","0.4"); $antall_kino_seere = rand(40000, 110000);  $tekst_3 = array("Du burde vente med å lansere filmene dine i hele verden ettersom du ikke er så veldig kjent enda."); }
         if($antall_film_prod >= '3') { $kansje_bra_5 = array("0.3","0.4","0.5"); $antall_kino_seere = rand(50000, 120000);  $tekst_3 = array("Hold deg til scandinavia for folk liker deg ikke andre steder enda.","Statistikken viser at det var $antall_kino_seere personer i verden som så filmen din, ikke for å være frekk men det er faen meg dårlig når du viser filmen din på verdensbasis."); }
         if($antall_film_prod >= '4') { $kansje_bra_5 = array("0.4","0.5","0.6"); $antall_kino_seere = rand(60000, 130000);  $tekst_3 = array("Du burde faktisk holde deg til visninger på kino i scandinavia for resultatet av bilettsalget sugde stort når du tenker på hvor mange personer det er i verden."); }
         if($antall_film_prod >= '5') { $kansje_bra_5 = array("0.5","0.6","0.7"); $antall_kino_seere = rand(70000, 140000);  $tekst_3 = array("Hold deg til scandinavia du er ikke akkuratt den beste produsenten på verdensbasis."); }
         if($antall_film_prod >= '6') { $kansje_bra_5 = array("0.6","0.7","0.8"); $antall_kino_seere = rand(80000, 150000);  $tekst_3 = array("Beregningene tilsier at det ble solgt $antall_kino_seere kinobiletter i hele verden, for og si det mildt sakt så kan ikke du måle deg med bilettsalget til de store folkene, viss du skal måles opp mot noen så er det småprodusenter i scandinavia.","Du burde ikke gå ut å vise filmen din i hele europa enda, hold deg til scandinavia rundt seks ganger til du."); }
         if($antall_film_prod >= '7') { $kansje_bra_5 = array("0.7","0.8","0.9"); $antall_kino_seere = rand(90000, 160000);  $tekst_3 = array("Filmen din solgte $antall_kino_seere biletter på premiæren, hold deg til produsering i scandinavia noen ganger til så går du over til produsering i europa for verden er ikke klar for dine filmer enda."); }
         if($antall_film_prod >= '8') { $kansje_bra_5 = array("0.8","0.9","1.0"); $antall_kino_seere = rand(100000, 170000); $tekst_3 = array("Verden er faen meg ikke klare for deg enda, sier seg vel selv når du får et resultat på $antall_kino_seere seere når filmen ble vist på verdensbasis."); }
         if($antall_film_prod >= '9') { $kansje_bra_5 = array("0.9","1.0","1.1"); $antall_kino_seere = rand(110000, 180000); $tekst_3 = array("Vis filmen din i scandinavia! resultatet på salg av biletter var dårlig.","Du burde ikke gå ut å vise filmen din i hele europa enda, hold deg til scandinavia rundt fire ganger til du."); }
         if($antall_film_prod >= '10') { $kansje_bra_5 = array("1.0","1.1","1.2"); $antall_kino_seere = rand(130000, 200000); $tekst_3 = array("Du solgte rundt $antall_kino_seere kinobiletter i verden, fucka resultat ass for det er en god del mennesker som har tilgang til kino i verden."); }
         if($antall_film_prod >= '11') { $kansje_bra_5 = array("1.1","1.2","1.3"); $antall_kino_seere = rand(150000, 210000); $tekst_3 = array("Du burde ikke ha så store forhåpninger at du trur hele verden vil like deg som produsent, hold deg til scandinavia du."); }
         if($antall_film_prod >= '12') { $kansje_bra_5 = array("1.2","1.3","1.4"); $antall_kino_seere = rand(170000, 220000); $tekst_3 = array("Du burde ikke ta et så stort steg, du burde vise filmen din i scandinavia istede.","For et resultat av seere, ikke akuratt bra for å si det slik. Hold deg til scandinavia noen ganger til du så går du heller over til europa ettervært."); }
         if($antall_film_prod >= '13') { $kansje_bra_5 = array("1.3","1.4","1.5"); $antall_kino_seere = rand(180000, 250000); $tekst_3 = array("Produser på verdensbasis senere du fordi verden er ikke klar for dine filmer enda men det er derimot europa snart."); }
         if($antall_film_prod >= '14') { $kansje_bra_5 = array("1.4","1.5","1.6"); $antall_kino_seere = rand(200000, 300000); $tekst_3 = array("Hold deg til europa for verden er ikke klar for et kjeni som deg enda, solgte ikke så bra med kinobiletter på verdensbasis.","Du kan ikke bare gå rett til produsering på verdensbasis uten å ha blitt kjent nok i europa. Hold deg til produsering i europa du lille $sjekk_kjon_11."); }
         if($antall_film_prod >= '15') { $kansje_bra_5 = array("1.5","1.6","1.7"); $antall_kino_seere = rand(220000, 320000); $tekst_3 = array("Europa er klar for deg men det er nok ikke hele verden så vi anbefaler deg å kun vise filmen din i europa og ikke hele verden en del ganger."); }
         if($antall_film_prod >= '16') { $kansje_bra_5 = array("1.6","1.7","1.8"); $antall_kino_seere = rand(240000, 340000); $tekst_3 = array("Verden venter ikke på filmer fra deg men derimot gjør verdensdelen europa det så ikke produser filmer i hele verden før du får veldig bra resultat på bilettsalget i europa.","Du burde ikke starte så stort når du er på dette nivået innen produsering av filmer, faktisk så burde du gå ned til å vise filmene dine i europa noen ganger til."); }
         if($antall_film_prod >= '17') { $kansje_bra_5 = array("1.7","1.8","1.9"); $antall_kino_seere = rand(260000, 360000); $tekst_3 = array("Produsering på verdensbasis? har du blitt gal eller for du burde rett å slett holde deg til europa en god del ganger til."); }
         if($antall_film_prod >= '18') { $kansje_bra_5 = array("1.8","1.9","2.0"); $antall_kino_seere = rand(280000, 380000); $tekst_3 = array("Du burde ikke gå ut å vise filmen din på verdensbasis enda, hold deg til europa rundt fem ganger til du for å tjene mest mulig.","Hold deg til europa for du er ikke akkuratt den beste produsenten på verdensbasis."); }
         if($antall_film_prod >= '19') { $kansje_bra_5 = array("1.9","2.0","2.1"); $antall_kino_seere = rand(300000, 400000); $tekst_3 = array("Du solgte rundt $antall_kino_seere kinobiletter i europa.","For å være presis så var det akuratt $antall_kino_seere personer som så filmen din på førpremiæren."); }
         if($antall_film_prod >= '20') { $kansje_bra_5 = array("2.0","2.1","2.2"); $antall_kino_seere = rand(350000, 450000); $tekst_3 = array("Verden venter ikke på filmer fra deg men derimot gjør verdensdelen europa det så ikke produser filmer i hele verden før du får veldig bra resultat på bilettsalget i europa."); }
         if($antall_film_prod >= '21') { $kansje_bra_5 = array("2.1","2.2","2.3"); $antall_kino_seere = rand(400000, 500000); $tekst_3 = array("Du fikk et dårlig resultat av bilettsalget i hele verden men om dette hadde vært et resultat som var i kun europa så hadde det vært bra, resultat av kinobiletter solg var $antall_kino_seere solgte biletter."); }
         if($antall_film_prod >= '22') { $kansje_bra_5 = array("2.2","2.3","2.4"); $antall_kino_seere = rand(450000, 550000); $tekst_3 = array("Du burde ikke gå ut å vise filmen din på verdensbasis enda, hold deg til europa rundt fem ganger til du for å tjene mest mulig.","Hold deg til europa for du er ikke akkuratt den beste produsenten på verdensbasis."); }
         if($antall_film_prod >= '23') { $kansje_bra_5 = array("2.3","2.4","2.5"); $antall_kino_seere = rand(500000, 600000); $tekst_3 = array("Verden venter ikke på filmer fra deg men derimot gjør verdensdelen europa det så ikke produser filmer i hele verden før du får veldig bra resultat på bilettsalget i europa."); }
         if($antall_film_prod >= '24') { $kansje_bra_5 = array("2.4","2.5","2.6"); $antall_kino_seere = rand(550000, 650000); $tekst_3 = array("Vis filmen din i europa! resultatet på salg av biletter var dårlig.","Filmen din solgte $antall_kino_seere biletter på premiæren, hold deg til produsering i europa noen ganger til du."); }
         if($antall_film_prod >= '25') { $kansje_bra_5 = array("2.5","2.6","2.7"); $antall_kino_seere = rand(600000, 700000); $tekst_3 = array("Hold deg til europa for du er ikke akkuratt den beste produsenten på verdensbasis.","Du solgte rundt $antall_kino_seere kinobiletter i verden."); }
         if($antall_film_prod >= '26') { $kansje_bra_5 = array("2.6","2.7","2.8"); $antall_kino_seere = rand(650000, 750000); $tekst_3 = array("Hold deg til europa for hele verden har ikke hørt om deg enda så hold deg til europa noen få ganger til."); }
         if($antall_film_prod >= '27') { $kansje_bra_5 = array("2.7","2.8","2.9"); $antall_kino_seere = rand(700000, 800000); $tekst_3 = array("En produsent venn råder deg til å kun vise filmen i europa noen ganger til for etter at han så resultat av kinobiletter solgt i hele verden så var han ikke akkuratt stolt over deg som $sjekk_kjon_11."); }
         if($antall_film_prod >= '28') { $kansje_bra_5 = array("2.8","2.9","3.0"); $antall_kino_seere = rand(750000, 850000); $tekst_3 = array("Du kan snart produsere filmer i hele verden men ikke helt enda så hold deg til bilettsalg i europa noen få ganger til."); }
         if($antall_film_prod >= '29') { $kansje_bra_5 = array("2.9","3.0","3.1"); $antall_kino_seere = rand(800000, 900000); $tekst_3 = array("Du solgte rundt $antall_kino_seere kinobiletter i verden.","Det var et passe salg av kinobiletter, det var cirka $antall_kino_seere jenter å gutter som så filmen din."); }
         if($antall_film_prod >= '30') { $kansje_bra_5 = array("3.0","3.1","3.2"); $antall_kino_seere = rand(850000, 950000); $tekst_3 = array("Folk flest elsket at det var $sjekk_kjon_0 $sjekk_kjon_8 $sjekk_kjon_1 som produserte filmen, det kom $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '31') { $kansje_bra_5 = array("3.1","3.2","3.3"); $antall_kino_seere = rand(900000, 1100000); $tekst_3 = array("Du solgte rundt $antall_kino_seere kinobiletter i verden.","Det var et greit salg av kinobiletter, det var cirka $antall_kino_seere jenter å gutter som så filmen din."); }
         if($antall_film_prod >= '32') { $kansje_bra_5 = array("3.2","3.3","3.4"); $antall_kino_seere = rand(950000, 1150000); $tekst_3 = array("Det gikk okei innen bilettsalget, du solgte en sum som tilsvarer $antall_kino_seere biletter.","Filmen din solgte $antall_kino_seere biletter på premiæren."); }
         if($antall_film_prod >= '33') { $kansje_bra_5 = array("3.3","3.4","3.5"); $antall_kino_seere = rand(1000000, 1200000); $tekst_3 = array("Filmen din solgte $antall_kino_seere biletter på verdensbasis."); }
         if($antall_film_prod >= '34') { $kansje_bra_5 = array("3.4","3.5","3.6"); $antall_kino_seere = rand(1100000, 1300000); $tekst_3 = array("Du fikk et bra resultat på verdensbasis, du solgte $antall_kino_seere kinobiletter."); }
         if($antall_film_prod >= '35') { $kansje_bra_5 = array("3.5","3.6","3.7"); $antall_kino_seere = rand(1200000, 1400000); $tekst_3 = array("Du solgte rundt $antall_kino_seere kinobiletter i europa.","For å være presis så var det akuratt $antall_kino_seere personer som så filmen din på førpremiæren."); }
         if($antall_film_prod >= '36') { $kansje_bra_5 = array("3.6","3.7","3.8"); $antall_kino_seere = rand(1300000, 1600000); $tekst_3 = array("Du fikk et bra resultat på verdensbasis, du solgte $antall_kino_seere kinobiletter."); }
         if($antall_film_prod >= '37') { $kansje_bra_5 = array("3.7","3.8","3.9"); $antall_kino_seere = rand(1400000, 1800000); $tekst_3 = array("Det gikk bra innen bilettsalget, du solgte en sum som tilsvarer $antall_kino_seere biletter.","Filmen din solgte $antall_kino_seere biletter på premiæren."); }
         if($antall_film_prod >= '38') { $kansje_bra_5 = array("3.8","3.9","4.0"); $antall_kino_seere = rand(1500000, 1900000); $tekst_3 = array("$brukernavn du gjorde en superduper bra jobb som produsent og filmskriver for det kom $antall_kino_seere mennesker på premiæren."); }
         if($antall_film_prod >= '39') { $kansje_bra_5 = array("3.9","4.0","4.1"); $antall_kino_seere = rand(1600000, 2000000); $tekst_3 = array("De $antall_kino_seere $sjekk_kjon_4 liker deg ikke så godt, de boikotter deg med å ikke kjøpe kinobiletter til filmen din men det gikk supert for det. Filmen din solgte $antall_kino_seere biletter."); }
         if($antall_film_prod >= '40') { $kansje_bra_5 = array("4.0","4.1","4.2"); $antall_kino_seere = rand(1700000, 2100000); $tekst_3 = array("Beregningene tilsier at det ble solgt $antall_kino_seere kinobiletter i hele verden.","Du solgte rundt $antall_kino_seere kinobiletter i verden."); }
         if($antall_film_prod >= '41') { $kansje_bra_5 = array("4.1","4.2","4.3"); $antall_kino_seere = rand(1800000, 2200000); $tekst_3 = array("Du er snart en vellykket produsent for filmen din gikk bedere en forvente innen bilettsalget.","$brukernavn du gjorde en superduper bra jobb som produsent og filmskriver for det kom $antall_kino_seere mennesker på premiæren."); }
         if($antall_film_prod >= '42') { $kansje_bra_5 = array("4.2","4.3","4.4"); $antall_kino_seere = rand(1900000, 2500000); $tekst_3 = array("Produseringen av filmen var vellykket for statistikken viser at det faktisk var $antall_kino_seere personer som så filmen din på premiæren.","For å være presis så var det akuratt $antall_kino_seere personer som så filmen din på førpremiæren."); }
         if($antall_film_prod >= '43') { $kansje_bra_5 = array("4.3","4.4","4.5"); $antall_kino_seere = rand(2000000, 3000000); $tekst_3 = array("De $antall_kino_seere $sjekk_kjon_4 liker deg ikke så godt, de boikotter deg med å ikke kjøpe kinobiletter til filmen din men det gikk supert for det. Filmen din solgte $antall_kino_seere biletter."); }
         if($antall_film_prod >= '44') { $kansje_bra_5 = array("4.4","4.5","4.6"); $antall_kino_seere = rand(2500000, 3500000); $tekst_3 = array("Det kom faen meg $antall_kino_seere personer på premiæren, skit bra gjort ass $brukernavn.","Seerene likte at det var $sjekk_kjon_0 $sjekk_kjon_1 som sto bak produseringen av en så bra film, det kom faktisk $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '45') { $kansje_bra_5 = array("4.5","4.6","4.7"); $antall_kino_seere = rand(3000000, 4000000); $tekst_3 = array("Du solgte $antall_kino_seere billetter rundt omkring i verden.","Folk flest elsket at det var $sjekk_kjon_0 $sjekk_kjon_8 $sjekk_kjon_1 som produserte filmen, det kom $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '46') { $kansje_bra_5 = array("4.6","4.7","4.8"); $antall_kino_seere = rand(3500000, 4500000); $tekst_3 = array("Veldig bra utført $brukernavn, du solgte $antall_kino_seere kinobiletter."); }
         if($antall_film_prod >= '47') { $kansje_bra_5 = array("4.7","4.8","4.9"); $antall_kino_seere = rand(4000000, 5000000); $tekst_3 = array("De $sjekk_kjon_5 $sjekk_kjon_9 er totalt forelsket i deg, de syntes du gjør en bra jobb som produsent. Resultat av billetsalget ble bra, du solgte faktisk $antall_kino_seere kinobiletter.","Du solgte $antall_kino_seere billetter rundt omkring i verden."); }
         if($antall_film_prod >= '48') { $kansje_bra_5 = array("4.8","4.9","5.0"); $antall_kino_seere = rand(4500000, 5500000); $tekst_3 = array("Du solgte $antall_kino_seere billetter rundt omkring i verden.","Seerene likte at det var $sjekk_kjon_0 $sjekk_kjon_1 som sto bak produseringen av en så bra film, det kom faktisk $antall_kino_seere personer for å se filmen din på kino."); }
         if($antall_film_prod >= '49') { $kansje_bra_5 = array("4.9","5.0","5.1"); $antall_kino_seere = rand(5000000, 6000000); $tekst_3 = array("Det kom $antall_kino_seere personer rundt omkring i verden for å se filmen din på kino.","Du fikk et resultat på $antall_kino_seere kino seere, veldig bra.","Du er en $sjekk_kjon_10 for menneskerasen når det kommer til film produsering, filmen din solgte $antall_kino_seere kinobilleter rundt omkring på kloden.","Folk respekterer deg $brukernavn og de støtter deg med å komme på filmene dine, i denne filmen så var det $antall_kino_seere personer som var på førpremiæren.","Du har faen meg skills når det gjelder å få folk til å se filmen din for det kom $antall_kino_seere personer for å se filmen din på første dag filmen kom på kino.","Det kom faen meg $antall_kino_seere personer på premiæren, skit bra gjort ass $brukernavn."); }
         if($antall_film_prod >= '50') { $kansje_bra_5 = array("5.1","5.2","5.3"); $antall_kino_seere = rand(6000000, 7000000); $tekst_3 = array("Det kom $antall_kino_seere personer rundt omkring i verden for å se filmen din på kino.","Du fikk et resultat på $antall_kino_seere kino seere, veldig bra.","Du er en $sjekk_kjon_10 for menneskerasen når det kommer til film produsering, filmen din solgte $antall_kino_seere kinobilleter rundt omkring på kloden.","Folk respekterer deg $brukernavn og de støtter deg med å komme på filmene dine, i denne filmen så var det $antall_kino_seere personer som var på førpremiæren.","Du har faen meg skills når det gjelder å få folk til å se filmen din for det kom $antall_kino_seere personer for å se filmen din på første dag filmen kom på kino.","Det kom faen meg $antall_kino_seere personer på premiæren, skit bra gjort ass $brukernavn."); }
         if($antall_film_prod >= '51') { $kansje_bra_5 = array("5.3","5.4","5.5"); $antall_kino_seere = rand(7000000, 8000000); $tekst_3 = array("Det kom $antall_kino_seere personer rundt omkring i verden for å se filmen din på kino.","Du fikk et resultat på $antall_kino_seere kino seere, veldig bra.","Du er en $sjekk_kjon_10 for menneskerasen når det kommer til film produsering, filmen din solgte $antall_kino_seere kinobilleter rundt omkring på kloden.","Folk respekterer deg $brukernavn og de støtter deg med å komme på filmene dine, i denne filmen så var det $antall_kino_seere personer som var på førpremiæren.","Du har faen meg skills når det gjelder å få folk til å se filmen din for det kom $antall_kino_seere personer for å se filmen din på første dag filmen kom på kino.","Det kom faen meg $antall_kino_seere personer på premiæren, skit bra gjort ass $brukernavn."); }
         if($antall_film_prod >= '52') { $kansje_bra_5 = array("5.5","5.6","5.7"); $antall_kino_seere = rand(8000000, 9000000); $tekst_3 = array("Det kom $antall_kino_seere personer rundt omkring i verden for å se filmen din på kino.","Du fikk et resultat på $antall_kino_seere kino seere, veldig bra.","Du er en $sjekk_kjon_10 for menneskerasen når det kommer til film produsering, filmen din solgte $antall_kino_seere kinobilleter rundt omkring på kloden.","Folk respekterer deg $brukernavn og de støtter deg med å komme på filmene dine, i denne filmen så var det $antall_kino_seere personer som var på førpremiæren.","Du har faen meg skills når det gjelder å få folk til å se filmen din for det kom $antall_kino_seere personer for å se filmen din på første dag filmen kom på kino.","Det kom faen meg $antall_kino_seere personer på premiæren, skit bra gjort ass $brukernavn."); }
         if($antall_film_prod >= '53') { $kansje_bra_5 = array("5.7","5.8","5.9"); $antall_kino_seere = rand(9000000, 10000000); $tekst_3 = array("Det kom $antall_kino_seere personer rundt omkring i verden for å se filmen din på kino.","Du fikk et resultat på $antall_kino_seere kino seere, veldig bra.","Du er en $sjekk_kjon_10 for menneskerasen når det kommer til film produsering, filmen din solgte $antall_kino_seere kinobilleter rundt omkring på kloden.","Folk respekterer deg $brukernavn og de støtter deg med å komme på filmene dine, i denne filmen så var det $antall_kino_seere personer som var på førpremiæren.","Du har faen meg skills når det gjelder å få folk til å se filmen din for det kom $antall_kino_seere personer for å se filmen din på første dag filmen kom på kino.","Det kom faen meg $antall_kino_seere personer på premiæren, skit bra gjort ass $brukernavn."); }
         } 
         $kansje_bra_5 = $kansje_bra_5[array_rand($kansje_bra_5)]; 
         $tekst_3 = $tekst_3[array_rand($tekst_3)];
          
         $Slutt_prosent_blir = $prosent_1 + $kansje_bra_2 + $kansje_bra_3 + $kansje_bra_4 + $kansje_bra_5  + '3.5';

         if($Slutt_prosent_blir >= '0') { $ternigkast = rand(1, 2); } 
         if($Slutt_prosent_blir >= '5') { $ternigkast = rand(2, 3); } 
         if($Slutt_prosent_blir >= '10') { $ternigkast = rand(3, 4); } 
         if($Slutt_prosent_blir >= '15') { $ternigkast = rand(4, 5); } 
         if($Slutt_prosent_blir >= '17') { $ternigkast = rand(5, 6); } 
         
         if($kjoonn == 'Gutt') { $tekst_blir_kjon = 'ei kåt dame'; } else { $tekst_blir_kjon = 'en kåt mann'; }
         
         // Terningkast aftenposten
         if($ternigkast == '1') { $terningkast_tekst = array("Aftenposten ga deg det dårligste terningkastet i filmens historie, nemlig en ener.","Aftenposten vil helst ikke se flere filmer fra deg om du ikke forbedrer deg.","Aftenposten ga deg en simpel ener for at du gadd å prøve å sette sammen en film.","Aftenposten ga deg et terningkast på det usle tallet en.","Aftenposten anbefalte folk å ikke gå å se filmen din, værre kritikk har de ikke gitt til en film før.","Aftenposten hata filmen din de har aldri sett en så stygg film før.","Aftenposten skrev at filmen din var rotete, dårlig, merkelig, uforstålig.","Aftenposten syntes filmen din manglet en bra historie, de ga deg terningkast en.","Aftenposten ga filmen din det dårligste terningkastet."); $ternigkast_bilde = '1.gif'; }
         if($ternigkast == '2') { $terningkast_tekst = array("Aftenposten ga deg terningkast to.","Aftenposten sin film skribent likte deg og gå deg derfor en toer istedenfor en ener.","Aftenposten syntes filmen din var patetisk, men de likte en del av filmen å ga deg derfor en toer.","Aftenposten likte ikke filmen din men de ga deg en toer for å være snille.","Aftenposten ga filmen din terningkast to.","Aftenposten ønsker ikke å kommentere filmen din av en årsak den vår utrolig dårlig.","Aftenposten skrev at filmen din sugde, de likte den rett å slett ikke."); $ternigkast_bilde = '2.gif'; }
         if($ternigkast == '3') { $terningkast_tekst = array("Aftenposten likte historien til filmen din men de syntes filmingen var dårlig.","Aftenposten syntes filmen din manglet en viss glød.","Aftenposten kastet terningen og den landet på en treer.","Aftenposten ga deg terningkast tre.","Aftenposten skrev en fin tekst om filmen din men ga deg desverre terningkast tre.","Aftenposten sin film skribent var $tekst_blir_kjon som syntes du var hot og ga deg derfor terningkast tre.","Aftenposten ga filmen din en treer.","Aftenposten ga et terningkast på tre, de syntes ikke filmen din var noe serlig.","Aftenposten ga filmen din terningkast tre."); $ternigkast_bilde = '3.gif'; }
         if($ternigkast == '4') { $terningkast_tekst = array("Aftenposten ga filmen en firer, gratulerer.","Aftenposten ga deg gode tilbakemeldinger, du fikk en firer.","Aftenposten ga deg terningkast fire.","Aftenposten likte filmen din samt at de syntes skuspillerene gjorde en bra jobb.","Aftenposten syntes filmen din var okei og slengte terningen på en firer.","Aftenposten ser frem til å se fler filmer fra deg.","Aftenposten syntes filmen din var bra til å være norsk og kastet terningen på nr fire."); $ternigkast_bilde = '4.gif'; }
         if($ternigkast == '5') { $terningkast_tekst = array("Aftenposten elsket historien til filmen samt skuspillerenes innsats. Filmen fikk teringkast fem.","Aftenposten digga filmen din å håper på at du produserer flere filmer.","Aftenposten ga filmen din en velfortjent femmer.","Aftenposten ga deg en femmer.","Aftenposten likte filmen din og slengte derfor terningen på nummer fem.","Aftenposten syntes filmen din var en av de bedere filmene de har sett og ga deg en grei terning."); $ternigkast_bilde = '5.gif'; }
         if($ternigkast == '6') { $terningkast_tekst = array("Aftenposten gleder seg til å høre om dine nye filmer, de elsket filmen din og ga deg derfor terningkast seks.","Aftenposten ga deg beste terningkast.","Aftenposten digga filmen din, de ser frem til å høre om dine fremtidige filmer."); $ternigkast_bilde = '6.gif'; }
         $terningkast_tekst = $terningkast_tekst[array_rand($terningkast_tekst)]; 
         
         $kansje_bra_6 = array("0.1","0.2","0.3","0.35","0.37","0.4","0,43","0.25");
         $kansje_bra_6 = $kansje_bra_6[array_rand($kansje_bra_6)]; 
         $Slutt_prosent_blir_2 = $Slutt_prosent_blir + $kansje_bra_6;
          
         if ($rank_niva == "5" && $rankpros < "50") {   $film_prosent_s = '2.0'; $film_respekt_s = '200'; }
         if ($rank_niva == "5" && $rankpros >= "50") {  $film_prosent_s = '1.9'; $film_respekt_s = '190'; }
         if ($rank_niva == "6" && $rankpros < "50") {   $film_prosent_s = '1.8'; $film_respekt_s = '180'; }
         if ($rank_niva == "6" && $rankpros >= "50") {  $film_prosent_s = '1.7'; $film_respekt_s = '170'; }
         if ($rank_niva == "7" && $rankpros < "50") {   $film_prosent_s = '1.6'; $film_respekt_s = '160'; }
         if ($rank_niva == "7" && $rankpros >= "50") {  $film_prosent_s = '1.5'; $film_respekt_s = '150'; }
         if ($rank_niva == "8" && $rankpros < "50") {   $film_prosent_s = '1.4'; $film_respekt_s = '140'; }
         if ($rank_niva == "8" && $rankpros >= "50") {  $film_prosent_s = '1.3'; $film_respekt_s = '130'; }
         if ($rank_niva == "9" && $rankpros < "50") {   $film_prosent_s = '1.2'; $film_respekt_s = '120'; }
         if ($rank_niva == "9" && $rankpros >= "50") {  $film_prosent_s = '1.1'; $film_respekt_s = '110'; }
         if ($rank_niva == "10" && $rankpros < "50") {  $film_prosent_s = '1.0'; $film_respekt_s = '100'; }
         if ($rank_niva == "10" && $rankpros >= "50") { $film_prosent_s = '0.9'; $film_respekt_s = '90'; }
         if ($rank_niva == "11" && $rankpros < "50") {  $film_prosent_s = '0.8'; $film_respekt_s = '80'; }
         if ($rank_niva == "11" && $rankpros >= "50") { $film_prosent_s = '0.7'; $film_respekt_s = '70'; }
         if ($rank_niva == "12" && $rankpros < "50") {  $film_prosent_s = '0.6'; $film_respekt_s = '60'; }
         if ($rank_niva == "12" && $rankpros >= "50") { $film_prosent_s = '0.5'; $film_respekt_s = '50'; }
         if ($rank_niva == "13" && $rankpros < "50") {  $film_prosent_s = '0.4'; $film_respekt_s = '40'; }
         if ($rank_niva == "13" && $rankpros >= "50") { $film_prosent_s = '0.3'; $film_respekt_s = '30'; }
         if ($rank_niva == "14" && $rankpros < "50") {  $film_prosent_s = '0.2'; $film_respekt_s = '20'; }
         if ($rank_niva == "14" && $rankpros >= "50") { $film_prosent_s = '0.0'; $film_respekt_s = '10'; }
         
         $film_ny_mellomtid = $tiden + '43200';
         $Finn_prosent_summen = $film_pris_K2 / '100' * $Slutt_prosent_blir_2;
         $ny_sum_penger_blir = $penger + $Finn_prosent_summen;         
         $ny_sum_respekt_blir = $respekt + $film_respekt_s;
         $ny_sum_rankprosent_blir = $rankpros + $film_prosent_s;
         $ny_film_antall = $antall_film_prod + '1';

       
         mysql_query("UPDATE brukere SET penger='$ny_sum_penger_blir',respekt='$ny_sum_respekt_blir',film_tid='$film_ny_mellomtid',antall_film_prod='$ny_film_antall',rankpros='$ny_sum_rankprosent_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'") or die(mysql_error());
         mysql_query("DELETE FROM filmer_produser  WHERE ditt_brukernavn='$brukernavn'") or die(mysql_error());
         
        echo '
        <div class="Div_MELDING">
        <span class="Span_str_0">Informasjon</span><br>
        <span class="Span_str_11"><img style="float: right; clear: right;" border="0" src="../Design/'.$ternigkast_bilde.'" width="100" height="100">
        '.$terningkast_tekst.'<br><br>
        '.$tekst_1.'<br><br>
        '.$tekst_2.'<br><br>
        '.$tekst_3.'<br><br>
        Du solgte '.number_format($antall_solgte_dvd, 0, ",", ".").' dvder av en produksjon på '.$markeds_K2.'.<br><br>
        Filmen din gikk i overskudd med '.number_format($Finn_prosent_summen, 0, ",", ".").' kroner.
        </span><br><br>
        <span class="Span_str_8">&nbsp;</span>
        </div>';
       
        }} else {
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("DELETE FROM filmer_produser WHERE ditt_brukernavn='$brukernavn'") or die(mysql_error());
        header("Location: game.php?side=FilmProdusering");
        }} else { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Dette valget er ugyldig.</span>';
        echo '</div>';
        }}
    
        ?>
        
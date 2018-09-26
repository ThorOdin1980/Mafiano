        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        $XxLee = $XxLee + '1';
        $ny_utbryt_skit = $bryt_ut_antall + '1';
        $ventetid_feng_blir = $tiden + '60';
        if($XxLee <= '9') { $XxLee = "0".$XxLee; }
        if($bryt_ut_antall >= '0')  { $RandT = rand(1, 10); }
        if($bryt_ut_antall >= '10') { $RandT = rand(1, 9);  }
        if($bryt_ut_antall >= '20') { $RandT = rand(1, 8);  }
        if($bryt_ut_antall >= '30') { $RandT = rand(1, 7);  }
        if($bryt_ut_antall >= '40') { $RandT = rand(1, 6);  }
        if($bryt_ut_antall >= '50') { $RandT = rand(1, 5);  }
        if($XxLee >= '32') { $RandT = '3'; }
      
        if($XxLee >= '27') { 
        if($RandT == '3' || $XxLee == '32') { 
        if($XxTony >= '25' && $XxAbdulhai >= '15') { 
        $NySumSpenn = floor($bank + '2500000');
        $NyttOppdrag = $oppdrag_nr + '1';
        $NyRanprosent = $rankpros + '0.4';
        $NyRespekt = $respekt + '2900';
        $NyBombechips = $bombechips + '500';
        mysql_query("UPDATE brukere SET bank='$NySumSpenn',oppdrag_nr='$NyttOppdrag',OppdragUtfort='',rankpros='$NyRanprosent',respekt='$NyRespekt',bombechips='$NyBombechips',bryt_ut_antall='$ny_utbryt_skit',vente_tid_bryt_ut='$ventetid_feng_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Oppdrag','Du har fullført oppdraget for young guns, du har mottatt 2.500.000 kroner på bank-konten din, 500 bombechips og 2900 respekt.','Ja')");
        echo PrintTeksten("Du brøt ut Lee Jang, du har brutt ut alle tre nå.",'1',"Vellykket");
        } else { 
        mysql_query("UPDATE brukere SET OppdragUtfort='Tony Casanabo $XxTony Abdulhai Shankman $XxAbdulhai Lee Jang 33',bryt_ut_antall='$ny_utbryt_skit',vente_tid_bryt_ut='$ventetid_feng_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        echo PrintTeksten("Du brøt ut Lee Jang.",'1',"Vellykket");
        }} else { 
        mysql_query("UPDATE brukere SET OppdragUtfort='Tony Casanabo $XxTony Abdulhai Shankman $XxAbdulhai Lee Jang $XxLee',bryt_ut_antall='$ny_utbryt_skit',vente_tid_bryt_ut='$ventetid_feng_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        echo PrintTeksten("Du feilet i forsøket på å bryte ut Lee Jang.",'1',"Feilet");
        }} else { 
        mysql_query("UPDATE brukere SET OppdragUtfort='Tony Casanabo $XxTony Abdulhai Shankman $XxAbdulhai Lee Jang $XxLee',bryt_ut_antall='$ny_utbryt_skit',vente_tid_bryt_ut='$ventetid_feng_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        echo PrintTeksten("Du feilet i forsøket på å bryte ut Lee Jang.",'1',"Feilet");
        }}
        ?>
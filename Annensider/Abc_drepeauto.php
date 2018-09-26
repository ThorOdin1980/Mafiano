        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
                
        // Start gi hitlist penger og poeng
      
        $HitlistPenger = '0';
        $HitlistPoeng = '0';
        $Hitlist = mysql_query("SELECT * FROM hitlist WHERE hitlist_offer='$Offer' AND timestampen_over > '$tiden'");

        if (mysql_num_rows($Hitlist) >= '1') { 

        while($HitlistInfo = mysql_fetch_assoc($Hitlist)) { 

        if($HitlistInfo['betalings_typen'] == 'Penger') {
                $HitlistPenger = floor($HitlistInfo['hitlist_dusor'] + $HitlistPenger);
        } else {
                $HitlistPoeng = floor($HitlistInfo['hitlist_dusor'] + $HitlistPoeng);
        }
        $HitlistID = $HitlistInfo['id'];
        mysql_query("DELETE FROM hitlist WHERE id='$HitlistID'");
        }
        $PengerFaa = number_format($HitlistPenger, 0, ",", ".");
        $PoengFaa = number_format($HitlistPoeng, 0, ",", ".");
        if($HitlistPenger >= '1') {
                $NySumSpenn = $bank + $HitlistPenger;
                $MeldingSpenn = "Du klarte å drepe $Offer og du har nå fått $PengerFaa kroner plassert i din bank.";
        } else {
                $NySumSpenn = $bank;
                $MeldingSpenn = "Det var desverre ingen som har hitlistet $Offer for penger ellers har hitlist lappen blitt sletta fordi den har gått over tidslengden eller kjøpt vekk fra lista."; 
        }

        if($HitlistPenger >= '1') {
                $NySumPoeng = $turns + $HitlistPoeng;
                $MeldingPoeng = "Du klarte å drepe $Offer og du har nå fått $PoengFaa poeng.";
        } else {
                $NySumPoeng = $turns;
                $MeldingPoeng = "Det var desverre ingen som har hitlistet $Offer for poeng ellers har hitlist lappen blitt sletta fordi den har gått over tidslengden eller kjøpt vekk fra lista.";
        }


        mysql_query("UPDATE brukere SET bank='$NySumSpenn',turns='$NySumPoeng' WHERE brukernavn='$brukernavn'");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Hitlist dusør','$MeldingSpenn $MeldingPoeng','Ja')");
        }
        // Lukker gi hitlist penger og poeng

        // Start slett kulefabrikk vist offeret har en
      
        $KfSjekk = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Eier='$Offer'");
        if (mysql_num_rows($KfSjekk) >= '1') { mysql_query("DELETE FROM Kulefabrikker WHERE KF_Eier='".$Offer."'"); }
        // Lukker slett kulefabrikk vist offeret har en

      
        $Sjekk_Butikk = mysql_query("SELECT * FROM Butikker WHERE Butikk_eier='$Offer'");
        if(mysql_num_rows($Sjekk_Butikk) >= '1') { 
        mysql_query("DELETE FROM Butikker WHERE Butikk_eier='$Offer'");
        }
        // Lukker slett butikker vist offeret har noen

        }
        ?>


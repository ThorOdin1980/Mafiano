    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?
    if(!isset($_POST['du_valgte'])) { $_POST['du_valgte'] = FALSE; }

    $KjopVopen = ""; $KjopBesk = ""; $KjopFly = ""; $KjopBat = ""; $KjopEiendom = ""; $KjopKuler = ""; $Auksjon = "";
    
    // Hent kulefabrikk
  
    $Kf = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Sted='$land'");
    $KF_I = mysql_fetch_assoc($Kf);

    
    if($_POST['du_valgte'] == 'Vopen') {  $Hent = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Våpen'");
    if(mysql_num_rows($Hent) == '1') { $Info = mysql_fetch_assoc($Hent); $box = $_POST['box1']; $box_count = count($box);
    if($box_count == '0') { $KjopVopen = PrintTeksten('Du må velge et våpen.','2','Feilet','2'); } else { 
    if($box_count > '1') { $KjopVopen = PrintTeksten('Du kan kun handle et våpen om gangen.','2','Feilet','2'); } else { $Handle = Mysql_Klar($box['0']);  $Sjekk = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND utstyr LIKE '$Handle'");
    if(mysql_num_rows($Sjekk) >= '1') { $KjopVopen = PrintTeksten('Du har dette våpenet.','2','Feilet','2'); } else { $V = explode('<br>', $Info['Butikk_varer']); $V_1 = explode(',', $V['0']); $V_2 = explode(',', $V['1']); $V_3 = explode(',', $V['2']); $V_4 = explode(',', $V['3']); $V_5 = explode(',', $V['4']); $V_6 = explode(',', $V['5']); $V_7 = explode(',', $V['6']); $V_8 = explode(',', $V['7']); $V_9 = explode(',', $V['8']); $A_1 = Bare_Siffer($V_1['0']); $A_2 = Bare_Siffer($V_2['0']); $A_3 = Bare_Siffer($V_3['0']); $A_4 = Bare_Siffer($V_4['0']); $A_5 = Bare_Siffer($V_5['0']); $A_6 = Bare_Siffer($V_6['0']); $A_7 = Bare_Siffer($V_7['0']); $A_8 = Bare_Siffer($V_8['0']); $A_9 = Bare_Siffer($V_9['0']);
    if($Handle == 'Hammer') { $Pris = Bare_Siffer($V_1['1']); $Antall = Bare_Siffer($V_1['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $NyX,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; } 
    elseif($Handle == 'Balltre') { $Pris = Bare_Siffer($V_2['1']); $Antall = Bare_Siffer($V_2['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $NyX,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; }
    elseif($Handle == 'Knokejern') { $Pris = Bare_Siffer($V_3['1']); $Antall = Bare_Siffer($V_3['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $NyX,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; }
    elseif($Handle == 'Kniv') { $Pris = Bare_Siffer($V_4['1']); $Antall = Bare_Siffer($V_4['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $NyX,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; }
    elseif($Handle == 'Glock 17') { $Pris = Bare_Siffer($V_5['1']); $Antall = Bare_Siffer($V_5['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $NyX,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; }
    elseif($Handle == 'Desert Eagle') { $Pris = Bare_Siffer($V_6['1']); $Antall = Bare_Siffer($V_6['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $NyX,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; }
    elseif($Handle == 'Uzi smg') { $Pris = Bare_Siffer($V_7['1']); $Antall = Bare_Siffer($V_7['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $NyX,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; }
    elseif($Handle == 'Ak-47') { $Pris = Bare_Siffer($V_8['1']); $Antall = Bare_Siffer($V_8['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $NyX,".$V_8['1']."<br>Steyr: $A_9,".$V_9['1']."<br>"; }
    elseif($Handle == 'Steyr aug a1') { $Pris = Bare_Siffer($V_9['1']); $Antall = Bare_Siffer($V_9['0']); $NyX = $Antall - '1'; $NyVar = "Hammer: $A_1,".$V_1['1']."<br>Balltre: $A_2,".$V_2['1']."<br>Knokejern: $A_3,".$V_3['1']."<br>Kniv: $A_4,".$V_4['1']."<br>Glock: $A_5,".$V_5['1']."<br>Desert Eagle: $A_6,".$V_6['1']."<br>Uzi smg: $A_7,".$V_7['1']."<br>Ak: $A_8,".$V_8['1']."<br>Steyr: $NyX,".$V_9['1']."<br>"; }
    if($Antall == '0') { $KjopVopen = PrintTeksten("Butikken har ikke $Handle på lager.",'2','Feilet','2'); } else { 
    if($Pris > $penger) { $KjopVopen = PrintTeksten("Du har ikke råd.",'2','Feilet','2'); } else { $NyPenger = floor($penger - $Pris); $NyKonto = floor($Info['Butikk_Konto'] + $Pris); $NyInntekt = floor($Info['Butikk_inntekt'] + $Pris); $NyttSalg = $Info['Butikk_salg'] + '1'; $Koster = VerdiSum($Pris,'kr');  mysql_query("UPDATE Butikker SET Butikk_Konto='$NyKonto',Butikk_varer='$NyVar',Butikk_inntekt='$NyInntekt',Butikk_salg='$NyttSalg' WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Våpen'");  mysql_query("UPDATE brukere SET penger='$NyPenger',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); mysql_query("INSERT INTO vapen_beskyttelse (brukernavn,utstyr,type,timestampen,dato_kjopt) VALUES ('$brukernavn','$Handle','1','$tiden','$tid $nbsp $dato')"); 
    $KjopVopen = PrintTeksten("Du har kjøpt $Handle for $Koster.",'2','Vellykket','2');
    }}}}}}}
    elseif($_POST['du_valgte'] == 'Besk') { $box = $_POST['box2']; $box_count = count($box);  $Hent = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Beskyttelse'");
    if(mysql_num_rows($Hent) == '1') { $Info = mysql_fetch_assoc($Hent);
    if($box_count == '0') { $KjopBesk = PrintTeksten('Du må velge beskyttelse.','2','Feilet','2'); } else { 
    if($box_count > '1') { $KjopBesk = PrintTeksten('Du kan kun handle en beskyttelse om gangen.','2','Feilet','2'); } else { $Handle = Mysql_Klar($box['0']);  $Sjekk = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND utstyr LIKE '$Handle'");
    if(mysql_num_rows($Sjekk) >= '1') { $KjopBesk = PrintTeksten('Du har beskyttelsen fra før av.','2','Feilet','2'); } else { $V = explode('<br>', $Info['Butikk_varer']); $V_1 = explode(',', $V['0']); $V_2 = explode(',', $V['1']); $V_3 = explode(',', $V['2']); $V_4 = explode(',', $V['3']); $V_5 = explode(',', $V['4']); $A_1 = Bare_Siffer($V_1['0']); $A_2 = Bare_Siffer($V_2['0']); $A_3 = Bare_Siffer($V_3['0']); $A_4 = Bare_Siffer($V_4['0']); $A_5 = Bare_Siffer($V_5['0']);
    if($Handle == 'Finnlandshette') { $Pris = Bare_Siffer($V_1['1']); $Antall = Bare_Siffer($V_1['0']); $NyX = $Antall - '1'; $NyVar = "Hette: $NyX,".$V_1['1']."<br>Hund: $A_2,".$V_2['1']."<br>Vest: $A_3,".$V_3['1']."<br>Livvakt: $A_4,".$V_4['1']."<br>Bil: $A_5,".$V_5['1']."<br>"; } 
    elseif($Handle == 'Hund') { $Pris = Bare_Siffer($V_2['1']); $Antall = Bare_Siffer($V_2['0']); $NyX = $Antall - '1'; $NyVar = "Hette: $A_1,".$V_1['1']."<br>Hund: $NyX,".$V_2['1']."<br>Vest: $A_3,".$V_3['1']."<br>Livvakt: $A_4,".$V_4['1']."<br>Bil: $A_5,".$V_5['1']."<br>"; }
    elseif($Handle == 'Skuddsikker vest') { $Pris = Bare_Siffer($V_3['1']); $Antall = Bare_Siffer($V_3['0']); $NyX = $Antall - '1'; $NyVar = "Hette: $A_1,".$V_1['1']."<br>Hund: $A_2,".$V_2['1']."<br>Vest: $NyX,".$V_3['1']."<br>Livvakt: $A_4,".$V_4['1']."<br>Bil: $A_5,".$V_5['1']."<br>"; }
    elseif($Handle == 'Livvakt') { $Pris = Bare_Siffer($V_4['1']); $Antall = Bare_Siffer($V_4['0']); $NyX = $Antall - '1'; $NyVar = "Hette: $A_1,".$V_1['1']."<br>Hund: $A_2,".$V_2['1']."<br>Vest: $A_3,".$V_3['1']."<br>Livvakt: $NyX,".$V_4['1']."<br>Bil: $A_5,".$V_5['1']."<br>"; }
    elseif($Handle == 'Skuddsikker bil') { $Pris = Bare_Siffer($V_5['1']); $Antall = Bare_Siffer($V_5['0']); $NyX = $Antall - '1'; $NyVar = "Hette: $A_1,".$V_1['1']."<br>Hund: $A_2,".$V_2['1']."<br>Vest: $A_3,".$V_3['1']."<br>Livvakt: $A_4,".$V_4['1']."<br>Bil: $NyX,".$V_5['1']."<br>"; }
    if($Antall == '0') { $KjopBesk = PrintTeksten("Butikken har ikke $Handle på lager.",'2','Feilet','2'); } else { 
    if($Pris > $penger) { $KjopBesk = PrintTeksten("Du har ikke råd.",'2','Feilet','2'); } else { $NyPenger = floor($penger - $Pris); $NyKonto = floor($Info['Butikk_Konto'] + $Pris); $NyInntekt = floor($Info['Butikk_inntekt'] + $Pris); $NyttSalg = $Info['Butikk_salg'] + '1'; $Koster = VerdiSum($Pris,'kr');  mysql_query("UPDATE Butikker SET Butikk_Konto='$NyKonto',Butikk_varer='$NyVar',Butikk_inntekt='$NyInntekt',Butikk_salg='$NyttSalg' WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Beskyttelse'");  mysql_query("UPDATE brukere SET penger='$NyPenger',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); mysql_query("INSERT INTO vapen_beskyttelse (brukernavn,utstyr,type,timestampen,dato_kjopt) VALUES ('$brukernavn','$Handle','2','$tiden','$tid $nbsp $dato')"); 
    $KjopBesk = PrintTeksten("Du har kjøpt $Handle for $Koster.",'2','Vellykket','2');
    }}}}}}}
    elseif($_POST['du_valgte'] == 'Fly') { $box = $_POST['box3']; $box_count = count($box);  $Hent = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Fly'");
    if(mysql_num_rows($Hent) == '1') { $Info = mysql_fetch_assoc($Hent);
    if($box_count == '0') { $KjopFly = PrintTeksten('Du må velge et fly.','2','Feilet','2'); } else { 
    if($box_count > '1') { $KjopFly = PrintTeksten('Du kan kun handle et fly om gangen.','2','Feilet','2'); } else { $Handle = Mysql_Klar($box['0']);  $Sjekk = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '1' AND Frakt_navn='$Handle'");
    if(mysql_num_rows($Sjekk) >= '1') { $KjopFly = PrintTeksten('Du har flyet fra før av.','2','Feilet','2'); } else { $V = explode('<br>', $Info['Butikk_varer']); $V_1 = explode(',', $V['0']); $V_2 = explode(',', $V['1']); $V_3 = explode(',', $V['2']); $V_4 = explode(',', $V['3']); $V_5 = explode(',', $V['4']); $A_1 = Bare_Siffer($V_1['0']); $A_2 = Bare_Siffer($V_2['0']); $A_3 = Bare_Siffer($V_3['0']); $A_4 = Bare_Siffer($V_4['0']); $A_5 = Bare_Siffer($V_5['0']);
    if($Handle == 'Aerostar 601P') { $Pris = Bare_Siffer($V_1['1']); $Antall = Bare_Siffer($V_1['0']); $NyX = $Antall - '1'; $frakt_kap = '90'; $NyVar = "Aerostar: $NyX,".$V_1['1']."<br>Mitsubishi: $A_2,".$V_2['1']."<br>Cessna Skyhawk: $A_3,".$V_3['1']."<br>Cessna: $A_4,".$V_4['1']."<br>Citation V Ultra: $A_5,".$V_5['1']."<br>"; } 
    elseif($Handle == 'Mitsubishi MU-2K') { $Pris = Bare_Siffer($V_2['1']); $Antall = Bare_Siffer($V_2['0']); $NyX = $Antall - '1'; $frakt_kap = '150'; $NyVar = "Aerostar: $A_1,".$V_1['1']."<br>Mitsubishi: $NyX,".$V_2['1']."<br>Cessna Skyhawk: $A_3,".$V_3['1']."<br>Cessna: $A_4,".$V_4['1']."<br>Citation V Ultra: $A_5,".$V_5['1']."<br>"; }
    elseif($Handle == 'Cessna Skyhawk') { $Pris = Bare_Siffer($V_3['1']); $Antall = Bare_Siffer($V_3['0']); $NyX = $Antall - '1'; $frakt_kap = '210'; $NyVar = "Aerostar: $A_1,".$V_1['1']."<br>Mitsubishi: $A_2,".$V_2['1']."<br>Cessna Skyhawk: $NyX,".$V_3['1']."<br>Cessna: $A_4,".$V_4['1']."<br>Citation V Ultra: $A_5,".$V_5['1']."<br>"; }
    elseif($Handle == 'Cessna 208') { $Pris = Bare_Siffer($V_4['1']); $Antall = Bare_Siffer($V_4['0']); $NyX = $Antall - '1'; $frakt_kap = '280'; $NyVar = "Aerostar: $A_1,".$V_1['1']."<br>Mitsubishi: $A_2,".$V_2['1']."<br>Cessna Skyhawk: $A_3,".$V_3['1']."<br>Cessna: $NyX,".$V_4['1']."<br>Citation V Ultra: $A_5,".$V_5['1']."<br>"; }
    elseif($Handle == 'Citation V Ultra') { $Pris = Bare_Siffer($V_5['1']); $Antall = Bare_Siffer($V_5['0']); $NyX = $Antall - '1'; $frakt_kap = '350'; $NyVar = "Aerostar: $A_1,".$V_1['1']."<br>Mitsubishi: $A_2,".$V_2['1']."<br>Cessna Skyhawk: $A_3,".$V_3['1']."<br>Cessna: $A_4,".$V_4['1']."<br>Citation V Ultra: $NyX,".$V_5['1']."<br>"; }
    if($Antall == '0') { $KjopFly = PrintTeksten("Butikken har ikke $Handle på lager.",'2','Feilet','2'); } else { 
    if($Pris > $penger) { $KjopFly = PrintTeksten("Du har ikke råd.",'2','Feilet','2'); } else { $NyPenger = floor($penger - $Pris); $NyKonto = floor($Info['Butikk_Konto'] + $Pris); $NyInntekt = floor($Info['Butikk_inntekt'] + $Pris); $NyttSalg = $Info['Butikk_salg'] + '1'; $Koster = VerdiSum($Pris,'kr');  mysql_query("UPDATE Butikker SET Butikk_Konto='$NyKonto',Butikk_varer='$NyVar',Butikk_inntekt='$NyInntekt',Butikk_salg='$NyttSalg' WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Fly'");  mysql_query("UPDATE brukere SET penger='$NyPenger',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); mysql_query("INSERT INTO fly_osv (Frakt_sted,Frakt_er,Frakt_navn,Frakt_eier,Frakt_timestamp,Frakt_dato,Frakt_kapasistet) VALUES ('$land','1','$Handle','$brukernavn','$tiden','$tid $nbsp $dato','$frakt_kap')"); 
    $KjopFly = PrintTeksten("Du har kjøpt $Handle for $Koster.",'2','Vellykket','2');
    }}}}}}}
    elseif($_POST['du_valgte'] == 'Bat') { $box = $_POST['box4']; $box_count = count($box);  $Hent = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Båter'");
    if(mysql_num_rows($Hent) == '1') { $Info = mysql_fetch_assoc($Hent);
    if($box_count == '0') { $KjopBat = PrintTeksten('Du må velge en båt.','2','Feilet','2'); } else { 
    if($box_count > '1') { $KjopBat = PrintTeksten('Du kan kun handle en båt om gangen.','2','Feilet','2'); } else { $Handle = Mysql_Klar($box['0']);  $Sjekk = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '2' AND Frakt_navn='$Handle'");
    if(mysql_num_rows($Sjekk) >= '1') { $KjopBat = PrintTeksten('Du har båten fra før av.','2','Feilet','2'); } else { $V = explode('<br>', $Info['Butikk_varer']); $V_1 = explode(',', $V['0']); $V_2 = explode(',', $V['1']); $V_3 = explode(',', $V['2']); $V_4 = explode(',', $V['3']); $V_5 = explode(',', $V['4']); $V_6 = explode(',', $V['5']); $A_1 = Bare_Siffer($V_1['0']); $A_2 = Bare_Siffer($V_2['0']); $A_3 = Bare_Siffer($V_3['0']); $A_4 = Bare_Siffer($V_4['0']); $A_5 = Bare_Siffer($V_5['0']); $A_6 = Bare_Siffer($V_6['0']);
    if($Handle == 'Triton 225') { $Pris = Bare_Siffer($V_1['1']); $Antall = Bare_Siffer($V_1['0']); $NyX = $Antall - '1'; $NyVar = "Triton: $NyX,".$V_1['1']."<br>Mariah: $A_2,".$V_2['1']."<br>Sea Ray: $A_3,".$V_3['1']."<br>FORBINA: $A_4,".$V_4['1']."<br>Mediterranèe: $A_5,".$V_5['1']."<br>Meridian: $A_6,".$V_6['1']."<br>"; } 
    elseif($Handle == 'Mariah SC25') {  $Pris = Bare_Siffer($V_2['1']); $Antall = Bare_Siffer($V_2['0']); $NyX = $Antall - '1'; $NyVar = "Triton: $A_1,".$V_1['1']."<br>Mariah: $NyX,".$V_2['1']."<br>Sea Ray: $A_3,".$V_3['1']."<br>FORBINA: $A_4,".$V_4['1']."<br>Mediterranèe: $A_5,".$V_5['1']."<br>Meridian: $A_6,".$V_6['1']."<br>"; }
    elseif($Handle == 'Sea Ray 275') { $Pris = Bare_Siffer($V_3['1']); $Antall = Bare_Siffer($V_3['0']); $NyX = $Antall - '1'; $NyVar = "Triton: $A_1,".$V_1['1']."<br>Mariah: $A_2,".$V_2['1']."<br>Sea Ray: $NyX,".$V_3['1']."<br>FORBINA: $A_4,".$V_4['1']."<br>Mediterranèe: $A_5,".$V_5['1']."<br>Meridian: $A_6,".$V_6['1']."<br>"; }
    elseif($Handle == 'FORBINA 36') { $Pris = Bare_Siffer($V_4['1']); $Antall = Bare_Siffer($V_4['0']); $NyX = $Antall - '1'; $NyVar = "Triton: $A_1,".$V_1['1']."<br>Mariah: $A_2,".$V_2['1']."<br>Sea Ray: $A_3,".$V_3['1']."<br>FORBINA: $NyX,".$V_4['1']."<br>Mediterranèe: $A_5,".$V_5['1']."<br>Meridian: $A_6,".$V_6['1']."<br>"; }
    elseif($Handle == 'Mediterranèe 43') { $Pris = Bare_Siffer($V_5['1']); $Antall = Bare_Siffer($V_5['0']); $NyX = $Antall - '1'; $NyVar = "Triton: $A_1,".$V_1['1']."<br>Mariah: $A_2,".$V_2['1']."<br>Sea Ray: $A_3,".$V_3['1']."<br>FORBINA: $A_4,".$V_4['1']."<br>Mediterranèe: $NyX,".$V_5['1']."<br>Meridian: $A_6,".$V_6['1']."<br>"; }
    elseif($Handle == 'Meridian 459') { $Pris = Bare_Siffer($V_6['1']); $Antall = Bare_Siffer($V_6['0']); $NyX = $Antall - '1'; $NyVar = "Triton: $A_1,".$V_1['1']."<br>Mariah: $A_2,".$V_2['1']."<br>Sea Ray: $A_3,".$V_3['1']."<br>FORBINA: $A_4,".$V_4['1']."<br>Mediterranèe: $A_5,".$V_5['1']."<br>Meridian: $NyX,".$V_6['1']."<br>"; }
    if($Antall == '0') { $KjopBat = PrintTeksten("Butikken har ikke $Handle på lager.",'2','Feilet','2'); } else { 
    if($Pris > $penger) { $KjopBat = PrintTeksten("Du har ikke råd.",'2','Feilet','2'); } else { $NyPenger = floor($penger - $Pris); $NyKonto = floor($Info['Butikk_Konto'] + $Pris); $NyInntekt = floor($Info['Butikk_inntekt'] + $Pris); $NyttSalg = $Info['Butikk_salg'] + '1'; $Koster = VerdiSum($Pris,'kr');  mysql_query("UPDATE Butikker SET Butikk_Konto='$NyKonto',Butikk_varer='$NyVar',Butikk_inntekt='$NyInntekt',Butikk_salg='$NyttSalg' WHERE Butikk_Land LIKE '$land' AND Butikk_Type LIKE 'Båter'");  mysql_query("UPDATE brukere SET penger='$NyPenger',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); mysql_query("INSERT INTO fly_osv (Frakt_sted,Frakt_er,Frakt_navn,Frakt_eier,Frakt_timestamp,Frakt_dato,Frakt_kapasistet) VALUES ('$land','2','$Handle','$brukernavn','$tiden','$tid $nbsp $dato','0')"); 
    $KjopBat = PrintTeksten("Du har kjøpt $Handle for $Koster.",'2','Vellykket','2');
    }}}}}}}
    elseif($_POST['du_valgte'] == 'Eiendom') { 
    $box = $_POST['box5']; $box_count = count($box);
    if($box_count == '0') { $KjopEiendom = PrintTeksten('Du må velge eiendom.','2','Feilet','2'); } else { 
    if($box_count > '1') { $KjopEiendom = PrintTeksten('Du kan kun handle en eiendom om gangen.','2','Feilet','2'); } else { 
    $Handle = Mysql_Klar($box['0']);
   
    $Hent = mysql_query("SELECT * FROM Eiendom WHERE Eier='$brukernavn' AND Eiendom LIKE '$Handle'");
    if(mysql_num_rows($Hent) >= '1') { $KjopEiendom = PrintTeksten("Du eier $Handle fra før av.",'2','Feilet','2'); } else {
    
    if($Handle == 'Hybel') { $Pris = '1000000'; $Plass = "0/2"; $Res = "0"; } 
    elseif($Handle == 'Enebolig') { $Pris = '2000000'; $Plass = "0/4"; $Res = "0"; }
    elseif($Handle == 'Luksus bolig') { $Pris = '5000000'; $Plass = "0/5"; $Res = "0"; }
    elseif($Handle == 'Villa') { $Pris = '8000000'; $Plass = "0/7"; $Res = "0"; }
    elseif($Handle == 'Luksus villa') { $Pris = '12000000'; $Plass = "0/9"; $Res = "3000"; }
    elseif($Handle == 'Odden slott') { $Pris = '30000000'; $Plass = "0/15"; $Res = "5000"; }
    elseif($Handle == 'Kråg slott') { $Pris = '50000000'; $Plass = "0/20";   $Res = "10000"; }
    elseif($Handle == 'Hotel rådli') { $Pris = '100000000'; $Plass = "0/35"; $Res = "20000"; }
    elseif($Handle == 'Plaza hotel') { $Pris = '300000000'; $Plass = "0/45"; $Res = "40000"; }
    elseif($Handle == 'Brud borg') { $Pris = '500000000'; $Plass = "0/95";   $Res = "60000"; }    
    if($Pris > $penger) { $KjopEiendom = PrintTeksten("Du har ikke råd.",'2','Feilet','2'); } else {
    if($Res > $respekt) { $KjopEiendom = PrintTeksten("Du har ikke høy nok respekt for å eie $Handle.",'2','Feilet','2'); } else {
    $NySumSpenn = floor($penger - $Pris);
  
    mysql_query("UPDATE brukere SET penger='$NySumSpenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
    mysql_query("INSERT INTO Eiendom (Eier,Eiendom,Plass,DatoKjopt,StampKjopt,Land) VALUES ('$brukernavn','$Handle','$Plass','$FullDato','$Timestamp','$land')") or die(mysql_error());
    $KjopEiendom = PrintTeksten("Du har kjøpt $Handle for ".VerdiSum($Pris,'kr').".",'2','Vellykket','2');
    }}}}}}elseif($_POST['du_valgte'] == 'Kuler') { 
    if(mysql_num_rows($Kf) >= '1') {
    $KulerKjop = Bare_Siffer(Mysql_Klar($_POST['sumkuler']));
    if(empty($KulerKjop)) { $KjopKuler = PrintTeksten('Du må skrive inn antall kuler du skal handle.','2','Feilet','2'); } 
    elseif($KF_I['KF_Kuler'] == '0') { $KjopKuler = PrintTeksten('Fabrikken er tom for kuler.','2','Feilet','2'); }
    elseif($KulerKjop > $KF_I['KF_Kuler']) { $KjopKuler = PrintTeksten('Fabrikken har ikke så mange kuler på lageret.','2','Feilet','2'); } else {

    $Pris = floor($KulerKjop * $KF_I['KF_SlagsPris']);
    $NyKonto = floor($Pris + $KF_I['KF_Konto']);
    $NyTjent = $KF_I['KF_Tjent_Totalt'] + $Pris;
    $NySalg = $KF_I['KF_AntallSalg'] + '1';
    $NySolgt = $KulerKjop + $KF_I['KF_KulerSolgt'];
    $NyKuler = $KF_I['KF_Kuler'] - $KulerKjop;
    $DineKuler = floor($kuler + $KulerKjop);
    $DinePenger = floor($penger - $Pris);
    $Kf_ID = $KF_I['id'];
    if($KF_I['KF_StorHandel'] == 'Ingen') { $Storst = $KulerKjop; } else { if($KulerKjop > $KF_I['KF_StorHandel']) { $Storst = $KulerKjop; } else { $Storst = $KF_I['KF_StorHandel']; }}
    if($Pris > $penger) { $KjopKuler = PrintTeksten('Du har ikke råd.','2','Feilet','2'); }
    elseif($DineKuler >= '10000000' ) { $KjopKuler = PrintTeksten('Du kan ikke bære mer en 10.000.000 kuler på en gang.','2','Feilet','2'); } else {
  
    mysql_query("UPDATE brukere SET kuler='$DineKuler',penger='$DinePenger',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
  
    mysql_query("UPDATE Kulefabrikker SET KF_Kuler='$NyKuler',KF_KulerSolgt='$NySolgt',KF_StorHandel='$Storst',KF_AntallSalg='$NySalg',KF_Konto='$NyKonto',KF_Tjent_Totalt='$NyTjent' WHERE id='$Kf_ID'"); 
    $KjopKuler = PrintTeksten("Du har kjøpt ".VerdiSum($KulerKjop,'kuler')." for ".VerdiSum($Pris,'kr').".",'2','Vellykket','2');


    }}}}
   
   /* elseif($_POST['du_valgte'] == 'Auksjon') { 
    $Auksjon = PrintTeksten('Du kan snart delta i auksjoner.','2','Feilet','2');
    } */
    
    echo "<div class=\"Div_masta\"><form method=\"post\" id=\"Butikken\"><input type=\"hidden\" name=\"du_valgte\" id=\"du_valgte\" value=\"\"/>";
    
  
    $Butikker = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land' ORDER BY `Butikk_Type`");
    while($I = mysql_fetch_assoc($Butikker)) { 
    
    $Butikken = strtoupper($I['Butikk_Type']);
    $Varer = explode('<br>', $I['Butikk_varer']);

    $Bilde = Mysql_Klar($I['Bilde']);

    echo "<table class=\"Rute_2\" id=\"Rute_2\"><tr><td class=\"R_0\" colspan=\"2\">$Butikken</td></tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"$Bilde\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"$Bilde\"></A></p></td></tr>";
    if($I['Butikk_Type'] == 'Våpen') {
    $en = explode(',', $Varer['0']); $to = explode(',', $Varer['1']); $tre = explode(',', $Varer['2']); $fire = explode(',', $Varer['3']); $fem = explode(',', $Varer['4']); $seks = explode(',', $Varer['5']); $sju = explode(',', $Varer['6']); $atte = explode(',', $Varer['7']); $ni = explode(',', $Varer['8']);
    
    echo $KjopVopen;
    
    echo "
    <tr><td class=\"R_4\">Våpen</td><td class=\"R_4\">Pris</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Hammer\">Hammer <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($en['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($en['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Balltre\">Balltre <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($to['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($to['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Knokejern\">Knokejern <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($tre['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($tre['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Kniv\">Kniv <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fire['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fire['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Glock 17\">Glock 17 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fem['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fem['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Desert Eagle\">Desert Eagle <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($seks['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($seks['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Uzi smg\">Uzi smg <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($sju['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($sju['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Ak-47\">Ak-47 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($atte['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($atte['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"Steyr aug a1\">Steyr aug a1 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($ni['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($ni['1']),'kr')."</td></tr>
    <tr><td class=\"R_7\" colspan=\"2\" onclick=\"document.getElementById('du_valgte').value='Vopen';document.getElementById('Butikken').submit()\">KJØP</td></tr>
    ";
    
    }
    elseif($I['Butikk_Type'] == 'Beskyttelse') { 
    $en = explode(',', $Varer['0']); $to = explode(',', $Varer['1']); $tre = explode(',', $Varer['2']); $fire = explode(',', $Varer['3']); $fem = explode(',', $Varer['4']);

    echo $KjopBesk;

    echo "
    <tr><td class=\"R_4\">Beskyttelse</td><td class=\"R_4\">Pris</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Finnlandshette\">Finnlandshette <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($en['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($en['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Hund\">Hund <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($to['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($to['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Skuddsikker vest\">Skuddsikker vest <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($tre['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($tre['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Livvakt\">Livvakt <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fire['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fire['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"Skuddsikker bil\">Skuddsikker bil <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fem['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fem['1']),'kr')."</td></tr>
    <tr><td class=\"R_7\" colspan=\"2\" onclick=\"document.getElementById('du_valgte').value='Besk';document.getElementById('Butikken').submit()\">KJØP</td></tr>
    ";
    
    }
    elseif($I['Butikk_Type'] == 'Fly') {
    $en = explode(',', $Varer['0']); $to = explode(',', $Varer['1']); $tre = explode(',', $Varer['2']); $fire = explode(',', $Varer['3']); $fem = explode(',', $Varer['4']); 
    
    echo $KjopFly;
    
    echo "
    <tr><td class=\"R_4\">Fly</td><td class=\"R_4\">Pris</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box3[]\" value=\"Aerostar 601P\">Aerostar 601P <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($en['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($en['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box3[]\" value=\"Mitsubishi MU-2K\">Mitsubishi MU-2K <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($to['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($to['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box3[]\" value=\"Cessna Skyhawk\">Cessna Skyhawk <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($tre['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($tre['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box3[]\" value=\"Cessna 208\">Cessna 208 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fire['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fire['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box3[]\" value=\"Citation V Ultra\">Citation V Ultra <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fem['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fem['1']),'kr')."</td></tr>
    <tr><td class=\"R_7\" colspan=\"2\" onclick=\"document.getElementById('du_valgte').value='Fly';document.getElementById('Butikken').submit()\">KJØP</td></tr>
    ";
    
    }
    elseif($I['Butikk_Type'] == 'Båter') { 
    $en = explode(',', $Varer['0']); $to = explode(',', $Varer['1']); $tre = explode(',', $Varer['2']); $fire = explode(',', $Varer['3']); $fem = explode(',', $Varer['4']); $seks = explode(',', $Varer['5']); 

    echo $KjopBat;

    echo "
    <tr><td class=\"R_4\">Båt</td><td class=\"R_4\">Pris</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box4[]\" value=\"Triton 225\">Triton 225 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($en['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($en['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box4[]\" value=\"Mariah SC25\">Mariah SC25 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($to['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($to['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box4[]\" value=\"Sea Ray 275\">Sea Ray 275 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($tre['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($tre['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box4[]\" value=\"FORBINA 36\">FORBINA 36 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fire['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fire['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box4[]\" value=\"Mediterranèe 43\">Mediterranèe 43 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($fem['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($fem['1']),'kr')."</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box4[]\" value=\"Meridian 459\">Meridian 459 <font style=\"color:#85a8bf; font-size:10px;\">[ ".Bare_Siffer($seks['0'])." ]</font></td><td class=\"R_2\">".VerdiSum(Bare_Siffer($seks['1']),'kr')."</td></tr>
    <tr><td class=\"R_7\" colspan=\"2\" onclick=\"document.getElementById('du_valgte').value='Bat';document.getElementById('Butikken').submit()\">KJØP</td></tr>
    ";
    
    }
    
    echo "</table>";
    
    }
    
    echo "</div><div class=\"Div_masta\">";
    

    echo "
    <table class=\"Rute_2\" id=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">EIENDOM</td></tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"../Bilder/eiendom.jpg\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"../Bilder/eiendom.jpg\"></A></p></td></tr>";
    
    echo $KjopEiendom;
    
    echo "
    <tr><td class=\"R_4\">Eiendom</td><td class=\"R_4\">Pris</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Hybel\">Hybel <font style=\"color:#85a8bf; font-size:10px;\">[ 2 Pers ]</font></td><td class=\"R_2\">1.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Enebolig\">Enebolig <font style=\"color:#85a8bf; font-size:10px;\">[ 4 Pers ]</font></td><td class=\"R_2\">2.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Luksus bolig\">Luksus bolig <font style=\"color:#85a8bf; font-size:10px;\">[ 5 Pers ]</font></td><td class=\"R_2\">5.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Villa\">Villa <font style=\"color:#85a8bf; font-size:10px;\">[ 7 Pers ]</font></td><td class=\"R_2\">8.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Luksus villa\">Luksus villa <font style=\"color:#85a8bf; font-size:10px;\">[ 9 Pers ]</font></td><td class=\"R_2\">12.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Odden slott\">Odden slott <font style=\"color:#85a8bf; font-size:10px;\">[ 15 Pers ]</font></td><td class=\"R_2\">30.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Kråg slott\">Kråg slott <font style=\"color:#85a8bf; font-size:10px;\">[ 20 Pers ]</font></td><td class=\"R_2\">50.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Hotel rådli\">Hotel rådli <font style=\"color:#85a8bf; font-size:10px;\">[ 35 Pers ]</font></td><td class=\"R_2\">100.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Plaza hotel\">Plaza hotel <font style=\"color:#85a8bf; font-size:10px;\">[ 45 Pers ]</font></td><td class=\"R_2\">300.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box5[]\" value=\"Brud borg\">Brud borg <font style=\"color:#85a8bf; font-size:10px;\">[ 95 Pers ]</font></td><td class=\"R_2\">500.000.000 kr</td></tr>
    <tr><td class=\"R_7\" colspan=\"2\" onclick=\"document.getElementById('du_valgte').value='Eiendom';document.getElementById('Butikken').submit()\">KJØP</td></tr>
    </table>";
    
    if(mysql_num_rows($Kf) >= '1') {
    
    $Bilde = Mysql_Klar($KF_I['KF_Banner']);
    
    echo "
    <table class=\"Rute_2\" id=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">KULEFABRIKK</td></tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"$Bilde\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"$Bilde\"></A></p></td></tr>";
    
    echo $KjopKuler;
    
    echo "
    <tr><td class=\"R_4\">Fabrikk</td><td class=\"R_4\">Info</td></tr>
    <tr><td class=\"R_1\">Fabrikk</td><td class=\"R_2\">".$KF_I['KF_Fabrikk']."</td></tr>
    <tr><td class=\"R_1\">Grunnlagt</td><td class=\"R_2\">".$KF_I['KF_Opprettet_Dato']."</td></tr>
    <tr><td class=\"R_1\">Fabrikk eier</td><td class=\"R_2\">".BrukerURL($KF_I['KF_Eier'])."</td></tr>
    <tr><td class=\"R_1\">Kuler</td><td class=\"R_2\">".VerdiSum($KF_I['KF_Kuler'],'stk')."</td></tr>
    <tr><td class=\"R_1\">Pris pr stk</td><td class=\"R_2\">".VerdiSum($KF_I['KF_SlagsPris'],'kr')."</td></tr>
    <tr><td class=\"R_1\"><input class=\"textbox2\" type=\"text\" name=\"sumkuler\" value=\"antall\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='antall')this.value='';\" onblur=\"if(this.value=='')this.value='antall';\"></td>
    <td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Kuler';document.getElementById('Butikken').submit()\">KJØP</td></tr>
    </table>";
    
    }
    
    /*
     echo "
    <table class=\"Rute_2\" id=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">AUKSJON</td></tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"../Bilder/auksjon.jpg\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"../Bilder/auksjon.jpg\"></A></p></td></tr>";
    
    echo $Auksjon;
    
    echo "
    <tr><td class=\"R_4\">Auksjons vare</td><td class=\"R_4\">Høyest bud</td></tr>
    <tr><td class=\"R_1\">Test en</td><td class=\"R_2\">2.000.000 kr</td></tr>
    <tr><td class=\"R_1\">Test to</td><td class=\"R_2\">3.500.000 kr</td></tr>
    <tr><td class=\"R_1\">Test tre</td><td class=\"R_2\">2.306.000 kr</td></tr>
    <tr><td class=\"R_1\">Test fire</td><td class=\"R_2\">1.050.540 kr</td></tr>
    <tr><td class=\"R_1\">Test fem</td><td class=\"R_2\">500.000 kr</td></tr>
    <tr><td class=\"R_1\">Test seks</td><td class=\"R_2\">16.965.320 kr</td></tr>
    <tr><td class=\"R_1\">Test sju</td><td class=\"R_2\">29.000.000 kr</td></tr>
    <tr><td class=\"R_1\">Test åtte</td><td class=\"R_2\">500.000.000 kr</td></tr>
    <tr><td class=\"R_1\">Test ni</td><td class=\"R_2\">132.000.000 kr</td></tr>
    <tr><td class=\"R_1\">Test ti</td><td class=\"R_2\">252.000.000 kr</td></tr>
    <tr><td class=\"R_1\"><input class=\"textbox2\" type=\"text\" name=\"sum2\" value=\"sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='sum')this.value='';\" onblur=\"if(this.value=='')this.value='sum';\"></td>
    <td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Auksjon';document.getElementById('Butikken').submit()\">GI BUD</td></tr>
    </table>";
    */
    
    echo "</form></div>";

    
    ?>

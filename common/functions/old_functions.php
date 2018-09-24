<?php
// This is all the old functions in the game, all of them will be renewed or deleted

	// Sonbru utvikling - scriptet ble utviklet 10.10.09 av Sondre Brudvik
    // Dette skriptet tillhører Sondre Brudvik, du har ingen rett til å bruke det med mindre du har kommet til en enighet med Sondre. 
    // Om Sondre Brudvik leverer deg en side og dette scriptet er inkludert har du på ingen måter rettigheter over denne filen. Ved kjøp har du lov til å bruke scriptet til den siden Sondre Brudvik har solgt deg.
    // Variabler
    $Timestamp = time();
    $Klokke = date("H:i:s");
    $Dato = date("d.m.y");
    $DatoIdag = date("d. M");
    $Nbsp = '//';
    $Aktiv = $Timestamp + '3600';
    $tiden_aktiv = $Aktiv;
    $FullDato = $Klokke." ".$Nbsp." ".$Dato;
    $AnnenDato = $Klokke." ".$Nbsp." ".$DatoIdag." ".$Nbsp." ".date("Y");
    // Funksjoner
    
    function Melding_Klar($Tekst)
    {
        $Tekst = htmlentities(strip_tags($Tekst)); // Removed mysql_real_escape_string
        return $Tekst;
    }

    

// -- Function Name : Mysql_Klar
// -- Params : $Tekst
// -- Purpose : 
    function Mysql_Klar($Tekst)
    {
        $Tekst = htmlspecialchars($Tekst); // Removed mysql_real_escape_string
        return $Tekst;
    }

    

// -- Function Name : Bare_Siffer
// -- Params : $Tekst
// -- Purpose : 
    function Bare_Siffer($Tekst)
    {
        $Tekst = preg_replace("/[^0-9]/", "",$Tekst);
        return $Tekst;
    }

    

// -- Function Name : Bare_Bokstaver
// -- Params : $Tekst
// -- Purpose : 
    function Bare_Bokstaver($Tekst)
    {
        $Tekst = preg_replace("[^A-Za-z]", "",$Tekst);
        return $Tekst;
    }

    

// -- Function Name : Bare_BS
// -- Params : $Tekst
// -- Purpose : 
    function Bare_BS($Tekst)
    {
        $Tekst = preg_replace("[^A-Za-z0-9 ]", "",$Tekst);
        return $Tekst;
    }

    

// -- Function Name : Fiks_Space
// -- Params : $Tekst
// -- Purpose : 
    function Fiks_Space($Tekst)
    {
        $Tekst = preg_replace('/\s+/', ' ',$Tekst);
        return trim($Tekst);
    }

    

// -- Function Name : VerdiSum
// -- Params : $Tekst,$Type
// -- Purpose : 
    function VerdiSum($Tekst,$Type)
    {
        $Tekst = number_format(intval($Tekst), 0, ",", ".")." $Type";
        return $Tekst;
    }

    

// -- Function Name : BrukerURL
// -- Params : $Navn
// -- Purpose : 
    function BrukerURL($Navn)
    {
        $Navn = "<a href=\"game.php?side=Bruker&navn=".urlencode($Navn)."\">".$Navn."</a>";
        return $Navn;
    }

    

// -- Function Name : IGjeng
// -- Params : $Navn
// -- Purpose : 
    function IGjeng($Navn)
    {
        
        if(empty($Navn))
        {
            $Navn = 'Ingen';
        }
        else
        {
            $Navn = '<a href="game.php?side=Gjeng&navn='.urlencode($Navn).'">$Navn</a>';
        }

        return $Navn;
    }

    

// -- Function Name : DrapsRank
// -- Params : $Tekst
// -- Purpose : 
    function DrapsRank($Tekst)
    {
        
        if ($Tekst >= '0')
        {
            $R = 'Ufarlig';
        }

        elseif($Tekst >= '3')
        {
            $R = 'Har drept';
        }

        elseif ($Tekst >= '6')
        {
            $R = 'Morder';
        }

        elseif ($Tekst >= '9')
        {
            $R = 'Veldig farlig';
        }

        elseif ($Tekst >= '12')
        {
            $R = 'Massemorder';
        }

        elseif ($Tekst >= '15')
        {
            $R = 'Psykopat';
        }

        return $R;
    }

    

// -- Function Name : PrintTeksten
// -- Params : $Tekst,$Type,$Svar,$Colspan
// -- Purpose : 
    function PrintTeksten($Tekst,$Type,$Svar,$Colspan='0')
    {
        
        if($Type == '1')
        {
            
            if($Svar == 'Vellykket')
            {
                $Class = "Span_str_6";
            }
            else
            {
                $Class = "Span_str_5";
            }

            $Svar = "<div class=\"Div_MELDING\"><span class=\"$Class\">$Tekst</span></div>";
        }

        elseif($Type == '2')
        {
            
            if($Svar == 'Vellykket')
            {
                $Class = "T_1";
            }
            else
            {
                $Class = "T_2";
            }

            $Svar = "<tr><td class=\"R_8\" colspan=\"$Colspan\"><span class=\"$Class\">$Tekst</span></td></tr>";
        }

        return $Svar;
    }

    

// -- Function Name : Stilling
// -- Params : $Stilling
// -- Purpose : 
    function Stilling($Stilling)
    {
        
        if($Stilling == 'u')
        {
            $Var = '';
        }

        elseif($Stilling == 'b')
        {
            $Var = '<font color="#923961">Mafiano bot</font>';
        }

        elseif($Stilling == 's')
        {
            $Var = '<font color="#999ea6">Support spiller</font>';
        }

        elseif($Stilling == 'sf')
        {
            $Var = '<font color="#516995">Support ansvarlig</font>';
        }

        elseif($Stilling == 'bz')
        {
            $Var = '<font color="#7d4d7e">Bugzorz</font>';
        }

        elseif($Stilling == 'mi')
        {
            $Var = '<font color="#518b95">mIRC ansvarlig</font>';
        }

        elseif($Stilling == 'fm')
        {
            $Var = '<font color="#5e8112">Forum moderator</font>';
        }

        elseif($Stilling == 'm')
        {
            $Var = '<font color="#906b12">Moderator</font>';
        }

        elseif($Stilling == 'A')
        {
            $Var = '<font color="#c03818">Administrator</font>';
        }

        return $Var;
    }

    

// -- Function Name : DrapStatus
// -- Params : $A
// -- Purpose : 
    function DrapStatus($A)
    {
        
        if($A >= '15')
        {
            $T = 'Psykopat';
        }

        elseif($A >= '12')
        {
            $T = 'Massemorder';
        }

        elseif ($A >= '9')
        {
            $T = 'Veldig farlig';
        }

        elseif ($A >= '6')
        {
            $T = 'Morder';
        }

        elseif ($A >= '3')
        {
            $T = 'Har drept';
        }
        else
        {
            $T = 'Ufarlig';
        }

        return $T;
    }

    

// -- Function Name : RankprosTo
// -- Params : $RankNiva,$Rankpros
// -- Purpose : 
    function RankprosTo($RankNiva,$Rankpros)
    {
        
        if($RankNiva > '1')
        {
            $M = $RankNiva * '100';
            $M = $M - '100';
        }
        else
        {
            $M = '0';
        }

        $T = $Rankpros - $M;
        return $T;
    }

    


    

// -- Function Name : Avlogging
// -- Params : 
// -- Purpose : 
    function Avlogging()
    {
        global $brukernavn, $Timestamp, $DinIpAdresse, $id_logget_inn, $id_toket_H, $liv, $aktiv_player_eller;
      
        $T = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$brukernavn' AND StampOver > '$Timestamp'");
        $B = mysql_query("SELECT * FROM IpBan WHERE IpAdresse='$DinIpAdresse' AND Tidslengde > '$Timestamp'");
        
        if(mysql_num_rows($T) >= '1')
        {
            LoggUt();
        }

        elseif(mysql_num_rows($B) >= '1')
        {
            LoggUt();
        }

        elseif($id_logget_inn != $id_toket_H)
        {
            LoggUt();
        }

        elseif($liv < '1')
        {
            LoggUt();
        }

        elseif($aktiv_player_eller < $Timestamp)
        {
            LoggUt();
        }

    }

    

// -- Function Name : NyRank
// -- Params : $RANKI, $PROSENTI
// -- Purpose : 
    function NyRank($RANKI, $PROSENTI)
    {
        global $brukernavn;
        
        if($RANKI == '1' && $PROSENTI >= '100')
        {
            $GiRank = 'JA';
            $Sporring = "";
        }

        elseif($RANKI == '2' && $PROSENTI >= '200')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '3' && $PROSENTI >= '300')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '4' && $PROSENTI >= '400')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '5' && $PROSENTI >= '500')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '6' && $PROSENTI >= '600')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '7' && $PROSENTI >= '700')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '8' && $PROSENTI >= '800')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '9' && $PROSENTI >= '900')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '10' && $PROSENTI >= '1000')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '11' && $PROSENTI >= '1100')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '12' && $PROSENTI >= '1200')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '13' && $PROSENTI >= '1300')
        {
            $GiRank = 'JA';
        }

        elseif($RANKI == '14' && $PROSENTI >= '1400')
        {
            $GiRank = 'JA';
        }
        else
        {
            $GiRank = 'NEI';
        }

        
        if($GiRank == 'JA')
        {
            $TallRankEr = $RANKI + '1';
          
            $SjekkLoggi = mysql_query("SELECT * FROM NyRank WHERE Brukernavn='$brukernavn' AND TallRank='$TallRankEr'");
            
            if (mysql_num_rows($SjekkLoggi) > '0')
            {
                $GiRank = 'NEI';
            }
            else
            {
                $GiRank = 'JA';
            }

        }

        return $GiRank;
    }

    

// -- Function Name : ListVopen
// -- Params : $En,$To,$Tre
// -- Purpose : 
    function ListVopen($En,$To,$Tre)
    {
        
        if($En == 'Ingen' && $To == 'Ingen' && $Tre == 'Ingen')
        {
            $R = 'Ingen';
        }
        else
        {
            
            if($En == 'Ingen')
            {
                $En = '';
            }

            
            if($To == 'Ingen')
            {
                $To = '';
            }
            else
            {
                $To = "<br>".$To;
            }

            
            if($Tre == 'Ingen')
            {
                $Tre = '';
            }
            else
            {
                $Tre = "<br>".$Tre;
            }

            $R = $En.$To.$Tre;
        }

        return $R;
    }

    

// -- Function Name : DineVopen
// -- Params : 
// -- Purpose : 
    function DineVopen()
    {
        global $brukernavn, $vopen_1_er, $vopen_2_er, $vopen_3_er, $besk_1_er, $besk_2_er, $besk_3_er;
      
        $H = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND forbruk_nr >= '1'");
        
        if(mysql_num_rows($H) >= '1')
        {
            while($V = mysql_fetch_assoc($H))
            {
                
                if($V['forbruk_nr'] == '1' && $V['type'] == '1')
                {
                    $vopen_1_er = $V['utstyr'];
                }

                elseif($V['forbruk_nr'] == '2' && $V['type'] == '1')
                {
                    $vopen_2_er = $V['utstyr'];
                }

                elseif($V['forbruk_nr'] == '3' && $V['type'] == '1')
                {
                    $vopen_3_er = $V['utstyr'];
                }

                elseif($V['forbruk_nr'] == '1' && $V['type'] == '2')
                {
                    $besk_1_er = $V['utstyr'];
                }

                elseif($V['forbruk_nr'] == '2' && $V['type'] == '2')
                {
                    $besk_2_er = $V['utstyr'];
                }

                elseif($V['forbruk_nr'] == '3' && $V['type'] == '2')
                {
                    $besk_3_er = $V['utstyr'];
                }

            }

        }

    }

    

// -- Function Name : bilens_verdi
// -- Params : $tall
// -- Purpose : 
    function bilens_verdi($tall)
    {
        
        if ($tall == 'Opel Calibra')
        {
            $verdi = '70000';
        }

        elseif ($tall == 'Audi TT')
        {
            $verdi = '400000';
        }

        elseif ($tall == 'Suziki XL-7')
        {
            $verdi = '210000';
        }

        elseif ($tall == 'Suzuki XL-7')
        {
            $verdi = '210000';
        }

        elseif ($tall == 'Toyota Supera')
        {
            $verdi = '150000';
        }

        elseif ($tall == 'Toyota Supra')
        {
            $verdi = '150000';
        }

        elseif ($tall == 'Nissan Skyline GT-R')
        {
            $verdi = '380000';
        }

        elseif ($tall == 'Peugot 307 SW')
        {
            $verdi = '120000';
        }

        elseif ($tall == 'Saab 9-5')
        {
            $verdi = '110000';
        }

        elseif ($tall == 'Nissan 100 NX')
        {
            $verdi = '30000';
        }

        elseif ($tall == 'Honda Civic 1,6')
        {
            $verdi = '39700';
        }

        elseif ($tall == 'Lada Niva')
        {
            $verdi = '70000';
        }

        elseif ($tall == 'Chrysler Neon')
        {
            $verdi = '62000';
        }

        elseif ($tall == 'Ford Escort 1,4')
        {
            $verdi = '74050';
        }

        elseif ($tall == 'Volvo 240')
        {
            $verdi = '30000';
        }

        elseif ($tall == 'Mazda RX-8')
        {
            $verdi = '450000';
        }

        elseif ($tall == 'Volkswagen golf 1,8 GT')
        {
            $verdi = '20000';
        }

        elseif ($tall == 'Mercedes-Benz SLK')
        {
            $verdi = '400000';
        }

        elseif ($tall == 'Range Rover 3.0 Td6')
        {
            $verdi = '500000';
        }

        elseif ($tall == 'Porsche 944')
        {
            $verdi = '60000';
        }

        elseif ($tall == 'Bmw 3-serie')
        {
            $verdi = '100000';
        }

        elseif ($tall == 'Jaguar XKR 4,2')
        {
            $verdi = '2000000';
        }

        $tall = $verdi;
        return $tall;
    }

    

// -- Function Name : FlyVerdi
// -- Params : $v
// -- Purpose : 
    function FlyVerdi($v)
    {
        
        if($v == 'Aerostar 601P')
        {
            $p = '3630000';
        }

        elseif($v == 'Mitsubishi MU-2K')
        {
            $p = '5160000';
        }

        elseif($v == 'Cessna Skyhawk')
        {
            $p = '9000000';
        }

        elseif($v == 'Cessna 208')
        {
            $p = '16340000';
        }

        elseif($v == 'Citation V Ultra')
        {
            $p = '29970000';
        }
        else
        {
            $p = '30000000';
        }

        return $p;
    }

    

// -- Function Name : BatVerdi
// -- Params : $v
// -- Purpose : 
    function BatVerdi($v)
    {
        
        if($v == 'Triton 225')
        {
            $p = '467000';
        }

        elseif($v == 'Mariah SC25')
        {
            $p = '507000';
        }

        elseif($v == 'Sea Ray 275')
        {
            $p = '1153000';
        }

        elseif($v == 'FORBINA 36')
        {
            $p = '2130000';
        }

        elseif($v == 'Mediterranèe 43')
        {
            $p = '3286800';
        }

        elseif($v == 'Meridian 459')
        {
            $p = '5275000';
        }
        else
        {
            $p = "10000000";
        }

        return $p;
    }

    

// -- Function Name : SjekkPlassering
// -- Params : $Bruker
// -- Purpose : 
    function SjekkPlassering($Bruker)
    {
        global $Timestamp;
      
        $Kidnappet = mysql_query("SELECT * FROM kidnapping WHERE offer='$Bruker'");
        $Sykehus = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$Bruker' AND timestampen_ute > $Timestamp");
      
        $Bunker = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$Bruker' AND godtatt_elle LIKE '1'");
      
        $Fengsel = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$Bruker'");
        
        if(empty($Bruker))
        {
            header("Location: index.php");
        }

        elseif(mysql_num_rows($Kidnappet) > '0')
        {
            header("Location: game.php?side=kidnappet");
        }

        elseif(mysql_num_rows($Sykehus) > '0')
        {
            header("Location: game.php?side=Sykehus");
        }

        elseif(mysql_num_rows($Bunker) > '0')
        {
            header("Location: game.php?side=bunker");
        }

        elseif(mysql_num_rows($Fengsel) > '0')
        {
            header("Location: game.php?side=Fengsel");
        }
        else
        {
            return 'klar';
        }

    }

    

// -- Function Name : PlateProd
// -- Params : 
// -- Purpose : 
    function PlateProd()
    {
        global $Timestamp;
      
        $P = mysql_query("SELECT * FROM `PlatestudioPlater` WHERE StampSolgt < $Timestamp ORDER BY `TimestampProd` DESC LIMIT 300");
        
        if(mysql_num_rows($P) >= '1')
        {
            while($I = mysql_fetch_assoc($P))
            {
                $ID = $I['Id'];
                $ASpilt = $I['AntallGangerSpilt'] + '2.45';
                $ASolgt = $ASpilt * '2';
                $Prosent = $ASolgt / '100' * $I['AntallSanger'];
                $ASolgt = $ASolgt + $Prosent;
                $NySumSolgt = $I['AntallSalg'] + $ASolgt;
                $NyTid = $Timestamp + '4000';
                mysql_query("UPDATE PlatestudioPlater SET AntallSalg='$NySumSolgt',StampSolgt='$NyTid' WHERE Id='$ID'");
            }

        }

    }

    

// -- Function Name : TidKlar
// -- Params : $Tid
// -- Purpose : 
    function TidKlar($Tid)
    {
        global $Timestamp;
        $Sjekk = $Tid - $Timestamp;
        
        if($Sjekk >= '1')
        {
            $Sjekk = $Sjekk;
        }
        else
        {
            $Sjekk = 'klar';
        }

        return $Sjekk;
    }

    

// -- Function Name : smil
// -- Params : $text
// -- Purpose : 
    function smil($text)
    {
        $trans = array(":((" => '<img src="smilies/10.gif" title="Gråter :((">',":))" => '<img src="smilies/9.gif" title="Le :))">',"=))" => '<img src="smilies/12.gif" title="Ler stort =))">',"=((" => '<img src="smilies/18.gif" title="Virkelig trist =((">', ":)" => '<img src="smilies/2.gif" title="Smil :)">',":(" => '<img src="smilies/1.gif" title="Trist :(">',":P" => '<img src="smilies/11.gif" title="Tunge :P">',":p" => '<img src="smilies/3.gif" title="Tunge :p">',"<3" => '<img src="smilies/4.gif" title="Forelsket <3">',"X(" => '<img src="smilies/5.gif" title="Sint X(">',":D" => '<img src="smilies/6.gif" title="Stort smil :D">',":S" => '<img src="smilies/7.gif" title="Usikker :S">',":O" => '<img src="smilies/8.gif" title="Sjokkert :O">',";P" => '<img src="smilies/13.gif" title="Sleike ;P">',":-*" => '<img src="smilies/14.gif" title="Kyss :-*">',":-O" => '<img src="smilies/15.gif" title="Sikler :-O">',":|" => '<img src="smilies/16.gif" title="Rett smil :|">',">:D<" => '<img src="smilies/17.gif" title="Klem >:D<">',":>" => '<img src="smilies/19.gif" title="Kul :>">',";)" => '<img src="smilies/20.gif" title="Blunk ;)">');
        $translated = strtr($text, $trans);
        return nl2br($translated);
    }

    

// -- Function Name : url
// -- Params : $url
// -- Purpose : 
    function url($url)
    {
        $pattern = array("/http:\/\/www\.youtube\.com\/watch\?(.*)v=([a-zA-Z0-9_\-]+)/i","/(^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6})$/i",'/(http:\/\/[^\s]+(.jpg|.png|.gif))/i');
        $replace = array('<object width="280" height="185"><param name="movie" value="http://www.youtube.com/v/$2&amp;hl=en_US&amp;fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/$2&amp;hl=en_US&amp;fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="280" height="185"></embed></object>','<a class="URL" href="mailto:$1">$1</a>','<a class=thickbox title="" href="$1"><img style="max-height:250px; max-width:200px; border-width:1;" src="$1"></a>');
        return preg_replace($pattern, $replace, $url);
    }

    

// -- Function Name : Skytebanen
// -- Params : 
// -- Purpose : 
    function Skytebanen()
    {
        global $Timestamp, $FullDato;
      
        $S = mysql_query("SELECT * FROM vapen_beskyttelse WHERE  type='1' AND trener_ell LIKE '1' AND skytetrening_over < '$Timestamp'");
        
        if(mysql_num_rows($S) >= '1')
        {
            while($I = mysql_fetch_assoc($S))
            {
                $ID = $I['id'];
                $VO = $I['utstyr'];
                $Trener = $I['brukernavn'];
                
                if($I['skytereningen'] == '0')
                {
                    $Opp = rand(2,4);
                }
                else
                {
                    $Opp = rand(6,16);
                }

                $NySkil = floor($I['skytereningen'] + $Opp);
                
                if($NySkil >= '100')
                {
                    $NySkil = '100';
                }
                else
                {
                    $NySkil = $NySkil;
                }

                
                if($NySkil == '100')
                {
                    
                    if($VO == 'Hammer')
                    {
                        $Svar = "Gratulerer du har trent opp slagkraften til det maksimale, du kan nå drepe folk med en hammer.";
                    }

                    elseif($VO == 'Balltre')
                    {
                        $Svar = "Gratulerer du har trent opp slagkraften, du kan knuse tryne til folk med et balltre.";
                    }

                    elseif($VO == 'Knokejern' || $VO == 'Knokjern')
                    {
                        $Svar = "Du har trent opp teknikken på å slå med knokjern, du kan nå bruke våpenet til å drepe.";
                    }

                    elseif($VO == 'Kniv')
                    {
                        $Svar = "Gratulerer du har trent opp stikk teknikken din, du kan nå knvistikke folk.";
                    }
                    else
                    {
                        $Svar = "Gratulerer du har trent opp skyte ferdighetene dine, du kan nå drepe en spiller med følgende våpen $VO.";
                    }

                }
                else
                {
                    
                    if($NySkil >= '0')
                    {
                        $Svar = array("Du har ikke akuratt treningslyst, våpentreningen gikk ikke så veldig bra.", "Du ble distrahert under treningen, du må nok trene mer.", "Du dreit deg ut under våpentreningen, du må nok trene mer.");
                    }

                    elseif($NySkil >= '10')
                    {
                        $Svar = array("Du må nok trene litt mer på våpenbana.", "Du var helt fra deg av irritasjon under våpentreningen, treningen gikk til helvete. Du må nok trene enda mer.", "Du var uduglig når det kommer til våpentrening, du må nok trene litt mer. Ikke glem at trening gjør deg til en mester.");
                    }

                    elseif($NySkil >= '30')
                    {
                        $Svar = array("Du trente ferdighetene dine bra men du har ikke oppnåd 100% med dette våpenet enda, tren litt mer så oppnår du det en dag.", "Du gjorde det helt OK under våpentreningen, tren mer så opnår du 100% en vakker dag.", "Du trente helt greit men du må desverre trene mer.");
                    }

                    elseif($NySkil >= '60')
                    {
                        $Svar = array("Du trente bra, men tren litt til så er det like før du er på 100 prosent.", "Gløden for å trene deg god med våpenet stoppet aldri men du har desverre ikke opnådd 100% enda, tren litt til.", "Du trente med våpenet til svetten rant men du må desverre trene litt mer for å opnå 100%");
                    }

                    $Svar = $Svar[array_rand($Svar)];
                }

                mysql_query("UPDATE vapen_beskyttelse SET trener_ell='0',skytetrening_over='',skytereningen='$NySkil' WHERE brukernavn='$Trener' AND id LIKE '$ID'");
              
                mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Trener','$Timestamp','$FullDato','Våpentrening','$Svar','Ja')");
            }

        }

    }

    

// -- Function Name : Dektektiver
// -- Params : 
// -- Purpose : 
    function Dektektiver()
    {
        global $brukernavn, $Timestamp;
      
        $Sok = mysql_query("SELECT DISTINCT bunker_invite.kis_invitert AS ibunker,drepe_soking.* FROM drepe_soking LEFT JOIN bunker_invite ON (drepe_soking.soker_etter=bunker_invite.kis_invitert AND bunker_invite.timestamp_ute > '$Timestamp') WHERE drepe_soking.time_sok_over < '$Timestamp' AND drepe_soking.befinner_seg LIKE 'Søker' AND drepe_soking.sokers_navn LIKE '$brukernavn'") or die(mysql_error());
        
        if(mysql_num_rows($Sok) >= '1')
        {
            while($i = mysql_fetch_assoc($Sok))
            {
                
                if(empty($i['ibunker']))
                {
                    $Bunkret = 'Nei';
                }
                else
                {
                    $Bunkret = 'Ja';
                }

                $S_Sokeren = $i['sokers_navn'];
                $S_Offer = $i['soker_etter'];
                $S_Lengde = $i['antall_min'];
                $S_Id = $i['id'];
                
                if($S_Lengde == '20')
                {
                    $Svar = array("J","J","N","N","N","N","N","N","N","N");
                }

                elseif($S_Lengde == '30')
                {
                    $Svar = array("J","J","J","N","N","N","N","N","N","N");
                }

                elseif($S_Lengde == '40')
                {
                    $Svar = array("J","J","J","J","N","N","N","N","N","N");
                }

                elseif($S_Lengde == '50')
                {
                    $Svar = array("J","J","J","J","J","N","N","N","N","N");
                }

                elseif($S_Lengde == '60')
                {
                    $Svar = array("J","J","J","J","J","J","N","N","N","N");
                }

                elseif($S_Lengde == '70')
                {
                    $Svar = array("J","J","J","J","J","J","J","N","N","N");
                }

                elseif($S_Lengde == '80')
                {
                    $Svar = array("J","J","J","J","J","J","J","J","N","N");
                }

                elseif($S_Lengde == '90')
                {
                    $Svar = array("J","J","J","J","J","J","J","J","J","N");
                }

                elseif($S_Lengde == '100')
                {
                    $Svar = array("J","J");
                }
                else
                {
                    $Svar = array("J","J");
                }

                $Svar = $Svar[array_rand($Svar)];
                
                if($Svar == 'N')
                {
                    mysql_query("UPDATE drepe_soking SET befinner_seg='Feilet' WHERE id='$S_Id'");
                }

                elseif($Bunkret == 'Ja')
                {
                    mysql_query("UPDATE drepe_soking SET befinner_seg='Feilet' WHERE id='$S_Id'");
                }
                else
                {
                  
                    $ByPlass = mysql_fetch_object(mysql_query("SELECT land FROM brukere WHERE brukernavn LIKE '$S_Offer'"));
                    $ByPlass = $ByPlass->land;
                  
                    mysql_query("UPDATE drepe_soking SET befinner_seg='Vellykket',bosted='$ByPlass' WHERE id='$S_Id'");
                }

            }

        }

      
        $TimeEkst = $Timestamp - '300';
        $SokTo = mysql_query("SELECT * FROM drepe_soking WHERE time_sok_over < '$TimeEkst' AND ekstra_min LIKE 'Ja' AND befinner_seg LIKE 'Vellykket' AND sokers_navn LIKE '$brukernavn' AND sok_over LIKE 'NOD'");
        
        if(mysql_num_rows($SokTo) >= '1')
        {
            while($ii = mysql_fetch_assoc($SokTo))
            {
                $SS_Sokeren = $ii['sokers_navn'];
                $SS_Offer = $ii['soker_etter'];
                $SS_Lengde = $ii['antall_min'];
                $SS_Id = $ii['id'];
              
                $ByYPlass = mysql_fetch_object(mysql_query("SELECT land FROM brukere WHERE brukernavn LIKE '$SS_Offer'"));
                $ByYPlass = $ByYPlass->land;
              
                mysql_query("UPDATE drepe_soking SET bosted='$ByYPlass',sok_over='JA' WHERE id='$SS_Id'");
            }

        }

    }

    

// -- Function Name : GiRank
// -- Params : 
// -- Purpose : 
    function GiRank()
    {
        global $rank_niva, $rankpros, $bombechips, $kjoonn, $brukernavn, $Timestamp, $FullDato, $Aktiv;
        $SjekkTilstand = $rank_niva * '100';
        
        if($SjekkTilstand >= '1400')
        {
            $SjekkTilstand = $SjekkTilstand - '10000';
        }

        
        if($rankpros >= $SjekkTilstand)
        {
            $NyRankEll = NyRank($rank_niva, $rankpros);
            
            if($NyRankEll == 'JA')
            {
                $NyTallRank = $rank_niva + '1';
                $Gave = $NyTallRank * '20';
                $NySumchips = floor($bombechips + $Gave);
                
                if($NyTallRank == '2' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Lærling";
                }

                elseif($NyTallRank == '3' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Bråkmaker";
                }

                elseif($NyTallRank == '4' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Kriminell";
                }

                elseif($NyTallRank == '5' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Gangster";
                }

                elseif($NyTallRank == '6' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Attentatmann";
                }

                elseif($NyTallRank == '7' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Torpedo";
                }

                elseif($NyTallRank == '8' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Kaptein";
                }

                elseif($NyTallRank == '9' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Narko Baron";
                }

                elseif($NyTallRank == '10' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Sjef";
                }

                elseif($NyTallRank == '11' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Gudfar";
                }

                elseif($NyTallRank == '12' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Leg.Gudfar";
                }

                elseif($NyTallRank == '13' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Don";
                }

                elseif($NyTallRank == '14' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Leg.Don";
                }

                elseif($NyTallRank == '15' && $kjoonn == 'Gutt')
                {
                    $RankNavn = "Capo Crimini";
                }

                elseif($NyTallRank == '2' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Luremus";
                }

                elseif($NyTallRank == '3' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Forførerske";
                }

                elseif($NyTallRank == '4' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Kriminell";
                }

                elseif($NyTallRank == '5' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Gangsterinne";
                }

                elseif($NyTallRank == '6' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Attentatdame";
                }

                elseif($NyTallRank == '7' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Morderske";
                }

                elseif($NyTallRank == '8' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Kaptein";
                }

                elseif($NyTallRank == '9' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Baronesse";
                }

                elseif($NyTallRank == '10' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Sjef";
                }

                elseif($NyTallRank == '11' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Gudmor";
                }

                elseif($NyTallRank == '12' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Leg.Gudmor";
                }

                elseif($NyTallRank == '13' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Grevinne";
                }

                elseif($NyTallRank == '14' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Herskerinne";
                }

                elseif($NyTallRank == '15' && $kjoonn == 'Jente')
                {
                    $RankNavn = "Capo Crimini";
                }

                $RankMeld = "Gratulerer du har blitt $RankNavn, som gratulasjon har vi plassert $Gave bombechips på din bruker.";
              
                mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Ny rank','$RankMeld','Ja')");
              
                mysql_query("INSERT INTO NyRank (Brukernavn, TallRank, Timestamp, Dato, Gave, RankNavn) VALUES ('$brukernavn','$NyTallRank','$Timestamp','$FullDato','$Gave','$RankNavn')");
                mysql_query("UPDATE brukere SET rank='$RankNavn',rank_nivaa='$NyTallRank',bombechips='$NySumchips',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
            }

        }

    }

    // Sjekk om du er der
    
    function Fengsel()
    {
        global $brukernavn, $Timestamp, $FullDato, $land;
      
        $F = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$brukernavn' AND $Timestamp > timestamp_over");
        
        if (mysql_num_rows($F) > 0)
        {
            mysql_query("DELETE FROM fengsel WHERE brukernavn='$brukernavn'");
          
            mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Sluppet fri','Du slapp ut av fengslet i $land','Ja')");
        }

    }

    

// -- Function Name : Sykehus
// -- Params : 
// -- Purpose : 
    function Sykehus()
    {
        global $brukernavn, $Timestamp, $liv, $Aktiv, $FullDato;
      
        $S = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute < $Timestamp");
        
        if (mysql_num_rows($S) > '0')
        {
            $I = mysql_fetch_assoc($S);
            $LivOpp = $I['antall_liv_opp'];
            $NyttLiv = $liv + $LivOpp;
            
            if($NyttLiv > '100')
            {
                $NyttLiv = '100';
            }
            else
            {
                $NyttLiv = floor($NyttLiv);
            }

          
            mysql_query("DELETE FROM sykehus WHERE brukernavn='$brukernavn'");
          
            mysql_query("UPDATE brukere SET liv='$NyttLiv',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
          
            mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Sykehus info','Behandlingen på sykehuset er nå over.','Ja')");
        }

    }

    

// -- Function Name : PlantasjeUlykke
// -- Params : 
// -- Purpose : 
    function PlantasjeUlykke()
    {
        global $brukernavn, $Timestamp, $FullDato;
      
        $P = mysql_query("SELECT * FROM plantasje WHERE brukernavn='$brukernavn' AND skade_kommer < '$Timestamp'");
        
        if (mysql_num_rows($P) >= '1')
        {
            $I = mysql_fetch_assoc($P);
            
            if($I['Tomt'] >= '10' && $I['Sysselsatte'] >= '10')
            {
                $DoAntall = rand (1, 8);
                $NyeArbeidere = $I['Sysselsatte'] - $DoAntall;
                $NySkade = $Timestamp + '280000';
                $Tekst = "Det skjedde en ulykke på plantasjen din, $DoAntall av dine arbeidere døde i ulykken.";
              
                mysql_query("UPDATE plantasje SET Sysselsatte='$NyeArbeidere',skade_kommer='$NySkade' WHERE brukernavn='$brukernavn'");
              
                mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Plantasje ulykke','$Tekst','Ja')");
            }

        }

    }
    

// -- Function Name : Kidnapping
// -- Params : 
// -- Purpose : 
    function Kidnapping()
    {
        global $brukernavn, $FullDato, $Timestamp;
      
        $KiddEn = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn' AND politi_finner < $Timestamp");
        $KiddTo = mysql_query("SELECT * FROM kidnapping WHERE kidnappers_navn='$brukernavn' AND politi_finner < $Timestamp");
        
        if(mysql_num_rows($KiddEn) > '0')
        {
            $I = mysql_fetch_assoc($KiddEn);
            $Bruker = $I['kidnappers_navn'];
          
            mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Bruker','$Timestamp','$FullDato','Sluppet fri','Politiet fant ut hvor personen du har kidnappet befant seg og de slapp han fri.','Ja')");
            mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Sluppet fri','Du er nå sluppet fri, politiet fant deg.','Ja')");
          
            mysql_query("DELETE FROM kidnapping WHERE offer='$brukernavn'");
        }

        elseif(mysql_num_rows($KiddTo) > '0')
        {
            $I = mysql_fetch_assoc($KiddTo);
            $Bruker = $I['offer'];
          
            mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Bruker','$Timestamp','$FullDato','Sluppet fri','Du er nå sluppet fri, politiet fant deg.','Ja')");
            mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Sluppet fri','Politiet fant ut hvor personen du har kidnappet befant seg og de slapp han fri.','Ja')");
          
            mysql_query("DELETE FROM kidnapping WHERE kidnappers_navn='$brukernavn'");
        }

    }

    

// -- Function Name : BottFengsel
// -- Params : 
// -- Purpose : 
    function BottFengsel()
    {
        global $land, $Timestamp;
        $RandNavn = array("Jake the ripper","Luigi Scarface","Steady Gun Gina","Crime Valentina","Tokuyoshi","Poofhead","Vic Gazebo","Skipppi Sherbert","Carlito Ciabetta","Gooblecute","Kinmatsu");
        $RandNavn = $RandNavn[array_rand($RandNavn)];
        $Straff = $Timestamp + '180';
      
        $F = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$RandNavn'");
        
        if(mysql_num_rows($F) == '0')
        {
            mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$RandNavn','Ran','3','3000000','$Straff','$Timestamp','$land')");
        }
        else
        {
            $I = mysql_fetch_assoc($F);
            $ID = $I['id'];
            
            if($I['timestamp_over'] < $Timestamp)
            {
                mysql_query("DELETE FROM fengsel WHERE id='$ID'");
            }

        }

    }

    

// -- Function Name : Horehus
// -- Params : 
// -- Purpose : 
    function Horehus()
    {
        global $Timestamp, $brukernavn, $FullDato, $tiden;
      
        $Info = mysql_query("SELECT * FROM Horehus_Knull WHERE Knull_stamp_over < '$Timestamp' AND Knull_brukernavn LIKE '$brukernavn' or Knull_hore LIKE '$brukernavn' AND Knull_stamp_over < '$Timestamp'");
        
        if(mysql_num_rows($Info) >= '1')
        {
            $I = mysql_fetch_assoc($Info);
            $HorehusID = $I['Knull_horehus_id'];
            $DatoStartet = $I['Knull_dato'];
            $StampStartet = $I['Knull_stamp'];
            $StampOver = $I['Knull_stamp_over'];
            $Stilling = $I['Knull_stilling'];
            $Behandling = $I['Knull_behandling'];
            $PengeSum = $I['Knull_sum'];
            $PersEn = $I['Knull_brukernavn'];
            $PersTo = $I['Knull_hore'];
            $SexLengde = ( $StampOver - $StampStartet ) / '60';
            $GirBort = mysql_query("SELECT * FROM brukere WHERE brukernavn='$PersEn'");
            $TarImot = mysql_query("SELECT * FROM brukere WHERE brukernavn='$PersTo'");
            $Gir = mysql_fetch_assoc($GirBort);
            $Tar = mysql_fetch_assoc($TarImot);
            
            if($Behandling == 'Bondage')
            {
                include "Annensider/Hor_bondage.php";
            }

            elseif($Behandling == 'Vennelig')
            {
                include "Annensider/Hor_vanlig.php";
            }

            elseif($Behandling == 'Voldtekt')
            {
                include "Annensider/Hor_voldtekt.php";
            }

        }
        else
        {
            $Hor = mysql_query("SELECT * FROM Horehus WHERE Bang_hore_er LIKE '$brukernavn' AND Bang_stamp_over < '$Timestamp'");
            
            if(mysql_num_rows($Hor) >= '1')
            {
                mysql_query("DELETE FROM Horehus WHERE Bang_hore_er='$brukernavn'");
              
                mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Arbeid over','Ditt arbeid som hore på strøktet er over.','Ja')");
            }

        }

    }

    // Tider
    
    function RegnTid($Sek)
    {
        
        if($Sek < '1')
        {
            return "NULL";
        }
        else
        {
            $Dager = floor(((($Sek / 60) / 60) / 24));
            $En = ((($Dager * 60) * 60) * 24);
            $Timer = floor(((($Sek - $En) / 60) / 60));
            $To = ((($Timer * 60) * 60) + $En);
            $Minutter = floor((($Sek - $To) / 60));
            $Tre = (($Minutter * 60) + $To);
            $Sekunder = floor($Sek - $Tre);
            $Tid = "";
            
            if($Dager > '0')
            {
                $Tid = $Dager . " d ";
            }

            
            if($Timer > '0')
            {
                $Tid = $Tid . $Timer . " t ";
            }

            
            if($Minutter > '0')
            {
                $Tid = $Tid . $Minutter . " m ";
            }

            
            if($Sekunder > '0')
            {
                $Tid = $Tid . $Sekunder . " s ";
            }

            return $Tid;
        }

    }

    // Krypering
    
    function Krypt_MD5($Var)
    {
        $Var = md5(md5(md5($Var)."abc")."DetVarEnGang9853721");
        return $Var;
    }

    

// -- Function Name : Krypt_Tall
// -- Params : $Var
// -- Purpose : 
    function Krypt_Tall($Var)
    {
        $Var = ($Var * 2416);
        $Tall = array('/0/','/1/','/2/','/3/','/4/','/5/','/6/','/7/','/8/','/9/');
        $Bokstaver = array('A','a','B','b','C','c','D','d','E','e');
        $Var = preg_replace ($Tall, $Bokstaver, $Var);
        return $Var;
    }

    

// -- Function Name : Dekrypt_Tall
// -- Params : $Var
// -- Purpose : 
    function Dekrypt_Tall($Var)
    {
        $Tall = array('0','1','2','3','4','5','6','7','8','9');
        $Bokstaver = array('/A/','/a/','/B/','/b/','/C/','/c/','/D/','/d/','/E/','/e/');
        $Var = preg_replace ($Bokstaver, $Tall, $Var);
        $Var = ($Var / 2416);
        return $Var;
    }

    

// -- Function Name : Krypt_Alt
// -- Params : $Var
// -- Purpose : 
    function Krypt_Alt($Var)
    {
        $Var = base64_encode(base64_encode(base64_encode($Var)));
        return $Var;
    }

    

// -- Function Name : Dekrypt_Alt
// -- Params : $Var
// -- Purpose : 
    function Dekrypt_Alt($Var)
    {
        $Var = base64_decode(base64_decode(base64_decode($Var)));
        return $Var;
    }

    // Sjekk variabler
    
    function Sjekk_En($Variabel,$Minimum,$Max,$Type,$Felt)
    {
        $Variabel = Fiks_Space($Variabel);
        
        if($Type == 'B')
        {
            $Variabel = Bare_Bokstaver($Variabel);
        }

        elseif($Type == 'S')
        {
            $Variabel = Bare_Siffer($Variabel);
        }

        elseif($Type == 'BS')
        {
            $Variabel = Bare_BS($Variabel);
        }

        elseif($Type == 'A')
        {
            $Variabel = $Variabel;
        }

        
        if(empty($Variabel))
        {
            $Tilbakemelding = $Felt.": Mangler tekst.";
        }
        else
        {
            
            if(strlen($Variabel) < $Minimum)
            {
                $Tilbakemelding = $Felt.": Inneholder for få tegn.";
            }
            else
            {
                
                if(strlen($Variabel) > $Max)
                {
                    $Tilbakemelding = $Felt.": Inneholder for mange tegn.";
                }
                else
                {
                    $Tilbakemelding = "Bra";
                }

            }

        }

        return $Tilbakemelding;
    }

    // Sjekk USER AGENT og REMOTE ADDR
    
    function Sjekk_agent($Ip,$Nett)
    {
        $RemoteADDR = md5($_SERVER['REMOTE_ADDR']);
        $HttpAGENT = md5($_SERVER['HTTP_USER_AGENT']);
        
        if($Ip == $RemoteADDR && $Nett == $HttpAGENT)
        {
            return 1;
        }
        else
        {
            return 2;
        }

    }

    // Hent url
    
    function curPageURL()
    {
        $pageURL = 'http';
        
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'  || $_SERVER['SERVER_PORT'] == 443)
        {
            $pageURL .= "s";
        }

        $pageURL .= "://";
        
        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }

        return $pageURL;
    }

    $Url = curPageURL();
    // Loggføring
    
    function Logg_Aktivitet($aktivitet)
    {
        global $Timestamp, $Klokke, $Dato, $Nbsp, $Aktiv, $FullDato, $brukernavn, $Url;
      
        mysql_query("INSERT INTO brukerLogg (bruker,dato,stamp,url,aktivitet) VALUES ('$brukernavn','$FullDato','$Timestamp','$Url','$aktivitet')");
    }

    // Del inn i sider
    
    function AntallSider($Tall)
    {
        $Tall = Bare_Siffer(Mysql_Klar($Tall));
        
        if(empty($Tall))
        {
            $Tall = '0';
        }

        elseif($Tall > '1')
        {
            $Tall = $Tall - '1';
        }

        return $Tall;
    }

    

// -- Function Name : VisSideListe
// -- Params : $Tall,$Side
// -- Purpose : 
    function VisSideListe($Tall='1',$Side='1')
    {
        $Antall = $Tall / '20';
        $Sider = '0';
        
        if($Antall > '1')
        {
            $i = '0';
            $Sider = "";
            while ($i <= $Antall)
            {
                $i++;
                $Asider = '20' * $i;
                $Asider = $Asider - '20';
                
                if($i < '10')
                {
                    $ekstra = '0';
                }
                else
                {
                    $ekstra = '';
                }

                $Sider = $Sider.'&nbsp;&nbsp;<a href="game.php?side='.$Side.'&s='.$Asider.'">['.$ekstra.''.$i.']</a>';
                
                if($i == '15' || $i == '30' || $i == '45' || $i == '60' || $i == '75' || $i == '90')
                {
                    $Sider = $Sider.'<br>';
                }

                
                if($i == '99')
                {
                    break;
                }

            }

            $Sider = '<div class="Div_MELDING">'.$Sider.'</div>';
        }

        return $Sider;
    }

    

// -- Function Name : VisSideListeTo
// -- Params : $Tall,$Side,$Type
// -- Purpose : 
    function VisSideListeTo($Tall,$Side,$Type)
    {
        $Antall = $Tall / '20';
        
        if($Antall > '1')
        {
            $i = '0';
            $Sider = "";
            while ($i <= $Antall)
            {
                $i++;
                $Asider = '20' * $i;
                $Asider = $Asider - '20';
                
                if($i < '10')
                {
                    $ekstra = '0';
                }
                else
                {
                    $ekstra = '';
                }

                $Sider = $Sider.'<a href="game.php?side='.$Side.'&'.$Type.'='.$Asider.'">['.$ekstra.''.$i.']</a>&nbsp;&nbsp;';
                
                if($i == '8' || $i == '16' || $i == '24' || $i == '32' || $i == '40' || $i == '48' || $i == '56' ||  $i == '64' ||  $i == '72' ||  $i == '80' ||  $i == '88' ||  $i == '96')
                {
                    $Sider = $Sider.'<br>';
                }

                
                if($i == '99')
                {
                    break;
                }

            }

            $Sider = '<tr><td class="R_9" colspan="2"><span class="T_3">'.$Sider.'</span></td></tr>';
        }

        return $Sider;
    }
    ?>
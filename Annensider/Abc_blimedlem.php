 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <?php
 if(empty($DIN_SUBMIT_KNAPP)) { header("Location: index.php"); } else { 
 
 // Funksjoner
 function ValidateEmail($var) { if (filter_var($var, FILTER_VALIDATE_EMAIL)) { return 1; } else { return 1; } //  (preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$/i", $var)) {return 1; } else { return 0; }
 }
 
        function geoCheckIP($ip) {
        if(!filter_var($ip, FILTER_VALIDATE_IP)) { throw new InvalidArgumentException("IP is not valid"); }
        $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
        if(empty($response)) { throw new InvalidArgumentException("Error contacting Geo-IP-Server"); }
        $Domene = preg_match('#Domain: (.*?)&nbsp;#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        $Land = preg_match('#Country: (.*?)&nbsp;#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        $Fylke = preg_match('#State/Region: (.*?)<br#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        $Byen = preg_match('#City: (.*?)<br#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        return "$Domene<br>$Land > $Fylke > $Byen";
        }

 function getBrowser($Agent) { 
 $u_agent = $Agent; $bname = 'Unknown'; $platform = 'Unknown'; $version= "";
 if(preg_match('/linux/i', $u_agent)) { $platform = 'linux'; }
 elseif(preg_match('/macintosh|mac os x/i', $u_agent)) { $platform = 'mac'; }
 elseif(preg_match('/windows|win32/i', $u_agent)) { $platform = 'windows'; }
 if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { $bname = 'Internet Explorer'; $ub = "MSIE"; }
 elseif(preg_match('/Firefox/i',$u_agent)) { $bname = 'Mozilla Firefox'; $ub = "Firefox"; }
 elseif(preg_match('/Chrome/i',$u_agent)) { $bname = 'Google Chrome'; $ub = "Chrome"; }
 elseif(preg_match('/Safari/i',$u_agent)) { $bname = 'Apple Safari'; $ub = "Safari"; }
 elseif(preg_match('/Opera/i',$u_agent)) { $bname = 'Opera'; $ub = "Opera"; }
 elseif(preg_match('/Netscape/i',$u_agent)) { $bname = 'Netscape'; $ub = "Netscape"; }
 $known = array('Version', $ub, 'other');
 $pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
 if (!preg_match_all($pattern, $u_agent, $matches)) { }
 $i = count($matches['browser']);
 if($i != 1) { if(strripos($u_agent,"Version") < strripos($u_agent,$ub)){ $version= $matches['version'][0]; } else { $version= $matches['version'][1]; }}
 else { $version= $matches['version'][0]; }
 if($version==null || $version=="") {$version="?";}
 $Brow = "$platform > $bname $version";
 return $Brow;
 }

 echo "<div class=\"Div_masta\"><form method=\"post\" id=\"$DIN_SUBMIT_KNAPP\"><div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Bli medlem</span></div><div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/blimedlem.jpg\"></div>";
 
 // Antibott
 $IdForumstart = $_SESSION['IdForumstart'];    
 
 $HentBott = mysql_query("SELECT * FROM AntibottEn WHERE id LIKE '%' ORDER BY RAND() LIMIT 1") or die(mysql_error());
 $Antibott = mysql_fetch_assoc($HentBott);
 $_SESSION['IdForumstart'] = $Antibott['id'];
  $IdForumstart = $_SESSION['IdForumstart'];   

 // Antibott
 
 // Aktiver bruker
 $Kode = Mysql_Klar($_REQUEST['Kode']);
 $BrukerID = Bare_Siffer(Mysql_Klar($_REQUEST['Koden']));
 if(!empty($Kode) && !empty($BrukerID)) { 
 $Eks = mysql_query("SELECT * FROM brukere WHERE brukerid='$BrukerID' AND passord='$Kode' AND aktivert='0'");
 if(mysql_num_rows($Eks) == '0') { echo PrintTeksten("Brukeren er allerede aktivert.","1","Feilet"); } else { 
 mysql_query("UPDATE brukere SET aktivert='1' WHERE brukerid='$BrukerID' AND passord='$Kode'");
 echo PrintTeksten("Brukeren er aktivert.","1","Vellykket");
 }}

 // Bli medlem
 if(isset($_POST['brukernavn'])) { 
     
 
 $Ip = $_SERVER['REMOTE_ADDR'];
 $Bannlyst = mysql_query("SELECT * FROM IpBan WHERE IpAdresse='$Ip' AND Tidslengde > '$tiden'");    
 if(mysql_num_rows($Bannlyst) >= '1') { echo PrintTeksten("Ip adressen er bannlyst.","1","Feilet"); } else { 
 
 $Bruker = Fiks_Space(Bare_BS(Mysql_Klar($_POST['brukernavn'])));
 $Email = mysql_real_escape_string($_POST['email']);
 $Postnummer = Bare_BS(Mysql_Klar($_POST['postnummer']));
 $Passord = mysql_real_escape_string($_POST['passordet']);
 $Kjon = Mysql_Klar($_POST['kjoon']);
 $Regler = Mysql_Klar($_POST['Godtar_regler']);
 $Svar = strtolower(mysql_real_escape_string($_POST['svar']));
 $Invitert = Mysql_Klar($_REQUEST['av']);
 
 // Sjekk om du er invitert
 
 if(empty($Invitert)) { $Invitert = 'Ingen&ingeN'; } else {
 $Sjekk = mysql_query("SELECT * FROM brukere WHERE brukerid LIKE '$Invitert'");
 if(mysql_num_rows($Sjekk) == '0') { $Invitert = 'Ingen&ingeN'; } else { 
 $Inv = mysql_fetch_assoc($Sjekk);
 $Invitert = $Inv['brukernavn'];
 }}
 
 if(empty($Svar)) { echo PrintTeksten("Antibott svar mangler.","1","Feilet"); }
 elseif(empty($IdForumstart)) { echo PrintTeksten("En feil oppstod, prøv igjen.","1","Feilet"); } else { 
 
 
 $SjekkSvar = mysql_query("SELECT * FROM AntibottEn WHERE id='$IdForumstart'");
 if(mysql_num_rows($SjekkSvar) == '0') { echo PrintTeksten("En feil oppstod, prøv igjen.","1","Feilet"); } else { 
 $BotSvar = mysql_fetch_assoc($SjekkSvar);
 $RiktigSvar = strtolower($BotSvar['Svar']);
 if($Svar != $RiktigSvar) { echo PrintTeksten("Feil antibott svar, riktig svar var $RiktigSvar.","1","Feilet"); } else { 
 if(empty($_POST['brukernavn']) || empty($_POST['email']) || empty($_POST['postnummer']) || empty($_POST['kjoon']) || empty($_POST['Godtar_regler']) || empty($_POST['passordet'])) { 
 echo '<div class="Div_MELDING">';
 if(empty($_POST['Godtar_regler'])) { echo '<span class="Span_str_5">Du har ikke godtatt reglene.</span>'; } 
 if(empty($_POST['brukernavn'])) { echo '<span class="Span_str_5">Du har glemt å fylle inn brukernavn feltet.</span>'; } 
 if(empty($_POST['email'])) { echo '<span class="Span_str_5">Du har glemt å fylle inn epost feltet.</span>'; } 
 if(empty($_POST['postnummer'])) { echo '<span class="Span_str_5">Du har glemt å fylle inn postnummer feltet.</span>'; } 
 if(empty($_POST['passordet'])) { echo '<span class="Span_str_5">Du har glemt å fylle inn passordet ditt.</span>'; } 
 if(empty($_POST['kjoon'])) { echo '<span class="Span_str_5">Du har glemt å velge hvilket kjøn du er.</span>'; } 
 echo '</div>';
 } else {
 if($Kjon == 'Gutt' || $Kjon == 'Jente') { 
 if(ValidateEmail($Email) == '1') {  
 
 // Sjekk om diverse ting
 
 $EmailSkj = mysql_query("SELECT email FROM brukere WHERE email='$Email' AND liv > '0'");
 $BrukerSkj = mysql_query("SELECT brukernavn FROM brukere WHERE brukernavn='$Bruker'");
 $BostedSkj = mysql_query("SELECT * FROM postnr WHERE postnummer='$Postnummer'");
 
 if(mysql_num_rows($EmailSkj) > '0') { echo PrintTeksten("Epost adressen er registrert på en levende bruker.","1","Feilet"); } 
 elseif(mysql_num_rows($BrukerSkj) > '0') { echo PrintTeksten("Brukernavnet er alt ibruk.","1","Feilet"); }
 elseif(mysql_num_rows($BostedSkj) == '0') { echo PrintTeksten("Postnummeret eksisterer ikke.","1","Feilet"); } else { 
 $Adress = mysql_fetch_assoc($BostedSkj);
 $Postnummer = $Adress['kommune'];
 $Pass = md5($Passord);

 mysql_query("INSERT INTO brukere (brukernavn,passord,email,land,regtid,ip,bosted_i_norge,regtid_stamp,Kjon,InvitertAv) VALUES('$Bruker','$Pass','$Email','Hamar','$tid $nbsp $dato','$Ip','$Postnummer','$Timestamp','$Kjon','$Invitert')") or die (mysql_error());
 
 // Session variabler
 $S_Id = session_id();
 $S_Nett = $_SERVER['HTTP_USER_AGENT'];
 $_SESSION['bruker_SES'] = $Bruker;
 $_SESSION['pass_SES'] = $Pass;
 $_SESSION['id_SES'] = $S_Id;
 $_SESSION['ip_SES'] = md5($Ip);
 $_SESSION['nett_SES'] = md5($S_Nett);
 
 $Stedet = mysql_real_escape_string(geoCheckIP($_SERVER['REMOTE_ADDR']));
 $Nettet = mysql_real_escape_string(getBrowser($_SERVER['HTTP_USER_AGENT']));

 mysql_query("UPDATE brukere SET sistinne='$AnnenDato',ip='$Ip',timestamp_inne='$Timestamp',aktiv_eller='$Aktiv',logg_in_id='$S_Id' WHERE brukernavn='$Bruker'");
 
 mysql_query("INSERT INTO Ip_logg (bruker,ip_brukt_nett,dato,nettleser,timestampen,Stedet) VALUES('$Bruker','$Ip','$AnnenDato','$Nettet','$Timestamp','$Stedet')") or die (mysql_error());
 
 mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Havers','$Bruker','$Timestamp','$FullDato','Informasjon','Velkommen som spiller på MafiaNo, din bruker er trygg i 83 timer fra registrert tid, etter det kan hvem som helst drepe deg, anbefaler og bruke bunkerfunksjonen for å ungå å bli drept i drapstiden som er fra 21.00 til 22.00 hver dag.','Nei')"); 
 Header("Location: game.php");
 
 }} else { echo PrintTeksten("Ugyldig epost adresse.","1","Feilet"); }
 } else { echo PrintTeksten("Ugyldig kjønn.","1","Feilet"); }
 }}}}}}

 if(empty($Bruker)) { $brukernavnet_VISES = ''; } else { $brukernavnet_VISES = $Bruker; }
 if(empty($Email)) { $email_VISES = ''; } else { $email_VISES = $Email; }
 if(empty($Postnummer)) { $post_VISES = ''; } else { $post_VISES = $_POST['postnummer']; }
 if(empty($Passord)) { $passord_VISES = ''; } else { $passord_VISES = $Passord; }
 if(empty($Kjon)) { $kjon_VISES = '<option>Gutt</option><option>Jente</option>'; } else { if($Kjon == 'Gutt') { $kjon_VISES = '<option selected>Gutt</option><option>Jente</option>'; } else { $kjon_VISES = '<option>Gutt</option><option selected>Jente</option>'; }}
 
 echo "<div class=\"Div_MELDING\"><span class=\"Span_str_0\">Opplysninger og regler</span><br><span class=\"Span_str_8\">Før registrering er du pliktig til å lese <a target=\"_blank\" href=\"http://www.mafiano.no/Regelverk.txt\"><b>regelverket</b></a>. Om du ønsker å spille MafiaNo må du følge alle reglene.</span><span class=\"Span_str_0\"><input type=\"checkbox\" name=\"Godtar_regler\" tabindex=\"1\" value=\"Ja\"> Ved klikk godtar du alle regler.</span></div>";
 
 if(empty($Antibott['Bilde']) || $Antibott['Bilde'] == 'Skriv url til et bilde hvis du skal stille spørsmål til et bilde.') { echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott</span></div><div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$Antibott['Sporsmol']."</span></div><div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott svar</span></div><div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"svar\" maxlength=\"30\" value=\"\"></div>"; } else { echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott</span></div><div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$Antibott['Sporsmol']."</span></div><div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bilde</span></div><div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a target=\"_blank\" href=\"".$Antibott['Bilde']."\">Klikk her for å se bilde</a></span></div><div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott svar</span></div><div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"svar\" maxlength=\"30\" value=\"\"></div>"; }
 
 echo "
 <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
 <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"brukernavn\" maxlength=\"20\" value=\"$brukernavnet_VISES\"></div>
 <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">E-Post adresse</span></div>
 <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"email\" maxlength=\"100\" value=\"$email_VISES\"></div>
 <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Post nummer</span></div>
 <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"postnummer\" maxlength=\"4\" onKeyPress=\"return numbersonly(this, event)\" value=\"$post_VISES\"></div>
 <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Passord</span></div>
 <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"passordet\" value=\"$passord_VISES\"></div>
 <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Kjønn</span></div>
 <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"kjoon\">$kjon_VISES</select></div>
 <div class=\"Div_venstre_side_1\">&nbsp;</div>
 <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('$DIN_SUBMIT_KNAPP').submit()\"><p class=\"pan_str_2\">REGISTRER DEG</p></div>
 </form></div>";
 
 }
 ?>
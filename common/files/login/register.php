<?php

date_default_timezone_set('Europe/Oslo');

if(!defined('view') or isset($_SESSION['id'])) { $output .= $noaccess; } else {

    // Temporary store functions

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



       $output .= '<div class="content"><div class="heading">Registrer deg</div>
    <div class="image"><img src="/common/gfx/function_images/register.png"></div>';



        if(isset($_POST['register']))      {
            if(isset($_POST['username']) || isset($_POST['email']) || isset($_POST['zipcode']) || isset($_POST['password']) || isset($_POST['repeat_password']) || isset($_POST['sex']))    {
                if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['zipcode']) && !empty($_POST['password']) && !empty($_POST['repeat_password']) && !empty($_POST['sex']))  {
                    if($_POST['sex'] == 'Gutt' OR $_POST['sex'] == 'Jente')    {

                        // Check if user is invited
                        if(isset($_GET['av']))  {
                            $check_if_invited_user_exist = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:userid");
                            $check_if_invited_user_exist->bindValue(':userid', $_GET['av']);
                            $check_if_invited_user_exist->execute();

                            if($check_if_invited_user_exist->rowCount() > 0)    {
                                $inviter_user = $check_if_invited_user_exist->fetch();
                                $invited_by = $inviter_user['brukernavn'];
                            } else {
                                $invited_by = 'Ingen&IngeN';
                            }
                        } else {
                            $invited_by = 'Ingen&IngeN';
                        }



                        // Continue registration

                        // check if username is taken
                        $check_username = $db->prepare("SELECT * FROM `brukere` WHERE `brukernavn`=:username");
                        $check_username->bindValue(':username', $_POST['username']);
                        $check_username->execute();

                        if($check_username->rowCount() < 1) {

                            // check if email is in use on a alive user

                            $check_email = $db->prepare("SELECT * FROM `brukere` WHERE `email`=:email AND `liv`>0");
                            $check_email->bindValue(':email', $_POST['email']);
                            $check_email->execute();

                            if($check_email->rowCount() < 1)    {

                                // Verify zip code

                                $check_zipcode = $db->prepare("SELECT * FROM `postnr` WHERE `postnummer`=:zipcode");
                                $check_zipcode->bindValue(':zipcode', $_POST['zipcode']);
                                $check_zipcode->execute();

                                if($check_zipcode->rowCount() > 0)  {

                                    if($_POST['password'] == $_POST['repeat_password']) {
                                        $zipcode = $check_zipcode->fetch();

                                        // Div
                                        $startcity = 'Hamar';

#                                        $create_user = $db->prepare("
#                            INSERT INTO brukere (`brukernavn`, `passord`, `email`, `land`, `regtid`, `ip`, `bosted_i_norge`, `regtid_stamp`, `Kjon`, `InvitertAv`, `sistinne`, `timestamp_inne`, `aktiv_eller`, `logg_in_id`, `vervet_av`) VALUES 
#                                            (:username, :password, :email, :startcity, :weirddate, :iplocation, :zipcode, :time, :sex, :invited_by, :sistinne, :timestamp_inne, :aktiv_eller, :logg_in_id, :vervet_av)");

					try {
					## Added 'user_verified' with value 1 to bypass SMS verification
                                        $create_user = $db->prepare("
                            INSERT INTO brukere (`brukernavn`, `passord`, `email`, `land`, `regtid`, `ip`, `bosted_i_norge`, `regtid_stamp`, `Kjon`, `InvitertAv`, `sistinne`, `timestamp_inne`, `aktiv_eller`, `logg_in_id`, `vervet_av`, `user_verified`) VALUES 
                                            (:username, :password, :email, :startcity, :weirddate, :iplocation, :zipcode, :time, :sex, :invited_by, :sistinne, :timestamp_inne, :aktiv_eller, :logg_in_id, :vervet_av, '1')");
                                        $create_user->bindValue(':username', $_POST['username']);
                                        $create_user->bindValue(':password', md5($_POST['password']));
                                        $create_user->bindValue(':email', $_POST['email']);
                                        $create_user->bindValue(':startcity', $startcity);
                                        $create_user->bindValue(':weirddate', date("H:i:s // d. M"));
                                        $create_user->bindValue(':iplocation', $_SERVER['REMOTE_ADDR']);
                                        $create_user->bindValue(':zipcode', $zipcode['kommune']);
                                        $create_user->bindValue(':time', time());
                                        $create_user->bindValue(':sex', $_POST['sex']);
                                        $create_user->bindValue(':invited_by', $invited_by);
                                        $create_user->bindValue(':sistinne', date("H:i:s // d. M // Y"));
                                        $create_user->bindValue(':timestamp_inne', time());
                                        $create_user->bindValue(':aktiv_eller', time() + 3600);
                                        $create_user->bindValue(':logg_in_id', session_id());
                                        $create_user->bindValue(':vervet_av', $invited_by);
                                        $create_user->execute();

					} catch (Exception $e) {
						echo "register.php: " . $e->getMessage();
						echo session_id();
					}


                                        $userid = $db->lastInsertId();

                                        $ip_log = $db->prepare("INSERT INTO `Ip_logg` (`bruker`, `ip_brukt_nett`, `dato`, `nettleser`, `timestampen`, `Stedet`) VALUES
                                            (:username, :ip, :annendato, :nettet, :timestamp, :stedet)");
                                        $ip_log->bindValue(':username', $_POST['username']);
                                        $ip_log->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
                                        $ip_log->bindValue(':annendato', date("H:i:s d. M Y"));
                                        $ip_log->bindValue(':nettet', $_SERVER['HTTP_USER_AGENT']);
                                        $ip_log->bindValue(':timestamp', time());
                                        $ip_log->bindValue(':stedet', $_SERVER['HTTP_USER_AGENT']);
                                        $ip_log->execute();



                                        $pm_title = 'Informasjon';
                                        $pm_message = 'Velkommen som spiller på MafiaNo, din bruker er trygg i 83 timer fra registrert tid, etter det kan hvem som helst drepe deg, vi anbefaler å bruke bunkerfunksjonen for å unngå å bli drept i drapstiden som er fra 21.00 til 22.00 hver dag.';


                                        $send_pm = $db->prepare("INSERT INTO `pm_system` (`fra_bruker`, `til_bruker`, `timestampen`, `dato_sendt`, `tittel`, `melding`, `fra_game_ell`) VALUES ('Havers', :username, :timestamp, :date_sent, :title, :message, 'Nei')");
                                        $send_pm->bindValue(':username', $_POST['username']);
                                        $send_pm->bindValue(':timestamp', time());
                                        $send_pm->bindValue(':date_sent', date("H:i:s d.m.y"));
                                        $send_pm->bindValue(':title', $pm_title);
                                        $send_pm->bindValue(':message', $pm_message);
                                        $send_pm->execute();


                                         // Session variabler
                                        $_SESSION['bruker_SES'] = $_POST['username'];
                                        $_SESSION['pass_SES'] = md5($_POST['password']);
                                        $_SESSION['id_SES'] = session_id();
                                        $_SESSION['ip_SES'] = md5($_SERVER['REMOTE_ADDR']);
                                        $_SESSION['nett_SES'] = md5($_SERVER['HTTP_USER_AGENT']);

                                        // Use this
                                        $_SESSION['id'] = $userid;

                                        Header("Location: game.php");

                                        $output .= '<div class="response_success">Du har opprettet en bruker. Blir du ikke logget inn, logg inn selv.</div>';

                                    } else {
                                        $output .= '<div class="response">Begge passordene må matche.</div>';
                                    }

                                } else {
                                    $output .= '<div class="response">Postnummeret du har oppgitt finnes ikke.</div>';
                                }
                            } else {
                                $output .= '<div class="response">Denne e-posten brukes allerede på en bruker som er i live. Har du glemt passordet ditt kan du trykke på glemt passord.</div>';
                            }
                        } else {
                            $output .= '<div class="response">Dette brukernavnet er allerede tatt av noen andre.</div>';
                        }
                    } else {
                        $output .= '<div class="response">Du gjorde noe dumt.</div>';
                    }
                } else {
                    $output .= '<div class="response">Du må fylle ut alle felt.</div>';
                }
            } else {
                $output .= '<div class="response">Du gjorde noe dumt.</div>';
            }
        }

        $output .= '
        <div class="form">
        <form method="POST" action="">
        <div class="text">Ved å registrere deg på MafiaNo aksepterer du alle våre <a href="/system/vilkar_og_betingelser">vilkår og betingelser</a>.</div>

        <div class="left">Ønsket brukernavn</div>
        <div class="right"><input type="text" name="username" value=""></div>
        <div class="clear"></div>

        <div class="left">E-post</div>
        <div class="right"><input type="text" name="email" value=""></div>
        <div class="clear"></div>

        <div class="left">Postnummer</div>
        <div class="right"><input type="text" name="zipcode" value="" maxlength="4"></div>
        <div class="clear"></div>

        <div class="left">Passord</div>
        <div class="right"><input type="password" name="password"></div>
        <div class="clear"></div>

        <div class="left">Gjenta passord</div>
        <div class="right"><input type="password" name="repeat_password"></div>
        <div class="clear"></div>

        <div class="left">Kjønn</div>
        <div class="right"><select name="sex"><option value="Gutt">Mann</option><option value="Jente">Kvinne</option></select></div>
        <div class="clear"></div>

        <button name="register">Registrer deg</button>
        <div class="clear"></div>
        </form>
        </div>';

        $output .= '</div>';
}

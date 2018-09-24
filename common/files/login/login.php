<?php
if(!defined('view') or isset($_SESSION['id'])) { $output .= $noaccess; } else {

    // Temporary store two functions here

    function geoCheckIP($ip) {
        if(!filter_var($ip, FILTER_VALIDATE_IP)) { throw new InvalidArgumentException("IP is not valid"); }
        $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
        if(empty($response)) { /*throw new InvalidArgumentException("Error contacting Geo-IP-Server"); */ return 'Ingenting'; }
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



       $output .= '<div class="content"><div class="heading">Logg inn</div>
    <div class="image"><img src="/common/gfx/function_images/login.png"></div>';

    if(isset($_POST['login']))      {

        // Store old vars, no fucking idea why

        $user_id = $_SERVER['REMOTE_ADDR']; // Stored as $IP_2KA in old system
        $user_agent = $_SERVER['HTTP_USER_AGENT']; // Stored as $NETT_2KA in old system

        // Check if user is IP-banned

        $check_ban = $db->prepare("SELECT * FROM `IpBan` WHERE `IpAdresse`=:ipadress AND `Tidslengde` > :timelimit");
        $check_ban->bindValue(':ipadress', $_SERVER['REMOTE_ADDR']);
        $check_ban->bindValue(':timelimit', time());
        $check_ban->execute();

        if($check_ban->rowCount() > 0)  {
            $output .= '<div class="response">IP-adressen du bruker er utestengt.</div>';
        } else { // IP is not banned, continue
            if(isset($_POST['username']) || isset($_POST['password']))      {
                if(empty($_POST['username']) || empty($_POST['password']))      {
                        $output .= '<div class="response">Du må fylle ut både brukernavn og passord.</div>';;
                } else {
                    // Everything looks good; check if user exists
                    // Currently use md5 and be ashamed
                    $password = md5($_POST['password']);

                    $verify_user = $db->prepare("SELECT * FROM `brukere` WHERE `brukernavn`=:username AND `passord`=:password");
                    $verify_user->bindValue(':username', $_POST['username']);
                    $verify_user->bindValue(':password', md5($_POST['password']));
                    $verify_user->execute();

                    if($verify_user->rowCount() > 0)        {
                        // User exists, and password is correct

                        $tobe_userinfo = $verify_user->fetch();

                        if($tobe_userinfo['aktivert'] == '0')   {
                            $output .= '<div class="response">Denne brukeren er ikke aktivert.</div>';
                        } elseif($tobe_userinfo['liv'] < '1')   {
                                $output .= '<div class="response">Du har blitt drept.</div>';
                        } else {
                                // check if any punishment beeing served

                            $check_timepunishment = $db->prepare("SELECT * FROM `TidsStraff` WHERE `Straffes`=:username AND `StampOver` > :time");
                            $check_timepunishment->bindValue(':username', $tobe_userinfo['brukernavn']);
                            $check_timepunishment->bindValue(':time', time());
                            $check_timepunishment->execute();

                            if($check_timepunishment->rowCount() > 0)   {
                                $punishment_info = $check_timepunishment->fetch();
                                $output .= '<div class="response">Du soner for tiden en tidstraff. Straffen din er ferdig '.date('d. M Y, H:i', $punishment_info['StampOver'] - time()).'. Husk at det ikke er lov å opprette en ny bruker i mellomtiden.';
                            } else {
                                // Now everything looks good to go;


                                // Variables used by old system

                                $_SESSION['bruker_SES'] = $tobe_userinfo['brukernavn'];
                                $_SESSION['pass_SES'] = $tobe_userinfo['passord'];
                                $_SESSION['id_SES'] = session_id();
                                $_SESSION['ip_SES'] = md5($_SERVER['REMOTE_ADDR']);
                                $_SESSION['nett_SES'] = md5($_SERVER['HTTP_USER_AGENT']);

                                // Variables used by new

                                $_SESSION['id'] = $tobe_userinfo['brukerid'];

                                $update_user = $db->prepare("UPDATE `brukere` SET `sistinne`=:sistinne, `timestamp_inne`=:time_sistinne, `aktiv_eller`=:timepluss, `logg_in_id`=:session_id WHERE `brukernavn`=:username");
                                $update_user->bindValue(':sistinne', date("H:i:s // d. M"));
                                $update_user->bindValue(':time_sistinne', time());
                                $update_user->bindValue(':timepluss', time()+3600);
                                $update_user->bindValue(':session_id', session_id());
                                $update_user->bindValue(':username', $tobe_userinfo['brukernavn']);
                                $update_user->execute();

                                $insert_ip_log = $db->prepare("INSERT INTO `Ip_logg` (`bruker`, `ip_brukt_nett`, `dato`, `nettleser`, `timestampen`, `Stedet`) VALUES 
                                                                                        (:username, :ip, :weirddate, :browser, :time, :location)");
                                $insert_ip_log->bindValue(':username', $tobe_userinfo['brukernavn']);
                                $insert_ip_log->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
                                $insert_ip_log->bindValue(':weirddate', date("H:i:s // d. M"));
                                $insert_ip_log->bindValue(':browser', getBrowser($_SERVER['HTTP_USER_AGENT']));
                                $insert_ip_log->bindValue(':location', geoCheckIP($_SERVER['REMOTE_ADDR']));

                                header("Location: ./game.php");

                                $output .= '<div class="response_success">Gratulerer, du har logget inn.</div>';


                            }

                        }

                    } else {
                            $output .= '<div class="response">Ugyldig brukernavn eller passord.</div>';
                    }
                }
            } else {
                    $output .= '<div class="response">Det skjedde noe feil.</div>';
            }
        }
    }

        $output .= '
        <div class="form">
        <form method="POST" action="">
        <input type="hidden" name="CSRF_KEY" value="'.$_SESSION['CSRF_KEY'].'">

        <div class="left">Brukernavn</div>
        <div class="right"><input type="text" name="username" value=""></div>
        <div class="clear"></div>

        <div class="left">Passord</div>
        <div class="right"><input type="password" name="password"></div>
        <div class="clear"></div>

        <button name="login">Logg inn</button>
        <div class="clear"></div>
        </form>
        </div>';

        $output .= '</div>';
}
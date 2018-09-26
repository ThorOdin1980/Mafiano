<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style> .GaInnI { float: left; margin-left: 5px; margin-top: 5px; color:#FFFFFF; } .GaInnI:hover { font-weight:bold; cursor:pointer; } </style>
<?php
  if (empty($brukernavn)) { header("Location: index.php"); } else { 
  if($type == 'A' || $type == 'm') { 
  

  if(!isset($_POST['Poeng_P']))  { $_POST['Poeng_P'] = ''; }
  if(!isset($B_1)) { $B_1 = ''; }
  if(!isset($B_2)) { $B_2 = ''; }
  if(!isset($B_3)) { $B_3 = ''; }
  if(!isset($B_4)) { $B_4 = ''; }
  if(!isset($B_5)) { $B_5 = ''; }
  if(!isset($B_6)) { $B_6 = ''; }


  ?>
  <div class="Div_innledning" id="Div_innleding">
    <span class="Span_str_2">Generelt</span>
  </div>
  <form method="post" id="BrukerInfo">
    <input type="hidden" name="Alter" id="Alter" />
  <?php
  if(!isset($_POST['Alter'])) { $_POST['Alter'] = ''; }
  if($_POST['Alter'] == '1') { 
    $P_Email = mysql_real_escape_string($_POST['Epost_P']);
    $P_Bilde = mysql_real_escape_string($_POST['Profilbilde_P']);
    $P_Signa = mysql_real_escape_string($_POST['Signatur_P']);
    $P_Navne = mysql_real_escape_string($_POST['Navn_P']);
    $P_Passo = md5(mysql_real_escape_string($_POST['Passord_P']));
    $P_Passe = mysql_real_escape_string($_POST['Passord_P']);
    if($type == 'm' && $I['type'] == 'A') { 
      echo PrintTeksten("Redigering sperret.","1","Feilet");
    } else { 
      if($P_Email == $I['email'] && $P_Bilde == $I['profilbilde'] && $P_Signa == $I['signatur'] && $P_Navne == $I['navn'] && (empty($P_Passe) || $P_Passo == $I['passord'])) { 
        echo PrintTeksten("Ingen endringer utført.","1","Feilet");
      } else {
        if($P_Email == $I['email']) { $B_1 = ''; } else { $B_1 = ",email='$P_Email'"; $Tekst = $Tekst."<b>Epost adresse:</b> $P_Email.<br>"; }
        if($P_Bilde == $I['profilbilde']) { $B_2 = ''; } else { $B_2 = ",profilbilde='$P_Bilde'"; $Tekst = $Tekst."<b>Bilde url:</b> $P_Bilde.<br>"; }
        if($P_Signa == $I['signatur']) { $B_3 = ''; } else { $B_3 = ",signatur='$P_Signa'"; $Tekst = $Tekst."<b>Signatur url:</b> $P_Signa.<br>"; }
        if($P_Navne == $I['navn']) { $B_4 = ''; } else { $B_4 = ",navn='$P_Navne'"; $Tekst = $Tekst."<b>Navn:</b> $P_Navne.<br>"; }
        if($P_Passo == $I['passord'] || empty($P_Passe)) { $B_5 = ''; } else { $B_5 = ",passord='$P_Passo'"; $Tekst = $Tekst."<b>Passord:</b> $P_Passe.<br>"; }
        
          mysql_query("INSERT INTO `EndringsLogg` (EndretAv,EndretDato,EndretInfo,EndretHos,EndretStamp) VALUES ('$brukernavn','$FullDato','$Tekst','$I_Brukernavn','$Timestamp')");
        
          mysql_query("UPDATE brukere SET brukernavn='$I_Brukernavn' $B_1 $B_2 $B_3 $B_4 $B_5 WHERE brukernavn='$I_Brukernavn'");
          mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
          echo PrintTeksten("$Tekst","1","Vellykket");
      }
    }
  }

  elseif($_POST['Alter'] == '2') { 
    $P_Respekt = Bare_Siffer(Mysql_Klar($_POST['Respekt_P']));
    $P_Bombechips = Bare_Siffer(Mysql_Klar($_POST['Bombechips_P']));
    $P_Penger = Bare_Siffer(Mysql_Klar($_POST['Penger_P']));
    $P_Banken = Bare_Siffer(Mysql_Klar($_POST['Bank_P']));
    $P_Poeng = Bare_Siffer(Mysql_Klar($_POST['Poeng_P']));
    $P_Kuler = Bare_Siffer(Mysql_Klar($_POST['Kuler_P']));
    $Tekst = 'kr';
    
    if($type == 'm' && $I['type'] == 'A') { 
      echo PrintTeksten("Redigering sperret.","1","Feilet");
    } else { 
      if($P_Respekt == floor($I['respekt']) && $P_Bombechips == floor($I['bombechips']) && $P_Penger == floor($I['penger']) && $P_Banken == floor($I['bank']) && $P_Poeng == floor($I['turns']) && $P_Kuler == floor($I['kuler'])) { 
        echo PrintTeksten("Ingen endringer utført.","1","Feilet");
      } else { 
        if($P_Respekt == floor($I['respekt'])) { $B_1 = ''; } else {$B_1 = ",respekt='$P_Respekt'"; $Tekst = $Tekst."<b>Respekt:</b> fra ".VerdiSum(floor($I['respekt']),'stk')." til ".VerdiSum($P_Respekt,'stk').".<br>"; }
        if($P_Bombechips == floor($I['bombechips'])) { $B_2 = ''; } else { $B_2 = ",bombechips='$P_Bombechips'"; $Tekst = $Tekst."<b>Bombechips:</b> fra ".VerdiSum(floor($I['bombechips']),'stk')." til ".VerdiSum($P_Bombechips,'stk').".<br>"; }
        if($P_Penger == floor($I['penger'])) { $B_3 = ''; } else { $B_3 = ",penger='$P_Penger'"; $Tekst = $Tekst."<b>Penger:</b> fra ".VerdiSum(floor($I['penger']),'kr')." til ".VerdiSum($P_Penger,'kr').".<br>"; }
        if($P_Banken == floor($I['bank'])) { $B_4 = ''; } else { $B_4 = ",bank='$P_Banken'"; $Tekst = $Tekst."<b>Banken:</b> fra ".VerdiSum(floor($I['bank']),'kr')." til ".VerdiSum($P_Banken,'kr').".<br>"; }
        if($type == 'A') { if($P_Poeng == floor($I['turns'])) { $B_5 = ''; } else { $B_5 = ",turns='$P_Poeng'"; $Tekst = $Tekst."<b>Poeng:</b> fra ".VerdiSum(floor($I['turns']),'stk')." til ".VerdiSum($P_Poeng,'stk').".<br>"; }
        if($P_Kuler == floor($I['kuler'])) { $B_6 = ''; } else { $B_6 = ",kuler='$P_Kuler'"; $Tekst = $Tekst."<b>Kuler:</b> fra ".VerdiSum(floor($I['kuler']),'stk')." til ".VerdiSum($P_Kuler,'stk').".<br>"; }}
        
      
        mysql_query("INSERT INTO `EndringsLogg` (EndretAv,EndretDato,EndretInfo,EndretHos,EndretStamp) VALUES ('$brukernavn','$FullDato','$Tekst','$I_Brukernavn','$Timestamp')");
      
        mysql_query("UPDATE brukere SET brukernavn='$I_Brukernavn' $B_1 $B_2 $B_3 $B_4 $B_5 $B_6 WHERE brukernavn='$I_Brukernavn'");
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
        echo PrintTeksten("$Tekst","1","Vellykket");
      }
    }
  }
  elseif($_POST['Alter'] == '3') { 
  $P_Drap = Bare_Siffer(Mysql_Klar($_POST['Drap_P']));
  $P_Kid = Bare_Siffer(Mysql_Klar($_POST['Kidnappinger_P']));
  $P_Brekk = Bare_Siffer(Mysql_Klar($_POST['Brekk_P']));
  $P_Biltyveri = Bare_Siffer(Mysql_Klar($_POST['Biltyveri_P']));
  $P_Utpressing = Bare_Siffer(Mysql_Klar($_POST['Utpressing_P']));
  $P_Utbryt = Bare_Siffer(Mysql_Klar($_POST['Utbryt_P']));
  $P_Herverk = Bare_Siffer(Mysql_Klar($_POST['Herverk_P']));
  $P_Horer = Bare_Siffer(Mysql_Klar($_POST['Horer_P']));
  $P_Filmer = Bare_Siffer(Mysql_Klar($_POST['Filmer_P']));
  $P_Ran = Bare_Siffer(Mysql_Klar($_POST['Ran_P']));

  if($type == 'm' && $I['type'] == 'A') { echo PrintTeksten("Redigering sperret.","1","Feilet"); } else { 
  if($P_Drap == floor($I['drap']) && $P_Kid == floor($I['kid_antall']) && $P_Brekk == floor($I['brekk_gjort']) && $P_Biltyveri == floor($I['biler_gjort']) && $P_Utpressing == floor($I['presse_antall']) && $P_Utbryt == floor($I['bryt_ut_antall']) && $P_Herverk == floor($I['herverk_gjort']) && $P_Horer == floor($I['horer_pult']) && $P_Filmer == floor($I['antall_film_prod']) && $P_Ran == floor($I['plan_ran'])) { 
  echo PrintTeksten("Ingen endringer utført.","1","Feilet");
  } else { 
  
  if($P_Drap == floor($I['drap'])) { $B_1 = ''; } else { $B_1 = ",drap='$P_Drap'"; $Tekst = $Tekst."<b>Drap:</b> fra ".VerdiSum(floor($I['drap']),'stk')." til ".VerdiSum($P_Drap,'stk').".<br>"; }
  if($P_Kid == floor($I['kid_antall'])) { $B_2 = ''; } else { $B_2 = ",kid_antall='$P_Kid'"; $Tekst = $Tekst."<b>Kidnappinger:</b> fra ".VerdiSum(floor($I['kid_antall']),'stk')." til ".VerdiSum($P_Kid,'stk').".<br>"; }
  if($P_Brekk == floor($I['brekk_gjort'])) { $B_3 = ''; } else { $B_3 = ",brekk_gjort='$P_Brekk'"; $Tekst = $Tekst."<b>Brekk:</b> fra ".VerdiSum(floor($I['brekk_gjort']),'stk')." til ".VerdiSum($P_Brekk,'stk').".<br>"; }
  if($P_Biltyveri == floor($I['biler_gjort'])) { $B_4 = ''; } else { $B_4 = ",biler_gjort='$P_Biltyveri'"; $Tekst = $Tekst."<b>Biltyveri:</b> fra ".VerdiSum(floor($I['biler_gjort']),'stk')." til ".VerdiSum($P_Biltyveri,'stk').".<br>"; }
  if($P_Utpressing == floor($I['presse_antall'])) { $B_5 = ''; } else { $B_5 = ",presse_antall='$P_Utpressing'"; $Tekst = $Tekst."<b>Utpressing:</b> fra ".VerdiSum(floor($I['presse_antall']),'stk')." til ".VerdiSum($P_Utpressing,'stk').".<br>"; }
  if($P_Utbryt == floor($I['plan_ran'])) { $B_6 = ''; } else { $B_6 = ",bryt_ut_antall='$P_Utbryt'"; $Tekst = $Tekst."<b>Utbrytninger:</b> fra ".VerdiSum(floor($I['bryt_ut_antall']),'stk')." til ".VerdiSum($P_Utbryt,'stk').".<br>"; }
  if($P_Herverk == floor($I['herverk_gjort'])) { $B_7 = ''; } else { $B_7 = ",herverk_gjort='$P_Herverk'"; $Tekst = $Tekst."<b>Herverk:</b> fra ".VerdiSum(floor($I['herverk_gjort']),'stk')." til ".VerdiSum($P_Herverk,'stk').".<br>"; }
  if($P_Horer == floor($I['horer_pult'])) { $B_8 = ''; } else { $B_8 = ",horer_pult='$P_Horer'"; $Tekst = $Tekst."<b>Horer pult:</b> fra ".VerdiSum(floor($I['horer_pult']),'stk')." til ".VerdiSum($P_Horer,'stk').".<br>"; }
  if($P_Filmer == floor($I['antall_film_prod'])) { $B_9 = ''; } else { $B_9 = ",antall_film_prod='$P_Filmer'"; $Tekst = $Tekst."<b>Filmer produsert:</b> fra ".VerdiSum(floor($I['antall_film_prod']),'stk')." til ".VerdiSum($P_Filmer,'stk').".<br>"; }
  if($P_Ran == floor($I['plan_ran'])) { $B_10 = ''; } else { $B_10 = ",plan_ran='$P_Ran'"; $Tekst = $Tekst."<b>Planlagt ran:</b> fra ".VerdiSum(floor($I['plan_ran']),'stk')." til ".VerdiSum($P_Ran,'stk').".<br>"; }



  mysql_query("INSERT INTO `EndringsLogg` (EndretAv,EndretDato,EndretInfo,EndretHos,EndretStamp) VALUES ('$brukernavn','$FullDato','$Tekst','$I_Brukernavn','$Timestamp')");

  mysql_query("UPDATE brukere SET brukernavn='$I_Brukernavn' $B_1 $B_2 $B_3 $B_4 $B_5 $B_6 $B_7 $B_8 $B_9 $B_10 WHERE brukernavn='$I_Brukernavn'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo PrintTeksten("$Tekst","1","Vellykket");
  }}}
  elseif($_POST['Alter'] == 'GaInn' && $type == 'A') { 
  
  $DinIP = $_SERVER['REMOTE_ADDR'];
  $DinID = session_id();
  $DittNETT = $_SERVER['HTTP_USER_AGENT'];
 
  $_SESSION['bruker_SES'] = $I_Brukernavn;
  $_SESSION['pass_SES'] = $I['passord'];
  $_SESSION['id_SES'] = $DinID;
  $_SESSION['ip_SES'] = md5($_SERVER['REMOTE_ADDR']);
  $_SESSION['nett_SES'] = md5($_SERVER['HTTP_USER_AGENT']);
  $_SESSION['id'] = $I['brukerid'];


  mysql_query("UPDATE brukere SET sistinne='$tid $nbsp $dato',ip='$DinIP',timestamp_inne='$Timestamp',aktiv_eller='$Aktiv',logg_in_id='$DinID' WHERE brukernavn='$I_Brukernavn'");

  mysql_query("INSERT INTO Ip_logg (bruker,ip_brukt_nett,ip_brukt_data,dato,nettleser,timestampen) VALUES('$I_Brukernavn','$DinIP','Ikke ferdig','$tid $nbsp $dato','$DittNETT','$Timestamp')");
  Header("Location: game.php");
  
  }

  if(empty($_POST['Epost_P'])) { $V_1 = $I['email']; } else { $V_1 = $_POST['Epost_P']; }
  if(empty($_POST['Profilbilde_P'])) { $V_2 = $I['profilbilde']; } else { $V_2 = $_POST['Profilbilde_P']; }
  if(empty($_POST['Signatur_P'])) { $V_3 = $I['signatur']; } else { $V_3 = $_POST['Signatur_P']; }
  if(empty($_POST['Navn_P'])) { $V_4 = $I['navn']; } else { $V_4 = $_POST['Navn_P']; }
  if(empty($_POST['Passord_P'])) { $V_5 = ''; } else { $V_5 = $_POST['Passord_P']; }

  if(empty($_POST['Respekt_P'])) { $V_6 = floor($I['respekt']); } else { $V_6 = $_POST['Respekt_P']; }
  if(empty($_POST['Bombechips_P'])) { $V_8 = floor($I['bombechips']); } else { $V_8 = $_POST['Bombechips_P']; }
  if(empty($_POST['Penger_P'])) { $V_9 = floor($I['penger']); } else { $V_9 = $_POST['Penger_P']; }
  if(empty($_POST['Bank_P'])) { $V_10 = floor($I['bank']); } else { $V_10 = $_POST['Bank_P']; }
  if(empty($_POST['Poeng_P'])) { $V_11 = floor($I['turns']); } else { $V_11 = $_POST['Poeng_P']; }
  if(empty($_POST['Kuler_P'])) { $V_12 = floor($I['kuler']); } else { $V_12 = $_POST['Kuler_P']; }

  if(empty($_POST['Drap_P'])) { $V_14 = $I['drap']; } else { $V_14 = $_POST['Drap_P']; }
  if(empty($_POST['Kidnappinger_P'])) { $V_15 = $I['kid_antall']; } else { $V_15 = $_POST['Kidnappinger_P']; }
  if(empty($_POST['Brekk_P'])) { $V_16 = $I['brekk_gjort']; } else { $V_16 = $_POST['Brekk_P']; }
  if(empty($_POST['Biltyveri_P'])) { $V_17 = $I['biler_gjort']; } else { $V_17 = $_POST['Biltyveri_P']; }
  if(empty($_POST['Utpressing_P'])) { $V_18 = $I['presse_antall']; } else { $V_18 = $_POST['Utpressing_P']; }
  if(empty($_POST['Utbryt_P'])) { $V_19 = $I['bryt_ut_antall']; } else { $V_19 = $_POST['Utbryt_P']; }
  if(empty($_POST['Herverk_P'])) { $V_20 = $I['herverk_gjort']; } else { $V_20 = $_POST['Herverk_P']; }
  if(empty($_POST['Horer_P'])) { $V_21 = $I['horer_pult']; } else { $V_21 = $_POST['Horer_P']; }
  if(empty($_POST['Filmer_P'])) { $V_22 = $I['antall_film_prod']; } else { $V_22 = $_POST['Filmer_P']; }
  if(empty($_POST['Ran_P'])) { $V_23 = $I['plan_ran']; } else { $V_23 = $_POST['Ran_P']; }
  
  if($type == 'A') {echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bruker</span></div><div class=\"Div_hoyre_side_1\"><span class=\"GaInnI\" onclick=\"document.getElementById('Alter').value='GaInn';document.getElementById('BrukerInfo').submit()\">Logg på denne brukeren</span></div>"; }
  
  echo "
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Epost-adresse</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Epost_P\" maxlength=\"300\" value=\"$V_1\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Profilbilde</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Profilbilde_P\" maxlength=\"300\" value=\"$V_2\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Signatur</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Signatur_P\" maxlength=\"300\" value=\"$V_3\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Navn</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Navn_P\" maxlength=\"300\" value=\"$V_4\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Nytt passord</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Passord_P\" maxlength=\"300\" value=\"$V_5\"></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Alter').value='1';document.getElementById('BrukerInfo').submit()\"><p class=\"pan_str_2\">LAGRE</p></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Respekt</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Respekt_P\" maxlength=\"300\" value=\"".VerdiSum($V_6,'res')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bombechips</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Bombechips_P\" maxlength=\"300\" value=\"".VerdiSum($V_8,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Penger (cash)</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Penger_P\" maxlength=\"300\" value=\"".VerdiSum($V_9,'kr')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Penger (bank)</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Bank_P\" maxlength=\"300\" value=\"".VerdiSum($V_10,'kr')."\"></div>
  ";
  
  
  if($type == 'A') {
  echo "
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Poeng</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Poeng_P\" maxlength=\"300\" value=\"".VerdiSum($V_11,'stk')."\"></div>
  ";
  }
  
  echo "
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Kuler</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Kuler_P\" maxlength=\"300\" value=\"".VerdiSum($V_12,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Alter').value='2';document.getElementById('BrukerInfo').submit()\"><p class=\"pan_str_2\">LAGRE</p></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Drap</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Drap_P\" maxlength=\"300\" value=\"".VerdiSum($V_14,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Kidnappinger</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Kidnappinger_P\" maxlength=\"300\" value=\"".VerdiSum($V_15,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brekk</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Brekk_P\" maxlength=\"300\" value=\"".VerdiSum($V_16,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Biltiveri</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Biltyveri_P\" maxlength=\"300\" value=\"".VerdiSum($V_17,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Utpressing</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Utpressing_P\" maxlength=\"300\" value=\"".VerdiSum($V_18,'stk')."\"></div> 
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Utbrytninger</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Utbryt_P\" maxlength=\"300\" value=\"".VerdiSum($V_19,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Herverk</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Herverk_P\" maxlength=\"300\" value=\"".VerdiSum($V_20,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Horer pult</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Horer_P\" maxlength=\"300\" value=\"".VerdiSum($V_21,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Filmer produsert</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Filmer_P\" maxlength=\"300\" value=\"".VerdiSum($V_22,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Planlagte ran</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Ran_P\" maxlength=\"300\" value=\"".VerdiSum($V_23,'stk')."\"></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Alter').value='3';document.getElementById('BrukerInfo').submit()\"><p class=\"pan_str_2\">LAGRE</p></div></form>
  <div class=\"Div_mellomledd\">&nbsp;</div>
  ";
  
  
  }}
  ?>
<?php
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    if(empty($info)) { $I = "Profilinformasjon her."; } else {
      $I = htmlspecialchars_decode($info);}
?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script language='javascript' src='SCRIPT/nicEdit.js'></script>
    <style type="text/css">
      .test ul, .test ol { /*margin: 0; /*10px 0 10px 15px*/ padding: 0 0 0 1.8em; /*position: relative;*/ }
      .test ol { /*margin: 0; /*10px 0 10px 10px*/ /*padding: 0; /*0 0 0 25px*/ /*position: relative;*/ }
      .test ul li, .test ol li { /*margin: 0; padding: 0; /*position: relative;*/ }
    </style>
    <script type="text/javascript">
      bkLib.onDomLoaded(function() {
      var myNicEditor = new nicEditor({buttonList : ['save','bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','indent','image','upload','link','unlink','forecolor','hr','strikethrough','subscript','superscript','removeformat'], onSave : function() { postwith('PostForm',myNicEditor.instanceById('myInstance1').getContent()) } })
      myNicEditor.setPanel('myNicPanel');
      myNicEditor.addInstance('myInstance1');
      });
      
      function postwith (navn,value) {
      var myForm = document.createElement("form");
      myForm.method="post";
      var myInput = document.createElement("input");
      myInput.setAttribute("name", navn);
      myInput.setAttribute("value", value);
      myForm.appendChild(myInput);
      document.body.appendChild(myForm);
      myForm.submit();
      document.body.removeChild(myForm); }
    </script>  
    <div class="Div_masta">
      <form method="post" id="LAGRE">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">REDIGER PROFIL</span></div>
          <?php
            if($kjoonn == 'Gutt') { 
            $Rank_15 = "Capo Crimini"; $Rank_14 = "Leg.Don"; $Rank_13 = "Don"; $Rank_12 = "Leg.Gudfar"; $Rank_11 = "Gudfar"; $Rank_10 = "Sjef"; $Rank_9 = "Narko Baron"; $Rank_8 = "Kaptein"; $Rank_7 = "Torpedo"; $Rank_6 = "Attentatmann"; $Rank_5 = "Gangster"; $Rank_4 = "Kriminell"; $Rank_3 = "Bråkmaker"; $Rank_2 = "Lærling"; $Rank_1 = "Uteligger";
            } else { 
            $Rank_15 = "Capo Crimini"; $Rank_14 = "Herskerinne"; $Rank_13 = "Grevinne"; $Rank_12 = "Leg.Gudmor"; $Rank_11 = "Gudmor"; $Rank_10 = "Sjef"; $Rank_9 = "Baronesse"; $Rank_8 = "Kaptein"; $Rank_7 = "Morderske"; $Rank_6 = "Attentatdame"; $Rank_5 = "Gangsterinne"; $Rank_4 = "Kriminell"; $Rank_3 = "Forførerske"; $Rank_2 = "Luremus"; $Rank_1 = "Uteligger";
            }
            
            $ReProsent = '100' - $rankpros2;
              
            if($rank_niva >= '2') { $Var_2 = "<p style=\"font-weight:bold;\">02: $Rank_2</p>"; } else { if($rankpros >= '0') { $ReProsent2 = $ReProsent; } else {  $ReProsent2 = "100"; } $Var_2 = "<div class=\"progress\" style=\"height: $ReProsent2%;\"><p>02: $Rank_2</p></div>"; }
            if($rank_niva >= '3') { $Var_3 = "<p style=\"font-weight:bold;\">03: $Rank_3</p>"; } else { if($rankpros >= '100') { $ReProsent3 = $ReProsent; } else {  $ReProsent3 = "100"; } $Var_3 = "<div class=\"progress\" style=\"height: $ReProsent3%;\"><p>03: $Rank_3</p></div>"; }
            if($rank_niva >= '4') { $Var_4 = "<p style=\"font-weight:bold;\">04: $Rank_4</p>"; } else { if($rankpros >= '200') { $ReProsent4 = $ReProsent; } else {  $ReProsent4 = "100"; } $Var_4 = "<div class=\"progress\" style=\"height: $ReProsent4%;\"><p>04: $Rank_4</p></div>"; }
            if($rank_niva >= '5') { $Var_5 = "<p style=\"font-weight:bold;\">05: $Rank_5</p>"; } else { if($rankpros >= '300') { $ReProsent5 = $ReProsent; } else {  $ReProsent5 = "100"; } $Var_5 = "<div class=\"progress\" style=\"height: $ReProsent5%;\"><p>05: $Rank_5</p></div>"; }
            if($rank_niva >= '6') { $Var_6 = "<p style=\"font-weight:bold;\">06: $Rank_6</p>"; } else { if($rankpros >= '400') { $ReProsent6 = $ReProsent; } else {  $ReProsent6 = "100"; } $Var_6 = "<div class=\"progress\" style=\"height: $ReProsent6%;\"><p>06: $Rank_6</p></div>"; }
            if($rank_niva >= '7') { $Var_7 = "<p style=\"font-weight:bold;\">07: $Rank_7</p>"; } else { if($rankpros >= '500') { $ReProsent7 = $ReProsent; } else {  $ReProsent7 = "100"; } $Var_7 = "<div class=\"progress\" style=\"height: $ReProsent7%;\"><p>07: $Rank_7</p></div>"; }
            if($rank_niva >= '8') { $Var_8 = "<p style=\"font-weight:bold;\">08: $Rank_8</p>"; } else { if($rankpros >= '600') { $ReProsent8 = $ReProsent; } else {  $ReProsent8 = "100"; } $Var_8 = "<div class=\"progress\" style=\"height: $ReProsent8%;\"><p>08: $Rank_8</p></div>"; }
            if($rank_niva >= '9') { $Var_9 = "<p style=\"font-weight:bold;\">09: $Rank_9</p>"; } else { if($rankpros >= '700') { $ReProsent9 = $ReProsent; } else {  $ReProsent9 = "100"; } $Var_9 = "<div class=\"progress\" style=\"height: $ReProsent9%;\"><p>09: $Rank_9</p></div>"; }
            if($rank_niva >= '10') { $Var_10 = "<p style=\"font-weight:bold;\">10: $Rank_10</p>"; } else { if($rankpros >= '800') { $ReProsent10 = $ReProsent; } else {  $ReProsent10 = "100"; } $Var_10 = "<div class=\"progress\" style=\"height: $ReProsent10%;\"><p>10: $Rank_10</p></div>"; }
            if($rank_niva >= '11') { $Var_11 = "<p style=\"font-weight:bold;\">11: $Rank_11</p>"; } else { if($rankpros >= '900') { $ReProsent11 = $ReProsent; } else {  $ReProsent11 = "100"; } $Var_11 = "<div class=\"progress\" style=\"height: $ReProsent11%;\"><p>11: $Rank_11</p></div>"; }
            if($rank_niva >= '12') { $Var_12 = "<p style=\"font-weight:bold;\">12: $Rank_12</p>"; } else { if($rankpros >= '1000') { $ReProsent12 = $ReProsent; } else {  $ReProsent12 = "100"; } $Var_12 = "<div class=\"progress\" style=\"height: $ReProsent12%;\"><p>12: $Rank_12</p></div>"; }
            if($rank_niva >= '13') { $Var_13 = "<p style=\"font-weight:bold;\">13: $Rank_13</p>"; } else { if($rankpros >= '1100') { $ReProsent13 = $ReProsent; } else {  $ReProsent13 = "100"; } $Var_13 = "<div class=\"progress\" style=\"height: $ReProsent13%;\"><p>13: $Rank_13</p></div>"; }
            if($rank_niva >= '14') { $Var_14 = "<p style=\"font-weight:bold;\">14: $Rank_14</p>"; } else { if($rankpros >= '1200') { $ReProsent14 = $ReProsent; } else {  $ReProsent14 = "100"; } $Var_14 = "<div class=\"progress\" style=\"height: $ReProsent14%;\"><p>14: $Rank_14</p></div>"; }
            if($rank_niva >= '15') { $Var_15 = "<p style=\"font-weight:bold;\">15: $Rank_15</p>"; } else { if($rankpros >= '1300') { $ReProsent15 = $ReProsent; } else {  $ReProsent15 = "100"; } $Var_15 = "<div class=\"progress\" style=\"height: $ReProsent15%;\"><p>15: $Rank_15</p></div>"; }
            
            if($rankpros2 > '100') { $rankpros3 = '100'; } else { $rankpros3 = $rankpros2; }

            if(isset($_POST['avatar'])) { 
              $Avatar = Mysql_Klar($_POST['avatar']);
              $Signatur = Mysql_Klar($_POST['signatur']);
              $Navnet = Mysql_Klar($_POST['navn']);
              $G_Pass = mysql_real_escape_string($_POST['gammelt_pass']);
              $N_Pass = mysql_real_escape_string($_POST['nytt_passord']);
              
              $Md_G_Pass = md5($G_Pass);
              $Md_N_Pass = md5($N_Pass);
              
              $Endre = "";
              
              if($Avatar == $profilbilde && $Navnet == $navn && empty($G_Pass) && $Signatur == $DinSign) { 
              echo PrintTeksten('Ingenting ble endret.','1','Feilet');
              } else {  
                echo '<div class="Div_MELDING">';
                if($Avatar != $profilbilde) { echo "<span class=\"Span_str_6\">Du har endret profilbildet.</span>"; $Endre = $Endre."profilbilde='$Avatar',"; }
                if($Signatur != $DinSign) { echo "<span class=\"Span_str_6\">Du har endret signatur.</span>"; $Endre = $Endre."signatur='$Signatur',"; }
                if($Navnet != $navn) { echo "<span class=\"Span_str_6\">Du har endret navn.</span>"; $Endre = $Endre."navn='$Navnet',"; }
                if(!empty($G_Pass)) { if($Md_G_Pass == $userinfo['passord']) { echo "<span class=\"Span_str_6\">Du har endret passordet.</span>"; $Endre = $Endre."passord='$Md_N_Pass',"; } else { echo "<span class=\"Span_str_5\">Feil passord.</span>"; }}
                echo "</div>"; 
                $profilbilde = $Avatar;
                $navn = $Navnet;
                $DinSign = $Signatur;
              }
              $Endre = $Endre."aktiv_eller='$Aktiv'";
            
              mysql_query("UPDATE brukere SET $Endre WHERE brukernavn='$brukernavn'");
            } elseif(isset($_POST['PostForm'])) { 
              $PostER = Mysql_Klar($_POST['PostForm']);
            
              mysql_query("UPDATE brukere SET info='$PostER',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
              echo PrintTeksten('Profilen er endret.','1','Vellykket');
              $I = $_POST['PostForm'];
            } elseif(isset($_POST['InvID'])) { 
              $InvID = Mysql_Klar($_POST['InvID']);
              if(empty($InvID)) { echo PrintTeksten('Invitasjonen er ugyldig.','1','Feilet'); } else { 
                $InvID = Dekrypt_Tall($InvID);
              
                $GodInv = mysql_query("SELECT * FROM Invite_diverse WHERE Invitert_brukernavn='$brukernavn' AND id LIKE '$InvID'");
                if(mysql_num_rows($GodInv) == '0') { echo PrintTeksten('Invitasjonen eksisterer ikke.','1','Feilet'); } else { 
                  $Info = mysql_fetch_assoc($GodInv);
                  if($Info['Invitert_type'] == 'Gjeng') {
                    if(empty($gjeng)) { 
                      $GjengID = $Info['Invitert_bedrift_id'];
                      $GjengNavn = $Info['Invitert_av_bedrift'];
                    
                      $SjekkGjeng = mysql_query("SELECT * FROM Gjenger WHERE id LIKE '$GjengID' AND Gjeng_Navn='$GjengNavn'");
                      if(mysql_num_rows($SjekkGjeng) == '0') { echo PrintTeksten('Gjengen eksisterer ikke lengere.','1','Feilet'); } else { 
                        mysql_query("UPDATE brukere SET gjeng='$GjengNavn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
                        mysql_query("INSERT INTO Gjeng_medlemmer (gjeng_id,brukernavn,stilling,ansatt_dato,ansatt_stamp) VALUES ('$GjengID','$brukernavn','Medlem','$FullDato','$Timestamp')");
                      
                        mysql_query("DELETE FROM Invite_diverse WHERE Invitert_brukernavn='$brukernavn' AND id LIKE '$InvID'");
                        echo PrintTeksten("Du er nå medlem av $GjengNavn.",'1','Vellykket');
                      }
                    } else {
                      echo PrintTeksten('Du må først forlate den gjengen du er i.','1','Feilet');
                    }
                  } // Kan ha flere forsjellige typer invitasjon legg til elsif her
                }
              }
            } elseif(isset($_POST['EpostInv'])) { 
              $EpostInviter = mysql_real_escape_string($_POST['EpostInv']);
              function ValidateEmail($email_BLI) { if (preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$/i", $email_BLI)) {return 1; } else { return 0; }}
              if(ValidateEmail($EpostInviter) == '1') {  
              
                $Sj = mysql_query("SELECT * FROM brukere WHERE email='$EpostInviter' AND liv > '1'");
                if(mysql_num_rows($Sj) == '0') { 
                  $Melding = nl2br("
                  <img src=\"http://www.mafiano.no/Design/Invitasjon.jpg\">
                  
                  MafiaNo er et tekstbasert mafiaspill med mange unike funksjoner som du ikke finner på lignende spill. 
                  Dette er en unik mulighet til å oppleve en spesiel spillfølelse.
                  
                  Du har blitt invitert av $brukernavn.
                  Registrering: <a href=\"http://www.mafiano.no/index.php?function=login&file=register&av=".$_SESSION['id']."\">mafiano.no</a>
                  Mvh: MafiaNo
                  ");
                  $headers  = 'MIME-Version: 1.0' . "\r\n";
                  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  $headers .= 'To: <'.$EpostInviter.'>' . "\r\n";
                  $headers .= 'From: '.$brukernavn.' <'.$email.'>' . "\r\n";
                  mail($EpostInviter, 'mafiano.no', $Melding, $headers);
                  echo PrintTeksten('Epost adressen er nå invitert.','1','Vellykket');
                } else { echo PrintTeksten('Epost adressen er registrert på en levende bruker.','1','Feilet'); }
              } else { echo PrintTeksten('Vennligst skriv en gyldig epost adresse.','1','Feilet'); }
            }
  
            if(empty($_POST['EpostInv'])) { $EpostVis = "Epost adresse"; } else { $EpostVis = $_POST['EpostInv']; }
            ?>
            <div class="Div_venstre_side_1"><span class="Span_str_1">E-post adresse</span></div>
            <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=$email;?></span></div>
            <div class="Div_venstre_side_1"><span class="Span_str_1">Avatar</span></div>
            <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="avatar" maxlength="300" value="<?=$profilbilde;?>"></div>
            <div class="Div_venstre_side_1"><span class="Span_str_1">Signatur</span></div>
            <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="signatur" maxlength="300" value="<?=$DinSign;?>"></div>
            <div class="Div_venstre_side_1"><span class="Span_str_1">Navn</span></div>
            <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="navn" maxlength="30" value="<?=$navn;?>"></div>
            <div class="Div_venstre_side_1"><span class="Span_str_1">Passord</span></div>
            <div class="Div_hoyre_side_1"><input class="textbox" type="password" name="gammelt_pass"></div>
            <div class="Div_venstre_side_1"><span class="Span_str_1">Nytt passord</span></div>
            <div class="Div_hoyre_side_1"><input class="textbox" type="password" name="nytt_passord"></div>
            <div class="Div_venstre_side_1">&nbsp;</div>
            <div class="Div_submit_knapp_2" onclick="document.getElementById('LAGRE').submit()"><p class="pan_str_2">LAGRE</p></div></form>
            <div id="myNicPanel" style="float:left; width:490px; margin-top:2px; margin-left:2px;"></div>
            <div style="float: left; width: 490px; background-color:#303030; margin-top:2px; margin-left:2px; border-bottom-style: solid; border-bottom-width: 1px;">
            <div id="myInstance1" style="float:left; width:480px; margin:5px; min-height:200px; color:#ffffff;" class="test"><?php echo $I; ?></div></div>
            </div>
            
            <div class="Div_masta">
            <table class="Rute_2" id="Rute_2"><tr><td class="R_0" colspan="2">NESTE RANK</td></tr>
            <tr><td><div class="progressbar"><div class="progress" style="width: <?php echo $rankpros3; ?>%; overflow:hidden;"><p><?php echo $rankpros2; ?>% utført</p></div></div></td></tr>
            </table>
            
            <table class="Rute_2" id="Rute_2"><tr><td class="R_0" colspan="2">RANKSTIGE</td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_15; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_14; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_13; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_12; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_11; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_10; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_9; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_8; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_7; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_6; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_5; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_4; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_3; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><?php echo $Var_2; ?></div></td></tr>
            <tr><td><div class="progressbar_v"><p style="font-weight:bold;">01: <?php echo $Rank_1; ?></p></div></td></tr>
            </table>
            <table class="Rute_2" id="Rute_2"><tr><td class="R_0" colspan="2">TELLERE</td></tr>
            <tr><td class="R_4">Type</td><td class="R_4">Antall</td></tr>
            <tr><td class="R_1">Drap</td><td class="R_2"><? echo VerdiSum($drap,'personer'); ?></td></tr>
            <tr><td class="R_1">Kidnappinger</td><td class="R_2"><? echo VerdiSum($kidnapping_antall,'stk'); ?></td></tr>
            <tr><td class="R_1" colspan="2">&nbsp;</td></tr>
            <tr><td class="R_1">Brekk</td><td class="R_2"><? echo VerdiSum($brekk_gjort,'ganger'); ?></td></tr>
            <tr><td class="R_1">Biltyveri</td><td class="R_2"><? echo VerdiSum($biler_gjort,'ganger'); ?></td></tr>
            <tr><td class="R_1">Utpressing</td><td class="R_2"><? echo VerdiSum($utpresse_antall,'ganger'); ?></td></tr>
            <tr><td class="R_1">Utbrytning</td><td class="R_2"><? echo VerdiSum($bryt_ut_antall,'ganger'); ?></td></tr>
            <tr><td class="R_1">Herverk</td><td class="R_2"><? echo VerdiSum($herverk_gjort,'ganger'); ?></td></tr>
            <tr><td class="R_1" colspan="2">&nbsp;</td></tr>
            <tr><td class="R_1">Seksuel aktivitet</td><td class="R_2"><? echo VerdiSum($horer_pult,'økter'); ?></td></tr>
            <tr><td class="R_1">Filmer produsert</td><td class="R_2"><? echo VerdiSum($antall_film_prod,'filmer'); ?></td></tr>
            <tr><td class="R_1">Planlagt ran</td><td class="R_2"><? echo VerdiSum($plan_ran,'ran'); ?></td></tr>
            <tr><td class="R_1" colspan="2">&nbsp;</td></tr>
            <tr><td class="R_1">Meldinger sendt</td><td class="R_2"><? echo VerdiSum($meldinger_sendt,'brev sendt'); ?></td></tr>
            </table>
            </div>

            <div class="Div_masta"><form method="post" id="Inv"><input type="hidden" name="InvID" id="InvID" />
            <table class="Rute_2" id="Rute_2"><tr><td class="R_0" colspan="2">INVITASJONER</td></tr>
            <?
            
          
            $Inv = mysql_query("SELECT * FROM Invite_diverse WHERE Invitert_brukernavn='$brukernavn' ORDER BY `Invitert_stamp` DESC LIMIT 0, 20");
            if(mysql_num_rows($Inv) == '0') { echo PrintTeksten('Ingen invitasjoner.','2','Feilet','2'); } else { 
              while($I = mysql_fetch_assoc($Inv)) {  
              
              $ID_En = Krypt_Tall($I['id']);

              echo "<tr><td class=\"R_3\">".$I['Invitert_av_bedrift']." <font style=\"color:#85a8bf; font-size:10px;\">[ ".$I['Invitert_type']." ]</font></td><td class=\"R_7\" onclick=\"document.getElementById('InvID').value='$ID_En';document.getElementById('Inv').submit()\">JA!</td></tr>";   
              }
            }
            
            ?>
            </table></form>
            <table class="Rute_2" id="Rute_2"><tr><td class="R_0" colspan="2">VENNER</td></tr>
            <?
          
            $Kon = mysql_query("SELECT kontakter.kontaktnavn, kontakter.status, brukere.aktiv_eller FROM kontakter INNER JOIN brukere ON kontakter.kontaktnavn=brukere.brukernavn WHERE kontakter.dittbrukernavn='$brukernavn'");
            if(mysql_num_rows($Kon) == 0) { echo PrintTeksten('Ingen kontakter.','2','Feilet','2'); } else {while ($I = mysql_fetch_assoc($Kon)) { 
              if($I['aktiv_eller'] > $Timestamp) { $Online = "<font style=\"color:#3c943c; font-weight:bold;\">Pålogget</font>"; } else { $Online = "<font style=\"color:#cc3f01; font-weight:bold;\">Avlogget</font>"; }
                echo "<tr><td class=\"R_3\">".BrukerURL($I['kontaktnavn'])." <font style=\"color:#85a8bf; font-size:10px;\">[ ".$I['status']." ]</font></td><td class=\"R_2\">$Online</td></tr>";
              }
            }
            ?>
            </table><form method="post" id="InviterVenn">
            <table class="Rute_2" id="Rute_2"><tr><td class="R_0" colspan="2">INVITER</td></tr>
            <tr><td class="R_1"><input class="textbox3" type="text" name="EpostInv" value="<? echo $EpostVis; ?>" onFocus="if(this.value=='Epost adresse')this.value='';" onblur="if(this.value=='')this.value='Epost adresse';"></td></tr>
            <tr><td class="R_7" onclick="document.getElementById('InviterVenn').submit()">INVITER</td></tr>
            <tr><td class="R_6">For å invitere venner og få belønning for det, be de registrere seg via denne lenken: http://www.mafiano.no/index.php?function=login&file=register&av=<?php echo $_SESSION['id']; ?></td></tr>
            </table></form>
            </div>
            
            <?
            }
            ?>
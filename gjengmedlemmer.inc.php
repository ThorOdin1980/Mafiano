<style>
  .VelgRad { float: left; border-bottom-style: solid; border-bottom-width: 1px; border-color:#000000; width: 378px; height: 25px; background-color:#383838; margin-top:2px; margin-left:2px; }
  .VelgRad:hover { background-color:#434343; cursor:pointer; }
  .LinjeTo { padding:3px; border-bottom-style: solid; border-bottom-width: 1px; border-color:#000000; font-size:11px; }
  .XMedlem { font-weight:bold; color:#e40404; filter:alpha(opacity=50); opacity:0.5; }
  .XMedlem:hover { filter:alpha(opacity=90); opacity:0.9; cursor:pointer; }
</style>
<?php
    if(basename($_SERVER['PHP_SELF']) == "gjengmedlemmer.inc.php") {
        header("Location: index.php"); exit;
    } else {
        // **********************************************************
        // ********************** Slett medlem **********************
        // ********************************************************** 

        $Slett = Mysql_Klar($_GET['Slett']);
        $Slett = Dekrypt_Tall($Slett);

        if(!empty($Slett) && $i['stilling'] == 'Boss') { $JaEll = 'Ja'; } 
        elseif(!empty($Slett) && $i['stilling'] == 'Medlem' && $Slett == $i['dinid']) { $JaEll = 'Ja'; } else { $JaEll = 'Nei'; }

             if($JaEll == 'Ja') {
                $GetMedlem = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE gjeng_id='$G_Id' AND id='$Slett' AND stilling='Medlem'");
                if(mysql_num_rows($GetMedlem) >= '1') { 
                  $In = mysql_fetch_assoc($GetMedlem);
                  $brukeren = $In['brukernavn'];
                  mysql_query("DELETE FROM Gjeng_medlemmer WHERE gjeng_id='$G_Id' AND id='$Slett' AND stilling='Medlem'");
                  if($i['stilling'] == 'Boss') {
                  
                    mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukeren','$Timestamp','$FullDato','Kastet ut','Du har blitt kastet ut av gjengen.','Ja')");
                }
               
                mysql_query("UPDATE brukere SET gjeng='' WHERE brukernavn='$brukeren'");
                if($i['stilling'] == 'Medlem') {
                    echo "<script>$('#SB_Midten2').load('post.php?GjengHus');</script>";
                }
            }
        }

        // *******************************************************
        // ********************** Medlemmer **********************
        // ******************************************************* 

        $Medlemmer = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE gjeng_id='$G_Id' ORDER BY stilling,ansatt_stamp");
        $Tell = '0';
        while($IEN = mysql_fetch_assoc($Medlemmer)) { 
            $Tell++;
            if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
            $Peng_Don = VerdiSum($IEN['penger_don'],'Kroner');
            $Poen_Don = VerdiSum($IEN['poeng_don'],'Poeng');
            $Bomb_Don = VerdiSum($IEN['bombechips_don'],'Bombechips');
            $Drap_Don = VerdiSum($IEN['Drap'],'Drap');
            $Sabotasje_Don = VerdiSum($IEN['Angrep'],'Angrep');
            $Forsvar_Don = VerdiSum($IEN['Forsvar'],'Forsvar');
            $SlettID = Krypt_Tall($IEN['id']);
            if($i['stilling'] == 'Boss' && $IEN['stilling'] == 'Medlem') {
                $SlettEll = "<br><span class=\"XMedlem\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Medlemmer&Slett=$SlettID');\">SLETT</span>";
            } elseif($i['stilling'] == 'Medlem' && $brukernavn == $IEN['brukernavn']) {
                $SlettEll = "<br><span class=\"XMedlem\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Medlemmer&Slett=$SlettID');\">FORLAT GJENG</span>"; 
            } else { $SlettEll = ''; }
  
            $R_Med = $R_Med."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($IEN['brukernavn'])." ( ".$IEN['stilling']." )<br>".$IEN['ansatt_dato']." $SlettEll</td><td class=\"LinjeTo Plassering\">$Peng_Don<br>$Poen_Don<br>$Bomb_Don</td><td class=\"LinjeTo Plassering\">$Drap_Don<br>$Sabotasje_Don<br>$Forsvar_Don</td></tr>";
        }
  
        // ********************************************************
        // ********************** Hoved html **********************
        // ********************************************************

        echo "<div class=\"Div_masta\" id=\"G_Medlemmer\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">$G_NavnEr</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Okonomi');\">( Økonomi )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Krim');\">( Krim )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Medlemmer');\">( Medlemmer )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Hovedkvarter');\">( Hovedkvarter )</span></td></tr><tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/GjengMed.jpg\"></td></tr>";
  
        if($_GET['Inviter'] && $i['stilling'] == 'Boss') { 
            $BrukerInv = Mysql_Klar($_GET['Inviter']);
            if(empty($BrukerInv)) {
                echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>";
            } else {
                $Kis = mysql_query("SELECT * FROM brukere WHERE brukernavn='$BrukerInv'");
                if(mysql_num_rows($Kis) == '0') {
                    echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$BrukerInv eksisterer ikke.</span></td></tr>";
                } else { 
                    $Info = mysql_fetch_assoc($Kis);
                    $BrukerInv = $Info['brukernavn'];
                    if($Info['liv'] < '1') {
                        echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$BrukerInv er dåd.</span></td></tr>";
                    } elseif($BrukerInv == $brukernavn) {
                        echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke invitere deg selv.</span></td></tr>";
                    } elseif(!empty($Info['gjeng'])) {
                        echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$BrukerInv er allerede med i en gjeng.</span></td></tr>";
                    } else {
                      
                        $S = mysql_query("SELECT * FROM Invite_diverse WHERE Invitert_brukernavn='$BrukerInv' AND Invitert_bedrift_id='$G_Id' AND Invitert_type='Gjeng'");
                        if(mysql_num_rows($S) >= '1') {
                            echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$BrukerInv er allerede invitert.</span></td></tr>";
                        } else {
                            mysql_query("INSERT INTO `Invite_diverse` (Invitert_av_bedrift, Invitert_dato, Invitert_stamp, Invitert_bedrift_id, Invitert_type, Invitert_brukernavn) VALUES ('$G_NavnEr','$FullDato','$Timestamp','$G_Id','Gjeng','$BrukerInv')") or die(mysql_error());
                            echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Du har invitert $BrukerInv.</span></td></tr>";
                        }
                    }
                }
            }
        }
  
        // *****************************************************************
        // ********************** Inviter medlem html **********************
        // *****************************************************************

        if($i['stilling'] == 'Boss') { 
            echo "<script>$('#InviterBruker').click(function() { if($('#Inviter').val() == '' || $('#Inviter').val() == 'Brukernavn') { alert('Brukernavn mangler.'); } else { var Navn = encodeURI($('#Inviter').val()); $('#SB_Midten2').load('post.php?GjengHus=Medlemmer&Inviter='+Navn); $('html, body').animate({scrollTop:100}, 'slow'); }});</script>"; 
            echo "<tr class=\"Viktig_0\"><td colspan=\"3\" class=\"Linje Send\" style=\"padding-bottom:9px;\"><input type=\"text\" id=\"Inviter\" value=\"Brukernavn\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\"><p class=\"Post\" id=\"InviterBruker\">Inviter!</p></td></tr>"; 
        }
  
        echo "<tr style=\"height:20px;\"><td class=\"R_4\">Bruker</td><td class=\"R_4\">Bidrag</td><td class=\"R_4\">Handlinger</td></tr>$R_Med</table></div>";

    }
?>
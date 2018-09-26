        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A' || $type == 'm') { 



        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">BRUKER KONTROLL</span></div>
        <div class="Div_submeny_1" onclick='document.location.href="game.php?side=TidsStraff"'><span class="Span_str_3">TIDS-STRAFF</span><span class="Span_str_4">Steng en spiller ute fra MafiaNo i en valgt tidsperiode.</span></div>
        <? if($type == 'A') { echo "
        <div class=\"Div_submeny_1\" onclick='document.location.href=\"game.php?side=ModkillGjennoppliv\"'><span class=\"Span_str_3\">MODKILL / GJENOPPLIV</span><br><span class=\"Span_str_4\">Her har du muligheten til å drepe samt gjennopplive spillere i spillet.</span></div>
        <div class=\"Div_submeny_1\" onclick='document.location.href=\"game.php?side=IpBan\"'><span class=\"Span_str_3\">IP BAN</span><span class=\"Span_str_4\">Bannlys en spesefik ip-adresse fra MafiaNo sine sider.</span></div>
        <div class=\"Div_submeny_1\" onclick='document.location.href=\"game.php?side=GiStilling\"'><span class=\"Span_str_3\">GI STILLING</span><span class=\"Span_str_4\">Her har du som administrator mulighet til å gi forsjellige stillinger til brukere på spillet.</span></div>"; } ?>
        </div>
        <?
        } else { header("Location: index.php"); }}}
        
        
        ?>
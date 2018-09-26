        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else {
        
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { 
        $fengsel_info = mysql_fetch_assoc($fengsel_sjekk_om);
        $tiden_ute = $fengsel_info['timestamp_over'] - $tiden;
        }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">FENGSEL</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/angrip.jpg" width="490" height="200"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Straff</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9">Du blir sluppet fri om <span id="tell"><?=$tiden_ute;?></span> sekunder</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Tatt for</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=$fengsel_info['tatt_for'];?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Bailout sum</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=number_format($fengsel_info['kjop_ut_sum'], 0, ",", ".");?> kr</span></div>
        </div>
        <?
        }
        ?>
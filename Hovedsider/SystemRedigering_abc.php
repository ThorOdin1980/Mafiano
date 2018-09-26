        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A' || $type == 'm') { 

        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">SYSTEM REDIGERING</span></div>
        <div class="Div_submeny_1" onclick='document.location.href="game.php?side=Nyhetsbehandler"'><span class="Span_str_3">Nyhetsbehandler</span><br><span class="Span_str_4">Her kan du behandle alle nyhetene til spillet.</span></div>
        <div class="Div_submeny_1" onclick='document.location.href="game.php?side=Rengjoring"'><span class="Span_str_3">Viktig informasjon</span><br><span class="Span_str_4">Viktig informasjon om spillet, database informasjon, server informasjon og statistikk.</span></div>
        <div class="Div_submeny_1" onclick='document.location.href="game.php?side=AntibottSpors"'><span class="Span_str_3">Lag spørsmål</span><br><span class="Span_str_4">Her kan du lage spørsmål som blir brukt som sikkerhet mot programvarer som spiller spillet automatisk.</span></div>
        </div>
        <?
        } else { header("Location: index.php"); }}}
        
        ?>
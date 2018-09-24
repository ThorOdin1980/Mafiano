  <style>
  .Rulett,.Blackjack,.Ssp,.Poker,.Trav,.Lotto,.Slot,.Terning { float: left; border-bottom-style: solid; border-bottom-width: 1px; border-color:#000000; width: 244px; height: 100px; background-color:#303030; margin-top:2px; margin-left:2px; -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; border-top-left-radius: 3px; -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; border-top-right-radius: 6px; }
  .Rulett { background-image: url('../Bilder/Rulett.jpg'); }
  .Blackjack { background-image: url('../Bilder/Black.jpg'); }
  .Ssp { background-image: url('../Bilder/Ssp.jpg'); }
  .Poker { background-image: url('../Bilder/Poker.jpg'); }
  .Trav { background-image: url('../Bilder/Trav.jpg'); }
  .Lotto { background-image: url('../Bilder/Lottoen.jpg'); }
  .Slot { background-image: url('../Bilder/Slot.jpg'); }
  .Terning { background-image: url('../Bilder/Terning.jpg'); }
  .Rulett:hover,.Blackjack:hover,.Ssp:hover,.Poker:hover,.Trav:hover,.Lotto:hover,.Slot:hover,.Terning:hover { cursor:pointer; filter:alpha(opacity=70); opacity:0.7; }
  </style>
  
  <?php
  if(basename($_SERVER['PHP_SELF']) == "Kasino.inc.php") { header("Location: index.php"); exit; } else {
  
  echo "
  <div id=\"G_Innhold\"></div>
  <div class=\"Div_masta\">
  <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Kasino</span></div>
  <div class=\"Rulett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Rulett');\"><span class=\"Span_str_3\">Rulett</span><br><span class=\"Span_str_4\">Spill rulett, velg riktig tall og vinn store summer.</span></div>";
  #<div class=\"Blackjack\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Blackjack');\"><span class=\"Span_str_3\">Blackjack</span><br><span class=\"Span_str_4\">Blackjack er et kortspill, om du er dreven så er det mulig å vinne store summer.</span></div>
  echo "<div class=\"Ssp\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=SSP');\"><span class=\"Span_str_3\">Stein saks papir</span><br><span class=\"Span_str_4\">Velg riktig hånd for å vinne penger.</span></div>
  <div class=\"Poker\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Poker');\"><span class=\"Span_str_3\">Poker</span><br><span class=\"Span_str_4\">Spill poker med venna dine, om du starter nytt bord så må tre personer joine før det blir avgjort en vinner.</span></div>
  <div class=\"Trav\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Trav');\"><span class=\"Span_str_3\">Travbanen</span><br><span class=\"Span_str_4\">Her kan du satse penger på en hest du trur kommer til å vinne.</span></div>
  <div class=\"Lotto\" onclick=\"alert('Under utvikling.')\"><span class=\"Span_str_3\">Lotto</span><br><span class=\"Span_str_4\">Lotto, det gjelder å velge riktig tall.</span></div>
  <div class=\"Slot\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Slot');\"><span class=\"Span_str_3\">Slot automat</span><br><span class=\"Span_str_4\">Her kan du spille på en pengeautomat.</span></div>
  <div class=\"Terning\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Terning');\"><span class=\"Span_str_3\">Kast terning</span><br><span class=\"Span_str_4\">Kast terninger å vinn penger.</span></div>

  </div>
  ";

  }
  ?>
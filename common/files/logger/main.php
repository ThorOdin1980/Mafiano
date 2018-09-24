<?php
  #if(!defined('view'))    { die('Not permission.'); }
  $output = '';

  if($userinfo['type'] == 'A' || $userinfo['type'] == 'm')  {
  ?>

  <div class="Div_masta">
  <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">Logger</span></div>

  <a href="?function=logger&file=botcheck">
    <div class="Div_submeny_1">
      <span class="Span_str_3">Brukerlogg</span><br>
      <span class="Span_str_4">Logger alle brukerevents</span>
    </div>
  </a>

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=Drap');">
    <span class="Span_str_3">Drapslogg</span><br>
    <span class="Span_str_4">Siste 150 drap som har forekommet på MafiaNo.</span>
  </div>

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=Bank');">
    <span class="Span_str_3">Bank transaksjoner</span><br>
    <span class="Span_str_4">Siste 700 bank transaksjoner fra en spiller til en annen.</span>
  </div>

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=Handel');">
    <span class="Span_str_3">Handel</span>
    <span class="Span_str_4">Siste 700 handler fra en spiller til en annen.</span>
  </div>

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=PoengBestilling');">
    <span class="Span_str_3">Poeng bestillinger</span>
    <span class="Span_str_4">Her ligger loggen over alle poeng bestillinger.</span>
  </div>

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=Ssp');">
    <span class="Span_str_3">Ssp logg</span>
    <span class="Span_str_4">Siste 700 stein-saks-papir resultater.</span>
  </div>

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=Blackjack');">
    <span class="Span_str_3">Blackjack logg</span>
    <span class="Span_str_4">Siste 700 blackjack resultater.</span>
  </div>  

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=IpLogg');">
    <span class="Span_str_3">IP logg</span>
    <span class="Span_str_4">Siste 200 ip-adresser innlogget.</span>
  </div>    

  <?php
  }
  if($userinfo['type'] == 'A')  {
  ?>


  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=Bunker');">
    <span class="Span_str_3">Bunker logg</span><br>
    <span class="Span_str_4">Siste 400 spillere som har har gått ned i en bunker.</span>
  </div>

  <div class="Div_submeny_1" onclick="$('#SB_Midten2').load('post.php?Logger=Pm');">
    <span class="Span_str_3">Private meldinger</span>
    <span class="Span_str_4">Siste 200 private meldinger.</span>
  </div>

  <div class="Div_submeny_1" onclick='document.location.href="game.php?side=BrukerRedigeringsLogg"'>
    <span class="Span_str_3">Bruker redigeringer</span>
    <span class="Span_str_4">Her ligger loggen for hva administratorene og moderatorene har endret hos en privat bruker, kun administratorer kan se dette.</span>
  </div>
</div>

    <?php
  }
?>


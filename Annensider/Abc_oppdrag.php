  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  echo "<div class=\"Div_masta\" id=\"Oppdrag\">";
  echo "<div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">OPPDRAG</span></div>";
                
  if($oppdrag_nr == '1') { $OppdragNiva2 = number_format($OppdragNiva, 0, ",", "."); $Bilde = "Oppdrag-1.jpg"; $Tekst = "<b>Skaff 7 Mazda RX-8:</b><br>Young guns i Oslo trenger 7 Mazda RX-8 som er ifra Hamar, de er villig til å betale deg 1.000.000 kr for jobben. De ser helst at oppdraget blir gjort glatt, ingen må få vite dette, om du fullfører dette oppdraget så er det store muligheter for at du får flere oppdrag senere i tiden.<br><br><b>Info:</b> Stjel bilen i Hamar, frakt den til oslo og selg den der.<br><br>Du har solgt ( $OppdragNiva2 ) av totalt 7 foreløpig."; } 
  elseif($oppdrag_nr == '2') { $Bilde = "Oppdrag-2.jpg"; $Tekst = "<b>Flukten:</b><br>Tre av young guns medlemmene har blitt arrestert, du må bryte ut ".BrukerUrl('Tony Casanabo').", ".BrukerUrl('Abdulhai Shankman')." og ".BrukerUrl('Lee Jang').".<br><br>".BrukerUrl('Tony Casanabo')." soner straffen sin i Bergen.<br>".BrukerUrl('Abdulhai Shankman')." soner straffen i Alta.<br>".BrukerUrl('Lee Jang')." soner straffen sin i Oslo.<br><br>Du får 2.500.000 kr, 2900 respekt og 500 bombechips for jobben."; }
  elseif($oppdrag_nr == '3') {  $Bilde = "Oppdrag-3.jpg"; $Tekst = "<b>Hevn:</b><br>Broren din har fått aids, du må knerte hora som ga broren din sykdommen. Hora sitt navn er ".BrukerUrl('Dirty krystal').", hu jobber ikke fast på et sted så det er mulig hu ikke befinner seg i en fast by hele tiden.<br><br>Du dreper ikke hora mot betaling du gjør det gratis for slekt, det er mulig hora bærer penger eller annet som du kan knabbe av hu etter at hu er død. Du dreper hu ved bruk av drapsfunksjonen."; }
  elseif($oppdrag_nr == '4') {  $Bilde = "Oppdrag-4.jpg"; $Tekst = "Det er dessverre ikke flere oppdrag akkuratt nå."; }
  elseif($oppdrag_nr == '5') {  $Bilde = "Oppdrag-5.jpg"; }
  elseif($oppdrag_nr == '6') {  $Bilde = "Oppdrag-6.jpg"; }
  elseif($oppdrag_nr == '7') {  $Bilde = "Oppdrag-7.jpg"; }
  elseif($oppdrag_nr == '8') {  $Bilde = "Oppdrag-8.jpg"; }
  elseif($oppdrag_nr == '9') {  $Bilde = "Oppdrag-9.jpg"; }
  elseif($oppdrag_nr == '10') { $Bilde = "Oppdrag-10.jpg"; }
  elseif($oppdrag_nr == '11') { $Bilde = "Oppdrag-11.jpg"; }
  elseif($oppdrag_nr == '12') { $Bilde = "Oppdrag-12.jpg"; }
  elseif($oppdrag_nr == '13') { $Bilde = "Oppdrag-13.jpg"; }
  elseif($oppdrag_nr == '14') { $Bilde = "Oppdrag-14.jpg"; }
  elseif($oppdrag_nr == '15') { $Bilde = "Oppdrag-15.jpg"; }
  elseif($oppdrag_nr == '16') { $Bilde = "Oppdrag-16.jpg"; }
        
  echo "<div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/$Bilde\" width=\"490\" height=\"200\"></div>";
  echo "<div class=\"Div_MELDING\"><span style=\"width: 480px; float: left; margin-left:5px; color:#FFFFFF;\">$Tekst<br></span></div>";
  echo "</div>";
  ?>
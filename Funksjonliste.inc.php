  <?php
  if(basename($_SERVER['PHP_SELF']) == "Funksjonliste.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Funksjoner</span></td></tr>
  <tr style=\"height:20px;\"><td class=\"R_4\">Funksjon</td><td class=\"R_4\">Mangler</td><td class=\"R_4\">Status</td></tr>
  
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Banken</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Brekk</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Børsen</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Bordellet</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Bilrace</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Biltyveri</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Drep spiller</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Detektiv utleie</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Dine eiendeler</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Fengsel</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Handel</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Hitlist</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Hærverk</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Kasino</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Kickboksing</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Kidnapp spiller</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Marked</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Midlertidig bunker</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Oppdrag</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Poeng</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Plantasjen</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Platestudio</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Planlagt ran</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Reis</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Sykehus</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Utpress</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Unnergrunnen</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  <tr class=\"Vanlig_1 Ekstra\"><td class=\"Linje Plassering\">Våpentrening</td><td class=\"Linje Plassering\">kommer</td><td class=\"Linje Plassering\">Aktivert</td></tr>
  </table></div>";
        
  }}
  ?>
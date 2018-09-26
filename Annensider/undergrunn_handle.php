  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($type)) { header("Location: index.php"); } else {
  $antall_varer = mysql_real_escape_string($_POST['antall_varer']);
  $valget_er = mysql_real_escape_string($_POST['valget_er']);
  $valgt_vare = mysql_real_escape_string($_POST['number']);

  
  if(empty($antall_varer) || empty($valget_er) || empty($valgt_vare)) { 
  echo '<div class="Div_MELDING">';
  if(empty($valgt_vare)) { echo '<span class="Span_str_5">Du har ikke valgt hvilken vare du skal handle/selge.</span>'; }
  if(empty($antall_varer)) { echo '<span class="Span_str_5">Du har ikke valgt antall varer du skal handle/selge.</span>'; }
  if(empty($valget_er)) { echo '<span class="Span_str_5">Du har ikke valgt om du skal selge eller kjøpe varer.</span>'; }
  echo '</div>';
  } else { 
  $antall_varer = ereg_replace("[^0-9]", "", $antall_varer);
  $antall_varer = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall_varer);
  if(is_numeric($antall_varer)) { 
  if($valget_er == '1' || $valget_er == '2') { 
  if($valgt_vare == 'Kokain' || $valgt_vare == 'Hasj' || $valgt_vare == 'Marihuana' || $valgt_vare == 'Heroin' || $valgt_vare == 'Ecstasy' || $valgt_vare == 'Flatskjerm tv' || $valgt_vare == 'Komplett pc' || $valgt_vare == 'Mobiltelefon' || $valgt_vare == 'Xbox 360' || $valgt_vare == 'Ipod') { 
  if($valgt_vare == 'Kokain') { $gange_pris = $undergrund_pris1; $vare_antall_naa = $Kokain_varer_land; }
  if($valgt_vare == 'Hasj') { $gange_pris = $undergrund_pris2; $vare_antall_naa = $Hasj_varer_land; }
  if($valgt_vare == 'Marihuana') { $gange_pris = $undergrund_pris3; $vare_antall_naa = $Marihuana_varer_land; }
  if($valgt_vare == 'Heroin') { $gange_pris = $undergrund_pris4; $vare_antall_naa = $Heroin_varer_land; }
  if($valgt_vare == 'Ecstasy') { $gange_pris = $undergrund_pris5; $vare_antall_naa = $Ecstasy_varer_land; }
  if($valgt_vare == 'Flatskjerm tv') { $gange_pris = $undergrund_pris6; $vare_antall_naa = $Flatskjerm_varer_land; }
  if($valgt_vare == 'Komplett pc') { $gange_pris = $undergrund_pris7; $vare_antall_naa = $pc_varer_land; }
  if($valgt_vare == 'Mobiltelefon') { $gange_pris = $undergrund_pris8; $vare_antall_naa = $Mobiltelefon_varer_land; }
  if($valgt_vare == 'Xbox 360') { $gange_pris = $undergrund_pris9; $vare_antall_naa = $Xbox_varer_land; }
  if($valgt_vare == 'Ipod') { $gange_pris = $undergrund_pris10; $vare_antall_naa = $Ipod_varer_land; }
  if($valget_er == '1') { 
  $prisen_blir = $antall_varer * $gange_pris;
  $ny_sum_spenn = $penger - $prisen_blir;
  $varer_totalt_er_blir = $varer_totalt_er + $antall_varer;
  if($varer_totalt_er_blir > '500') { 
  echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke eie mer en fem hundre varer på en gang.</span></div>'; 
  } else {
  if($prisen_blir > $penger) { 
  echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>';
  } else { 
  $i = '1';

  while ($i <= $antall_varer) {
  $i++; 
  mysql_query("INSERT INTO Undergrunn_varer (vare_eier,vare_plassert,vare_er,varer_ligger_hos) VALUES ('$brukernavn','$land','$valgt_vare','Ingen')"); 
  }

  mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
  echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kjøpt '.$antall_varer.' vare/r, varetypen er '.$valgt_vare.', prisen ble '.number_format($prisen_blir, 0, ",", ".").' kr.</span></div>';
  }}
  } else { 
  if($antall_varer > $vare_antall_naa) { 
  echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke selge flere varer en du har.</span></div>';
  } else { 
  
  $penger_tilbake_blir = $antall_varer * $gange_pris;
  $ny_sum_spenn = $penger + $penger_tilbake_blir;
  

  mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("DELETE FROM Undergrunn_varer WHERE vare_eier='$brukernavn' AND vare_plassert='$land' AND varer_ligger_hos LIKE 'Ingen' LIMIT $antall_varer") or die(mysql_error());
  echo '<div class="Div_MELDING"><span class="Span_str_6">Du har solgt '.$antall_varer.' vare/r, varetypen er '.$valgt_vare.', du fikk '.number_format($penger_tilbake_blir, 0, ",", ".").' kr.</span></div>';

  
  }}} else { 
  echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan kun velge mellom de varene som selges på undergrunnen.</span></div>';
  }} else { 
  echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan kun velge mellom kjøp og salg.</span></div>';
  }} else { 
  echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan bare bruke siffer når du skal velge x antall varer du skal handle/selge.</span></div>';
  }}}
  ?>
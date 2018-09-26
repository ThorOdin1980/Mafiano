  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(SjekkPlassering($brukernavn) == 'klar') { 
  
  // Variabler
  $KanDrep = $regtid_stamp_din + '300000';
  $Tid_igjen = $KanDrep - $tiden;


  echo "<div class=\"Div_masta\"><form method=\"post\" id=\"Drep\"><div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Drep</span></div><div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Drap.jpg\"></div>";

  if($KanDrep > $tiden) { echo PrintTeksten("Du kan ikke drepe før $Tid_igjen sekunder er omme.","1","Feilet"); }
  
  elseif (time() < strtotime('01-01-2020')) {
    echo PrintTeksten("Drap er stengt frem til 1. Februar kl 21:00.","1","Feilet");
  } 
  elseif(date("H") != '21') { echo PrintTeksten("Du kan drepe mellom 21.00 og 22.00","1","Feilet"); }
  else { 
  

  $H_vopen = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='1' AND forbruk_nr >= '1'");

  $h24since = time() - 82800;

  $H_drap = mysql_query("SELECT * FROM drepte_spillere WHERE `timestampen` > $h24since");

  $sql = mysql_query("SELECT * FROM brukere WHERE liv > 0 AND modkilled = 0");
  $sql = mysql_num_rows($sql);
  $max_drap = ($sql * 10 / 100);

  $sql = mysql_query("SELECT * FROM drap_config");
  $d_conf = mysql_fetch_object($sql);
  $last_updated = $d_conf->last_up;
  $timelimit = time() + 82800;
  if(time() >= $last_updated){
    mysql_query("UPDATE drap_config SET max_kills = '$max_drap', last_up = '$timelimit' WHERE id = 1");
  }
  $maxkills = $d_conf->max_kills;
  if($maxkills >= 1){
    $maxkills = '<span style="font-size: 12px;color: #0f0; font-weight: bold;">'.number_format($maxkills).' drap</span>';
  }else{
    $maxkills = '<span style="font-size: 12px;color: #f00; font-weight: bold;">'.number_format($maxkills).' drap</span>';
  }

  $time_now = time();
  $last_kill = mysql_query("SELECT * FROM DrapsLogg WHERE TimestampDrept BETWEEN '$h24since' AND '$time_now' ORDER BY id DESC");
  $last_killed = mysql_num_rows($last_kill);

  if(mysql_num_rows($H_drap) > 0) { $T_drap = 0; $D_drap = 0;
    while($bi = mysql_fetch_assoc($H_drap)) {
      
      if($bi['morder_navn'] == $brukernavn) { $D_drap++; }
      $T_drap++;
    }
  } else {
    $T_drap = '0'; $D_drap = '0';
  }

  if(mysql_num_rows($H_vopen) == '0') { echo PrintTeksten("Du bærer ingen våpen og kan derfor ikke drepe.","1","Feilet"); }
  elseif($D_drap >= $max_drap) { echo PrintTeksten("Maks 10% av spillerne kan bli drept per dag! Grensen er nådd!","1","Feilet"); }
  elseif($T_drap >= $max_drap) { echo PrintTeksten("Maks 10% av spillerne kan bli drept per dag! Grensen er nådd!.","1","Feilet"); } else { 
  
  // Drep medspiller
  if(isset($_POST['Offer'])) { 
  $Offer = Mysql_Klar($_POST['Offer']);
  $AntallKuler = Bare_Siffer(Mysql_Klar($_POST['AntallKuler'])); 
  $Fluktbil = Bare_Siffer(Mysql_Klar($_POST['bil_valgt']));
  if($type == "A" || $type == "m") { echo PrintTeksten("Du har ikke love til å drepe.","1","Feilet"); }
  elseif(empty($Offer)) { echo PrintTeksten("Du må fylle inn navnet til spilleren du skal drepe.","1","Feilet"); }
  elseif(empty($AntallKuler)) { echo PrintTeksten("Kulesummen mangler.","1","Feilet"); }
  elseif($AntallKuler > $kuler) { echo PrintTeksten("Du har ikke så mange kuler","1","Feilet"); }
  elseif($AntallKuler < '1000') { echo PrintTeksten("Kulesummen er for lav, minimum 1.000 kuler.","1","Feilet"); }
  elseif(empty($Fluktbil)) { echo PrintTeksten("Du må velge en fluktbil.","1","Feilet"); } else { 
  $H_offer = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Offer'");
  if(mysql_num_rows($H_offer) == '0') { echo PrintTeksten("Brukeren $Offer eksisterer ikke.","1","Feilet"); } else { 
  $H_Info = mysql_fetch_assoc($H_offer);
  $Offer = $H_Info['brukernavn'];
  $offer_respekt = $H_Info['respekt'];
  $offer_liv = $H_Info['liv'];
  $offer_type = $H_Info['type'];
  $offer_rankniva = $H_Info['rank_nivaa'];
  $offer_land = $H_Info['land'];
  $offer_drap = $H_Info['drap'];
  $offer_rankprosent = $H_Info['rankpros'];
  $offer_Sex = $H_Info['Kjon'];
  $offer_registrert = $H_Info['regtid_stamp'];
  $offer_stamp_udodlig = $offer_registrert + '300000';

  $StrafferSF = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$Offer' AND StampOver > '$tiden'");  
  if($brukernavn == $Offer) { echo PrintTeksten("Du kan ikke drepe deg selv.","1","Feilet"); }
  elseif($Offer != 'Dirty krystal' && time() < strtotime('01-02-2017')) {
    echo PrintTeksten("Drap åpner 1. Februar kl 21:00.","1","Feilet");
  }
  elseif($offer_liv < '1') { echo PrintTeksten("$Offer er allerede død.","1","Feilet"); }
  elseif($offer_stamp_udodlig > $tiden) { echo PrintTeksten("$Offer er nylig registrert og kan derfor ikke drepes enda.","1","Feilet"); }
  elseif(mysql_num_rows($StrafferSF) >= '1') { echo PrintTeksten("$Offer soner en straff.","1","Feilet"); }
  elseif($offer_type == 'A' || $offer_type == 'm' || ($offer_type == 'b' && $Offer != 'Dirty krystal')) { echo PrintTeksten("Du kan ikke drepe en moderator/administrator/bot.","1","Feilet"); }
  elseif($Offer == 'Dirty krystal' && $oppdrag_nr != '3') { echo PrintTeksten("Du kan ikke drepe en moderator/administrator/bot.","1","Feilet"); }
  elseif($Fluktbil == '00') { echo PrintTeksten("Du har desverre ingen biler du kan bruke som fluktbil.","1","Feilet"); } else { 
  $Fluktbil = $Fluktbil - '421';

  $H_bil = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND land='$land' AND id LIKE '$Fluktbil' AND TransportEll < '$tiden'");
  if(mysql_num_rows($H_bil) == '0') { echo PrintTeksten("Du kan ikke bruke en bil du ikke eier.","1","Feilet"); } else { 
  include "Abc_DrepMedKuler.php";
  }}}}}

  if(empty($_POST['Offer'])) { $Box_Drep = ""; } else { $Box_Drep = $_POST['Offer']; }
  if(empty($_POST['AntallKuler'])) { $Box_Kuler = ""; } else { $Box_Kuler = Bare_Siffer($_POST['AntallKuler']); }


  $BilerBy = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND land='$land' AND TransportEll < '$tiden'");
  if(mysql_num_rows($BilerBy) == 0) { $DinBiler = "<option value=\"00\">Ingen biler</option>"; } else { 
  while($BilInfo = mysql_fetch_assoc($BilerBy)) { 
  $Fake = $BilInfo['id'] + '421';
  $Hk = substr($BilInfo['hestekrefter'], 0, 1);
  if($Hk == '0') { $Hk = substr($BilInfo['hestekrefter'], 1); } else { $Hk = $BilInfo['hestekrefter']; }
  $DinBiler = $DinBiler."<option value=\"$Fake\">Bilmerke: ".$BilInfo['bilmerke']." Hestekrefter: $Hk</option>"; 
  }}

  // Html form her
  echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gjenstående drap:</span></div><div class=\"Div_hoyre_side_1\">".$maxkills."</div>";
  echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Drapsoffer</span></div><div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Offer\" maxlength=\"30\"  value=\"$Box_Drep\"></div>";
  echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antall kuler</span></div><div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"AntallKuler\" maxlength=\"30\"  value=\"$Box_Kuler\"></div>";
  echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Fluktbil</span></div><div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"bil_valgt\">$DinBiler</select></div>";
  echo "<div class=\"Div_venstre_side_1\">&nbsp;</div><div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Drep').submit()\"><p class=\"pan_str_2\">DREP</p></div>";
  
  }}
  echo "</form></div>";
  }
  ?>
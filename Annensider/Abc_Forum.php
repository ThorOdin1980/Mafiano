  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script>
  $(document).ready(function() {
  $('#PostTraad').hide(); $('#Opprett').click(function() { if ($('#PostTraad').is(":hidden")) { $('#PostTraad').fadeIn("slow"); } else { $('#PostTraad').fadeOut("slow"); }});   
  
  $('#PostFormen').click(function() {
  
  var rank = parseInt('<? echo $rank_niva; ?>');
  var grense = parseInt('3');
  if(grense > rank) { alert('Du har ikke høy nok rank enda.'); }
  else if($('#Tittel_P').val() == "") { alert('Tittel feltet er tomt.'); }
  else if($('#Tittel_P').val().length < "3") { alert('Tittelen er for kort, minimum 3 tegn.'); }
  else if($('#Tittel_P').val().length > "20") { alert('Tittelen er for langt, maks 20 tegn.'); }
  else if($('#Innhold_P').val() == "") {  alert('Innholdet mangler.'); }
  else if($('#Innhold_P').val().length < "50") { alert('Innholdet må bestå av mer en 50 tegn.'); }
  //else if($('#Innhold_P').val().length > "5000") { alert('Innholdet er for langt.'); } 
  else { document.getElementById('<? echo $submit_knapp_1; ?>').submit() }
  });
  
  });
  
  </script>

  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else { 
  $antall = AntallSider($_REQUEST['s']);
  $forum = Bare_Bokstaver($_REQUEST['t']);
  
  if($forum == 'RF' || $forum == 'FF' || $forum == 'SF' || $forum == 'KF' || $forum == 'GF') { $forum = $forum; } else { $forum = 'FF'; }
  
  $True = "Nei";
  $EkstraSpors = "";
  $GjengId = "";
  if($forum == 'GF') { 
  if(empty($gjeng)) { header("Location: game.php"); } else { 

  $HentGjeng = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE brukernavn='$brukernavn'");
  if(mysql_num_rows($HentGjeng) == '0') { header("Location: game.php"); } else {
  $IG = mysql_fetch_assoc($HentGjeng);
  $GjengId = $IG['gjeng_id'];
  $GjengStilling = $IG['stilling'];
  if($GjengStilling == 'Boss') { $True = "Ja"; } else { $True = "Nei"; }
  $EkstraSpors = "AND startet_gjeng='$GjengId'";
  }}}
  
  if($forum == 'RF') { if($type == 's' || $type == 'sf' || $type == 'bz' || $type == 'mi' || $type == 'fm' || $type == 'm' || $type == 'A') { } else { header("Location: game.php"); }}
  
  if($forum == 'RF') { $Tekst = "Ledelsen"; } 
  elseif($forum == 'FF') { $Tekst = "Off-toptic"; }
  elseif($forum == 'SF') { $Tekst = "Salg/søknad"; }
  elseif($forum == 'KF') { $Tekst = "Kriminalitet"; }
  elseif($forum == 'GF') { $Tekst = "Gjeng"; }

  if(isset($_POST['Type_P'])) { 
  $Tittel_P = Mysql_Klar($_POST['Tittel_P']);
  $Type_P = Mysql_Klar($_POST['Type_P']);
  $Tidsrom_P = Mysql_Klar($_POST['Tidsrom_P']);
  $Sticky_P = Mysql_Klar($_POST['Sticky_P']);
  $Innhold_P = Melding_Klar($_POST['Innhold_P']);

  if($rank_niva >= '3') { 
  if(!empty($Tittel_P) && !empty($Type_P) && !empty($Tidsrom_P) && !empty($Sticky_P) && !empty($Innhold_P)) { 
  if(strlen($Tittel_P) >= '3' && strlen($Tittel_P) < '20') { 
  if($Type_P == 'Fri prat' || $Type_P == 'Kun bud i kroner') { 
  if($Tidsrom_P == 'Ingen tidslengde' || $Tidsrom_P == '1 dag' || $Tidsrom_P == '2 dager' || $Tidsrom_P == '3 dager' || $Tidsrom_P == '4 dager' || $Tidsrom_P == '5 dager' || $Tidsrom_P == '6 dager' || $Tidsrom_P == '7 dager' || $Tidsrom_P == '8 dager' || $Tidsrom_P == '9 dager') { 
  if($Sticky_P == 'Ja' || $Sticky_P == 'Nei') { 
  if(strlen($Innhold_P) >= '50' ) {  // && strlen($Innhold_P) < '5000'

  if($Sticky_P == 'Ja' && ($type == 'A' || $type == 'm' || $type == 'fm' || $type == 'sf' || $True == 'Ja')) { $Sticky_P = 'Sticky'; } else { $Sticky_P = 'Vanlig'; }
  if($Type_P == 'Fri prat') { $Type_P = 'Diskusjon'; } else { $Type_P = 'Høyeste bud'; }
  if($Tidsrom_P == 'Ingen tidslengde') { $Tidsrom_P = '0'; } else { $Tidsrom_P = $Timestamp + (Bare_Siffer($Tidsrom_P) * '86400'); }
  if($Sticky_P == 'Sticky') { $tid_poste = $Timestamp * '20'; } else { $tid_poste = $Timestamp; }


  mysql_query("UPDATE brukere SET Forumemner=`Forumemner`+'1',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO forum_traader (startet_av, startet_dato, startet_stamp, startet_innhold, startet_tittel, startet_gjeng, startet_kategori, startet_type, startet_sticky, startet_timestamp_slutt, aktiv_eller) VALUES ('$brukernavn','$FullDato','$Timestamp','$Innhold_P','$Tittel_P','$GjengId','$Type_P','$forum','$Sticky_P','$Tidsrom_P','$tid_poste')"); 
  
  }}}}}}}}



  echo "
  <div class=\"Div_masta\" id=\"PostTraad\" name=\"PostTraad\">
  <form method=\"post\" id=\"$submit_knapp_1\">
  <input type=\"hidden\" name=\"Type_P\" id=\"Type_P\" value=\"Fri prat\"/>
  <input type=\"hidden\" name=\"Tidsrom_P\" id=\"Tidsrom_P\" value=\"Ingen tidslengde\"/>
  <input type=\"hidden\" name=\"Sticky_P\" id=\"Sticky_P\" value=\"Nei\"/>
  <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Ny forumtråd</span></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Tittel</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" id=\"Tittel_P\" name=\"Tittel_P\" maxlength=\"20\" value=\"\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Type</span></div>
  <div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('Type')\"><div id=\"Velg type\" class=\"Span_str_9\"><b>Velg type:</b> Frit prat</div><div id=\"Type\" class=\"D_Boks\"><div class=\"D_Over\" onclick=\"VisValg('Velg type','Fri prat','Type_P')\">---> Fri prat</div><div class=\"D_Over\" onclick=\"VisValg('Velg type','Kun bud i kroner','Type_P')\">---> Kun bud i kroner</div></div></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Tidsrom</span></div>
  <div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('Tidsrom')\"><div id=\"Velg tidslengde\" class=\"Span_str_9\"><b>Velg tidsrom:</b> Ingen tidslengde</div><div id=\"Tidsrom\" class=\"D_Boks\"><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','Ingen tidslengde','Tidsrom_P')\">---> Ingen tidslengde</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','1 dag','Tidsrom_P')\">---> 1 dag</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','2 dager','Tidsrom_P')\">---> 2 dager</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','3 dager','Tidsrom_P')\">---> 3 dager</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','4 dager','Tidsrom_P')\">---> 4 dager</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','5 dager','Tidsrom_P')\">---> 5 dager</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','6 dager','Tidsrom_P')\">---> 6 dager</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','7 dager','Tidsrom_P')\">---> 7 dager</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','8 dager','Tidsrom_P')\">---> 8 dager</div><div class=\"D_Over\" onclick=\"VisValg('Velg tidslengde','9 dager','Tidsrom_P')\">---> 9 dager</div></div></div>
  ";
  
  if($type == 'A' || $type == 'm' || $type == 'fm' || $type == 'sf' || $True == 'Ja') { echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Sticky</span></div><div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('EkstraV')\"><div id=\"Sticky\" class=\"Span_str_9\"><b>Sticky:</b> Nei</div><div id=\"EkstraV\" class=\"D_Boks\"><div class=\"D_Over\" onclick=\"VisValg('Sticky','Ja','Sticky_P')\">---> Ja</div><div class=\"D_Over\" onclick=\"VisValg('Sticky','Nei','Sticky_P')\">---> Nei</div></div></div>"; }
  
  echo "
  <div class=\"Div_venstre_side_2\"></div>
  <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"Innhold_P\" id=\"Innhold_P\"></textarea></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" id=\"PostFormen\"><p class=\"pan_str_2\">POST TRÅD</p></div>
  <div class=\"Div_mellomledd\">&nbsp;</div>
  </form></div>
  ";

  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"4\"><span style=\"float:left; line-height:30px;\">$Tekst forum</span><span class=\"Opprett\" id=\"Opprett\" mane=\"Opprett\">( Opprett ny forumtråd )</span></td></tr><tr style=\"height:20px;\"><td class=\"R_4\">Tittel</td><td class=\"R_4\">Trådstarter</td><td class=\"R_4\">Svar</td><td class=\"R_4\">Siste innlegg</td></tr>";

  $H = mysql_query("SELECT * FROM forum_traader WHERE id LIKE '%' AND startet_type='$forum' AND Slettet_ell='Nei' $EkstraSpors ORDER BY `aktiv_eller` DESC LIMIT $antall, 20");
  if(mysql_num_rows($H) >= '1') {
  $Tell = '0';
  while ($I = mysql_fetch_assoc($H)) { 
  $Tell++;
  $fake_id = Krypt_Tall($I['id']);
  if($Tell % 2 == 0) { 
  if($I['startet_sticky'] == 'Sticky') { $Sticky = "<span class=\"Sticky\">(Sticky)</span>"; $Klasse = "Viktig_1"; } else { $Sticky = ""; $Klasse = "Vanlig_1"; }
  } else { 
  if($I['startet_sticky'] == 'Sticky') { $Sticky = "<span class=\"Sticky\">(Sticky)</span>"; $Klasse = "Viktig_2"; } else { $Sticky = ""; $Klasse = "Vanlig_2"; }}
  echo "<tr class=\"$Klasse\"><td class=\"Linje Toptic\" onclick='document.location.href=\"game.php?side=LesForum&t=$forum&id=$fake_id\"'>".$I['startet_tittel']." $Sticky</td><td class=\"Linje Plassering\">".BrukerURL($I['startet_av'])."<br>".$I['startet_dato']."</td><td class=\"Linje Plassering\" style=\"color:#ffffff;\">".$I['startet_svar']."</td><td class=\"Linje Plassering\">".BrukerURL($I['siste_innlegg'])."<br>".$I['siste_dato']."</td></tr>";  
  }}
  

  $H2 = mysql_query("SELECT * FROM forum_traader WHERE id LIKE '%' AND startet_type='$forum' AND Slettet_ell='Nei' $EkstraSpors");
  $antall_rader = mysql_num_rows($H2);
  $antall_sider = $antall_rader / '20';
  if($antall_sider < '1') { $antall_sider = '0'; } else {
  echo "<tr><td class=\"R_9\" colspan=\"4\"><span class=\"T_3\">";
  $i = '0';
  while ($i <= $antall_sider) {
  $i++;
  $side_tall = '20' * $i;
  $side_tall = $side_tall - '20';
  if($i < '10') { $ekstra = '0'; } else { $ekstra = ''; }
  echo '<a href="game.php?side=Forum&s='.$side_tall.'&t='.$forum.'">['.$ekstra.''.$i.'] </a>';
  if($i == '20' || $i == '40' || $i == '60' || $i == '80' || $i == '100') { echo '<br>'; }
  if($i == '99') { break; } 
  }
  echo '</span></td></tr>';
  }
  
  echo "</table></div>";
  } 
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else {
  $Forum = Bare_Bokstaver($_REQUEST['t']);
  $Antall = AntallSider($_REQUEST['s']);
  
  $ForumIDEN = $_REQUEST['id'];
  $ForumID = Dekrypt_Tall(Bare_Bokstaver($_REQUEST['id']));

  if($Forum == 'RF' || $Forum == 'FF' || $Forum == 'SF' || $Forum == 'KF' || $Forum == 'GF') { $Forum = $Forum; } else { $Forum = 'FF'; }
  
  if($Forum == 'RF') { $Tekst = "Ledelsen";} 
  elseif($Forum == 'FF') { $Tekst = "Off-toptic"; }
  elseif($Forum == 'SF') { $Tekst = "Salg/søknad"; }
  elseif($Forum == 'KF') { $Tekst = "Kriminalitet"; }
  elseif($Forum == 'GF') { $Tekst = "Gjeng"; }

  $True = "Nei";
  $EkstraSpors = "";
  $GjengId = "";
  if($Forum == 'GF') { 
  if(empty($gjeng)) { header("Location: game.php"); } else { 

  $HentGjeng = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE brukernavn='$brukernavn'");
  if(mysql_num_rows($HentGjeng) == '0') { header("Location: game.php"); } else {
  $IG = mysql_fetch_assoc($HentGjeng);
  $GjengId = $IG['gjeng_id'];
  $GjengStilling = $IG['stilling'];
  if($GjengStilling == 'Boss') { $True = "Ja"; } else { $True = "Nei"; }
  $EkstraSpors = "AND forum_traader.startet_gjeng='$GjengId'";
  $EkstraSporsTo = "AND startet_gjeng='$GjengId'";
  }}}
  
  if(!isset($forum))  { $forum = ''; }
  if(!isset($_POST['du_velger'])) { $_POST['du_velger'] = ''; }
  if(!isset($EkstraSporsTo))  { $EkstraSporsTo = ''; }
  
  if($forum == 'RF') { if($type == 's' || $type == 'sf' || $type == 'bz' || $type == 'mi' || $type == 'fm' || $type == 'm' || $type == 'A') { } else { header("Location: game.php"); }}


  $Emne = mysql_query("SELECT forum_traader.*,brukere.brukernavn,brukere.type,brukere.profilbilde,brukere.Kjon,brukere.signatur,brukere.rank,brukere.aktiv_eller FROM forum_traader LEFT JOIN brukere ON brukere.brukernavn=forum_traader.startet_av WHERE forum_traader.id='$ForumID' AND forum_traader.startet_type='$Forum' AND forum_traader.Slettet_ell='Nei' $EkstraSpors");
  if(mysql_num_rows($Emne) == '0') { header("Location: game.php"); } else { 
  $EmneI = mysql_fetch_assoc($Emne);
  $ID_Blir = $EmneI['id'];
  if($EmneI['startet_timestamp_slutt'] == '0') { $Til_sek = '99'; } else { $Til_sek = $EmneI['startet_timestamp_slutt'] - $tiden; }
  if($EmneI['startet_sticky'] == 'Sticky') { $EK = $tiden * '20'; } else { $EK = '0'; } $Opprettet = $tiden + $EK;
  
  
  if($_POST['du_velger'] == 'ResirkulerEmne') { 
  if($type == 'A' || $type == 'm' || $type == 'fm' || $type == 'sf' || $True == 'Ja') { // REMOVED  $EmneI['startet_av'] == $brukernavn ||
  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE forum_traader SET startet_svar='0' WHERE id='$ID_Blir'");
  mysql_query("UPDATE forum_svar SET slettet_ell='Ja' WHERE traad_id='$ID_Blir'");     
  }}
  if($_POST['du_velger'] == 'SlettForumEmne') { 
  if($type == 'A' || $type == 'm' || $type == 'fm' || $type == 'sf' || $True == 'Ja') { // REMOVED  $EmneI['startet_av'] == $brukernavn||
  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE forum_traader SET Slettet_ell='Ja' WHERE id='$ID_Blir'");
  mysql_query("UPDATE forum_svar SET slettet_ell='Ja' WHERE traad_id='$ID_Blir'");     
  header("Location: game.php?side=Forum&t=$Forum");
  }}
  elseif($_POST['du_velger'] == 'SvarTilEmne') { 
  $Innhold_P = Melding_Klar($_POST['Innhold_P']);
  if($rank_niva >= '2') { 
  if($Til_sek > '1') { 
  if(!empty($Innhold_P)) { 
  if(strlen($Innhold_P) >= '2') {  //  && strlen($Innhold_P) < '5000'

  mysql_query("UPDATE brukere SET Forumsvar=`Forumsvar`+'1',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE forum_traader SET startet_svar=`startet_svar`+'1',aktiv_eller='$Opprettet',siste_innlegg='$brukernavn',siste_dato='$tid $nbsp $dato' WHERE id='$ID_Blir'");
  mysql_query("INSERT INTO forum_svar (traad_id,dato_opprettet,startet_type,timestampen_opprettet,innhold_tekst,skrevet_av) VALUES ('$ID_Blir','$FullDato','$Forum','$Timestamp','$Innhold_P','$brukernavn')");
  }}}}}
  elseif($_POST['du_velger'] == 'RedigerEmne') { 
  $RedigerEmnet = Melding_Klar($_POST['RedigerEmne_P']);
  if($type == 'A' || $type == 'm' || $type == 'fm' || $type == 'sf' || $True == 'Ja') { // REMOVED  $EmneI['startet_av'] == $brukernavn ||
  if(!empty($RedigerEmnet)) { 
  if(strlen($RedigerEmnet) >= '2' && strlen($RedigerEmnet) < '5000') { 

  mysql_query("UPDATE forum_traader SET RedigertAv='$brukernavn',DatoRedigert='$FullDato',startet_innhold='$RedigerEmnet' WHERE id='$ID_Blir'");
  }}}}
  
  ?>
  <script>
  $(document).ready(function() {
  $('#PostSvar').hide(); $('#RedigerEmne').hide();
  
  $('#Opprett').click(function() { $('#RedigerEmne').hide(); if ($('#PostSvar').is(":hidden")) { $('#PostSvar').fadeIn("slow"); window.scrollTo(100,0); } else { $('#PostSvar').fadeOut("slow"); }});   
  $('#RedEmne').click(function() { $('#PostSvar').hide(); if ($('#RedigerEmne').is(":hidden")) { $('#RedigerEmne').fadeIn("slow"); window.scrollTo(100,0); } else { $('#RedigerEmne').fadeOut("slow"); }});   

  
  $('#PostFormen').click(function() {
  var rank = parseInt('<? echo $rank_niva; ?>');
  var grense = parseInt('2');
  var stengt = parseInt('<? echo $Til_sek; ?>');
  if(grense > rank) { alert('Du har ikke høy nok rank enda.'); }
  else if(stengt < '1') { alert('Forumet er stengt.'); }
  else if($('#Innhold_P').val() == "") {  alert('Innholdet mangler.'); }
  else if($('#Innhold_P').val().length < "2") { alert('Innholdet må bestå av mer en 2 tegn.'); }
  //else if($('#Innhold_P').val().length > "5000") { alert('Innholdet er for langt.'); } 
  else { document.getElementById('du_velger').value='SvarTilEmne';document.getElementById('<? echo $submit_knapp_1; ?>').submit(); }
  });
  
  $('#PostFormenTo').click(function() {
  if($('#RedigerEmne_P').val() == "") {  alert('Innholdet mangler.'); }
  else if($('#RedigerEmne_P').val().length < "2") { alert('Innholdet må bestå av mer en 2 tegn.'); }
 // else if($('#RedigerEmne_P').val().length > "5000") { alert('Innholdet er for langt.'); } 
  else { document.getElementById('du_velger').value='RedigerEmne';document.getElementById('<? echo $submit_knapp_1; ?>').submit(); }
  });
  
  $(".Bravo").click(function() { window.scrollTo(100,0); });  
  
  $("#XxXemne").click(function() { 
  if (confirm('Er du sikker på at du vil slette dette emne?')) { 
  var stilling = "<? echo $type; ?>";
  var sjef = "<? echo $True; ?>";
  var navn = "<? echo $brukernavn; ?>"; <?php /* REMOVED  || navn == ' echo $EmneI['startet_av']; ' */ ?>
  if(stilling == 'A' || stilling == 'm' || stilling == 'fm' || stilling == 'sf' || sjef == 'Ja') { 
  document.getElementById('du_velger').value='SlettForumEmne';document.getElementById('<? echo $submit_knapp_1; ?>').submit();
  } else { 
  alert('Du har ikke lov til og slette forumemner.');
  }}});
  
  $("#RrRemne").click(function() { 
  if (confirm('Er du sikker på at du vil resirkulere emne?')) { 
  var stilling = "<? echo $type; ?>";
  var sjef = "<? echo $True; ?>";
  var navn = "<? echo $brukernavn; ?>";
													<?php /* REMOVED  || navn == ' echo $EmneI['startet_av']; ' */ ?>
  if(stilling == 'A' || stilling == 'm' || stilling == 'fm' || stilling == 'sf' || sjef == 'Ja') { 
  document.getElementById('du_velger').value='ResirkulerEmne';document.getElementById('<? echo $submit_knapp_1; ?>').submit();
  } else { 
  alert('Du har ikke lov til og resirkulere forumemner.');
  }}});
  
  });
  
  </script>
  <?
  if($EmneI['type'] == 'u') { $Stilling = "Spiller"; }
  elseif($EmneI['type'] == 'b') { $Stilling = "MafiaNo bot"; }
  elseif($EmneI['type'] == 's') { $Stilling = "Support spiller"; }
  elseif($EmneI['type'] == 'sf') { $Stilling = "Support ansvarlig"; }
  elseif($EmneI['type'] == 'bz') { $Stilling = "Bugzorz"; }
  elseif($EmneI['type'] == 'mi') { $Stilling = "mIRC ansvarlig"; }
  elseif($EmneI['type'] == 'fm') { $Stilling = "Forum moderator"; }
  elseif($EmneI['type'] == 'm') { $Stilling = "Moderator"; }
  elseif($EmneI['type'] == 'A') { $Stilling = "Administrator"; }

  if(empty($EmneI['profilbilde']) || $EmneI['profilbilde'] == 'http://') {
  if($EmneI['Kjon'] == 'Gutt') { $URL = 'http://www.mafiano.no/mafia222.png'; } 
  if($EmneI['Kjon'] == 'Jente') { $URL = 'http://www.mafiano.no/mafia555.png'; } 
  } else { $URL = htmlspecialchars($EmneI['profilbilde']); }
  
  $TekstVisEn = url(smil(html_entity_decode($EmneI['startet_innhold'])));


  
  $Ranks = $EmneI['rank'];

  if(empty($EmneI['signatur'])) { $Signatur = ""; } else { $Signatur = "<span class=\"Box_3\"><p align=\"center\"><img style=\"max-width:472px; max-height:100px;\" src=\"".$EmneI['signatur']."\" title=\"Signatur\"></p></span>"; }

  // REMOVED  || $brukernavn == $EmneI['startet_av'])
  
  if($type == 'A' || $type == 'fm' || $type == 'm' || $type == 'sf' || $True == 'Ja') { $Oppe1 = "Ja"; $Granted1 = "<a id=\"XxXemne\" class=\"slett\" title=\"Slett emne\"><a id=\"RrRemne\" class=\"resirkuler\" title=\"Resirkuler emne\"></a></a><a class=\"rediger\" id=\"RedEmne\" title=\"Rediger emne\"></a>"; } else { $Granted1 = ""; }
  if(empty($EmneI['RedigertAv'])) { $Redigering1 = ""; } else { $Oppe1 = "Ja"; $Redigering1 = "<p class=\"top\">Sist redigert av ".BrukerURL($EmneI['RedigertAv'])." ".$EmneI['DatoRedigert']."</p>"; }
  if($Oppe1 == 'Ja') { $Box_33 = "<span class=\"Box_3\">$Redigering1 $Granted1</span>"; } else { $Box_33 = ""; }
  
  echo "<form method=\"post\" id=\"$submit_knapp_1\">";
  
  echo "
  <div class=\"Div_masta\" id=\"PostSvar\" name=\"PostSvar\">
  <input type=\"hidden\" name=\"du_velger\" id=\"du_velger\" />
  <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Opprett svar</span></div>
  <div class=\"Div_venstre_side_2\"><span class=\"Span_str_1\">Tekst</span></div>
  <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"Innhold_P\" id=\"Innhold_P\"></textarea></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" id=\"PostFormen\"><p class=\"pan_str_2\">POST SVAR</p></div>
  <div class=\"Div_mellomledd\">&nbsp;</div>
  </div>
  ";
  
  echo "
  <div class=\"Div_masta\" id=\"RedigerEmne\" name=\"RedigerEmne\">
  <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Rediger emne</span></div>
  <div class=\"Div_venstre_side_2\"><span class=\"Span_str_1\">Tekst</span></div>
  <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"RedigerEmne_P\" id=\"RedigerEmne_P\">".html_entity_decode($EmneI['startet_innhold'])."</textarea></div>
  <div class=\"Div_venstre_side_1\">&nbsp;</div>
  <div class=\"Div_submit_knapp_2\" id=\"PostFormenTo\"><p class=\"pan_str_2\">Lagre</p></div>
  <div class=\"Div_mellomledd\">&nbsp;</div>
  </div>
  ";
  
  echo "</form>";
    
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\">";
  echo "<tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">$Tekst forum</span><span class=\"Opprett\" id=\"Opprett\" mane=\"Opprett\">( Opprett svar )</span></td></tr>";
  echo "<tr><td class=\"Linje Forum_2\"><span class=\"Box_1\"><p class=\"tekst\">".$EmneI['startet_dato']." - Av ".BrukerURL($EmneI['startet_av'])."</p><p class=\"rap\">Rapporter</p></span><span class=\"Box_2\"><span class=\"img\" onclick='document.location.href=\"game.php?side=Bruker&navn=".urlencode($EmneI['startet_av'])."\"'><p class=\"en\">$Stilling</p><img src=\"$URL\"><p class=\"to\">$Ranks</p></span><font style=\"font-size:15px; font-weight:bold;\">".$EmneI['startet_tittel']."</font><br>$TekstVisEn</span>$Signatur $Box_33</td></tr>";


  $Svar = mysql_query("SELECT forum_svar.*,brukere.brukernavn,brukere.type,brukere.profilbilde,brukere.Kjon,brukere.signatur,brukere.rank,brukere.aktiv_eller FROM forum_svar LEFT JOIN brukere ON brukere.brukernavn=forum_svar.skrevet_av WHERE forum_svar.traad_id='$ID_Blir' AND forum_svar.startet_type='$Forum' AND forum_svar.Slettet_ell='Nei' ORDER BY forum_svar.timestampen_opprettet DESC LIMIT $Antall, 20");
  if(mysql_num_rows($Svar) >= '1') {
  while($SvarI = mysql_fetch_assoc($Svar)) { 
  

  if($SvarI['type'] == 'u') { $Stilling = "Spiller"; }
  elseif($SvarI['type'] == 'b') { $Stilling = "MafiaNo bot"; }
  elseif($SvarI['type'] == 's') { $Stilling = "Support spiller"; }
  elseif($SvarI['type'] == 'sf') { $Stilling = "Support ansvarlig"; }
  elseif($SvarI['type'] == 'bz') { $Stilling = "Bugzorz"; }
  elseif($SvarI['type'] == 'mi') { $Stilling = "mIRC ansvarlig"; }
  elseif($SvarI['type'] == 'fm') { $Stilling = "Forum moderator"; }
  elseif($SvarI['type'] == 'm') { $Stilling = "Moderator"; }
  elseif($SvarI['type'] == 'A') { $Stilling = "Administrator"; }

  if(empty($SvarI['profilbilde']) || $SvarI['profilbilde'] == 'http://') {
  if($SvarI['Kjon'] == 'Gutt') { $URL = 'http://www.mafiano.no/mafia222.png'; } 
  if($SvarI['Kjon'] == 'Jente') { $URL = 'http://www.mafiano.no/mafia555.png'; } 
  } else { $URL = htmlspecialchars($SvarI['profilbilde']); }
  

  $TekstVis = html_entity_decode($SvarI['innhold_tekst']);
  $TekstVis = url(smil($TekstVis));
  $Ranks = $SvarI['rank'];

  if(empty($SvarI['signatur'])) { $Signaturen = ""; } else { $Signaturen = "<span class=\"Box_3\"><p align=\"center\"><img style=\"max-width:472px; max-height:100px;\" src=\"".$SvarI['signatur']."\" title=\"Signatur\"></p></span>"; }

  
  // REMOVED  $brukernavn == $SvarI['skrevet_av']) ||
  
  if($type == 'A' || $type == 'fm' || $type == 'm' || $type == 'sf' || $True == 'Ja') { $Oppe = "Ja"; $Granted = "<a class=\"slett\" title=\"Slett svar\"></a><a class=\"rediger\" title=\"Rediger svar\"></a>"; } else { $Granted = ""; }
  if(empty($SvarI['RedigertAv'])) { $Redigering = ""; } else { $Oppe = "Ja"; $Redigering = "<p class=\"top\">Sist redigert av ".BrukerURL($SvarI['RedigertAv'])." ".$SvarI['DatoRedigert']."</p>"; }
  if($Oppe == 'Ja') { $Box_3 = "<span class=\"Box_3\">$Redigering $Granted</span>"; } else { $Box_3 = ""; }

  echo "<tr><td class=\"Linje Forum_1\"><span class=\"Box_1\"><a class=\"Bravo\" title=\"Til toppen\"></a><p class=\"top\">".$SvarI['dato_opprettet']." - Av ".BrukerURL($SvarI['skrevet_av'])."</p><p class=\"rap\">Rapporter</p></span><span class=\"Box_2\"><span class=\"img\" onclick='document.location.href=\"game.php?side=Bruker&navn=".urlencode($SvarI['skrevet_av'])."\"'><p class=\"en\">$Stilling</p><img src=\"$URL\"><p class=\"to\">$Ranks</p></span>$TekstVis</span>$Signaturen $Box_3</td></tr>";
  
  }}
  

  $H2 = mysql_query("SELECT * FROM forum_svar WHERE traad_id='$ID_Blir' AND startet_type='$Forum' AND Slettet_ell='Nei' $EkstraSporsTo");
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
  echo '<a href="game.php?side=LesForum&id='.$ForumIDEN.'&s='.$side_tall.'&t='.$Forum.'">['.$ekstra.''.$i.'] </a>';
  if($i == '20' || $i == '40' || $i == '60' || $i == '80' || $i == '100') { echo '<br>'; }
  if($i == '99') { break; } 
  }
  echo '</span></td></tr>';
  }

  echo "</table></div>";

  
  }}
  ?>
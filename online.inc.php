  <?php
  if(basename($_SERVER['PHP_SELF']) == "online.inc.php") { header("Location: index.php"); exit; } else {
  
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') {
  
  echo "
  <script>
  function LoggDenUt(Bid,Rad) { 
  $.post('post.php?MebOnline=True&LoggUt='+Bid);
  $('#'+Rad).fadeOut(1000);
  }
  </script>
  ";
  
  if($_GET['LoggUt']) { 
  $UtEr = Bare_Bokstaver(Mysql_Klar($_GET['LoggUt']));
  if(!empty($UtEr)) {
  $UtEr = Dekrypt_Tall($UtEr);
 
  mysql_query("UPDATE brukere SET aktiv_eller='$Timestamp' WHERE brukerid='$UtEr'");
  }}}
  
  if(empty($_GET['Antall'])) { $Antall = '0'; } else { $Antall = Bare_Siffer(Mysql_Klar($_GET['Antall'])); }
  

  if($_GET['Venn'] == 'True') { $VelgOn = "kontakter.kontaktnavn=brukere.brukernavn"; $Opprett = "Vis alle"; $Tek = "venner"; } else { $VelgOn = "brukere.brukerid LIKE '%'"; $Opprett = "Vis venner"; $Tek = "medlemmer"; }
  $Pa = mysql_query("SELECT brukere.brukerid FROM brukere LEFT JOIN kontakter ON kontakter.dittbrukernavn='$brukernavn' AND kontakter.kontaktnavn=brukere.brukernavn WHERE $VelgOn AND brukere.aktiv_eller > $Timestamp");
  $H = mysql_query("SELECT brukere.*,kontakter.dittbrukernavn,kontakter.status FROM brukere LEFT JOIN kontakter ON kontakter.dittbrukernavn='$brukernavn' AND kontakter.kontaktnavn=brukere.brukernavn WHERE $VelgOn AND brukere.aktiv_eller > $Timestamp ORDER BY brukere.regtid_stamp LIMIT $Antall,20");
  if(mysql_num_rows($H) == '0') { $R_On = "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ingen $Tek pålogget for øyeblikket.</span></td></tr>"; } else { 
  $Tell = '0';
  while($i = mysql_fetch_assoc($H)) { 
  $Tell++;
  
  if(empty($i['profilbilde']) || $i['profilbilde'] == 'http://') {if($i['Kjon'] == 'Gutt') { $URL = 'http://www.mafiano.no/mafia222.png'; } if($i['Kjon'] == 'Jente') { $URL = 'http://www.mafiano.no/mafia555.png'; }} else { $URL = htmlspecialchars($i['profilbilde']); }
  
  $I_UrlBruker = urlencode($i['brukernavn']);
  $KunID = Krypt_Tall($i['brukerid']);
  $Draps = DrapStatus($i['drap']);
  if($i['type'] == 'u') { $Stilling = ""; } else { $Stilling = "( ".Stilling($i['type'])." )"; }
  if(!empty($i['status'])) { $venn = "<p>".$i['status']."</p>"; } else { $venn = ''; }
  if(empty($i['gjeng'])) { $GjengEr = "Ingen"; } else { $GjengEr = "<b><a href=\"game.php?side=Gjeng&navn=".urlencode($i['gjeng'])."\">".$i['gjeng']."</a></b>"; }
  
  if($rad_B['type'] == 'A') { $Ek = "<p title=\"Logg ut\" onclick=\"LoggDenUt('$KunID','$Tell')\"><img src=\"../Design/Avlogg.png\"></p>"; } else { $Ek = ''; }
  if($brukernavn == $i['brukernavn']) { $Knap = "<p class=\"GoTop\" title=\"Gå til toppen av siden\"><img src=\"../Design/Top.png\"></p>"; } 
  elseif(empty($i['status'])) { $Knap = "<p class=\"GoTop\" title=\"Gå til toppen av siden\"><img src=\"../Design/Top.png\"></p>$Ek<p title=\"Legg til kontakt\" id=\"$KunID\" class=\"LeggTilKontakt\"><img src=\"../Design/Kontakt.png\"></p><p onclick=\"SendMeldi('$I_UrlBruker')\" title=\"Send melding\"><img src=\"../Design/Mail.png\"></p>"; }
  else { $Knap = "<p class=\"GoTop\" title=\"Gå til toppen av siden\"><img src=\"../Design/Top.png\"></p>$Ek<p onclick=\"SendMeldi('$I_UrlBruker')\" title=\"Send melding\"><img src=\"../Design/Mail.png\"></p>"; }
  
  
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  $R_On = $R_On."<tr class=\"$Klasse\" id=\"$Tell\">
  <td class=\"Linje On\">
  <span class=\"Online\">
  <span class=\"Bilde\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_UrlBruker\"'><img src=\"$URL\"></span>
  <span class=\"dato\">Innlogget ".$i['sistinne']."</span>
  <span class=\"info\"><span style=\"float:left;\"><b>".BrukerURL($i['brukernavn'])."</b> $Stilling ( ".$i['Kjon']." )</span> $venn</span>
  <span class=\"info\">".$i['rank']." ( ".PengStatus($i['penger'])." ) ( $Draps )</span>
  <span class=\"info\">Familie: $GjengEr</span>
  <span class=\"en\">$Knap</span>
  </span>
  </td></tr>  
  ";
  
  }}

  echo "
  <script>
  $('.GoTop').click(function() { $('html, body').animate({scrollTop:100}, 'slow'); });
  $('.LeggTilKontakt').click(function() { id = this.id; $.post('post.php?AddFriend='+id); $('#'+id).fadeOut(1000); });
  $('.Opprett').click(function() { if($('.Opprett').html() == '( Vis alle )') { $('#SB_Midten2').load('post.php?MebOnline=True'); } else { $('#SB_Midten2').load('post.php?MebOnline=True&Venn=True'); }});
  function SendMeldi(bruker) { $('#SB_Midten2').load('post.php?du_valgte=Innboks&Meld=True&Til='+bruker); $('html, body').animate({scrollTop:100}, 'slow'); }
  </script>
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Pålogget</span><span class=\"Opprett\">( $Opprett )</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/spillerepologget.jpg\"></td></tr>
  $R_On";
  echo SiderVis(mysql_num_rows($Pa),'post.php?MebOnline=True');
  echo "</table></div>";
  
  }
  ?>
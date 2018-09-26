  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else {


  $Forum = mysql_query("SELECT * FROM forum_traader WHERE id LIKE '%' AND startet_type NOT LIKE 'GF' AND Slettet_ell='Nei' ORDER BY `startet_type`,`aktiv_eller` DESC");

  $RF = ""; $I_1 = "0";
  $FF = ""; $I_2 = "0";
  $SF = ""; $I_3 = "0";
  $KF = ""; $I_4 = "0";

  while($I = mysql_fetch_assoc($Forum)) { 
  $Fake2 = Krypt_Tall($I['id']);
  $Tittel2 = htmlspecialchars($I['startet_tittel']);
  $Typa2 = $I['startet_type'];
  if($I['startet_sticky'] == 'Sticky') { $Sticky2 = "style=\"color:#1aa0b4\""; } else { $Sticky2 = ''; }
  $VAR = "<li $Sticky2 onclick='document.location.href=\"game.php?side=LesForum&id=$Fake2&s=0&t=$Typa2\"'>$Tittel2</li>"; 
  if($Typa2 == 'RF') { if($I_1 < '7') { $RF = $RF.$VAR; $I_1++; }}
  elseif($Typa2 == 'FF') { if($I_2 < '7') { $FF = $FF.$VAR; $I_2++; }}
  elseif($Typa2 == 'SF') { if($I_3 < '7') { $SF = $SF.$VAR; $I_3++; }}
  elseif($Typa2 == 'KF') { if($I_4 < '7') { $KF = $KF.$VAR; $I_4++; }}
  }
  
  if($type == 's' || $type == 'sf' || $type == 'bz' || $type == 'mi' || $type == 'fm' || $type == 'm' || $type == 'A') { if(empty($RF)) { $RF = "<li><font color=\"#CC3300\">Ingen emner</font></li>"; }} else { $RF = "<li><font color=\"#CC3300\">Låst forum</font></li>"; } 
  if(empty($FF)) { $FF = "<li><font color=\"#CC3300\">Ingen emner</font></li>"; }
  if(empty($SF)) { $SF = "<li><font color=\"#CC3300\">Ingen emner</font></li>"; }
  if(empty($KF)) { $KF = "<li><font color=\"#CC3300\">Ingen emner</font></li>"; }

  echo "<div id=\"SB_Rute_1\"><h1 onclick='document.location.href=\"game.php?side=Forum&t=RF\"'>Ledelsen</h1><ul>$RF</ul></div>";
  echo "<div id=\"SB_Rute_2\"><h1 onclick='document.location.href=\"game.php?side=Forum&t=FF\"'>Off-toptic</h1><ul>$FF</ul></div>";
  echo "<div id=\"SB_Rute_3\"><h1 onclick='document.location.href=\"game.php?side=Forum&t=SF\"'>Salg/søknad</h1><ul>$SF</ul></div>";
  echo "<div id=\"SB_Rute_4\"><h1 onclick='document.location.href=\"game.php?side=Forum&t=KF\"'>Kriminalitet</h1><ul>$KF</ul></div>";
  echo "<div id=\"SB_Rute_5\"><h1 onclick='document.location.href=\"game.php?side=Forum&t=GF\"'>Gjeng - forum</h1><ul>";

  if(empty($gjeng)) { echo  "<li><font color=\"#CC3300\">Ingen emner</font></li>"; } else { 

  $HEG = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE brukernavn='$brukernavn'");
  $HEG = mysql_fetch_assoc($HEG);
  $GjengIden = $HEG['gjeng_id'];
  $ForPrint = mysql_query("SELECT * FROM forum_traader WHERE id LIKE '%' AND startet_type='GF' AND startet_gjeng='$GjengIden' AND Slettet_ell='Nei' ORDER BY `aktiv_eller` DESC LIMIT 0, 7");
  if(mysql_num_rows($ForPrint) == '0') { echo '<li><font color="#CC3300">Ingen emner</font></li>'; } else {
  while($Row = mysql_fetch_assoc($ForPrint)) { 
  $Fake3 = Krypt_Tall($Row['id']);
  $Tittel3 = htmlspecialchars($Row['startet_tittel']);
  if($Row['startet_sticky'] == 'Sticky') { $Sticky3 = "style=\"color:#1aa0b4\""; } else { $Sticky3 = ''; }
  echo "<li $Sticky3 onclick='document.location.href=\"game.php?side=LesForum&id=$Fake3&s=0&t=GF\"'>$Tittel3</li>"; 
  }}}
  
  echo "</ul></div>";

  }
  ?>

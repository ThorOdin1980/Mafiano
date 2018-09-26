  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?

  $Forum = mysql_query("SELECT * FROM forum_traader WHERE id LIKE '%' AND startet_type NOT LIKE 'GF' AND startet_type NOT LIKE 'RF' AND Slettet_ell='Nei' ORDER BY `startet_type`,`aktiv_eller` DESC");

  $RF = ""; $I_J = "0";
  $FF = ""; $I_H = "0";
  $SF = ""; $I_3 = "0";
  $KF = ""; $I_4 = "0";
  
  while($I = mysql_fetch_assoc($Forum)) { 
  $Tittel2 = htmlspecialchars($I['startet_tittel']);
  $Typa2 = $I['startet_type'];
  if($I['startet_sticky'] == 'Sticky') { $Sticky2 = "style=\"color:#1aa0b4\""; } else { $Sticky2 = ''; }
  $VAR = "<li  $Sticky2 >$Tittel2</lì>"; 
  if($Typa2 == 'FF') { if($I_2 < '7') { $FF = $FF.$VAR; $I_2++; }}
  elseif($Typa2 == 'SF') { if($I_3 < '7') { $SF = $SF.$VAR; $I_3++; }}
  elseif($Typa2 == 'KF') { if($I_4 < '7') { $KF = $KF.$VAR; $I_4++; }}
  }
  
  if(empty($FF)) { $FF = "<li><font color=\"#CC3300\">Ingen emner</font></li>"; }
  if(empty($SF)) { $SF = "<li><font color=\"#CC3300\">Ingen emner</font></li>"; }
  if(empty($KF)) { $KF = "<li><font color=\"#CC3300\">Ingen emner</font></li>"; }

  echo "<div id=\"SB_Rute_1\"><h1>Ledelsen</h1><ul><li><font color=\"#CC3300\">Låst forum</font></li></ul></div>";
  echo "<div id=\"SB_Rute_2\"><h1>Off-toptic</h1><ul>$FF</ul></div>";
  echo "<div id=\"SB_Rute_3\"><h1>Salg/søknad</h1><ul>$SF</ul></div>";
  echo "<div id=\"SB_Rute_4\"><h1>Kriminalitet</h1><ul>$KF</ul></div>";
  echo "<div id=\"SB_Rute_5\"><h1>Gjeng - forum</h1><ul><li><font color=\"#CC3300\">Ingen emner</font></li></ul></div>";

  ?>
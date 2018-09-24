  <style>
  .LinjeTo { padding:3px; border-bottom-style: solid; border-bottom-width: 1px; border-color:#000000; font-size:11px; }
  .Send .PostEn { width:150px; text-align:center; margin:2px 7px 0 7px; background-color:#444444; color:#b6e122; font-size:11px; font-weight:bold; padding:3px; filter:alpha(opacity=50); opacity:0.5; }
  .Send .PostEn:hover { cursor:pointer; filter:alpha(opacity=90); opacity:0.9; }
  .Send .tekst:hover { cursor:pointer; filter:alpha(opacity=90); opacity:0.9; }
  .Send .AddOn { filter:alpha(opacity=90); opacity:0.9; }
  </style>
  <?php
  if(basename($_SERVER['PHP_SELF']) == "gjengbank.inc.php") { header("Location: index.php"); exit; } else {
  if($i['stilling'] == 'Boss') {

  echo "
  <script> 
  $('.tekst').click(function() {
  var id = '#' + this.id;
  if(id == '#Peng' || id == '#Poen' || id == '#Bomb') { 
  if($(id).hasClass('AddOn') == 0) { $('.tekst').removeClass('AddOn'); $(id).addClass('AddOn'); } else { $(id).removeClass('AddOn'); }
  } else { alert('Ugyldig valg.'); }});
  
  function sendit(Opp) {
  if(Opp == 'Inn' || Opp == 'Ut') { 
  if($('.tekst').hasClass('AddOn') == 0) { alert('Du må velge en valuta.'); }
  else if($('#Summen').val() == '' || $('#Summen').val() == 'Sum') { alert('Summen mangler.'); } else { 
  var Valg = encodeURI(Opp); 
  var Sum = encodeURI($('#Summen').val()); 
  var Type = encodeURI($('.AddOn').attr(\"id\"));
  $('#SB_Midten2').load('post.php?GjengHus=Okonomi&Valg='+Valg+'&Val='+Sum+'&Enhet='+Type);
  }}}
  </script>";

  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">$G_NavnEr</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Okonomi');\">( Økonomi )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Krim');\">( Krim )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Medlemmer');\">( Medlemmer )</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Hovedkvarter');\">( Hovedkvarter )</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/Bank-4.jpg\"></td></tr>
  ";

  if(($_GET['Valg'] == 'Inn' || $_GET['Valg'] == 'Ut') && $i['stilling'] == 'Boss') { 
  if($_GET['Enhet'] == 'Bomb' || $_GET['Enhet'] == 'Poen' || $_GET['Enhet'] == 'Peng') {  
  $Valg = Mysql_Klar($_GET['Valg']);
  $Sum =  Bare_Siffer(Mysql_Klar($_GET['Val']));
  $Enhet = Mysql_Klar($_GET['Enhet']);
  if($Enhet == 'Peng') { $Din = floor($rad_B['penger']); $Har = $i['Gjeng_Penger']; $Var = 'kr'; $Col = "Gjeng_Penger"; $ColTo = "penger"; } 
  elseif($Enhet == 'Poen') { $Din = floor($rad_B['turns']); $Har = $i['Gjeng_Poeng']; $Var = 'poeng'; $Col = "Gjeng_Poeng"; $ColTo = "turns"; } 
  elseif($Enhet == 'Bomb') { $Din = floor($rad_B['bombechips']); $Har = $i['Gjeng_Bombechips']; $Var = 'bombechips'; $Col = "Gjeng_Bombechips"; $ColTo = "bombechips"; }
  $SumVis = VerdiSum($Sum,$Var);
  if($Valg == 'Inn') { $Bla = "på hånda"; $Tall = $Din; $Svar = "Du har satt inn $SumVis."; $Oppgave = "$Col=`$Col`+'$Sum'"; $OppgaveTo = "$ColTo=`$ColTo`-'$Sum'"; } else { $Bla = "på gjengkontoen"; $Tall = $Har; $Svar = "Du tatt ut $SumVis."; $Oppgave = "$Col=`$Col`-'$Sum'"; $OppgaveTo = "$ColTo=`$ColTo`+'$Sum'"; }
  if($Sum > '10000000000') { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Summen er for høy.</span></td></tr>"; }
  elseif($Sum < '1') { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Summen er for lav.</span></td></tr>"; }
  elseif($Sum > $Tall) { echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_2\">Du har ikke så mye $Var $Bla.</span></td></tr>";
  } else { 

  mysql_query("UPDATE brukere SET $OppgaveTo,aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `Gjeng_bank` (Sum,Kategori,Dato,Stamp,Transaksjon,Gjeng_id,Brukernavn) VALUES ('$Sum','$Var','$FullDato','$Timestamp','$Valg','$G_Id','$brukernavn')");
  mysql_query("UPDATE Gjenger SET $Oppgave WHERE id='$G_Id'");
  echo "<tr><td class=\"R_8\" colspan=\"3\" style=\"height:25px;\"><span class=\"T_1\">$Svar</span></td></tr>";
  }}}

  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" colspan=\"3\" style=\"padding-bottom:9px;\">
  <span class=\"tekst\" id=\"Peng\">Penger: <b>".VerdiSum($i['Gjeng_Penger'],'kr')."</b></span>
  <span class=\"tekst\" id=\"Poen\">Poeng: <b>".VerdiSum($i['Gjeng_Poeng'],'stk')."</b></span>
  <span class=\"tekst\" id=\"Bomb\">Bombechips: <b>".VerdiSum($i['Gjeng_Bombechips'],'stk')."</b></span>
  <input id=\"Summen\" type=\"text\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\">
  <p style=\"float:left;\" onclick=\"sendit('Inn');\" class=\"PostEn\">Sett inn</p><p style=\"float:right;\" onclick=\"sendit('Ut');\" class=\"PostEn\">Ta ut</p></td></tr>
  <tr style=\"height:20px;\"><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Dato</td><td class=\"R_4\">Sum</td></tr>";
  $Trans = mysql_query("SELECT * FROM Gjeng_bank WHERE Gjeng_id='$G_Id' ORDER BY Transaksjon,Stamp DESC LIMIT 20");
  while($IT = mysql_fetch_assoc($Trans)) { 
  if($IT['Transaksjon'] == 'Ut') { $Klas = "<span style=\"color:#e40404; font-weight:bold;\">( UT )</span>"; } else { $Klas = "<span style=\"color:#3c943c; font-weight:bold;\">( INN )</span>"; }
  echo "<tr class=\"Vanlig_1\"><td class=\"LinjeTo Plassering\">".BrukerURL($IT['Brukernavn'])."</td><td class=\"LinjeTo Plassering\">".$IT['Dato']."</td><td class=\"LinjeTo Plassering\">".VerdiSum($IT['Sum'],$IT['Kategori'])." $Klas</td></tr>";
  }
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Dato</td><td class=\"R_4\">Donering</td></tr>";
  $Don = mysql_query("SELECT * FROM Gjeng_donering WHERE gjengid='$G_Id' ORDER BY stamp DESC LIMIT 20");
  while($ITT = mysql_fetch_assoc($Don)) { 
  echo "<tr class=\"Vanlig_1\"><td class=\"LinjeTo Plassering\">".BrukerURL($ITT['brukernavn'])."</td><td class=\"LinjeTo Plassering\">".$ITT['dato']."</td><td class=\"LinjeTo Plassering\">".$ITT['sum']."</td></tr>";
  }
  echo "</table></div>";
  
  }}
  ?>
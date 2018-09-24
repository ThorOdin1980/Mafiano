  <style>
  .Spinn { float:left; width:138px; text-align:center; padding:3px; margin-bottom:2px; background-color:#a6cd70; }
  .Spinn:hover { font-weight:bold; cursor:pointer; }
  .Bets { float:left; width:138px; min-height:307px; background-color:#a6cd70; padding-left:3px; padding-right:3px; padding-bottom:3px; padding-top:1px; }
  .Bets span { display:none; }
  .Bets p { float:left; width:30px; color:#ffffff; margin-top:2px; padding:2px; text-align:center; font-size:9px; background-color:#303030; }
  .Bets input { float:left; margin-left:2px; margin-top:2px; width:98px; color:#ffffff; border:0; padding:2px; font-size:9px; background-color:#303030; }
  .Bet_0 { position:absolute; margin-left:132px; margin-top:10px; width:182px; height:43px; }
  .Bet_1 { position:absolute; margin-left:10px; width:60px; height:51px; }
  .Bet_2 { position:absolute; margin-left:71px; width:60px; height:103px; }
  .Bet_3 { position:absolute; width:60px; height:25px; }
  .Vis, .VisTo { background-color:#666666; filter:alpha(opacity=60); opacity:0.6; cursor:pointer; }
  .VisTre, .VisFire { background: url('../Design/Nullover.png') no-repeat left top; cursor:pointer; }

  </style>
  <?php
  if(basename($_SERVER['PHP_SELF']) == "Rulett.inc.php") { header("Location: index.php"); exit; } else {
  
  function SjekkBett($N) { if($N == 'Null' || $N == 'Even' || $N == 'Rod' || $N == 'Svart' || $N == 'Odd' || $N == '1st' || $N == '2st' || $N == '3st' || ($N > '0' && $N < '37') || $N == 'En' || $N == 'To' || $N == 'Tre') { return 'Ja'; } else { return 'Nei'; }}
  function Vinnere($T) { if($T == '0') { $Arr = array("Null"); } elseif($T == '1') { $Arr = array("1","En","1st","Rod","Odd"); } elseif($T == '2') { $Arr = array("2","To","1st","Svart","Even"); } elseif($T == '3') { $Arr = array("3","Tre","1st","Rod","Odd"); } elseif($T == '4') { $Arr = array("4","En","1st","Svart","Even"); } elseif($T == '5') { $Arr = array("5","To","1st","Rod","Odd"); } elseif($T == '6') { $Arr = array("6","Tre","1st","Svart","Even"); } elseif($T == '7') { $Arr = array("7","En","1st","Rod","Odd"); } elseif($T == '8') { $Arr = array("8","To","1st","Svart","Even"); } elseif($T == '9') { $Arr = array("9","Tre","1st","Rod","Odd"); } elseif($T == '10') { $Arr = array("10","En","1st","Svart","Even"); } elseif($T == '11') { $Arr = array("11","To","1st","Svart","Odd"); } elseif($T == '12') { $Arr = array("12","Tre","1st","Rod","Even"); } elseif($T == '13') { $Arr = array("13","En","2st","Svart","Odd"); } elseif($T == '14') { $Arr = array("14","To","2st","Rod","Even"); } elseif($T == '15') { $Arr = array("15","Tre","2st","Svart","Odd"); } elseif($T == '16') { $Arr = array("16","En","2st","Rod","Even"); } elseif($T == '17') { $Arr = array("17","To","2st","Svart","Odd"); } elseif($T == '18') { $Arr = array("18","Tre","2st","Rod","Even"); } elseif($T == '19') { $Arr = array("19","En","2st","Rod","Odd"); } elseif($T == '20') { $Arr = array("20","To","2st","Svart","Even"); } elseif($T == '21') { $Arr = array("21","Tre","2st","Rod","Odd"); } elseif($T == '22') { $Arr = array("22","En","2st","Svart","Even"); } elseif($T == '23') { $Arr = array("23","To","2st","Rod","Odd"); } elseif($T == '24') { $Arr = array("24","Tre","2st","Svart","Even"); } elseif($T == '25') { $Arr = array("25","En","3st","Rod","Odd"); } elseif($T == '26') { $Arr = array("26","To","3st","Svart","Even"); } elseif($T == '27') { $Arr = array("27","Tre","3st","Rod","Odd"); } elseif($T == '28') { $Arr = array("28","En","3st","Svart","Even"); } elseif($T == '29') { $Arr = array("29","To","3st","Svart","Odd"); } elseif($T == '30') { $Arr = array("30","Tre","3st","Rod","Even"); } elseif($T == '31') { $Arr = array("31","En","3st","Svart","Odd"); } elseif($T == '32') { $Arr = array("32","To","3st","Rod","Even"); } elseif($T == '33') { $Arr = array("33","Tre","3st","Svart","Odd"); } elseif($T == '34') { $Arr = array("34","En","3st","Rod","Even"); } elseif($T == '35') { $Arr = array("35","To","3st","Svart","Odd"); } elseif($T == '36') { $Arr = array("36","Tre","3st","Rod","Even"); } return $Arr; }
  function VinnSum($N,$S) {
  if($N == 'Null') { $Ga = '36'; }
  elseif($N == 'Even') { $Ga = '2'; }
  elseif($N == 'Rod') { $Ga = '2'; }
  elseif($N == 'Svart') { $Ga = '2'; }
  elseif($N == 'Odd') { $Ga = '2'; }
  elseif($N == '1st') { $Ga = '3'; }
  elseif($N == '2st') { $Ga = '3'; }
  elseif($N == '3st') { $Ga = '3'; }
  elseif($N > '0' && $N < '37') { $Ga = '36'; }
  elseif($N == 'En') { $Ga = '3'; }
  elseif($N == 'To') { $Ga = '3'; }
  elseif($N == 'Tre') { $Ga = '3'; }
  $Sum = floor($S * $Ga);
  return $Sum;
  }
  
  echo "
  <script>
  var _images = ['../casino/Rull_1.gif', '../casino/Rull_2.gif', '../casino/Rull_3.gif', '../casino/Rull_4.gif', '../casino/Rull_5.gif', '../casino/Rull_6.gif', '../casino/Rull_7.gif', '../casino/Rull_8.gif', '../casino/Rull_9.gif', '../casino/Rull_10.gif','../casino/Rull_11.gif', '../casino/Rull_12.gif', '../casino/Rull_13.gif', '../casino/Rull_14.gif', '../casino/Rull_15.gif', '../casino/Rull_16.gif', '../casino/Rull_17.gif', '../casino/Rull_18.gif', '../casino/Rull_19.gif','../casino/Rull_20.gif','../casino/Rull_21.gif', '../casino/Rull_22.gif', '../casino/Rull_23.gif', '../casino/Rull_24.gif', '../casino/Rull_25.gif', '../casino/Rull_26.gif', '../casino/Rull_27.gif', '../casino/Rull_28.gif', '../casino/Rull_29.gif','../casino/Rull_30.gif','../casino/Rull_31.gif', '../casino/Rull_32.gif', '../casino/Rull_33.gif', '../casino/Rull_34.gif', '../casino/Rull_35.gif', '../casino/Rull_36.gif'];
  var gotime = _images.length;
  $.each(_images,function(e) { $(new Image()).load(function() { if (--gotime < 1) begin(); }).attr('src',this); });
  $('.Bet_1,.Bet_2,.Bet_3').hover(function () { $(this).addClass(\"Vis\"); },function () { $(this).removeClass(\"Vis\"); });
  $('.Bet_1,.Bet_2,.Bet_3').click(function () { if($(this).is('.VisTo')) { var Navn = '#' + this.id.slice(0,-1) + '1'; $(Navn).css(\"display\",\"none\"); $(this).removeClass(\"VisTo\"); } else { var Navn = '#' + this.id.slice(0,-1) + '1'; $(Navn).css(\"display\",\"block\"); $(this).addClass(\"VisTo\"); }});
  $('.Bet_0').hover(function () { $(this).addClass(\"VisTre\"); },function () { $(this).removeClass(\"VisTre\"); });
  $('.Bet_0').click(function () { if($(this).is('.VisFire')) { var Navn = '#' + this.id.slice(0,-1) + '1'; $(Navn).css(\"display\",\"none\"); $(this).removeClass(\"VisFire\"); } else { var Navn = '#' + this.id.slice(0,-1) + '1'; $(Navn).css(\"display\",\"block\"); $(this).addClass(\"VisFire\"); }});
  $('.Spinn').click(function () { 
  
  if($('.Bets span:visible').length == 0) { alert('Du har ikke plassert bets.'); }
  else if($('.Bets span:visible').length > 20) { alert('Du kan maks plassere bets på 20 ruter.'); } else {  
  var valgt = Array(); $('.Bets span:visible').each(function() { var SatsEr = $('input', this).val(); var SatsPa = $('input', this).attr('id'); var Send = SatsPa+'-'+SatsEr; if(SatsEr != 'Sum' && SatsEr != '0') { valgt.push(Send); }}); if(valgt.length < 1) { alert('Du har ikke plottet inn en sum.'); } else { $('#SB_Midten2').load('post.php?du_valgte=Rulett&Spinn='+valgt); $('html, body').animate({scrollTop:200}, 'slow'); }
  }});
  </script>
  ";
  
  $Svar = '';
  if($_GET['Spinn']) {
  $Verdi = Mysql_Klar($_GET['Spinn']);
  if(empty($Verdi)) { 
  $Svar = PrintTeksten("Ugyldig post,","1","Feilet");
  $R_Bilde = "Rull";
  } else {
  $Verdi = explode(",",$Verdi);
  $Tell = '0'; 
  $R_Bilde = rand(1,36);
  foreach ($Verdi as $dear) { 
  $Var = explode("-",$dear);
  if(SjekkBett($Var['0']) == 'Ja') { $Tell++; $Sum = $Sum + Bare_Siffer($Var['1']); }
  } 

  
  if($Tell == '0') { $Svar = PrintTeksten("Finner ingen gyldige bets.","1","Feilet"); $R_Bilde = "Rull"; } 
  elseif($Sum > $rad_B['penger']) { $Svar = PrintTeksten("Du har ikke nok penger.","1","Feilet"); $R_Bilde = "Rull"; } else { 
  
  $Meld = "";
  $Vinn = "0";
  $Sjekk = Vinnere($R_Bilde);
  foreach($Verdi as $deare) { 
  $Var = explode("-",$deare);
  if(SjekkBett($Var['0']) == 'Ja') { 
  if(in_array($Var['0'], $Sjekk, true)) { $Vinn = $Vinn + VinnSum($Var['0'],$Var['1']); $Meld = $Meld."Vinner: ".$Var['0'].", gevinst ".VerdiSum(VinnSum($Var['0'],$Var['1']),'kr').".<br>"; }
  }} 
  
  if(empty($Meld)) { 
  $NySumSpen = floor($rad_B['penger'] - $Sum);
  mysql_query("UPDATE brukere SET penger='$NySumSpen',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `RulletLogg` (Bruker,Stamp,Dato,TotalSats,TotalGevinst,VinnInfo,VinnTall) VALUES ('$brukernavn','$Timestamp','$AnnenDato','$Sum','0','Tapte','$R_Bilde')");
  $Svar = PrintTeksten("Vinnertall: <b>$R_Bilde</b>, du tapte.","1","Feilet"); } else { 
  $NySumSpen = floor(($rad_B['penger'] - $Sum) + $Vinn);
  mysql_query("UPDATE brukere SET penger='$NySumSpen',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO `RulletLogg` (Bruker,Stamp,Dato,TotalSats,TotalGevinst,VinnInfo,VinnTall) VALUES ('$brukernavn','$Timestamp','$AnnenDato','$Sum','$Vinn','$Meld','$R_Bilde')");
  $Svar = PrintTeksten("<font style=\"font-size:14px;\">Vinnertall: <b>$R_Bilde</b></font><br>$Meld","1","Vellykket"); }
  
  $R_Bilde = "Rull_".$R_Bilde;
  }}} else { $R_Bilde = "Rull"; }
  
  
  echo"
  <div class=\"Div_masta\">
  <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Rulett</span></div>
  <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Gambling-1.jpg\"></div>
  $Svar
  <div style=\"float: left; width: 490px; background-color:#509046; margin-top:2px; margin-left:2px; padding-bottom:5px; padding-top:5px;\">
  <p align=\"center\"><img src=\"../casino/".$R_Bilde.".gif\"></p>
  <div style=\"float:left; margin-left:16px; margin-top:54px; width:144px;\">
  <div class=\"Spinn\">SPINN!</div>
  <div class=\"Bets\">
  <span id=\"Null_1\"><p>0</p><input type=\"text\" id=\"Null\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"Even_1\"><p>Even</p><input type=\"text\" id=\"Even\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"Rod_1\"><p>Rød</p><input type=\"text\" id=\"Rod\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"Svart_1\"><p>Svart</p><input type=\"text\" id=\"Svart\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"Odd_1\"><p>Odd</p><input type=\"text\" id=\"Odd\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"1st_1\"><p>1st</p><input type=\"text\" id=\"1st\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"2st_1\"><p>2st</p><input type=\"text\" id=\"2st\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"3st_1\"><p>3st</p><input type=\"text\" id=\"3st\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"1_1\"><p>1</p><input type=\"text\" id=\"1\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"2_1\"><p>2</p><input type=\"text\" id=\"2\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"3_1\"><p>3</p><input type=\"text\" id=\"3\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"4_1\"><p>4</p><input type=\"text\" id=\"4\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"5_1\"><p>5</p><input type=\"text\" id=\"5\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"6_1\"><p>6</p><input type=\"text\" id=\"6\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"7_1\"><p>7</p><input type=\"text\" id=\"7\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"8_1\"><p>8</p><input type=\"text\" id=\"8\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"9_1\"><p>9</p><input type=\"text\" id=\"9\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"10_1\"><p>10</p><input type=\"text\" id=\"10\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"11_1\"><p>11</p><input type=\"text\" id=\"11\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"12_1\"><p>12</p><input type=\"text\" id=\"12\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"13_1\"><p>13</p><input type=\"text\" id=\"13\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"14_1\"><p>14</p><input type=\"text\" id=\"14\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"15_1\"><p>15</p><input type=\"text\" id=\"15\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"16_1\"><p>16</p><input type=\"text\" id=\"16\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"17_1\"><p>17</p><input type=\"text\" id=\"17\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"18_1\"><p>18</p><input type=\"text\" id=\"18\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"19_1\"><p>19</p><input type=\"text\" id=\"19\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"20_1\"><p>20</p><input type=\"text\" id=\"20\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"21_1\"><p>21</p><input type=\"text\" id=\"21\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"22_1\"><p>22</p><input type=\"text\" id=\"22\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"23_1\"><p>23</p><input type=\"text\" id=\"23\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"24_1\"><p>24</p><input type=\"text\" id=\"24\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"25_1\"><p>25</p><input type=\"text\" id=\"25\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"26_1\"><p>26</p><input type=\"text\" id=\"26\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"27_1\"><p>27</p><input type=\"text\" id=\"27\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"28_1\"><p>28</p><input type=\"text\" id=\"28\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"29_1\"><p>29</p><input type=\"text\" id=\"29\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"30_1\"><p>30</p><input type=\"text\" id=\"30\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"31_1\"><p>31</p><input type=\"text\" id=\"31\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"32_1\"><p>32</p><input type=\"text\" id=\"32\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"33_1\"><p>33</p><input type=\"text\" id=\"33\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"34_1\"><p>34</p><input type=\"text\" id=\"34\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"35_1\"><p>35</p><input type=\"text\" id=\"35\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"36_1\"><p>36</p><input type=\"text\" id=\"36\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"En_1\"><p>2-1</p><input type=\"text\" id=\"En\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"To_1\"><p>2-2</p><input type=\"text\" id=\"To\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  <span id=\"Tre_1\"><p>2-3</p><input type=\"text\" id=\"Tre\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\"></span>
  
  </div></div>
  <div style=\"float:left; height:400px; background-image:url('../casino/roulettebord.gif'); width:323px;\">
  <div class=\"Bet_0\" id=\"Null_2\"></div>
  <div class=\"Bet_1\" id=\"Even_2\" style=\"margin-top:106px;\"></div>
  <div class=\"Bet_1\" id=\"Rod_2\" style=\"margin-top:158px;\"></div>
  <div class=\"Bet_1\" id=\"Svart_2\" style=\"margin-top:210px;\"></div>
  <div class=\"Bet_1\" id=\"Odd_2\" style=\"margin-top:262px;\"></div>
  <div class=\"Bet_2\" id=\"1st_2\" style=\"margin-top:54px;\"></div>
  <div class=\"Bet_2\" id=\"2st_2\" style=\"margin-top:158px;\"></div>
  <div class=\"Bet_2\" id=\"3st_2\" style=\"margin-top:262px;\"></div>
  <div class=\"Bet_3\" id=\"1_2\" style=\"margin-left:132px; margin-top:54px;\"></div>
  <div class=\"Bet_3\" id=\"2_2\" style=\"margin-left:193px; margin-top:54px;\"></div>
  <div class=\"Bet_3\" id=\"3_2\" style=\"margin-left:254px; margin-top:54px;\"></div>
  <div class=\"Bet_3\" id=\"4_2\" style=\"margin-left:132px; margin-top:80px;\"></div>
  <div class=\"Bet_3\" id=\"5_2\" style=\"margin-left:193px; margin-top:80px;\"></div>
  <div class=\"Bet_3\" id=\"6_2\" style=\"margin-left:254px; margin-top:80px;\"></div>
  <div class=\"Bet_3\" id=\"7_2\" style=\"margin-left:132px; margin-top:106px;\"></div>
  <div class=\"Bet_3\" id=\"8_2\" style=\"margin-left:193px; margin-top:106px;\"></div>
  <div class=\"Bet_3\" id=\"9_2\" style=\"margin-left:254px; margin-top:106px;\"></div>
  <div class=\"Bet_3\" id=\"10_2\" style=\"margin-left:132px; margin-top:132px;\"></div>
  <div class=\"Bet_3\" id=\"11_2\" style=\"margin-left:193px; margin-top:132px;\"></div>
  <div class=\"Bet_3\" id=\"12_2\" style=\"margin-left:254px; margin-top:132px;\"></div>
  <div class=\"Bet_3\" id=\"13_2\" style=\"margin-left:132px; margin-top:158px;\"></div>
  <div class=\"Bet_3\" id=\"14_2\" style=\"margin-left:193px; margin-top:158px;\"></div>
  <div class=\"Bet_3\" id=\"15_2\" style=\"margin-left:254px; margin-top:158px;\"></div>
  <div class=\"Bet_3\" id=\"16_2\" style=\"margin-left:132px; margin-top:184px;\"></div>
  <div class=\"Bet_3\" id=\"17_2\" style=\"margin-left:193px; margin-top:184px;\"></div>
  <div class=\"Bet_3\" id=\"18_2\" style=\"margin-left:254px; margin-top:184px;\"></div>
  <div class=\"Bet_3\" id=\"19_2\" style=\"margin-left:132px; margin-top:210px;\"></div>
  <div class=\"Bet_3\" id=\"20_2\" style=\"margin-left:193px; margin-top:210px;\"></div>
  <div class=\"Bet_3\" id=\"21_2\" style=\"margin-left:254px; margin-top:210px;\"></div>
  <div class=\"Bet_3\" id=\"22_2\" style=\"margin-left:132px; margin-top:236px;\"></div>
  <div class=\"Bet_3\" id=\"23_2\" style=\"margin-left:193px; margin-top:236px;\"></div>
  <div class=\"Bet_3\" id=\"24_2\" style=\"margin-left:254px; margin-top:236px;\"></div>
  <div class=\"Bet_3\" id=\"25_2\" style=\"margin-left:132px; margin-top:262px;\"></div>
  <div class=\"Bet_3\" id=\"26_2\" style=\"margin-left:193px; margin-top:262px;\"></div>
  <div class=\"Bet_3\" id=\"27_2\" style=\"margin-left:254px; margin-top:262px;\"></div>
  <div class=\"Bet_3\" id=\"28_2\" style=\"margin-left:132px; margin-top:288px;\"></div>
  <div class=\"Bet_3\" id=\"29_2\" style=\"margin-left:193px; margin-top:288px;\"></div>
  <div class=\"Bet_3\" id=\"30_2\" style=\"margin-left:254px; margin-top:288px;\"></div>
  <div class=\"Bet_3\" id=\"31_2\" style=\"margin-left:132px; margin-top:314px;\"></div>
  <div class=\"Bet_3\" id=\"32_2\" style=\"margin-left:193px; margin-top:314px;\"></div>
  <div class=\"Bet_3\" id=\"33_2\" style=\"margin-left:254px; margin-top:314px;\"></div>
  <div class=\"Bet_3\" id=\"34_2\" style=\"margin-left:132px; margin-top:340px;\"></div>
  <div class=\"Bet_3\" id=\"35_2\" style=\"margin-left:193px; margin-top:340px;\"></div>
  <div class=\"Bet_3\" id=\"36_2\" style=\"margin-left:254px; margin-top:340px;\"></div>
  <div class=\"Bet_3\" id=\"En_2\" style=\"margin-left:132px; margin-top:366px;\"></div>
  <div class=\"Bet_3\" id=\"To_2\" style=\"margin-left:193px; margin-top:366px;\"></div>
  <div class=\"Bet_3\" id=\"Tre_2\" style=\"margin-left:254px; margin-top:366px;\"></div>
  </div></div></div>";
    
  
  }
  ?>
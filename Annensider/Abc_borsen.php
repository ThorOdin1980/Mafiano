  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <div class="Div_masta"><form method="post" id="borsen">
  <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">BØRSEN</span></div>
  <div class="Div_bilde"><img border="0" src="Bilder/Aksjer.jpg" width="490" height="200"></div>
  <?php
  function sjekk_belop($tall) {
  if(ereg("^[0-9]+$",$tall) && strlen($tall) < '50') return true; else return false; }
  $id = $_SESSION['id'];
  $peng = $penger;
  $maxha = 100000; // max ha
  $tidssjekk = (60 * 60 * 3); // antal sekk melom ver oppdatering i børsen
  $pilopp = "<img src=\"../../Design/pil-opp.gif\">"; // Link til bildene husk at den skrives rett i spøringen 
  $pilned = "<img src=\"../../Design/pil-ned.gif\">"; 

  $ting = array(
    "0" => array(
        "navn"=>'Coca Cola',
        "minp"=>'100',
        "maxp"=>'500'
      ),
    "1" => array(
        "navn"=>'DnB Nor',
        "minp"=>'140',
        "maxp"=>'250'
      ),
    "2" => array(
        "navn"=>'Microsoft',
        "minp"=>'150',
        "maxp"=>'300'
      ),
    "3" => array(
        "navn"=>'Telenor',
        "minp"=>'50',
        "maxp"=>'140'
      ),
    "4" => array(
        "navn"=>'Hydro',
        "minp"=>'400',
        "maxp"=>'700'
      ),
    );

  // coca cola = 100 - 500 kroner
  // dnb nor = 140 - 250 kroner
  // microsoft = 150 - 300 kroner
  // telenor = 50 - 140 kroner
  // norsk hydro = 400 - 700 kroner
        

  $sql = mysql_query("SELECT * FROM `bors_pris` WHERE `id` = '1'");
  if (mysql_num_rows($sql) > 0) {
  $priser = mysql_fetch_assoc($sql);

  $sql2 = mysql_query("SELECT * FROM `bors_pris` WHERE `id` = '2'") or die(mysql_error());
  if (mysql_num_rows($sql2) > 0) {
  $sistsjer = mysql_fetch_assoc($sql2);
  if(time() > $priser[neste_upp]) { // oppdater prisene!
  $oppdate = "UPDATE `bors_pris` SET ";
  $sistopp = "UPDATE `bors_pris` SET ";
  foreach ($ting as $key => $value) {
  $rand = rand(1,25);
  $rand2 = rand(1,2);
  if ($rand2 == 2) { // gå opp
  if(($priser[$key] + $rand) > $value[maxp]) { //hopp
  $narand = rand($value[minp],$value[maxp]);
  $oppdate .= "`$key` = '$narand', ";
  if($narand > $priser[$key]) {
  $sistopp .= "`$key` = '$pilopp ".($narand - $priser[$key])."', ";
  } elseif ($narand < $priser[$key]) {
  $sistopp .= "`$key` = '$pilned ".($priser[$key] - $narand)."', ";
  }} else { // vanlig stigning
  $oppdate .= "`$key` = '".($priser[$key] + $rand)."', ";
  $sistopp .= "`$key` = '$pilopp $rand', ";
  }} else { // gå ned
  if(($priser[$key] - $rand) < $value[minp]) { // hopp i prisen
  $narand = rand($value[minp],$value[maxp]);
  $oppdate .= "`$key` = '$narand', ";
  if ($narand > $priser[$key]) {
  $sistopp .= "`$key` = '$pilopp ".($narand - $priser[$key])."', ";
  } elseif ($narand < $priser[$key]) {
  $sistopp .= "`$key` = '$pilned ".($priser[$key] - $narand)."', ";
  }} else { // vanlig synking
  $oppdate .= "`$key` = '".($priser[$key] - $rand)."', ";
  $sistopp .= "`$key` = '$pilned $rand', ";
  }}}
  $oppdate .= "`neste_upp` = '".($tidssjekk + time())."' WHERE `id` = '1'";
  $sistopp .= "`neste_upp` = '0' WHERE `id` = '2'"; // `neste_upp` = '0' trengs ikke men bere for og slippe å fjerne , fra spørringen
  mysql_query($oppdate) or die(mysql_error());
  mysql_query($sistopp) or die(mysql_error());
  }

  $sql3 = mysql_query("SELECT * FROM `borsen` WHERE `id` = '$id'");
  if(mysql_num_rows($sql3) < 1) {

  mysql_query("INSERT INTO `borsen` (`id`) VALUES ('$id');");
  $sql3 = mysql_query("SELECT * FROM `borsen` WHERE `id` = '$id'");
  }
  $har = mysql_fetch_assoc($sql3);
  if($_POST['action'] && $_POST['action'] == "kjop") {
  $samlet = ($har[0]+$har[1]+$har[2]+$har[3]+$har[4]);
  if (!sjekk_belop($_POST[antall]) && $_POST[antall] > 0) { echo PrintTeksten("Du kan kun bruke tall i feltet.","1","Feilet");
  } elseif(!isset($ting["$_POST[valg]"][navn])) { echo PrintTeksten("Du må velge hva du skal kjøpe.","1","Feilet");
  } elseif (($_POST[antall] + $samlet) > $maxha) { echo PrintTeksten("Du kan max ha $maxha stk.","1","Feilet");
  } elseif ($peng < ($_POST[antall] * $priser["$_POST[valg]"])) { echo PrintTeksten("Du har ikke råd.","1","Feilet");
  } else {
  $peng = $peng - ($_POST[antall] * $priser["$_POST[valg]"]);
  $antalna = ($har["$_POST[valg]"] + $_POST[antall]);

  mysql_query("UPDATE `brukere` SET `penger` = '$peng' WHERE `brukerid` = '$id'");

  mysql_query("UPDATE `borsen` SET `$_POST[valg]` = '$antalna' WHERE `id` = '$id'") or die(mysql_error());
  if($_POST[antall] == 1) { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du kjøpte 1 aksje i ".$ting["$_POST[valg]"][navn]." for ".number_format(($_POST[antall] * $priser["$_POST[valg]"]))." kr.</span></div>";
  } else { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du kjøpte $_POST[antall] aksjer i ".$ting["$_POST[valg]"][navn]." for ".number_format(($_POST[antall] * $priser["$_POST[valg]"]))." kr.</span></div>"; }

  $sql3 = mysql_query("SELECT * FROM `borsen` WHERE `id` = '$id'");
  $har = mysql_fetch_assoc($sql3);
  }} elseif ($_POST['action'] && $_POST['action'] == "selg"){
  if(!sjekk_belop($_POST[antall]) && $_POST[antall] > 0) { echo PrintTeksten("Du kan kun skrive inn et tall.","1","Feilet");
  } elseif(!isset($ting["$_POST[valg]"][navn])) { echo PrintTeksten("Du må velge hva du skal kjøpe.","1","Feilet");
  } elseif($har["$_POST[valg]"] < $_POST[antall]) {  echo PrintTeksten("Du har ikke så mange aksjer.","1","Feilet");
  } else {
  $peng = $peng + ($_POST[antall] * $priser["$_POST[valg]"]);
  $antalna = ($har["$_POST[valg]"] - $_POST[antall]);

  mysql_query("UPDATE `brukere` SET `penger` = '$peng' WHERE `brukerid` = '$id'");

  mysql_query("UPDATE `borsen` SET `$_POST[valg]` = '$antalna' WHERE `id` = '$id'");
  if ($_POST[antall] == 1) { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du solgte 1 aksje fra ".$ting["$_POST[valg]"][navn]." for ".number_format(($_POST[antall] * $priser["$_POST[valg]"]))." kr.</span></div>";
  } else { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du solgte $_POST[antall] aksjer fra ".$ting["$_POST[valg]"][navn]." for ".number_format(($_POST[antall] * $priser["$_POST[valg]"]))." kr.</span></div>"; }

  $sql3 = mysql_query("SELECT * FROM `borsen` WHERE `id` = '$id'");
  $har = mysql_fetch_assoc($sql3);
  }} else { }

  ?>
  <div class="Div_venstre_side_4"><span class="Span_str_1">Firma</span></div>
  <div class="Div_venstre_side_4"><span class="Span_str_1">Pris</span></div>
  <div class="Div_venstre_side_4"><span class="Span_str_1">Siste handling</span></div>
  <div class="Div_venstre_side_4"><span class="Span_str_1">Du har</span></div>
  <div class="Div_bunn_4"><span class="Span_str_1">Merk</span></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $ting[0][navn];?></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($priser[0]);?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $sistsjer[0];?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($har[0]);?> stk</div>
  <div class="Div_bunn_3">&nbsp;&nbsp;<input type="radio" name="valg" value="0"></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $ting[1][navn];?></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($priser[1]);?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $sistsjer[1];?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($har[1]);?> stk</div>
  <div class="Div_bunn_3">&nbsp;&nbsp;<input type="radio" name="valg" value="1"></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $ting[2][navn];?></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($priser[2]);?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $sistsjer[2];?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($har[2]);?> stk</div>
  <div class="Div_bunn_3">&nbsp;&nbsp;<input type="radio" name="valg" value="2"></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $ting[3][navn];?></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($priser[3]);?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $sistsjer[3];?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($har[3]);?> stk</div>
  <div class="Div_bunn_3">&nbsp;&nbsp;<input type="radio" name="valg" value="3"></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $ting[4][navn];?></div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($priser[4]);?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo $sistsjer[4];?> kr</div>
  <div class="Div_venstre_side_3">&nbsp;&nbsp;<?echo number_format($har[4]);?> stk</div>
  <div class="Div_bunn_3">&nbsp;&nbsp;<input type="radio" name="valg" value="4"></div>
  <div class="Div_venstre_side_1"><span class="Span_str_1">Antall</span></div>
  <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="antall" maxlength="10" onKeyPress="return numbersonly(this, event)"></div>
  <div class="Div_venstre_side_1">&nbsp;</div><input type="hidden" name="action" id="du_valgte" />
  <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='selg';document.getElementById('borsen').submit()"><p class="pan_str_2">SELG</p></div>
  <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='kjop';document.getElementById('borsen').submit()"><p class="pan_str_2">KJØP</p></div>
  </form>
  <?
  } else { echo PrintTeksten("Ute av drift.","1","Feilet"); }
  } else { echo PrintTeksten("Ute av drift.","1","Feilet"); }
  ?></div>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } else { 
  if ($type == 'A' || $type == 'm') {  
        
  echo "<div class=\"Div_masta\"><form method=\"post\" id=\"LagSpors\"><div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">ANTIBOT - LAG SPØRSMÅL</span></div>";
        
  if (isset($_POST['sporsmol'])) { 
  $Bilde_1 = mysql_real_escape_string($_POST['bilde']);
  $Sporsmol_1 = mysql_real_escape_string($_POST['sporsmol']);
  $Svar_1 = mysql_real_escape_string($_POST['svar']);

  mysql_query("INSERT INTO `AntibottEn` (SkrevetAv,Sporsmol,Svar,Bilde,Timestamp,DatoSkrevet) VALUES ('$brukernavn','$Sporsmol_1','$Svar_1','$Bilde_1','$tiden','$tid $nbsp $dato')");
  echo PrintTeksten("Spørsmål lagret.","1","Vellykket");
  }
   
  echo "
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bilde?</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"bilde\" maxlength=\"200\" value=\"Skriv url til et bilde hvis du skal stille spørsmål til et bilde.\" onFocus=\"if(this.value=='Skriv url til et bilde hvis du skal stille spørsmål til et bilde.')this.value='';\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Spørsmål</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"sporsmol\" maxlength=\"200\" value=\"Spørsmålet ditt.\" onFocus=\"if(this.value=='Spørsmålet ditt.')this.value='';\"></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Svar</span></div>
  <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"svar\" maxlength=\"30\"  value=\"Svaret til spørsmålet skriver du inn her.\" onFocus=\"if(this.value=='Svaret til spørsmålet skriver du inn her.')this.value='';\"></div>
  <div class=\"Div_submit_knapp_3\" onclick=\"document.getElementById('LagSpors').submit()\"><p class=\"pan_str_2\">LAGRE SPØRSMÅL</p></div></form>
  </div>
  ";
  }}
  ?>
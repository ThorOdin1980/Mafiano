  <?php
  if(basename($_SERVER['PHP_SELF']) == "IpBan.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A') { 
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">IP Bannlysning</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Bruker');\">( Gå tilbake )</span></td></tr>";
  
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Ip adresse / brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Ip adresse / brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Ip adresse / brukernavn';\">
  <textarea id=\"R_Info\" onFocus=\"if(this.value=='Grunnlag')this.value='';\" onblur=\"if(this.value=='')this.value='Grunnlag';\">Grunnlag</textarea>
  <p class=\"Post\" onclick=\"alert('test')\">Bannlys!</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">BLA</td><td class=\"R_4\">BLA</td><td class=\"R_4\">BLA</td></tr>";
  echo "</table></div>";

  
  }}
  ?>
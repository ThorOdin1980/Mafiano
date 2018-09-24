  <?php
  if(basename($_SERVER['PHP_SELF']) == "addvenn.inc.php") { header("Location: index.php"); exit; } else {
  
  $BrukId = Dekrypt_Tall(Mysql_Klar($_GET['AddFriend']));

  $B = mysql_query("SELECT brukere.*,kontakter.status FROM brukere LEFT JOIN kontakter ON kontakter.kontaktnavn=brukere.brukernavn AND kontakter.dittbrukernavn='$brukernavn' WHERE brukere.brukerid='$BrukId' AND brukere.brukernavn NOT LIKE '$brukernavn'");
  if(mysql_num_rows($B) == '1') {
  $i = mysql_fetch_assoc($B);
  if(empty($i['status'])) {
  if($i['Kjon'] == 'Gutt') { $Vennskap = "Venn"; } else { $Vennskap = "Venninne"; }
  $Add = $i['brukernavn'];
  mysql_query("INSERT INTO `kontakter` (kontaktnavn,dittbrukernavn,status,timestampen,dato) VALUES ('$Add','$brukernavn','$Vennskap','$Timestamp','$FullDato')");
  }}
  
  }
  ?>
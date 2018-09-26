  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script language='javascript' src='SCRIPT/nicEdit.js'></script>
  <script type="text/javascript">
  bkLib.onDomLoaded(function() {
  var myNicEditor = new nicEditor({fullPanel : true, onSave : function() { postwith('PostForm',myNicEditor.instanceById('myInstance1').getContent()) } })
  myNicEditor.setPanel('myNicPanel');
  myNicEditor.addInstance('myInstance1');
  });
  
  function postwith (navn,value) {
  var myForm = document.createElement("form");
  myForm.method="post";
  var myInput = document.createElement("input");
  myInput.setAttribute("name", navn);
  myInput.setAttribute("value", value);
  myForm.appendChild(myInput);
  document.body.appendChild(myForm);
  myForm.submit();
  document.body.removeChild(myForm); }
  </script>  
  <div class="Div_masta">
  <?
  if($type == 'A' || $type == 'm') { 
  echo "<div id=\"myNicPanel\" style=\"float:left; width:490px; margin-left:2px;\"></div>";
  if(isset($_POST['PostForm'])) {
  $PostER = mysql_real_escape_string($_POST['PostForm']); 

  mysql_query("UPDATE FAQ SET Faq='$PostER',Dato='$FullDato',Stamp='$tiden',SistEndretAv='$brukernavn' WHERE Id LIKE '2'");
  echo "<div style=\"float: left; width: 490px; background-color:#ffffff; margin-top:2px; margin-left:2px; padding-bottom:5px; padding-top:5px;\"><span class=\"Span_str_6\">Endring utført!</span></div>";
  }}
  ?>  
  <div style="float: left; width: 490px; background-color:#f9f6f6; margin-top:2px; margin-left:2px;">
  <div id="myInstance1" style="float:left; margin:5px; min-height:200px; width:480px;">
  <?

  $HentFAQ = mysql_query("SELECT * FROM FAQ WHERE Id LIKE '2'");
  $InfoFAQ = mysql_fetch_assoc($HentFAQ);
  echo $InfoFAQ['Faq'];
  ?>
  </div></div></div>
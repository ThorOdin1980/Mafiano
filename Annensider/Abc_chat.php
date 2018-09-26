  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
  <style type="text/css">
    .chat_textarea {
          float:right;
          border-style: solid;
          border-width: 1px;
          border-color:#000000;
          margin-right:5px;
          padding:5px;
          width:430px;
          height:100px;
          background-color:#383838;
          font-size:10px;
          color:#FFFFFF;
          font-family: Verdana;
        }

      button.post_chat {
        float:right;
        font-weight:bold;
        border-style: solid;
        border-width: 1px;
        border-color:#000000;
        margin-right:5px;
        margin-top:3px;
        height:20px;
        width:55px;
        font-size:10px;
      }

      .chat_reset_button  {
        float:right;
        font-weight:bold;
        border-style: solid;
        border-width: 1px;
        border-color:#000000;
        margin-right:3px;
        margin-top:3px;
        height:20px;
        width:55px;
        font-size:10px;
      }

      .MeldVises  {
        float:right;
        width:200px;
        height: 18px;
        margin-right:3px;
        margin-top:3px;
        border-style: solid;
        border-width: 1px;
        border-color:#000000;
        line-height:18px;
        text-indent:5px;
        color:#ffffff;
      }

      .Chatshow {
        float:left; width: 480px; margin-left:5px; margin-top:5px; color:#ffffff; overflow: auto;
      }
  </style>
  <script type="text/javascript">
  
  function SkrivDiv(DivID,DivTekst) { document.getElementById(DivID).innerHTML = DivTekst;  }


  function get(obj) {
    if($("#ChatPost").val() == "") {
      alert('Meldingen mangler.');
    } else if($("#ChatPost").val().length > "600") {
      alert('Meldingen kan maks inneholde 600 tegn.');
    } else {
      var poststr = "du_valgte=" + encodeURI( document.getElementById("du_valgte").value ) + "&ChatPost=" + encodeURI( document.getElementById("ChatPost").value );
      $("#ChatPost").val("");
      makePOSTRequest('post.php', poststr);
    }
  }

   
  $(document).ready( function() { 
    function Chat() {
    $.getJSON("post.php?SkrivChat=",function(data){
      SkrivDiv('Chatvisesher',data[1]);
    }); 
  } setInterval( Chat, 1000); });


  </script>

  <div class="Div_masta">
    <form action="javascript:get(document.getElementById('myform'));" name="myform" id="myform">
      <input type="hidden" name="action" id="du_valgte" value="Chat"/>
      <div class="Div_innledning" id="Div_innleding">
        <span class="Span_str_2">CHAT</span></div>
        <div class="Div_Porno_0">
          <textarea class="chat_textarea" name="ChatPost" id="ChatPost"></textarea>
          <button class="post_chat" name="B3">POST</button>
          <input type="reset" class="chat_reset_button" value="RESET" name="h">
</form>
          <!--<div id="MeldVises" class="MeldVises"></div>-->

        </div>
        <div class="Div_Porno_0">
          <div class="Chatshow" id="Chatvisesher">Laster... </div>
        </div>
      
    </div>








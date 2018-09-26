
  function LastSide(Fil) { 
  $("#SB_Midten2").load(Fil);
  }
      
  /* Post form */
  var http_request = false;
  function makePOSTRequest(url, parameters) { http_request = false;
  if (window.XMLHttpRequest) { http_request = new XMLHttpRequest();
  if (http_request.overrideMimeType) { http_request.overrideMimeType('text/html'); }} else if (window.ActiveXObject) { // IE
  try { http_request = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {
  try { http_request = new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {}}}
  if (!http_request) { alert('Cannot create XMLHTTP instance'); return false; }
  http_request.onreadystatechange = alertContents;
  http_request.open('POST', url, true);
  http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_request.setRequestHeader("Content-length", parameters.length);
  http_request.setRequestHeader("Connection", "close");
  http_request.send(parameters); }



  /* Nedtelling */
  $(document).ready( function() { 
  function NedTell() {
    $('.TellNed').each(function(){
      var id = '#' + this.id;
      var verdi = $(id).html() - '1';
      if(verdi >= '0') {
        $(id).html(verdi);
      }
    }
   ); 
  }

  function TidKlar() {
    $('.TidKlar').each(function(){
      var id = '#' + this.id;
      if($(id).html() != '(klar)') {
        var verdi = $(id).html().replace(/\D/g,'') - '1';
        if(verdi <= '0') {
          $(id).html('(klar)');
        } else {
          $(id).html('('+verdi+')');
        }
      }
    }
    );
  }

  setInterval(NedTell, 1000); setInterval(TidKlar, 1000); });

  function VisAlternativer(id) { var id = '#'+id; if($(id).css('visibility') == "visible") { $(id).css('visibility','hidden'); } else { $('.D_Boks').css('visibility','hidden'); $(id).css('visibility','visible'); }}
  function VisValg(Div,Tekst,Verdi) { var GetDiv = document.getElementById(Div); var DivTekst = '<b>' + Div + ':' + '</b>' + '&nbsp;' + Tekst; GetDiv.innerHTML = DivTekst; document.getElementById(Verdi).value = Tekst; }
  function numbersonly(myfield, e, dec) { var key; var keychar; if (window.event) key = window.event.keyCode; else if (e) key = e.which; else return true; keychar = String.fromCharCode(key); if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) return true; else if ((("0123456789").indexOf(keychar) > -1)) return true; else if (dec && (keychar == ".")) { myfield.form.elements[dec].focus(); return false; } else return false; }
  



  // Added later


   
   
  $(function(){
  $('.dragbox')
  .each(function(){
  $(this).hover(function(){
  $(this).find('h1').addClass('collapse');
  }, function(){
  $(this).find('h1').removeClass('collapse');
  })
  .find('h1').hover(function(){
  $(this).find('.drakos').css('visibility', 'visible');
  }, function(){
  $(this).find('.drakos').css('visibility', 'hidden');
  })
  .click(function(){
  $(this).siblings('.dragbox-content').toggle();
  })
  .end()
  .find('.drakos').css('visibility', 'hidden');
  });
  
  $('.column').sortable({
  connectWith: '.column',
  handle: 'h1',
  cursor: 'move',
  placeholder: 'placeholder',
  forcePlaceholderSize: true,
  opacity: 0.4,
  stop: function(event, ui){
  $(ui.item).find('h1').click();
  var sortorder='';
  $('.column').each(function(){
  var itemorder=$(this).sortable('toArray');
  var columnId=$(this).attr('id');
  sortorder+=columnId+'='+itemorder.toString()+'/';
  });
  sortEr = encodeURI(sortorder);
  /* Skal poste til post.php her */
  }
  })
  .disableSelection();
  });

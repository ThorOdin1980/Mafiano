        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 

        function bbkoder ($str) {
        $bbkoder = array(
        '/\[center\](.*?)\[\/center\]/is',
        '/\[film\](.*?)\[\/film\]/is',
        '/\[mar2\](.*?)\[\/mar\]/is',
        '/\[mar\](.*?)\[\/mar\]/is',
        '/\[k\](.*?)\[\/k\]/is',
        '/\[b\](.*?)\[\/b\]/is',                               
        '/\[i\](.*?)\[\/i\]/is',                               
        '/\[u\](.*?)\[\/u\]/is',
        '/\[p\](.*?)\[\/p\]/is',
        '/\[img\](.*?)\[\/img\]/is',
        '/\[img=(.*?)\]/is',
        '/\[hr\]/is',
        '/\[farge=(.*?)\](.*?)\[\/farge\]/is',
        '/\[navn\](.*?)\[\/navn\]/is',
        '/\[size=(.*?)\](.*?)\[\/size\]/is',
        '/\[ramme=(.*?)\](.*?)\[\/ramme\]/is',
        '/\:wow:/is',
        '/\:rofl:/is',
        '/\:sover:/is',
        '/\:le:/is',
        '/\:luv:/is',
        '/\:plis:/is',
        '/\:lol:/is',
        '/\:hm:/is',
        '/\:unfear:/is',
        '/\:bigeye:/is',
        '/\:tatt:/is',
        '/\:blåveis:/is',
        '/\:forvirret:/is',
        '/\:spam:/is'
        );
  
        $erstatt = array(
        '<center>$1</center>',
        '<embed src="$1" width="425" height="350"></embed>',
        '<marquee behavior="alternate">$1</marquee>',
        '<marquee>$1</marquee>',
        '<em>$1</em>',
        '<b>$1</b>',
        '<i>$1</i>',
        '<u>$1</u>',
        '<p>$1</p>',
        '<img src="$1" style="max-width:480px; max-height=500px;" />',
        '<img src="$1" style="max-width:480px; max-height=500px;" />',
        '<hr color="#000000" />',
        '<span style="color: $1">$2</span>',
        '<a href="http://www.mafiano.no/game.php?side=Bruker&navn=$1">$1</a>',
        '<font size="$1">$2</font>',
        '<fieldset style="border:2px solid #000000; width: 440;"><legend>$1</legend>$2</fieldset>',
        '<img border="0" src="smilies/wow.gif">',
	    '<img border="0" src="smilies/rofl.gif">',
        '<img border="0" src="smilies/sover.gif">',
        '<img border="0" src="smilies/le.gif">',
	    '<img border="0" src="smilies/luv.gif">',
        '<img border="0" src="smilies/plis.gif">',
        '<img border="0" src="smilies/lol.gif">',
	    '<img border="0" src="smilies/hm.gif">',
        '<img border="0" src="smilies/unfear.gif">',
        '<img border="0" src="smilies/bigeye.gif">',
	    '<img border="0" src="smilies/tatt.gif">',
        '<img border="0" src="smilies/blåveis.gif">',
        '<img border="0" src="smilies/forvirret.gif">',
	    '<img border="0" src="smilies/spam.gif">'
        );
        $str = preg_replace ($bbkoder, $erstatt, $str);
        return nl2br($str);  
        }

        echo "<div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">NYHETER</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Nyheter-1.jpg\" width=\"490\" height=\"200\"></div>";

        $antall = AntallSider(@$_REQUEST['s']);
        
      
        $Il = mysql_query("SELECT * FROM Nyheter WHERE id LIKE '%' ORDER BY `Stamp` DESC LIMIT $antall, 20");
        while ($Rad = mysql_fetch_assoc($Il)) {   
        $Tekst = bbkoder($Rad['Nyhet']);  
        $Tekst = wordwrap($Tekst, 60, "\n", true);
        
        $Bruker = BrukerURL($Rad['Brukernavn']);
        
        echo "<div class=\"Div_Porno_0\"><span class=\"Span_str_8\">";
	    if(!empty($Rad['BildeURL'])) { echo "<A class=\"thickbox\" title=\"\" href=\"".$Rad['BildeURL']."\"><img style=\"float: left; clear: left; padding-right:5px; max-width:190px; max-height: 190px;\" border=\"0\" src=\"".$Rad['BildeURL']."\"></A>"; }
	    echo "<p style=\"font-family: Arial Black; font-size:14px; font-weight:bold;\">".$Rad['Overskrift']."</p><hr noshade color=\"#000000\" style=\"margin-top:3px; margin-bottom:3px;\"><p>$Tekst</p><hr noshade color=\"#000000\" style=\"margin-top:3px; margin-bottom:3px;\"><p style=\"float:left;\">".$Rad['Dato']."</p><p style=\"float:right;\">$Bruker</p></span></div>";
        }
        
      
        $Rader = mysql_query("SELECT * FROM Nyheter WHERE id LIKE '%'");
        #echo VisSideListe(mysql_num_rows($Rader));

        echo "</div>";
        }
        ?>
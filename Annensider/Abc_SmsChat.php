        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">SMS CHAT</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/sms.jpg\" width=\"490\" height=\"200\"></div>
        ";
        

        function sjekk_sms($meld){ 
        $meld = substr($meld, 5);
        $meld = substr($meld, 0, 10) . '';
        $meld = ereg_replace("[^A-Za-z0-9]", "", $meld);
        $meld = ereg_replace("[A]", "", $meld);
        $meld = substr($meld, 0, 4) . '';
        $meld = strtoupper($meld);
        if($meld == 'POEN' || $meld == 'NICK') { return 0; } else { return 1; }
        }
        
        function tlf_nr($meld){ $meld = substr($meld, 2); $meld = substr($meld, 0, 5) . ''; return $meld; }
        
      
        $Hent_SMS_Meld = mysql_query("SELECT * FROM HttpInbox WHERE MessageType LIKE 'text' AND Ibruk LIKE 'Nei'");
        if(mysql_num_rows($Hent_SMS_Meld) >= '1') { 
        while ($Meld_Info = mysql_fetch_assoc($Hent_SMS_Meld)) { 
        if(sjekk_sms($Meld_Info['Data']) == 1) { 
        $SMS_Melding = substr($Meld_Info['Data'], 5);


        echo "
        <div class=\"Div_Porno_0\">
        <span class=\"Span_str_8\">
        <b>Telefon nummer:</b> ".tlf_nr($Meld_Info['FromNumber'])."??? <br>
        <b>Insendt av:</b> Brukernavn <br>
        <b>Dato:</b> ".$Meld_Info['Timestamp']."<br>
        <b>Melding:</b> ".$SMS_Melding."<br>
        </span><br>
        </div>
        ";
        
        }}}

        echo "</div>";
        
        } 
        ?>

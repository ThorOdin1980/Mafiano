        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_top_1"><span class="Span_str_1">Byer</span><form method="post" id="<?=$submit_knapp_2;?>"></div>
        <div class="Div_top_1"><span class="Span_str_1">Priser</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Tider</span></div>
        <div class="Div_top_2"><span class="Span_str_1">Merk</span></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Drammen</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris1;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;05 - 15 <? if(date("i") > '04' && date("i") < '16') { if($land != 'Drammen') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="1" checked name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Lillehammer</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris2;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;10 - 20 <? if(date("i") > '09' && date("i") < '21') { if($land != 'Lillehammer') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="2" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Hamar</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris3;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;15 - 25 <? if(date("i") > '14' && date("i") < '26') { if($land != 'Hamar') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="3" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Alta</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris4;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;20 - 30 <? if(date("i") > '19' && date("i") < '31') { if($land != 'Alta') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="4" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Bergen</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris5;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;25 - 35 <? if(date("i") > '24' && date("i") < '36') { if($land != 'Bergen') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="5" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Bodø</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris6;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;30 - 40 <? if(date("i") > '29' && date("i") < '41') { if($land != 'Bodø') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="6" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Oslo</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris7;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;35 - 45 <? if(date("i") > '34' && date("i") < '46') { if($land != 'Oslo') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="7" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Stavanger</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris8;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;40 - 50 <? if(date("i") > '39' && date("i") < '51') { if($land != 'Stavanger') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="8" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Trondheim</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris9;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;45 - 55 <? if(date("i") > '44' && date("i") < '56') { if($land != 'Trondheim') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="9" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Tromsø</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris10;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;50 - 60 <? if(date("i") >= '50' || date("i") == '00') { if($land != 'Tromsø') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="10" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Kristiansand</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris11;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;55 - 05 <? if(date("i") >= '55' || date("i") <= '05') { if($land != 'Kristiansand') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="11" name="number"></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;Sandefjord</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;<?=$flyplass_pris12;?> Kr</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;00 - 10 <? if(date("i") >= '00' && date("i") < '11') { if($land != 'Sandefjord') { echo '( <font color="#3c943c">Går nå</font> )'; } else { echo '( <font color="#cc3f01">Er her</font> )'; }} ?></div>
        <div class="Div_bunn_2"><input type="radio" value="12" name="number"></div>
        <div class="Div_submit_knapp_3" onclick="document.getElementById('<?=$submit_knapp_2;?>').submit()"><p class="pan_str_2">REIS MED OFFENTLIG FLY</p></div></form>
        <?
        }
        ?>
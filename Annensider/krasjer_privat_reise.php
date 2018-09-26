     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <?
     if (empty($brukernavn)) { header("Location: index.php"); } else {
      
     if($land == 'Drammen' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer"); }
     if($land == 'Drammen' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar"); }
     if($land == 'Drammen' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Lillehammer","Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Drammen' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen"); }
     if($land == 'Drammen' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Hamar","Trondheim");  }
     if($land == 'Drammen' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Oslo"); }
     if($land == 'Drammen' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Drammen","Stavanger"); }
     if($land == 'Drammen' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Lillehammer","Trondheim"); }
     if($land == 'Drammen' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Lillehammer","Hamar","Trondheim","Bodø","Tromsø"); }
     if($land == 'Drammen' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand"); }
     if($land == 'Drammen' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Lillehammer' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Trondheim"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Oslo"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Drammen","Stavanger"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Trondheim"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Trondheim","Bodø","Tromsø"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand","Drammen"); }
     if($land == 'Lillehammer' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Hamar' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen"); }
     if($land == 'Hamar' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer"); }
     if($land == 'Hamar' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Hamar' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen","Lillehammer"); }
     if($land == 'Hamar' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Trondheim","Bodø"); }
     if($land == 'Hamar' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Oslo"); }
     if($land == 'Hamar' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Drammen","Stavanger"); }
     if($land == 'Hamar' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Trondheim"); }
     if($land == 'Hamar' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Trondheim","Bodø","Tromsø"); }
     if($land == 'Hamar' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand","Drammen"); }
     if($land == 'Hamar' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Alta' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen","Tromsø","Bodø","Trondheim","Lillehammer"); }
     if($land == 'Alta' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer","Tromsø","Bodø","Trondheim"); }
     if($land == 'Alta' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar","Tromsø","Bodø","Trondheim"); }
     if($land == 'Alta' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen","Tromsø","Bodø","Trondheim"); }
     if($land == 'Alta' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Bodø","Tromsø"); }
     if($land == 'Alta' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Oslo","Tromsø","Bodø","Trondheim","Hamar"); }
     if($land == 'Alta' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Stavanger","Bergen","Tromsø","Bodø","Trondheim"); }
     if($land == 'Alta' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Tromsø","Bodø","Trondheim"); }
     if($land == 'Alta' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Tromsø"); }
     if($land == 'Alta' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand","Stavanger","Bergen","Tromsø","Bodø","Trondheim"); }
     if($land == 'Alta' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord","Hamar","Tromsø","Bodø","Trondheim"); }
     
     if($land == 'Bergen' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen"); }
     if($land == 'Bergen' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer"); }
     if($land == 'Bergen' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Lillehammer","Hamar"); }
     if($land == 'Bergen' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Bergen' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Trondheim","Bodø");  }
     if($land == 'Bergen' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Drammen","Oslo"); }
     if($land == 'Bergen' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Stavanger"); }
     if($land == 'Bergen' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Trondheim"); }
     if($land == 'Bergen' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Trondheim","Bodø","Tromsø"); }
     if($land == 'Bergen' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Stavanger","Kristiansand"); }
     if($land == 'Bergen' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Bodø' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen","Trondheim","Lillehammer"); }
     if($land == 'Bodø' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer","Trondheim"); }
     if($land == 'Bodø' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar","Trondheim"); }
     if($land == 'Bodø' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Alta","Tromsø"); }
     if($land == 'Bodø' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen","Trondheim"); }
     if($land == 'Bodø' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Oslo","Trondheim","Hamar"); }
     if($land == 'Bodø' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Stavanger","Trondheim","Bergen"); }
     if($land == 'Bodø' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Trondheim"); }
     if($land == 'Bodø' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Tromsø"); }
     if($land == 'Bodø' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand","Trondheim","Bergen","Stavanger"); }
     if($land == 'Bodø' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord","Trondheim","Lillehammer","Drammen"); }

     if($land == 'Oslo' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen"); }
     if($land == 'Oslo' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer"); }
     if($land == 'Oslo' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar"); }
     if($land == 'Oslo' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Hamar","Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Oslo' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen","Drammen"); }
     if($land == 'Oslo' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Hamar","Trondheim","Bodø"); }
     if($land == 'Oslo' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Stavanger","Drammen"); }
     if($land == 'Oslo' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Trondheim","Lillehammer"); }
     if($land == 'Oslo' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Tromsø","Hamar","Trondheim","Bodø"); }
     if($land == 'Oslo' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand"); }
     if($land == 'Oslo' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Stavanger' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen"); }
     if($land == 'Stavanger' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer"); }
     if($land == 'Stavanger' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar","Drammen"); }
     if($land == 'Stavanger' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Lillehammer","Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Stavanger' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen"); }
     if($land == 'Stavanger' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Lillehammer","Trondheim","Bodø"); }
     if($land == 'Stavanger' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Drammen","Oslo"); }
     if($land == 'Stavanger' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Lillehammer","Trondheim"); }
     if($land == 'Stavanger' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Lillehammer","Trondheim","Bodø","Tromsø"); }
     if($land == 'Stavanger' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand"); }
     if($land == 'Stavanger' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Trondheim' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen","Lillehammer"); }
     if($land == 'Trondheim' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer"); }
     if($land == 'Trondheim' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar"); }
     if($land == 'Trondheim' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Bodø","Tromsø","Alta"); }
     if($land == 'Trondheim' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen"); }
     if($land == 'Trondheim' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Bodø"); }
     if($land == 'Trondheim' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Hamar","Oslo"); }
     if($land == 'Trondheim' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Bergen","Stavanger"); }
     if($land == 'Trondheim' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Bodø","Tromsø"); }
     if($land == 'Trondheim' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Lillehammer","Drammen","Kristiansand"); }
     if($land == 'Trondheim' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Tromsø' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Bodø","Trondheim","Lillehammer","Drammen"); }
     if($land == 'Tromsø' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Bodø","Trondheim","Lillehammer"); }
     if($land == 'Tromsø' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Bodø","Trondheim","Hamar"); }
     if($land == 'Tromsø' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Alta"); }
     if($land == 'Tromsø' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bodø","Trondheim","Bergen"); }
     if($land == 'Tromsø' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Bodø"); }
     if($land == 'Tromsø' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Bodø","Trondheim","Lillehammer","Oslo"); }
     if($land == 'Tromsø' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Bodø","Trondheim","Bergen","Stavanger"); }
     if($land == 'Tromsø' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Bodø","Trondheim"); }
     if($land == 'Tromsø' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Bodø","Trondheim","Bergen","Stavanger","Kristiansand"); }
     if($land == 'Tromsø' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Kristiansand' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Drammen","Lillehammer"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Oslo","Hamar"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Stavanger","Bergen","Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Stavanger","Bergen"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Stavanger","Bergen","Trondheim","Bodø"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Oslo"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Stavanger"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Stavanger","Bergen","Trondheim"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Stavanger","Bergen","Trondheim","Bodø","Tromsø"); }
     if($land == 'Kristiansand' && $valgt_sted == 'Sandefjord') { $Fly_styrter_i = array("Sandefjord"); }

     if($land == 'Sandefjord' && $valgt_sted == 'Drammen') { $Fly_styrter_i = array("Drammen"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Lillehammer') { $Fly_styrter_i = array("Lillehammer"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Hamar') { $Fly_styrter_i = array("Hamar"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Alta') { $Fly_styrter_i = array("Oslo","Hamar","Trondheim","Bodø","Tromsø","Alta"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Bergen') { $Fly_styrter_i = array("Bergen"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Bodø') { $Fly_styrter_i = array("Oslo","Hamar","Trondheim","Bodø"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Oslo') { $Fly_styrter_i = array("Oslo"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Stavanger') { $Fly_styrter_i = array("Stavanger"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Trondheim') { $Fly_styrter_i = array("Oslo","Hamar","Trondheim"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Tromsø') { $Fly_styrter_i = array("Oslo","Hamar","Trondheim","Bodø","Tromsø"); }
     if($land == 'Sandefjord' && $valgt_sted == 'Kristiansand') { $Fly_styrter_i = array("Kristiansand"); }
     
     $Fly_styrter_i = $Fly_styrter_i[array_rand($Fly_styrter_i)];
     $Fly_tekst_vises = array("Flyet ditt havarerte over $Fly_styrter_i, du rakk å hoppe ut av flyet før flyet kom helt ut av kontroll. Du mistet flyet ditt og alt som befant seg i det.","Flyet ditt begynte å brenne, du forlot flyet med fallskjermen din. Du mistet flyet ditt og alt som befant seg i det.","Venstre vinge knakk i luftrommet til $Fly_styrter_i, du hoppet ut med fallskjermen din. Du mistet flyet ditt og alt som befant seg i det."); 
     $Fly_tekst_vises = $Fly_tekst_vises[array_rand($Fly_tekst_vises)];
     $ny_sum_penger_blir = $penger - '900';
     $ny_reise_ventetid = $tiden + '900';
     
     // Endrer databaser
   
     mysql_query("DELETE FROM Undergrunn_varer WHERE vare_eier='$brukernavn' AND varer_ligger_hos='$valgt_fly_id'") or die(mysql_error());
   
     mysql_query("DELETE FROM fly_osv WHERE Frakt_eier='$brukernavn' AND id='$valgt_fly_id'") or die(mysql_error());
     mysql_query("UPDATE brukere SET penger='$ny_sum_penger_blir',land='$Fly_styrter_i',reise_tid='$ny_reise_ventetid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
     echo '<div class="Div_MELDING"><span class="Span_str_6">'.$Fly_tekst_vises.'</span></div>';
     }
     ?>
     
     test
        
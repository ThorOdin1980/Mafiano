<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (empty($type)) { header("Location: index.php"); } else {
if ($land == 'Drammen') { $undergrund_pris1 = '245'; }
if ($land == 'Drammen') { $undergrund_pris2 = '110'; }
if ($land == 'Drammen') { $undergrund_pris3 = '140'; }
if ($land == 'Drammen') { $undergrund_pris4 = '600'; }
if ($land == 'Drammen') { $undergrund_pris5 = '250'; }
if ($land == 'Drammen') { $undergrund_pris6 = '5500'; }
if ($land == 'Drammen') { $undergrund_pris7 = '4870'; }
if ($land == 'Drammen') { $undergrund_pris8 = '2780'; }
if ($land == 'Drammen') { $undergrund_pris9 = '2600'; }
if ($land == 'Drammen') { $undergrund_pris10 = '900'; }

if ($land == 'Lillehammer') { $undergrund_pris1 = '235'; }
if ($land == 'Lillehammer') { $undergrund_pris2 = '100'; }
if ($land == 'Lillehammer') { $undergrund_pris3 = '150'; }
if ($land == 'Lillehammer') { $undergrund_pris4 = '480'; }
if ($land == 'Lillehammer') { $undergrund_pris5 = '200'; }
if ($land == 'Lillehammer') { $undergrund_pris6 = '6500'; }
if ($land == 'Lillehammer') { $undergrund_pris7 = '5000'; }
if ($land == 'Lillehammer') { $undergrund_pris8 = '2980'; }
if ($land == 'Lillehammer') { $undergrund_pris9 = '3000'; }
if ($land == 'Lillehammer') { $undergrund_pris10 = '960'; }

if ($land == 'Hamar') { $undergrund_pris1 = '170'; }
if ($land == 'Hamar') { $undergrund_pris2 = '86'; }
if ($land == 'Hamar') { $undergrund_pris3 = '150'; }
if ($land == 'Hamar') { $undergrund_pris4 = '520'; }
if ($land == 'Hamar') { $undergrund_pris5 = '200'; }
if ($land == 'Hamar') { $undergrund_pris6 = '6000'; }
if ($land == 'Hamar') { $undergrund_pris7 = '5100'; }
if ($land == 'Hamar') { $undergrund_pris8 = '2700'; }
if ($land == 'Hamar') { $undergrund_pris9 = '2700'; }
if ($land == 'Hamar') { $undergrund_pris10 = '955'; }

if ($land == 'Alta') { $undergrund_pris1 = '180'; }
if ($land == 'Alta') { $undergrund_pris2 = '89'; }
if ($land == 'Alta') { $undergrund_pris3 = '130'; }
if ($land == 'Alta') { $undergrund_pris4 = '530'; }
if ($land == 'Alta') { $undergrund_pris5 = '190'; }
if ($land == 'Alta') { $undergrund_pris6 = '6100'; }
if ($land == 'Alta') { $undergrund_pris7 = '5300'; }
if ($land == 'Alta') { $undergrund_pris8 = '3200'; }
if ($land == 'Alta') { $undergrund_pris9 = '3000'; }
if ($land == 'Alta') { $undergrund_pris10 = '907'; }

if ($land == 'Bergen') { $undergrund_pris1 = '150'; }
if ($land == 'Bergen') { $undergrund_pris2 = '100'; }
if ($land == 'Bergen') { $undergrund_pris3 = '160'; }
if ($land == 'Bergen') { $undergrund_pris4 = '500'; }
if ($land == 'Bergen') { $undergrund_pris5 = '180'; }
if ($land == 'Bergen') { $undergrund_pris6 = '6000'; }
if ($land == 'Bergen') { $undergrund_pris7 = '5300'; }
if ($land == 'Bergen') { $undergrund_pris8 = '3200'; }
if ($land == 'Bergen') { $undergrund_pris9 = '3020'; }
if ($land == 'Bergen') { $undergrund_pris10 = '920'; }

if ($land == 'Bodø') { $undergrund_pris1 = '180'; }
if ($land == 'Bodø') { $undergrund_pris2 = '129'; }
if ($land == 'Bodø') { $undergrund_pris3 = '150'; }
if ($land == 'Bodø') { $undergrund_pris4 = '500'; }
if ($land == 'Bodø') { $undergrund_pris5 = '210'; }
if ($land == 'Bodø') { $undergrund_pris6 = '5990'; }
if ($land == 'Bodø') { $undergrund_pris7 = '4900'; }
if ($land == 'Bodø') { $undergrund_pris8 = '2990'; }
if ($land == 'Bodø') { $undergrund_pris9 = '2970'; }
if ($land == 'Bodø') { $undergrund_pris10 = '908'; }

if ($land == 'Oslo') { $undergrund_pris1 = '260'; }
if ($land == 'Oslo') { $undergrund_pris2 = '149'; }
if ($land == 'Oslo') { $undergrund_pris3 = '181'; }
if ($land == 'Oslo') { $undergrund_pris4 = '700'; }
if ($land == 'Oslo') { $undergrund_pris5 = '340'; }
if ($land == 'Oslo') { $undergrund_pris6 = '6320'; }
if ($land == 'Oslo') { $undergrund_pris7 = '5240'; }
if ($land == 'Oslo') { $undergrund_pris8 = '3190'; }
if ($land == 'Oslo') { $undergrund_pris9 = '3070'; }
if ($land == 'Oslo') { $undergrund_pris10 = '936'; }

if ($land == 'Stavanger') { $undergrund_pris1 = '230'; }
if ($land == 'Stavanger') { $undergrund_pris2 = '100'; }
if ($land == 'Stavanger') { $undergrund_pris3 = '150'; }
if ($land == 'Stavanger') { $undergrund_pris4 = '500'; }
if ($land == 'Stavanger') { $undergrund_pris5 = '200'; }
if ($land == 'Stavanger') { $undergrund_pris6 = '6000'; }
if ($land == 'Stavanger') { $undergrund_pris7 = '5000'; }
if ($land == 'Stavanger') { $undergrund_pris8 = '3000'; }
if ($land == 'Stavanger') { $undergrund_pris9 = '2800'; }
if ($land == 'Stavanger') { $undergrund_pris10 = '943'; }

if ($land == 'Trondheim') { $undergrund_pris1 = '200'; }
if ($land == 'Trondheim') { $undergrund_pris2 = '90'; }
if ($land == 'Trondheim') { $undergrund_pris3 = '140'; }
if ($land == 'Trondheim') { $undergrund_pris4 = '490'; }
if ($land == 'Trondheim') { $undergrund_pris5 = '200'; }
if ($land == 'Trondheim') { $undergrund_pris6 = '6140'; }
if ($land == 'Trondheim') { $undergrund_pris7 = '4900'; }
if ($land == 'Trondheim') { $undergrund_pris8 = '3000'; }
if ($land == 'Trondheim') { $undergrund_pris9 = '2900'; }
if ($land == 'Trondheim') { $undergrund_pris10 = '914'; }

if ($land == 'Tromsø') { $undergrund_pris1 = '209'; }
if ($land == 'Tromsø') { $undergrund_pris2 = '98'; }
if ($land == 'Tromsø') { $undergrund_pris3 = '146'; }
if ($land == 'Tromsø') { $undergrund_pris4 = '494'; }
if ($land == 'Tromsø') { $undergrund_pris5 = '207'; }
if ($land == 'Tromsø') { $undergrund_pris6 = '6143'; }
if ($land == 'Tromsø') { $undergrund_pris7 = '4943'; }
if ($land == 'Tromsø') { $undergrund_pris8 = '3029'; }
if ($land == 'Tromsø') { $undergrund_pris9 = '2984'; }
if ($land == 'Tromsø') { $undergrund_pris10 = '919'; }

if ($land == 'Kristiansand') { $undergrund_pris1 = '218'; }
if ($land == 'Kristiansand') { $undergrund_pris2 = '138'; }
if ($land == 'Kristiansand') { $undergrund_pris3 = '120'; }
if ($land == 'Kristiansand') { $undergrund_pris4 = '532'; }
if ($land == 'Kristiansand') { $undergrund_pris5 = '250'; }
if ($land == 'Kristiansand') { $undergrund_pris6 = '6013'; }
if ($land == 'Kristiansand') { $undergrund_pris7 = '4820'; }
if ($land == 'Kristiansand') { $undergrund_pris8 = '3000'; }
if ($land == 'Kristiansand') { $undergrund_pris9 = '2910'; }
if ($land == 'Kristiansand') { $undergrund_pris10 = '949'; }

if ($land == 'Sandefjord') { $undergrund_pris1 = '208'; }
if ($land == 'Sandefjord') { $undergrund_pris2 = '128'; }
if ($land == 'Sandefjord') { $undergrund_pris3 = '140'; }
if ($land == 'Sandefjord') { $undergrund_pris4 = '600'; }
if ($land == 'Sandefjord') { $undergrund_pris5 = '270'; }
if ($land == 'Sandefjord') { $undergrund_pris6 = '6400'; }
if ($land == 'Sandefjord') { $undergrund_pris7 = '5330'; }
if ($land == 'Sandefjord') { $undergrund_pris8 = '3200'; }
if ($land == 'Sandefjord') { $undergrund_pris9 = '3190'; }
if ($land == 'Sandefjord') { $undergrund_pris10 = '975'; }
}
?>
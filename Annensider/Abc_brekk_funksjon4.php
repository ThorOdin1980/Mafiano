  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon4', time(), $db);

  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); }
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  $SubAvgjor = array("Fengsel","Respekt","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Respekt","Ikkeno","Ikkeno","Ikkeno","Fengsel");
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $SubAvgjor = $SubAvgjor[array_rand($SubAvgjor)];

  $NyVentetid = $Timestamp + '100';
  $BrekkTall = $brekk_gjort + '1';

  if($Avgjor == 'JA') { 
  $Tjen = rand(800, 1800); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $Meld = array("Du stormet leiligheten til naboen og kom unna med $TjenFormat.","Du stjal $TjenFormat fra nabohuset.","Alt du stjal var en tv og en dvd spiller, du solgte det og tjente $TjenFormat.","Du sprengte husveggen og stjal gullkjeder, du tjente $TjenFormat.","Det var ikke mye i huset, du stjal bare en pc og du solgte den for $TjenFormat.","Døren var open så du stjal det lille som var, du tjente $TjenFormat.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble busta.","Du ble tatt av en politimann.","Huset hadde alarm, du ble busta av purken.","Du prøvde og rane huset til en politimann, du ble tatt.","Du ble tatt på veien hjem.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Innbrudd','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $skjoon_tekst = rand (1, 2); 
  if($skjoon_tekst == '1') { $tekst_navn = array("Henrik","Adrian","Sindre","Christian","Lars","Ragnar","Simen","Stig","Marius","Paul","Jørgen","Marcus","Anders","Stefan","Steffen"); $tekst_to_eid = 'mannen'; } else { $tekst_navn = array("Hanna","Tone","Ane","Caroline","Heidi","Ellen","Magnhild","Torild","Hilde","Emilie","Camilla","Monica","Oda sofie","Tina","Connie"); $tekst_to_eid = 'dama'; }
  $tekst_navn = $tekst_navn[array_rand($tekst_navn)];
  $Meld = array("Du fant ingen gjennstander av verdi så du tente på huset, du gikk opp i respekt.","Dæven du banka dritten ut av huseieren, du stakk før politi kom til åstedet, du gikk opp i respekt.","Huset du skulle rane var fult av folk, du gikk inn å knuste noen hoder. Du gikk opp i respekt.","Du slo ned politimannen Fred på vei til huset, du gikk opp i respekt men fikk ikke stjelt noe.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') { 
  $Meld = array("Du kom deg inn i huset men noen andre hadde stjelt alt av verdi rett før deg, du feilet.","Du feilet.","Du knuste kjøkkenvinduet men alarmen gikk, du stakk.","Du brøt deg inn i huset men falt på vei ut, du feilet.","Alt gikk bra helt til eiern kom hjem og slo deg ned.","Du prøvde å dirke opp døra men klarte det ikke.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>
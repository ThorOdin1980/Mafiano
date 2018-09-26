  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 

  if($SexLengde == '40') { if($Gir['horer_pult'] >= '80') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }} 
  elseif($SexLengde == '35') { if($Gir['horer_pult'] >= '70') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '30') { if($Gir['horer_pult'] >= '60') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '25') { if($Gir['horer_pult'] >= '50') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '20') { if($Gir['horer_pult'] >= '40') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '15') { if($Gir['horer_pult'] >= '30') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '10') { if($Gir['horer_pult'] >= '10') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}

  if($Gir['Kjon'] == 'Gutt' && $Tar['Kjon'] == 'Gutt') { 
  if($Stilling == 'Doggystyle') { $Meld_0 = "Du knullet $PersTo brutalt i rompa mens han var bundet fast."; } 
  elseif($Stilling == 'Oralsex') { $Meld_0 = "Du ble sugd av $PersTo mens du pisket ham med din sadopisk."; }
  elseif($Stilling == 'Plogen' || $Stilling == 'Bindersen' || $Stilling == 'Lotus' || $Stilling == 'Myk misjonær') { $Meld_0 = 'Du utførte sex stillingen "'.strtolower($Stilling).'" med en mann som var bundet fast.'; }
  } 
  elseif($Gir['Kjon'] == 'Jente' && $Tar['Kjon'] == 'Gutt') {
  if($Stilling == 'Doggystyle') { $Meld_0 = "$PersTo bandt deg fast og knullet deg hardt."; } 
  elseif($Stilling == 'Oralsex') { $Meld_0 = "$PersTo sleiket musa di, du pisket ham med lærpisk."; }
  elseif($Stilling == 'Plogen' || $Stilling == 'Bindersen' || $Stilling == 'Lotus' || $Stilling == 'Myk misjonær') { $Meld_0 = 'Du utførte sex stillingen "'.strtolower($Stilling).'" med en mann som var bundet fast.'; }
  }
  elseif($Gir['Kjon'] == 'Gutt' && $Tar['Kjon'] == 'Jente') { 
  if($Stilling == 'Doggystyle') { $Meld_0 = "Du knullet $PersTo mens hu var bundet fast."; } 
  elseif($Stilling == 'Oralsex') { $Meld_0 = "$PersTo sugde deg mens du pisket hun med sadopisken din."; }
  elseif($Stilling == 'Plogen' || $Stilling == 'Bindersen' || $Stilling == 'Lotus' || $Stilling == 'Myk misjonær') { $Meld_0 = 'Du utførte sex stillingen "'.strtolower($Stilling).'" med ei jente som var bundet fast.'; }
  }
  elseif($Gir['Kjon'] == 'Jente' && $Tar['Kjon'] == 'Jente') { 
  if($Stilling == 'Doggystyle') { $Meld_0 = "Du og $PersTo pulte hverandre i rompa med strapon dildo, du brukte også en sadopisk på hun en gang iblandt."; } 
  elseif($Stilling == 'Oralsex') { $Meld_0 = "$PersTo sleika deg, du bandt hu fast under aktiviteten."; }
  elseif($Stilling == 'Plogen' || $Stilling == 'Bindersen' || $Stilling == 'Lotus' || $Stilling == 'Myk misjonær') { $Meld_0 = 'Du utførte sex stillingen "'.strtolower($Stilling).'" med ei jente som var bundet fast, du brukte strapon dildo.'; }
  }

  if($Gir['Kjon'] == $Tar['Kjon']) { $GiRespekt = 'Nei'; $Meld_1 = 'Du fikk ikke respekt siden du hadde samleie med likt kjøn.'; } 
  elseif($Holder == 'Ja') { $GiRespekt = 'Ja'; $Meld_1 = 'Du holdt ut under hele perioden, du fikk respekt.'; }
  elseif($Holder == 'Nei') { $GiRespekt = 'Nei'; $Meld_1 = 'Du fikk desverre ikke respekt siden du besvimte under aktiviteten.';  }

  $Meld = "$Meld_0 $Meld_1";
  $NyPult = $Tar['horer_pult'] + '1';

  include "knull_prosent.php";

  if($GiRespekt == 'Ja') { $Res_1 = ( $Gir['horer_pult'] + '2.53' ) * '2.2'; if($Res_1 > '900') { $Res_1 = '900'; } $Res_2 = ( $Gir['rank_nivaa'] + '2.53' ) * '2'; $Res_3 = $SexLengde * '3.3'; $GiResp = floor($Res_1 + $Res_2 + $Res_3); } else { $GiResp = '0'; }


  mysql_query("UPDATE brukere SET rankpros=`rankpros`+'$knull_prosent_s',horer_pult=`horer_pult`+'1',respekt=`respekt`+'$GiResp' WHERE brukernavn='$PersEn'"); 
  mysql_query("UPDATE brukere SET horer_pult='$NyPult',penger=`penger`+'$PengeSum' WHERE brukernavn='$PersTo'"); 
  mysql_query("UPDATE Horehus SET Bang_hore_skils='$NyPult',Bang_Status='Klar for deg' WHERE id='$HorehusID'"); 
  mysql_query("DELETE FROM Horehus_Knull WHERE Knull_horehus_id='$HorehusID' AND Knull_brukernavn='$PersEn'");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersEn','$Timestamp','$FullDato','Seksuel aktivitet','$Meld','Ja')");
  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersTo','$Timestamp','$FullDato','Sex over','Seksuel aktivitet med $PersEn er avsluttet.','Ja')");

  }
  ?>
<?
if (empty($brukernavn)) { header("Location: index.php"); } else {
if ($rank_niva == "1") {   $RankPluss = '2.5'; }
if ($rank_niva == "2") {   $RankPluss = '1.9'; }
if ($rank_niva == "3") {   $RankPluss = '1.5'; }
if ($rank_niva == "4") {   $RankPluss = '1.0'; }
if ($rank_niva == "5") {   $RankPluss = '0.4'; }
if ($rank_niva == "6") {   $RankPluss = '0.1'; }
if ($rank_niva == "7") {   $RankPluss = '0.09'; }
if ($rank_niva == "8") {   $RankPluss = '0.05'; }
if ($rank_niva == "9") {   $RankPluss = '0.01'; }
if ($rank_niva == "10") {  $RankPluss = '0.009'; }
if ($rank_niva == "11") {  $RankPluss = '0.005'; }
if ($rank_niva == "12") {  $RankPluss = '0.004'; }
if ($rank_niva == "13") {  $RankPluss = '0.003'; }
if ($rank_niva == "14") {  $RankPluss = '0.002'; }
if ($rank_niva == "15") { $RankPluss = '0.001'; }
if ($rank_niva == "16") { $RankPluss = '0.0009'; }
if ($rank_niva == "17") { $RankPluss = '0.0008'; }
}
?>
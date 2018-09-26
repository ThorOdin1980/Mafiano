<?
// Knull prosent
if (empty($brukernavn)) { header("Location: index.php"); }
if ($rank_niva == "1") {   $knull_prosent_s = '2.5'; }
if ($rank_niva == "2") {   $knull_prosent_s = '1.9'; }
if ($rank_niva == "3") {   $knull_prosent_s = '1.5'; }
if ($rank_niva == "4") {   $knull_prosent_s = '1.0'; }
if ($rank_niva == "5") {   $knull_prosent_s = '0.4'; }
if ($rank_niva == "6") {   $knull_prosent_s = '0.1'; }
if ($rank_niva == "7") {   $knull_prosent_s = '0.07'; }
if ($rank_niva == "8") {   $knull_prosent_s = '0.04'; }
if ($rank_niva == "9") {   $knull_prosent_s = '0.01'; }
if ($rank_niva == "10") {  $knull_prosent_s = '0.008'; }
if ($rank_niva == "11") {  $knull_prosent_s = '0.004'; }
if ($rank_niva == "12") {  $knull_prosent_s = '0.003'; }
if ($rank_niva == "13") {  $knull_prosent_s = '0.002'; }
if ($rank_niva == "14") {  $knull_prosent_s = '0.001'; }
if ($rank_niva == "15") { $knull_prosent_s = '0.0008'; }
if ($rank_niva == "16") { $knull_prosent_s = '0.0007'; }
if ($rank_niva == "17") { $knull_prosent_s = '0.0006'; }


?>
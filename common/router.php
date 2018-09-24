<?php
if(!defined('view'))	{ die('Not permission.'); }


	if(isset($_GET['side']))	{


		switch (@$_GET['side']) {
  case "4C": include "Hovedsider/Reis_abc.php"; break;
  case "AntibottSpors": include "Annensider/Abc_antibotter.php"; break;
  case "ButikkFirma": include "Annensider/Abc_StartButikk.php"; break;
  case "Bunker": include "Annensider/Abc_MBunker.php"; break;
  case "bunker": include "Annensider/Abc_MBunker.php"; break;
  case "BrukerRedigeringsLogg": include "Annensider/Abc_RBLogg.php"; break;
  case "Bruker": include "Annensider/Abc_bruker.php"; break;
  case "Børsen": include "Annensider/Abc_borsen.php"; break;
  case "Brekk": include "Annensider/Abc_Brekk.php"; break;
  case "Biltyveri": include "Annensider/Abc_Biltyveri.php"; break;
  case "Banken": include "Annensider/Abc_banken.php"; break;
  case "Chat": include "Annensider/Abc_chat.php"; break;
  case "Detektiv": include "Annensider/Abc_Detektiv.php"; break;
  case "DinKulefabrikk": include "Annensider/Abc_DinKF.php"; break;
  case "DinButikk": include "Annensider/Abc_DinButikk.php"; break;
  case "DineFirma": include "Hovedsider/DineFirma_abc.php"; break;
  case "Drep": include "Annensider/Abc_drep.php"; break;
  case "Eiendeler": include "Annensider/Abc_eiendom.php"; break;
  case "FilmProdusering": include "Annensider/Abc_produserfilm.php"; break;
  case "Fengsel": include "Annensider/Abc_fengsel.php";  break;
  case "Flyplassen": include "Annensider/Abc_flyreise.php"; break;
  case "Frakt": include "Annensider/Abc_Frakt.php"; break;
  case "Facebook": include "Annensider/Abc_Facebook.php"; break;
  case "FAQ": include "Annensider/Abc_faq.php"; break;
  case "Gravplass": include "Annensider/Abc_gravplass.php"; break;
  case "GiStilling": include "Annensider/Abc_GiStilling.php"; break;
  case "Gjeng": include "Annensider/gjeng.php"; break;
  case "Herverk": include "Annensider/Abc_Herverk.php"; break;
  case "Hitlist": include "Annensider/Abc_hitlist.php";  break;
  case "Horehus": include "Annensider/Abc_horehus.php"; break;
  case "IpBan": include "Annensider/Abc_IpBan.php"; break;
  case "Kidnapping": include "Annensider/Abc_kidnapping.php"; break;
  case "kidnappet": include "Annensider/Abc_kidnapping.php"; break;
  case "KontaktOss": include "Annensider/Abc_kontaktoss.php"; break;
  case "Lotto": include "Annensider/Abc_lotto.php"; break;
  case "Marked": include "Annensider/Abc_Marked.php"; break;
  case "MMSBilder": include "Annensider/Abc_MMSBilder.php"; break;
  case "MinSide": include "Annensider/Abc_MinSide.php"; break;
  case "ModkillGjennoppliv": include "Annensider/Abc_killakrem.php"; break;
  case "Nyhetsbehandler": include "Annensider/Abc_Nyhetsbehandler.php"; break;
  case "Nyheter": include "Annensider/Abc_Nyheter.php"; break;
  case "Oppdrag": include "Annensider/Abc_oppdrag.php"; break;
  case "Poker": include "Annensider/Abc_poker.php"; break;
  case "PlanlagtRan": include "Annensider/Abc_planlagtran.php"; break;
  case "Plantasjen": include "Annensider/Abc_plantasjen.php"; break;
  case "Platestudio": include "Annensider/Abc_platestudio.php"; break;
  case "Poeng": include "Annensider/Abc_bestillpoeng.php"; break;
  case "Rengjoring": include "Annensider/Abc_dbrengjoring.php"; break;
  case "StartGjeng": include "Annensider/Abc_startgjeng.php"; break;
  case "SystemRedigering": include "Hovedsider/SystemRedigering_abc.php"; break;
  case "Statistikk": include "Annensider/Abc_stats.php"; break;
  case "SupportSpillere": include "Annensider/Abc_supportspillere.php"; break;
  case "Sykehus": include "Annensider/Abc_sykehus.php"; break;
  case "SpillRegler": include "Annensider/Abc_SpillRegler.php"; break;
  case "TidsStraff": include "Annensider/Abc_TidsStraff.php"; break;
  case "Utpressing": include "Annensider/Abc_utpress.php"; break;
  case "Utpress": include "Annensider/Abc_PressSpiller.php"; break;
  case "Undergrunnen": include "Annensider/Abc_undergrunnen.php"; break;
  case "VopenTrening": include "Annensider/Abc_Skytebanen.php"; break;
  case "SmsChat": include "Annensider/Abc_SmsChat.php"; break;
  case "Forum": include "Annensider/Abc_Forum.php"; break;
  case "LesForum": include "Annensider/Abc_ForumLes.php"; break;

  // New pages

  case "auksjon": include "./common/files/handel/auksjon.php"; break;

  default: include "Annensider/Abc_Nyheter.php";
  }






	} else {
		if(isset($_GET['function']))	{
			if(isset($_GET['file']))	{
				if(file_exists('./common/files/'.$_GET['function'].'/'.$_GET['file'].'.php'))	{
					include('./common/files/'.$_GET['function'].'/'.$_GET['file'].'.php');
				} else {
					$output .= '<div class="content"><div class="heading">Ingen fil</div></div>';
				}
			} else {
				$output .= '<div class="content"><div class="heading">Det skjedde noe feil. #routing.php</div></div>';
			}
		} else {
			if(!isset($_GET['file']))	{
				if(!isset($_SESSION['id']))	{
					if(!file_exists('./common/files/login/login.php'))	{
						$output .= '<div class="content"><div class="heading">Det skjedde noe feil. #routing.php</div></div>';
					} else {
						include('./common/files/login/login.php');
					}
				} else {
					if(!file_exists('./Annensider/Abc_Nyheter.php'))	{
						$output .= '<div class="content"><div class="heading">Det skjedde noe feil. #routing.php</div></div>';
					} else {
						include('./Annensider/Abc_Nyheter.php');
					}
				}
			} else {
				$output .= '<div class="content"><div class="heading">Det skjedde noe feil. #routing.php</div></div>';
			}
		}
	}
	

?>
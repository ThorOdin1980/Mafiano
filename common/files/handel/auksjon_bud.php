<?php
if(!defined('view') || !isset($_SESSION['id'])) { $output .= $noaccess; } else {
	 $output .= '
          <div class="Div_masta">
            <form method="post" id="LagSpors">
              <div class="Div_innledning" id="Div_innleding">
                  <span class="Span_str_2">Auksjon</span>
              </div>
            </form>
          </div>
          ';

     if(isset($_GET['id']))	{
     	// Verify auction id
     	$auction_id = $db->prepare("SELECT * FROM `auctions` WHERE `id`=:auction_id");
     	$auction_id->bindValue(':auction_id', $_GET['id']);
     	$auction_id->execute();

     	if($auction_id->rowCount() > 0)	{
     		// IS auction active=
     		$auction = $auction_id->fetch();

     		if($auction['end_time'] >  time())	{
     			// Everything looks good

     			// Seller info
     			$seller_info_get = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:userid");
     			$seller_info_get->bindValue(':userid', $auction['seller_id']);
     			$seller_info_get->execute();

     			$seller_info = $seller_info_get->fetch();

     			 // Get bid

                $get_bids = $db->prepare("SELECT * FROM `auctions_bid` WHERE `auction_id`=:auction_id ORDER BY `bid` DESC LIMIT 1");
                $get_bids->bindValue(':auction_id', $auction['id']);
                $get_bids->execute();

                if($get_bids->rowCount() > 0)   {
                    $bid = $get_bids->fetch();
                    $bid_ = $bid['bid'];
                } else {
                    $bid_ = '0';
                }

     			$output .= '
     			<div class="form">
     				<div class="left">Objekt</div>
     				<div class="right">&nbsp; '.$auction['object_type'].'</div>
     				<div class="clear"></div>

     				<div class="left">By</div>
     				<div class="right">&nbsp; '.$auction['object_location'].'</div>
     				<div class="clear"></div>

     				<div class="left">Selger</div>
     				<div class="right">&nbsp; '.$seller_info['brukernavn'].'</div>
     				<div class="clear"></div>

     				<div class="left">Høyeste bud</div>
     				<div class="right">&nbsp; '.number_format($bid_).' kr</div>
     				<div class="clear"></div>

     				<div class="left">Ferdig</div>
     				<div class="right">&nbsp; '.date('d. M Y, H:i', $auction['end_time']).'</div>
     				<div class="clear"></div>

     			</div>';


     			// Get list of bids

     			$get_bidlist_ = $db->prepare("SELECT * FROM `auctions_bid` WHERE `auction_id`=:auction_id ORDER BY `bid` DESC");
                $get_bidlist_->bindValue(':auction_id', $auction['id']);
                $get_bidlist_->execute();





     			$output .= '
     			<div class="Div_innledning" id="Div_innleding">
                	<span class="Span_str_2">Budliste</span>
             	</div>

             	<table>
		       		<thead>
		       			<tr>
		       				<th width="162">Brukernavn</th>
		       				<th width="162">Bud</th>
		       				<th width="162">Tid</th>
		       			</tr>
		       		</thead>
		       		<tbody>';

		       		if($get_bidlist_->rowCount() > 0)	{


		       			while($bids = $get_bidlist_->fetch())	{
			       			// Get bidder name
			       			$bidder_name_ = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:bidder_id");
			       			$bidder_name_->bindValue(':bidder_id', $bids['bidder_id']);
			       			$bidder_name_->execute();

			       			$bidder_name = $bidder_name_->fetch();

			       			$output .= '
			       			<tr>
			       				<td>'.$bidder_name['brukernavn'].'</td>
			       				<td>'.number_format($bids['bid']).' kr</td>
			       				<td>'.date('d. M Y, H:i:s', $bids['time']).'</td>
			       			</tr>
			       			';
			       		}

	                } else {
	                	$output .= '<tr><td colspan="3">Ingen bud enda</td></tr>';
	                }

		       		$output .= '</tbody>
		       	</table>';


		       	// New bid

		       	$output .= '
		       	<div class="Div_innledning" id="Div_innleding">
                	<span class="Span_str_2">Gi bud</span>
             	</div>';

             	if(isset($_POST['new_bid']))	{
             		if(isset($_POST['bid']))	{
             			if(is_numeric($_POST['bid']))	{
	             			if(intval($_POST['bid'] >= $bid_+$auction['min_interval']))	{
	             				if($userinfo['penger'] >= intval($_POST['bid']))	{
	             					// Everything looks good. Take money from this user, give back to last user.
	             					$remove_money = $db->prepare("UPDATE `brukere` SET `penger`=`penger` - :new_penger WHERE `brukerid`=:brukerid");
	             					$remove_money->bindValue(':new_penger', $_POST['bid']);
	             					$remove_money->bindValue(':brukerid', $_SESSION['id']);
	             					$remove_money->execute();

	             					if($bid_ == '0')	{

	             					} else {
		             					// give last user back money
		             					$get_last_bidder = $db->prepare("SELECT * FROM `auctions_bid` WHERE `auction_id`=:auction_id ORDER BY `id` DESC LIMIT 1");
		             					$get_last_bidder->bindValue(':auction_id', $auction['id']);
		             					$get_last_bidder->execute();
		             					$last_bidder = $get_last_bidder->fetch();

		             					$give_last_bidder_money_back = $db->prepare("UPDATE `brukere` SET `penger`=`penger` + :last_bid WHERE `brukerid`=:brukerid");
		             					$give_last_bidder_money_back->bindValue(':last_bid', $last_bidder['bid']);
		             					$give_last_bidder_money_back->bindValue(':brukerid', $last_bidder['bidder_id']);
		             					$give_last_bidder_money_back->execute();
		             				}

	             					// Add bid 
	             					$add_bid = $db->prepare("INSERT INTO `auctions_bid` (`auction_id`, `bidder_id`, `time`, `bid`) VALUES (:auction_id, :bidder_id, :time, :bid)");
	             					$add_bid->bindValue(':auction_id', $auction['id']);
	             					$add_bid->bindValue(':bidder_id', $_SESSION['id']);
	             					$add_bid->bindValue(':time', time());
	             					$add_bid->bindValue(':bid', intval($_POST['bid']));
	             					$add_bid->execute();

	             					$output .= 'Budet ditt er lagt inn.';




	             				} else {
	             					$output .= '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke by så mye.</span></div>';
	             				}
	             			} else {
	             				$output .= '<div class="Div_MELDING"><span class="Span_str_5">Du må by minstebud eller mer.</span></div>';
	             			}
	             		} else {
	             			$output .= '<div class="Div_MELDING"><span class="Span_str_5">Budet må være tall.</span></div>';
	             		}
             		}
             	}

             	$output .= '

             	<form method="POST" action="">
	             	<div class="form">
	             		<div class="left">Bud</div>
	             		<div class="right"><input type="text" name="bid" value="" placeholder="Minstebud er '.number_format($bid_ + $auction['min_interval']).' kr"></div>
	             		<div class="clear"></div>

	             		<button class="form_medium" name="new_bid">Gi bud</button>
	             	</div>
	            </form>

		       	';

     		} else {
     			$output .= '<div class="Div_MELDING"><span class="Span_str_5">Denne auksjonen er ferdig.</span></div>';
     		}

     	} else {
     		$output .= '<div class="Div_MELDING"><span class="Span_str_5">Ugyldig auksjon. Trykket du på noe for å komme hit kan du sende melding til support med hvordna.</span></div>';
     	}
     } else {
     	$output .= '<div class="Div_MELDING"><span class="Span_str_5">Det skjedde noe feil.</span></div>';
     }
}
?>
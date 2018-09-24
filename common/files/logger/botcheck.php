<?php
	if(!defined('view'))    { die('Not permission.'); }

	if($userinfo['type'] == 'A' || $userinfo['type'] == 'm')	{


		$output .= '
		<div class="Div_masta">
              <div class="Div_innledning" id="Div_innleding">
                  <span class="Span_str_2">Brukerlogg</span>
              </div>
        </div>';

        if(isset($_POST['search']))	{
        	if(isset($_POST['username']))	{
        		if(!empty($_POST['username']))	{
        			// check if username exist
        			$verify_username = $db->prepare("SELECT * FROM `brukere` WHERE `brukernavn`=:brukernavn");
        			$verify_username->bindValue(':brukernavn', $_POST['username']);
        			$verify_username->execute();

        			if($verify_username->rowCount() > 0)	{
        				$search_info = $verify_username->fetch();
        				// All good; send events
        				$event = $_POST['event_type'];
        			} else {
        				$output .= '<div class="Div_MELDING"><span class="Span_str_5">Det finnes ingen brukere med dette navnet.</span></div>';
        			}
        		} else {
        			$output .= '<div class="Div_MELDING"><span class="Span_str_5">Du må fylle ut et brukernavn.</span></div>';
        		}
        	} else {
        		$output .= '<div class="Div_MELDING"><span class="Span_str_5">Det skjedde noe feil.</span></div>';
        	}
        }

        $output .= '<form method="POST" action="">
        	<div class="Div_venstre_side_1">
                <span class="Span_str_1">Brukernavn</span>
            </div>
            <div class="Div_hoyre_side_1">
                <input class="textbox" name="username">
            </div>

            <div class="Div_venstre_side_1">
             <span class="Span_str_1">Loggtype</span>
            </div>

            <div class="Div_hoyre_side_1">
            <select class="textbox" name="event_type">
            	<option value="Alle">Alle</option>
            	';
            // Load all unique event types
            $load_unique_events = $db->prepare("SELECT DISTINCT `event` FROM `botlog`");
            $load_unique_events->execute();

            while($event_types = $load_unique_events->fetch())	{
            	$output .= '<option value="'.$event_types['event'].'">'.$event_types['event'].'</option>';
            }

            $output .= '
            </select>
             </div>

            <div class="Div_venstre_side_1">
            </div>
            <button class="form_medium" name="search">Søk etter logger</button>
        </form>';

        $output .= '
        <table>
       		<thead>
       			<tr>
       				<th>Brukernavn</th>
       				<th>Event</th>
       				<th>Kommentar</th>
       				<th>Tidspunkt</th>
                    <th>Diff</th>
       			</tr>
       		</thead>
       		<tbody>
        ';




        if(isset($event))	{
        	if($event == 'Alle')	{
        		$load_events = $db->prepare("SELECT * FROM `botlog` WHERE `user_id`=:userid ORDER BY `id` DESC");
        	} else {
        		$load_events = $db->prepare("SELECT * FROM `botlog` WHERE `user_id`=:userid AND `event`=:event ORDER BY `id` DESC");
        		$load_events->bindValue(':event', $event);
        	}
        	$load_events->bindValue(':userid', $search_info['brukerid']);

        	$load_events->execute();

        	if($load_events->rowCount() > 0)	{
        		while($get_events = $load_events->fetch())	{

              if(!isset($timestamps))  {
                $timestamps = $get_events['time'];
              }

              $plusstime = $timestamps - $get_events['time'];
	        		
              $output .= '
	        		<tr>
	       				<td><a href="?side=Bruker&navn='.$get_events['username'].'">'.$get_events['username'].'</a></td>
	       				<td>'.$get_events['event'].'</td>
	       				<td>'.$get_events['comment'].'</td>
	       				<td>'.date('d. M Y, H:i:s', $get_events['time']).'</td>
                <td>+'.$plusstime.'s</td>
	       			</tr>
	        		';


              $timestamps = $get_events['time'];
	        	}
        	} else {
        		$output .= '<div class="Div_MELDING"><span class="Span_str_5">Finner ingen events på '.$search_info['brukernavn'].'.</span></div>';
        	}

        } else {
        	// No userlogs selected, then show last 100

        	$get_last_100_events = $db->prepare("SELECT * FROM `botlog` ORDER BY `id` DESC");
        	$get_last_100_events->execute();

        	while($get_events = $get_last_100_events->fetch())	{
            if(!isset($timestamps))  {
                $timestamps = $get_events['time'];
            }
            $plusstime = $timestamps - $get_events['time'];
        		$output .= '
        		<tr>
       				<td><a href="?side=Bruker&navn='.$get_events['username'].'">'.$get_events['username'].'</a></td>
       				<td>'.$get_events['event'].'</td>
       				<td>'.$get_events['comment'].'</td>
       				<td>'.date('d. M Y, H:i:s', $get_events['time']).'</td>
              <td>+'.$plusstime.'s</td>
       			</tr>
        		';
            $timestamps = $get_events['time'];
        	}
        }

        $output .= '
        	</tbody>
        </table>
        ';

	}
  ?>
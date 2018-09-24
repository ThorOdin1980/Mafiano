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


        // See if there is anything for sale

        $check_objects_for_sale = $db->prepare("SELECT * FROM `auctions` WHERE `end_time`>:time");
        $check_objects_for_sale->bindValue(':time', time());
        $check_objects_for_sale->execute();

        if($check_objects_for_sale->rowCount() > 0) {
            // List objects for sale


            $output .= '
            <table>
                <thead>
                    <tr>
                        <th width="64">Type</th>
                        <th width="65">Lokasjon</th>
                        <th width="100">Selger</th>
                        <th width="150">Bud</th>
                        <th width="115">Avsluttes</th>
                    </tr>  
                </thead>
                <tbody>
            ';

            while($saleobject = $check_objects_for_sale->fetch())   {

                // Get seller name
                $seller_info_get = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:userid");
                $seller_info_get->bindValue(':userid', $saleobject['seller_id']);
                $seller_info_get->execute();
                $seller_info = $seller_info_get->fetch();

                // Get bid

                $get_bids = $db->prepare("SELECT * FROM `auctions_bid` WHERE `auction_id`=:auction_id ORDER BY `bid` DESC LIMIT 1");
                $get_bids->bindValue(':auction_id', $saleobject['id']);
                $get_bids->execute();

                if($get_bids->rowCount() > 0)   {
                    $bid = $get_bids->fetch();
                    $bid_ = $bid['bid'];
                } else {
                    $bid_ = '0';
                }

                $output .= '
                <tr>
                    <td>'.$saleobject['object_type'].'</td>
                    <td>'.$saleobject['object_location'].'</td>
                    <td>'.$seller_info['brukernavn'].'</td>
                    <td>'.number_format($bid_).' kr</td>
                    <td>'.date('d. M Y, H:i', $saleobject['end_time']).'</td>
                </tr>

                <tr>
                    <td colspan="5"><a href="?function=handel&file=auksjon_bud&id='.$saleobject['id'].'">Klikk her for å gi bud. Minstebud er '.number_format($saleobject['start_bid']).' kr, og minsteøkning er '.number_format($saleobject['min_interval']).' kr.</a></div>
                </tr>
                ';
            }

            $output .= '
                </tbody>
            </table>
            ';

        } else {   
            $output .= '<div class="Div_MELDING"><span class="Span_str_5">Det er ingenting til salgs akkuratt nå.</span></div>';
        }


      $output .= '
      <div class="Div_masta">
        <form method="post" id="LagSpors">
          <div class="Div_innledning" id="Div_innleding">
              <span class="Span_str_2">Legg ut auksjon</span>
          </div>
        </form>
      </div>
      ';

      // Verify if user is owner of any stores

      $possible_auction_objects = array();

      // Check for bullet factories

      $bulletfactory_owner_check = $db->prepare("SELECT * FROM `Kulefabrikker` WHERE `KF_Eier`=:username");
      $bulletfactory_owner_check->bindValue(':username', $userinfo['brukernavn']);
      $bulletfactory_owner_check->execute();

      if($bulletfactory_owner_check->rowCount() > 0)  {
        while($list_bulletfactory = $bulletfactory_owner_check->fetch())  {

            // Check if object is already for sale

            $for_sale_check = $db->prepare("SELECT * FROM `auctions` WHERE `object_id`=:object_id AND `object_type`='Kulefabrikk");
            $for_sale_check->bindValue(':object_id', $list_bulletfactory['id']);
            $for_sale_check->execute();

            if($for_sale_check->rowCount() > 0) {
            } else {
              $possible_auction_objects[] = array(
                                                    "object_id" => $list_bulletfactory['id'],
                                                    "object_type" => "Kulefabrikk",
                                                    "object_location" => $list_bulletfactory['KF_Sted']
                                                    ); 
            }
            $bulletfactory = TRUE;
        }
      } else {
        $bulletfactory = FALSE;
      }

      $stores_owner_check = $db->prepare("SELECT * FROM `Butikker` WHERE `Butikk_eier`=:username");
      $stores_owner_check->bindValue(':username', $userinfo['brukernavn']);
      $stores_owner_check->execute();

      if($stores_owner_check->rowCount() > 0) {
        while($list_stores = $stores_owner_check->fetch())  {

            // Check if object is already for sale

            $for_sale_check_stores = $db->prepare("SELECT * FROM `auctions` WHERE `object_id`=:object_id AND `object_type`=:object_type");
            $for_sale_check_stores->bindValue(':object_id', $list_stores['id']);
            $for_sale_check_stores->bindValue(':object_type', $list_stores['Butikk_Type']);
            $for_sale_check_stores->execute();

            if($for_sale_check_stores->rowCount() > 0) {
            } else {
              $possible_auction_objects[] = array(
                                                "object_id" => $list_stores['id'],
                                                "object_type" => $list_stores['Butikk_Type'],
                                                "object_location" => $list_stores['Butikk_Land']);
            }
            $stores = TRUE;
        }
      } else {
        $stores = FALSE;
      }

      if($stores == TRUE || $bulletfactory == TRUE) {
        // User has something to put on auction

        if(isset($_POST['auction_away']))   {
            if(isset($_POST['start_price']) && isset($_POST['min_interval']) && isset($_POST['end_time']) && isset($_POST['auction_object']))     {
                if(!empty($_POST['start_price']) && !empty($_POST['min_interval']) && !empty($_POST['end_time']))   {

                    if(isset($_POST['auction_object'])) {
                        $auction_object = explode('_', $_POST['auction_object']);
                        $object_id = $auction_object["0"];
                        $object_type = $auction_object["1"];
                        
                        // Verify that user owns object and not already for sale
                        if($object_type == 'Kulefabrikk' || $object_type == 'Fly' || $object_type == 'Båter' || $object_type == 'Beskyttelse' || $object_type == 'Våpen')   {
                            if($object_type == 'Kulefabrikk')   {
                                $verify_owner = $db->prepare("SELECT * FROM `Kulefabrikker` WHERE `KF_Eier`=:username AND `id`=:id");
                            } elseif($object_type == 'Fly' || $object_type == 'Båter' || $object_type == 'Beskyttelse' || $object_type == 'Våpen')  {
                                $verify_owner = $db->prepare("SELECT * FROM `Butikker` WHERE `Butikk_eier`=:username AND `id`=:id");
                            }

                            $verify_owner->bindValue(':username', $userinfo['brukernavn']);
                            $verify_owner->bindValue(':id', $object_id);
                            $verify_owner->execute();

                            if($verify_owner->rowCount() > 0)   {
                                // now check if is for sale

                                $verify_not_for_sale = $db->prepare("SELECT * FROM `auctions` WHERE `object_id`=:object_id AND `object_type`=:object_type AND `end_time`>:time");
                                $verify_not_for_sale->bindValue(':object_id', $object_id);
                                $verify_not_for_sale->bindValue(':object_type', $object_type);
                                $verify_not_for_sale->bindValue(':time', time());

                                $verify_not_for_sale->execute();

                                if($verify_not_for_sale->rowCount() > 0)    {
                                    $output .= '<div class="Div_MELDING"><span class="Span_str_5">Den ligger allerede ute til auksjon. </span></div>';
                                } else {
                                    // Everything good to go!

                                    // Verify all inputs is valid

                                    if(is_numeric($_POST['start_price']) && is_numeric($_POST['min_interval']))   {

                                        // verify date input

                                        if(strtotime($_POST['end_time']) > time()+12*60*60 || strtotime($_POST['end_time']) == FALSE)  {
                                            $timestamp_end_time = strtotime($_POST['end_time']);

                                            // get object info

                                            $object_info = $verify_owner->fetch();

                                            if($object_type == 'Kulefabrikk')   {
                                                $object_location = $object_info['KF_Sted'];
                                            } else {
                                                $object_location = $object_info['Butikk_Land'];
                                            }


                                            $output .= '
                                            <div class="Div_MELDING"><span class="Span_str_6">
                                            Du har lagt ut auksjon med minstebud på '.number_format($_POST['start_price']).' kr, med minste budøkning på '.number_format($_POST['min_interval']).' kr, som er ferdig '.date('d. M Y, H:i', $timestamp_end_time).'.
                                            </div>
                                            ';



                                            $insert_object = $db->prepare("INSERT INTO `auctions` 
                                                (`object_id`, `object_type`, `object_location`, `seller_id`, `start_bid`, `min_interval`, `end_time`) VALUES
                                                (:object_id, :object_type, :object_location, :seller_id, :start_bid, :min_interval, :end_time)");

                                            $insert_object->bindValue(':object_id', $object_id);
                                            $insert_object->bindValue(':object_type', $object_type);
                                            $insert_object->bindValue(':object_location', $object_location);
                                            $insert_object->bindValue(':seller_id', $userinfo['brukerid']);
                                            $insert_object->bindValue(':start_bid', intval($_POST['start_price']));
                                            $insert_object->bindValue(':min_interval', intval($_POST['min_interval']));
                                            $insert_object->bindValue(':end_time', $timestamp_end_time);
                                            $insert_object->execute();


                                        } else {
                                            $output .= '<div class="Div_MELDING"><span class="Span_str_5">Sluttid må være minst 12 timer frem i tid.</span></div>';
                                        }
                                    } else {
                                        $output .= '<div class="Div_MELDING"><span class="Span_str_5">Minstebud og minste økningsinterval må være tall.</span></div>';
                                    }

                                }
                            } else {
                                $output .= '<div class="Div_MELDING"><span class="Span_str_5">Du er ikke eier av objektet som du prøver å auksjonere bort.</span></div>';
                            }
                        } else {
                            $output .= '<div class="Div_MELDING"><span class="Span_str_5">Det skjedde noe feil.</span></div>';
                        }
                    } else {
                        $output .= '<div class="Div_MELDING"><span class="Span_str_5">Det skjedde noe feil.</span></div>';
                    }
                } else {
                    $output .= '<div class="Div_MELDING"><span class="Span_str_5">Du må fylle ut alle felter.</span></div>';
                }
            } else {
                $output .= '<div class="Div_MELDING"><span class="Span_str_5">Det skjedde noe feil.</span></div>';
            }
        }
          
        $output .= '
        <form method="POST" action="">
            <div class="Div_venstre_side_1">
             <span class="Span_str_1">Auksjonsobjekt</span>
            </div>

            <div class="Div_hoyre_side_1">
            <select class="textbox" name="auction_object">';
              foreach($possible_auction_objects as $auction_object)  {
                // Check if object is for sale
                $verify_for_sale = $db->prepare("SELECT * FROM `auctions` WHERE `object_id`=:object_id AND `object_type`=:object_type AND `end_time`>:time");
                $verify_for_sale->bindValue(':object_id', $auction_object['object_id']);
                $verify_for_sale->bindValue(':object_type', $auction_object['object_type']);
                $verify_for_sale->bindValue(':time', time());
                $verify_for_sale->execute();

                if($verify_for_sale->rowCount() < 1)    {

                    $output .= '<option value="'.$auction_object['object_id'].'_'.$auction_object['object_type'].'">'.$auction_object['object_type'].' i '.$auction_object['object_location'].'</option>
                    ';
                }
              }
            $output .= '
            </select>
             </div>


            <div class="Div_venstre_side_1">
                <span class="Span_str_1">Startpris</span>
            </div>
            <div class="Div_hoyre_side_1">
                <input class="textbox" name="start_price" placeholder="Skriv kun tall.">
            </div>



            <div class="Div_venstre_side_1">
                <span class="Span_str_1">Minstebudøkning</span>
            </div>
            <div class="Div_hoyre_side_1">
                <input class="textbox" name="min_interval" placeholder="Skriv kun tall.">
            </div>



            <div class="Div_venstre_side_1">
                <span class="Span_str_1">Dato ferdig</span>
            </div>
            <div class="Div_hoyre_side_1">
                <input class="textbox" name="end_time" placeholder="Skriv dato i følgende format: DD/MM/YYYY HH:MM - '.date('d.m.Y H:i', strtotime("+2 days")).'. ">
            </div>


            <div class="Div_venstre_side_1">
            </div>
            <button class="form_medium" name="auction_away">Legg ut</button>
        </form>

        ';
      }
  }
  ?>
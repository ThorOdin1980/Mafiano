<?php
if(!defined('view') || !isset($_SESSION['id'])) { $output .= $noaccess; } else {

		$output .= '
		<div class="content">
			<div class="heading">Finn spiller</div>
			<div class="image"><img width="488" src="/Bilder/FinnSpiller.jpg"></div>
				<form method="POST" action"">
					<div class="form">
						<div class="left">Brukernavn</div>
						<div class="right"><input type="text" name="username" placeholder="Skriv inn navn, eller deler av navn på brukeren du vil finne her" value="';
						if(isset($_POST['search']))	{
							$output .= $_POST['username'];
						}
						$output .= '"></div>
						<div class="clear"></div>

						<button name="search">Søk</button>
						<div class="clear"></div>
					</div>
				</form>';


		if(isset($_POST['search']))	{
			if(!isset($_POST['username']) || strlen($_POST['username']) < '3')	{
				$output .= '<div class="text">Du må bruke minst 3 tegn når du søker.</div>';
			} else {

				// Search for users using what was written in the search field

				$search_query = $db->prepare("SELECT * FROM `brukere` WHERE `brukernavn` LIKE CONCAT('%',:username,'%') LIMIT 25");
				$search_query->bindValue(':username', $_POST['username']);
				$search_query->execute();

				if($search_query->rowCount() <= '0')	{
					$output .= '<div class="text">Ingen brukere med det du søkte etter som en del av brukernavnet.</div>';
				} else {
					$output .= '
					<table>
						<thead>
							<tr>
								<th width="128">Brukernavn</th>
								<th width="120">Status</th>
								<th width="120">Rank</th>
								<th width="120">Sist aktiv</th>
							</tr>
						</thead>
						<tbody>
					
					';
					foreach($search_query as $row)	{

						$life_status = ($row['liv'] >= '1' OR $row['liv'] < '0') ? '<span style="color:green;">Lever</span>' : '<span style="color:red;">Død</span>';
						$user_active = ((time() - $row['last_active']) > (15*60)) ? '<span style="color:red;">avlogget</span>' : '<span style="color:green;">Pålogget</span>';

						$output .= '
						<tr>
							<td><a href="?side=Bruker&navn='.$row['brukernavn'].'">'.$row['brukernavn'].'</a></th>
							<td>'.$life_status.' og '.$user_active.'</th>
							<td>'.$row['rank'].'</th>
							<td>'.date('j M, Y, H:i', $row['last_active']).'</th>
						</tr>';
					}
					$output .= '</tbody></table>';
				}

				
			}
		}

		$output .= '
		</div>';

} // Defined view
?>
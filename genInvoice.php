<?php
include('wordsPrice.php');
include('database/selectClass.php');
$selectRecord = new records;
$array = $_POST['item'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Faktura</title>
	<link rel="stylesheet" href="https://stackpath.bootsthapcdn.com/bootsthap/4.2.1/css/bootsthap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>
	<body>
		<div class="invoice">
      		<div class="fvheader">
        		
        		<div class="seller">
					<h4>SPRZEDAWCA:</h4>
					<?php
						$table = 'seller';
						$name = $_POST['seller'];
						$selectRecord->viewClientInfo($table, $name);
					?>
        		</div>

        		<div class="buyer">
					<h4>NABYWCA:</h4>
          			<?php
		  				$table = 'buyer';
						$name = $_POST['buyer'];
						$selectRecord->viewClientInfo($table, $name);
		  			?>
        		</div>
        		
        		<div class="fvdate">
          			<h5>Białystok, dnia: <?= $_POST['date1'] ?></h5>
          			<h4>FAKTURA VAT</h4>
          			<p style="color: red; font-weight: bold; font-size:14px;">ORYGINAŁ</p>
          			<p>
		  			<?php
		  				$selectRecord->fvNumber();
		  			?>
		  			</p>
          			<p>Data sprzedaży: <?=$_POST['date2']?></p>
        		</div>

      		</div>

			<div class="fvbody">
				<table class="fvtable">
					<thead>
						<tr>
							<th>LP.</th>
							<th>Nazwa</th>
							<th>PKWiU</th>
							<th>Ilość</th>
							<th>j.m</th>
							<th>Cena jednostkowa netto</th>
							<th>VAT[%]</th>
							<th>Wartość netto</th>
							<th>Kwota VAT </th>
							<th>Wartość brutto</th>
						</tr>
					</thead>
					<tbody>
	            	<?php
				  		$sumGross = 0;
				 		 $sumNet = 0;
				  		$sumVat = 0;
				  		$pay = $_POST['payment'];

	             		for($i = 0; $i < count($array); $i++) {
							if($_POST['vat'][$i] == 'ZW' || $_POST['vat'][$i] == 'NP') {

								$price = $_POST['price'][$i];
		                		$vat = ($_POST['vat'][$i]);
		                		$quant = $_POST['quantity'][$i];
		               		 	$priceGross = round(($price * $quant),2);
								$sumGross += $priceGross;
								$sumNet += $price*$quant;

		                		echo '<tr>
		                  				<td>'.($i + 1).'.</td>
		                				<td>'.$_POST['item'][$i].'</td>
		                  				<td></td>
		                  				<td>'.$quant.'</td>
		                  				<td>szt.</td>
		                  				<td>'.$price.' zł</td>
		                  				<td>'.$vat.'</td>
		                  				<td>'.$price*$quant.' zł</td>
		                  				<td>'.$vat.'</td>
		                  				<td>'.$priceGross.' zł</td>
		               				 </tr>';
		            		} else {

								$price = $_POST['price'][$i];
		                		$vat = ($_POST['vat'][$i]/100);
		                		$quant = $_POST['quantity'][$i];
		                		$vatNet = round(($price * $vat) * $quant,2);
		                		$priceGross = round(($price * $quant) + $vatNet,2);
								$sumGross += $priceGross;
								$sumNet += $price*$quant;
								$sumVat += $vatNet;

		                		echo '<tr>
		                  				<td>'.($i + 1).'.</td>
		                  				<td>'.$_POST['item'][$i].'</td>
		                  				<td></td>
		                  				<td>'.$quant.'</td>
		                  				<td>szt.</td>
		                  				<td>'.$price.' zł</td>
		                  				<td>'.($vat*100).'</td>
		                  				<td>'.$price*$quant.'zł</td>
		                  				<td>'.$vatNet.' zł</td>
		                  				<td>'.$priceGross.' zł</td>
		                			</tr>';
							}
				  		}
						echo '<tr>
								<td colspan="6"></td>
								<th style="border-top: 2px solid black;">Razem:</th>
								<td style="border-top: 2px solid black;">'.$sumNet.' zł</td>
								<td style="border-top: 2px solid black;">'.$sumVat.' zł</td>
								<td style="border-top: 2px solid black;">'.$sumGross.' zł</td>
							</tr>';
	            	?>
					</tbody>
				</table>

				<?= 'Do zapłaty: '.$sumGross.' zł<br/>';?>
				<?= kwotaslownie($sumGross).'<br/>';?>
				<?= 'Sposób zapłaty: '.$pay;?>
				<?php
					if($pay == "Przelew 7 dni") {
						
						echo '<b>(na dzień '.date("Y-m-d", strtotime($_POST['date1'].'+ 7days')).')<br/></b>
						Numer konta: 11 1111 1111 1111 1111 1111 bank <br/>';
					} elseif($pay == "Przelew 14 dni") {
							
						echo '<b>(na dzień '.date("Y-m-d", strtotime($_POST['date1'].'+ 14days')).')<br/></b>
						Numer konta: 11 1111 1111 1111 1111 1111 bank <br/>';
					} else {

						echo '<b>(Opłacone)<br/></b>';
					}
				?>
			</div>

			<div class="displayPerson">
				<p>Osoba upoważniona do wystawiania faktur</p>
			</div>
			<div class="receivingPerson">
				<p>Osoba upoważniona do odbierania faktur</p>
			</div>
		</div>
  </body>
</html>
<?php
$selectRecord->insertData(count($array));
 session_destroy();
 ?>

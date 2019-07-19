<?php
include('wordsPrice.php');
include('database/selectClass.php');
$selectRecord = new records;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Faktura</title>
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<script type="text/javascript" src="addInput.js"></script>
</head>
<body>

<div class="invoice">
	<form action="<?='edit.php?id='.$editInv[0]['ID']?>" method="post">
      	<div class="fvheader">
        	<div class="seller">
				<h4>SPRZEDAWCA:</h4>
				<?php
	            $table = 'seller';
	            $name = $editInv[0]['SELLER_NAME'];
	            $selectRecord->viewClientInfo($table, $name);
	          	?>
	        </div>
	        <div class="buyer">
				<h4>NABYWCA:</h4>
	          	<?php
				$table = 'buyer';
				$name = $editInv[0]['BUYER_NAME'];
				$selectRecord->viewClientInfo($table, $name);
				?>
	        </div>
	        <div class="fvdate">
	          	<h5>Białystok, dnia: <?='<input type="date" name="date1" value="'.$editInv[0]['DATE'].'" />';?></h5>
	          	<h4>FAKTURA VAT</h4>
	          	<p><?=$editInv[0]['NUMBER'];?></p>
	          	<p>Data sprzedaży:<?='<input type="date" name="date2" value="'.$editInv[0]['SELLDATE'].'" />';?></p>
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
					$pay = $editInv[0]['PAYMENT'];

              		for($i = 1; $i <= $editInv[0]['LOOPS']; $i++) {
						if($editInv[($i-1)]['VAT'] == 'ZW' || $editInv[($i-1)]['VAT'] == 'NP') {
									
							$price = $editInv[($i-1)]['PRICE'];
	                		$vat = ($editInv[($i-1)]['VAT']);
	                		$quant = $editInv[($i-1)]['QUANTITY'];
	                		$priceGross = round(($price * $quant),2);
							$sumGross += $priceGross;
							$sumNet += $price*$quant;

	                		echo '<tr>
	                  				<td>'.$i.'.</td>
                    				<td><input type="text" name="item'.$i.'" value="'.$editInv[($i-1)]['NAME'].'"/></td>
								    <td><input type="text" name="PKWiU'.$i.'" value=""/></td>
								    <td><input type="text" name="quant'.$i.'" value="'.$quant.'" /></td>
								    <td>szt.</td>
								    <td><input type="text" name="price'.$i.'" value="'.$price.' zł" /> </td>
								    <td><input type="text" name="vat'.$i.'" value="'.($vat).'" /></td>
								    <td>'.$price*$quant.' zł</td>
								    <td>'.$vat.'</td>
								    <td>'.$priceGross.' zł</td>
									<input type="hidden" name="loops" value = "'.$editInv[0]['LOOPS'].'" />
									<input type="hidden" name="itemname'.$i.'" value="'.$editInv[($i-1)]['NAME'].'" />
	                			</tr><hr>';
	              		} else {
										
								$price = $editInv[($i-1)]['PRICE'];
						        $vat = ($editInv[($i-1)]['VAT']/100);
						        $quant = $editInv[($i-1)]['QUANTITY'];
						        $vatNet = round(($price * $vat) * $quant,2);
						        $priceGross = round(($price * $quant) + $vatNet,2);
								$sumGross += $priceGross;
								$sumNet += $price*$quant;
								$sumVat += $vatNet;

	                			echo '<tr>
								        <td>'.$i.'</td>
								        <td><input type="text" name="item'.$i.'" value="'.$editInv[($i-1)]['NAME'].'"/></td>
								        <td><input type="text" name="PKWiU'.$i.'" value=""/></td>
								        <td><input type="text" name="quant'.$i.'" value="'.$quant.'" /></td>
								        <td>szt.</td>
								        <td><input type="text" name="price'.$i.'" value="'.$price.' zł" /> </td>
								        <td><input type="text" name="vat'.$i.'" value="'.($vat*100).'" /></td>
								        <td>'.$price*$quant.'zł</td>
								        <td>'.$vatNet.' zł</td>
								        <td>'.$priceGross.' zł</td>
										<input type="hidden" name="loops" value = "'.$editInv[0]['LOOPS'].'" />
										<input type="hidden" name="itemname'.$i.'" value="'.$editInv[($i-1)]['NAME'].'" />
									 </tr>'; 
						}
              		}
              		echo '<tr id="nextInput"><td></td></tr>';
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
			<input type="button" name="inputAdd" value=" " class="buttonaddw" onclick="add2()" />
			<input type="button" name="inputDelete" value=" " class="buttondelw" onclick="del2()" />
			<br>
			<?= 'Do zapłaty: '.$sumGross.' zł<br/>';?>
			<?= kwotaslownie($sumGross).'<br/>';?>
			<?= 'Sposób zapłaty: '.$pay;?>
			<?php
			if($pay == "Przelew 7 dni") {
            	if($editInv[0]['PAID'] == 1) {

              		echo '<b>(na dzień '.date("Y-m-d", strtotime($editInv[0]['DATE'].'+ 7days')).') - OPŁACONA<br/></b>
						  	Numer konta: 11 1111 1111 1111 1111 1111 bank <br/>';
            	} else {

				    echo '<b>(na dzień '.date("Y-m-d", strtotime($editInv[0]['DATE'].'+ 7days')).')<br/></b>
				            Numer konta: 11 1111 1111 1111 1111 1111 bank <br/>';
            	}
			} elseif($pay == "Przelew 14 dni") {
            	if($editInv[0]['PAID'] == 1) {

              		echo '<b>(na dzień '.date("Y-m-d", strtotime($editInv[0]['DATE'].'+ 14days')).') - OPŁACONA<br/></b>
  							Numer konta: 11 1111 1111 1111 1111 1111 bank <br/>';
            	} else {
              
				    echo '<b>(na dzień '.date("Y-m-d", strtotime($editInv[0]['DATE'].'+ 14days')).')<br/></b>
				             Numer konta: 11 1111 1111 1111 1111 1111 bank <br/>';
            	}
			} else {
				
				echo '<b>(Opłacone)<br/></b>';
			}
			?>
		</div>
		<footer>
			<?= '<div class="displayPerson">
					<p>Osoba upoważniona do wystawiania faktur</p>
				</div>
				<div class="receivingPerson">
					<p>Osoba upoważniona do odbierania faktur</p>
				</div>';
			?>
        	<div class="footButton">
          		<a href="listInvoiceView.php">Powrót</a>
				<input type="submit" name="" value="Zapisz" />
        	</div>
        </footer>
	</form>
</div>

</body>
</html>

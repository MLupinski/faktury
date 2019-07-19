<?php
session_start();
if(!isset($_SESSION['newRow']))
{
	$_SESSION['newRow'] = 0;
}
include('database/selectClass.php');
$selectRecord = new records;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Faktura</title>
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<script type="text/javascript" src="addInput.js"></script>
</head>
	<body>
		<div class="fvInfo">

			<form action="viewInvoice.php" method="post">
      		<label>Data wystawienia <label2>Data sprzedaży</label2></label>
        	<input type="date" value="<?= date("Y-m-d") ?>" name="date1"/>
        	<input type="date" value="<?= date("Y-m-d") ?>" name="date2"/>
					<label>Sprzedawca <label3>Nabywca</label3></label>
	    	<select name="seller">
	    	<?php
					$table = 'seller';
					$selectRecord->selectClient($table);
				?>
	    	</select>
				<select name="buyer">
				<?php
					$table = 'buyer';
					$selectRecord->selectClient($table);
			 	?>
		 		</select>
      	<label>Metoda płatności</label>
      	<select name="payment">
        	<option>Przelew 7 dni</option>
        	<option>Przelew 14 dni</option>
        	<option>Gotówka</option>
      	</select>
      	<br>
			<div id="FV"></div>
				<input type="button" name="inputAdd" value=" " class="buttonadd" onclick="add()" />
				<input type="button" name="inputDelete" value=" " class="buttondel" onclick="del()" />
				<br>
				<input type="submit" name="view" value="Utwórz i zobacz fakturę" class="submitbutton"/>
				<a href="index.php" class="submitbutton">Powrót</a>
			</form>
		</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

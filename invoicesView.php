<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Faktura</title>
	<link rel="stylesheet" href="css/invoice.css" type="text/css" />
	<script type="text/javascript" src="addInput.js"></script>
</head>
<body>

	<?php foreach ($editInv as $row) { ?>
		
		<div id="invoice">
			<h1>NABYWCA: <br/> <?= $row['SELLER_NAME']?></h1>
		</div>
	<?php } ?>
	
</body>
</html>
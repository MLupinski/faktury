<?php

if(isset($_POST['item'][0])) {

	include('genInvoice.php');

} else {
	
	header('Location: createInv.php');

}




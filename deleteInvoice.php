<?php
require("database/invoiceActionsClass.php");

$deleteAction = new InvoiceActions();
$deleteAction->invoiceDelete();
 ?>

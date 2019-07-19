<?php
include("database/invoiceActionsClass.php");

$editInv = new InvoiceActions;
$editInv = $editInv->invoiceShow();
include("invoiceShowView.php");

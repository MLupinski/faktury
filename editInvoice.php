<?php
include("database/invoiceActionsClass.php");

$editInv = new InvoiceActions;
$editInv = $editInv->invoiceEditShow();
include("editInvoiceView.php");

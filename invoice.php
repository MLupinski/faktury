<?php
include_once("database/invoiceActionsClass.php");

$editInv = new InvoiceActions;
$editInv = $editInv->showList();

include("invoicesView.php");
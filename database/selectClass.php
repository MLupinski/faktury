<?php

class records
{

  public function fvNumber()
  {
    include("connect.php");
    $selQuery = "SELECT * FROM invoice_nr";
    $stmt = $dbh->prepare($selQuery);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row)
    {
      echo 'FV/'.$row['NUMBER'].'/'.$row['MONTH'].'/'.$row['YEAR'];
      $number = $row['NUMBER'];
      $id = $row['ID'];
    }

    $nowMonth = date('m');
    $nowYear = date('Y');
    $number += 1;

    $query = "UPDATE invoice_nr SET NUMBER = $number, MONTH = $nowMonth, YEAR = $nowYear WHERE ID = $id";
    $stmd = $dbh->prepare($query);
    $stmd->execute();

    $insquery = "INSERT INTO invoice (NUMBER, SELLDATE, DATE, BUYER_NAME, SELLER_NAME, LOOPS) VALUES (?, ?, ?, ?, ?, ?)";
    $stdm = $dbh->prepare($insquery);
    $stdm->execute(['FV/'.$row['NUMBER'].'/'.$row['MONTH'].'/'.$row['YEAR'],$_POST['date1'], $_POST['date2'], $_POST['buyer'], $_POST['seller'], count($_POST['item'])]);
  }

  public function selectClient($table)
  {
    $tab = $table;
    include("connect.php");

    $selQuery = "SELECT * FROM $tab";
    $stmt = $dbh->prepare($selQuery);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row)
    {
      echo '<option>'.$row['NAME'].'</option>';
    }
  }

  public function viewClientInfo($table, $name)
  {
    $tab = $table;
    $clientName = $name;
    include("connect.php");

    $selQuery = "SELECT * FROM $tab WHERE NAME = '$name'";
    $stmt = $dbh->prepare($selQuery);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row)
    {
      echo '
           <p>'.$row['NAME'].'</p>
           <p>'.$row['ADDRESS'].'</p>
           <p>'.$row['PHONE'].'</p>
           <p>'.$row['EMAIL'].'</p>
           <p>'.$row['WEB'].'</p>
           <p>NIP: '.$row['NIP'].'</p>';
    }
  }

  public function insertData($loops)
  {
    include('connect.php');
    $selQuery = "SELECT * FROM invoice_nr";
    $stmt = $dbh->prepare($selQuery);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row)
    {
      $number = $row['NUMBER'];
      $month = $row['MONTH'];
      $year = $row['YEAR'];
    }

    $fvNumber = 'FV/'.($number-1).'/'.$month.'/'.$year;
    $selQuery2 = "SELECT * FROM invoice WHERE NUMBER = '$fvNumber'";
    $stmt2 = $dbh->prepare($selQuery2);
    $stmt2->execute();
    $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results2 as $row2)
    {
      $id = $row2['ID'];
    }

    for($i = 0; $i < $loops; $i++)
    {
      $insQuery = "INSERT INTO invoice_data (INVOICE_ID, NAME, VAT, PRICE, QUANTITY, PAYMENT) VALUES (?, ?, ?, ?, ?, ?)";
      $stdm = $dbh->prepare($insQuery);
      $stdm->execute([$id, $_POST['item'][$i], $_POST['vat'][$i], $_POST['price'][$i], $_POST['quantity'][$i], $_POST['payment']]);
    }
  }
}

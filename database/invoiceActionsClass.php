<?php

class InvoiceActions
{

  public function invoiceDelete()
  {
    require("database/connect.php");
    $id = $_GET['id'];

    $delDateQuery = 'DELETE FROM invoice_data WHERE INVOICE_ID = :id';
    $stmd = $dbh->prepare($delDateQuery);
    $stmd->bindValue(':id', $id);
    $stmd->execute();

    $delQuery = 'DELETE FROM invoice WHERE ID = :id';
    $stmt = $dbh->prepare($delQuery);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header("Location: listInvoiceView.php");
  }

  public function invoicePaid()
  {
    require("database/connect.php");
    $id = $_GET['id'];

    $updateQuery = 'UPDATE invoice SET PAID = 1 WHERE ID = :id';
    $stmu = $dbh->prepare($updateQuery);
    $stmu->bindValue(':id', $id);
    $stmu->execute();

    header("Location: listInvoiceView.php");
  }

  public function invoiceEditShow()
  {
    require("database/connect.php");
    $id = $_GET['id'];

    $editShowQuery = 'SELECT * FROM invoice AS i INNER JOIN invoice_data AS id ON i.ID = id.INVOICE_ID WHERE i.ID = :id';
    $stme = $dbh->prepare($editShowQuery);
    $stme->bindValue(':id', $id);
    $stme->execute();

    $results = $stme->fetchAll(PDO::FETCH_ASSOC);

    return $results;
  }

  public function invoiceShow()
  {
    require("database/connect.php");
    $id = $_GET['id'];

    $editShowQuery = 'SELECT * FROM invoice AS i INNER JOIN invoice_data AS id ON i.ID = id.INVOICE_ID WHERE i.ID = :id';
    $stme = $dbh->prepare($editShowQuery);
    $stme->bindValue(':id', $id);
    $stme->execute();

    $results = $stme->fetchAll(PDO::FETCH_ASSOC);

    return $results;
  }

  public function invoiceEdit()
  {
    echo '<pre>'; print_r($_POST);

    require("database/connect.php");
    $id = $_GET['id'];
    $loops = $_POST['loops'];
    $query = 'editQuery';
    $st = 'stme';

    for($i = 1; $i <= $loops; $i++)
    {
      $editQuery = $query.$i;
      $stme = $st.$i;

      echo $editQuery."\n";

      $editQuery = 'UPDATE invoice_data
      SET NAME = :item, VAT = :vat, PRICE = :price, QUANTITY = :quant
      WHERE ID = :id AND NAME = :itemname';
      $stme = $dbh->prepare($editQuery);
      $stme->bindValue(':item', $_POST["item$i"], PDO::PARAM_STR);
      $stme->bindValue(':vat', $_POST["vat$i"], PDO::PARAM_INT);
      $stme->bindValue(':price', $_POST["price$i"], PDO::PARAM_STR);
      $stme->bindValue(':quant', $_POST["quant$i"], PDO::PARAM_INT);
      $stme->bindValue(':id', $id, PDO::PARAM_INT);
      $stme->bindValue(':itemname', $_POST["itemname$i"], PDO::PARAM_STR);
      $stme->execute();

      echo $editQuery."\n";
      echo $_POST["item$i"]."\n";
      echo $_POST["vat$i"]."\n";
      echo $_POST["price$i"]."\n";
      echo $_POST["quant$i"]."\n";
      echo $id."\n";
      echo $_POST["itemname$i"]."\n";
    }
  }

public function showList()
{
  include('database/connect.php');
  $selQuery = "SELECT * FROM invoice";
  $stmt = $dbh->prepare($selQuery);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $results;
 /*foreach ($results as $row)
  {
    if($row['PAID'] == 0)
    {
      echo '<table class="fvtable">
          <thead>
            <tr>
              <th>LP.</th>
              <th>Numer faktury</th>
              <th>Data sprzedaży</th>
              <th>Data wystawienia</th>
              <th>Opcje</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>'.($i+1).'</td>
              <td><a href="invoiceShow.php?id='.$row['ID'].'" style="color:green;">'.$row['NUMBER'].'</a></td>
              <td>'.$row['SELLDATE'].'</td>
              <td>'.$row['DATE'].'</td>
              <td><a href="editInvoice.php?id='.$row['ID'].'"  class="actionButton">Edytuj</a>
                  <a href="deleteInvoice.php?id='.$row['ID'].'"  class="actionButton">Usuń</a>
                  <a href="generatePDF.php?id='.$row['ID'].'"  class="actionButton">PDF</a>
              </td>
              <td>
                  <a href="paidInvoice.php?id='.$row['ID'].'" class="button">Oznacz jako zapłacona</a>
              </td>
            </tr>
          </tbody>
        </table>';
        $i++;
    }
    else
    {
      echo '<table class="fvtable">
          <thead>
            <tr>
              <th>LP.</th>
              <th>Numer faktury</th>
              <th>Data sprzedaży</th>
              <th>Data wystawienia</th>
              <th>Opcje</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>'.($i+1).'</td>
              <td><a href="invoiceShow.php?id='.$row['ID'].'" style="color:green;">'.$row['NUMBER'].'</a></td>
              <td>'.$row['SELLDATE'].'</td>
              <td>'.$row['DATE'].'</td>
              <td><a href="editInvoice.php?id='.$row['ID'].'"  class="actionButton">Edytuj</a>
                  <a href="deleteInvoice.php?id='.$row['ID'].'"  class="actionButton">Usuń</a>
                  <a href="generatePDF.php?id='.$row['ID'].'"  class="actionButton">PDF</a>
              </td>
              <td>
                  <button type="button" disabled>Faktura Opłacona</button>
              </td>
            </tr>
          </tbody>
        </table>';
        $i++;
    }
  }*/
}

}

 ?>

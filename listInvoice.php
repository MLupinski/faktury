<?php

function showlist()
{
  include('database/connect.php');
  $selQuery = "SELECT * FROM invoice";
  $stmt = $dbh->prepare($selQuery);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;

  foreach ($results as $row)
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
  }
}
?>

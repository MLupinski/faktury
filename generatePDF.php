<?php
$id = $_GET['id'];
require 'vendor\autoload.php';
use mikehaertl\wkhtmlto\Pdf;

$pdf = new Pdf([
                  'commandOptions' => [
                  'useExec' => true,
                  'escapeArgs' => false,
                  'procOptions' => array(
                  // This will bypass the cmd.exe which seems to be recommended on Windows
                  'bypass_shell' => true,
                 // Also worth a try if you get unexplainable errors
                  'suppress_errors' => true,
               ),
               ],
               ]);
               $globalOptions = array(
               'no-outline', // Make Chrome not complain
              // Default page options
               'page-size' => 'A4'
                );

               $pdf->setOptions($globalOptions);
               $pdf->addPage('http://localhost/faktury/invoiceShow.php?id='.$id);
               $pdf->binary = "C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe";
               $pdf->saveAs('FV');
               if (!$pdf->send()) {
            throw new Exception('Could not create PDF: '.$pdf->getError());
          }

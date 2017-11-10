<?php

require '/vendor/autoload.php';
use mikehaertl\wkhtmlto\Pdf;
/*
if(isset($_GET['id']))
{
    $userID = $_SESSION['id'];
}
else
{
    $userID = 0;
}
*/

// Create a new Pdf object with some global PDF options
$pdf = new Pdf(array(
    'binary' => 'D://wkhtmltopdf//bin//wkhtmltopdf',
    'ignoreWarnings' => true,
    'commandOptions' => array(
        'useExec' => true,      // Can help if generation fails without a useful error message
        'procEnv' => array(
            // Check the output of 'locale' on your system to find supported languages
            'LANG' => 'en_US.utf-8',
        ),
    ),
));

// Add a page. To override above page defaults, you could add
// another $options array as second argument.
$pdf->addPage('http://localhost:8001/branch/receipt.php?id=162&action=view');

if(!$pdf->send())
echo $pdf->getError();

?>
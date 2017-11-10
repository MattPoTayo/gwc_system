<?php
ob_start();
session_start();
require_once("verify_access.php");
require_once("../vendor/autoload.php");
require_once("../resource/database/hive.php");
use mikehaertl\wkhtmlto\Pdf;

if(isset($_GET['id']))
    {
        $creation = $_GET['id'];
        $check = mysqli_query($mysqli, "SELECT * FROM `sales_head` WHERE `ID` = '$creation' AND `Mark` >= 0");
        if($check AND mysqli_num_rows($check) == 1)
        {
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
            $pdf->addPage("http://localhost:8001/branch/sales_order.php?id=".$creation."&action=view");

            if(!$pdf->send())
            echo $pdf->getError();
        }
        else
        {
            header("location:index.php");
        }
    }
    else
    {
        header("location:index.php");
    }   
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
?>
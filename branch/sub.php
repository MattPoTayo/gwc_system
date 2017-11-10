<?php
$documentTemplate = file_get_contents ("template.html");
foreach ($_POST as $key => $postVar)
{
    $documentTemplate = 
    preg_replace ("/name=\"$key\"/", "value=\"$postVar\"", $documentTemplate);
}
file_put_contents ("out.html", $documentTemplate);
shell_exec ("wkhtmltopdf out.html test.pdf");
?>
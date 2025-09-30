<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include 'vendor/autoload.php';
$copy = new PsModule\PsLogger\Logger('ready');

print_r('<center>================== Start ==================</center>');

if ($copy->write('Test')) {
    echo "<center>Write Success</center>";
} else {
    echo "<center>Something went wrong</center>";
}

print_r('<center>================== Done ==================</center>');
?>
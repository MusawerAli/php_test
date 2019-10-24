<?php
// include your composer dependencies
session_start();

require_once "API/vendor/autoload.php";

    $gClient    =   new Google_Client();
    $gClient->setClientId("508793159082-39f16r747mpj69jhbcpbfrf0smbujds6.apps.googleusercontent.com");
    $gClient->setClientSecret("508793159082-39f16r747mpj69jhbcpbfrf0smbujds6.apps.googleusercontent.com");
    $gClient->setApplicationName("Instagram MusawerALi");
    $gClient->setRedirectUri("http://localhost/php_test/google_auth/g-callback.php");


    $gClient->addScope();
    $con = new mysqli('localhost','root','','php_test');
    if($con->connect_error){
        die("Connnection failed:" . $con->connect_error);

    }
?>
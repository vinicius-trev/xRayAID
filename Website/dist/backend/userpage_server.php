<?php
/*!
 * xRayAID
 * backend/userpage_server.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

session_start();

/* Debug */
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

/* If user is not logged in, go to main page */
if(!isset($_SESSION['username']))
{
   header("Location: ./");
   exit;
}
?>
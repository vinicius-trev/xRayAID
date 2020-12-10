<?php
/*!
 * xRayAID
 * backend/delete.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

session_start();

/* If user is not logged in, go to main page */
if(!isset($_SESSION['username']))
{
    header("Location: ./");
    exit;
}

if (isset($_GET['id'])) 
{

    /* Call API */
    $ch = curl_init(); 
    $url = 'http://localhost:5000/deleteClassification';
    $url = $url . '?username=' . $_SESSION['username'] . '&' . 'id=' . $_GET['id'];
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $delete_result = curl_exec($ch);
    curl_close($ch);
    $delete_result = json_decode($delete_result, true);

    var_dump($delete_result);

    if($delete_result['success'] == true)
    {
        if($_SESSION['historyOK'] == 1)
        {
            $_SESSION['historyOK'] = 0;
        }

        header("Location: ../history.php?cls");
        exit;
    }
    else 
    {
        header("Location: ../history.php?cls&error");
        exit;
    }

    
    
}

?>
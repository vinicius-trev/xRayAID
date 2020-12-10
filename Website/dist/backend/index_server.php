<?php
/*!
 * xRayAID
 * backend/index_server.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

/* Debug */
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

/* Defining Variables */
$email    = "";
$errors = array();

/* Connection to mysql DB */
$db = mysqli_connect('localhost', 'username', 'password', 'database_name');


/* Increver-se Backend Logic */
if (isset($_POST['subscribe'])) 
{
    /* Capture email from forms */
    $email = mysqli_real_escape_string($db, $_POST['subscribe_email']);

    /* Check if email is empty  */
    if (empty($email)) 
    {
        array_push($errors, "Email é obrigatório");
    }

    /* Check the database to make sure a email does not already exist */
    $email_check_query = "SELECT * FROM emails WHERE email='$email' LIMIT 1"; /* Make SQL query */
    $result = mysqli_query($db, $email_check_query);   /* Capture query result */
    $check_mail = mysqli_fetch_assoc($result);
    
    /* If user already exist, push error to frontend */
    if ($check_mail['email'] === $email)
    { 
        array_push($errors, "Email já existe");
        header("location: ./already-subscribed.html");
        exit;
    }

    /* Make the subscribe request at DB */
    if (count($errors) == 0) 
    {
        /* Save Email on DB */
        $query = "INSERT INTO emails(email) VALUES('$email')"; /* Make SQL query */
        $result = mysqli_query($db, $query); /* Capture query result */

        /* Send automatic email to contato@xrayaid.com.br */
        /* Will be implemented later, if time collaborate */

        /* Send automatic email to the email existed in $email variable */
        /* Will be implemented later, if time collaborate */

        header("location: ./subscribed.html");
        exit;
    }
 }
?>

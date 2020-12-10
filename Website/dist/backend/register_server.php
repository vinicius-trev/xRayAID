<?php
/*!
 * xRayAID
 * backend/register_server.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

session_start();

/* Defining Variables */
$username = "";
$email    = "";
$errors = array();
$options = [
    'cost' => 12
  ];

/* Connection to mysql DB */
$db = mysqli_connect('localhost', 'username', 'password', 'database_name');
$db->set_charset('utf8mb4');

/* Register Function with Captcha */
if (isset($_POST['reg_user']) && isset($_POST['g-recaptcha-response'])) 
{
    /* Get captcha if it is not null */
    if(isset($_POST['g-recaptcha-response']))
    {
        $captcha=$_POST['g-recaptcha-response'];
    }

    /* If Captcha is null, push an error */
    if(!$captcha)
    {
        array_push($errors, "reCAPTCHA deve ser preenchido");
    }

    /* Making the POST Request to Google Server */
    $secretKey = "CAPTCHA_SECRET_KEY";
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);

    /* Take action based on the returned captcha: If user is not a robot*/
    if($responseKeys["success"]) 
    {   
        /* Capture username, email and both passwords from forms */
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        /* Check if any of the fields are empty  */
        if (empty($username))
        { 
            array_push($errors, "Usuário é obrigatório"); 
        }
        if (empty($email)) 
        { 
            array_push($errors, "Email é obrigatório"); 
        }
        if (empty($password_1)) 
        {
            array_push($errors, "Senha é obrigatória"); 
        }
        if ($password_1 != $password_2) 
        {
            array_push($errors, "As duas senhas não coincidem");
        }

        /* Check the database to make sure a user does not already
        * exist with the same username and/or email */
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        /* If user already exist, push error to frontend */
        if ($user)
        { 
            if ($user['username'] === $username) 
            {
                array_push($errors, "O usuário já existe");
            }
            if ($user['email'] === $email) 
            {
                array_push($errors, "Email já existe");
            }
        }

        /* If there is no errors, register the new user */
        if (count($errors) == 0) 
        {
            $password = password_hash($password_1 , PASSWORD_BCRYPT, $options);  /* Encrypt password */
            $query = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')"; /* Make SQL query */
            $result = mysqli_query($db, $query); /* Capture query result */
            $_SESSION['username'] = $username;
            header('location: login.php');
            exit;
        }
    }
    else if ($captcha)
    {
        /* User is a Robot */
        array_push($errors, "Robôs não são aceitos aqui!");
    }
}
?>
<?php
/*!
 * xRayAID
 * backend/login_server.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

// header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
session_start();

/* If user is not logged in, go to main page */
if(isset($_SESSION['username']))
{
    echo "<script>window.top.location.href = 'userpage.php'</script>";
    header('Cache-Control: no cache');
    session_cache_limiter('private');
    exit;
}

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

/* Login Function with Captcha */
if (isset($_POST['login_user']) && isset($_POST['g-recaptcha-response'])) 
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
        /* User is not a robot */
        /* Capture username and password from forms */
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        /* Check if username or password is empty  */
        if (empty($username)) 
        {
            array_push($errors, "Usuário é obrigatório");
        }
        if (empty($password)) 
        {
            array_push($errors, "Senha é obrigatória");
        }

        /* Make the login request at DB */
        if (count($errors) == 0) 
        {
            $query = $db->prepare("SELECT password FROM users WHERE username='$username' limit 1");
            $query->bind_param('s', $username);
            $query->execute();

            $query_results = $query->get_result();
            $value = $query_results->fetch_object();
            $hash = $value->password;

            /* If query is OK Login is OK too */
            if (password_verify($password, $hash)) 
            {
                $_SESSION['username'] = $username;
                echo "<script>window.top.location.href = 'userpage.php'</script>";
                header('Cache-Control: no cache');
                session_cache_limiter('private');
                exit;
            }
            else /* Wrong username or password */
            {
                array_push($errors, "Usuário ou senha inválidos");
            }
        }
    } 
    else if ($captcha)
    {
        /* User is a Robot */
        array_push($errors, "Robôs não são aceitos aqui!");
    }
}
?>
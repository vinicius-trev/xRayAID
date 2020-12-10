<?php
/*!
 * xRayAID
 * backend/password_server.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

session_start();

/* Defining Variables */
$email = "";
$errors = array();
$success = array();
$options = [
    'cost' => 12
];

/* Connection to mysql DB */
$db = mysqli_connect('localhost', 'username', 'password', 'database_name');
$db->set_charset('utf8mb4');

/* Password Recovery condition with Captcha */
if (isset($_POST['pass_reset']) && isset($_POST['g-recaptcha-response'])) 
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
        /* Capture email from form */
        $email = mysqli_real_escape_string($db, $_POST['email']);

        /* Check if email is empty  */
        if (empty($email)) 
        {
            array_push($errors, "Email é obrigatório");
        }

        /* Make the email request at DB to see if it exists*/
        if (count($errors) == 0) 
        {
            $query = $db->prepare("SELECT password FROM users WHERE email='$email' limit 1");
            $query->bind_param('s', $email);
            $query->execute();

            $query_results = $query->get_result();
            $value = $query_results->fetch_object();

            /* If query is OK Login is OK too */
            if ($value != NULL) 
            {
                /* generate a unique random token of length 100 */
                $token = bin2hex(random_bytes(50));

                /* store token in the password-reset database table against the user's email */
                $sql = "INSERT INTO password_recovery(email, token) VALUES ('$email', '$token')";
                $results = mysqli_query($db, $sql);

                /* Send email to user with the token in a link they can click on */
                $to = $email;
                $subject = "Reset de senha na plataforma xRayAID";
                $message = '<html><body>';
                $message .= "Ola, clique aqui <a href=\"https://xrayaid.com.br/new_password.php?token=" . $token . "\">link</a> para recuperar sua senha no xRayAID";
                $message .= '</body></html>';

                $headers = "From: xrayaid-noreply@xrayaid.com.br" . "\r\n";
                $headers .= "Reply-To: contato@xrayaid.com.br" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                mail($to, $subject, $message, $headers);
                header('location: pending.php?email=' . $email);

                array_push($success, "Enviamos um email para você com as intruções para recuperar a senha.");
            }
            else /* Email does not exist */
            {
                array_push($errors, "Email não existe");
            }
        }
    } 
    else if ($captcha)
    {
        /* User is a Robot */
        array_push($errors, "Robôs não são aceitos aqui!");
    }
}

/* Change password condition */
if (isset($_POST['new_password'])) {
    $new_pass = mysqli_real_escape_string($db, $_POST['password_1']);
    $new_pass_c = mysqli_real_escape_string($db, $_POST['password_2']);
  
    /* Grab to token that came from the email link */
    $token = $_GET['token'];
    if (empty($new_pass) || empty($new_pass_c)) 
    {
        array_push($errors, "O campo de nova senha não pode ser vazio");
    }

    if ($new_pass !== $new_pass_c) 
    {
        array_push($errors, "As senhas não coincidem");
    }

    if (count($errors) == 0) 
    {
      /* select email address of user from the password_recovery table */
      $sql = "SELECT email FROM password_recovery WHERE token='$token' LIMIT 1";
      $results = mysqli_query($db, $sql);
      $email = mysqli_fetch_assoc($results)['email'];
      
      if ($email) 
      {
        $new_pass = password_hash($new_pass , PASSWORD_BCRYPT, $options);
        $sql = "UPDATE users SET password='$new_pass' WHERE email='$email'";
        $results = mysqli_query($db, $sql);

        $drop = "DELETE FROM password_recovery WHERE token='$token' LIMIT 1";
        $results = mysqli_query($db, $drop);
        header('location: recovery_success.php');
      }
    }
  }
?>
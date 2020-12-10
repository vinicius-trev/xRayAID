<!-- /*!
 * xRayAID
 * backend/update_information.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ -->

<?php 

/* If user is not logged in, go to main page */
if(!isset($_SESSION['username']))
{
   header("Location: ./");
   exit;
}

/* Submit form with Additional Informations */
/* This will update mongodb annotations and feedback fields with the values inserted */
if(isset($_POST["additionalInfo"])) 
{
    $annotations = $_POST['annotations'];
    $feedback = $_POST['feedback'];
    $username = $_SESSION['username'];
    $classification_id = $_SESSION['classification_id'];

    if(strlen($feedback) != 0 || strlen($annotations) != 0)
    {
    
        /* Building POST request to API */
        $data = array(
            'username' => strval($username),
            'classification_id' => strval($classification_id),
            'feedback' => strval($feedback),
            'annotations' => strval($annotations)
        );

        $postvars = http_build_query($data);

        $ch = curl_init();   
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/updateText');
        curl_exec($ch);
        curl_close($ch);

        /* Saving annotations and feedback on session to recover on texfield reload */
        $_SESSION['annotations'] = $annotations;
        $_SESSION['feedback'] = $feedback;

        /* Avoiding POST redrect on page refresh */
        echo '<script>
                 if ( window.history.replaceState ) { 
                     window.history.replaceState( null, null, window.location.href );
                 }
                 </script>';
    }
}
?>
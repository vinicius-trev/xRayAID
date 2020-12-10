<?php
/*!
 * xRayAID
 * backend/classify_server.php
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

# Clear classificarion status, used when user clicks on classification page
function clearClassificationStatus() {
    if($_SESSION['classifyOK'] == 1)
    {
        $_SESSION['classifyOK'] = 0;
        $_SESSION['historyOK'] = null;
        $_SESSION['feedback'] = $_SESSION['annotations'] = "";
    }
    if($_SESSION['historyOK'] == 1)
    {
        $_SESSION['historyOK'] = 0;
    }

    echo '<script>
            if ( window.history.replaceState ) { 
                window.history.replaceState( null, null, window.location.href.split("?")[0] );
            }
        </script>';
}

if (isset($_GET['cls'])) {
    clearClassificationStatus();
}

/* If user is not logged in, go to main page */
if(!isset($_SESSION['username']))
{
   header("Location: ./");
   exit;
}

/* Error and success Variable */
$errors = array();
$success = array();

/* Check if it is a valid image, the HTML already validates the format (png, jpg, jpeg) */
if(isset($_POST["submit"])) 
{
    /* Check image size, 10MB limit */
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) 
    {   
        if ($_FILES['fileToUpload']['size'] > 10000000) 
        {
            array_push($errors, "Arquivo Inválido - Arquivo supera os 10MB.");
            $classifyOK = 0;
        }
        else
        {
            /* Calling xRayAID API to POST classification */
            /* Filling POST fields with data (image, username) */
            $tmpfile = $_FILES['fileToUpload']['tmp_name'];
            $filename = basename($_FILES['fileToUpload']['name']);
            $data = array(
                'image' => curl_file_create($tmpfile, $_FILES['image']['type'], $filename),
                'data' => "{'username': '" . strval($_SESSION['username']) . "'}"
            );

            /* Posting request to API */
            $ch = curl_init();   
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
            curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/predict');
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result, true);

            if ($result["success"] == true)
            {
                /* Classification OK, show_results will exibit both images by xRayAID GET API */
                /* That will be based on the variables below */
                /* Get Original image in base64 */
                $ch = curl_init(); 
                $url = 'http://localhost:5000/image';
                $url = $url . '?username=' . $result['username'] . '&' . 'id=' . $result['classification_id'] . '&' . 'image=original';
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                $result_original = curl_exec($ch);
                curl_close($ch);

                if($result_original != '')
                {   
                    /* Converting base64 image */
                    $f = finfo_open();
                    $original_type = finfo_buffer($f, $result_original, FILEINFO_MIME_TYPE);
                    $original = "data:" . $original_type . ";base64," . base64_encode($result_original);
                
                    /* Get Pneumonia probability */
                    $pneumonia_probability = number_format(round($result["pneumonia_probability"] * 100, 4), 2, ',', ' ');

                    /* Saving classification ID, original image and probability on session (for reloading and keeping on page) */
                    $_SESSION['original'] = $original;
                    $_SESSION['classification_id'] = $result['classification_id'];
                    $_SESSION['pneumonia_probability'] = $pneumonia_probability;

                    /* Get Heatmap image in base64 */
                    $ch = curl_init(); 
                    $url = 'http://localhost:5000/image';
                    $url = $url . '?username=' . $result['username'] . '&' . 'id=' . $result['classification_id'] . '&' . 'image=heatmap_original';
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    $result_heatmap = curl_exec($ch);
                    curl_close($ch);

                    if($result_heatmap != '')
                    {   
                        /* Converting base64 image */
                        $f = finfo_open();
                        $heatmap_type = finfo_buffer($f, $result_heatmap, FILEINFO_MIME_TYPE);
                        $heatmap = "data:" . $heatmap_type . ";base64," . base64_encode($result_heatmap);

                        /* Saving important data on session */
                        $_SESSION['heatmap'] = $heatmap;

                        /* Get Original LAB image in base64 */
                        $ch = curl_init(); 
                        $url = 'http://localhost:5000/image';
                        $url = $url . '?username=' . $result['username'] . '&' . 'id=' . $result['classification_id'] . '&' . 'image=original_lab';
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_URL, $url);
                        $result_original_lab = curl_exec($ch);
                        curl_close($ch);

                        if($result_original_lab != '')
                        {   
                            /* Converting base64 image */
                            $f = finfo_open();
                            $original_lab_type = finfo_buffer($f, $result_original_lab, FILEINFO_MIME_TYPE);
                            $original_lab = "data:" . $original_lab_type . ";base64," . base64_encode($result_original_lab);

                            /* Saving important data on session */
                            $_SESSION['original_lab'] = $original_lab;

                            /* Get Heatmap LAB image in base64 */
                            $ch = curl_init(); 
                            $url = 'http://localhost:5000/image';
                            $url = $url . '?username=' . $result['username'] . '&' . 'id=' . $result['classification_id'] . '&' . 'image=heatmap_lab';
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_URL, $url);
                            $result_heatmap_lab = curl_exec($ch);
                            curl_close($ch);

                            if($result_heatmap_lab != '')
                            {   
                                /* Converting base64 image */
                                $f = finfo_open();
                                $heatmap_lab_type = finfo_buffer($f, $result_heatmap_lab, FILEINFO_MIME_TYPE);
                                $heatmap_lab = "data:" . $heatmap_lab_type . ";base64," . base64_encode($result_heatmap_lab);

                                $classifyOK = 1;

                                /* Saving important data on session */
                                $_SESSION['classifyOK'] = $classifyOK;
                                $_SESSION['heatmap_lab'] = $heatmap_lab;

                            }
                            else
                            {
                                array_push($errors, "Erro ao utilizar API GET /image, contate o suporte!");
                                $classifyOK = 0;
                            }

                        }
                        else
                        {
                            array_push($errors, "Erro ao utilizar API GET /image, contate o suporte!");
                            $classifyOK = 0;
                        }

                    }
                    else
                    {
                        array_push($errors, "Erro ao utilizar API GET /image, contate o suporte!");
                        $classifyOK = 0;
                    }
                }
                else
                {
                    array_push($errors, "Erro ao utilizar API GET /image, contate o suporte!");
                    $classifyOK = 0;
                }
            }
            else
            {
                array_push($errors, "Erro ao utilizar API POST /predict, contate o suporte!");
                $classifyOK = 0;
            }

            /* Preventing POST duplicated request on success */
            echo '<script>
                 if ( window.history.replaceState ) { 
                     window.history.replaceState( null, null, window.location.href );
                 }
                 </script>';
        }
    } 
    /* Invalid image, size is null */
    else 
    {
        array_push($errors, "Arquivo Inválido - Tenta novamente, agora com uma imagem válida");
        $classifyOK = 0;
    }
}
?>
<?php
/*!
 * xRayAID
 * backend/history_server.php
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

/* Startup variables and functions */
$errors = array();

if($_SESSION['historyOK'] == null)
{
  $_SESSION['historyOK'] = 0;
  $_SESSION['classifyOK'] = 0;
}

if (isset($_GET['cls'])) 
{
  if($_SESSION['classifyOK'] == 1)
  {
      $_SESSION['classifyOK'] = 0;
      $_SESSION['feedback'] = $_SESSION['annotations'] = "";
  }
  if($_SESSION['historyOK'] != 1)
  {
    $_SESSION['historyOK'] = 0;
  }

  echo '<script>
          if ( window.history.replaceState ) { 
            window.history.replaceState( null, null, window.location.href.split("?")[0] );
           }
        </script>';
}

if (isset($_GET['back'])) 
{
  $_SESSION['classifyOK'] = 0;
  
  echo '<script>
          if ( window.history.replaceState ) { 
            window.history.replaceState( null, null, window.location.href.split("?")[0] );
          }
        </script>';
}

if(isset($_GET['error']))
{
  array_push($errors, "Erro ao utilizar API GET /deleteClassification, contate o suporte!");

  echo '<script>
          if ( window.history.replaceState ) { 
              window.history.replaceState( null, null, window.location.href.split("?")[0] );
          }
        </script>';
}

/* Visualize classification when button is pressed */
if (isset($_GET['visualize'])) 
{
  /* Save Classification ID */
  $_SESSION['classification_id'] = $_GET['visualize'];
  
  /* Get 4 images and add to session */
  $ch = curl_init(); 
  $url = 'http://localhost:5000/image';
  $url = $url . '?username=' . $_SESSION['username'] . '&' . 'id=' . $_GET['visualize'] . '&' . 'image=original';
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

      /* Saving classification ID, original image and probability on session (for reloading and keeping on page) */
      $_SESSION['original'] = $original;

      /* Get Heatmap image in base64 */
      $ch = curl_init(); 
      $url = 'http://localhost:5000/image';
      $url = $url . '?username=' . $_SESSION['username'] . '&' . 'id=' . $_GET['visualize'] . '&' . 'image=heatmap_original';
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
          $url = $url . '?username=' . $_SESSION['username'] . '&' . 'id=' . $_GET['visualize'] . '&' . 'image=original_lab';
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
              $url = $url . '?username=' . $_SESSION['username'] . '&' . 'id=' . $_GET['visualize'] . '&' . 'image=heatmap_lab';
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

  /* Get feedback and annotation texts then, add to session */
  $ch = curl_init(); 
  $url = 'http://localhost:5000/getText';
  $url = $url . '?username=' . $_SESSION['username'] . '&' . 'id=' . $_GET['visualize'];
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $text_result = curl_exec($ch);
  curl_close($ch);

  if($text_result != null)
  {
    $text_result = json_decode($text_result, true);
    $_SESSION['annotations'] = $text_result['annotations'];
    $_SESSION['feedback'] = $text_result['feedback'];
    $classifyOK = 1;
  }
  else
  {
    array_push($errors, "Erro ao utilizar API GET /getText, contate o suporte!");
    $classifyOK = 0;
  }

  /* Fill probability variable */
  foreach($_SESSION['history'] as $item) 
  {
    if($item['classification_id'] == $_GET['visualize'])
    {
      $_SESSION['pneumonia_probability'] = number_format(round($item["pneumonia_probability"] * 100, 4), 2, ',', ' ');
    }
  }

  /* Flag up, indicating that the result can be shown */
  $_SESSION['classifyOK'] = $classifyOK;

  echo '<script>
          if ( window.history.replaceState ) { 
              window.history.replaceState( null, null, window.location.href.split("?")[0] );
          }
        </script>';
}

/* Function to make request */
function getHistory()
{
  /* CURL the API (Need to parse the JSON) */
  if($_SESSION['historyOK'] == 0)
  {
    $ch = curl_init(); 
    $url = 'http://localhost:5000/getHistory';
    $url = $url . '?username=' . $_SESSION['username'];
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $history_result = curl_exec($ch);
    curl_close($ch);
    $_SESSION['history'] = json_decode($history_result, true);

    /* If success, change flag status */
    $_SESSION['historyOK'] = 1;
  }

  if ($_SESSION['historyOK'] = 1 && $_SESSION['history'] != null) /* Populate HTML Table */
  {
    $i = 0;
    foreach($_SESSION['history'] as $item) {

      echo '<tr>';
      echo '    <td class="border-left border-top border-bottom rounded-left align-middle text-center bg-white width:5%">';
      echo '        <div id="sellPerCirc' . $i . '" class="perCirc m-auto">';
      echo '            <div class="perCircInner">';
      echo '            </div>';
      echo '        </div>';
      echo '    </td>';
      echo '    <td class="border align-middle text-center" style="width:13%">' . $item['classification_id'] . '</td>';
      echo '    <td class="border align-middle text-center" style="width:25%">' . number_format(round($item["pneumonia_probability"] * 100, 2), 2, ',', ' ') . '%</td>';
      echo '    <td class="border align-middle text-center" style="width:25%"><spam style="display:none;">' .  $item['classification_id'] . '</spam>'  . date('d/m/Y', $item['classification_id']) . '</td>';
      echo '    <td class="border align-middle text-center" style="width:25%">' . date('H:i:s', $item['classification_id']) . '</td>';
      echo '    <td class="border-0 text-right align-middle bg-white" style="width:5%" ><a class="btn btn-primary ml-1" href="?visualize=' . $item['classification_id'] . '">Visualizar</a></td>';
      echo '    <td class="border-0 text-left align-middle text-center bg-white" style="width:2%">';
      echo '        <div class="delete">  ';
      echo '            <a class="deleteModal roboto a-danger" href="#" data-toggle="modal" data-id="' . $item['classification_id'] . '" data-target="#deleteModal" >';
      echo '                <i class="fas fa-trash mr-1"></i> Excluir';
      echo '            </a>';
      echo '        </div>';
      echo '    </td>';
      echo '</tr>';

      $i = $i + 1;
    }
  }
  else
  {
    echo '<div class="text-center font-weight-light" style="color:red; font-size:0.9em">';
    echo '      <p> Erro ao utilizar API GET /getHistory, contate o suporte! </p>';
    echo '</div>';
  }
}
?>
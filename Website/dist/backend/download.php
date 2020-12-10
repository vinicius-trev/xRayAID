<?php
/*!
 * xRayAID
 * backend/download.php
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

/* Prepare tmp file for zip */
$file = tempnam("tmp", "zip");
$zip = new ZipArchive();
$zip->open($file, ZipArchive::OVERWRITE);

/* Add files/contents */
$re = '#^data:image/\w+;base64,#i'; 

/* Add Original  Image */ 
$data = preg_replace($re, '', $_SESSION['original']);
$data = base64_decode($data);
$mimetype = finfo_buffer(finfo_open(), $data, FILEINFO_MIME_TYPE);
$type = substr($mimetype, 6);
$zip->addFromString('original.' . $type, $data);

/* Add Original Filtered Image */ 
$data = preg_replace($re, '', $_SESSION['original_lab']);
$data = base64_decode($data);
$mimetype = finfo_buffer(finfo_open(), $data, FILEINFO_MIME_TYPE);
$type = substr($mimetype, 6);
$zip->addFromString('original_filtered.' . $type , $data);

/* Add Heatmap Original Image */
$data = preg_replace($re, '', $_SESSION['heatmap']);
$data = base64_decode($data);
$zip->addFromString('mapa-de-calor_original.jpg', $data);

/* Add Heatmap Filtered Image */ 
$data = preg_replace($re, '', $_SESSION['heatmap_lab']);
$data = base64_decode($data);
$zip->addFromString('mapa-de-calor_filtered.jpg', $data);

/* Add text values */
$zip->addFromString('anotações.txt', ("Probabilidade de Pnmeumonia: " .  $_SESSION['pneumonia_probability'] . "%\nAnotações: " . $_SESSION['annotations'] . "\nFeedback: " . $_SESSION['feedback']));

/* Close and send zip file to users */
$zip->close();
$filename =  'Classificacao-' . $_SESSION['classification_id'] . '.zip';
header('Content-Type: application/zip');
header('Content-Length: ' . filesize($file));
header('Content-Disposition: attachment; filename="' . $filename . '"');
readfile($file);
unlink($file);
?>
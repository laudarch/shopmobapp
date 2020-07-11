<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database/db.php';
$folder = "tvnotes/images/";

$base=$_REQUEST['image'];

//echo $base;

// base64 encoded utf-8 string
$binary=base64_decode($base);
// binary, utf-8 bytes

header('Content-Type: bitmap; charset=utf-8');
//$theFile = base64_decode($image_data);
$blob_name = uniqid('', TRUE);
$filename = $folder.$blob_name.'.jpg';

$file = fopen($filename, 'wb');
fwrite($file, $binary);
fclose($file);

$query = "INSERT INTO blobs (blob_path, status) VALUES ('$filename' , 'A')";
mysql_query($query) or die (mysql_error()); 
$blob_id = mysql_insert_id();

echo $blob_id;

?>

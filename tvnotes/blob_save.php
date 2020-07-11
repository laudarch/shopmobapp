<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database/db.php';
$folder = "images/";

if(isset($_POST['submit'])){
    $blob_name = uniqid('', TRUE);
    error_log("auto generated name ".$blob_name);
    
    if($blob_name){
        $filename = $folder.$blob_name.$_FILES['upload']['name'];
        $status = move_uploaded_file($_FILES['upload']['tmp_name'], $filename);
        
        if($status){
       
            $query = "INSERT INTO blobs ( blob_path, status ) VALUES ('".$filename."' , 'A')";
            mysql_query($query) or die (mysql_error()); 
            $blob_id = mysql_insert_id();
            
            echo "<img src =".$filename." width=\"100\" height=\"100\">";
        }
    }
   
}
?>

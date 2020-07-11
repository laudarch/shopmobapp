<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include 'database/db.php';

$name = "";
$tv_station_id ="";
$program_category_id ="";
$description = "";
$showday ="";
$showtime ="";
$blob_id = "";

$folder = "images/";

if(isset($_POST['submit'])){
    $blob_name = uniqid('', TRUE);
    error_log("auto generated name ".$blob_name);
    
    if($blob_name){
        $filename = $folder.$blob_name.$_FILES['upload']['name'];
        $status = move_uploaded_file($_FILES['upload']['tmp_name'], $filename);
        
        if($status){
       
            $query = "INSERT INTO blobs ( blob_path, status ) VALUES ('".$filename."', 'A')";
            mysql_query($query) or die (mysql_error()); 
            $blob_id = mysql_insert_id();
            
//            echo $blob_id;
        }
    }
   
}


if(isset($_REQUEST['name']) && $_REQUEST['name'] != null && $_REQUEST['name'] != ""){
    
    $name = $_REQUEST['name'];
    
}

if(isset($_REQUEST['tv_station_id']) && $_REQUEST['tv_station_id'] != null && $_REQUEST['tv_station_id'] != ""){
    
    $tv_station_id = $_REQUEST['tv_station_id'];
    
}

if(isset($_REQUEST['description']) && $_REQUEST['description'] != null && $_REQUEST['description'] != ""){
    
    $description = $_REQUEST['description'];
    
}

if(isset($_REQUEST['program_category_id']) && $_REQUEST['program_category_id'] != null && $_REQUEST['program_category_id'] != ""){
    
    $program_category_id = $_REQUEST['program_category_id'];
    
}

if(isset($_REQUEST['showday']) && $_REQUEST['showday'] != null && $_REQUEST['showday'] != ""){
    
    $showday = $_REQUEST['showday'];
    
}

if(isset($_REQUEST['showtime']) && $_REQUEST['showtime'] != null && $_REQUEST['showtime'] != ""){
    
    $showtime = $_REQUEST['showtime'];
    
}

$query = "INSERT INTO programs (category_id, tv_station_id, name, description, blob_id, showday, showtime) VALUES ('$program_category_id' , '$tv_station_id', '$name', '$description', '$blob_id', '$showday', '$showtime')";
$result = mysql_query($query) or die (mysql_error()); 
$team_id = mysql_insert_id();

//echo $name."<br/>"; 
//echo $abbreviation."<br/>"; 
//echo $description."<br/>"; 
//echo $country."<br/>"; 

$_SESSION['error_msg'] = $name.' Tv Program is saved';

header("location:index.php");

?>

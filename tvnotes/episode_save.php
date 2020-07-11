<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include 'database/db.php';

$name = "";
$program_id ="";
$description = "";
$video_id = "";

$folder = "videos/";

if(isset($_REQUEST['name']) && $_REQUEST['name'] != null && $_REQUEST['name'] != ""){
    
    $name = $_REQUEST['name'];
    
}

if(isset($_REQUEST['program_id']) && $_REQUEST['program_id'] != null && $_REQUEST['program_id'] != ""){
    
    $program_id = $_REQUEST['program_id'];
    
}

if(isset($_REQUEST['description']) && $_REQUEST['description'] != null && $_REQUEST['description'] != ""){
    
    $description = $_REQUEST['description'];
    
}

$query = "INSERT INTO episodes (program_id, title, description) VALUES ('$program_id' , '$name', '$description')";
$result = mysql_query($query) or die (mysql_error()); 
$team_id = mysql_insert_id();


$blob_name = uniqid('', TRUE);
    error_log("auto generated name ".$blob_name);
    
    if($blob_name){
        $filename = $folder.$blob_name.$_FILES['upload']['name'];
        $status = move_uploaded_file($_FILES['upload']['tmp_name'], $filename);
        
        if($status){
       
            $query = "INSERT INTO podcast ( episode_id, podcast_path ) VALUES ('".$team_id."', '".$filename."')";
            mysql_query($query) or die (mysql_error()); 
            $video_id = mysql_insert_id();
            
//            echo $blob_id;
        }
    }
    
//echo $name."<br/>"; 
//echo $abbreviation."<br/>"; 
//echo $description."<br/>"; 
//echo $country."<br/>"; 

$_SESSION['error_msg'] = $name.' is saved';

header("location:add_episode.php");

?>

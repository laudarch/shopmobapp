<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database/db.php';

$name = "";
$username ="";
$password ="";
$msisdn = "";
$email ="";
$blob_id = "";

if(isset($_REQUEST['image']) && $_REQUEST['image'] != null && $_REQUEST['image'] != ""){
    
    $fields = array(
            'image'=>urlencode($_REQUEST['image']),
            
        );
    $fields_string="";
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string,'&');


    $requestUrl = "http://www.shopmobapp.com/tvnotes/base64_blob_save.php";
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $requestUrl);
    curl_setopt($curl_handle,CURLOPT_POST,count($fields));
    curl_setopt($curl_handle,CURLOPT_POSTFIELDS,$fields_string);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $blob_id = curl_exec($curl_handle);
    curl_close($curl_handle);

     
}


if(isset($_REQUEST['name']) && $_REQUEST['name'] != null && $_REQUEST['name'] != ""){
    
    $name = $_REQUEST['name'];
    
}

if(isset($_REQUEST['username']) && $_REQUEST['username'] != null && $_REQUEST['username'] != ""){
    
    $username = $_REQUEST['username'];
    
}

if(isset($_REQUEST['password']) && $_REQUEST['password'] != null && $_REQUEST['password'] != ""){
    
    $password = $_REQUEST['password'];
    
}

if(isset($_REQUEST['msisdn']) && $_REQUEST['msisdn'] != null && $_REQUEST['msisdn'] != ""){
    
    $msisdn = $_REQUEST['msisdn'];
    
}

if(isset($_REQUEST['email']) && $_REQUEST['email'] != null && $_REQUEST['email'] != ""){
    
    $email = $_REQUEST['email'];
    
}

//if(isset($_REQUEST['blob_id']) && $_REQUEST['blob_id'] != null && $_REQUEST['blob_id'] != ""){
//    
//    $blob_id = $_REQUEST['blob_id'];
//    
//}

$query = "INSERT INTO users (name, username, password, msisdn, email, blob_id) VALUES ('$name' , '$username', '$password', '$msisdn', '$email', '$blob_id')";
$result = mysql_query($query) or die (mysql_error()); 

$xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<users>\n";



if($result == TRUE){
    $user_id = mysql_insert_id();
    
    $requestUrl = "http://www.shopmobapp.com/tvnotes/get_user.php?user_id=".$user_id;
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $requestUrl);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($curl_handle);
    curl_close($curl_handle);
    
    echo $result;
    exit;
//    $xml_output .= "\t<row>\n";
//    $xml_output .= "\t\t<id>" . $user_id . "</id>\n";
//    $xml_output .= "\t\t<name></name>\n";
//    $xml_output .= "\t\t<username></username>\n";
//    $xml_output .= "\t\t<password></password>\n";
//    $xml_output .= "\t\t<email></email>\n";
//    $xml_output .= "\t\t<msisdn></msisdn>\n";
//    $xml_output .= "\t\t<blob_id>" . $blob_id . "</blob_id>\n";
//    $xml_output .= "\t</row>\n";
}else{
    $xml_output .= "\t<row>\n";
    $xml_output .= "\t\t<id></id>\n";
    $xml_output .= "\t</row>\n";
}

$xml_output .= "</users>";

header("Content-type: text/xml"); 
echo $xml_output; 
?>

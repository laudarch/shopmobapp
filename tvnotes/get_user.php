<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include 'database/db.php';

$xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<users>\n";
$query =""; 

if(isset($_REQUEST['user_id'])){
    
    if($_REQUEST['user_id'] != null && $_REQUEST['user_id'] != ""){
        $query .= "SELECT * FROM users WHERE id IN (".$_REQUEST['user_id'].")";        
    }else{
       
        $xml_output .= "\t\t<user></user>\n";
        $xml_output .= "</users>";
        header("Content-type: text/xml"); 
        
        echo $xml_output;
        exit;
    }    
}else if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
    
    if($_REQUEST['username'] != null && $_REQUEST['password'] != ""){
        $query .= "SELECT * FROM users WHERE username ='".$_REQUEST['username']."' AND password = '".$_REQUEST['password']."'";   
    }else{
       
        $xml_output .= "\t\t<user></user>\n";
        $xml_output .= "</users>";
        header("Content-type: text/xml"); 
        
        echo $xml_output;
        exit;
    } 
    
}else if(isset($_REQUEST['msisdn']) && isset($_REQUEST['password'])){
    
    if($_REQUEST['msisdn'] != null && $_REQUEST['password'] != ""){
        $query .= "SELECT * FROM users WHERE msisdn ='".$_REQUEST['msisdn']."' AND password = '".$_REQUEST['password']."'";   
    }else{
       
        $xml_output .= "\t\t<user></user>\n";
        $xml_output .= "</users>";
        header("Content-type: text/xml"); 
        
        echo $xml_output;
        exit;
    } 
    
}else if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
    
    if($_REQUEST['email'] != null && $_REQUEST['password'] != ""){
        $query .= "SELECT * FROM users WHERE email ='".$_REQUEST['email']."' AND password = '".$_REQUEST['password']."'";   
    }else{
       
        $xml_output .= "\t\t<user></user>\n";
        $xml_output .= "</users>";
        header("Content-type: text/xml"); 
        
        echo $xml_output;
        exit;
    } 
    
}else if(isset($_REQUEST['username'])){
    
    if($_REQUEST['username'] != null && $_REQUEST['username'] != ""){
        $query .= "SELECT * FROM users WHERE username ='".$_REQUEST['username']."'";   
    }else{
       
        $xml_output .= "\t\t<user></user>\n";
        $xml_output .= "</users>";
        header("Content-type: text/xml"); 
        
        echo $xml_output;
        exit;
    } 
    
}else if(isset($_REQUEST['email'])){
    
    if($_REQUEST['email'] != null && $_REQUEST['email'] != ""){
        $query .= "SELECT * FROM users WHERE email ='".$_REQUEST['email']."'";   
    }else{
       
        $xml_output .= "\t\t<user></user>\n";
        $xml_output .= "</users>";
        header("Content-type: text/xml"); 
        
        echo $xml_output;
        exit;
    } 
    
}else if(isset($_REQUEST['msisdn'])){
    
    if($_REQUEST['msisdn'] != null && $_REQUEST['msisdn'] != ""){
        $query .= "SELECT * FROM users WHERE msisdn ='".$_REQUEST['msisdn']."'";   
    }else{
       
        $xml_output .= "\t\t<user></user>\n";
        $xml_output .= "</users>";
        header("Content-type: text/xml"); 
        
        echo $xml_output;
        exit;
    } 
    
}

$view = mysql_query($query) or die($query.' users query failed ' . mysql_error());   
if(mysql_num_rows($view) > 0){    
    for($x = 0 ; $x < mysql_num_rows($view) ; $x++){
            $row = mysql_fetch_assoc($view);
            $xml_output .= "\t<row>\n";
            $xml_output .= "\t\t<id>" . $row['id'] . "</id>\n";
            $xml_output .= "\t\t<name>" . $row['name'] . "</name>\n";
            $xml_output .= "\t\t<username>" . $row['username'] . "</username>\n";
            $xml_output .= "\t\t<password>" . $row['password'] . "</password>\n";
            $xml_output .= "\t\t<email>" . $row['email'] . "</email>\n";
            $xml_output .= "\t\t<msisdn>" . $row['msisdn'] . "</msisdn>\n";
            $xml_output .= "\t\t<blob_id>" . $row['blob_id'] . "</blob_id>\n";
            $xml_output .= "\t</row>\n";
    }
    }else{
    	$xml_output .= "\t\t<row></row>\n";
    }

    $xml_output .= "</users>";

    header("Content-type: text/xml"); 
    echo $xml_output; 
?>

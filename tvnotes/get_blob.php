<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database/db.php';

if(isset($_REQUEST['blob_id'])){
    $query = "SELECT * FROM blobs WHERE id = '".$_REQUEST['blob_id']."'";
    $view = mysql_query($query) or die($query.' blobs query failed ' . mysql_error());
    
    //error_log("NUMBER OF ROWS: " . (int)mysql_num_rows($view));
    if((int) mysql_num_rows($view)>=1){
        $row = mysql_fetch_assoc($view);
        $photo = $row['blob_path'];
        
        $im = file_get_contents("http://www.shopmobapp.com/tvnotes/".$photo);
        header("Content-type: image/jpg");  
        echo $im;
        exit;
    }else{
    
    $xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<blobs>\n";
$xml_output .= "<blob>id does not match any blob</blob>";
$xml_output .= "</blobs>";
header("Content-type: text/xml");
echo $xml_output;
}
   

   
}else{
    
    $xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<blobs>\n";
$xml_output .= "<blob>no id passed</blob>";
$xml_output .= "</blobs>";
header("Content-type: text/xml");
echo $xml_output;
}
    
?>

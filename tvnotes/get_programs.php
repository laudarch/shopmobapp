<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header("Content-type: text/xml"); 
session_start();
include 'database/db.php';
$query =" ";
//$view;

if (isset($_REQUEST['category_id']) && isset($_REQUEST['tv_station_id'])) {
    $query .= "SELECT * FROM programs WHERE category_id = '".$_REQUEST['category_id']."' AND tv_station_id = '".$_REQUEST['tv_station_id']."'";
    
}else if(isset($_REQUEST['program_id'])){
    
    $query .= "SELECT * FROM programs WHERE id IN (".$_REQUEST['program_id'].")";
   
}else if (isset($_REQUEST['tv_station_id'])) {
    $query .= "SELECT * FROM programs WHERE tv_station_id = '".$_REQUEST['tv_station_id']."'";   
}else{
    
    $query .= "SELECT * FROM programs";
   
}

$view = mysql_query($query) or die($query.' programs query failed ' . mysql_error());

$xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<programs>\n";

for($x = 0 ; $x < mysql_num_rows($view) ; $x++){
    $row = mysql_fetch_assoc($view);
    $xml_output .= "\t<row>\n";
    $xml_output .= "\t\t<id>" . $row['id'] . "</id>\n";
    $xml_output .= "\t\t<name>" . $row['name'] . "</name>\n";
        // Escaping illegal characters
        $row['description'] = str_replace("&", "&", $row['description']);
        $row['description'] = str_replace("<", "<", $row['description']);
        $row['description'] = str_replace(">", "&gt;", $row['description']);
        $row['description'] = str_replace("\"", "&quot;", $row['description']);
    $xml_output .= "\t\t<description>" . $row['description'] . "</description>\n";
    $xml_output .= "\t\t<blob_id>" . $row['blob_id'] . "</blob_id>\n";
    $xml_output .= "\t\t<tv_station_id>" . $row['tv_station_id'] . "</tv_station_id>\n";
    $xml_output .= "\t\t<showtime>" . $row['showtime'] . "</showtime>\n";
    $xml_output .= "\t\t<showday>" . $row['showday'] . "</showday>\n";
    $xml_output .= "\t</row>\n";
}

$xml_output .= "</programs>";

echo $xml_output; 
?>

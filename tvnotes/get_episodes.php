<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
include 'database/db.php';

$xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<episodes>\n";

$query =" ";
//$view;

if(isset($_REQUEST['program_id'])){
    
    if($_REQUEST['program_id'] != null && $_REQUEST['program_id'] != ""){
        
        $query .= "SELECT * FROM episodes WHERE program_id IN (".$_REQUEST['program_id'].") ORDER BY timestamp DESC";
        $view = mysql_query($query) or die($query.' episodes query failed ' . mysql_error());
        
        for($x = 0 ; $x < mysql_num_rows($view) ; $x++){
            $row = mysql_fetch_assoc($view);
            $xml_output .= "\t<row>\n";
            $xml_output .= "\t\t<id>" . $row['id'] . "</id>\n";
            $xml_output .= "\t\t<title>" . $row['title'] . "</title>\n";
            $xml_output .= "\t\t<code>" . $row['code'] . "</code>\n";
            // Escaping illegal characters
            $row['description'] = str_replace("&", "&", $row['description']);
            $row['description'] = str_replace("<", "<", $row['description']);
            $row['description'] = str_replace(">", "&gt;", $row['description']);
            $row['description'] = str_replace("\"", "&quot;", $row['description']);
            $xml_output .= "\t\t<description>" . $row['description'] . "</description>\n";
            $xml_output .= "\t\t<timestamp>" . $row['timestamp'] . "</timestamp>\n";
            $xml_output .= "\t</row>\n";
       }
    }else {
        $xml_output .= "\t<row/>\n";
        
    }
   
}else {
    $xml_output .= "\t<row/>\n";
}

header("Content-type: text/xml"); 

$xml_output .= "</episodes>";
echo $xml_output; 
?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include 'database/db.php';

$query_categories =" ";
//$view;

if (isset($_REQUEST['category_id'])) {
    $query_categories = "SELECT * FROM programs_category WHERE id IN (".$_REQUEST['category_id'].")";
    
}else{   
   $query_categories = "SELECT * FROM programs_category";
   
}

$view_categories = mysql_query($query_categories) or die('categories query failed' . mysql_error());

$xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<categories>\n";

$row_num = mysql_num_rows($view_categories);

if($row_num>=1){
    for($x = 0 ; $x < $row_num ; $x++){
        $row = mysql_fetch_assoc($view_categories);
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
        $xml_output .= "\t</row>\n";
    }
}else{
    $xml_output .= "\t<row>\n";
}

$xml_output .= "</categories>";

header("Content-type: text/xml");
echo $xml_output; 

?>

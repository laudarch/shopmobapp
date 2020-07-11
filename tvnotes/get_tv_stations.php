<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-type: text/xml"); 
session_start();
include 'database/db.php';

$query_categories = "SELECT * FROM tv_stations ORDER BY name ASC";
$view_categories = mysql_query($query_categories) or die('tv stations query failed' . mysql_error());

$xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<tvstations>\n";

for($x = 0 ; $x < mysql_num_rows($view_categories) ; $x++){
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
    // Escaping illegal characters
        $row['motto'] = str_replace("&", "&", $row['motto']);
        $row['motto'] = str_replace("<", "<", $row['motto']);
        $row['motto'] = str_replace(">", "&gt;", $row['motto']);
        $row['motto'] = str_replace("\"", "&quot;", $row['motto']);
    $xml_output .= "\t\t<motto>" . $row['motto'] . "</motto>\n";
    $xml_output .= "\t\t<blob_id>" . $row['blob_id'] . "</blob_id>\n";
    $xml_output .= "\t</row>\n";
}

$xml_output .= "</tvstations>";

echo $xml_output; 

?>

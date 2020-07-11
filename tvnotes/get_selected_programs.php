<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database/db.php';

if(isset($_REQUEST['user_id'])){
    
    if($_REQUEST['user_id'] != null && $_REQUEST['user_id'] != ""){
        $query = "SELECT * FROM prefferred_programs WHERE user_id IN (".$_REQUEST['user_id'].")";
        $result = mysql_query($query) or die($query.' prefferred programs query failed ' . mysql_error());

        $ids="";
        $row_num = mysql_num_rows($result);
        for($x = 0 ; $x < $row_num ; $x++){
            $row = mysql_fetch_assoc($result);
            $ids .= $row['program_id'];

            if($x < $row_num-1){
                $ids .= ",";
            }
        }

        error_log(">>>> INFO preferred ids: " . $ids);   
        $requestUrl = "http://www.asknanagh.com/tvnotes/get_programs.php?program_id=".$ids;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $requestUrl);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $status = curl_exec($curl_handle);
        curl_close($curl_handle);

        header("content-type: text/xml");
        echo $status;
        
    }else{
    
    $xml_output = "<?xml version=\"1.0\"?>\n";
    $xml_output .= "<programs>\n";
    $xml_output .= "<ids>user_id is empty </ids>";
    $xml_output .= "</programs>";
    
    header("Content-type: text/xml");
    echo $xml_output;
}   
}else{
    
    $xml_output = "<?xml version=\"1.0\"?>\n";
    $xml_output .= "<programs>\n";
    $xml_output .= "<ids>no user id field passed.</ids>";
    $xml_output .= "</programs>";
    
    header("Content-type: text/xml");
    echo $xml_output;
}
?>

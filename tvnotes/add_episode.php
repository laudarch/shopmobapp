<?php
session_start();
include 'database/db.php';

    $query = "SELECT * FROM programs";
    $result = mysql_query($query) or die('presenters query failed' . mysql_error());
    $row = mysql_fetch_assoc($result);
    
//    $query_category = "SELECT * FROM programs_category";
//    $result_category = mysql_query($query_category) or die('categories query failed' . mysql_error());
//    $row_category = mysql_fetch_assoc($result_category);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<!-- page title here -->
	<title>TV Notes</title>

	<link href="favicon.ico" rel="icon" type="image/x-icon">

<link rel="stylesheet" type="text/css" href="css/index.css" media="all">
</head>
<body>
<div id="central">
<div id="header">
	<h1 class="header_text">Add TV Program Episodes</h1>
</div>
<div id="bottom_shadow">
	<img alt="banner" src="img/bottom_bg.png"/>
</div>
		
		<div id="c_left">
        	<?php if(isset($_SESSION['error_msg'])){ echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); }?>
			<form name="imgUpload" action="episode_save.php" method="post" enctype="multipart/form-data">
            	
                                
<!--				<label for="abbreviation">Abbreviation:</label><br>
				<input value="" name="abbreviation" id="abbreviation" type="text"><br>-->
				<label for="country"> Select TV Program:</label><br>
				<select name="program_id" id="program_id">
<!--                                    <option value=""></option>-->
                                    <?php 
						do{
						
						echo "<option value =\"".$row['id']."\">"
							 .$row['name']."</option>";
							 
						  }while ($row = mysql_fetch_assoc($result));		
					?>
                                </select><br>
                                    
                                                                   
                                <label for="name">Episode Title:</label><br>
				<input value="" name="name" id="name" type="text"><br>
                                    
                                <label for="logo">Upload Video</label><br>
                                <input type="file" name="upload" id="upload" /><br/>
                                                                
                                <label for="history">Description:</label><br>
				<textarea rows="" cols="" name="description" id="description"></textarea><br/>              	
                                
		        <input id="submit" name="submit" value="SAVE" type="submit" />
		  </form>
		</div>
        
        <div id="c_right">
			<h2 class="bol">Related Links</h2>
			<div class="contain">			
			
                            <a href="index.php">Add TV Program</a><br/>
                	<a href="add_presenters.php">Add TV Presenter</a><br/>
                    
               
            </div>  
	
			<h2 class="bol">Call Us</h2>
			<div class="contain">
			
				<!-- your information here -->				
				<p class="contact"><img class="icon" src="img/phone.png" alt="Phone number" title="Phone number" onload="fixPNG(this)"><b>XXX - XXX - XX - XX</b></p>
				
			</div>
		</div>
        
</div>
<div id="footer">
		<div> &copy;2012 Tv Notes. All Rights Reserved</div>
</div>
</body>
</html>
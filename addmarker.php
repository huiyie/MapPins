<?php include "base.php"; ?>
<?php
	if (!empty($_POST['location']) && !empty($_POST['description'])){
		//add marker to database then redirect to main.php
		$username = mysql_real_escape_string($_SESSION['Username']);
		$name = mysql_real_escape_string($_POST['location']);
		$desc = mysql_real_escape_string($_POST['description']);
		$lat = mysql_real_escape_string($_POST['lat']);
		$lng = mysql_real_escape_string($_POST['lng']);
		
		$checkmarker = mysql_query("SELECT * FROM all_markers WHERE user = '".$username."' AND lat = '".$lat."' AND lng = '".$lng."'");
		
		if(mysql_num_rows($checkmarker) == 1){
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that marker is already recorded.</p>";
		}else{
			$addquery = mysql_query("INSERT INTO all_markers (user, name, description, lat, lng) VALUES('".$username."', '".$name."', '".$desc."', '".$lat."', '".$lng."')");
        
			if($addquery){
				?>
				<meta http-equiv="refresh" content="0;main.php">
			<?php
			}else{
				echo "<h1>Error</h1>";
				echo "<p>Adding marker failed. Please go back and try again.</p>";    
			}
		}
	}else{
		//marker is empty, redirect to main.php?>
		<meta http-equiv="refresh" content="0;main.php">
<?php			
	}

?>
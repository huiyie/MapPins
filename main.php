<?php include "base.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Map Pins</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2VR09uSpIDwG9tcWJLajlWB5B1EUCH9E"></script>
		<script language="javascript" type="text/javascript" src="js/maps.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
<body>
<?php
if(empty($_SESSION['LoggedIn']) || empty($_SESSION['Username']))
{
?>
	<meta http-equiv="refresh" content="0;index.html">
     <?php
}else
{
    ?>
	<?php
//Initialize your first couple variables
$encodedString = ""; //This is the string that will hold all your location data
$x = 0; //This is a trigger to keep the string tidy
 
//Now we do a simple query to the database
$result = mysql_query("SELECT * FROM all_markers WHERE user = '".$_SESSION['Username']."'");
 
//Multiple rows are returned
while ($row = mysql_fetch_array($result, MYSQL_NUM)){
    //This is to keep an empty first or last line from forming, when the string is split
    if ( $x == 0 ){
         $separator = "";
    }else{
         //Each row in the database is separated in the string by four *'s
         $separator = "****";
    }
    //Saving to the String, each variable is separated by three &'s
    $encodedString = $encodedString.$separator.
    "<h1><b> ".$row[2].			
    "</b></h1><br><p>".$row[3].
	"<input type='hidden' id='markerID' name='markerID' value='".$row[0]."' />".
    "</p>&&&".$row[4]."&&&".$row[5]; 	
	
	//NAME
	//DESCRIPTION
	//LAT LNG
    $x = $x + 1;
}
?>
		<input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
		
		<!-- Header -->
		<header id="header" class="skel-layers-fixed">
		<h1><a href="main.php">Map Pins</a></h1>
		<nav id="nav">
		<ul>
		<li>Hello, <?=$_SESSION['Username']?>!</li>
		<li><a href="logout.php" class="button special">Log Out</a></li>
		</ul>
		</nav>
		</header>
		
		<!-- main-->
		<div class="center"> 	
			<div id="map-canvas"></div>
		</div>
		
		<?php
			if (!empty($_POST['location']) && !empty($_POST['description'])){
		?>
			<h5><b>Name of Location:</b> <?=$_POST['location']?>
			<b>Description:</b> <?=$_POST['description']?> 
			<b>Longtitude:</b> <?=$_POST['lng']?>
			<b>Latitude:</b> <?=$_POST['lat']?></h5>	
		<?php
			}
		?>
		
		<!-- Footer -->
		<footer id="footer">
			<div class="container">
				<ul class="copyright">
					<li>&copy; Untitled. All rights reserved.</li>
				</ul>
			</div>
		</footer>
	   <?php
}
?>
</body>
</html>
<?php include "base.php"; ?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Register</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body id="top">
<?php
if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
    $email = mysql_real_escape_string($_POST['email']);
     
     $checkusername = mysql_query("SELECT * FROM users WHERE Username = '".$username."'");
      
     if(mysql_num_rows($checkusername) == 1)
     {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
     }
     else
     {
        $registerquery = mysql_query("INSERT INTO users (Username, Password, Email) VALUES('".$username."', '".$password."', '".$email."')");
        if($registerquery)
        {
            echo "<h1>Success</h1>";
            echo "<p>Your account was successfully created. Please <a href=\"login.php\">click here to login</a>.</p>";
        }
        else
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, your registration failed. Please go <a href=\"login.php\">back and try again.</a></p>";    
        }       
     }
}
else
{
    ?>
		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="main.php">Map Pins</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="main.php">Home</a></li>
						<li><a href="login.php" class="button special">Login</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper style1">
				<header class="major">
					<h2>Register</h2>
					<p>To begin your Map Pins experience, register with us now!</p>
				</header>
				<div class="container">
					<section>
						<form method="post" action="register.php" name="registerform" id="registerform">
						<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
						<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
						<label for="email">Email Address:</label><input type="text" name="email" id="email" /><br />
						<input type="submit" name="register" id="register" value="Register" />
						</form>
					</section>
				</div>
			</section>

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
<?php include "base.php"; ?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Log In</title>
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
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
?>

	<meta http-equiv="refresh" content="0;main.php">
      
     <?php
}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
     
    $checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
     
    if(mysql_num_rows($checklogin) == 1)
    {
        $row = mysql_fetch_array($checklogin);
        $email = $row['Email'];
         
        $_SESSION['Username'] = $username;
        $_SESSION['EmailAddress'] = $email;
        $_SESSION['LoggedIn'] = 1;
         
        echo "<h1>Success</h1>";
        echo "<p>Logging you in now</p>";
        echo "<meta http-equiv='refresh' content='0;main.php' />";
    }
    else
    {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, your account could not be found. Please <a href=\"login.php\">click here to try again</a>.</p>";
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
					<h2>Login</h2>
					<p>Your Map Pins experience is only a click away!</p>
				</header>
				<div class="container">
					<section>
						    <form method="post" action="login.php" name="loginform" id="loginform">
							<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
							<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
							<input type="submit" name="login" id="login" value="Login" />
							</form>
					</section>
					
					<section>
					<center>
					<p>Don't have an account?</p>
					<p><a href="register.php" class="button alt">Register Now!</a></p>
					</center>
					<section>
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
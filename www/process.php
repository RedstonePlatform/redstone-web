<?php
//process.php

$error = '';
$name = '';
$email = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("/var/secure/contact.csv", "a") or die('fopen failed');;
  $no_rows = count(file("/var/secure/contact.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'message' => $message
  );

  fputcsv($file_open, $form_data) or die('fputcsv failed;');
  fclose($file_open );

  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $message = '';
 }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Redstone Platform</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="/assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="index.html">Redstone Platform</a></h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<div class="inner">
							<h2>Menu</h2>
							<ul class="links">
								<li><a href="index.html">Home</a></li>
								<li><a href="gettingstarted.html">Download wallet</a></li>
								<li><a href="assets/Redstone_Whitepaper.pdf">Download Whitepaper</a></li>
								<li><a href="https://blockexplorer.redstoneplatform.com/block-explorer">Block Explorer</a></li>
								<li><a href="registration.php">Airdrop Registration</a></li>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<div class="logo"><span class="icon fa-diamond" style='font-size:48px;color:red'></span></div>
							<h2><?php echo $error; ?></h2>
							<a href="index.html" class="special">Home</a>
					</div>

					</section>
				<!-- Wrapper -->
				<section id="wrapper">
				</section>
				<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<div class="footer-social-icons">
							<br><h2>Follow us on</h2>
							<a href="https://github.com/redstoneplatform" class="social-icon"><i class="fab fa-github"></i></a>
							<a href="https://t.me/redstoneplatform"" class="social-icon"><i class="fab fa-telegram"></i></a>
							<a href="https://discord.gg/BCSX854" class="social-icon"><i class="fab fa-discord"></i></a>
							<a href="https://twitter.com/redstonecoin" class="social-icon"><i class="fab fa-twitter"></i></a>
							<a href="mailto:admin@redstoneplatform.com" class="social-icon"><i class="fa fa-at"></i></a>
							</div>
							<ul class="copyright">
								<li>&copy; Redstone Platform. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>

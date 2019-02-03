<?php
//index.php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
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
 //if(empty($_POST["subject"]))
 //{
 // $error .= '<p><label class="text-danger">Subject is required</label></p>';
 //}
 //else
 //{
 // $subject = clean_text($_POST["subject"]);
 //}
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
  $file_open = fopen("contact_data.csv", "a");
  $no_rows = count(file("contact_data.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'subject' => $subject,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $subject = '';
  $message = '';
 }
}

?>
<!DOCTYPE HTML>
<!--
	Solid State by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Redstone Platform</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
								<li><a href="http://test.blockexplorer.redstoneplatform.com/block-explorer">Block Explorer (Testnet)</a></li>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<div class="logo"><span class="icon fa-diamond" style='font-size:48px;color:red'></span></div>
							<h2>This is Redstone</h2>
							<p><strong>Redstone</strong> an economy to incentivise the development and operation of valuable dApps & Services.</p>
					</div>

					</section>

				<!-- Wrapper -->
					<section id="wrapper">

						<!-- One -->
							<section id="one" class="wrapper spotlight style1">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">What is Redstone</h2>
											<p><strong>Redstone</strong> provides an incentive for the community to develop and host dApps, web services, games or any software as a service (SaaS). It allows developers to crowdfund & monetise their efforts whilst providing the mechanic for the end users to make micropayments to allow them to use the dApps or web services. A marketplace for discovery of dApps, web services & will also allow for crowdsourcing software development.</p>
									</div>
								</div>
							</section>

						<!-- Two -->
							<section id="two" class="wrapper alt spotlight style2">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic02.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Who's Redstone for?</h2>
										<p><strong>Redstone</strong> is for independent full or part time developers looking to monetise their software development efforts. Operating a service node provides an income, whilst providing the underlying infrastructure & security for Redstone. Investors can earn a passive income for securing the underlying blockchain.</p>
									</div>
								</div>
							</section>

						<!-- Three -->
							<section id="three" class="wrapper spotlight style3">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Marketplace</h2>
										<p><strong>Redstone</strong> we plan to build a marketplace that will enable people to utilise community created dApps & web services. Available on the platform will be a section to enable developers to crowdfund for new dApps. We are actively researching crowdsourcing the development via microtasks / micropayments. We also want to encourage the community to operate the dApps & services by running them along side their masternodes for which they will get a share of the block rewards.</p>
										<a href="#" class="special">Learn more</a>
									</div>
								</div>
							</section>

						<!-- Four -->
						<section id="two" class="wrapper alt spotlight style2">
							<div class="inner">
								<div class="content">
									<h2 class="major">Key Features</h2>
									<p>Some of the key features of the <strong>Redstone</strong> platform:</p>
									<ul class="alt">
										<li class="icon fa-map-marker"  style='font-size:20px'> Decentralised & Distributed</li>
										<li class="icon fa-money" style='font-size:20px'> Proof of Stake</li>
										<li class="icon fa-gear" style='font-size:20px'> Service Nodes</li>
										<li class="icon fa-code" style='font-size:20px'> C# Smart Contracts</li>
										<li class="icon fa-signal" style='font-size:20px'> Side chains</li>
										<li class="icon fa-bolt" style='font-size:20px'> Oracles</li>
									</ul>
								</div>
							</div>
						</section>
					</section>
				<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<h2 class="major">Get in touch</h2>
							<p>If you want to keep up to date with all things <strong>Redstone</strong> then enter your details below and we will add you to our mailing list or sign up for one of our social media channels</p>
							<form method="post">
						    <h3 align="center">Contact Form</h3>
     						<br />
     						<?php echo $error; ?>
     						<div class="field">
     						 <label for="name">Name</label>
    						  <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $name; ?>" />
    						 </div>
    						 <div class="field">
    						  <label for="email">Email</label>
      						  <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" />
    						 </div>
							<div class="field">
							<label for="message"></label>
							<textarea name="message" id="message" rows="4" class="form-control" placeholder="message" value="<?php echo $message; ?>" /></textarea>
							</div>
							<div class="actions">
							<input type="submit" name="submit" class="btn btn-info" value="Send" />
							</div>
							</form>
							
							<ul class="contact">
								<li class="fa-github" style='font-size:20px'> <a href="https://github.com/redstoneplatform">https://github.com/redstoneplatform</a></li>
								<li class="fa-telegram" style='font-size:20px'><a href="https://t.me/redstoneplatform">t.me/redstoneplatform</a></li>
								<li class="fa-discord" style='font-size:20px'><a href="https://discord.gg/BCSX854">discord.gg/BCSX854</a></li>
								<li class="fa-envelope" style='font-size:20px'><a href="mailto:admin@redstonecoin.com">admin@redstonecoin.com</a></li>
								<li class="fa-twitter" style='font-size:20px'><a href="https://twitter.com/redstonecoin">twitter.com/redstonecoin</a></li>
							</ul>
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

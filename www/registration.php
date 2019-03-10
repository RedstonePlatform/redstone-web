<?php
require_once '/var/secure/keys.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Redstone Platform</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src='https://www.google.com/recaptcha/api.js?render=<?php echo $captcha_site_key; ?>'></script>
	</head>
	<body class="is-preload">
		<script>
			grecaptcha.ready(function() {
			// do request for recaptcha token
			// response is promise with passed token
			<?php echo $error; ?>
				grecaptcha.execute('<?php echo $captcha_site_key; ?>', {action:'validate_captcha'})
						  .then(function(token) {
					// add token value to form
					document.getElementById('g-recaptcha-response').value = token;
				});
			});
		</script>
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
								<li><a href="http://test.blockexplorer.redstoneplatform.com/block-explorer">Block Explorer (Testnet)</a></li>
								<li><a href="registration.php">Airdrop Registration</a></li>
								<li><a href="https://github.com/RedstonePlatform/Redstone/wiki">Support Wiki</a></li>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>
				<!-- Wrapper -->
				<section id="wrapper">
					<header>
						<div class="inner">
							<div class="logo"><span class="icon fa-diamond" style='font-size:48px;color:red'></span></div>
							<h2>Redstone Airdrop Registration</h2>
							<p>To register for the <strong>Redstone</strong> airdrop, please provide the following details.</p>
						</div>
					</header>

					<!-- Content -->
						<div class="wrapper">
							<div class="inner">
								<form method="post" action="register.php">
									<div class="g-recaptcha" data-sitekey="<?php echo $captcha_site_key; ?>"></div>
									<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
									<input type="hidden" name="action" value="validate_captcha">
									<div class="fields">
										<div class="field">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" required autofocus />
										</div>
										<div class="field">
											<label for="email">Email</label>
											<input type="email" name="email" id="email" required />
										</div>
										<div class="field">
											<label for="redstone_add">Redstone Address</label>
											<input type="text" name="redstone_add" id="redstone_add" required />
										</div>
										<div class="field">
											<label for="github">Github Name</label>
											<input type="text" name="github" id="github" required />
										</div>
										<div class="field">
											<label for="discord">Redstone Discord Id</label>
											<input type="text" name="discord" id="discord" required />
										</div>
										<div class="field">
											<label for="telegram">Redstone Telegram Id</label>
											<input type="text" name="telegram" id="telegram" required />
										</div>
									</div>
									<ul class="actions">				
										<li><input type="submit" value="Register" /></li>
									</ul>
								</form>
							</div>
						</div>

				</section>

			<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<br>
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

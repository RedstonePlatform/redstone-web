<?php
$error = '';
$name = '';
$email = '';
$redstone_add = '';
$github = '';
$discord = '';
$telegram = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secret = '6LeI6pAUAAAAAMEL2oevzyX5HVQfh5c4Rs5zyBa3';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);
		$recaptcha_score=$responseData->score;
        if($responseData->success):

			if(empty($_POST["name"]))
			{$error .= '<p><label class="text-danger">Please Enter your Name</label></p>';}
			else
			{
				$name = clean_text($_POST["name"]);
				if(!preg_match("/^[a-zA-Z ]*$/",$name))
					{$error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';}
			}
			if(empty($_POST["email"]))
			{$error .= '<p><label class="text-danger">Please Enter your Email</label></p>';}
				else
				{
				$email = clean_text($_POST["email"]);
				 if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				 {$error .= '<p><label class="text-danger">Invalid email format</label></p>';}
				}
			if(empty($_POST["redstone_add"]))
				{$error .= '<p><label class="text-danger">Redstone Address is required</label></p>';}
			else
				{$redstone_add = clean_text($_POST["redstone_add"]);} 
			if(empty($_POST["github"]))
				{$error .= '<p><label class="text-danger">Github ID is required</label></p>';}
			else
				{$github = clean_text($_POST["github"]);}
		   	if(empty($_POST["discord"]))
				{$error .= '<p><label class="text-danger">Discord ID is required</label></p>';}
			else 
				{$discord = clean_text($_POST["discord"]);}
		   
			if(empty($_POST["telegram"]))
				{$error .= '<p><label class="text-danger">Telegram ID is required</label></p>';}
			else
				{$telegram = clean_text($_POST["telegram"]);}

			
			$ip_add = clean_text($_SERVER['REMOTE_ADDR']);	
			if($error == '')
				$file_open = fopen("airdrop.csv", "a") or die('fopen failed');
				$no_rows = count(file("airdrop.csv"));
				if($no_rows > 1)
					{$no_rows = ($no_rows - 1) + 1;}
					$form_data = array(
			  		'sr_no'  => $no_rows,
			  		'name'  => $name,
			  		'email'  => $email,
			  		'redstone_add'  => $redstone_add,
			  		'github'  => $github,
			  		'discord'  => $discord,
			  		'telegram'  => $telegram,
			  		'ip_add' => $ip_add,
			  		'recaptcha_score' => $recaptcha_score);
		   
			 fputcsv($file_open, $form_data) or die('fputcsv failed;');
			 fclose($file_open );
		   
			 $error = '<label class="text-success">Thank you for registering for the Redstone Airdrop!</label>';
			 $name = '';
			 $email = '';
			 $redstone_add = '';
			 $github = '';
			 $discord = '';
			 $telegram = '';
			 $ip_add ='' ;
			 $recaptcha_score = '';
        else:
            $error  = '<p>Verification failed it looks like you are a bot, please retry!</p>';
        endif;
    else:
        $error  = '<p>Please retry!</a></p>';
    endif;
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
		<script src='https://www.google.com/recaptcha/api.js?render=6LeI6pAUAAAAAPdCgVajKzU4VoxQ3GLKg9A1gjlP'></script>
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
								<li><a href="../index.html">Home</a></li>
								<li><a href="../gettingstarted.html">Download wallet</a></li>
								<li><a href="../assets/Redstone_Whitepaper.pdf">Download Whitepaper</a></li>
								<li><a href="http://test.blockexplorer.redstoneplatform.com/block-explorer">Block Explorer (Testnet)</a></li>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<div class="logo"><span class="icon fa-diamond" style='font-size:48px;color:red'></span></div>
							<h2>Redstone Airdrop Registration</h2>
							<strong><?php echo $error; ?></strong>
							<a href="../index.html" class="special">Home</a>
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
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			</script>
	</body>
</html>



<?php
## reCAPTCHA V3 key define ##
#client-side
define('RECAPTCHA_SITE_KEY','6LeI6pAUAAAAAPdCgVajKzU4VoxQ3GLKg9A1gjlP'); // define here reCAPTCHA_site_key
#server-side
define('RECAPTCHA_SECRET_KEY','6LeI6pAUAAAAAMEL2oevzyX5HVQfh5c4Rs5zyBa3'); // define here reCAPTCHA_secret_key

$error = '';
$name = '';
$email = '';
$redstone_add = '';
$github = '';
$discord = '';
$telegram = '';
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
 if(empty($_POST["redstone_add"]))
 {
  $error .= '<p><label class="text-danger">Redstone Address is required</label></p>';
 }
 else
 {
  $redstone_add = clean_text($_POST["redstone_add"]);
 }

 if(empty($_POST["github"]))
 {
  $error .= '<p><label class="text-danger">Github ID is required</label></p>';
 }
 else
 {
  $github = clean_text($_POST["github"]);
 }

 if(empty($_POST["discord"]))
 {
  $error .= '<p><label class="text-danger">Discord ID is required</label></p>';
 }
 else
 {
  $discord = clean_text($_POST["discord"]);
 }

 if(empty($_POST["telegram"]))
 {
  $error .= '<p><label class="text-danger">Telegram ID is required</label></p>';
 }
 else
 {
  $telegram = clean_text($_POST["telegram"]);
 }


class Captcha{
    public function getCaptcha($SecretKey){
        $data = array(
   'secret' => RECAPTCHA_SECRET_KEY,
   'response' => $SecretKey
  );   
  $verify = curl_init();
  curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify"); 
  curl_setopt($verify, CURLOPT_POST, true);
  curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
  $response_data = curl_exec($verify);
  $response_data = json_decode($response_data);
  curl_close($verify);  
  //echo "<pre>"; print_r($response_data); echo "</pre>";
  return $response_data;
    }
}
///////////////////////////// OR /////////////////////////////
/*
class Captcha{
    public function getCaptcha($SecretKey){
        $Resposta=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".RECAPTCHA_SECRET_KEY."&response={$SecretKey}");
        $Retorno=json_decode($Resposta);
        return $Retorno;
    }
}
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
 
 //echo "<pre>"; print_r($_REQUEST); echo "</pre>";
  
 $ObjCaptcha = new Captcha();
 $Retorno = $ObjCaptcha->getCaptcha($_POST['g-recaptcha-response']); 
 
 //echo "<pre>"; print_r($Retorno); echo "</pre>";
 
 if($Retorno->success){
  echo '<p style="color: #0a860a;">CAPTCHA was completed successfully!</p>';
 }else{   
  echo '<p style="color: #f80808;">reCAPTCHA error: Check to make sure your keys match the registered domain and are in the correct locations.<br> You may also want to doublecheck your code for typos or syntax errors.</p>';
 }
}

 if($error == '')
 {
  $file_open = fopen("airdrop.csv", "a") or die('fopen failed');;
  $no_rows = count(file("airdrop.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'redstone_add'  => $redstone_add,
   'github'  => $github,
   'discord'  => $discord,
   'telegram'  => $telegram,
   'message' => $message,
   'recaptcha' => $response_data
  );

  fputcsv($file_open, $form_data) or die('fputcsv failed;');
  fclose($file_open );

  $error = '<label class="text-success">Thank you for registering with Redstone</label>';
  $name = '';
  $email = '';
  $redstone_add = '';
  $github = '';
  $discord = '';
  $telegram = '';
  $message = '';
 }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Redstone Platform</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
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
							<h2><?php echo $error; ?></h2>
							<a href="../index.html" class="special">Home</a>
					</div>

					</section>
				<!-- Wrapper -->
				<section id="wrapper">
				</section>
				<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<h2 class="major">Get in touch</h2>
							<p>If you want to keep up to date with all things <strong>Redstone</strong> then enter your details below and we will add you to our mailing list or sign up for one of our social media channels</p>
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
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			<script src="https://www.google.com/recaptcha/api.js?render=6LeI6pAUAAAAAPdCgVajKzU4VoxQ3GLKg9A1gjlP"></script>
			<script>
 				grecaptcha.ready(function() 
				{
 				grecaptcha.execute('6LeI6pAUAAAAAPdCgVajKzU4VoxQ3GLKg9A1gjlP', {action: 'homepage'}).then(function(token) 
					{  
  					document.getElementById('g-recaptcha-response').value=token;
 					});
				});
			</script>
	</body>
</html>



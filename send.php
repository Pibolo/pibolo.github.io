<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style/style.css" />
		<link rel="stylesheet" type="text/css" href="style/scrollpath.css" />
		<link rel="stylesheet" href="popin/style/styles.css" />
		<link rel="stylesheet" href="popin/style/iview.css" />
		<link rel="stylesheet" href="popin/style/popin/style.css" />
		<link rel="stylesheet" type="text/css" href="styles_form.css" />


		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<meta name="description" content="The plugin that lets you define custom scroll paths" />
		<title>Jérémy Alluin Portfolio</title>
	</head>
	<body>
		<nav class="nav-send">
			<ul>
				<li><a href="index.php">Retour au site</a></li>
			</ul>
		</nav>

		<div class="wrapper-send">
			<div class="pres-send">

				<?php
					require 'vendor/autoload.php';
					use Mailgun\Mailgun;

					# Instantiate the client.
					$mgClient = new Mailgun($_ENV["MAILGUN_API_KEY"]);
					$domain = $_ENV["MAIL_DOMAIN"];

					# Make the call to the client.
					$result = $mgClient->sendMessage($domain, array(
						'from'    => 'Pibolo Cv <mailgun@'. $domain .'>',
						'to'      => 'Nicolas Rotier <nicolas.rotier@gmail.com>',
						'subject' => "Votre cv m'interesse",
						'text'    => $_POST["message"]
						));
				?>
				</div>
		</div>


	</body>
</html>


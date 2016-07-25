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
						error_reporting(E_ALL^E_STRICT);
						# Include the Autoloader (see "Libraries" for install instructions)
						require 'vendor/autoload.php';
						use Mailgun\Mailgun;
						use Http\Adapter\Guzzle6\Client;


						# Instantiate the client.
						$client = new Client();
						$mgClient = new Mailgun('key-64bd6fa6a5f3376bc819f30849bf9947', $client);
						$domain = "sandbox2f454b62a48f439cb6abd6f5a5759dbe.mailgun.org";

						# Make the call to the client.
						$result = $mgClient->sendMessage("$domain", [
						'from'    => 'Mailgun Sandbox <postmaster@sandbox2f454b62a48f439cb6abd6f5a5759dbe.mailgun.org>',
						'to'      => 'Jeremy <jeremy.alluin@gmail.com>',
						'subject' => 'Hello Jeremy',
						'text'    => $_POST['message']
						]);
					?>
				</div>
		</div>

		
	</body>
</html>


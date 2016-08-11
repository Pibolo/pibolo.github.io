<!DOCTYPE html>
<html lang="en">
	<body>
		<nav class="nav-send">
			<ul>
				<li><a href="index.php#contact">Retour au site</a></li>
			</ul>
		</nav>

		<div class="wrapper-send">
			<div class="pres-send">

				<?php
					require 'vendor/autoload.php';
					use Mailgun\Mailgun;

					# Instantiate the client.
					$mgClient = new Mailgun(getenv('MAILGUN_API_KEY'));
					$domain = getenv('MAIL_DOMAIN');
					# Make the call to the client.
					$result = $mgClient->sendMessage($domain, array(
						'from'    => $_POST["name"] . '<'. $_POST["email"] .'>',
						'to'      => '<' . getenv('MAIL_TO') . '>',
						'subject' => "Pibolo CV",
						'text'    => $_POST["message"]
						));
				?>
				</div>
		</div>


	</body>
</html>
<?php
	header('Location: index.php#contact');
?>

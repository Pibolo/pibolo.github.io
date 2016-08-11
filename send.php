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

						function isValid($code, $ip = null)
						{
						    if (empty($code)) {
						        return false; // Si aucun code n'est entré, on ne cherche pas plus loin
						    }
						    $params = [
						        'secret'    => 	6Lf5XicTAAAAACUPrtqkDQSFAJCGP9UPAHy-cDdF,
						        'response'  => g-recaptcha-response
						    ];
						    if( $ip ){
						        $params['remoteip'] = $ip;
						    }
						    $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
						    if (function_exists('curl_version')) {
						        $curl = curl_init($url);
						        curl_setopt($curl, CURLOPT_HEADER, false);
						        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
						        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
						        $response = curl_exec($curl);
						    } else {
						        // Si curl n'est pas dispo, un bon vieux file_get_contents
						        $response = file_get_contents($url);
						    }

						    if (empty($response) || is_null($response)) {
						        return false;
						    }

						    $json = json_decode($response);
						    return $json->success;
						}
				?>
				</div>
		</div>


	</body>
</html>
<?php
	header('Location: index.php#contact');
?>

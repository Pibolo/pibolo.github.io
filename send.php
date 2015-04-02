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
				<li><a href="index.php#contact">Retour au formulaires</a></li>
			</ul>
		</nav>	
			
		<div class="wrapper-send">
			<div class="pres-send">
					<?php
					/**
					 * Page de vérification et d'envoi des messages
					 *@author Emrah Karademir <malakief@gmail.com> original @author Bryan Helmig
					 *@version 1.0
					 */

					// Adresse de réception des messages
					$sendto = '***********************';
					// Sujet du message
					$subject = 'Le sujet du Mail';
					// Message Titre lors d'une erreur de saisie
					$errormessage = 'Merci de renseigner les informations suivantes';
					// Message lors d'un envoi réussi
					$thanks = "Merci pour votre message<br />Une réponse dans les meilleurs délais vous sera apportée.";
					// Message lors d'un message frauduleux (piège à Bot)
					$honeypot = "Message frauduleux.";
					// Messages lors de champs vides
					$emptyname =  'Votre Nom';
					$emptyemail = 'Votre adresse E-mail';
					$emptytele = 'Votre numero de téléphone';
					$emptymessage = 'Votre message';
					// Messages lors d'une erreur de saisie
					$alertname =  'Merci de bien renseigner votre Nom avec des caractères standard';
					$alertemail = 'Merci de renseigner votre adresse E-mail dans ce format: <i>nom@exemple.com</i>';
					$alerttele = 'Merci de bien renseigner votre Numero de telephone dans ce format: <i>01 23 45 67 89</i>';
					$alertmessage = "Votre message semble comporter des caracteres speciaux, qui sont courant dans les adresses Web, merci de verifier.";

					// --------------------------- Code a ne pas toucher ci-dessous, à moins de savoir ce que vous faites ---------------------------------

					// Variable contenant les messages d'alertes
					$alert = '';
					// Variable vérifiant si une erreur se produit lors de la vérification avant l'envoi du message
					// Elle passe a 1 si une erreur se produit
					$pass = 0;

					// Fonction qui vérifie si le numéro comporte bien 10 chiffres
					function validerNumero($tel) {
					    //Retourne true s'il est valide, sinon false.
					    return preg_match('`^0[1-68]([-. ]?[0-9]{2}){4}$`', $tel) ? true : false;
					}


					// Fonction de nettoyage des variables pour des raisons de sécurités
					function clean_var($variable) {
					    $variable = strip_tags(stripslashes(trim(rtrim($variable))));
					    return $variable;
					}

					// Piège à Bot
					if ( empty($_POST['last']) ) {

					    // Vérification des variables
					    // Le Nom
					    if ( empty($_POST['name']) ) {
						    $pass = 1;
						    $alert .= "<li>" . $emptyname . "</li>";
					    } elseif ( ereg( "[][{}()*+?.\\^$|]", $_POST['name'] ) ) {
						    $pass = 1;
						    $alert .= "<li>" . $alertname . "</li>";
					    }
					    // Le mail
					    if ( empty($_POST['email']) ) {
						    $pass = 1;
						    $alert .= "<li>" . $emptyemail . "</li>";
					    } elseif ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
						    $pass = 1;
						    $alert .= "<li>" . $alertemail . "</li>";
					    }
					    // Le téléphone
					    /*if ( empty($_POST['tele']) ) {
						    $pass = 1;
						    $alert .= "<li>" . $emptytele . "</li>";
					    } elseif (!validerNumero($_POST['tele'] ) ) {
						    $pass = 1;
						    $alert .= "<li>" . $alerttele . "</li>";
					    }*/
					    // Le message
					    if ( empty($_POST['message']) ) {
						    $pass = 1;
						    $alert .= "<li>" . $emptymessage . "</li>";
					    }
						    // Si une erreur d'est produit, on affiche les messages adéquat
						    if ( $pass==1 ) {
							echo "<script>$(\".message\").hide(\"slow\").show(\"slow\"); </script>";
							echo "<h1>" . $errormessage . "</h1><br />";
							echo "<ul>";
							echo $alert;
							echo "</ul>";
						    // Si aucune erreur ne se produit ($pass = 0), on envoi le message
						    } else {
							$message = "De: " . clean_var($_POST['name']) . "\n";
							$message .= "Email: " . clean_var($_POST['email']) . "\n";
							$message .= "Telephone: " . clean_var($_POST['tele']) . "\n";
							$message .= "Message: \n\n" . clean_var($_POST['message']);
							$header = 'From:'. clean_var($_POST['email']);
							
							// Code d'envoi du mail
							mail($sendto, $subject, $message, $header);
							// javascript
							echo "<script>$(\".message\").hide(\"slow\").show(\"slow\").animate({opacity: 1.0}, 4000).hide(\"slow\"); $(':input').clearForm() </script>";
							echo "<b>" .$thanks. "</b>";
							die();
						    }
					// Ici on affiche le message d'erreur du piège a bot
					} else {
					    echo "<script>$(\".message\").hide(\"slow\").show(\"slow\"); </script>";
					    echo $honeypot;
					}
					?>
				</div>
		</div>

		
	</body>
</html>


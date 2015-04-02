<?php

/**
 * Form Class
 *@author Emrah Karademir
 *@version 1.0
 */

class Form
{
    public function __construct() { }
    
    public function affiche_form() {
	
	// Voici le div qui va afficher le résultat de l'envoi du message
	?>
	<div class="message"><div id="alert"></div></div>
	<?php
	// voici le formulaire de conctact
	?>
	<div>
	    <div id="contact-form">
		<form action="send.php" method="post" id="contactForm">
		<ul>
		    <li>
			<label for="name">Nom:*</label>
			<input type="text" name="name" value="" id="name" />
		    </li>
		    <li>
			<label for="email">Mail:*</label>
			<input type="text" name="email" value="" id="email" />
		    </li>
		    <li>
			<label for="tele">Téléphone:</label>
			<input type="text" name="tele" value="" id="tele" />
		    </li>
		    <li class="special">
			<label for="last">test honeypot</label>
			<input type="text" name="last" value="" id="last" />
		    </li>
		    <li>
			<label for="message">Message:*</label>
			<textarea rows="6" name="message"></textarea>
		    </li>
		    <li>
			<input class="bouton" type="submit" value="Valider" />
		    </li>
		</ul>
		</form>
	    </div>
	</div>
	<?php
    }
}
?>
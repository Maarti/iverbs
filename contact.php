<?php include('include/head-inc.php'); ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="all">
<?php include('include/header-inc.php'); ?>


<div id="corps">
<?php include('include/menu-inc.php'); ?>


<h1><img src="img/contact.png" alt="Contacter l'administrateur"/></h1> <!-- Police : Learning Curve 56px -->
<center>
<p>Pour toute information, n'hésitez pas à utiliser <a href="http://bryan.maarti.net#contact">ce formulaire</a> pour contacter l'administrateur du site.</p>
<p>Merci de contribuer au bon développement du site en rapportant les bugs et les erreurs que vous auriez pu rencontrer pendant la navigation sur le site.</p>
<p>Merci également de lire <a href="about.php#pb_connus">les problèmes connus</a> (dans le tableau "Problème rencontrés") avant d'en signaler un.</p><br/>
<!-- <?php
	/*
		********************************************************************************************
		CONFIGURATION
		********************************************************************************************
	*/
	// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
	$destinataire = 'windblow45@gmail.com';

	// copie ? (envoie une copie au visiteur)
	$copie = 'non';

	// Action du formulaire (si votre page a des paramètres dans l'URL)
	// si cette page est index.php?page=contact alors mettez index.php?page=contact
	// sinon, laissez vide
	$form_action = '';

	// Messages de confirmation du mail
	$message_envoye = "Votre message nous est bien parvenu !";
	$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

	// Message d'erreur du formulaire
	$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

	/*
		********************************************************************************************
		FIN DE LA CONFIGURATION
		********************************************************************************************
	*/

	/*
	 * cette fonction sert à nettoyer et enregistrer un texte
	 */
	function Rec($text)
	{
		$text = trim($text); // delete white spaces after & before text
		if (1 === get_magic_quotes_gpc())
		{
			$stripslashes = create_function('$txt', 'return stripslashes($txt);');
		}
		else
		{
			$stripslashes = create_function('$txt', 'return $txt;');
		}

		// magic quotes ?
		$text = $stripslashes($text);
		$text = htmlspecialchars($text, ENT_QUOTES); // converts to string with " and ' as well
		$text = nl2br($text);
		return $text;
	};

	/*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
	function IsEmail($email)
	{
		$pattern = "^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,7}$";
		return (mb_eregi($pattern,$email)) ? true : false;
	};

	$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

	// si formulaire envoyé, on récupère tous les champs. Sinon, on initialise les variables.
	$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
	$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
	$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
	$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

	if (isset($_POST['envoi']))
	{
		// On va vérifier les variables et l'email ...
		$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
		$err_formulaire = (IsEmail($email)) ? false : true;

		if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
		{
			// les 4 variables sont remplies, on génère puis envoie le mail
			$headers = 'From: '.$nom.' <'.$email.'>' . "\r\n";

			// envoyer une copie au visiteur ?
			if ($copie == 'oui')
			{
				$cible = $destinataire.','.$email;
			}
			else
			{
				$cible = $destinataire;
			};

			// Remplacement de certains caractères spéciaux
			$message = html_entity_decode($message);
			$message = str_replace('&#039;',"'",$message);
			$message = str_replace('&#8217;',"'",$message);
			$message = str_replace('<br>','',$message);
			$message = str_replace('<br />','',$message);

			// Envoi du mail
			if (mail($cible, $objet, $message, $headers))
			{
				echo '<p>'.$message_envoye.'</p>'."\n";
			}
			else
			{
				echo '<p>'.$message_non_envoye.'</p>'."\n";
			};
		}
		else
		{
			// une des 3 variables (ou plus) est vide ...
			echo '<p>'.$message_formulaire_invalide.' <a href="contact.php">Retour au formulaire</a></p>'."\n";
			$err_formulaire = true;
		};
	}; // fin du if (!isset($_POST['envoi']))

	if (($err_formulaire) || (!isset($_POST['envoi'])))
	{
		// afficher le formulaire
		echo '<center><table><tr><td><form id="contact" method="post" action="'.$form_action.'">'."\n";
		echo '	<fieldset><legend>Vos coordonnées</legend>'."\n";
		echo '		'."\n";
		echo '			<table><tr><td><label for="nom">Nom :</label></td>';
		echo '			<td><input type="text" id="nom" name="nom" value="'.stripslashes($nom).'" tabindex="1" /></td></tr>';


		echo '			<tr><td><label for="email">Email :</label></td>';
		echo '			<td><input type="text" id="email" name="email" value="'.stripslashes($email).'" tabindex="2" /></td>';

		echo '	</tr></table></fieldset>'."\n";

		echo '	<fieldset><legend>Votre message :</legend>'."\n";
		echo '		<p>'."\n";
		echo '			<table><tr><td><label for="objet">Objet :</label></td>';
		echo '			<td><input type="text" id="objet" name="objet" value="'.stripslashes($objet).'" tabindex="3" /></td></tr>';

		echo '			<tr><td><label for="message">Message :</label></td>';
		echo '			<td><textarea id="message" name="message" tabindex="4" cols="15" rows="2">'.stripslashes($message).'</textarea></td></tr>';

		echo '	</table></fieldset>'."\n";

		echo '	<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer le formulaire !" /></div>'."\n";
		echo '</form></td></tr></table></center>'."\n";
	};
?>
-->
</center>
</div>


<?php include('include/footer-inc.php'); ?>
</div>
</body>
</html>
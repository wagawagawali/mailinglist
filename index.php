<?php
session_start();

include 'config.inc.php';
include 'functions.inc.php';

if($_POST) {

	$email = trim(strip_tags($_POST['email']));

	$error = false;

	if(is_valid_email($email) == false) {

		$error = true;
	}

	else{

		$inscription = "INSERT INTO membres(email) VALUES (:email)";

		$parametres = array(":email" => $email);

		$preparedStatement = $connexion-> prepare($inscription);

		$preparedStatement->execute($parametres);

		if($preparedStatement->execute($parametres)){
		

			//$message = "Ceci est un mail de confirmation. Cliquer sur le lien pour terminer votre inscription.";
			//$sujet ="Newsletter Jacksonguitar";
			//$result = mail($email,$sujet,$message);


			$contentMail = Swift_Message::newInstance('Newsletter Jacksonguitar')

			->setSubject('Newsletter Jacksonguitar')

			->setFrom(array('alexandre@pixeline.be' => 'Jacksonguitar'))

			->setTo(array($email))

			->setBody('Ceci est un mail de confirmation. Cliquer sur le lien pour terminer votre inscription à notre newsletter');

			$sendEmail = $mailer->send($contentMail);

				 
		}
		
	}

	$db_connexion = null;

}


?>

<!DOCTYPE>

<html>
<head>

	<title>Inscription</title>
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic' rel='stylesheet' type='text/css'>

</head>
<body>

	<h1>Inscrivez vous à notre newsletter</h1>


	<?php
		if($_POST) {

			if(empty($email)) {

				echo "<p class='error_mail'>Le champ mail est vide.</p>";
			}
			elseif(is_valid_email($email) == false && $email != '') {
				echo "<p class='error_mail'>Votre adresse mail n'est pas fonctionnelle.</p>";
			}
			else{

				echo "<p class='send_mail'>Vous allez recevoir un mail de confirmation.</p>";
			}
		}
	?>
	<form method="post">
		
			<label for='email'>Email</label>

			<input class="mail_input" id="email" type="mail" placeholder="Entrez ici votre adresse mail" name="email" >
		
		
		<input type="submit" name="send" value="Inscription" class="submit">
	</form>



</body>

</html>

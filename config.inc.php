<?php

$host = 'localhost';
$db_name = 'mail';
$db_username = 'root';
$db_password = 'root';

try{

	$dsn = "mysql:host=$host;dbname=$db_name;charset=utf8";

	$connexion = new PDO($dsn, $db_username, $db_password);
}

catch(PDOException $e){

	echo $e->getMessage();
}

//mailSwift
require_once 'lib/swift_required.php';

			$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587)

			->setUsername('alexandre@pixeline.be')

			->setPassword('bDMUEuWn1H4r3FCGQjyO-g');

			$mailer = Swift_Mailer::newInstance($transport);

?>
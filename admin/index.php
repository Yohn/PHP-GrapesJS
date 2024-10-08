<?php

if (!isset($_SESSION)) {
	session_start();
}
$connfile = '../config/dbconnection.php';
if (file_exists($connfile)) {
	require_once '../config/dbconnection.php';
	require_once 'Autoload.php';

	$login = new UserClass();
	$level = new AccessLevel();

	if ($login->isLoggedIn() === true) {
		if ($level->levels() === 9) {
			header('Location: ../admin/dashboard.php');
			exit();
		} else {
			header('Location: ../users/profile.php');
			exit();
		}
	} else {

		$redirect = '../signin/login.php';
		header('Location: ' . $redirect);
		exit();
	}
} else {
	header('Location: ../installer/install.php');
	exit();
}
?>

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
	$newuser = new NewUser();
} else {
	header('Location: ../installer/install.php');
	exit();
}
?>
<?php include '../elements/header.php'; ?>
</head>
<body class="hold-transition register-page">
	<?php
	if ($login->isLoggedIn() === true) {
		header('Location: ../users/profile.php');
		exit();
	} else {
		include 'views/register.php';
		include '../elements/footer.php';
	}
	?>
</body>
</html>

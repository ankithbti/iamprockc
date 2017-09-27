<?php
	require_once('../header.php');
	unset($_SESSION['otpEmail']);

	if(!isset($_SESSION['userName'])){
		header('Location: login.php');
	}
	header('Location: ../home/home.php');
?>

<body>
<div class="container">
	<div class="alert alert-success" role="alert">Prockc Home Page</div>
	<h1>Hello! <?php echo $_SESSION['userName'] ; ?></h1>
	<a href="logout.php">Logout</a>
</div>
</body>
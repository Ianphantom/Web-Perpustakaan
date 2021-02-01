<?php
session_start();
error_reporting(0);
include("common/config.php");
if (!empty($_GET['message'])) {
	$msg = $_GET['message'];
	unset($_GET['messsage']);
}
if (isset($_POST['submit'])) {
	$name = $_POST['email'];
	$query = "SELECT * FROM anggota WHERE email='$name' and password='" . md5($_POST['password']) . "'";
	$ret = mysqli_query($con, $query);
	$num = mysqli_fetch_array($ret);
	echo $num;
	if ($num > 0) {
		echo "Hallo";
		$extra = "dashboard.php";
		$_SESSION['login'] = $_POST['email'];
		$_SESSION['id'] = $num['id'];
		$host = $_SERVER['HTTP_HOST'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 1;
		$q = "insert into userlog(username,userip,status) values('" . $_SESSION['login'] . "','$uip','$status')";
		$log = mysqli_query($con, $q);
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/user/$extra");
		exit();
	} else {
		$_SESSION['login'] = $_POST['username'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;
		$q = "insert into admlog(username,userip,status) values('" . $_SESSION['login'] . "','$uip','$status')";
		mysqli_query($con, $q);
		$error = "Email atau password tidak valid";
		$extra = "login.php";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Perpustakaan</title>
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/iconperpus.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/iconperpus.png">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="index.php">
					<img src="vendors/images/logoperpusdark.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="register.php">Register</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<?php if ($msg) { ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Selamat </strong><?php echo htmlentities($msg) ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } ?>
						<?php if ($error) { ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Maaf </strong><?php echo htmlentities($error) ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } ?>
						<div class="login-title">
							<h2 class="text-center text-primary">Selamat Datang di Perpustakaan</h2>
						</div>
						<form class="form-login" name="login" method="post">
							<div class="input-group custom">
								<input type="text" name="email" class="form-control form-control-lg" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Login</button>
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">Atau</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="register.php">Buat Akun</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>

</html>
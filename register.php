<?php
session_start();
error_reporting(0);
include("common/config.php");
if (isset($_POST['submit'])) {
	header("location:index.php?message=$msg");
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$kelamin = $_POST['gender'];
	$alamat = $_POST['alamat'];
	$nomor = $_POST['nomor'];
	$identitas = $_POST['identitas'];
	$imgfile = $_FILES['fileidentitas']['name'];
	move_uploaded_file($_FILES['fileidentitas']["tmp_name"], "user/identitas/.$imgfile");
	$query = mysqli_query($con, "insert into anggota(email,username,nama_member,gender,nomor_telepon_member,alamat_member,identitas_member,file_identitas,password)
								values('$email','$username','$nama','$gender','$nomor','$alamat','$identitas','$imgfile','$password') ");
	if ($query) {
		$msg = "Anda telah berhasil melakukan pendaftaran, silahkan melakukan login";
		header("location:index.php?message=$msg");
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
	<link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css">
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
	<script>
		function availability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>
	<script>
		function valid() {
			if (document.pendaftaran.password.value != document.pendaftaran.confirmpass.value) {
				alert("Password yang anda masukkan tidak sama  !!");
				document.pendaftaran.confirmpass.focus();
				return false;
			}
			return true;
		}
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
					<li><a href="index.php">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/register-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10">
						<div class="wizard-content">
							<form class="tab-wizard2 wizard-circle wizard" id="form" enctype="multipart/form-data" name="pendaftaran" method="post">
								<h5>Akun Kredensial</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Email Address*</label>
											<div class="col-sm-8">
												<input type="email" class="form-control" name="email" required id="email" onBlur="availability()">
												<span id="user-availability-status1" style="font-size:12px;"></span><br>
											</div>

										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Password*</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" name="password" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Confirm Password*</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" id="confirmpass" name="confirmpass" required onchange="return valid()">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Username*</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="username">
											</div>
										</div>
									</div>
								</section>
								<h5>Data diri</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Nama Lengkap</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="nama" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Jenis Kelamin*</label>
											<div class="col-sm-8">
												<div class="custom-control custom-radio custom-control-inline pb-0">
													<input type="radio" id="male" name="gender" class="custom-control-input" value="pria">
													<label class="custom-control-label" for="male">Pria</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline pb-0">
													<input type="radio" id="female" name="gender" class="custom-control-input" value="wanita">
													<label class="custom-control-label" for="female">Wanita</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Alamat</label>
											<div class="col-sm-8">
												<textarea type="text" class="form-control" name="alamat"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Nomor Telepon</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="nomor" name="nomor" onchange="myFunction()">
											</div>
										</div>
									</div>
								</section>
								<!-- Step 3 -->
								<h5>Identitas</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Jenis Identitas</label>
											<div class="col-sm-8">
												<select class="form-control selectpicker" title="Select Card Type" name="identitas" required>
													<option value="KTP">KTP</option>
													<option value="KTM">KTM</option>
													<option value="Passport">Passport</option>
													<option value="Lainnya">Lainnya</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Upload identitas</label>
											<div class="col-sm-8">
												<input type="file" name="fileidentitas" required>
											</div>
										</div>

									</div>
								</section>
								<!-- Step 4 -->
								<h5>Overview Information</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<ul class="register-info">
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Email Address</div>
													<div class="col-sm-8" id="emailUser"></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Nama Lengkap</div>
													<div class="col-sm-8" id="namaUser"></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Nomor</div>
													<div class="col-sm-8" id="nomorUser"></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Alamat</div>
													<div class="col-sm-8" id="alamat"></div>
												</div>
											</li>
										</ul>
										<div class="custom-control custom-checkbox mt-4">
											<input type="checkbox" class="custom-control-input" id="customCheck1">
											<label class="custom-control-label" for="customCheck1">Saya telah membaca dan setuju dengan syarat dan ketentuan</label>
										</div>
									</div>
									<div class="input-group mb-0">
										<button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Daftar</button>
									</div>
								</section>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- success Popup html Start -->
	<!-- <button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">Launch modal</button>
	<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
			<div class="modal-content">
				<div class="modal-body text-center font-18">
					<h3 class="mb-20">Form Telah Dikirim</h3>
					<div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
					Pendaftaran anda sedang diproses. Harap menunggu sejenak
				</div>
				<div class="modal-footer justify-content-center">
					<button class="btn btn-primary btn-lg btn-block" name="daftar" type="submit">Baik</button>
				</div>
			</div>
		</div>
	</div> -->
	<!-- success Popup html End -->
	<!-- js -->
	<script>
		// document.getElementById("nomor").addEventListener("change", myFunction);
		function myFunction() {
			document.getElementById("emailUser").innerHTML = document.pendaftaran.email.value;
			document.getElementById("namaUser").innerHTML = document.pendaftaran.nama.value;
			document.getElementById("nomorUser").innerHTML = document.pendaftaran.nomor.value;
			document.getElementById("alamat").innerHTML = document.pendaftaran.alamat.value;
		}
		// document.getElementById("confirmpass").addEventListener("change", validasi);
	</script>
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/jquery-steps/jquery.steps.js"></script>
	<script src="vendors/scripts/steps-setting.js"></script>
</body>

</html>
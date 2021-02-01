<?php session_start();
error_reporting(0);
include("../common/config.php");
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	$query = mysqli_query($con, "call getID('" . $_SESSION['login'] . "')");
	$row = mysqli_fetch_array($query);
	$id = $row['id_member'];
	if (!empty($_GET['message'])) {
		$msg = $_GET['message'];
	}
	if (isset($_POST['submit'])) {
		mysqli_free_result($riwayatBayar);
		mysqli_next_result($con);
		$jumlah = $_POST['jumlah'];
		$lama = $_POST['jumlah'] / 5000;
		$bukti = $_FILES['bukti']['name'];
		move_uploaded_file($_FILES["bukti"]["tmp_name"], "buktiIuran/.$bukti");
		$query = mysqli_query($con, "insert into biaya_langganan(id_member,jumlah_pembayaran,bukti_pembayaran,lama_langganan, status)
										values('$id','$jumlah','$bukti','$lama','not verified')");

		if ($query) {
			$msg = "Langganan Anda berhasil diperpanjang";
			header("location:pembayaranIuran.php?message=$msg");
		} else {
			$error = "Langganan gagal diperpanjang";
		}
	}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<title>Perpustakaan</title>
		<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/iconperpus.png">
		<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/iconperpus.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
		<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
		<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
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

	<body>
		<?php include("common/header.php") ?>
		<?php include("common/sidebar.php") ?>
		<div class="main-container">
			<div class="pd-ltr-20">
				<div class="card-box pd-20 height-100-p mb-30">
					<div class="row align-items-center">
						<div class="col-md-4">
							<img style="max-height: 200px;" src="../vendors/images/iuran.svg" alt="">
						</div>
						<div class="col-md-8">
							<h4 class="font-20 weight-500 mb-10 text-capitalize">
								Halo<div class="weight-600 font-30 text-blue"><?php echo htmlentities($row['nama_member']) ?></div>
							</h4>
							<p class="font-18 max-width-600">Form pengisian pembayaran biaya langganan</p>
						</div>
					</div>
				</div>
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Form Pengisian Iuran Anggota</h4>
							<h6 class="mb-30">Biaya 1 bulan langganan = Rp5.000,-</h6>
						</div>
					</div>
					<?php if ($msg) { ?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<strong>Selamat! </strong><?php echo htmlentities($msg) ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
					<?php if ($error) { ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<strong>Maaf, </strong><?php echo htmlentities($error) ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
					<form name="lama" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Jumlah Pembayaran</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" name="jumlah" placeholder="Jumlah" type="search">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Bukti Pembayaran</label>
							<div class="col-sm-12 col-md-10">
								<input type="file" class="form-control-file form-control height-auto" name="bukti">
							</div>
						</div>
						<div class="col-md-3">
							<input class="btn btn-primary btn-lg btn-block" name="submit" type="submit">
						</div>
					</form>
				</div>
				<br>
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Riwayat Pembayaran</h4>
						<?php
						$idmember = $row['id_member'];
						?>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Nama</th>
									<th>Tanggal Pembayaran</th>
									<th>Jumlah</th>
									<th>Lama Langganan</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								mysqli_free_result($q);
								mysqli_next_result($con);
								$riwayatBayar = mysqli_query($con, "select * from biaya_langganan inner join anggota on biaya_langganan.id_member = anggota.id_member where biaya_langganan.id_member='$idmember'");
								while ($rowBayar = mysqli_fetch_array($riwayatBayar)) { ?>
									<tr>
										<td class="table-plus"><?php echo htmlentities($rowBayar['nama_member']) ?></td>
										<td><?php echo htmlentities($rowBayar['tanggal_pembayaran']) ?></td>
										<td><?php echo htmlentities($rowBayar['jumlah_pembayaran']) ?></td>
										<td><?php echo htmlentities($rowBayar['lama_langganan']) ?> Bulan</td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
													<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
													<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
								<?php }
								mysqli_free_result($riwayatBayar);
								mysqli_next_result($con);
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				Perpustakaan - Final Project Sistem Basis Data Kelompok 7</a>
			</div>
		</div>
		<!-- js -->
		<script>
			function myFunction() {
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("myInput");
				filter = input.value.toUpperCase();
				table = document.getElementById("myTable");
				tr = table.getElementsByTagName("tr");
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[0];
					if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}
				}
			}
		</script>
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>
		<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="../vendors/scripts/dashboard.js"></script>
	</body>

	</html>
<?php } ?>
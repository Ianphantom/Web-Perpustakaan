<?php session_start();
error_reporting(0);
include("../common/config.php");
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	$query = mysqli_query($con, "call getID('" . $_SESSION['login'] . "')");
	$row = mysqli_fetch_array($query)
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
							<img src="../vendors/images/daftarbuku.svg" alt="">
						</div>
						<div class="col-md-8">
							<h4 class="font-20 weight-500 mb-10 text-capitalize">
								Halo<div class="weight-600 font-30 text-blue"><?php echo htmlentities($row['nama_member']) ?></div>
							</h4>
							<p class="font-18 max-width-600">Berikut adalah semua daftar buku yang tersedia pada perpustakaan kami</p>
						</div>
					</div>
				</div>
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Daftar Buku</h4>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th scope="col">Judul Buku</th>
									<th scope="col">Kategori</th>
									<th scope="col">Publisher</th>
									<th scope="col">ISBN</th>
									<th scope="col">Jumlah Stock</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								mysqli_free_result($query);
								mysqli_next_result($con);
								$q = "SELECT id_buku,nama_publisher,deskripsi_kategori,judul_buku,isbn,jumlah_buku FROM BUKU AS A INNER JOIN publisher AS B ON  A.id_publisher=B.id_publisher INNER JOIN kategori_buku AS C ON A.kode_kategori=C.kode_kategori";
								$query = mysqli_query($con, $q);

								while ($rowbuku = mysqli_fetch_array($query)) { ?>
									<tr>
										<td scope="row"><?php echo htmlentities($rowbuku['judul_buku']) ?></td>
										<td scope="row"><?php echo htmlentities($rowbuku['deskripsi_kategori']) ?></td>
										<td scope="row"><?php echo htmlentities($rowbuku['nama_publisher']) ?></td>
										<td scope="row"><?php echo htmlentities($rowbuku['isbn']) ?></td>
										<td scope="row"><?php echo htmlentities($rowbuku['jumlah_buku']) ?></td>
										<td><a href="reservedBook.php?kode=<?php echo htmlentities($rowbuku['id_buku']) ?>"><button type="button" class="btn btn-outline-success">Booking</button></a></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					Perpustakaan - Final Project Sistem Basis Data Kelompok 7</a>
				</div>
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
		<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
		<script src="../vendors/scripts/datatable-setting.js"></script>
	</body>
	<script src="../vendors/scripts/dashboard.js"></script>
	</body>

	</html>
<?php } ?>
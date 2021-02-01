<?php session_start();
error_reporting(0);
include("../common/config.php");
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	$query = mysqli_query($con, "call getID('" . $_SESSION['login'] . "')");
	$row = mysqli_fetch_array($query);
	$id = $row['id_member'];
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
							<img src="../vendors/images/riwayat.svg" alt="">
						</div>
						<div class="col-md-8">
							<h4 class="font-20 weight-500 mb-10 text-capitalize">
								Halo<div class="weight-600 font-30 text-blue"><?php echo htmlentities($row['nama_member']) ?></div>
							</h4>
							<p class="font-18 max-width-600">Berikut adalah semua daftar buku yang tersedia pada perpustakaan kami</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 mb-40">
						<div class="card-box height-100-p widget-style1">
							<div class="d-flex flex-wrap align-items-center">
								<div class="progress-data">
									<div id="chart"></div>
								</div>
								<?php
								mysqli_free_result($query);
								mysqli_next_result($con);
								$q1 = mysqli_query($con, "call cek_jumlah_peminjaman_user($id)");
								$rowpinjaman = mysqli_fetch_array($q1);
								?>
								<div class="widget-data">
									<div class="h4 mb-0"><?php echo htmlentities($rowpinjaman['jumlah_pinjaman']); ?></div>
									<div class="weight-600 font-14">Total Peminjaman</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 mb-40">
						<div class="card-box height-100-p widget-style1">
							<div class="d-flex flex-wrap align-items-center">
								<div class="progress-data">
									<div id="chart2"></div>
								</div>
								<?php
								mysqli_free_result($rowpinjaman);
								mysqli_next_result($con);
								$q2 = mysqli_query($con, "call cek_jumlah_reserved_user($id)");
								$rowpinjaman1 = mysqli_fetch_array($q2);
								?>
								<div class="widget-data">
									<div class="h4 mb-0"><?php echo htmlentities($rowpinjaman1['jumlah_pinjaman']) ?></div>
									<div class="weight-600 font-14">Reserved</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 mb-40">
						<div class="card-box height-100-p widget-style1">
							<div class="d-flex flex-wrap align-items-center">
								<div class="progress-data">
									<div id="chart3"></div>
								</div>
								<?php
								mysqli_free_result($rowpinjaman1);
								mysqli_next_result($con);
								$q3 = mysqli_query($con, "call cek_jumlah_issued_user($id)");
								$rowpinjaman3 = mysqli_fetch_array($q3);
								?>
								<div class="widget-data">
									<div class="h4 mb-0"><?php echo htmlentities($rowpinjaman3['jumlah_pinjaman']) ?></div>
									<div class="weight-600 font-14">Belum dikembalian</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="card-box">
					<div style="padding:20px;">
						<div class="weight-600 font-30 text-blue">Riwayat Peminjaman Buku</div>
					</div>
					<!-- <div class="header-left">
    <div class="menu-icon dw dw-menu"></div>
    <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
    <div class="header-search">
     <form>
      <div class="form-group mb-0">
       <i class="dw dw-search2 search-icon"></i>
        <input type="text" id="myInput" class="form-control search-input" onkeyup="myFunction()" placeholder="Cari judul buku" title="Type in a name">
       </div>
      </form>
     </div>
    </div> -->
					<table class="table table-striped text-center bg-light" id="myTable">
						<thead>
							<tr>
								<th scope="col">Judul Buku</th>
								<th scope="col">Tanggal Peminjaman</th>
								<th scope="col">Tanggal Pengembalian</th>
								<th scope="col">Denda</th>
								<th scope="col">Keterangan</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							mysqli_free_result($rowpinjaman3);
							mysqli_next_result($con);
							$q = "call history_peminjaman($id)";
							$query5 = mysqli_query($con, $q);
							while ($rowbuku = mysqli_fetch_array($query5)) { ?>
								<tr>
									<td scope="row"><?php echo htmlentities($rowbuku['judul_buku']) ?></td>
									<td scope="row"><?php echo htmlentities($rowbuku['tanggal_peminjaman']) ?></td>
									<td scope="row"><?php echo htmlentities($rowbuku['tanggal_pengembalian1']) ?></td>
									<td scope="row"><?php
													if ($rowbuku['status_peminjaman'] == "reserved") {
														echo htmlentities("-");
													} else {
														echo htmlentities($rowbuku['denda']);
													} ?></td>
									<?php
									if ($rowbuku['denda'] == '-' || $rowbuku['status_peminjaman'] == "reserved" || $rowbuku['status_peminjaman'] == "returned") { ?>
										<td scope="row">-</a></td>
									<?php } else { ?>
										<td scope="row" style="color:red">Segera Kembalikan Buku</a></td>
									<?php } ?>
									<td scope="row"><?php
											if ($rowbuku['status_peminjaman'] == "reserved") { ?>
											<button type="button" class="btn btn-sm btn-success"><?php echo htmlentities($rowbuku['status_peminjaman']) ?></button>
										<?php } else if ($rowbuku['status_peminjaman'] == "issued") { ?>
											<button type="button" class="btn btn-sm btn-warning"><?php echo htmlentities($rowbuku['status_peminjaman']) ?></button>
										<?php } else { ?>
											<button type="button" class="btn btn-sm btn-info"><?php echo htmlentities($rowbuku['status_peminjaman']) ?></button>
										<?php } ?>
									</td>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<br>
				<div class="footer-wrap pd-20 mb-20 card-box">
					DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
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
		<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="../vendors/scripts/dashboard.js"></script>
	</body>

	</html>
<?php } ?>
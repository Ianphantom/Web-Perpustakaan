<?php session_start();
error_reporting(0);
include("../common/config.php");
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	$query = mysqli_query($con, "call getID('" . $_SESSION['login'] . "')");
	$row = mysqli_fetch_array($query);
	// $set = mysql_query($con,'select * from anggota');
	// while($db = mysql_fetch_row($set)){
	// 	$dbs[] = $db[0];
	// echo implode('<br/>', $dbs);
	// }
	// $result = mysql_list_tables("anggota");
	// $num_rows = mysql_num_rows($result);
	// for ($i = 0; $i < $num_rows; $i++) {
	// 	echo "Table: ", mysql_tablename($result, $i), "\n";

	// mysql_free_result($result);

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
							<img src="../vendors/images/dashboard.svg" alt="">
						</div>
						<div class="col-md-8">
							<h4 class="font-20 weight-500 mb-10 text-capitalize">
								Welcome back <div class="weight-600 font-30 text-blue"><?php echo htmlentities($row['nama_member']) ?></div>
							</h4>
							<p class="font-18 max-width-600">Selamat datang di sistem perpustakaan ini. Silahkan menggunakan sistem ini sebaik mungkin untuk keperluan Anda</p>
						</div>
					</div>
				</div>
				<div class="card-box pd-20 height-100-p mb-30">
					<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
							<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="../vendors/images/sunny.png" alt="First slide">
								<div class="carousel-caption d-none d-md-block" style="padding:10px">
									<h5 class="color-white">Sunny Everywhere</h5>
									<p>Sunny Dahye adalah figur publik asal Korea Selatan yang eksis di media sosial.
										Perempuan yang fasih berbahasa Indonesia ini terkenal berkat video-videonya tentang
										negeri ginseng. Bulan Desember 2019 lalu, Sunny menerbitkan kumpulan kisah personalnya
										dalam buku Sunny Everywhere. Sunny juga bercerita tentang dirinya yang sempat tinggal di Bali.</p>
								</div>
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="../vendors/images/khong.png" alt="Second slide">
								<div class="carousel-caption d-none d-md-block" style="padding:10px">
									<h5 class="color-white">Perjamuan Khong Guan</h5>
									<br>
									<p>Kumpulan puisi terbaru Joko Pinurbo berjudul Perjamuan Khong Guan.
										Jokpin, begitu ia kerap disapa, membuat kaleng Khong Guan sebagai
										medium dan objek dari puisi-puisi yang diciptakannya.
										Kreasinya sungguh mengena walaupun tetap sederhana.</p>
								</div>
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="../vendors/images/pond.png" alt="Third slide">
								<div class="carousel-caption d-none d-md-block" style="padding:10px" >
									<h5 class="color-white">A Swim in a Pond in the Rain: In Which Four Russians Give
										a Master Class on Writing, Reading, and Life, George Saunders</h5>
									<p>Penulis Lincoln in the Bardo yang memenangkan Booker Prize mengundang kita untuk mempertimbangkan
										apa yang membuat fiksi berhasil dan mengapa, melalui pembedahannya terhadap cerita pendek Rusia.</p>
								</div>
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					Perpustakaan - Final Project Sistem Basis Data Kelompok 7</a>
				</div>
			</div>
		</div>
		<!-- js -->
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
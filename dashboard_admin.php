<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
 include('view/header.php');
 include('config.php');
?>
<title>Admin Page</title>
</head>
<body>
<?php
    include('view/header_admin.php');
    include('view/sidebar_admin.php');
    include('view/rightbar_admin.php');
    $sql1="SELECT * FROM anggota";
    $query1 = mysqli_query($conn, $sql1);
    $jumlah1 = mysqli_num_rows($query1);
    $sql2="SELECT * FROM buku";
    $query2 = mysqli_query($conn, $sql2);
    $jumlah2 = mysqli_num_rows($query2);
    $sql3="SELECT * FROM biaya_langganan WHERE status='verified'";
    $query3 = mysqli_query($conn, $sql3);
    $jumlah3 = mysqli_num_rows($query3);
    $sql4="SELECT * FROM data_donasi";
    $query4 = mysqli_query($conn, $sql4);
    $jumlah4 = mysqli_num_rows($query4);
?>

<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img class="d-flex justify-content-center" style="max-height: 200px;" src="vendors/images/admin.svg" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $_SESSION['nama'] ?>!</div>
                        </h4>
                        <br/>
						<p class="font-18 max-width-600">Selamat Datang <?php echo $_SESSION['nama'] ?>. Have a nice day !</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style2">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h4 mb-0"><?php echo $jumlah1; ?></div>
								<div class="weight-600 font-14">Anggota</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style2">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h4 mb-0"><?php echo $jumlah2; ?></div>
								<div class="weight-600 font-14">Buku</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style2">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h4 mb-0"><?php echo $jumlah3; ?></div>
								<div class="weight-600 font-14">Iuran (verified)</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style2">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h4 mb-0"><?php echo $jumlah4; ?></div>
								<div class="weight-600 font-14">Donasi</div>
							</div>
						</div>
					</div>
				</div>
            </div>
<?php
include "view/footer.php";
?>
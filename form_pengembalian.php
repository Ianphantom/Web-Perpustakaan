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
    <title>Form Konfirmasi Peminjaman Online</title>
    </head>
    <body>
    <?php
        if(isset($_POST['konfirmasi'])){
        include('view/header_admin.php');
        include('view/sidebar_admin.php');
        include('view/rightbar_admin.php');
        $id=$_POST['id_peminjaman'];
        $sql = "SELECT * FROM peminjaman_buku WHERE nomor_peminjaman=$id";
        $query = mysqli_query($conn, $sql);
        $peminjaman = mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query) < 1 ){
            die("data tidak ditemukan...");
        }

    ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Form Konfirmasi Pengembalian</h4>
						</div>
                    </div>
                    <br/>
					<form action="pengembalian_back.php" method="POST">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">No.peminjaman </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="id" placeholder="No.peminjaman" value="<?php echo $peminjaman['nomor_peminjaman'] ?>" readonly/>
							</div>
                        </div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Id Buku </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="bk" placeholder="Id Buku" value="<?php echo $peminjaman['id_buku'] ?>" readonly/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Tanggal Peminjaman</label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="tgl" placeholder="Tanggal Peminjaman" value="<?php echo $peminjaman['tanggal_peminjaman'] ?>"readonly/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Id Anggota </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="ang" placeholder="Id Anggota" value="<?php echo $peminjaman['id_member'] ?>" readonly/>
							</div>
                        </div>
                        <div class="form-group row">
                            <input class="btn-sm btn-primary" type="submit" value="Konfirmasi" name="konfirmasi" style="margin-left:12px"/>
                        </div>
					</form>
				</div>
				<!-- Default Basic Forms End -->
<?php
    include('view/footer.php');
    }
?>
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
    <title>Edit Buku</title>
    </head>
    <body>
    <?php
        if( !isset($_GET['id']) ){
            header('Location: buku.php');
        }
        include('view/header_admin.php');
        include('view/sidebar_admin.php');
        include('view/rightbar_admin.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM buku WHERE id_buku=$id";
        $query = mysqli_query($conn, $sql);
        $buku = mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query) < 1 ){
            die("data tidak ditemukan...");
        }        
        $publisher = $buku['id_publisher'];
        $category = $buku['kode_kategori'];
        $sql2 = "SELECT GROUP_CONCAT(id_penulis)as penulis FROM penulis_buku WHERE id_buku=$id GROUP BY (id_buku)";
        $query2 = mysqli_query($conn, $sql2);
        $penulis = mysqli_fetch_assoc($query2);

    ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Form Edit Buku</h4>
						</div>
                    </div>
                    <br/>
					<form action="edit_back.php" method="POST">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Id Buku </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="id" placeholder="Id Buku" value="<?php echo $buku['id_buku'] ?>" readonly/>
							</div>
                        </div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Judul Buku </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="judul" placeholder="Judul Buku" value="<?php echo $buku['judul_buku'] ?>"/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Penulis </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="penulis" placeholder="Penulis Buku" value="<?php echo $penulis['penulis']; ?>"/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label"></label>
							<div class="col-sm-12 col-md-10">
                                <a href="daftar_penulis.php" style="margin-left:5px">Lihat Penulis</a>
							</div>
						</div>
                        <?php
                            include ('config.php');
                            $sql2 = "SELECT * FROM publisher";
                            $query2 = mysqli_query($conn, $sql2);
                        ?>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Penerbit</label>
							<div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="penerbit" id="penerbit">
                                <option>Pilih Penerbit...</option>
                                <?php 
                                    while($penerbit = mysqli_fetch_array($query2)){ 
                                        if($publisher == $penerbit['id_publisher']){ ?>
                                            <option value="<?php echo htmlentities($penerbit['id_publisher']) ?>" selected><?php echo htmlentities($penerbit['nama_publisher']) ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo htmlentities($penerbit['id_publisher']) ?>"><?php echo htmlentities($penerbit['nama_publisher']) ?></option>
                                <?php } } ?>
                            </select>
							</div>
                        </div>
                        <?php
                            $sql3 = "SELECT * FROM kategori_buku";
                            $query3 = mysqli_query($conn, $sql3);
                        ?>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
							<div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="kategori" id="kategori">
                                <option>Pilih Kategori...</option>
                                <?php 
                                    while($kategori = mysqli_fetch_array($query3)){ 
                                        if($category == $kategori['kode_kategori']){ ?>
                                            <option value="<?php echo htmlentities($kategori['kode_kategori']) ?>" selected><?php echo htmlentities($kategori['deskripsi_kategori']) ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo htmlentities($kategori['kode_kategori']) ?>"><?php echo htmlentities($kategori['deskripsi_kategori']) ?></option>
                                <?php } } ?>
                            </select>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">ISBN </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="isbn" placeholder="ISBN" value="<?php echo $buku['isbn'] ?>"/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Jumlah </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="jumlah" placeholder="Jumlah" value="<?php echo $buku['jumlah_buku'] ?>"/>
							</div>
                        </div>
                        <div class="form-group row">
                            <input class="btn-sm btn-primary" type="submit" value="Edit" name="edit" style="margin-left:12px"/>
                        </div>
					</form>
				</div>
				<!-- Default Basic Forms End -->
<?php
    include('view/footer.php');
?>
<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("Location:admin.php");
}
?>
<?php
include('view/header.php');
?>
<title>Formulir Donasi</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>

<body>
    <?php
    include('view/header_admin.php');
    include('view/sidebar_admin.php');
    include('view/rightbar_admin.php');
    ?>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Form Donasi</h4>
                        </div>
                    </div>
                    <br />
                    <form action="donasi_back.php" method="POST">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Id anggota </label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="id" placeholder="Id anggota" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label"></label>
                            <div class="col-sm-12 col-md-10">
                                <a href="daftar_anggota.php" style="margin-left:5px">Lihat daftar anggota</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="kategori" id="kategori">
                                    <option>Pilih Kategori...</option>
                                    <option>Uang</option>
                                    <option>Buku</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Keterangan </label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan Donasi" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jumlah </label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="jumlah" placeholder="Jumlah Donasi" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class="btn-sm btn-primary" type="submit" value="Daftarkan" name="donasi" style="margin-left:12px" />
                        </div>
                    </form>
                </div>
                <!-- Default Basic Forms End -->
                <?php
                include('view/footer.php');
                ?>
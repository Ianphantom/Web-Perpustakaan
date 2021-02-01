<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include('view/header.php');
?>
    <title>Formulir Tambah Penerbit</title>
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
							<h4 class="text-blue h4">Form Tambah Penerbit</h4>
						</div>
                    </div>
                    <br/>
					<form action="pnr_back.php" method="POST">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama Penerbit </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="penerbit" placeholder="Nama Penerbit" />
							</div>
                        </div>
                        <div class="form-group row">
                            <input class="btn-sm btn-primary" type="submit" value="Tambah" name="tambah" style="margin-left:12px"/>
                        </div>
					</form>
				</div>
				<!-- Default Basic Forms End -->
<?php
    include('view/footer.php');
?>
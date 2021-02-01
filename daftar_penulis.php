<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include('view/header.php');
?>
<title>Daftar Penulis</title>
</head>
<body>
<?php
    include('view/header_admin.php');
    include('view/sidebar_admin.php');
    include('view/rightbar_admin.php');
?>
<!--<p>
            Nama anggota : <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Nama anggota">
        </p>
        <table id="tabel" border="1">
            <thead>
            <tr>
                <th scope="col">id_anggota</th>
                <th scope="col">Nama</th>
                <th scope="col">No.Telp</th>
            </tr>
            </thead>
        <tbody>

        </tbody>
        </table>
    </div>
        -->

        <!-- Responsive tables Start -->
        <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
        <div class="pd-20 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">Cari Penulis</h4>
                        </div>
                        <br/>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>
                                    <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="Nama Penulis">
                                </label>
                            </div>
                        </div>
                    </div>
					<div class="table-responsive">
						<table class="table table-striped" id="tabel">
							<thead>
								<tr>
									<th scope="col">id_penulis</th>
									<th scope="col">Nama Penulis</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                include ("config.php");

                                $sql = "SELECT * FROM penulis";
                                $query = mysqli_query($conn, $sql);

                                while($anggota = mysqli_fetch_array($query)){
                                echo "<tr>";

                                echo "<td>".$anggota['id_penulis']."</td>";
                                echo "<td>".$anggota['nama_penulis']."</td>";

                                echo "</tr>";
                                }
                            ?>
							</tbody>
						</table>
					</div>
				</div>
                <!-- Responsive tables End -->
                </div>
					</div>
                </div>
<script>
            function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabel");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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
<?php
include "view/footer.php";
?>
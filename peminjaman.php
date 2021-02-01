<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("Location:admin.php");
}
?>
<?php
include('view/header.php');
?>
<title>Daftar Peminjaman</title>
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
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Daftar Peminjaman</h4>
                        </div>
                        <br />
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>
                                    <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="Nama Anggota">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tabel">
                            <thead>
                                <tr>
                                    <th scope="col">No. Peminjaman</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Nama Anggota</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Tanggal Pengembalian</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("config.php");

                                $sql = "SELECT peminjaman_buku.nomor_peminjaman,buku.judul_buku,anggota.nama_member,peminjaman_buku.tanggal_peminjaman, peminjaman_buku.tanggal_pengembalian, peminjaman_buku.status_peminjaman FROM peminjaman_buku INNER JOIN buku, anggota WHERE peminjaman_buku.id_buku=buku.id_buku AND peminjaman_buku.id_member=anggota.id_member";
                                $query = mysqli_query($conn, $sql);

                                while ($peminjaman = mysqli_fetch_array($query)) {
                                    echo "<tr>";

                                    echo "<td>" . $peminjaman['nomor_peminjaman'] . "</td>";
                                    echo "<td>" . $peminjaman['judul_buku'] . "</td>";
                                    echo "<td>" . $peminjaman['nama_member'] . "</td>";
                                    echo "<td>" . $peminjaman['tanggal_peminjaman'] . "</td>";
                                    echo "<td>" . $peminjaman['tanggal_pengembalian'] . "</td>";
                                    if ($peminjaman['status_peminjaman'] == "reserved") {
                                        echo "<td> <span class='badge badge-primary'>" . $peminjaman['status_peminjaman'] . "</span></td>";
                                    } else if ($peminjaman['status_peminjaman'] == "issued") {
                                        echo "<td> <span class='badge badge-warning'>" . $peminjaman['status_peminjaman'] . "</span></td>";
                                    } else if ($peminjaman['status_peminjaman'] == "returned") {
                                        echo "<td> <span class='badge badge-success'>" . $peminjaman['status_peminjaman'] . "</span></td>";
                                    }

                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Responsive tables End -->
            </div>
            <?php
            include "view/footer.php";
            ?>
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
                td = tr[i].getElementsByTagName("td")[2];
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
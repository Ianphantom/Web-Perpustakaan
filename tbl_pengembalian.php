<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("Location:admin.php");
}
?>
<?php
include('view/header.php');
?>
<title>Daftar Konfirmasi Pengembalian</title>
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
                            <h4 class="text-blue h4">Daftar Konfirmasi Pengembalian</h4>
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
                                    <th scope="col">No.peminjaman</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Nama Anggota</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Konfirmasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("config.php");

                                $sql = "SELECT peminjaman_buku.nomor_peminjaman,buku.judul_buku,anggota.nama_member,staff.nama_staff ,peminjaman_buku.tanggal_peminjaman, peminjaman_buku.tanggal_pengembalian, peminjaman_buku.status_peminjaman FROM peminjaman_buku INNER JOIN buku, anggota,staff WHERE peminjaman_buku.id_buku=buku.id_buku AND peminjaman_buku.id_member=anggota.id_member AND peminjaman_buku.id_staff=staff.id_staff AND peminjaman_buku.status_peminjaman='issued' ORDER BY nomor_peminjaman";
                                $query = mysqli_query($conn, $sql);

                                while ($peminjaman = mysqli_fetch_array($query)) {
                                    echo "<form action='form_pengembalian.php' method='post'>";
                                    echo "<tr>";

                                    echo "<td><input type='hidden' name='id_peminjaman' value='" . $peminjaman['nomor_peminjaman'] . "'>" . $peminjaman['nomor_peminjaman'] . "</td>";
                                    echo "<td>" . $peminjaman['judul_buku'] . "</td>";
                                    echo "<td>" . $peminjaman['nama_member'] . "</td>";
                                    echo "<td>" . $peminjaman['tanggal_peminjaman'] . "</td>";
                                    echo "<td><button class='badge badge-primary' type='submit' name='konfirmasi'> Konfirmasi </button></td>";

                                    echo "</tr>";
                                    echo "</form>";
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
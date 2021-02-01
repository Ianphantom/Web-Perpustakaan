<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("Location:admin.php");
}
?>
<?php
include('view/header.php');
?>
<title>Daftar Iuran</title>
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
                            <h4 class="text-blue h4">Daftar Iuran</h4>
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
                                    <th scope="col">No.pembayaran</th>
                                    <th scope="col">Nama Anggota</th>
                                    <th scope="col">Jumlah Pembayaran</th>
                                    <th scope="col">Bukti Pembayaran</th>
                                    <th scope="col">Tanggal Pembayaran</th>
                                    <th scope="col">Lama Langganan</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("config.php");

                                $sql = "SELECT biaya_langganan.nomor_pembayaran,anggota.nama_member,biaya_langganan.jumlah_pembayaran,biaya_langganan.bukti_pembayaran,biaya_langganan.tanggal_pembayaran,biaya_langganan.lama_langganan,biaya_langganan.status FROM biaya_langganan INNER JOIN anggota WHERE biaya_langganan.id_member=anggota.id_member ";
                                $query = mysqli_query($conn, $sql);

                                while ($pembayaran = mysqli_fetch_array($query)) {
                                    echo "<tr>";

                                    echo "<td>" . $pembayaran['nomor_pembayaran'] . "</td>";
                                    echo "<td>" . $pembayaran['nama_member'] . "</td>";
                                    echo "<td>" . $pembayaran['jumlah_pembayaran'] . "</td>";
                                    if( $pembayaran['bukti_pembayaran']==''){ ?>
                                        <td>-</td>
                                    <?php } else{ ?>
                                        <td><?php echo htmlentities( $pembayaran['bukti_pembayaran']) ?></td>
                                    <?php }
                                    // echo "<td>" . $pembayaran['bukti_pembayaran'] . "</td>";
                                    echo "<td>" . $pembayaran['tanggal_pembayaran'] . "</td>";
                                    echo "<td>" . $pembayaran['lama_langganan'] . "</td>";
                                    if ($pembayaran['status'] == "not verified") {
                                        echo "<td> <span class='badge badge-danger'>" . $pembayaran['status'] . "</span></td>";
                                    } else if ($pembayaran['status'] == "verified") {
                                        echo "<td> <span class='badge badge-success'>" . $pembayaran['status'] . "</span></td>";
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
<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include ('config.php');

if(isset($_POST['konfirmasi'])){

    // ambil data dari formulir
    $id = $_POST['id'];
    $ptg =  $_SESSION['id'];
    $buku = $_POST['bk'];

    // buat query
    $sql = "UPDATE peminjaman_buku SET peminjaman_buku.id_staff=$ptg, peminjaman_buku.tanggal_peminjaman=current_timestamp(), peminjaman_buku.status_peminjaman='issued' WHERE peminjaman_buku.nomor_peminjaman=$id";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
            window.alert("Sukses");
            window.location.href = "tbl_peminjaman.php";
            </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "tbl_peminjaman.php";
            </script>';
    }


} else {
    die("Akses dilarang...");
}

?>
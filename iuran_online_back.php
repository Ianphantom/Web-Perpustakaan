<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include ('config.php');

if(isset($_POST['konfirmasi'])){
    $id=$_POST['id_iuran'];
    $sql = "UPDATE biaya_langganan SET status='verified' WHERE nomor_pembayaran=$id";
    $query = mysqli_query($conn, $sql);

    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
            window.alert("Sukses");
            window.location.href = "konfirmasi_iuran_online.php";
            </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "konfirmasi_iuran_online.php";
            </script>';
    }

} else {
    die("Akses dilarang...");
}

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
    $id =  $_POST['ang'];
    $jumlah = $_POST['jml'];
    $lama = $jumlah/5000;

    // buat query
    $sql = "INSERT INTO biaya_langganan (id_member, jumlah_pembayaran, tanggal_pembayaran, lama_langganan, status) VALUE ('$id','$jumlah',current_timestamp(),$lama,'verified')";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
            window.alert("Sukses");
            window.location.href = "form_iuran_offline.php";
            </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "form_iuran_offline.php";
            </script>';
    }


} else {
    die("Akses dilarang...");
}

?>
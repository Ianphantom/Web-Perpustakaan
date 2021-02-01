<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include ('config.php');

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['donasi'])){

    // ambil data dari formulir
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];

    $sql = "INSERT INTO data_donasi (id_member, jenis, jumlah, keterangan) VALUE ('$id', '$kategori', '$jumlah','$keterangan')";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: donasi_sukses.php');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: donasi_gagal.php');
    }


} else {
    die("Akses dilarang...");
}

?>
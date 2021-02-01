<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include ('config.php');

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['tambah'])){

    // ambil data dari formulir
    $penerbit = $_POST['penerbit'];

    // buat query
    $sql = "INSERT INTO publisher (nama_publisher) VALUE ('$penerbit')";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        echo '<script>
            window.alert("Sukses");
            window.location.href = "tambah_penerbit.php";
            </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "tambah_penerbit.php";
            </script>';
    }


} else {
    die("Akses dilarang...");
}

?>
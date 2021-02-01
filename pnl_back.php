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
    $penulis = $_POST['penulis'];

    // buat query
    $sql = "INSERT INTO penulis (nama_penulis) VALUE ('$penulis')";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        echo '<script>
            window.alert("Sukses");
            window.location.href = "tambah_penulis.php";
        </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "tambah_penulis.php";
        </script>';
    }


} else {
    die("Akses dilarang...");
}

?>
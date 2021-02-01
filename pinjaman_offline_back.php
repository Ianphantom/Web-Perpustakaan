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
    $ptg =  $_SESSION['id'];
    $buku = $_POST['bk'];
    $anggota = $_POST['ang'];

    // buat query
    $sql = "INSERT INTO peminjaman_buku(id_buku,id_member,id_staff,tanggal_peminjaman,status_peminjaman) VALUE ('$buku','$anggota','$ptg',current_timestamp(),'issued')";
    $query = mysqli_query($conn, $sql);
    $sql2 = "UPDATE buku SET jumlah_buku=(SELECT jumlah_buku FROM buku WHERE id_buku=$buku)-1 WHERE id_buku=$buku";
    $query2 = mysqli_query($conn, $sql2);

    // apakah query simpan berhasil?
    if( $query && $query2 ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
            window.alert("Sukses");
            window.location.href = "form_peminjaman_offline.php";
            </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "form_peminjaman_offline.php";
            </script>';
    }


} else {
    die("Akses dilarang...");
}

?>
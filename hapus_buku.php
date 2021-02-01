
<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include "config.php";
    if( !isset($_GET['id']) ){
        header('Location: buku.php');
    }
    $id = $_GET['id'];

    // buat query hapus
    $sql2 = "DELETE FROM penulis_buku WHERE id_buku=$id";
    $query2 = mysqli_query($conn, $sql2);
    $sql = "DELETE FROM buku WHERE id_buku=$id";
    $query = mysqli_query($conn, $sql);

    // apakah query hapus berhasil?
    if( $query && $query2 ){
        header('Location: buku.php');
    } else {
        die("gagal menghapus...");
    }
?>

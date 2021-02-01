<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include ('config.php');
if(isset($_POST['edit'])){

    // ambil data dari formulir
    $judul = $_POST['judul'];
    $penerbit = $_POST['penerbit'];
    $kategori = $_POST['kategori'];
    $penulis = $_POST['penulis'];
    $penulis=preg_replace("/[.,]/", " ",$penulis);
    $arr=explode(" ",$penulis);
    $isbn = $_POST['isbn'];
    $jumlah = $_POST['jumlah'];
    $id = $_POST['id'];

    // buat query
    $sql = "UPDATE buku SET judul_buku='$judul', id_publisher='$penerbit', kode_kategori='$kategori', isbn='$isbn', jumlah_buku='$jumlah' WHERE id_buku=$id";
    $query = mysqli_query($conn, $sql);

    $sql3 = "DELETE FROM penulis_buku WHERE id_buku=$id";
    $query3 = mysqli_query($conn, $sql3);
    
    foreach($arr as $array)
    {
        $sql2 = "INSERT INTO penulis_buku (id_penulis,id_buku) VALUES($array,$id)";
        $query2 = mysqli_query($conn, $sql2);
    }
    // apakah query simpan berhasil?
    if( $query && $query2) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
            window.alert("Sukses");
            window.location.href = "buku.php";
            </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "buku.php";
            </script>';
    }


} else {
    die("Akses dilarang...");
}

?>
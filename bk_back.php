<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include ('config.php');

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penulis=preg_replace("/[.,]/", " ",$penulis);
    $arr=explode(" ",$penulis);
    $penerbit = $_POST['penerbit'];
    $kategori = $_POST['kategori'];
    $isbn = $_POST['isbn'];
    $jumlah = $_POST['jumlah'];

    // buat query
    $sql = "INSERT INTO buku (id_publisher, kode_kategori, judul_buku, isbn, jumlah_buku) VALUE ('$penerbit', '$kategori', '$judul','$isbn','$jumlah')";
    $sql2 = "SELECT LAST_INSERT_ID()";
    $query = mysqli_query($conn, $sql);
    $query2 = mysqli_query($conn, $sql2);
    $id = mysqli_fetch_array($query2);
    $id_buku = $id[0];

    if( $query && $query2 ) {
        foreach($arr as $array)
        {
            $sql3= "INSERT INTO penulis_buku (id_buku, id_penulis) VALUE ('$id_buku','$array')";
            $query3 = mysqli_query($conn, $sql3);
        }
        if($query3){
        echo '<script>
            window.alert("Sukses");
            window.location.href = "tambah_buku.php";
            </script>';
        }
        else {
            // kalau gagal alihkan ke halaman indek.php dengan status=gagal
            echo '<script>
                window.alert("Gagal");
                window.location.href = "tambah_buku.php";
                </script>';
        }
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        echo '<script>
            window.alert("Gagal");
            window.location.href = "tambah_buku.php";
            </script>';
    }


} else {
    die("Akses dilarang...");
}

?>
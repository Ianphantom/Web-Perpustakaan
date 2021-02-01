<?php session_start();
    error_reporting(0);
    include("../common/config.php");
    if(strlen($_SESSION['login'])==0){ 
        header('location:index.php');
    }else {
        $query=mysqli_query($con,"select * from anggota where email='".$_SESSION['login']."'");
        $row=mysqli_fetch_array($query);
        $id_buku = $_GET['kode'];
        $id_user = $row['id_member'];
        $query2 = mysqli_query($con, "insert into peminjaman_buku(id_buku,id_member,status_peminjaman) values('$id_buku','$id_user','reserved') ");
        if($query2){
            $query3 = mysqli_query($con, "update buku set jumlah_buku=jumlah_buku-1 where id_buku='$id_buku'");
        }
        header("location:riwayat.php");
    }   
?>
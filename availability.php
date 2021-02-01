<?php 
    require_once('common/config.php');
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $q = "SELECT email from anggota where email = '$email'";
        $query = mysqli_query($con, $q);
        $num = mysqli_num_rows($query);
        if($num>0){
            echo "<span style='color:red'>Email telah digunakan</span>";
            echo "<script>('#submit').prop('disabled',true);</script>";
        }else{
            echo "<span style='color:#007bff'>Email tersedia</span>";
            echo "<script>('#submit').prop('disabled',false);</script>";
        }
    }
?>
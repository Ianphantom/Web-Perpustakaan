<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<script>
     window.alert("Gagal");
     window.location.href = "donasi_front.php";
</script>;  
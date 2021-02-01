<?php 
    session_start();
    include("../common/config.php");
    mysqli_query($con, "UPDATE userlog set logout=CURRENT_TIMESTAMP() where username='".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
    $_SESSION['login']='';
    session_unset();
?>
<script>
    document.location="../index.php";
</script>
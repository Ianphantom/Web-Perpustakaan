<?php
include ("config.php");

if(isset($_POST["masuk"]))  
 {  
           $username = $_POST['name'];
           $password = md5($_POST['password']);
           //die ($password);
           $sql = "SELECT * FROM admin WHERE username = '$username' AND password='$password'";  
           $query = mysqli_query($conn, $sql);
           $row = mysqli_fetch_array($query);
           $id = $row['id'];
           $nama = $row['username'];

           if(mysqli_num_rows($query) > 0)  
             {  
               session_start();
               $_SESSION['status'] = "login";
               $_SESSION['id'] = $id;
               $_SESSION['nama'] = $nama;
               header("Location:dashboard_admin.php");
		   }
		   else  
			{  
				echo '
                    <script>
                    window.alert("Gagal Login");
                    window.location.href = "admin.php";
                    </script>';  
			}      
}
else  
{  
	echo '
     <script>
     window.alert("Gagal Login");
     window.location.href = "admin.php";
     </script>';  
}   
 ?>
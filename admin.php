<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Admin</title>
</head>
<body>
	<?php 
	session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:login.php?pesan=gagal");
	}
 
	?>

	<?php
include 'functions.php';

?>


<?=template_header('Home')?>


<center>
<?php echo "<h4>Hai, Admin " . $_SESSION['username'] . "</h4>"; ?>
<img src="https://cdni.iconscout.com/illustration/premium/thumb/admin-lady-managing-online-data-transfer-and-security-2112384-1782204.png" alt="" width="630" height="450" con> 
</center>
<?=template_footer()?>
	
</body>
</html>

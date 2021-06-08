<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
 <?php
 if (isset($_SESSION['username'])) {
    header("Location: login.php");
}
 ?>
	
 	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Nama Pengguna dan Password tidak sesuai !</div>";
		}
	}
	?>

 
	<div class="kotak_login">
		<p class="tulisan_login">MASUK</p>
		<center>
		<img src="images/contact.jpg "alt="" width="250" height="250">
		</center>
		<form action="proses-login.php" method="post">
			
			<label>Nama Pengguna</label>
			<input type="text" name="username" class="form_login" placeholder="Nama Pengguna.." required="required">
 
			<label>Kata Sandi</label>
			<input type="password" name="password" class="form_login" placeholder=" Kata Sandi..." required="required">
 
			<input type="submit" class="tombol_login" value="Masuk">
 
			<br/>
			<p class=""><font size="2">belum punya akun ? <a href="daftar.php">Daftar</a>.</font></p>
			
			<p class=""><font size="2"><a href="index.html">Kembali ke Beranda</a>.</font></p>
			
		</form>
		
	</div>
 
 
</body>
</html>
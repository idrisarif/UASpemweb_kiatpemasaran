<!DOCTYPE html>
<?php 

include 'koneksi.php';

error_reporting(0);

session_start();

$nama = $_POST['nama'];
$level = "pengguna";
$username = $_POST['username'];
$password = $_POST['password'];
 
//$sql = "INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$username', '$password', '$level')";
//$result = mysqli_query($koneksi, $sql);

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (!empty($_POST)) {
;
		$sql = "INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$username', '$password', '$level')";

			$result = mysqli_query($koneksi, $sql);

			if ($result) {
				echo "<script>alert('Pendaftaran akun berhasil. Silahkan Masuk')</script>";
				$nama = "";
				$username = "";
				$_POST['password'] = "";
				$level = "";
				header("location:login.php");
				
			} else {
				echo "<script>alert('error')</script>";
				header("location:daftar.php");
			}
		}
		
	


?>



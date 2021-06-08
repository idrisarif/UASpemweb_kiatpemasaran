<?php 
$koneksi = mysqli_connect("localhost","root","","pemweb");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>

<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "pemweb";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) { // If Check Connection
    die("<script>alert('Connection Failed.')</script>");
}

?>
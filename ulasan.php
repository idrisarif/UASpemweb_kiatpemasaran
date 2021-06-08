

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kiat Pemasaran</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/komentar.css">
	<link rel="stylesheet" href="css/ulasan.css">
    <script src="js/emoji.js"></script>

</head>

<header>
    <div class="container"></div>
    <h1><a href="">Kiat Pemasaran</a></h1>
    <ul>
            <li><a href="index.html">Beranda</a></li>
            <li><a href="materi.html">Materi</a></li>
            <li><a href="kuis.html">Kuis</a></li>
            <li><a href="tentang.html">Tentang</a></li>
            <li><a href="login.php">Ulasan</a></li>
			 <li style=" border: 2px solid #ea112f;border-radius: 3px; background: #ea112f; color: #FFfffF;" ><a href="index.html">KELUAR</a></li>
    </ul>
    </div>
</header>





<?php 

include 'koneksi.php';

error_reporting(0); // 

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email']; 
	$comment = $_POST['comment']; 

	$sql = "INSERT INTO comments (name, email, comment)
			VALUES ('$name', '$email', '$comment')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Komentar berhasil ditambahkan')</script>";
	} else {
		echo "<script>alert('Komentar tidak bisa ditambah')</script>";
	}
}

?>
<body>
	<br>
	<br>
	<br>
	<div class="wrapper">
		<form action="ulasan.php" method="POST" class="form">
			<div class="row">
				<div class="input-group">
					<label for="name">Nama</label>
					<input type="text" name="name" id="name" placeholder="Masukkan Nama" required>
				</div>
				
			</div>
			<div class="input-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" placeholder="Masukkan Email" required>
				</div>
			<div class="input-group">
				<label for="comment">Komentar</label>
				<textarea id="comment" name="comment" placeholder="Isi Komentar" required></textarea>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Kirim</button>
			</div>

		<p> <h2>Komentar :</h2> </p>
		</form>
		<div class="prev-comments">
			<?php 
			
			$sql = "SELECT * FROM comments";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

			?>
			<div class="single-item">
				<h4><?php echo $row['name']; ?></h4>
				<a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a>
				<p><?php echo $row['comment']; ?></p>
			</div>
			<?php

				}
			}
			
			?>
		</div>
	</div>

  <div class="wrapper">
    <input type="radio" name="rate" id="star-1">
    <input type="radio" name="rate" id="star-2">
    <input type="radio" name="rate" id="star-3">
    <input type="radio" name="rate" id="star-4">
    <input type="radio" name="rate" id="star-5">	
    <div class="content">
      <div class="outer">
        <div class="emojis">
          <li class="slideImg"><img src="images/emoji-1.png" alt=""></li>
          <li><img src="images/emoji-2.png" alt=""></li>
          <li><img src="images/emoji-3.png" alt=""></li>
          <li><img src="images/emoji-4.png" alt=""></li>
          <li><img src="images/emoji-5.png" alt=""></li>
        </div>
      </div>
      <div class="stars">
        <label for="star-1" class="star-1 fas fa-star"></label>
        <label for="star-2" class="star-2 fas fa-star"></label>
        <label for="star-3" class="star-3 fas fa-star"></label>
        <label for="star-4" class="star-4 fas fa-star"></label>
        <label for="star-5" class="star-5 fas fa-star"></label>
      </div>
    </div>
    <div class="footer">
      <span class="text"></span>
      <span class="numb"></span>
    </div>
  </div>

</body>
</html>
    <footer>
        <div class="container"> 
        <small>Copyright &copy; 2021 - KiatPemasaran-Pemrograman Web PTI19A-Kelompok 5.</small>
    </footer>
    </body>
    </html>
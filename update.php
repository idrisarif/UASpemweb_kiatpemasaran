<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Hampir sama dengan create.php, tapi disini dilakukan update data bukan tambah data 
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $level = isset($_POST['level']) ? $_POST['level'] : '';
        
        // Update record
        $stmt = $pdo->prepare('UPDATE user SET id = ?, nama = ?, username = ?, password = ?, level = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $username, $password, $level, $_GET['id']]);
        $msg = 'Data berhasil diedit!';
    }
    
    $stmt = $pdo->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $pengguna = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pengguna) {
        exit('Tidak cocok!');
    }
} else {
    exit('Tidak terdeteksi!');
}
?>



<?=template_header('Read')?>

<center>
<h5>Edit Data</h5>
</center>
<div class="content update">

    <form action="update.php?id=<?=$pengguna['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="<?=$pengguna['id']?>" id="id">
        <input type="text" name="nama" value="<?=$pengguna['nama']?>" id="nama">
        <label for="username">Nama Pengguna</label>
        <label for="notelp">Kata Sandi</label>
        <input type="text" name="username" value="<?=$pengguna['username']?>" id="email">
        <input type="text" name="password" value="<?=$pengguna['password']?>" id="password"> 
        <label for="level">Level</label>
        <select name="level" style="padding: 10px;width: 400px;margin-right: 25px;margin-bottom: 15px;border: 1px solid #cccccc;">
			<option value="">---Pilih---</option>
			<option value="admin">admin</option>
			<option value="pengguna">pengguna</option>
		</select>
        <input type="submit" value="Edit">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
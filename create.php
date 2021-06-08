<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {

    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;

    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $level = isset($_POST['level']) ? $_POST['level'] : '';

    // Menambahkan data baru
    $stmt = $pdo->prepare('INSERT INTO user VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $username, $password, $level]);
    // Pesan
    $msg = 'Data berhasil ditambah!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="nama" id="nama">
        <label for="username">Username</label>
        <label for="password">Password</label>
        <input type="text" name="username" id="username">
        <input type="text" name="password" id="password">
        <label for="level">Level</label>
		<select name="level" style="padding: 10px;width: 400px;margin-right: 25px;margin-bottom: 15px;border: 1px solid #cccccc;">
			<option value="">---Pilih---</option>
			<option value="admin">admin</option>
			<option value="pengguna">pengguna</option>
		</select>
        <input type="submit" value="Tambah">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
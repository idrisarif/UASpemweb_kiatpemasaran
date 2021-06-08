<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Mengecek ID
if (isset($_GET['id'])) {
    // Memilih data yang akan dihapus
    $stmt = $pdo->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $pengguna = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pengguna) {
        exit('Tidak Ada!');
    }
    // Konfirmasi sebelum menghapus
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // kLIK TOMBOL YA JIKA MENGHAPUS DATA
            $stmt = $pdo->prepare('DELETE FROM user WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Berhasil dihapus!';
        } else {
            // kLIK TOMBOL TIDAK JIKA BATAL MENGHAPUS DATA DAN KEMBALI KE HALAMAN SEBELUMNYA
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('Tidak Ada!');
}
?>


<?=template_header('Delete')?>

<center>
<h5>Hapus Data</h5>
</center>
<div class="content delete">
	
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Yakin akan menghapus data id<?=$pengguna['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$pengguna['id']?>&confirm=yes">Ya</a>
        <a href="delete.php?id=<?=$pengguna['id']?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
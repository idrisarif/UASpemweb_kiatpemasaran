<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Mengecek ID
if (isset($_GET['id'])) {
    // Memilih data yang akan dihapus
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $pengguna = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pengguna) {
        exit('Tidak Ada');
    }
    // Konfirmasi sebelum menghapus
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // kLIK TOMBOL YA JIKA MENGHAPUS DATA
            $stmt = $pdo->prepare('DELETE FROM comments WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Berhasil dihapus!';
        } else {
            // kLIK TOMBOL TIDAK JIKA BATAL MENGHAPUS DATA DAN KEMBALI KE HALAMAN SEBELUMNYA
            header('Location: readkomen.php');
            exit;
        }
    }
} else {
    exit('Tidak Ada');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Hapus</h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Yakin akan menghapus data id<?=$pengguna['id']?>?</p>
    <div class="yesno">
        <a href="deletekomen.php?id=<?=$pengguna['id']?>&confirm=yes">Ya</a>
        <a href="deletekomen.php?id=<?=$pengguna['id']?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
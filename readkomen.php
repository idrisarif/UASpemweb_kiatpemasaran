<?php
include 'functions.php';
// Koneksi dengan database sql
$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
//  Jumlah data tiap halaman
$records_per_page = 5;


// menyiapkan database sql dan memanggil data dari tabel comments
$stmt = $pdo->prepare('SELECT * FROM comments ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Mengambil data sehingga bisa ditampilkan
$pengguna = $stmt->fetchAll(PDO::FETCH_ASSOC);


// mendapatkan jumlah data sehingga dapat memberikan tombol next dan previous
$num_pengguna = $pdo->query('SELECT COUNT(*) FROM comments')->fetchColumn();
?>


<?=template_header('Read')?>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 



 
</head>
<div class="content read">
	<center>
<h5>Lihat Data  Ulasan</h5>
</center>

	<table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Email</td>
                <td>Komentar</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengguna as $comments): ?>
            <tr>
                <td><?=$comments['id']?></td>
				<td><?=$comments['name']?></td>
                <td><?=$comments['email']?></td>
                <td><?=$comments['comment']?></td>

                <td class="actions">
                    
                    <a href="deletekomen.php?id=<?=$comments['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="readkomen.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_pengguna): ?>
		<a href="readkomen.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>
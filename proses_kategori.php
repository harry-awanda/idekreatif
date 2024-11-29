<?php 

include("config.php");

// Mulai session
session_start();

if (isset($_POST['simpan'])) {
	$category_name = $_POST['category_name'];
	$query = "INSERT INTO categories (category_name) VALUES ('$category_name')"; 
	$exec = mysqli_query($conn, $query);
	if ($exec) {
		// Simpan notifikasi ke dalam session
		$_SESSION['notification'] = [
			'type' => 'primary',
			'message' => 'Kategori berhasil ditambahkan!'
		];
	} else {
		$_SESSION['notification'] = [
			'type' => 'danger',
			'message' => 'Gagal menambahkan kategori: ' . mysqli_error($conn)
		];
	}
	header('Location: kategori.php');
	exit();
}

if (isset($_GET['category_id'])) {
	$category_id = $_GET['category_id'];
	$exec = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$category_id'");
	if ($exec) {
		$_SESSION['notification'] = [
			'type' => 'primary',
			'message' => 'Kategori berhasil dihapus!'
		];
	} else {
		$_SESSION['notification'] = [
			'type' => 'danger',
			'message' => 'Gagal menghapus kategori: ' . mysqli_error($conn)
		];
	}
	header('Location: kategori.php');
	exit();
}

if (isset($_POST['update'])) {
	$category_id = $_POST['category_id'];
	$category_name = $_POST['category_name'];
	$query = "UPDATE categories SET category_name = '$category_name' WHERE category_id='$category_id'";
	$exec = mysqli_query($conn, $query);
if ($exec) {
	$_SESSION['notification'] = [
		'type' => 'primary',
		'message' => 'Kategori berhasil diperbarui!'
	];
} else {
	$_SESSION['notification'] = [
		'type' => 'danger',
		'message' => 'Gagal memperbarui kategori: ' . mysqli_error($conn)
	];
}
header('Location: kategori.php');
exit();
}
?>
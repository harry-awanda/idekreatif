<?php 

// Menghubungkan ke file konfigurasi database
include("config.php");

// Memulai sesi untuk menyimpan notifikasi
session_start();

// Proses penambahan kategori baru
if (isset($_POST['simpan'])) {
	// Mengambil data nama kategori dari form
	$category_name = $_POST['category_name'];

	// Query untuk menambahkan data kategori ke dalam database
	$query = "INSERT INTO categories (category_name) VALUES ('$category_name')"; 
	$exec = mysqli_query($conn, $query);

	// Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
	if ($exec) {
		$_SESSION['notification'] = [
			'type' => 'primary', // Jenis notifikasi (contoh: primary untuk keberhasilan)
			'message' => 'Kategori berhasil ditambahkan!'
		];
	} else {
		$_SESSION['notification'] = [
			'type' => 'danger', // Jenis notifikasi (contoh: danger untuk kegagalan)
			'message' => 'Gagal menambahkan kategori: ' . mysqli_error($conn)
		];
	}

	// Redirect kembali ke halaman kategori
	header('Location: kategori.php');
	exit();
}

// Proses penghapusan kategori
if (isset($_GET['category_id'])) {
	// Mengambil ID kategori dari parameter URL
	$category_id = $_GET['category_id'];

	// Query untuk menghapus kategori berdasarkan ID
	$exec = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$category_id'");

	// Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
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

	// Redirect kembali ke halaman kategori
	header('Location: kategori.php');
	exit();
}

// Proses pembaruan kategori
if (isset($_POST['update'])) {
	// Mengambil data dari form pembaruan
	$category_id = $_POST['category_id'];
	$category_name = $_POST['category_name'];

	// Query untuk memperbarui data kategori berdasarkan ID
	$query = "UPDATE categories SET category_name = '$category_name' WHERE category_id='$category_id'";
	$exec = mysqli_query($conn, $query);

	// Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
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

	// Redirect kembali ke halaman kategori
	header('Location: kategori.php');
	exit();
}
?>
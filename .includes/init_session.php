<?php
session_start();

// Periksa apakah sesi username dan role sudah ada, jika tidak arahkan ke halaman login
if (empty($_SESSION["username"]) || empty($_SESSION["role"])) {
  header('Location: ./auth/login.php');
  exit(); // Pastikan script berhenti setelah pengalihan
}

// Pastikan user_id ada dalam sesi, jika tidak tampilkan pesan kesalahan dan hentikan eksekusi
if (empty($_SESSION["user_id"])) {
  echo "Error: user_id not set in the session.";
  exit();
}

// Ambil data dari sesi
$userId = $_SESSION["user_id"];
$username = $_SESSION["username"];
$name = $_SESSION["name"];
$role = $_SESSION["role"];

// Ambil notifikasi jika ada, kemudian hapus dari sesi
$notification = $_SESSION['notification'] ?? null;
if ($notification) {
  unset($_SESSION['notification']);
}
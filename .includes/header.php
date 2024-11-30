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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard &mdash; IdeKreatif</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Summernote CSS and JS -->
    <link rel="stylesheet" href="assets/vendor/css/summernote.min.css">
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <?php include 'sidemenu.php';?>
        <?php include 'navbar.php';?>
        <!-- Layout container -->
        <div class="layout-page">

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
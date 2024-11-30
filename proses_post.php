<?php
include 'config.php';

// Mulai sesi
session_start();

// Pastikan user_id tersedia di sesi
if (!isset($_SESSION["user_id"])) {
  $_SESSION['notification'] = [
    'type' => 'danger',
    'message' => 'Anda harus login terlebih dahulu.'
  ];
  header('Location: login.php');
  exit();
}

$userId = $_SESSION["user_id"];

// Handle form submission to add a new post
if (isset($_POST['simpan'])) {
  $postTitle = $_POST["post_title"];
  $content = $_POST["content"];
  $categoryId = $_POST["category_id"];
  
  // Handle image upload
  $imageDir = "assets/img/uploads/";
  $imageName = $_FILES["image"]["name"];
  $imagePath = $imageDir . basename($imageName);
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
    // Insert new post into the database
    $query = "INSERT INTO posts (post_title, content, created_at,
    category_id, user_id, image_path) VALUES ('$postTitle', '$content',
    NOW(), $categoryId, $userId, '$imagePath')";
    
    if ($conn->query($query) === TRUE) {
      $_SESSION['notification'] = [
        'type' => 'primary',
        'message' => 'Post successfully added.'
      ];
    } else {
      $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Error adding post: ' . $conn->error
      ];
    }
  } else {
    $_SESSION['notification'] = [
      'type' => 'danger',
      'message' => 'Failed to upload image.'
    ];
  }
  header('Location: dashboard.php');
  exit();
}

// Periksa apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
  $postId = $_POST['post_id'];
  $postTitle = $_POST["post_title"];
  $content = $_POST["content"];
  $categoryId = $_POST["category_id"];
  // Direktori penyimpanan gambar
  $imageDir = "assets/img/uploads/";
  // Periksa apakah ada file gambar yang diunggah
  if (!empty($_FILES["image_path"]["name"])) {
    $imageName = $_FILES["image_path"]["name"];
    $imagePath = $imageDir . $imageName;
    // Pindahkan file yang diunggah ke direktori tujuan
    move_uploaded_file($_FILES["image_path"]["tmp_name"], $imagePath);
    // Hapus gambar lama (opsional)
    $queryOldImage = "SELECT image_path FROM posts WHERE id_post = $postId";
    $resultOldImage = $conn->query($queryOldImage);
    if ($resultOldImage->num_rows > 0) {
      $oldImage = $resultOldImage->fetch_assoc()['image_path'];
      if (file_exists($oldImage)) {
        unlink($oldImage); // Hapus file lama
      }
    }
  } else {
    // Jika tidak ada file baru, gunakan gambar yang lama
    $imagePathQuery = "SELECT image_path FROM posts WHERE id_post = $postId";
    $result = $conn->query($imagePathQuery);
    $imagePath = ($result->num_rows > 0) ? $result->fetch_assoc()['image_path'] : null;
  }
  // Update post di database
  $queryUpdate = "
  UPDATE posts 
  SET post_title = '$postTitle', content = '$content', category_id = $categoryId, image_path = '$imagePath' 
  WHERE id_post = $postId";
  if ($conn->query($queryUpdate) === TRUE) {
    $_SESSION['notification'] = [
      'type' => 'primary',
      'message' => 'Postingan berhasil diperbarui.'
    ];
    header('Location: dashboard.php');
    exit();
  } else {
    $_SESSION['notification'] = [
      'type' => 'danger',
      'message' => 'Gagal memperbarui postingan.'
    ];
    header('Location: edit_post.php?post_id=' . $postId);
    exit();
  }
} else {
  $_SESSION['notification'] = [
    'type' => 'danger',
    'message' => 'Permintaan tidak valid.'
  ];
  header('Location: dashboard.php');
  exit();
}

// Handle deletion of a post
if (isset($_GET['post_id'])) {
  $postId = $_GET['post_id'];
  $queryDelete = "DELETE FROM posts WHERE id_post = $postId";
  
  if ($conn->query($queryDelete) === TRUE) {
    $_SESSION['notification'] = [
      'type' => 'primary',
      'message' => 'Post successfully deleted.'
    ];
  } else {
    $_SESSION['notification'] = [
      'type' => 'danger',
      'message' => 'Error deleting post: ' . $conn->error
    ];
  }
  header('Location: dashboard.php');
  exit();
}
?>
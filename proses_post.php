<?php 
include 'config.php';

// Start or resume the session
session_start();
// Get user_id from session (you need to set this when the user logs in)
if (isset($_SESSION["user_id"])) {
  $userId = $_SESSION["user_id"];
} else {
  // Handle the case where user_id is not set in the session
  // You might want to redirect to a login page or handle the error accordingly
  echo "Error: user_id not set in the session.";
  exit();
}

if (isset($_POST['simpan'])) {
  // Handle form submission
  $postTitle = $_POST["post_title"];
  $content = $_POST["content"];
  $categoryId = $_POST["category_id"];
  
  // Handle image upload
  $imageDir = "assets/img/uploads/"; // Sesuaikan dengan direktori tempat menyimpan gambar
  $imageName = $_FILES["image"]["name"];
  $imagePath = $imageDir . $imageName;

  move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

  // Insert new post into the database
  $query = "INSERT INTO posts (post_title, content, created_at,
  category_id, user_id,  image_path) VALUES ('$postTitle',
  '$content', NOW(), $categoryId, $userId, '$imagePath')";

  if ($conn->query($query) === TRUE) {
      // Redirect to the post list
      header('Location: dashboard.php?status=added');
      exit();
  } else {
      echo "Error: " . $query . "<br>" . $conn->error;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $postId = $_POST['post_id'];
  $postTitle = $_POST["post_title"];
  $content = $_POST["content"];
  $categoryId = $_POST["category_id"];

  // Handle image upload
  $imageDir = "assets/img/uploads/";
  $imageName = $_FILES["image"]["name"];
  $imagePath = $imageDir . $imageName;

  move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

  // Update post in the database
  $query = "UPDATE posts SET post_title='$postTitle',
  content='$content', category_id=$categoryId,  image_path='$imagePath'
  WHERE id_post=$postId";
  if ($conn->query($query) === TRUE) {
    // Panggil fungsi showToast untuk menampilkan notifikasi
    header('Location: dashboard.php?status=updated');
    exit();
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
}

if (isset($_GET['post_id'])) {
  $postId = $_GET['post_id'];

  // Hapus post dari database
  $queryDelete = "DELETE FROM posts WHERE id_post = $postId";

  if ($conn->query($queryDelete) === TRUE) {
      // Redirect kembali ke halaman yang sesuai (misalnya dashboard.php)
      header('Location: dashboard.php?status=deleted');
      exit();
  } else {
      echo "Error: " . $queryDelete . "<br>" . $conn->error;
  }
} else {
  echo "Post ID not provided.";
}
?>
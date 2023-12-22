<?php 
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['post_id'];
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $categoryId = $_POST["category_id"];

    // Update post in the database
    $query = "UPDATE posts SET post_title='$postTitle', content='$content', category_id=$categoryId WHERE id_posts=$postId";
    if ($conn->query($query) === TRUE) {
      // Panggil fungsi showToast untuk menampilkan notifikasi
      echo '<script>showToast("Post berhasil diubah", "bg-success");</script>';
      
      // Redirect to the post list
      header("Location: dashboard.php");
      exit();
  } else {
      echo "Error: " . $query . "<br>" . $conn->error;
  }
}
?>

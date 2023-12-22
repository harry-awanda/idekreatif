<?php
include '../config.php';

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Hapus post dari database
    $queryDelete = "DELETE FROM posts WHERE id_posts = $postId";

    if ($conn->query($queryDelete) === TRUE) {
        // Redirect kembali ke halaman yang sesuai (misalnya dashboard.php)
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $queryDelete . "<br>" . $conn->error;
    }
} else {
    echo "Post ID not provided.";
}
?>

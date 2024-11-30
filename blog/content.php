<?php 
include '../config.php';
include 'header.php';

// Pastikan id_post tersedia dan valid
if (isset($_GET['id_post']) && is_numeric($_GET['id_post'])) {
  $id_post = $_GET['id_post'];
  // Query untuk mendapatkan data post berdasarkan ID
  // $postQuery = "SELECT * FROM posts WHERE id_posts = $id_posts";
  $postQuery = "SELECT posts.id_post, posts.post_title, users.name as user_name, 
    posts.created_at, posts.image_path, posts.content FROM posts
    INNER JOIN users ON posts.user_id = users.user_id
    WHERE posts.id_post = $id_post";
  $postResult = mysqli_query($conn, $postQuery);
  // Pastikan post dengan ID tersebut ada
  if (mysqli_num_rows($postResult) > 0) {
    $post = mysqli_fetch_assoc($postResult);
?>
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">
    <ol>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php">Blog</a></li>
      <li><?= $post['post_title']; ?></li>
    </ol>
    <h2><?= $post['post_title']; ?></h2>
  </div>
</section>
<!-- End Breadcrumbs -->
<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-8 entries">
        <article class="entry entry-single">
          <div class="entry-img">
            <img src="../<?= $post['image_path']; ?>" alt="" class="img-fluid">
          </div>
          <h2 class="entry-title">
            <a href="#"><?= $post['post_title']; ?></a>
          </h2>
          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center">
                <i class="bi bi-person"></i><a href="#"><?= $post['user_name']; ?></a>
              </li>
              <li class="d-flex align-items-center">
                <i class="bi bi-clock"></i> <a href="#"><time><?= $post['created_at']; ?></time></a>
              </li>
            </ul>
          </div>
          <div class="entry-content">
            <p>
              <?= $post['content']; ?>
            </p>
          </div>
        </article><!-- End blog entry -->
      </div><!-- End blog entries list -->
      <?php include "sidebar.php"; ?>
    </div><!-- End blog sidebar -->
  </div>
</section><!-- End Blog Section -->

<?php
  } else {
    // Jika post tidak ditemukan
    echo "<p>Post not found.</p>";
  }
} else {
  // Jika id_post tidak tersedia atau tidak valid
  echo "<p>Invalid post ID.</p>";
}
include 'footer.php';
?>
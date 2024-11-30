<?php 
include 'config.php';
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
            <img src="<?= $post['image_path']; ?>" alt="" class="img-fluid">
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
      <div class="col-lg-4">
        <div class="sidebar">
          <h3 class="sidebar-title">Categories</h3>
          <div class="sidebar-item categories">
            <ul>
              <?php
                // Ambil data kategori dari tabel categories
                $categoryQuery = "SELECT * FROM categories";
                $categoryResult = mysqli_query($conn, $categoryQuery);
                while ($category = mysqli_fetch_assoc($categoryResult)) :
              ?>
              <li><a href="#"><?= $category['category_name']; ?></a></li>
              <?php endwhile; ?>
            </ul>
          </div><!-- End sidebar categories-->
          <h3 class="sidebar-title">Recent Posts</h3>
          <div class="sidebar-item recent-posts">
            <?php
              // Query untuk mendapatkan postingan terbaru
              $recentPostsQuery = "SELECT post_title, created_at FROM posts ORDER BY created_at DESC LIMIT 5";
              $recentPostsResult = mysqli_query($conn, $recentPostsQuery);
              while ($recentPost = mysqli_fetch_assoc($recentPostsResult)) :
            ?>
            <div class="post-item clearfix">
              <!-- Gambar post (gantilah dengan path yang sesuai jika ada) -->
              <img src="assets/blog/img/blog/blog-recent-1.jpg" alt="">
              <h4><a href="blog-single.html"><?= $recentPost['post_title']; ?></a></h4>
              <time ><?= date('M j, Y', strtotime($recentPost['created_at'])); ?></time>
            </div>
            <?php endwhile; ?>
          </div><!-- End sidebar recent posts-->
        </div><!-- End sidebar recent posts-->
      </div><!-- End sidebar -->
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
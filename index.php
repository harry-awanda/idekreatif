<?php 
include 'config.php';
include '.includes/blog/header.php';
?>
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">
    <ol>
      <li><a href="#">Home</a></li>
      <li>Blog</li>
    </ol>
    <h2>Blog</h2>
  </div>
</section><!-- End Breadcrumbs -->
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-8 entries">
        <?php
          $perPage = 5; // Jumlah konten per halaman
          $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $start = ($currentPage - 1) * $perPage;
          $query = "SELECT posts.id_post, posts.post_title, users.name as user_name, categories.category_name,
          posts.created_at, posts.image_path, posts.content FROM posts
          INNER JOIN users ON posts.user_id = users.user_id
          LEFT JOIN categories ON posts.category_id = categories.category_id
          ORDER BY posts.created_at DESC, users.name
          LIMIT $start, $perPage";
          
          $exec = mysqli_query($conn, $query);
          while ($post = mysqli_fetch_assoc($exec)) :
        ?>
        <article class="entry">
          <div class="entry-img">
            <img src="<?= $post['image_path']; ?>" alt="" class="img-fluid">
          </div>
          <h2 class="entry-title"><a href="#"><?= $post['post_title']; ?></a></h2>
          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center">
                <i class="bi bi-person"></i> <a href="#"><?= $post['user_name']; ?></a>
              </li>
              <li class="d-flex align-items-center">
                <i class="bi bi-clock"></i> <a href="#"><time><?= $post['created_at']; ?></time></a>
              </li>
            </ul>
          </div>
          <div class="entry-content">
            <p>
            <?php
              $content = $post['content'];
              $words = str_word_count($content, 1); // Memecah teks menjadi array kata
              $limitedWords = array_slice($words, 0, 30); // Mengambil 30 kata pertama
              echo implode(' ', $limitedWords); // Menggabungkan kembali array kata menjadi teks
              ?>
            </p>
            <div class="read-more">
            <a href="content.php?id_post=<?= $post['id_post']; ?>">Read More</a>
            </div>
          </div>
        </article><!-- End blog entry -->
        <?php endwhile; ?>
        <div class="blog-pagination">
          <ul class="justify-content-center">
            <?php
              $totalPages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts")) / $perPage);
              for ($i = 1; $i <= $totalPages; $i++) :
            ?>
            <li class="<?= ($i === $currentPage) ? 'active' : ''; ?>"><a href="?page=<?= $i; ?>"><?= $i; ?></a></li>
              <?php endfor; ?>
          </ul>
        </div>
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
              <h4><a href="#"><?= $recentPost['post_title']; ?></a></h4>
              <time><?= date('M j, Y', strtotime($recentPost['created_at'])); ?></time>
            </div>
            <?php endwhile; ?>
          </div><!-- End sidebar recent posts-->
        </div><!-- End sidebar recent posts-->
      </div><!-- End sidebar -->
    </div><!-- End blog sidebar -->
  </div>
</section><!-- End Blog Section -->
<?php include '.includes/blog/footer.php'; ?>
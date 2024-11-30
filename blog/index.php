<?php 
include '../config.php';
include 'header.php';
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
            <img src="../<?= $post['image_path']; ?>" alt="" class="img-fluid">
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
            // Membatasi kata-kata dengan tag HTML
            $words = preg_split('/\s+/', strip_tags($content));
            $limitedWords = array_slice($words, 0, 30);
            $limitedContent = implode(' ', $limitedWords);

            echo $limitedContent; // Menampilkan kata terbatas tanpa HTML
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
      <?php include "sidebar.php"; ?>
    </div><!-- End blog sidebar -->
  </div>
</section><!-- End Blog Section -->
<?php include 'footer.php'; ?>
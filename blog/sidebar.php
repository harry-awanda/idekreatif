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
        $recentPostsQuery = "SELECT post_title, created_at, image_path FROM posts ORDER BY created_at DESC LIMIT 5";
        $recentPostsResult = mysqli_query($conn, $recentPostsQuery);
        while ($recentPost = mysqli_fetch_assoc($recentPostsResult)) :
      ?>
      <div class="post-item clearfix">
        <!-- Gambar post (gantilah dengan path yang sesuai jika ada) -->
        <img src="../<?= $recentPost['image_path']; ?>" alt="">
        <h4><a href="#"><?= $recentPost['post_title']; ?></a></h4>
        <time><?= date('M j, Y', strtotime($recentPost['created_at'])); ?></time>
      </div>
      <?php endwhile; ?>
    </div><!-- End sidebar recent posts-->
  </div><!-- End sidebar recent posts-->
</div><!-- End sidebar -->
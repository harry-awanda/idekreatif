<?php 
include '../config.php';
include '.includes/header.php';


?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard</h4>
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="card-title text-primary">Welcome <?php echo $name; ?>! 🎉</h5>
          <p class="mb-4">You have successfully logged in as a <span class="fw-bold"><?php echo $role; ?></span>.</p>
        </div>
      </div>
      <div class="col-sm-5 text-center text-sm-left">
        <div class="card-body pb-0 px-0 px-md-4">
          <img
            src="../assets/img/illustrations/man-with-laptop-light.png"
            height="140"
            alt="View Badge User"
          />
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-xxl flex-grow-1">
  <!-- Hoverable Table rows -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>Semua Postingan</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
          <table id="datatable" class="table table-hover">
            <thead>
              <tr class="text-center">
                <th width="50px">#</th>
                <th >Judul Post</th>
                <th >Penulis</th>
                <th >Kategori</th>
                <th width="150px">Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <!-- Query untuk membaca data dari tabel Database (webspp) -->
            <?php 
              $index=1;
              $query = "SELECT posts.*, users.name as user_name, categories.category_name
              FROM posts INNER JOIN users ON posts.user_id = users.user_id
              LEFT JOIN categories ON posts.category_id = categories.category_id 
              WHERE posts.user_id = $userId";
              $exec = mysqli_query($conn,$query);
              while($category = mysqli_fetch_assoc($exec)) :
            ?>
              <tr>
                <td><?= $index++; ?></td>
                <td><?= $category['post_title']; ?></td>
                <td><?= $category['user_name']; ?></td>
                <td><?= $category['category_name']; ?></td>
                <td class="text-center">
                <a href="edit_post.php?post_id=<?php echo $category['id_posts']; ?>" class="btn btn-secondary">Edit</a>
                <!-- Tombol Hapus -->
                <a href="proses_hapus_post.php?post_id=<?php echo $category['id_posts']; ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
</div>
<!-- / Content -->

<?php include '.includes/footer.php'; ?>
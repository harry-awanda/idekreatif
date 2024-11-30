<?php 
include 'config.php';
include '.includes/header.php';
include '.includes/toast_notification.php';
$title = "Post";
?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard</h4>
  <div class="card">
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
              <!-- Query untuk membaca data dari tabel Database -->
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
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a href="edit_post.php?post_id=<?php echo $category['id_post']; ?>"
                        class="dropdown-item">
                          <i class="bx bx-edit-alt me-2"></i> Edit</a>
                        <a href="proses_post.php?post_id=<?php echo $category['id_post']; ?>"
                        class="dropdown-item">
                          <i class="bx bx-trash me-2"></i> Delete</a>
                      </div>
                    </div>
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
</div>
<!-- / Content -->
<?php include '.includes/footer.php'; ?>
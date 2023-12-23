<?php 
include '../config.php';
include '.includes/header.php';

?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Postingan Baru</h4>
  <div class="row">
    <!-- Form controls -->
    <div class="col-md-10">
      <div class="card mb-4">
        <div class="card-body">
          <form method="POST" action="proses_post.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="post_title" class="form-label">Post Title</label>
              <input type="text" class="form-control" id="post_title" name="post_title" required>
            </div>
            <div class="mb-3">
              <label for="formFile" class="form-label">Upload gambar</label>
              <input class="form-control" type="file" id="image"  name="image" accept="image/*" />
            </div>
            <div class="mb-3">
              <label for="category_id" class="form-label">Category</label>
              <select class="form-select" id="category_id" name="category_id" required>
                <!-- Fetch categories from the database and populate the options -->
                <option value="" selected disabled>Pilih salah satu</option>
                <?php
                $query = "SELECT * FROM categories";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <!-- Summernote textarea -->
              <textarea class="form-control" id="content" name="content" required></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '.includes/footer.php'; ?>
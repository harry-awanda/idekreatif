<?php 
include '../config.php';
include '.includes/header.php';

// Ambil data post yang akan diedit dari database (gantilah ini dengan metode pengambilan data yang sesuai)
$postIdToEdit = $_GET['post_id']; // Sesuaikan dengan cara Anda mendapatkan ID post yang akan di-edit
$query = "SELECT * FROM posts WHERE id_posts = $postIdToEdit";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "Post not found.";
    exit();
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Edit Postingan</h4>
  <div class="row">
    <!-- Form controls -->
    <div class="col-md-10">
      <div class="card mb-4">
        <div class="card-body">
          <form method="POST" action="proses_edit_post.php">
            <input type="hidden" name="post_id" value="<?php echo $postIdToEdit; ?>">
            <div class="mb-3">
              <label for="post_title" class="form-label">Post Title</label>
              <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post['post_title']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="category_id" class="form-label">Category</label>
              <select class="form-select" id="category_id" name="category_id" required>
                <!-- Fetch categories from the database and populate the options -->
                <option value="" selected disabled>Select one</option>
                <?php
                $queryCategories = "SELECT * FROM categories";
                $resultCategories = $conn->query($queryCategories);
                
                if ($resultCategories->num_rows > 0) {
                    while ($row = $resultCategories->fetch_assoc()) {
                        $selected = ($row["category_id"] == $post['category_id']) ? "selected" : "";
                        echo "<option value='" . $row["category_id"] . "' $selected>" . $row["category_name"] . "</option>";
                    }
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <!-- Summernote textarea -->
              <textarea class="form-control" id="content" name="content" required><?php echo $post['content']; ?></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '.includes/footer.php'; ?>
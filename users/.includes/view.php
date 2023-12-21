<?php include '../config.php';

if(isset($_POST['category_id'])) {
  $category_id = $_POST['category_id'];
  $exec = mysqli_query($conn,"SELECT * FROM categories WHERE category_id='$category_id' ");
  $category = mysqli_fetch_assoc($exec);
  ?>
  <form action="proses_kategori.php" method="POST">
    <div class="form-group">
      <input type="hidden" class="form-control" name="category_id" value="<?= $category['category_id'] ?>">
    </div>
    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" class="form-control" name="category_name" value="<?= $category['category_name'] ?>">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      <button type="Submit" name="update" class="btn btn-warning">Update</button>
    </div>
  </form>
<?php }

?>

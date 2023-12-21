s<?php 
include '../config.php';
include '.includes/header.php';

?>

<!-- Bootstrap Toast -->
<div id="toastAdd" class="bs-toast toast fade bg-primary position-absolute m-3 end-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    <div class="me-auto fw-semibold">Data berhasil ditambahkan.</div>
  </div>
</div>
<!-- Bootstrap Toast -->
<div id="toastUpdate" class="bs-toast toast fade bg-primary position-absolute m-3 end-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    <div class="me-auto fw-semibold">Data berhasil di update.</div>
  </div>
</div>
<!-- Bootstrap Toast -->
<div id="toastDelete" class="bs-toast toast fade bg-primary position-absolute m-3 end-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    <div class="me-auto fw-semibold">Data berhasil dihapus.</div>
  </div>
</div>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Kategori</h4>
  <!-- Hoverable Table rows -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>Data Kategori</h4>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Tambah Kategori
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
          <table id="datatable" class="table table-hover">
            <thead>
              <tr class="text-center">
                <th width="50px">#</th>
                <th >Nama</th>
                <th width="150px">Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <!-- Query untuk membaca data dari tabel Database (webspp) -->
            <?php 
              $index=1;
              $query = "SELECT * FROM categories";
              $exec = mysqli_query($conn,$query);
              while($category = mysqli_fetch_assoc($exec)) :
            ?>
              <tr>
                <td><?= $index++; ?></td>
                <td><?= $category['category_name']; ?></td>
                <td class="text-center">
                  <button type="button" class="view_data btn btn-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal" id="<?= $category['category_id']; ?>" ?>Edit
                  </button>
                  <!-- Tombol untuk menampilkan modal konfirmasi hapus kategori -->
                  <a href="proses_kategori.php?category_id=<?= $category['category_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?')">Hapus</a>
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

<?php include '.includes/footer.php'; ?>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form action="proses_kategori.php" method="POST" >
              <div>
                <label for="namaKategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" name="category_name"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Batal
                </button>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Update Kategori -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Update Data Kategori</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body" id="datakategori">
            <!-- form edit data kelas dipisah ke dalam file view.php -->
          </div>
        </div>
      </div>
    </div>

    <script>
      $('.view_data').click(function(){
        let categoryID = $(this).attr('id');
        $.ajax({
          url: '.includes/view.php',
          method: 'POST',
          data: {category_id:categoryID},
          success:function(data){
            $('#datakategori').html(data)
            $('#editCategoryModal').modal('show');
          }
        })
      })
    </script>
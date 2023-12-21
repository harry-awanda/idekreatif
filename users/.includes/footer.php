            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="#" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="#" target="_blank" class="footer-link me-4">Support</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <?php
    if (isset($_GET["status"]) && $_GET["status"] == "added") {
      echo '<script>
              $(document).ready(function(){
                  $("#toastAdd").toast("show");
              });
              </script>';
            }
    elseif (isset($_GET["status"]) && $_GET["status"] == "updated") {
      echo '<script>
              $(document).ready(function(){
                  $("#toastUpdate").toast("show");
              });
              </script>';
            }
    elseif (isset($_GET["status"]) && $_GET["status"] == "deleted") {
      echo '<script>
              $(document).ready(function(){
                  $("#toastDelete").toast("show");
              });
              </script>';
            }
    ?>
    <script>
      $(document).ready(function() {
        $('#datatable').DataTable();
      } );
    </script>
    <script>
    // Get the current page URL
    var currentUrl = window.location.href;
    // Iterate through each menu item and check if the href matches the current URL
    document.querySelectorAll('.menu-item').forEach(function(item) {
        var link = item.querySelector('a');
        if (link && link.href === currentUrl) {
            item.classList.add('active');
        }
    });
</script>
  </body>
</html>
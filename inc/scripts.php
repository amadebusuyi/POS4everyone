

<!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

  <?php if($_GET['page'] == "login"): ?>
  <script src="assets/js/login.js"></script>
  <?php else: ?>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/dashboard.js?v=1.2.0"></script>
  <script src="assets/js/charts.js?v=1.2.0"></script>
  <!-- Demo JS - remove this in your project board. -->
  <script src="assets/js/demo.min.js"></script>

  <script src="assets/js/script.js"></script>    
  <script src="assets/js/functions.js"></script>    
  <script src="assets/vendor/template7/dist/template7.min.js"></script>
  <script src="assets/js/main.js"></script> 

  <?php endif; ?>
</body>

</html>
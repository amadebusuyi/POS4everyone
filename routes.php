  <?php require "inc/nav.php"; ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include "inc/top-nav.php"; ?>

    <?php 

        if(isset($_GET['page'])){
          $page = trim($_GET['page']);

          if($page == "dashboard"){
            if($_SESSION['role'] > 0)
              require "pages/dashboard.php";
            else
              redirect("./sales");
          }

          elseif($page == "dashboarda"){
              require "pages/dashboarda.php";
          }

          elseif($page == "receipt"){
              require "pages/receipt.php";
          }

          elseif($page == "profile"){
            require "pages/profile.php";
          }

          elseif($page == "sales"){
            require "pages/sales.php";
          }

          elseif($page == "sales-history"){
            require "pages/sales_history.php";
          }

          elseif($page == "staff"){
            if($_SESSION['role'] > 0)
              require "pages/staff.html";
            else
              redirect("./sales");
          }

          elseif($page == "categories"){
            if($_SESSION['role'] > 0)
              require "pages/categories.html";
            else
              redirect("./sales");
          }

          elseif($page == "customers"){
            if($_SESSION['role'] > 0)
              require "pages/customers.html";
            else
              redirect("./sales");
          }

          elseif($page == "suppliers"){
            if($_SESSION['role'] > 0)
              require "pages/suppliers.html";
            else
              redirect("./sales");
          }

          elseif($page == "sales-data"){
            if($_SESSION['role'] == 2)
              require "pages/sales_data.php";
            else
              redirect("./sales");
          }

          elseif($page == "products"){
            require "pages/products.php";
          }

          elseif($page == "logout"){
            require "pages/logout.php";
          }

          else{
            redirect("./dashboard");
          }

        }

        else{
          redirect("./dashboard");
        }

     ?>
      
    <?php include "inc/footer.html"; ?>
    </div>
  </div>
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main" style="z-index: 1045 !important">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  d-flex  align-items-center">
        <a class="navbar-brand" href="./home">
          PelseyGold
        </a>
        <div class=" ml-auto ">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->

          <ul class="navbar-nav">
            <?php if($_SESSION['role'] != 0): ?>
            <li class="nav-item">
              <a class="nav-link <?php if($_GET['page'] == "dashboard"){echo "active";} ?>" href="./dashboard">
                <i class="fa fa-industry text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link <?php if($_GET['page'] == "sales"){echo "active";} ?>" href="./sales">
                <i class="fa fa-spinner text-primary"></i>
                <span class="nav-link-text">Sales</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($_GET['page'] == "sales-history"){echo "active";} ?>" href="./sales-history">
                <i class="fa fa-clock text-primary"></i>
                <span class="nav-link-text">Sales History</span>
              </a>
            </li>
            <?php if($_SESSION['role'] != 0): ?>
            <li class="nav-item">
              <a class="nav-link <?php if($_GET['page'] == "staff"){echo "active";} ?>" href="./staff">
                <i class="fa fa-users text-primary"></i>
                <span class="nav-link-text">Staff</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($_GET['page'] == "customers"){echo "active";} ?>" href="./customers">
                <i class="fa fa-users text-primary"></i>
                <span class="nav-link-text">Customers</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($_GET['page'] == "categories" || $_GET['page'] == "products" || $_GET['page'] == "suppliers"){echo "active";} ?>" href="#navbar-commodities" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-commodities">
                <i class="fa fa-box text-primary"></i>
                <span class="nav-link-text">Commodities</span>
              </a>
              <div class="collapse show" id="navbar-commodities">
                <ul class="nav nav-sm flex-column">
                  
                  <li class="nav-item">
                    <a href="./categories" class="nav-link <?php if($_GET['page'] =="categories"){echo "active";} ?>">
                      <span class="sidenav-mini-icon"> C </span>
                      <span class="sidenav-normal"> Categories </span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="./suppliers" class="nav-link <?php if($_GET['page'] =="suppliers"){echo "active";} ?>">
                      <span class="sidenav-mini-icon"> S </span>
                      <span class="sidenav-normal"> Suppliers </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./products" class="nav-link <?php if($_GET['page'] =="products"){echo "active";} ?>">
                      <span class="sidenav-mini-icon"> P </span>
                      <span class="sidenav-normal"> Products </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <?php endif; ?>
            <?php if($_SESSION['role'] == 2): ?>
              <li class="nav-item">
              <a class="nav-link <?php if($_GET['page'] == "sales-data" || $_GET['page'] == "new-order" || $_GET['page'] == "suppliersa"){echo "active";} ?>" href="#navbar-analytics" data-toggle="collapse" role="button">
                <i class="fa fa-box text-primary"></i>
                <span class="nav-link-text">Analytics</span>
              </a>
              <div class="collapse show" id="navbar-analytics">
                <ul class="nav nav-sm flex-column">
                  
                  <li class="nav-item">
                    <a href="./sales-data" class="nav-link <?php if($_GET['page'] =="sales-data"){echo "active";} ?>">
                      <span class="sidenav-mini-icon"> S </span>
                      <span class="sidenav-normal"> Sales Data </span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="./new-order" class="nav-link <?php if($_GET['page'] =="new-order"){echo "active";} ?>">
                      <span class="sidenav-mini-icon"> N </span>
                      <span class="sidenav-normal"> New Order </span>
                    </a>
                  </li><!-- 
                  <li class="nav-item">
                    <a href="./products" class="nav-link <?php if($_GET['page'] =="products"){echo "active";} ?>">
                      <span class="sidenav-mini-icon"> P </span>
                      <span class="sidenav-normal"> Products </span>
                    </a>
                  </li> -->
                </ul>
              </div>
            </li>
          <?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
  </nav>
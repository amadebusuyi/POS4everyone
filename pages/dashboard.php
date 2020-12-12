<?php 
require "process/conn.php";
// require "process/functions.php";

$conn = $pdo->open();

$dateNow = date("Y-m-d H:i:s");
// CUSTOMER'S INFO

$query = $conn->prepare("SELECT * from customers where deleted = 0");
$query->execute();
$customer_count = 0;
$new_customer = 0;
while($customer_row = $query->fetch()){
  if(getMonth($customer_row['created_at']) === getMonth($dateNow)){
    $new_customer++;
  }
  $customer_count++;
}

if($new_customer > 0){
  $new_customer_percent = round((($new_customer/$customer_count) * 100), 2)."%";
}
else{
  $new_customer_percent = "0%";
}

// STAFF'S INFO

$query = $conn->prepare("SELECT * from users where deleted = 0 and role != 2");
$query->execute();
$staff_count = 0;
$new_staff = 0;
while($staff_row = $query->fetch()){
  if(getMonth($staff_row['created_at']) === getMonth($dateNow)){
    $new_staff++;
  }
  $staff_count++;
}

if($new_staff > 0){
  $new_staff_percent = round((($new_staff/$staff_count) * 100), 2)."%";
}
else{
  $new_staff_percent = "0%";
}

// SALES COUNT

$query = $conn->prepare("SELECT * from sale_summary where deleted = 0");
$query->execute();
$sales_count = 0;
$new_sales = 0;
while($sales_row = $query->fetch()){
  if(getMonth($sales_row['created_at']) === getMonth($dateNow)){
    $new_sales++;
  }
  $sales_count++;
}

if($new_sales > 0){
  $new_sales_percent = round((($new_sales/$sales_count) * 100), 2)."%";
}
else{
  $new_sales_percent = "0%";
}

// PRODUCTS COUNT

$query = $conn->prepare("SELECT * from commodities where deleted = 0");
$query->execute();
$product_count = 0;
$new_product = 0;
while($product_row = $query->fetch()){
  if(getMonth($product_row['created_at']) === getMonth($dateNow)){
    $new_product++;
  }
  $product_count++;
}

if($new_product > 0){
  $new_product_percent = round((($new_product/$product_count) * 100), 2)."%";
}
else{
  $new_product_percent = "0%";
}

$pdo->close();
 ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">

<!--        <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Customers</h5>
                      <span class="h2 font-weight-bold mb-0">
                        <?php echo $customer_count; ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                      <?php echo $new_customer_percent; ?>
                    </span>
                    <span class="text-nowrap">This month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Staffs</h5>
                      <span class="h2 font-weight-bold mb-0">
                        <?php echo $staff_count; ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 
                      <?php echo $new_staff_percent; ?>
                    </span>
                    <span class="text-nowrap">This month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                      <span class="h2 font-weight-bold mb-0">
                        <?php echo $sales_count; ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                      <?php echo $new_sales_percent; ?>
                    </span>
                    <span class="text-nowrap">This month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Commodities</h5>
                      <span class="h2 font-weight-bold mb-0">
                        <?php echo $product_count; ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                       <i class="fa fa-box"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 
                      <?php echo $new_product_percent; ?>
                    </span>
                    <span class="text-nowrap">This month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                  <h5 class="h3 mb-0">Total orders</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <!-- POWERED BY DASHBOARD.JS STARTING FROM LINE 1389 -->
              <div class="chart">
                <canvas id="chart-bars" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
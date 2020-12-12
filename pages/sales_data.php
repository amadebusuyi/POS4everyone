<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="cart-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cart-modal">Sale History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position: relative; overflow-x: auto">
                <table class="table align-items-center table-flush" id="table-products-list">
                  <thead>
                    <th>Commodities</th>
                    <th>Unit price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                  </thead>
                  <tbody id="products-list">
                    
                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
           </form>
        </div>
    </div>
</div>


<div class="container-fluid mt-5">
  <div class="row mt-4" id="display-products-history">
    <div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush" id="product--table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Month</th>
            <th scope="col">Total Sale</th>
            <th scope="col">Total Profit</th>
          </tr>
        </thead>
          <?php
            require "process/conn.php"; 
            $conn = $pdo->open();

            $year = date("Y");

            if(isset($_POST['year'])){
              $year = $_POST['year'];
            }

            $sales = array(
              "Jan" => array(),
              "Feb" => array(),
              "Mar" => array(),
              "Apr" => array(),
              "May" => array(),
              "Jun" => array(),
              "Jul" => array(),
              "Aug" => array(),
              "Sep" => array(),
              "Oct" => array(),
              "Nov" => array(),
              "Dec" => array()
            );

            $profits_rec = array(
              "Jan" => array(),
              "Feb" => array(),
              "Mar" => array(),
              "Apr" => array(),
              "May" => array(),
              "Jun" => array(),
              "Jul" => array(),
              "Aug" => array(),
              "Sep" => array(),
              "Oct" => array(),
              "Nov" => array(),
              "Dec" => array()
            );

            $query = $conn->prepare("SELECT * from sale_summary where YEAR(created_at) = :year");
            $query->execute(["year"=>$year]);
            
            $profits = array();
              while ($result = $query->fetch()) {
                // var_dump($result);
                  $month = getMonthName(getMonth($result['created_at']));
                  $amount = $result['amount'];
                  $profit = $result['profit'];
                  
                  array_push($sales[$month], $amount);
                  array_push($profits_rec[$month], $profit);
                  // array_push($sales, $result);
              }

           ?>
           <tbody>
            <?php if(count($sales) > 0): ?>
                <tr>
                 <!--  <td>
                    <input type="checkbox" id="select-{{@index}}-{{id}}">
                  </td> -->
                  <td class="month">January</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Jan"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec["Jan"]) ?></td>
                  <!-- <td>
                    <button class="btn btn-dark btn-sm" data-id="<?php echo $sales[$i]['id'] ?>" data-action="viewPurchase">
                      <i class="fa fa-eye"></i>
                    </button>
                  </td> -->
                </tr>
                <tr>
                  <td class="month">February</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Feb"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Feb']) ?></td>
                </tr>
                <tr>
                  <td class="month">March</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Mar"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Mar']) ?></td>
                </tr>
                <tr>
                  <td class="month">April</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Apr"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Apr']) ?></td>
                </tr>
                <tr>
                  <td class="month">May</td>
                  <td class="amount" data-array><?php echo json_encode($sales["May"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['May']) ?></td>
                </tr>
                <tr>
                  <td class="month">June</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Jun"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Jun']) ?></td>
                </tr>
                <tr>
                  <td class="month">July</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Jul"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Jul']) ?></td>
                </tr>
                <tr>
                  <td class="month">August</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Aug"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Aug']) ?></td>
                </tr>
                <tr>
                  <td class="month">September</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Sep"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Sep']) ?></td>
                </tr>
                <tr>
                  <td class="month">October</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Oct"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Oct']) ?></td>
                </tr>
                <tr>
                  <td class="month">November</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Nov"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Nov']) ?></td>
                </tr>
                <tr>
                  <td class="month">December</td>
                  <td class="amount" data-array><?php echo json_encode($sales["Dec"]) ?></td>
                  <td class="profit" data-array><?php echo json_encode($profits_rec['Dec']) ?></td>
                </tr>              
              <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
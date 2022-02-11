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
      <table class="table align-items-center table-flush" id="product-history-table">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="sorting_asc" tabindex="0" aria-controls="products-table" rowspan="1" colspan="1" aria-sort="ascending">Customer Name</th>
            <th scope="col">Amount</th>
            <th scope="col">Sold by</th>
            <th scope="col">Date</th>
            <th data-type="no-sort" scope="col">Action</th>
          </tr>
        </thead>
          <?php
            require "process/conn.php"; 
            $conn = $pdo->open();

            $query = $conn->prepare("SELECT * from sale_summary");
            $query->execute();
            $sales = array();
              while ($result = $query->fetch()) {
                if($_SESSION['role'] == 0 ){
                  if($result['created_by'] == $_SESSION['user']){
                  
                    $query2 = $conn->prepare("SELECT name from customers where id=:id");
                    $query2->execute(["id"=>$result['customer']]);
                    $customer = $query2->fetch()['name'];

                    $query3 = $conn->prepare("SELECT username from users where id=:id");
                    $query3->execute(["id"=>$_SESSION['user']]);
                    $username = $query3->fetch()['username'];

                    $result['customer_name'] = $customer;
                    $result['username'] = $username;
                    array_push($sales, $result);
                  }
                }

                else{
                    $query2 = $conn->prepare("SELECT name from customers where id=:id");
                    $query2->execute(["id"=>$result['customer']]);
                    $customer = $query2->fetch()['name'];

                    $query3 = $conn->prepare("SELECT username from users where id=:id");
                    $query3->execute(["id"=>$result['created_by']]);
                    $username = $query3->fetch()['username'];

                    $result['customer_name'] = $customer;
                    $result['username'] = $username;
                    array_push($sales, $result);
                }
              }
           ?>
           <tbody>
            <?php if(count($sales) > 0): ?>
              <?php for ($i=0; $i < count($sales); $i++): ?>
                <tr>
                 <!--  <td>
                    <input type="checkbox" id="select-{{@index}}-{{id}}">
                  </td> -->
                  <td class="name"><?php echo $sales[$i]['customer_name'] ?></td>
                  <td class="amount">₦<?php echo $sales[$i]['amount'] ?></td>
                  <td class="sold-by"><?php echo $sales[$i]['username'] ?></td>
                  <td class="date"><?php echo $sales[$i]['updated_at'] ?></td>
                  <td>
                    <button class="btn btn-dark btn-sm" data-id="<?php echo $sales[$i]['id'] ?>" data-action="viewPurchase">
                      <i class="fa fa-eye"></i>
                    </button>
                  </td>
                </tr>
                <?php endfor; ?>
              <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cart-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cart-modal">New Customer Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-customer-form">
              <div class="modal-body">
                  <div class="container-fluid">
                      <div class="row">
                        <div class="col-12" data-form>
                          <input type="text" id="customer-name" class="form-control" data-form-label="Customer's Name" data-form-float data-form-required="Provide customer's name">
                        </div>
                        <div class="col-12" data-form>
                          <input type="text" id="customer-phone" class="form-control" data-form-label="Customer's Phone" data-form-num data-form-float>
                        </div>
                        <div class="col-12" data-form>
                          <input type="email" id="customer-email" class="form-control" data-form-label="Customer's Email" data-form-float>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12" data-form>
                            <textarea id="customer-address" class="form-control" data-form-float data-form-label="Customer's Address"></textarea>
                        </div>
                      </div>        
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-default update-pro" data-id="">Add Customer</button>
              </div>
           </form>
        </div>
    </div>
</div>

<div id="saleComplete" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255, 1); z-index: 1047; height: 100%; display: none">
  <h1 style="position: relative; top: 10px; left: 10px">Purchase Summary</h1>
  <span class="close-sale-complete" style="position: absolute; top: 10px; right: 10px; cursor: pointer"><i class="fa fa-times fa-2x"></i></span>

  <div class="container">
    <div class="row mt-4">
      <div class="col-4 col-sm-3">
         <button class="btn btn-dark add-customer">+ Add <span class="d-none d-md-inline">Customer</span></button>
      </div>
      <div class="col-8 col-sm-4" data-form>
        <input type="search" class="form-control" id="searchCustomer" data-form-label="Search for customer" data-form-float>
      </div>
      <div class="col-sm-5" data-form id="display-customers">
        <select class="form-control" id="selectCustomer" data-form-float data-form-label="Select from list of customers">

        </select>
        <div class="text-center">
          <span class="search-result-count" style="color: brown; font-size: 12px;"></span>
        </div>
      </div>
    </div>

    <div class="row mt-3 p-2 cart-t-row" style="">
      <table class="table table-striped table-bordered table-responsive" width="100%" style="margin-top: 30px; overflow-x: hidden">
        <thead>
          <tr style="position: absolute; margin-right: 8.4%; margin-top: -50px">
            <td class="col-12">
              <strong class="display-customer-name"></strong>
            </td>
            <td class="col-12 total-amount">
              <strong class="display-cart-amount"></strong>
            </td>
          </tr>
          <tr>
            <th>S/N</th>
            <th width="45%">Name</th>
            <th width="10%">Quantity</th>
            <th width="20%">Unit Cost</th>
            <th width="25%">Total Amount</th>
          </tr>
        </thead>
        <tbody class="display-cart">

        </tbody>
      </table>
    </div>
  </div>

  <div class="cart-footer alert-primary" style="position: absolute; bottom: 0; left: 0; right: 0; height: 60px;">
    <div class="container">
      <div class="row m-2">
        <div class="col-12 text-center">
          <button class="btn btn-success" id="completeSale">Complete Sale</button>
        </div>
      </div>
    </div>
  </div>
</div>

<p style="position: absolute; top: 84px; left: 50%; transform: translateX(-50%); padding: 5px 10px; border-radius: 10px; display: inline; width: 300px" class="alert-success d-none text-center display-cart-amount"></p>


  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-6 text-left">  
        <button id="clearCart" class="btn btn-default"><i class="fa fa-times"></i> Clear<span class="d-none d-sm-inline"> Sale</span></button>
      </div>
      <div class="col-6 text-right" id="showSaleBtn">
        &nbsp;
      </div>
    </div>
    <div class="row mt-4" id="display-products">
      <script type="text/template" id="template-products">
        {{#if products}}
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="products-table">
              <thead class="thead-light">
                <tr>
                  <th data-type="no-sort"><input type="checkbox" class="d-none" id="select-all"></th>
                  <th scope="col" class="sorting_asc" tabindex="0" aria-controls="products-table" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
                  <th scope="col">Therapeutic name</th>
                  <th scope="col">Brand name</th>
                  <th scope="col">Available Quantity</th>
                  <th scope="col">Cost</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Amount</th>
                  <th data-type="no-sort" scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                {{#each products}}
                <tr>
                  <td>
                    <input type="checkbox" id="select-{{@index}}-{{id}}">
                  </td>
                  <td class="gname">{{generic_name}}</td>
                  <td class="tname">{{therapeutic}}</td>
                  <td class="bname">{{brand_name}}</td>
                  <td class="qty">{{quantity}}</td>
                  <td class="sell">₦{{unit_selling_price}}</td>
                  <td class="qty-buy"><input type="text" class="form-control" style="max-width: 100px; text-align: center" name="qty-buy" data-form-num placeholder="0" value="1"></td>
                  <td class="amount" data-amount="{{unit_selling_price}}">₦{{unit_selling_price}}</td>
                  <td>
                    <button class="btn btn-dark btn-sm" data-id="{{id}}" data-action="addPro">
                      <i class="fa fa-plus"></i>
                    </button>
                  </td>
                </tr>
                {{/each}}
              </tbody>
            </table>
          </div>
          {{/if}}
          <script type="text/javascript">
            $("#products-table").show(function(){
              $(this).dataTable();
            });

            $("th").show(function(){
              if($(this).data("type") == "no-sort"){
                let html = $(this).html();
                $(this).replaceWith(`<th>${html}</th>`);
              }
            })

            $("#select-all").click(function(){
              if($(this).prop("checked") == true){
                $("[type='checkbox']").each(function(){
                  $(this).prop("checked", true);
                })
              }
              else{
                $("[type='checkbox']").each(function(){
                  $(this).prop("checked", false);
                })
              }
            })

            // To get the total current transaction amount
            var loadAmountTotal = (arr) => {
              let total = 0;
              for(var i = 0; i < arr.length; i++){
                total += moneyToNum(arr[i].amount);
              }
              return formatMoney(String(total));
            }

            // UPDATE CART STATUS FOR PURCHASE SUMMARY
            var loadCartTr = (arr, customer) => {
              if(customer){
                $(".display-customer-name").text(`Customer Name: ${customer.name}`);
                fetchCustomers(customer.id);
              }
              $(".display-cart").empty();
              $.each(arr, (i, item) =>{
                $(".display-cart").append(`
                   <tr>
                    <td>${i+1}</td>
                    <td>${item.name}</td>
                    <td>${item.qty}</td>
                    <td>${formatMoney(item.cost)}</td>
                    <td>${item.amount}</td>
                  </tr>
                  `);
              })
            };

            // UPDATE CART STATUS
            var cartStatus = (cart_items) => {
              let cart = {};
              if(localStorage.cart){
                cart = JSON.parse(localStorage.cart);
              }
              let check = $("#showSaleBtn").find("button").html();
              cart.cart_items = cart_items;
              localStorage.cart = JSON.stringify(cart);
              if(cart_items.length > 0){
                $(".display-cart-amount").html(`Total Amount: <strong>${loadAmountTotal(cart_items)}</strong>`).removeClass("d-none");

                loadCartTr(cart_items, cart.customer);

                $("#showSaleBtn").html(`<button style="margin-left: 50px" class='btn btn-primary' onclick="cartContinue('${cart_items}')"><i class='fa fa-shopping-cart'></i> <span class="d-none d-sm-inline">Continue sale</span> (${cart_items.length})</button>`);
              }
              
              else{
                if(check)
                  $("#showSaleBtn").find("button").remove();
                  $(".display-cart-amount").addClass("d-none");
              }
            }


            // Loads or create cart identifier and processor
            var cart = {};
            var cart_items = [];
            if(localStorage.cart){
              cart = JSON.parse(localStorage.cart);
              cart_items = cart.cart_items;
            }

            //To empty cart, triggered by the click of a button
            $("#clearCart").click(function(e){
              e.preventDefault();
              parent = $("[type='checkbox']").parent("td").parent("tr");
              parent.removeClass("bg-t-selected");
              $(".display-customer-name").text("Customer Name: ");

              $("[type='checkbox']").each(function(){
                $(this).prop("checked", false);
              });

              parent.find("[name='qty-buy']").each(function(){
                $(this).val(0).change();
              });

              $("#selectCustomer").find("option").each(function(){
                if(!$(this).val())
                  $(this).prop("selected", true);
                else
                  $(this).removeAttr("selected");
              });
              localStorage.cart = "{}";
              cart_items = [];
              cartStatus(cart_items);
            })


            // Used to display cart items on load and check when a check button is not active
            $("[type='checkbox']").each(function(){
              if($(this).prop("id") !== "select-all"){
                let id = $(this).prop("id").split("select-")[1].split("-")[1];
                let status = cart_items.find(item => item.id == id);
                let parent = $(this).parent("td").parent("tr");
                let total_available = Number(parent.find(".qty").text());
                if(total_available < 1){
                  parent.css("background", "rgba(250,48,82,0.1)");
                }
                if(status){
                  $(this).prop("checked", true);
                  parent.addClass("bg-t-selected");
                  parent.find("[name='qty-buy']").val(status.qty);
                  parent.find("[data-amount]").text(status.amount);

                  cartStatus(cart_items);
                }
              }

              // Use to remove the tick on select all button
              $(this).click(function(){
                if($(this).prop("checked") == false){
                  $("#select-all").prop("checked", false);
                }
              })

            })

            // To update cart quantity and amount in real time
            // Prevents zero with active items in carts
            $("[name='qty-buy']").change(function(){
              val = $(this).val();
              if(!val || val == 0){
                val = 1;
                $(this).val(1).keyup();
              }
            })
            // the main value change processor
            $("[name='qty-buy']").keyup(function(){
              val = $(this).val();
              parent = $(this).parent("td").parent("tr");
              available = parent.find(".qty").text();
              if(val > Number(available)){
                val = available;
                $(this).val(val);
              }
              cost = parent.find("[data-amount]").data("amount");
              amount = formatMoney(String(Number(moneyToNum(cost)) * val));
              parent.find("[data-amount]").text(amount);

              if(parent.find("[type='checkbox']").prop("checked") === true){
                id = parent.find("[type='checkbox']").prop("id").split("select-")[1].split("-")[1];
                $.each(cart_items, (i, item)=>{
                  if(item.id == id){
                    item.amount = amount;
                    item.qty = val;
                  }
                })
                cartStatus(cart_items);
              }

            })

            // MAIN CART UPDATE IN RELATION TO CHECK BOXES HAPPENS HERE
            $("[type='checkbox']").click(function(){

              $("[type='checkbox']").each(function(){
                if($(this).prop("id") !== "select-all"){
                  let id = $(this).prop("id").split("select-")[1].split("-")[1];
                  let status = cart_items.find(item => item.id == id);

                  let trParent = $(this).parent("td").parent("tr");

                  if($(this).prop("checked") === true){
                    if(!status){
                      //Product info update
                      let cost = trParent.find(".amount").data("amount");
                      let qty = trParent.find(".qty-buy").find("input").val();
                      let name = trParent.find(".gname").text();
                      let tname = trParent.find(".tname").text();
                      let bname = trParent.find(".bname").text();
                      let total_available = Number(trParent.find(".qty").text());
                      if(total_available < 1){
                        swal("Product is out of stock");
                        $(this).prop("checked", false);
                        return false;
                      }
                      if(tname && bname){
                        name = `${name} (${tname} / ${bname})`;
                      }
                      else if(tname){
                        name = `${name} (${tname})`;
                      }
                      else if(bname){
                        name = `${name} (${bname})`;
                      }
                      let amount = formatMoney(String(qty * moneyToNum(cost)));
                      cart_items.push({id: id, cost: cost, qty: qty, amount: amount, name: name});
                    }
                    trParent.addClass("bg-t-selected");
                  }
                  else{
                    if(status){
                      cart_items = cart_items.filter(item => item.id !== id);
                    }
                    trParent.removeClass("bg-t-selected");
                  }

                }
                  
                cartStatus(cart_items);
                
              })
            })

            setInterval(()=>{
              $("[data-action='addPro']").each(function(){
                let check = $(this).parent("td").parent("tr").find("[type='checkbox']");
                if(check.prop("checked") === true){
                  $(this).find('i').removeClass('fa-add').addClass('fa-times');
                }
                else{
                  if($(this).find("i").hasClass("fa-add") === false){
                    $(this).find("i").removeClass('fa-times').addClass('fa-add');
                  }
                }
              })
            },100);

            $("[data-action='addPro']").click(function(e){
              e.preventDefault();
              let proid = $(this).data("id");
              $(this).parent("td").parent("tr").find("[type='checkbox']").click();
            });

            $("[data-form-num]").keypress(function(e){
                numOnly(e);
            });

            var cartContinue = (cart_items) => {
              $("#saleComplete").fadeIn();
            };

            $(".add-customer").click(()=>{
              $("#cartModal").modal("show");
            })

            $(".close-sale-complete").click(()=>{
              $("#saleComplete").fadeOut();
            });

          </script>
        </script>
      </div>
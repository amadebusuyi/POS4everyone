<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="add-product-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-product-modal">+ Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-product-form">
              <div class="modal-body">
                  <div class="container-fluid" style="width: 115%; margin-left: -7.5%">
                      <div class="row">
                         <div class="col-sm-6" data-form>
                            <select id="pro-cat" class="form-control" data-form-float data-form-required="Category must be selected" data-form-label="Select category">
                              <option value="" selected disabled>Select category</option>
                              <?php 
                                include "process/conn.php";
                                $conn = $pdo->open();

                                $query = $conn->prepare("SELECT id, name from categories where deleted = 0");
                                $query->execute();

                                while ($row = $query->fetch()) {
                                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                }

                               ?>
                            </select>
                          </div>
                         <div class="col-sm-6" data-form>
                            <select id="pro-sup" class="form-control" data-form-float data-form-required="Supplier must be selected" data-form-label="Select Supplier">
                              <option value="" selected disabled>Select Supplier</option>
                              <?php 

                                $query = $conn->prepare("SELECT id, name from suppliers where deleted = 0");
                                $query->execute();

                                while ($row = $query->fetch()) {
                                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                }

                                $pdo->close();
                               ?>
                            </select>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-sm-6" data-form>
                          <input type="text" id="pro-name" class="form-control" data-form-label="Product Name (generic)" data-form-float data-form-required="Product name cannot be empty">
                        </div>
                        <div class="col-sm-6" data-form>
                          <input type="text" id="pro-tname" class="form-control" data-form-label="Product Name (Therapeutic)" data-form-float>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6" data-form>
                          <input type="text" id="pro-bname" class="form-control" data-form-label="Brand Name" data-form-float>
                        </div>
                        <div class="col-sm-6" data-form>
                          <input type="text" id="pro-qty" class="form-control" data-form-label="Quantity" data-form-num data-form-float data-form-required="Quantity cannot be empty">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6" data-form>
                          <input type="text" id="pro-cost" class="form-control" data-form-label="Unit Cost Price" data-form-float data-form-currency>
                        </div>
                        <div class="col-sm-6" data-form>
                          <input type="text" id="pro-sell" class="form-control" data-form-label="Unit Selling Price" data-form-currency data-form-float data-form-required="You must add a selling price">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12" data-form>
                            <textarea id="pro-desc" class="form-control" data-form-float data-form-label="Description" data-form-placeholder="Describe this product"></textarea>
                        </div>                        
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-default">Add Product</button>
              </div>
           </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateProductModal" tabindex="-1" role="dialog" aria-labelledby="add-product-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update-product-modal">Update product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update-product-form">
              <div class="modal-body">
                  <div class="container-fluid" style="width: 115%; margin-left: -7.5%">
                     <div class="row">
                         <div class="col-sm-6" data-form>
                            <select id="procat" class="form-control" data-form-float data-form-required="Category must be selected" data-form-label="Select category">
                              <option value="" selected disabled>Select category</option>
                              <?php 

                                $query = $conn->prepare("SELECT id, name from categories where deleted = 0");
                                $query->execute();

                                while ($row = $query->fetch()) {
                                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                }

                               ?>
                            </select>
                          </div>
                         <div class="col-sm-6" data-form>
                            <select id="prosup" class="form-control" data-form-float data-form-required="Supplier must be selected" data-form-label="Select Supplier">
                              <option value="" selected disabled>Select Supplier</option>
                              <?php 

                                $query = $conn->prepare("SELECT id, name from suppliers where deleted = 0");
                                $query->execute();

                                while ($row = $query->fetch()) {
                                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                }

                                $pdo->close();
                               ?>
                            </select>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-sm-6" data-form>
                          <input type="text" id="proname" class="form-control" data-form-label="Product Name (generic)" data-form-float data-form-required="Product name cannot be empty">
                        </div>
                        <div class="col-sm-6" data-form>
                          <input type="text" id="protname" class="form-control" data-form-label="Product Name (Therapeutic)" data-form-float>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6" data-form>
                          <input type="text" id="probname" class="form-control" data-form-label="Brand Name" data-form-float>
                        </div>
                        <div class="col-sm-6" data-form>
                          <input type="text" id="proqty" class="form-control" data-form-label="Quantity" data-form-num data-form-float data-form-required="Quantity cannot be empty">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6" data-form>
                          <input type="text" id="procost" class="form-control" data-form-label="Unit Cost Price" data-form-float data-form-currency>
                        </div>
                        <div class="col-sm-6" data-form>
                          <input type="text" id="prosell" class="form-control" data-form-label="Unit Selling Price" data-form-currency data-form-float data-form-required="You must add a selling price">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12" data-form>
                            <textarea id="prodesc" class="form-control" data-form-float data-form-label="Description" data-form-placeholder="Describe this product"></textarea>
                        </div>
                      </div>        
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-default update-pro" data-id="">Update product</button>
              </div>
           </form>
        </div>
    </div>
</div>


    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-6 text-left">  
          <button data-target="#addProductModal" data-toggle="modal" class="btn btn-default">+ Add<span class="d-none d-sm-inline"> product</span></button>
        </div>
        <div class="col-6 text-right" id="showDeleteBtn">
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
                    <th data-type="no-sort"><input type="checkbox" id="select-all"></th>
                    <th scope="col" class="sorting_asc" tabindex="0" aria-controls="products-table" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
                    <th scope="col">Therapeutic name</th>
                    <th scope="col">Brand name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Category</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Unit cost price</th>
                    <th scope="col">Unit sell price</th>
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
                    <td class="text-center qty">{{quantity}}</td>
                    <td class="cat">{{category}}</td>
                    <td class="sup">{{supplier}}</td>
                    <td class="cost">₦{{unit_cost_price}}</td>
                    <td class="sell">₦{{unit_selling_price}}</td>
                    <!--<td class="profit">{{js "loadProfit(this.unit_selling_price, this.unit_cost_price)"}}</td>-->
                    <td>
                      <!-- <button class="btn btn-default btn-sm" data-id="{{id}}" data-action="viewPro">
                        <i class="fa fa-eye"></i>
                      </button> -->
                      <button class="btn btn-dark btn-sm" data-id="{{id}}" data-action="updatePro">
                        <i class="fa fa-edit"></i>
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

              $("[type='checkbox']").each(function(){
                $(this).click(function(){
                  if($(this).prop("checked") == false){
                    $("#select-all").prop("checked", false);
                  }
                })
              })

              $("[type='checkbox']").click(function(){
                let status = 0;
                let count = 0;
                let ids = [];
                $("[type='checkbox']").each(function(){
                  if($(this).prop("checked") == true && $(this).prop("id") !== "select-all"){
                    status = 1;
                    count = count+1;
                    ids.push($(this).prop("id").split("select-")[1].split("-")[1]);
                    $(this).parent("td").parent("tr").addClass("bg-light");
                  }
                  else{
                    $(this).parent("td").parent("tr").removeClass("bg-light");
                  }
                  let check = $("#showDeleteBtn").find("button").html();
                  if(status === 1){
                      $("#showDeleteBtn").html(`<button style="margin-left: 50px" class='btn btn-warning' onclick="deleteList('${ids}')"><i class='fa fa-trash'></i> <span class="d-none d-sm-inline">Delete Selected</span> (${count})</button>`);
                  }
                  
                  else{
                    if(check)
                      $("#showDeleteBtn").find("button").remove();
                  }
                })
              })

              function deleteList(ids = []){
                swal.fire({
                  title: "Are you sure?",
                  text: "Please confirm that you want to delete selected products from database",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete!",
                }).then ((result) => {
                  if(result.value){
                    $.post("process/commodities.php", {multi_del_product: ids}, (data)=>{
                      data = JSON.parse(data);
                      if(data.status === "success"){
                        localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
                        location.reload();
                      }
                      else{
                        swal("Error occured!", data.message, "warning");
                      }
                    })
                  }
                })
              }
                    
              $("[data-action='updatePro']").click(function(e){
                e.preventDefault();
               let proid = $(this).data("id");
                $("#proname").val($(this).parent("td").parent("tr").find(".gname").html());
                $("#protname").val($(this).parent("td").parent("tr").find(".tname").html());
                $("#probname").val($(this).parent("td").parent("tr").find(".bname").html());
                $("#proqty").val($(this).parent("td").parent("tr").find(".qty").html());
                let sup = $(this).parent("td").parent("tr").find(".sup").html();
                let cat = $(this).parent("td").parent("tr").find(".cat").html();
                $("#prosup").find("option").each(function(){
                  if($(this).html() == sup){
                    $(this).prop("selected", true);
                  }
                })
                $("#procat").find("option").each(function(){
                  if($(this).html() == cat){
                    $(this).prop("selected", true);
                  }
                })
                $("#procost").val($(this).parent("td").parent("tr").find(".cost").html());
                $("#prosell").val($(this).parent("td").parent("tr").find(".sell").html());

                $(".update-pro").data("id", proid);

                $("#updateProductModal").modal("show");
              });

            </script>
          </script>
          </div>
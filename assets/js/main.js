(function($) {
    'use strict'

    var uinfo = localStorage.uinfo;
    if(uinfo){
      uinfo = JSON.parse(uinfo);
    }

    else{
      window.location = "./logout";
    }

    $(".show-firstname").text(uinfo.first_name);

    let _img = uinfo.image;
    if(!_img)
      _img = "user.png";
    
      $(".load-image").html(`<img alt="" src="assets/img/profile/${_img}">`);

    let thisData = {uinfo: uinfo};

   
    $("#display-profile").show(function(e){
      var loc = String(window.location);
      if(loc.indexOf("profile#/") > -1){
        $.get("process/users.php?get_role", function(data){
          if(Number(data) > 0){
            let user = loc.split("profile#/")[1];
            $.post("process/users.php", {
              fetch_username: user
            }, function(data){
              data = JSON.parse(data);
              if(data.status == "success"){
                let amount = 0;
                $.each(data.data.sales_amount, (i, item)=>{
                  amount += Number(moneyToNum(item));
                });
                data.data.sales_amount = formatMoney(String(amount));
                $("#display-profile").html(renderTemplate("#template-profile", {uinfo: data.data}));
              }
              else{
                let amount = 0;
                $.each(thisData.uinfo.sales_amount, (i, item)=>{
                  amount += Number(moneyToNum(item));
                });
                thisData.uinfo.sales_amount = formatMoney(String(amount));
                $("#display-profile").html(renderTemplate("#template-profile", thisData));               
              }
            })
          }
          else{
                let amount = 0;
                $.each(thisData.uinfo.sales_amount, (i, item)=>{
                  amount += Number(moneyToNum(item));
                });
                thisData.uinfo.sales_amount = formatMoney(String(amount));
            $("#display-profile").html(renderTemplate("#template-profile", thisData));               
          }
        })
      }
      else{
                let amount = 0;
                $.each(thisData.uinfo.sales_amount, (i, item)=>{
                  amount += Number(moneyToNum(item));
                });
                thisData.uinfo.sales_amount = formatMoney(String(amount));
        $(this).html(renderTemplate("#template-profile", thisData));
      }
    })

    if(localStorage.prompt){
      let prompt = JSON.parse(localStorage.prompt);
      setTimeout(()=>{
        swal.fire(prompt.title, prompt.message, prompt.type);
        localStorage.removeItem("prompt");
      }, 500);
    }

    //Update user info on page load
    $.post("process/users.php", {
      update: uinfo.id
    }, (data)=>{
      data = JSON.parse(data);
      if(data.status == "success"){
        localStorage.uinfo = JSON.stringify(data.data);
      }
      else{
        window.location = "./logout";
      }
    })

    $("#display-staff").show(function(){
      $.post("process/users.php", {
        fetch_staff: true
      }, (data)=>{
        data = JSON.parse(data);
        if(data.status == "success"){
          $("#display-staff").html(renderTemplate("#template-staff", {staff: data.data}));
        }
      })
    });

    $("#add-staff-form").submit(function(e){
      e.preventDefault();
      let result = validateForm($(this), "json");
      if(result.status == "failed"){
        return false;
      }

      else{
        result.data.add_staff = true;
        let btn = $(this).find("[type=submit]");
        btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
        $.post("process/users.php", result.data, function(data){
          data = JSON.parse(data);
          btn.html("Add Staff").prop("disabled", false);
          if(data.status === "success"){
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
          else{
            swal.fire("Oops!", data.message, "warning");
          }
        })
      }

    })

    // USER PROFILE AND EDITING ENDS HERE -------->

    // COMMODITIES HANDLING STARTS FROM HERE <--------

    // Commodities category >>

    $("#add-category-form").submit(function(e){
      e.preventDefault();
      let result = validateForm($(this), "form");
      if(result.status == "failed"){
        return false;
      }

      else{
        result.data = "?add_category="+uinfo.id+result.data;
        let btn = $(this).find("[type=submit]");
        btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
        $.get("process/commodities.php"+result.data, function(data){
          data = JSON.parse(data);
          btn.html("Add Category").prop("disabled", false);
          if(data.status === "success"){
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
          else{
            swal.fire("Oops!", data.message, "warning");
          }
        })
      }

    })

    $("#display-categories").show(function(){
      $.post("process/commodities.php", {
        fetch_categories: true
      }, (data)=>{
        data = JSON.parse(data);
        if(data.status == "success"){
          $("#display-categories").html(renderTemplate("#template-categories", {categories: data.data}));
        }
      })
    });

    $("#update-category-form").submit(function(e){
      e.preventDefault();
      let catid = $(".update-cat").data("id");
      let result = validateForm($(this), "form");
      if(result.status == "failed"){
        return false;
      }

      else{
        result.data = "?update_category="+catid+result.data;
        let btn = $(this).find("[type=submit]");
        btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
        $.get("process/commodities.php"+result.data, function(data){
          data = JSON.parse(data);
          btn.html("Add Category").prop("disabled", false);
          if(data.status === "success"){
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
          else{
            swal.fire("Oops!", data.message, "warning");
          }  
        })
      }

    })

    // << Commodities Categories ends

    // Commodities suppliers >>

    $("#add-supplier-form").submit(function(e){
      e.preventDefault();
      let result = validateForm($(this), "form");
      if(result.status == "failed"){
        return false;
      }

      else{
        result.data = "?add_supplier="+uinfo.id+result.data;
        let btn = $(this).find("[type=submit]");
        btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
        $.get("process/commodities.php"+result.data, function(data){
          data = JSON.parse(data);
          btn.html("Add Supplier").prop("disabled", false);
          if(data.status === "success"){
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
          else{
            swal.fire("Oops!", data.message, "warning");
          }
        })
      }

    })

    $("#display-suppliers").show(function(){
      $.post("process/commodities.php", {
        fetch_suppliers: true
      }, (data)=>{
        data = JSON.parse(data);
        if(data.status == "success"){
          $("#display-suppliers").html(renderTemplate("#template-suppliers", {suppliers: data.data}));
        }
      })
    });

    $("#update-supplier-form").submit(function(e){
      e.preventDefault();
      let supid = $(".update-sup").data("id");
      let result = validateForm($(this), "form");
      if(result.status == "failed"){
        return false;
      }

      else{
        result.data = "?update_supplier="+supid+result.data;
        let btn = $(this).find("[type=submit]");
        btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
        $.get("process/commodities.php"+result.data, function(data){
          data = JSON.parse(data);
          btn.html("Add Supplier").prop("disabled", false);
          if(data.status === "success"){
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
          else{
            swal.fire("Oops!", data.message, "warning");
          }  
        })
      }

    })

    // << Commodiities suppliers ends here

    // Adding of commodities starts here >>

    $("#add-product-form").submit(function(e){
      e.preventDefault();
      let result = validateForm($(this), "form")
      if(result.status == "failed"){
        return false;
      }

      else{
        result.data = "?add_product="+uinfo.id+result.data;
        let btn = $(this).find("[type=submit]");
        btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
        $.get("process/commodities.php"+result.data, function(data){
          data = JSON.parse(data);
          btn.html("Add Product").prop("disabled", false);
          if(data.status === "success"){
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
          else{
            swal.fire("Oops!", data.message, "warning");
          }
        })
      }

    })

    $("#display-products").show(function(){
      $.post("process/commodities.php", {
        fetch_products: true
      }, (data)=>{
        data = JSON.parse(data);
        if(data.status == "success"){
          products = data.data;
          $("#display-products").html(renderTemplate("#template-products", {products: data.data}));
        }
      })
    });

    $("#update-product-form").submit(function(e){
      e.preventDefault();
      let proid = $(".update-pro").data("id");
      let result = validateForm($(this), "form");
      if(result.status == "failed"){
        return false;
      }

      else{
        result.data = "?update_product="+proid+result.data;
        let btn = $(this).find("[type=submit]");
        btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
        $.get("process/commodities.php"+result.data, function(data){
          data = JSON.parse(data);
          btn.html("Add Suppliers").prop("disabled", false);
          if(data.status === "success"){
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
          else{
            swal.fire("Oops!", data.message, "warning");
          }  
        })
      }

    })

    // << Adding of commodities ends here

    // Commodities processing ends here -------->


    // MAIN SEARCH BAR LINKED WITH TABLE SEARCH

    $("#navbar-search-main").keyup(function(e){
      // e.preventDefault();
     let input = $(this).find("input");
      $(".dataTables_filter").find("input").val(input.val()).keyup();
      // input.val("");
      // `$(this).focus();`
    }) 


// SALES HANDLING BEGINS HERE <---------------

  fetchCustomers();

  $("#add-customer-form").submit(function(e){
    e.preventDefault();
    let page = false;
    if($(this).data("page")){
      page = true;
    }
    let result = validateForm($(this), "form");
    if(result.status == "failed"){
      return false;
    }

    else{
      result.data = "?add_customer="+result.data;
      $.get("process/sales.php"+result.data, (data)=>{
        data = JSON.parse(data);
        if(data.status === "success"){
          if(!page){
            $("#cartModal").modal("hide");
            swal.fire("Done!", data.message, "success");
            fetchCustomers(); 
          }
          else{
            localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
            location.reload();
          }
        }
        else{
          $("#cartModal").modal("hide");
          swal.fire("Error!", data.message, "warning");
        }
      })
    }
  })

  $("#display-customers-main").show(function(){
      $.get("process/sales.php?fetch_customers", (data)=>{
        customers = JSON.parse(data).data;
        $("#display-customers-main").html(renderTemplate("#template-customers", {customers: customers}));
      })
    });

  // To load currently selected customer to cart
  $("#selectCustomer").change(function(){
    let customerId = $(this).val();
    if(customerId){
      if(localStorage.cart)
        cart = JSON.parse(localStorage.cart);

      let customer = customers.find(item => item.id == customerId);
      if(customer){
        cart.customer = {id: customer.id, name: customer.name};
        localStorage.cart = JSON.stringify(cart);
        $(".display-customer-name").text(`Customer Name: ${customer.name}`);
      }
    }
    else{
      cart.customer = {};
      localStorage.cart = JSON.stringify(cart);
      $(".display-customer-name").text(`Customer Name: `);
    }
  })

  var customerSearch = (elem) => {
    let searchQuery = elem.val();
    let customerSearchResult = [];
    $.each(customers, (i, item)=>{
      let nameSearch = item['name'].toLowerCase().indexOf(searchQuery.toLowerCase());
      let phoneSearch = item['phone'].indexOf(searchQuery);
      if(nameSearch > -1){
        customerSearchResult.push(customers[i]);
      }
      else if(phoneSearch > -1){
        customerSearchResult.push(customers[i]);
      }
    })
    loadCustomers(customerSearchResult);
    if(searchQuery)
      $(".search-result-count").text(`${customerSearchResult.length} found`);
    else
      $(".search-result-count").empty();

  }

  $("#searchCustomer").keyup(function(){
    customerSearch($(this));
  })

  $("#searchCustomer").change(function(){
    customerSearch($(this));
  })

  
  $("#update-customer-form").submit(function(e){
    e.preventDefault();
    let id = $(".update-customer").data("id");
    let result = validateForm($(this), "form");
    if(result.status == "failed"){
      return false;
    }

    else{
      result.data = "?update_customer="+id+result.data
      let btn = $(this).find("[type=submit]");
      btn.html("<i class='fa fa-spinner fa-spin'></fa>").prop("disabled", true);
      $.get("process/sales.php"+result.data, function(data){
        data = JSON.parse(data);
        if(data.status === "success"){
          localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
          // location.reload();
        }
        else{
          swal.fire("Oops!", data.message, "warning");
          btn.html("Add Customer").prop("disabled", false);
        }  
      })
    }

  })

  // SALES CONFIRMATION, STORAGE AND CONCLUSION >>

  $("#completeSale").click(function(e){
    e.preventDefault();
    $(this).html(`<i class="fa fa-spinner fa-spin fa-2x" style="margin: -5px"></i>`).prop("disabled", true);

    // Prepare cart for upload
    let amount = loadAmountTotal(cart.cart_items);
    let total_selling_price = 0;
    let total_cost_price = 0;
    let items = [];
    $.each(cart.cart_items, (i, item) => {
      let product = products.find(itm => itm.id == item.id);
      total_selling_price += moneyToNum(product.unit_selling_price) * item.qty;
      total_cost_price += moneyToNum(product.unit_cost_price) * item.qty;
      items.push({
        id: item.id, 
        quantity: item.qty, 
        cost_price: product.unit_cost_price, 
        selling_price: product.unit_selling_price
      });
    });

    if(!cart.customer || !cart.customer.id){
      cart.customer = {id: 1};
    }

    let profit = formatMoney(String(total_selling_price - total_cost_price));

    $.post("process/sales.php", {
      add_sale: true,
      customer: cart.customer.id,
      items: JSON.stringify(items),
      amount: amount,
      profit: profit
    }, (data)=>{
      data = JSON.parse(data);
      if(data.status ==="success"){
        localStorage.removeItem("cart");
        $("#clearCart").click();
        $(".close-sale-complete").click();
        localStorage.prompt = JSON.stringify({title: "Done!", message: data.message, type: "success"});
        location.reload();
      }
      else{
        swal.fire("Error occured!", data.message, "warning");
      }
    })

  })


    setTimeout(()=>{
      // location.reload();
    }, 2000)

  // << SALES CONFIRMATION, STORAGE AND CONCLUSION ENDS HERE


// SALES HANDLING ENDS HERE ---------------->


// SALES HISTORY HANDLING STARTS HERE <---------------

$("#product-history-table").show(function(){
  $(this).dataTable();
});

$("th").show(function(){
  if($(this).data("type") == "no-sort"){
    let html = $(this).html();
    $(this).replaceWith(`<th>${html}</th>`);
  }
})

$("[data-action='viewPurchase']").click(function(){
  let id = $(this).data("id");
  let amount = $(this).parent("td").parent("tr").find(".amount").text();
  $.get("process/sales.php?sale_history="+id, function(data){
    data = JSON.parse(data);
      if(data.status ==="success"){
        let proList = "";
        for(var i = 0; i < data.data.length; i++){
          proList += `<tr>
            <td>${data.data[i].name}</td>
            <td>${data.data[i].amount}</td>
            <td>${data.data[i].quantity}</td>
            <td>${amount}</td>
          </tr>`;
        }
        $("#products-list").html(proList);
        $("#productsModal").modal("show");
      }
  })
})

$("[data-array]").each(function(){
  let array = $(this).text();
  // console.log(array);
  array = JSON.parse(array);
  if(array.length > 0){
    let sum = 0;
    $.each(array, (i, item)=>{
      console.log(item);
      sum += moneyToNum(item);
    })
    $(this).text(formatMoney(String(sum)));
  }
  else{
    $(this).text("₦ 0.00");
  }
})

// SALES HISTORY HANDLING ENDS HERE --------------->

}(jQuery))

var makeRand = (length, type = false) => {
    var result = '';
    characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if(type == "cap-lt-num"){characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';}
    else if(type == "all"){characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';}
    else if(type == "sm-lt-num"){characters = 'abcdefghijklmnopqrstuvwxyz0123456789';}
    else if(type == "num"){characters = '1234567890';}
    else if(type == "sm-lt"){characters = "abcdefghijklmnopqrstuvwxyz";}

    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

var renderTemplate = (selector, data = {}) => {

  var template = document.querySelector(selector).innerHTML;
  var compiled = Template7(template).compile();
  return compiled(data);

}


//_________________________________________________________________________
/********** To format timestamp to an easily readable format **********/

var timeFromNow = function (time) {

    // Get timestamps
    var unixTime = new Date(time).getTime();
    if (!unixTime) return;
    var now = new Date().getTime();

    // Calculate difference
    var difference = (unixTime / 1000) - (now / 1000);

    // Setup return object
    var tfn = {};

    // Check if time is in the past, present, or future
    tfn.when = 'now';
    if (difference > 0) {
        tfn.when = 'future';
    } else if (difference < -1) {
        tfn.when = 'past';
    }

    // Convert difference to absolute
    difference = Math.abs(difference);

    // Calculate time unit
    if (difference / (60 * 60 * 24 * 365) > 1) {
        // Years
        if(difference/(60*60*24*45*365) > 1.9)
            tfn.unitOfTime = 'years';
        else
            tfn.unitOfTime = 'year';
        tfn.time = Math.floor(difference / (60 * 60 * 24 * 365));
    } else if (difference / (60 * 60 * 24 * 45) > 1) {
        // Months
        if(difference/(60*60*24*45) > 1.9)
            tfn.unitOfTime = 'months';
        else
            tfn.unitOfTime = 'month';
        tfn.time = Math.floor(difference / (60 * 60 * 24 * 45));
    } else if (difference / (60 * 60 * 24) > 1) {
        // Days
        if(difference/(60*60*24) > 1.9)
            tfn.unitOfTime = 'days';
        else
            tfn.unitOfTime = 'day';

        tfn.time = Math.floor(difference / (60 * 60 * 24));
    } else if (difference / (60 * 60) > 1) {
        // Hours
        if(difference/(60*60) > 1.9)  
            tfn.unitOfTime = 'hours';
        else
            tfn.unitOfTime = 'hour';
        tfn.time = Math.floor(difference / (60 * 60));
    } else if (difference / (60) > 1) {
        // Hours
        tfn.unitOfTime = 'minutes';
        tfn.time = Math.floor(difference / (60));
    } else {
        // Seconds
        tfn.unitOfTime = 'seconds';
        tfn.time = Math.floor(difference);
    }

    // Return time from now data
    return tfn;

};

var formatTime = (time) => {

    let c_time = timeFromNow(time);

    if(c_time.when === "now")
        return "Just Now";
    else if(c_time.when === "past")
        return c_time.time +" "+c_time.unitOfTime;
}


var showRole = (role) =>{
if(role == 0)
  return "Staff";

else if(role == 1)
  return "Admin Staff";

else if(role == 2)
  return "Super Admin";
}


// 
//    TO LOAD CUSTOMERS INFORMATION INTO DOM
//      DECALRED HERE BECAUSE IT MUST BE LOADED BEFORE PAGE LOADS FULLY
// 

// Global customers variable
var customers = "";
var products = "";

var loadProfit = (num1, num2) => {
    num1 = num1.replace(/,/g, "");
    num2 = num2.replace(/,/g, "");
    let result = String(Number(num1) - Number(num2));
    return formatMoney(result);
}

  var fetchCustomers = (id = false) => {
    $("#display-customers").show(function(){
      $.get("process/sales.php?fetch_customers", (data)=>{
        customers = JSON.parse(data).data;
        loadCustomers(customers, id);
      })
    });
  }

  var loadCustomers = (customers, id = false) => {
    $("#selectCustomer").empty();
    if(customers){
      $("#selectCustomer").append('<option value="">Select Customer</option>')
      for(var i = 0; i < customers.length; i++){
        let phone = "";
        let selected = "";
        if(customers[i].phone)
          phone = "("+customers[i].phone+")";
        if(id && id == customers[i].id){
          selected = "selected";
        }
        $("#selectCustomer").append(`<option value="${customers[i].id}" ${selected}>
          ${customers[i].name} ${phone}</option>`);
      }
    }
    else{
      $("#selectCustomer").append(`<option value="" disabled selected>No customer found</option>`);
    }
  }


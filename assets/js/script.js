/* SOME SCRIPTS FOR WEB OPERATION SLOT IN HERE*/

   var updateStockRow = (id) => {
    let trId = makeRand(16);
      return `
        <tr data-item-id="${trId}" data-id="${id}">
          <td>
            <input type="text" class="form-control" style="text-align: center" data-form-items data-name="generic_name" placeholder="Item name (generic)">
          </td>
          <td>
            <input type="text" class="form-control" style="text-align: center" data-form-items data-name="specific_name" placeholder="Item name (specific)">
          </td>
          <td>
            <select type="text" class="form-control" style="text-align: center" data-form-items data-name="supplier">
              <option selected value="">Select Supplier</option>
              <option>Supplier 1</option>
              <option>Supplier 2</option>
              <option>Supplier 3</option>
              <option>Supplier 4</option>
            </select>
          </td>
          <td>
            <input type="text" class="form-control" style="text-align: center" data-form-items data-name="qty-plus" data-form-num placeholder="0">
          </td>
          <td>
            <input type="text" class="form-control" style="text-align: center" data-form-items data-name="qty-minus" data-form-num placeholder="0">
          </td>
          <td>
            <input type="text" class="form-control" style="text-align: center" data-form-items data-name="description" placeholder="description">
          </td>
          <td>
            <button class="btn btn-sm btn-dark remove-item-row" onclick="removeItemRow('${trId}')" data-item-target="${trId}"><i class="fa fa-times"></i></button>
          </td>
        </tr>`;
    }
// SCRIPT TO UPDATE MULTIPLE STOCKS
    var updateStock = (ids) => {
      console.log(ids);
      ids = ids.split(",");
      var html = "";
      for(var i = 0; i < ids.length; i++){
        html += updateStockRow(ids[i]);
      }
      
      $("body").append('<script src="assets/js/script.js"></script>');
      $(".update-stock-tbody").html(html);
      $("#updateStockItems").show();
    }

/* DOM SCRIPT ENDS HERE */


    var formHandler = (elem, type) => {
        let parent = $(elem).parent("[data-form]");
        let input = $(parent).html();
        $(parent).html("<div class='form-group'>"+input+"</div>");
        let tag = $(parent).find("input");
        if(type === "textarea")
            tag = $(parent).find("textarea");
        if(type === "select")
            tag = $(parent).find("select");

        if($(tag).data("form-label")){
            let text = $(tag).data("form-label");
            let placeholder = "";
            if($(tag).data("form-float") !== undefined){
                $(tag).prop("placeholder", text);
                if($(tag).data("form-placeholder"));{
                    placeholder = $(tag).data("form-placeholder");
                }

                $(tag).focus(function(){

                    $(this).parent(".form-group").find(".error-note-handler").remove();
            
                    if($(tag).data("form-required") !== undefined || $(tag).prop("required") !== false){
                        text = text+"<span style='color: brown'> *</span>";
                    }
                    $(tag).parent(".form-group").prepend(`<inputname style="position: absolute; margin-top: -10px; font-size: 14px; background: white; padding: 0 3px; margin-left: 7px; color: #767">${text}</inputname>`);
                    if(placeholder && $(tag).val().length < 1){
                        $(tag).prop("placeholder", placeholder);
                    }
                })

                $(tag).focusout(function(){
                    if(text.indexOf("<span") > -1){
                        text = text.split("<span")[0];
                    }
                    if($(tag).val() == null || $(tag).val().length < 1){
                        $(tag).prop("placeholder", text);
                        $(tag).parent(".form-group").children("inputname").remove();
                    }
                })
            }
            else{
                if($(tag).data("form-placeholder")){
                    placeholder = $(tag).data("form-placeholder");
                    $(tag).prop("placeholder", placeholder);
                }
                else
                    $(tag).prop("placeholder", text);

                let rand = makeRand(15, "all");
                let id = $(tag).prop("id");
                if(!id){
                    $(tag).prop("id", rand);
                    id = rand;
                }
                if($(tag).data("form-required") !== undefined || $(tag).prop("required") !== false){
                    text = text+"<span style='color: brown'> *</span>";
                }
                $(tag).parent(".form-group").prepend(`<label for="${id}">${text}</label>`); 
            }
        }
    }

    $("input").each(function(){
        formHandler(this);
    })

    $("textarea").each(function(){
        formHandler(this, "textarea");
    })

    $("select").each(function(){
        formHandler(this, "select");
    })

    var validateForm = (tag, type) => {
        var status = 1;
        var result = {};
        if(type == "form"){
            result = ""
        }

        var load = (elem) => {

            global $type;
            global $result;

            let id = elem.prop("id");
            let val = elem.val();
            if((elem).data("form-currency") !== undefined){
                val = val.replace("₦", "");
                val = val.replace("$", "");
            }

            if(id.indexOf("-") > -1){
                id = id.replace(/-/g, "_");
            }

            if(type == "json"){
                result[id] = val;
            }

            else if(type == "form"){
                result += "&"+id+"="+val;
            }
        }

        $(tag).find(".form-control").each(function(){
            if($(this).data("form-required") != undefined || $(this).prop("required") != false){

                if($(this).val() == null || $(this).val().length < 1){
                    status = 0;
                    let warning = "This is a required field";
                    if($(this).data("form-required").length > 0){
                        warning = $(this).data("form-required");
                    }
                    else if($(this).prop("required").length > 0){
                        warning = $(this).prop("required");
                    }
                    let errCheck = $(this).parent(".form-group").find(".error-note-handler").html();
                    if(!errCheck)
                        $(this).parent(".form-group").append("<span class='error-note-handler' style='color: brown; font-size: 12px'>"+warning+"</span>")
                    
                }

                load($(this));
            }

            else{
                load($(this));
            }
        })

        if(status == 0)
            return {status: "failed", message: "required field empty", data: result};
        
        else
            return {status: "success", message: "Form complete", data: result};
    }

    function numOnly(e){
        let ins = e.key;
        let state = false;
        let numray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0, "."];
        for(var i = 0; i < numray.length; i++){
            if(ins == String(numray[i])){
                state = true;
                break;
            }
            else{}
        } 
        if(state === false){
            //alert(100);
            e.preventDefault();
        } 
    }

    function moneyToNum(str){
          str = str.replace(/₦/g, "");
          str = str.replace("$", "");
          str = Number(str.replace(/,/g, ""));
          return str;
    }

    function moneyToFixed(str){
          str = str.replace(/₦/g, "");
          str = str.replace("$", "");
          str = Number(str.replace(/,/g, "")).toFixed(2);
          return str;
    }


    function formatMoney(amount){
          amount = amount.replace(/₦/g, "");
          amount = amount.replace("$", "");
          amount = Number(amount.replace(/,/g, "")).toFixed(2);
          amount = amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
          return "₦"+amount;
    }

    $("[data-form-num]").keypress(function(e){
        numOnly(e);
    })

    $("[data-form-currency]").keypress(function(e){
        numOnly(e);
    })

    $("[data-form-currency]").change(function(){
        $(this).val(formatMoney($(this).val()));
    })


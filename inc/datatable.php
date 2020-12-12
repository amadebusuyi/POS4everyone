<script>
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
        ids.push($(this).prop("id").split("select-")[1]);
        $(this).parent("td").parent("tr").addClass("bg-light");
      }
      else{
        $(this).parent("td").parent("tr").removeClass("bg-light");
      }
      let check = $("#showDeleteBtn").find("button").html();
      if(status === 1){
          $("#showDeleteBtn").html(`<button style="margin-left: 50px" class='btn btn-warning' onclick="deleteList('${ids}')">Delete Selected (${count})</button>`);
      }
      
      else{
        if(check)
          $("#showDeleteBtn").find("button").remove();
      }
    })
  })
</script>
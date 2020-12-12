    <div class="header pb-6 d-flex align-items-center" style="min-height: 100px;">

    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row" id="display-profile">
       <script type="text/template" id="template-profile">
        {{#if uinfo}}
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#" class="profile-image">
                    {{#if uinfo.image}}
                      <img src="assets/img/profile/{{uinfo.image}}" style="width: 150%" class="rounded-circle">
                    {{else}}
                      <img src="assets/img/profile/user.png" style="width: 150%" class="rounded-circle">
                    {{/if}}
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <!-- <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div> -->
            </div> 
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                      <span class="heading">{{uinfo.sales_count}}</span>
                      <span class="description">Sales count</span>
                    </div>
                    <div>
                      <span class="heading">{{uinfo.sales_amount}}</span>
                      <span class="description">Sales Amount</span>
                    </div>
                 <!--    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div> -->
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h4><strong>@{{uinfo.username}}</strong></h4>
                <h5 class="h3">
                  {{uinfo.first_name}} {{uinfo.last_name}}
                </h5>
                <div class="h5 font-weight-300">
                  {{js "showRole(this.uinfo.role)"}}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Added {{js "formatTime(this.uinfo.created_at)"}} ago
                </div>
                <div>
                  <i class="ni education_hat mr-2"><small></i>{{uinfo.email}} | {{uinfo.phone}}
                </small></div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-xl-8 order-xl-1">
          
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
              </div>
            </div>
            <div class="card-body">

                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                <form>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="{{uinfo.first_name}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="{{uinfo.last_name}}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control" placeholder="Username" value="{{uinfo.username}}" disabled="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control" placeholder="email@example.com" value="{{uinfo.email}}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <textarea id="input-address" rows="1" class="form-control" placeholder="Address">{{uinfo.address}}</textarea>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-phone">Phone</label>
                        <input type="text" id="input-phone" class="form-control" placeholder="Phone Number" value="{{uinfo.phone}}">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button href="" class="btn btn-sm btn-default" data-id="{{uinfo.id}}" id="updateProfile">Update Profile</button>
                    </div>
                  </div>
                </form>
                  <hr class="my-4" />
                  <!-- Description -->
                <form>
                  <h6 class="heading-small text-muted mb-4">Change Password</h6>
                  <div class="row">
                    <div class="pl-lg-4 col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="oldPass">Old password</label>
                        <input type="password" id="oldPass" class="form-control" placeholder="********">
                      </div>
                    </div>
                    <div class="pl-lg-4 col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="newPass">New Password</label>
                        <input type="password" id="newPass" class="form-control" placeholder="********">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button type="button" data-id="{{uinfo.id}}" id="changePassword" class="btn btn-default btn-sm">Update Password</button>
                    </div>
                  </div>
                </form>
                </div>
                
            </div>
          </div>
        </div>
      {{/if}}
      <script type="text/javascript">
      let uinfo = JSON.parse(localStorage.uinfo);

      $("#updateProfile").click(function(e){
      e.preventDefault();

      let uid = $(this).data("id");

      $(this).html("<i class='fa fa-spinner fa-spin'></i>").prop("disabled", true);
      let first_name = $("#input-first-name").val();
      let last_name = $("#input-last-name").val();
      let email = $("#input-email").val();
      let phone = $("#input-phone").val();
      let address = $("#input-address").val();
      if(!first_name){
        swal("Input Error", "First name cannot be empty", "warning");
        $("#updateProfile").text("Update Profile").prop("disabled", false);
        return false;
      }

      $.post("process/users.php", {
        update_user: uid,
        first_name: first_name,
        last_name: last_name,
        email: email,
        phone: phone,
        address: address
      }, function(data){
        data = JSON.parse(data);
        if(data.status == "success"){
          localStorage.prompt = JSON.stringify({title: "Updated!", message: data.message, type: "success"});
          $("#updateProfile").text("Update Profile").prop("disabled", false);
          location.reload();
        }
        else{
          swal("Failed", data.message, "warning");
          $("#updateProfile").text("Update Profile").prop("disabled", false); 
        }
      })
    });

    $("#changePassword").click(function(e){
      e.preventDefault();
      let uid = $(this).data("id");
      let oldPass = $("#oldPass").val();
      let newPass = $("#newPass").val();

      let pw_case = 1;

      if(uid != uinfo.id && uinfo.id > 0){
        pw_case = 2;
      }

      if(newPass.length < 5 || oldPass.length < 5){
        swal("Input Error", "Password must be more than 4 characters", "warning");
        return false;
      }

      else{
        $.post("process/users.php", {
          change_password: uid,
          pw_case: pw_case,
          old_pass: oldPass,
          new_pass: newPass
        }, function(data){
          data = JSON.parse(data);
          if(data.status == "success"){
            swal("Done", data.message, "success");
          }
          else{
            swal("Error", data.message, "warning");            
          }
        })
      }
    });

      </script>
    </script>
  </div>


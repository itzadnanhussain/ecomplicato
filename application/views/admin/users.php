<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Search Table Fields By Filter</h4>
          <form class="submit-form" action="<?php echo base_url('Partial/SearchTableFieldsFiltersUsers') ?>">
            <div class="form-group">
              <label>Select Condition</label>
              <select class="js-example-basic-single w-100 form-control" name="condition" id="select-condition" onchange="selectCondition(this.value)">
                <option value="All" <?php echo (isset($_SESSION['search_users']) && ($_SESSION['search_users'] == 'All')) ? 'selected' : '' ?>>All Fields </option>
                <option value="Some" <?php echo (isset($_SESSION['search_users']) && ($_SESSION['search_users'] == 'Some')) ? 'selected' : '' ?>>Some Fields</option>
              </select>
            </div>
            <div class="form-group" id="multi-select">
              <label>Select Different Fields</label>
              <select class="js-example-basic-multiple w-100 form-control" name="fields[]" multiple="multiple" disabled>
                <?php if (isset($fields) && !empty($fields)) { ?>
                  <?php foreach ($fields as $key => $value) { ?>
                    <option value="<?php echo $value ?>" selected><?php echo $value ?></option>
                  <?php } ?>
                <?php }  ?>
              </select>
            </div>


            <input type="submit" class="btn btn-primary" value="Search">
          </form>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <h4 class="card-title">Total Number Of Users <div class="badge badge-pill badge-success"><?php echo (isset($users) && (!empty($users))) ? count($users) : 0  ?></div>
              </h4>

            </div>
            <!-- <div class="col-sm-6">
              <h6 class="text-right" style="margin-top: -11px;"><button data-toggle="modal" class="btn btn-primary" data-target="#">Add New </button></h6>

            </div> -->

            <div class="col-12">
              <div class="table-responsive">
                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                  <div class="row">
                    <div class="col-sm-12">

                      <style>
                        .dataTable thead>tr>th {
                          font-size: 11px;
                        }

                        .actions-links a>i {
                          font-size: 20px !important;
                          color: darkblue;
                          margin-right: 15px;
                        }
                      </style>



                      <table class="table dataTable no-footer" id="table-users" role="grid" aria-describedby="order-listing_info">
                        <thead> 
                            <tr class="bg-primary text-white">
                              <th>#ID</th>
                              <?php echo (in_array('email', $fields)) ? '<th>Email</th>' : '' ?>
                              <?php echo (in_array('password', $fields)) ? '<th>Password</th>' : '' ?>
                              <?php echo (in_array('name', $fields)) ? '<th>Name</th>' : '' ?>
                              <?php echo (in_array('phone', $fields)) ? '<th>Phone</th>' : '' ?>
                              <?php echo (in_array('location', $fields)) ? '<th>Location</th>' : '' ?>
                              <?php echo (in_array('device_type', $fields)) ? '<th>Device_Type</th>' : '' ?>
                              <?php echo (in_array('created_date', $fields)) ? '<th>Created_Date</th>' : '' ?>
                              <?php echo (in_array('is_active', $fields)) ? '<th>Is_Active</th>' : '' ?>  
                              <th>Actions</th>
                            </tr> 
                        </thead>



                        <tbody> 

                            <!----All Search---->
                            <?php if (isset($users) && !empty($users)) { ?>
                              <?php foreach ($users as $key => $value) { ?>
                                <tr>
                                  <?php echo (isset($value->user_id1)) ? '<td>' . $value->user_id1 . '</td>' : '' ?>
                                  <?php echo (isset($value->email)) ? '<td>' . $value->email . '</td>' : '' ?>
                                  <?php echo (isset($value->password)) ? '<td>' . $value->password . '</td>' : '' ?>
                                  <?php echo (isset($value->user_id)) ? '<td>' . GetProviderName($value->user_id) . '</td>' : '' ?>
                                  <?php echo (isset($value->user_id)) ? '<td>' . GetProviderContact($value->user_id) . '</td>' : '' ?>
                                  <?php echo (isset($value->user_id)) ? '<td>' . GetProviderAddress($value->user_id) . '</td>' : '' ?>
                                  <?php echo (isset($value->device_type)) ? '<td>' . $value->device_type . '</td>' : '' ?>
                                  <?php echo (isset($value->created_date)) ? '<td>' . $value->created_date . '</td>' : '' ?>
                                  <?php echo (isset($value->is_active)) ? '<td>' . $value->is_active . '</td>' : '' ?>
                                  <td class="actions-links_client">
                                    <a data-toggle="modal" data-target="#EditUser" data-whatever="<?php echo $value->user_id1 ?>"><i class="mdi mdi-pencil-box"></i></a>
                                    <a href="javascript:void(0)" onclick="DeleteRecord('<?php echo $value->user_id1 ?>')"><i class="mdi mdi-delete" style="color: orangered;"></i></a>
                                  </td>
                                </tr>
                              <?php } ?>
                            <?php } ?>  
                        </tbody>

                      </table>

                    </div>
                  </div>

                  <style>
                    .actions-links_client a>i {
                      font-size: 23px !important;
                      color: darkblue;
                      margin-right: 15px;
                      margin: 15px;
                    }
                  </style>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<!-- -Model--->
<!-- <div class="modal fade" id="AddNewUser" tabindex="-1" role="dialog" aria-labelledby="AddNewUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="submit-form" action="<?php echo base_url('users/add-user') ?>">
          <div class="form-group">
            <label>User ID</label>
            <input type="text" name="user_id" id="user_id" class="form-control">
          </div>
          <div class="form-group">
            <label>Social Media Type</label>
            <select name="social_media_type" id="social_media_type" class="form-control">
              <option value="email">Email</option>
              <option value="google">Google</option>
              <option value="apple">Apple</option>
            </select>
          </div>
          <div class="form-group">
            <label>social_id</label>
            <input type="text" name="social_id" id="social_id" class="form-control">
          </div>
          <div class="form-group">
            <label>User Type</label>
            <select name="user_type" id="user_type" class="form-control">
              <option value="provider">Provider</option>
              <option value="app_user">App User</option>
            </select>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Salt</label>
            <input type="text" name="salt" id="salt" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <label>Auth Token</label>
            <input type="text" name="auth_token" id="auth_token" class="form-control">
          </div>
          <div class="form-group">
            <label>Access Token</label>
            <input type="text" name="access_token" id="access_token" class="form-control">
          </div>
          <div class="form-group">
            <label>Verify Forgot Code</label>
            <input type="text" name="verify_forgot_code" id="verify_forgot_code" class="form-control">
          </div>
          <div class="form-group">
            <label>Badge</label>
            <input type="text" name="badge" id="badge" class="form-control">
          </div>
          <div class="form-group">
            <label>Device_Type</label>
            <input type="text" name="device_type" id="device_type" class="form-control">
          </div>
          <div class="form-group">
            <label>User_Time_Zone</label>
            <input type="text" name="user_time_zone" id="user_time_zone" class="form-control">
          </div>
          <div class="form-group">
            <label>Is Admin</label>
            <input type="text" name="is_admin" id="is_admin" class="form-control">
          </div>
          <div class="form-group">
            <label>Created_Date</label>
            <input type="text" name="created_date" id="created_date" class="form-control">
          </div>
          <div class="form-group">
            <label>Updated_Date</label>
            <input type="text" name="updated_date" id="updated_date" class="form-control">
          </div>
          <div class="form-group">
            <label>Is_Active</label>
            <input type="text" name="is_active" id="is_active" class="form-control">
          </div>
          <div class="form-group">
            <label>Is_Deleted</label>
            <input type="text" name="is_deleted" id="is_deleted" class="form-control">
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Add Record</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div> -->



<!-- -Model--->
<div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="EditUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="submit-form" action="<?php echo base_url('users/update-user') ?>">
          <div class="form-group">
            <input type="hidden" name="user_id" id="user_id" class="form-control">
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>

          <div class="form-group">
            <label>Reset Password</label>
            <input type="password" name="password" class="form-control">
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Update Record</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>




<script>
  ///load Data Table Part:2
  let table = $('#table-users').DataTable();

  ///Submit Form Part:3
  $('.submit-form').submit(function(e) {
    e.preventDefault();
    e.stopPropagation();
    let form = $(this).serialize();
    let url = $(this).attr('action');
    $.ajax({
      type: 'POST',
      url: url,
      data: form,
      dataType: 'html',
      success: function(data) {
        let res = JSON.parse(data);
        switch (res.code) {
          case 'success':
            // showSuccessSwal(res.message);
            showSuccessSwal(res.message);
            setTimeout(function() {
              window.location.reload();
            }, 3500);
            break;
          case 'warning':
            // showWarningSwal(res.message);
            showWarningSwal(res.message);
            break;
          case 'error':
            res.message.forEach(function(error) {
              $('[name=' + error[0] + ']').parent().append('<span style="color:red; font-size:11px">' + error[1] + '</span>');
            })
            break;

        }
      }

    });
  })

  //Model Part:4
  $('#EditUser').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var user_id = button.data('whatever');
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url('GetUsersTableRecordById') ?>",
      data: {
        user_id1: user_id
      },
      dataType: 'html',
      success: function(data) {
        let res = JSON.parse(data);
        switch (res.code) {
          case 'success':
            ///enter values in form 
            $('#user_id1').val(res.data[0]['user_id1']);
            $('#user_id').val(res.data[0]['user_id']);
            $('#social_media_type').val(res.data[0]['social_media_type']);
            $('#social_id').val(res.data[0]['social_id']);
            $('#user_type').val(res.data[0]['user_type']);
            $('#email').val(res.data[0]['email']);
            $('#salt').val(res.data[0]['salt']);
            $('#password').val(res.data[0]['password']);
            $('#auth_token').val(res.data[0]['auth_token']);
            $('#access_token').val(res.data[0]['access_token']);
            $('#verify_forgot_code').val(res.data[0]['verify_forgot_code']);
            $('#badge').val(res.data[0]['badge']);
            $('#device_type').val(res.data[0]['device_type']);
            $('#user_time_zone').val(res.data[0]['user_time_zone']);
            $('#is_admin').val(res.data[0]['is_admin']);
            $('#created_date').val(res.data[0]['created_date']);
            $('#updated_date').val(res.data[0]['updated_date']);
            $('#is_active').val(res.data[0]['is_active']);
            $('#is_deleted').val(res.data[0]['is_deleted']);
            break;
          case 'warning':
            showWarningSwal(res.message);
            setTimeout(function() {
              window.location.reload();
            }, 3500);
            break;

        }
      }
    });

  });

  ///Error Removing Process Part:5
  $(document).on("keypress", "form input", function(e) {
    $("span").html("");
  });

  ///Delete Record Part:6
  function DeleteRecord(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Partial/DeleteByAjax') ?>",
            data: {
              value: id,
              field: 'user_id1',
              table: 'user',

            },
            dataType: 'html',
            success: function(data) {
              let res = JSON.parse(data);
              switch (res.code) {
                case 'success':
                  swal("Poof! Your Record File has been deleted!", {
                    icon: "success",
                    button: false,
                    timer: 3000,
                  });
                  // showSuccessToast(res.message);
                  setTimeout(function() {
                    window.location.reload();
                  }, 2500)
                  break;
                case 'warning':
                  swal("Poof! Your Record File Not Delete", {
                    icon: "warning",
                  });

              }
            }
          });
        } else {
          swal("Your Record File is safe!");
        }
      });
  }
</script>
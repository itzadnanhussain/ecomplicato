<div class="content-wrapper">
  <div class="row">

    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <h4 class="card-title">Search Table Fields By Filter</h4>
            </div>
            <div class="col-sm-6">
              <h6 class="text-right" style="margin-top: -11px;"><button data-toggle="modal" class="btn btn-outline-info btn-icon-text" data-target="#ImportProvider"><i class="mdi mdi-file-pdf btn-icon-prepend"></i> Import Csv</button></h6>

            </div>

          </div>

          <form class="submit-form" action="<?php echo base_url('Partial/SearchTableFieldsFiltersProviders') ?>">
            <div class="form-group">
              <label>Select Records Type</label>
              <select class="js-example-basic-single w-100 form-control" name="profile_search">
                <option value="completed_profile" <?php echo (isset($_SESSION['profile_search']) && ($_SESSION['profile_search'] == 'completed_profile')) ? 'selected' : '' ?>>Completed Providers Profile </option>
                <option value="in_completed_profile" <?php echo (isset($_SESSION['profile_search']) && ($_SESSION['profile_search'] == 'in_completed_profile')) ? 'selected' : '' ?>>Incompleted Providers Profile </option>
              </select>
            </div>
            <div class="form-group">
              <label>Select Columns Condition</label>
              <select class="js-example-basic-single w-100 form-control" name="condition" id="select-condition" onchange="searchCondition(this.value)">
                <option value="All" <?php echo (isset($_SESSION['search_providers']) && ($_SESSION['search_providers'] == 'All')) ? 'selected' : '' ?>>All Fields </option>
                <option value="Some" <?php echo (isset($_SESSION['search_providers']) && ($_SESSION['search_providers'] == 'Some')) ? 'selected' : '' ?>>Some Fields</option>
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
            <h4 class="card-title">Total Number Of Providers <div class="badge badge-pill badge-success"><?php echo (isset($providers) && (!empty($providers))) ? count($providers) : 0  ?></div>
            </h4>
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

                      <table class="table dataTable no-footer" id="table-providers" role="grid" aria-describedby="order-listing_info">
                        <thead>

                          <tr class="bg-primary text-white">
                            <th>#ID</th>
                            <?php echo (in_array('account_email', $fields)) ? '<th>Account_Email</th>' : '' ?>
                            <?php echo (in_array('business_name', $fields)) ? '<th>Business_Name</th>' : '' ?>
                            <?php echo (in_array('password', $fields)) ? '<th>Password</th>' : '' ?>
                            <?php echo (in_array('professional_field', $fields)) ? '<th>Professional_Field</th>' : '' ?>
                            <?php echo (in_array('profession', $fields)) ? '<th>Profession</th>' : '' ?>
                            <?php echo (in_array('address_text', $fields)) ? '<th>Address_Text</th>' : '' ?>
                            <?php echo (in_array('unit_suite', $fields)) ? '<th>Unit_Suite</th>' : '' ?>
                            <?php echo (in_array('city', $fields)) ? '<th>City</th>' : '' ?>
                            <?php echo (in_array('state', $fields)) ? '<th>State</th>' : '' ?>
                            <?php echo (in_array('contact_name', $fields)) ? '<th>Contact_Name</th>' : '' ?>
                            <?php echo (in_array('contact_email', $fields)) ? '<th>Contact_Email</th>' : '' ?>
                            <?php echo (in_array('contact_phone_number', $fields)) ? '<th>Contact_Phone_Number</th>' : '' ?>
                            <?php echo (in_array('website', $fields)) ? '<th>Website</th>' : '' ?>
                            <?php echo (in_array('incorrect_data', $fields)) ? '<th>Incorrect_Data</th>' : '' ?>
                            <?php echo (in_array('created_date', $fields)) ? '<th>Created_Date</th>' : '' ?>
                            <?php echo (in_array('hourly_rate_id', $fields)) ? '<th>Hourly_Rate_Id</th>' : '' ?>
                            <?php echo (in_array('is_active', $fields)) ? '<th>Is_Active</th>' : '' ?>
                            <?php echo (in_array('likes', $fields)) ? '<th>Likes</th>' : '' ?>
                            <?php echo (in_array('contacts', $fields)) ? '<th>Contacts</th>' : '' ?>
                            <?php echo (in_array('is_paid', $fields)) ? '<th>Is_Paid</th>' : '' ?>
                            <th>Actions</th>
                          </tr>

                        </thead>
                        <tbody>

                          <?php if (isset($providers) && !empty($providers)) { ?>

                            <?php foreach ($providers as $key => $value) { ?>
                              <tr>

                                <?php echo (isset($value->service_provider_info_id)) ? '<td>' . $value->service_provider_info_id . '</td>' : '' ?>

                                <?php echo (isset($value->user_id) && (in_array('account_email', $fields))) ? '<td>' . GetProvidersAccountEmail($value->user_id) . '</td>' : '' ?>

                                <?php echo (isset($value->business_name)) ? '<td>' . $value->business_name . '</td>' : '' ?>


                                <?php echo (isset($value->user_id) && (in_array('password', $fields))) ? '<td>' . GetProvidersPasswords($value->user_id) . '</td>' : '' ?>
                                <?php echo (isset($value->professional_field)) ? '<td>' . $value->professional_field . '</td>' : '' ?>
                                <?php echo (isset($value->user_id) && (in_array('profession', $fields))) ? '<td>' . GetProvidersProfession($value->user_id) . '</td>' : '' ?>
                                <?php echo (isset($value->address_text)) ? '<td>' . $value->address_text . '</td>' : '' ?>
                                <?php echo (isset($value->unit_suite)) ? '<td>' . $value->unit_suite . '</td>' : '' ?>
                                <?php echo (isset($value->city)) ? '<td>' . $value->city . '</td>' : '' ?>
                                <?php echo (isset($value->state)) ? '<td>' . $value->state . '</td>' : '' ?>
                                <?php echo (isset($value->contact_name)) ? '<td>' . $value->contact_name . '</td>' : '' ?>
                                <?php echo (isset($value->contact_email)) ? '<td>' . $value->contact_email . '</td>' : '' ?>
                                <?php echo (isset($value->contact_phone_number)) ? '<td>' . $value->contact_phone_number . '</td>' : '' ?>
                                <?php echo (isset($value->website)) ? '<td>' . $value->website . '</td>' : '' ?>
                                <?php echo (isset($value->incorrect_data)) ? '<td>' . $value->incorrect_data . '</td>' : '' ?>
                                <?php echo (isset($value->created_date)) ? '<td>' . $value->created_date . '</td>' : '' ?>
                                <?php echo (isset($value->hourly_rate_id)) ? '<td>' . $value->hourly_rate_id . '</td>' : '' ?>
                                <?php echo (isset($value->is_active)) ? '<td>' . $value->is_active . '</td>' : '' ?>
                                <?php echo (isset($value->user_id) && (in_array('likes', $fields))) ? '<td>' . GetProvidersLikes($value->user_id) . '</td>' : '' ?>
                                <?php echo (isset($value->user_id) && (in_array('contacts', $fields))) ? '<td>' . GetProviderContactCount($value->user_id) . '</td>' : '' ?>
                                <?php echo (isset($value->user_id) && (in_array('is_paid', $fields))) ? '<td> ' . GetPaidFlag($value->is_paid) . ' </td>' : '' ?>


                                <td class="actions-links_client">
                                  <a data-toggle="modal" data-target="#EditProvider" data-whatever="<?php echo $value->service_provider_info_id ?>"><i class="mdi mdi-pencil-box"></i></a>
                                  <a href="javascript:void(0)" onclick="DeleteRecord('<?php echo $value->service_provider_info_id ?>')"><i class="mdi mdi-delete" style="color: orangered;"></i></a>
                                  <a href="<?php echo base_url('providers/details/') . urlencode(base64_encode($value->user_id)) ?>"><i class="mdi mdi-menu"></i></a>

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
<div class="modal fade" id="AddNewProvider" tabindex="-1" role="dialog" aria-labelledby="AddNewProvider" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="submit-form" action="<?php echo base_url('providers/add-provider') ?>">

          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label>Account Name</label>
            <input type="text" name="account_name" class="form-control">
          </div>

          <div class="form-group">
            <label>Account Email</label>
            <input type="email" name="account_email" class="form-control">
          </div>

          <div class="form-group">
            <label>Account Phone</label>
            <input type="text" name="account_phone" class="form-control">
          </div>

          <div class="form-group">
            <label>Business Email</label>
            <input type="email" name="business_email" class="form-control">
          </div>

          <div class="form-group">
            <label>Contact Name</label>
            <input type="text" name="contact_name" class="form-control">
          </div>

          <div class="form-group">
            <label>Contact Email</label>
            <input type="email" name="contact_email" class="form-control">
          </div>

          <div class="form-group">
            <label>Contact Phone</label>
            <input type="phone" name="contact_phone" class="form-control">
          </div>

          <div class="form-group">
            <label>Industry</label>
            <input type="text" name="industry" class="form-control">
          </div>

          <div class="form-group">
            <label>profession</label>
            <input type="text" name="profession" class="form-control">
          </div>

          <div class="form-group">
            <label>Street</label>
            <input type="text" name="street" class="form-control">
          </div>

          <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control">
          </div>

          <div class="form-group">
            <label>State</label>
            <input type="text" name="state" class="form-control">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Add Record</button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>



<!-- -Model--->
<div class="modal fade" id="EditProvider" tabindex="-1" role="dialog" aria-labelledby="EditProvider" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="submit-form" action="<?php echo base_url('providers/UpdateProvider') ?>">

          <div class="form-group">
            <input type="hidden" name="service_provider_info_id" id="service_provider_info_id" class="form-control">
          </div>

          <div class="form-group">
            <label>Contact Name</label>
            <input type="text" name="contact_name" id="contact_name" class="form-control">
          </div>
          <div class="form-group">
            <label>Contact Phone</label>
            <input type="text" name="contact_phone_number" id="contact_phone_number" class="form-control">
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="address" name="address_text" id="address_text" class="form-control">
          </div>
          <div class="form-group">
            <label>City</label>
            <input type="text" name="city" id="city" class="form-control">
          </div>
          <div class="form-group">
            <label>State</label>
            <input type="text" name="state" id="state" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Profile Status</label>
            <select name="complete" id="complete" class="form-control">
              <option value="0">False</option>
              <option value="1">True</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Paid Flag</label>
            <select name="is_paid" id="is_paid" class="form-control">
              <option value="0">False</option>
              <option value="1">True</option>
            </select>
          </div>
          <div class="form-group">
            <label>Professional Field</label>
            <select name="professional_field" id="professional_field" class="form-control">
              <?php if (isset($professional_field) && !empty($professional_field)) { ?>
                <?php foreach ($professional_field as $key => $value) { ?>
                  <option value="<?php echo $value->professional_field_value ?>"><?php echo $value->professional_field_title ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Hourly Rate</label>
            <select name="hourly_rate_id" id="hourly_rate_id" class="form-control">
              <?php if (isset($hourly_rate) && !empty($hourly_rate)) { ?>
                <?php foreach ($hourly_rate as $key => $value) { ?>
                  <option value="<?php echo $value->hourly_rate_id ?>"><?php echo $value->rate_title ?></option>
                <?php } ?>
              <?php } ?>
            </select>
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



<!-- -Model--->
<div class="modal fade" id="ImportProvider" tabindex="-1" role="dialog" aria-labelledby="ImportProvider" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="import_csv" enctype="multipart/form-data">
          <div class="form-group">
            <label>Select CSV File</label>
            <input type="file" name="csv_file" id="csv_file" required accept=".csv" class="form-control" />
          </div>
          <br />
          <button type="submit" name="import_csv" class="btn btn-primary" id="import_csv_btn">Import CSV</button>
        </form>
      </div>
    </div>

  </div>
</div>




<script>
  ///load Data Table
  let table = $('#table-providers').DataTable();

  ///Submit Form 
  $('.submit-form').submit(function(e) {
    e.preventDefault();
    e.stopPropagation();
    let form = $(this).serialize(); 
    let url = $(this).attr('action');
    $(".error").remove();
    $.ajax({
      type: 'POST',
      url: url,
      data: form,
      dataType: 'html',
      success: function(data) {
        let res = JSON.parse(data);
        switch (res.code) {
          case 'success':
            showSuccessSwal(res.message);
            setTimeout(function() {
              window.location.reload();
            }, 3500);
            break;
          case 'warning':
            showWarningSwal(res.message);
            break;
          case 'error':
            res.message.forEach(function(error) {
              $('[name=' + error[0] + ']').parent().append('<span style="color:red; font-size:11px" class="error">' + error[1] + '</span>');
            })
            break;

        }
      }

    });
  })


  //Model 
  $('#EditProvider').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('whatever');
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url('GetProvidersTableRecordById') ?>",
      data: {
        service_provider_info_id: id
      },
      dataType: 'html',
      success: function(data) {
        let res = JSON.parse(data);
        switch (res.code) {
          case 'success':
            ///enter values in form  
            $('#service_provider_info_id').val(res.data[0]['service_provider_info_id']);
            $('#contact_name').val(res.data[0]['contact_name']);
            $('#contact_phone_number').val(res.data[0]['contact_phone_number']);
            $('#address_text').val(res.data[0]['address_text']);
            $('#city').val(res.data[0]['city']);
            $('#state').val(res.data[0]['state']);
            $('#is_paid').val(res.data[0]['is_paid']);
            $('#complete').val(res.data[0]['complete']);
            $('#hourly_rate_id').val(res.data[0]['hourly_rate_id']);
            $('#professional_field').val(res.data[0]['professional_field']);

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


  ///Delete Record 
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
              field: 'service_provider_info_id',
              table: 'service_provider_info',

            },
            dataType: 'html',
            success: function(data) {
              let res = JSON.parse(data);
              switch (res.code) {
                case 'success':
                  swal("Proof! Your Record File has been deleted!", {
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

  $(document).keypress(function(e) {
    $('.error').hide();
  });
</script>

<script>
  $('#import_csv').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
      url: "<?php echo base_url(); ?>providers/import_provider",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      // beforeSend: function() {
      //   $('#import_csv_btn').html('Importing...');
      //   $('#import_csv_btn').attr('Disabled',true);
      // }, 
      success: function(data) {
        let res = JSON.parse(data);
        switch (res.code) {
          case 'success':
            showSuccessSwal(res.message);
            setTimeout(function() {
              window.location.reload();
            }, 3500);
            break;
          case 'warning':
            showWarningSwal(res.message);
            break;

        }
      },
      // complete: function()
      // {
      //   $('#import_csv_btn').attr('Disabled',false);
      // } 
    })
  });
</script>

<script>

$(function(){
  var value = '<?php echo ($_SESSION['search_providers']) ?>';
  searchCondition(value);
})
  function searchCondition(value) { 
    if (value == "Some") {
      $('#multi-select').show();
      $('#multi-select select').attr('disabled', false);
    } else if (value == "All") {
      $('#multi-select select').attr('disabled', true);
      $('#multi-select').hide();
    }
  }
</script>
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
              <h6 class="text-right" style="margin-top: -11px;"><button data-toggle="modal" class="btn btn-outline-info btn-icon-text" data-target="#ImportArticle"><i class="mdi mdi-file-pdf btn-icon-prepend"></i> Import Csv</button></h6>

            </div>
          </div>
          <form class="submit-form" action="<?php echo base_url('Partial/SearchTableFieldsFiltersArticles') ?>">
            <div class="form-group">
              <label>Select Condition</label>
              <select class="js-example-basic-single w-100 form-control" name="condition" id="select-condition" onchange="selectCondition(this.value)">
                <option value="All" <?php echo (isset($_SESSION['search_articles']) && ($_SESSION['search_articles'] == 'All')) ? 'selected' : '' ?>>All Fields </option>
                <option value="Some" <?php echo (isset($_SESSION['search_articles']) && ($_SESSION['search_articles'] == 'Some')) ? 'selected' : '' ?>>Some Fields</option>
              </select>
            </div>
            <div class="form-group" id="multi-select">
              <label>Select Different Fields</label>
              <select class="js-example-basic-multiple w-100 form-control" name="fields[]" multiple="multiple" disabled>
                <?php if (isset($fields) && !empty($fields)) { ?>
                  <?php foreach ($fields as $key => $value) { ?>
                    <option value="<?php echo $value ?>" <?php echo (array_search($value, $fields_head)) ? 'selected' : '' ?>><?php echo $value ?></option>
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
              <h4 class="card-title">Total Number Of articles <div class="badge badge-pill badge-success"><?php echo (isset($articles) && (!empty($articles))) ? count($articles) : 0  ?></div>
              </h4>

            </div>
            <div class="col-sm-6">
              <h6 class="text-right" style="margin-top: -11px;"><button data-toggle="modal" class="btn btn-primary" data-target="#AddNewArticle">Add New </button></h6>

            </div>


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

                      <table class="table dataTable no-footer" id="table-articles" role="grid" aria-describedby="order-listing_info">
                        <thead>
                          <?php if (isset($_SESSION['search_articles']) && ($_SESSION['search_articles'] == 'Some')) { ?>
                            <tr class="bg-primary text-white">
                              <?php foreach ($fields_head as $key => $value) { ?>
                                <?php if ($value == 'user_id') {  ?>
                                  <th>Provider_Email</th>
                                <?php } else { ?>
                                  <th><?php echo $value ?></th>
                                <?php } ?>
                              <?php } ?>
                              <th>Actions</th>

                            </tr>
                          <?php  } else { ?>
                            <tr class="bg-primary text-white">
                              <?php foreach ($fields_head as $key => $value) { ?>
                                <?php if ($value == 'user_id') {  ?>
                                  <th>Provider_Email</th>
                                <?php } else { ?>
                                  <th><?php echo $value ?></th>
                                <?php } ?>
                              <?php } ?>
                              <th>Actions</th>

                            </tr>
                          <?php } ?>
                        </thead>
                        <tbody>

                          <?php if (isset($_SESSION['search_articles']) && ($_SESSION['search_articles'] == 'Some')) { ?>
                            <?php if (isset($articles) && !empty($articles)) { ?>
                              <!----Some Search---->
                              <?php foreach ($articles as $key => $value) { ?>
                                <tr>
                                  <?php echo (isset($value->article_id)) ? '<td>' . $value->article_id . '</td>' : '' ?>
                                  <?php echo (isset($value->user_id)) ? '<td>' . GetUserEmail($value->user_id) . '</td>' : '' ?>
                                  <?php echo (isset($value->title)) ? '<td><textarea class="form-control" cols="30" rows="5" disabled style="width: auto;">' . $value->title . '</textarea></td>' : '' ?>
                                  <?php echo (isset($value->description)) ? '<td><textarea class="form-control" cols="60" rows="5" disabled style="width: auto;">' . $value->description . '</textarea></td>' : '' ?>
                                  <?php echo (isset($value->photo)) ? '<td>  <img src="'.base_url($value->photo).'" alt="" sizes="" srcset=""></td>' : '' ?>
                                  <?php echo (isset($value->link)) ? '<td>' . $value->link . '</td>' : '' ?>
                                  <?php echo (isset($value->professional_field_id)) ? '<td>' . ProfessionalFieldsTitle($value->professional_field_id) . '</td>' : '' ?>
                                  <?php echo (isset($value->is_admin)) ? '<td>' . $value->is_admin . '</td>' : '' ?>
                                  <?php echo (isset($value->created_date)) ? '<td>' . $value->created_date . '</td>' : '' ?>
                                  <?php echo (isset($value->updated_date)) ? '<td>' . $value->updated_date . '</td>' : '' ?>
                                  <td class="actions-links_client">
                                    <a data-toggle="modal" data-target="#EditArticle" data-whatever="<?php echo $value->article_id ?>"><i class="mdi mdi-pencil-box"></i></a>
                                    <a href="javascript:void(0)" onclick="DeleteRecord('<?php echo $value->article_id ?>')"><i class="mdi mdi-delete" style="color: orangered;"></i></a>
                                  </td>
                                 
                                </tr>
                              <?php } ?>
                            <?php } ?>
                          <?php } else {  ?>
                            <?php if (isset($articles) && !empty($articles)) { ?>
                              <?php foreach ($articles as $key => $value) { ?>
                                <tr>
                                  <?php echo (isset($value->article_id)) ? '<td>' . $value->article_id . '</td>' : '' ?>
                                  <?php echo (isset($value->user_id)) ? '<td>' . GetUserEmail($value->user_id) . '</td>' : '' ?>
                                  <?php echo (isset($value->title)) ? '<td><textarea class="form-control" cols="30" rows="5" disabled style="width: auto;">' . $value->title . '</textarea></td>' : '' ?>
                                  <?php echo (isset($value->description)) ? '<td><textarea class="form-control" cols="60" rows="5" disabled style="width: auto;">' . $value->description . '</textarea></td>' : '' ?>
                                  <?php echo (isset($value->photo)) ? '<td>  <img src="'.base_url($value->photo).'" alt="" sizes="500" srcset=""></td>' : '' ?>
                                  <?php echo (isset($value->link)) ? '<td>' . $value->link . '</td>' : '' ?>
                                  <?php echo (isset($value->professional_field_id)) ? '<td>' . ProfessionalFieldsTitle($value->professional_field_id) . '</td>' : '' ?>
                                  <?php echo (isset($value->is_admin)) ? '<td>' . $value->is_admin . '</td>' : '' ?>

                                  <?php echo (isset($value->created_date)) ? '<td>' . $value->created_date . '</td>' : '' ?>
                                  <?php echo (isset($value->updated_date)) ? '<td>' . $value->updated_date . '</td>' : '' ?>

                                  <td class="actions-links_client">
                                    <a data-toggle="modal" data-target="#EditArticle" data-whatever="<?php echo $value->article_id ?>"><i class="mdi mdi-pencil-box"></i></a>
                                    <a href="javascript:void(0)" onclick="DeleteRecord('<?php echo $value->article_id ?>')"><i class="mdi mdi-delete" style="color: orangered;"></i></a>
                                  </td>
                                </tr>
                              <?php } ?>
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
<div class="modal fade" id="AddNewArticle" tabindex="-1" role="dialog" aria-labelledby="AddNewArticle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="submit-form" action="<?php echo base_url('articles/add-article') ?>" enctype="multipart/form-data">


          <!-- <div class="form-group">
            <label>User ID</label>
            <select name="user_id" class="form-control">
              <?php if (isset($users) && !empty($users)) { ?>
                <?php foreach ($users as $key => $value) { ?>
                  <option value="<?php echo $value->user_id ?>"><?php echo $value->user_id ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div> -->


          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="10" class="form-control"></textarea>
          </div>
          <!-- <div class="form-group">
            <label>Image</label>
            <input type="file" name="photo" class="form-control">
          </div> -->
          <div class="form-group">
            <label>Hyperlink</label>
            <input type="text" name="link" class="form-control">
          </div>
          <div class="form-group">
            <label>Professional List</label>
            <select name="professional_field_id" id="professional_field_id" class="form-control" onchange="getprofessionforadd(this.value)">
              <?php if (isset($professional_list) && !empty($professional_list)) { ?>
                <?php foreach ($professional_list as $key => $value) { ?>
                  <option value="<?php echo $value->professional_field_id ?>"><?php echo $value->professional_field_title ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <!-- <div class="form-group">
            <label for="">Profession List</label>
            <select name="profession_id" id="professionadd" class="form-control">

            </select>
          </div> -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Submit Record</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>



<!-- -Model--->
<div class="modal fade" id="EditArticle" tabindex="-1" role="dialog" aria-labelledby="EditArticle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="submit-form" action="<?php echo base_url('articles/update-article') ?>" enctype="multipart/form-data">

          

          <div class="form-group">
            <input type="hidden" name="article_id" id="article_id">
            <label>Title</label>
            <input type="text" name="title" id="title" class="form-control">
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="10" id="description" class="form-control"></textarea>
          </div>

          <!-- <div class="form-group">
            <label>Image</label>
            <input type="file" name="photo" class="form-control">
          </div> -->

          <div class="form-group">
            <label>Hyperlink</label>
            <input type="text" name="link" id="link" class="form-control">
          </div>

          <div class="form-group">
            <label>Professional List</label>
            <select name="professional_field_id" id="professional_field_id" class="form-control">
              <?php if (isset($professional_list) && !empty($professional_list)) { ?>
                <?php foreach ($professional_list as $key => $value) { ?>
                  <option value="<?php echo $value->professional_field_id ?>"><?php echo $value->professional_field_title ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Submit Record</button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>


<!-- -Model--->
<div class="modal fade" id="ImportArticle" tabindex="-1" role="dialog" aria-labelledby="ImportArticle" aria-hidden="true">
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
  let table = $('#table-articles').DataTable();

  ///Submit Form 
  $('.submit-form').submit(function(e) {
    e.preventDefault();
    e.stopPropagation();
    var formData = new FormData(this);
    let url = $(this).attr('action');
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
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
              $('[name=' + error[0] + ']').parent().append('<span style="color:red; font-size:11px">' + error[1] + '</span>');
            })
            break;


        }
      }

    });
  })



  //Model 
  $('#EditArticle').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('whatever');
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url('GetArticlesTableRecordById') ?>",
      data: {
        article_id: id
      },
      dataType: 'html',
      success: function(data) {
        let res = JSON.parse(data);
        switch (res.code) {
          case 'success':

            ///enter values in form 
            $('#article_id').val(res.data[0]['article_id']);
            $('#user_id').val(res.data[0]['user_id']);
            $('#title').val(res.data[0]['title']);
            $('#description').val(res.data[0]['description']);
            $('#link').val(res.data[0]['link']);
            $('#professional_field_id').val(res.data[0]['professional_field_id']);
            // $('#image_path').append('<img src="<?php echo base_url() ?> '+ res.data[0]['image_path']'" class="form-control" />');




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


  ///Error Removing Process
  $(document).on("keypress", "form input", function(e) {
    $("span").html("");
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
              field: 'article_id',
              table: 'article',

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

<script>
  $('#import_csv').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
      url: "<?php echo base_url(); ?>articles/import_article",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function() {
        $('#import_csv_btn').html('Importing...');
      },
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
      }
    })
  });
</script>

<script>
  // ///first Time Load Function
  // $(function() {
  //   getprofessionforadd($('#professional_field_id').val());
  // })

  // function getprofessionforadd(id) {
  //   $('#professionadd').find('option')
  //     .remove()
  //     .end();
  //   $.ajax({
  //     type: 'POST',
  //     url: "<?php echo base_url('Providers/GetProfessionByParentProfessional') ?>",
  //     data: {
  //       professional_field_id: id,
  //       table: 'profession',
  //     },
  //     dataType: 'html',
  //     success: function(data) {
  //       let res = JSON.parse(data);
  //       switch (res.code) {
  //         case 'success':

  //           let list = ' ';
  //           for (let index = 0; index < res.data.length; index++) {
  //             list += '<option value=' + res.data[index]['profession_id'] + ' >' + res.data[index]['profession_field_title'] + '</option>';
  //           }
  //           $('#professionadd').append(list);
  //           break;
  //         case 'warning':


  //           break;

  //       }
  //     }
  //   });
  // }
</script>
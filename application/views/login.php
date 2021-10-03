<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo (isset($title)) ? $title : 'No Title ' ?></title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>vendors/jquery-toast-plugin/jquery.toast.min.css">
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/') ?>images/favicon.png" />
</head>

<body class="sidebar-fixed">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h4 class="text-center">Ecomplicato Management</h4>
                <!-- <img src="<?php echo base_url('assets/') ?>images/logo-dark.svg" alt="logo"> -->
              </div>
              <form class="submit-form pt-3" action="<?php echo base_url('login') ?>">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <!-- <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div> -->
                  <a href="javascript:void(0)" class="auth-link text-black" data-toggle="modal" data-target="#forgot-password">Forgot password?</a>
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <!-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="Javascript:void(0)" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- Modal -->
  <div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Password Resest Process</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="submit-form" action="<?php echo base_url('forgot-password') ?>">
            <div class="form-group">
              <label>Username</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <label>Confrim Password</label>
              <input type="password" name="cpassword" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- base:js -->
  <script src="<?php echo base_url('assets/') ?>vendors/base/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url('assets/') ?>vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/toastDemo.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
<script>
  ///submit form
  $('.submit-form').submit(function(e) {

    e.preventDefault();
    e.stopPropagation();
    var form = $(this).serialize();
    var url = $(this).attr('action');

    $.ajax({
      type: 'POST',
      url: url,
      data: form,
      dataType: 'html',
      success: function(data) {
        let res = JSON.parse(data);
        switch (res.code) {
          case 'success':
            // showSuccessToast(res.message);
            showSuccessSwal(res.message);


            if (res.page == 'login') {
              setTimeout(function() {
                window.location.href = "<?php echo base_url('login') ?>";
              }, 2500)

            } else {
              setTimeout(function() {
                window.location.href = "<?php echo base_url('dashboard') ?>";
              }, 2500)

            }

            break;
          case 'warning':
            // showWarningToast(res.message);
            showWarningSwal(res.message);
            break;
            // case 'error':
            //   res.message.forEach(function(error) {
            //     $('[name=' + error[0] + ']').parent().append('<span style="color:red; font-size:11px">' + error[1] + '</span>');
            //   })
            //   break;
        }
      }
    });

  });


  function showSuccessSwal(message) {
    swal({
      title: "Success!",
      text: message,
      className: 'swal-wide',
      icon: "success",
      button: false,
    });

  }


  function showWarningSwal(message) {
    swal({
      title: "Warning!",
      text: message,
      className: 'swal-wide',
      icon: "warning",
      button: false,
      timer: 3000,
    });

  }
</script>
<style>
  .swal-overlay {
    background-color: rgba(43, 165, 137, 0.45);

  }

  .swal-wide {
    width: 300px !important;
    height: 300px !important;
    position: absolute !important;
    top: 10px !important;
    right: 10px !important;
  }
</style>
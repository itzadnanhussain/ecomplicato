  <div class="footer-wrapper">
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; <?php echo date('Y') ?>. All rights reserved. </span>
      </div>
    </footer>
  </div>
  </div>
  </div>
  </div>

  <script src="<?php echo base_url('assets/') ?>js/off-canvas.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/template.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/settings.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/todolist.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/dashboard.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/custom.js"></script>
  <script src="<?php echo base_url('assets/') ?>vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/toastDemo.js"></script>
  <script>
    ///General Scripts

    // Select 2 Library Part:1
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        tags: true
      });
    });

    $(function() {
      var value = $("#select-condition option:selected").val();
      selectCondition(value);
    });

    function selectCondition(value) {
      if (value == "Some") {
        // $('#multi-select').show();
        $('#multi-select select').attr('disabled', false);
      } else if (value == "All") {
        $('#multi-select select').attr('disabled', true);
        // $('#multi-select').hide();
      }
    }

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

  </body>

  </html>
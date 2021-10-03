<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo (isset($title)) ? $title : 'No Title' ?></title>

  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="shortcut icon" href="<?php echo base_url('assets/') ?>images/favicon.png" />
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>vendors/jquery-toast-plugin/jquery.toast.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <!---- Script Tags------------->
  <script src="<?php echo base_url('assets/') ?>vendors/base/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url('assets/') ?>vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?php echo base_url('assets/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  

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
    .select2-container
    {
      width: auto !important;
    }
  </style>

</head>

<body class="sidebar-fixed">
  <div class="container-scroller">

    <!--Top Navigation Bar -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

      <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
        <a class="navbar-brand brand-logo" href="<?php echo base_url('dashboard') ?>">Ecomplicato</a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url('dashboard') ?>">EC</a>
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item  dropdown d-none align-items-center d-lg-flex d-none">
            <a class="dropdown-toggle btn btn-outline-secondary btn-fw" href="#" data-toggle="dropdown" id="pagesDropdown">
              <span class="nav-profile-name">Settings</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="pagesDropdown">
              <!-- <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a> -->
              <a class="dropdown-item" href="<?php echo base_url('logout') ?>">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>

            </div>
          </li>

        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>

    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link d-flex">
              <div class="profile-image">
                <img src="<?php echo base_url('assets/profile.jpg') ?>" alt="image">
              </div>
              <div class="profile-name">
                <p class="name">
                  <?php echo (isset($_SESSION['username'])) ? $_SESSION['username'] : 'AdminTest' ?>
                </p>
                <p class="designation">
                  Admin
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
              <i class="mdi mdi-shield-check menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('users') ?>">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('articles') ?>">
              <i class="mdi mdi mdi-library-books menu-icon"></i>
              <span class="menu-title">Articles</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('providers') ?>">
              <i class="mdi mdi-account-multiple-plus menu-icon"></i>
              <span class="menu-title">Providers</span>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-view-array menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/accordions.html">Accordions</a></li>
              </ul>
            </div>
          </li> -->
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
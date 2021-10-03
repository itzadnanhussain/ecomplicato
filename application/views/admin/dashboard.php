<div class="content-wrapper">
  <div class="row">
    <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Users In System</h4>
          <div class="d-flex justify-content-between">
            <p class="text-muted">Total Users</p>
            <p class="text-muted"> <?php echo (isset($user) && !empty($user) ? count($user) : 0) ?></p>
          </div>
          <div class="progress progress-md">
            <div class="progress-bar bg-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Articles In System</h4>
          <div class="d-flex justify-content-between">
            <p class="text-muted">Total Article</p>
            <p class="text-muted"> <?php echo (isset($article) && !empty($article) ? count($article) : 0) ?></p>
          </div>
          <div class="progress progress-md">
            <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Providers In System</h4>
          <div class="d-flex justify-content-between">
            <p class="text-muted">Total Providers</p>
            <p class="text-muted"> <?php echo (isset($provider) && !empty($provider) ? count($provider) : 0) ?></p>
          </div>
          <div class="progress progress-md">
            <div class="progress-bar bg-warning w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>



     


   

  </div>
</div>
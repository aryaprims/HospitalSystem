<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= base_url('assets/logo.png') ?>" type="image/x-icon">
  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
  <title>Posyandu | <?= $title ?></title>

  <script src="http://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.js"></script>
</head>

<body>
  <?php
  if ($this->session->userdata('username')) {
    $this->load->view('template/TopNav');
  ?>
    <div class="dashboard-wrapper container-fluid">
      <div class="row">
        <?php $this->load->view('template/SideNav'); ?>
        <div class="dashboard-container col-lg-10 col-md-9 col-sm-12">
          <?php $this->load->view($main_view); ?>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Data Deletion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete <span id="dataName"></span> ? </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="deleteButton">Confirm</button>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
    $this->load->view($main_view);
  }
  ?>
</body>

</html>
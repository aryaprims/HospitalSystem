<?php
if ($this->session->userdata('username')) {
  if ($this->session->userdata('hak_akses') != 1) {
    redirect('Landing/dashboard');
  }
} else {
  redirect('Landing/dashboard');
}
?>

<div class="py-5">
  <h1 class="text-center"><?= $title ?></h1>
  <div class="table-responsive container">
    <div class="d-flex justify-content-end px-3 mt-2">
      <button type="button" class="btn btn-primary" id="tambah" data-toggle="modal" data-target="#tambahModal">Tambah <?= $title ?></button>
    </div>
    <table class="table table-dark table-hover table-bordered" id="mydata" style="width: 100%">
      <thead>
        <tr>
          <th>Username</th>
          <th>Nama Admin</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Tambah Modal Admin -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Tambah <?= $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahForm" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="username" class="col-form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="password" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </div>
        <div class="form-button modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="tambahSubmit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    let table = $('#mydata').DataTable({
      "searching": false,
      "ordering": true,
      "order": [
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?= base_url('AdminController/data_admin') ?>",
        "type": "GET",
        "dataSrc": ""
      },
      "columns": [{
          "data": "username"
        },
        {
          "data": "nama"
        }
        
      ]
    });

    $('#tambahForm').on('submit', function(event) {
      event.preventDefault();
      let form = $(this);

      $.ajax({
        url: `<?= base_url('AdminController/add_admin') ?>`,
        type: 'post',
        data: form.serialize(),
        dataType: 'json',
        success: function(res) {
          if (res.success == true) {
            table.ajax.reload();
            $("#tambahModal").modal('hide');
          } else {
            $.each(res.messages, function(key, value) {
              let el = $('#' + key);
              el.closest('div.form-group').find("div.error").remove();
              el.after(value);
            })
          }
        }
      });
    });

    $('#tambahModal').on('hide.bs.modal', function() {
      $("#name").val("");
      $("#username").val("");
      $("#password").val("");
    })
  });
</script>
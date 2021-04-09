<?php
if ($this->session->userdata('username')) {
  if ($this->session->userdata('hak_akses') == 3) {
    redirect('PasienController/profile');
  }
} else {
  redirect('Landing/dashboard');
}
?>
<div class="py-5">
  <h1 class="text-center"><?= $title ?></h1>
  <div class="table-responsive container">
    <table class="table table-dark table-hover table-bordered" id="mydata" style="width: 100%">
      <thead>
        <tr>
          <th>Username</th>
          <th>NIP</th>
          <th>Nama Pasien</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editForm" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="nip" class="col-form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip">
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="username" class="col-form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
        </div>
        <div class="form-button modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="editSubmit">Submit</button>
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
        [1, 'asc']
      ],
      "ajax": {
        "url": "<?= base_url('PasienController/all_data_pasien') ?>",
        "type": "GET",
        "dataSrc": ""
      },
      "columns": [{
          "data": "username"
        },
        {
          "data": "nip"
        },
        {
          "data": "nama"
        },
        {
          "data": "username",
          "render": function(data, type, row) {
            return `<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="${data}"><i class="fas fa-trash"></i></button><div class="mt-2 ml-md-2 mt-md-0 d-inline-block"><button class="btn btn-primary mr-2" data-toggle="modal" data-target="#editModal" data-edit="${data}"><i class="fas fa-edit"></i></button></div>`
          }
        }
      ]
    });

    $('#deleteModal').on('show.bs.modal', function(event) {
      let username = $(event.relatedTarget).data('whatever');
      let modal = $(this)
      modal.find('#dataName').text(username)
      $('#deleteButton').on('click', function() {
        $.ajax({
          url: `<?= base_url('PasienController/delete_pasien/') ?>${username}`,
          type: "GET",
          async: true,
          dataType: "JSON"
        })
        table.ajax.reload();
        $("#deleteModal").modal('hide');
      })
    });

    $('#editModal').on('show.bs.modal', function(event) {
      let username = $(event.relatedTarget).data('edit');
      let modal = $(this);

      $.ajax({
        url: `<?= base_url('PasienController/data_pasien/') ?>${username}`,
        type: "GET",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#nip").val(data.nip);
            $("#name").val(data.nama);
            $("#username").val(data.username);
          } else {
            console.log("error");
          }
        }
      })

      $('#editForm').on('submit', function(event) {
        event.preventDefault();
        let form = $(this);

        $.ajax({
          url: `<?= base_url('PasienController/update_pasien/') ?>${username}`,
          type: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function(res) {
            if (res.success == true) {
              $("#nip").val('');
              $("#name").val('');
              $("#username").val('');
              table.ajax.reload();
              $("#editModal").modal('hide');
            } else {
              $.each(res.messages, function(key, value) {
                let el = $('#' + key);
                el.closest('div.form-group').find("div.error").remove();
                el.after(value);
              })
            }
          }
        })
      })
    });
  });
</script>
<?php
if ($this->session->userdata('username')) {
  if ($this->session->userdata('hak_akses') == 3) {
    redirect('Landing/dashboard');
  }
} else {
  redirect('Landing/dashboard');
}
?>

<div class="py-5">
  <h1 class="text-center"><?= $title ?></h1>
  <div class="table-responsive container">
    <?php
    if ($this->session->userdata('hak_akses') == 1) {
      echo '<div class="d-flex justify-content-end px-3 mt-2">
      <button type="button" class="btn btn-primary" id="tambah" data-toggle="modal" data-target="#tambahModal">Tambah ' . $title . '</button>
    </div>';
    }
    ?>
    <table class="table table-dark table-hover table-bordered" id="mydata" style="width: 100%">
      <thead>
        <tr>
          <th>Username</th>
          <th>Nama Dokter</th>
          <th>Spesialis</th>
          <th>Lama Bekerja</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Tambah Modal Dokter -->
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
          <div class="form-group">
            <label for="spesialis" class="col-form-label">Spesialis</label>
            <input type="text" class="form-control" id="spesialis" name="spesialis">
          </div>
          <div class="form-group">
            <label for="lama_bekerja" class="col-form-label">Lama Bekerja</label>
            <input type="text" class="form-control" id="lama_bekerja" name="lama_bekerja">
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
            <label for="nip" class="col-form-label">Username</label>
            <input type="text" class="form-control" id="usernameEdit" name="username">
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="namaEdit" name="nama">
          </div>
          <div class="form-group">
            <label for="username" class="col-form-label">Spesialis</label>
            <input type="text" class="form-control" id="spesialisEdit" name="spesialis">
          </div>
          <div class="form-group">
            <label for="username" class="col-form-label">Lama Bekerja</label>
            <input type="text" class="form-control" id="lama_bekerjaEdit" name="lama_bekerja">
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
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?= site_url('DokterController/data_dokter') ?>",
        "type": "GET",
        "dataSrc": ""
      },
      "columns": [{
          "data": "username"
        },
        {
          "data": "nama"
        },
        {
          "data": "spesialis"
        },
        {
          "data": "lama_bekerja"
        },
        {
          "data": "username",
          "render": function(data, type, row) {
            return <?= $this->session->userdata('hak_akses'); ?> == 1 ? `<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="${data}"><i class="fas fa-trash"></i></button>
            <div class="mt-2 mt-md-0 ml-md-2 d-inline-block"><button class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-edit="${data}"><i class="fas fa-edit"></i></button></div>` : ''
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
          url: `<?= base_url('DokterController/delete_dokter/') ?>${username}`,
          type: "GET",
          async: true,
          dataType: "JSON",
        })
        table.ajax.reload();
        $("#deleteModal").modal('hide');
      })
    });

    $('#tambahForm').on('submit', function(event) {
      event.preventDefault();
      let form = $(this);

      $.ajax({
        url: `<?= base_url('DokterController/add_dokter') ?>`,
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
      $("#spesialis").val("");
      $("#lama_bekerja").val("");
    });

    $('#editModal').on('show.bs.modal', function(event) {
      let username = $(event.relatedTarget).data('edit');
      let modal = $(this);

      $.ajax({
        url: `<?= base_url('DokterController/getOneDokter/') ?>${username}`,
        type: "GET",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#usernameEdit").val(data.username);
            $("#namaEdit").val(data.nama);
            $("#spesialisEdit").val(data.spesialis);
            $("#lama_bekerjaEdit").val(data.lama_bekerja);
          } else {
            console.log("error");
          }
        }
      })

      $('#editForm').on('submit', function(event) {
        event.preventDefault();
        let form = $(this);
        $.ajax({
          url: `<?= base_url('DokterController/edit_dokter/') ?>${username}`,
          type: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function(res) {
            if (res.success == true) {
              $("#usernameEdit").val('');
              $("#namaEdit").val('');
              $("#spesialisEdit").val('');
              $("#lama_bekerjaEdit").val('');
              table.ajax.reload();
              $('#editModal').modal('hide');
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
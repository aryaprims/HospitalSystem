<?php
if (!$this->session->userdata('username')) {
  redirect('Landing/dashboard');
}
?>

<!-- Tabel Jadwal Imunisasi -->
<div class="py-5">
  <h1 class="text-center"><?= $title ?></h1>
  <div class="table-responsive container">
    <?php
    if ($this->session->userdata('hak_akses') == 2) {
      echo '<div class="d-flex justify-content-end px-3 mt-2">
      <button type="button" class="btn btn-primary" id="tambah" data-toggle="modal" data-target="#tambahModal">Tambah ' . $title . '</button>
    </div>';
    }
    ?>
    <table class="table table-dark table-hover table-bordered" id="mydata" style="width: 100%">
      <thead>
        <tr>
          <th>Jadwal</th>
          <th>Nama Dokter</th>
          <th>Spesialis</th>
          <th>Lama Bekerja</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Tambah Modal Jadwal Imunisasi -->
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
            <label for="tanggal" class="col-form-label">Jadwal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
          </div>
          <div class="form-group">
            <label for="nama" class="col-form-label">Nama Dokter</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $this->session->userdata('nama'); ?>" disabled>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_dokter" name="id_dokter" value="<?= $this->session->userdata('id'); ?>">
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
            <label for="tanggal" class="col-form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggalJadwal" name="tanggalJadwal">
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
  // Get Data Jadwal
  $(document).ready(function() {
    const id = <?= $this->session->userdata('id'); ?>;
    let table = $('#mydata').DataTable({
      "ordering": true,
      "order": [
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?= site_url('JadwalController/data_jadwal') ?>",
        "type": "GET",
        "dataSrc": ""
      },
      "columns": [{
          "data": "tanggal"
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
          "data": "id_jadwal",
          "render": function(data, type, row) {
            return <?= $this->session->userdata('hak_akses'); ?> == 2 && row.id_dokter == id ? `<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="${data}"><i class="fas fa-trash"></i></button>
            <div class="mt-2 mt-md-0 ml-md-2 d-inline-block"><button class="btn btn-primary mr-2" data-toggle="modal" data-target="#editModal" data-edit="${data}"><i class="fas fa-edit"></i></button></div>` : ''
          }
        }
      ]
    });

    // Delete Modal
    $('#deleteModal').on('show.bs.modal', function(event) {
      let id_jadwal = $(event.relatedTarget).data('whatever');
      let jadwal = $(event.relatedTarget).data('name');
      let modal = $(this)
      modal.find('#dataName').text(`jadwal ${jadwal}`)
      $('#deleteButton').on('click', function() {
        $.ajax({
          url: `<?= base_url('JadwalController/delete_jadwal/') ?>${id_jadwal}`,
          type: "GET",
          async: true,
          dataType: "JSON",
        })
        table.ajax.reload();
        $("#deleteModal").modal('hide');
      })
    });

    // Edit Modal
    $('#editModal').on('show.bs.modal', function(event) {
      let id_jadwal = $(event.relatedTarget).data('edit');

      $.ajax({
        url: `<?= base_url('JadwalController/data_tanggal/') ?>${id_jadwal}`,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          if (data) {
            $("#tanggalJadwal").val(data.tanggal)
          } else {
            console.log("error")
          }
        }
      })

      // edit Form
      $('#editForm').on('submit', function(event) {
        event.preventDefault();
        let form = $(this);

        $.ajax({
          url: `<?= base_url('JadwalController/update_jadwal/') ?>${id_jadwal}`,
          type: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function(res) {
            if (res.success == true) {
              $("#tanggalJadwal").val('');
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
      });
    });




    // Tambah Form
    $('#tambahForm').on('submit', function(event) {
      event.preventDefault();
      let form = $(this);

      $.ajax({
        url: `<?= base_url('JadwalController/add_jadwal') ?>`,
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

    // Tambah Modal
    $('#tambahModal').on('hide.bs.modal', function() {
      $("#tanggal").val("");
    });
  });
</script>
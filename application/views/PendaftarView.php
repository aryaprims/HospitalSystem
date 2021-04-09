<?php
if (!$this->session->userdata('username')) {
  redirect('Landing/dashboard');
}
?>

<div class="py-5">
  <h1 class="text-center"><?= $title ?></h1>
  <div class="table-responsive container">
    <?php if ($this->session->userdata('hak_akses') == 3) {
      echo '<div class="d-flex justify-content-end px-3 mt-2">
      <button type="button" class="btn btn-primary" id="tambah" data-toggle="modal" data-target="#tambahModal">Tambah ' . $title . '</button>
    </div>';
    }
    ?>
    <table class="table table-dark table-hover table-bordered" id="mydata" style="width: 100%">
      <thead>
        <tr>
          <th>NIP</th>
          <th>No Antrian</th>
          <th>Tanggal</th>
          <th>Nama Dokter</th>
          <th>Usia Anak</th>
          <th>Tinggi Anak</th>
          <th>Berat Anak</th>
          <th>Keluhan</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Tambah Modal Pendaftar -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
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
            <label for="nip" class="col-form-label">NIP</label>
            <input type="text" class="form-control" value="<?= $this->session->userdata('id') ?>" id="nip" name="nip" readonly>
          </div>
          <div class="form-group">
            <label for="no_antrian" class="col-form-label">No Antrian</label>
            <input type="text" class="form-control no_antrian" id="no_antrian" name="no_antrian" readonly>
          </div>
          <div class="form-group">
            <label for="tanggal" class="col-form-label">Tanggal</label>
            <select class="form-control tanggal" id="tanggal" name="tanggal">
              <?php
              $query = $this->db->get('jadwal_imunisasi');
              $result = $query->result_array();
              foreach ($result as $key) {
                echo "<option value='" . $key['id_jadwal'] . "'>" . $key['tanggal'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="row">
            <div class="form-group col-9">
              <!-- <div class="col-9"> -->
              <label for="usia_anak" class="col-form-label">Usia Anak</label>
              <input type="number" min="0" class="form-control" id="usia_anak" name="usia_anak">
              <!-- </div> -->
              <!-- <div class="col-3 d-flex align-items-end"> -->
              <!-- </div> -->
            </div>
            <div class="form-group col-3">
              <label for="usia" class="col-form-label" style="visibility: hidden;">.</label>
              <select class="form-control" id="usia" name="usia">
                <option value="Tahun">Tahun</option>
                <option value="Bulan">Bulan</option>
                <option value="Hari">Hari</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-10">
              <label for="tinggi_anak" class="col-form-label">Tinggi Anak</label>
              <input type="number" min="0" class="form-control" id="tinggi_anak" name="tinggi_anak">
            </div>
            <div class="form-group col-2">
              <label class="col-form-label" style="visibility: hidden;">.</label>
              <input type="text" disabled class="form-control-plaintext" value="cm">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-10">
              <label for="berat_anak" class="col-form-label">Berat Anak</label>
              <input type="number" min="0" class="form-control" id="berat_anak" name="berat_anak">
            </div>
            <div class="form-group col-2">
              <label class="col-form-label" style="visibility: hidden;">.</label>
              <input type="text" disabled class="form-control-plaintext" value="kg">
            </div>
          </div>
          <div class="form-group">
            <label for="keluhan" class="col-form-label">Keluhan</label>
            <input type="text" class="form-control" id="keluhan" name="keluhan">
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

<!-- Edit Modal Pendaftar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Tambah <?= $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editForm" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="nip-edit" class="col-form-label">NIP</label>
            <input type="text" class="form-control" value="<?= $this->session->userdata('id') ?>" id="nip-edit" name="nip-edit" readonly>
          </div>
          <div class="form-group">
            <label for="no_antrian-edit" class="col-form-label">No Antrian</label>
            <input type="text" class="form-control no_antrian" id="no_antrian-edit" name="no_antrian-edit" readonly>
          </div>
          <div class="form-group">
            <label for="tanggal-edit" class="col-form-label">Tanggal</label>
            <select class="form-control tanggal" id="tanggal-edit" name="tanggal-edit">
              <?php
                $query = $this->db->get('jadwal_imunisasi');
                $result = $query->result_array();
                foreach ($result as $key) {
                  echo "<option value='" . $key['id_jadwal'] . "'>" . $key['tanggal'] . "</option>";
                }
              ?>
            </select>
          </div>
          <input type="hidden" name="tanggal-hidden" id="tanggal-hidden">
          <div class="row">
            <div class="form-group col-9">
              <!-- <div class="col-9"> -->
              <label for="usia_anak-edit" class="col-form-label">Usia Anak</label>
              <input type="number" min="0" class="form-control" id="usia_anak-edit" name="usia_anak-edit">
              <!-- </div> -->
              <!-- <div class="col-3 d-flex align-items-end"> -->
              <!-- </div> -->
            </div>
            <div class="form-group col-3">
              <label for="usia-edit" class="col-form-label" style="visibility: hidden;">.</label>
              <select class="form-control" id="usia-edit" name="usia-edit">
                <option value="Tahun">Tahun</option>
                <option value="Bulan">Bulan</option>
                <option value="Hari">Hari</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-10">
              <label for="tinggi_anak-edit" class="col-form-label">Tinggi Anak</label>
              <input type="number" min="0" class="form-control" id="tinggi_anak-edit" name="tinggi_anak-edit">
            </div>
            <div class="form-group col-2">
              <label class="col-form-label" style="visibility: hidden;">.</label>
              <input type="text" disabled class="form-control-plaintext" value="cm">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-10">
              <label for="berat_anak-edit" class="col-form-label">Berat Anak</label>
              <input type="number" min="0" class="form-control" id="berat_anak-edit" name="berat_anak-edit">
            </div>
            <div class="form-group col-2">
              <label class="col-form-label" style="visibility: hidden;">.</label>
              <input type="text" disabled class="form-control-plaintext" value="kg">
            </div>
          </div>
          <div class="form-group">
            <label for="keluhan-edit" class="col-form-label">Keluhan</label>
            <input type="text" class="form-control" id="keluhan-edit" name="keluhan-edit">
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
    const baseUrl = <?= $this->session->userdata('hak_akses') ?> != 3 ? `<?= base_url('PendaftarController/data_pendaftar') ?>` : `<?= base_url("PendaftarController/data_one_pendaftar/" . $this->session->userdata('id')) ?>`
    let table = $('#mydata').DataTable({
      "searching": false,
      "ordering": true,
      "order": [
        [1, 'asc']
      ],
      "ajax": {
        "url": baseUrl,
        "type": "GET",
        "dataSrc": ""
      },
      "columns": [{
          "data": "nip"
        },
        {
          "data": "no_antrian"
        },
        {
          "data": "tanggal"
        },
        {
          "data": "nama"
        },
        {
          "data": "usia_anak"
        },
        {
          "data": "tinggi_anak"
        },
        {
          "data": "berat_anak"
        },
        {
          "data": "keluhan"
        },
        {
          "data": "id_tabel_pendaftar",
          "render": function(data, type, row) {
            return <?= $this->session->userdata("hak_akses") ?> == 3 ? `<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-nip="${row.nip}" data-antrian="${row.no_antrian}" data-whatever="${data}"><i class="fas fa-trash"></i></button><div class="mt-2 ml-md-2 mt-md-0 d-inline-block"><button class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-nip="${row.nip}" data-antrian="${row.no_antrian}" data-edit="${data}"><i class="fas fa-edit"></i></button></div>` : ""
          }
        }
      ]
    });

    function count_jadwal(id_jadwal) {
      $.ajax({
        url: `<?= base_url('PendaftarController/count_jadwal/') ?>${id_jadwal}`,
        type: "GET",
        dataType: "JSON",
        success: function(res) {
          $(".no_antrian").val(res + 1);
        }
      })
    }

    $('#deleteModal').on('show.bs.modal', function(event) {
      let id_tabel_pendaftar = $(event.relatedTarget).data('whatever');
      let nip = $(event.relatedTarget).data('nip');
      let no_antrian = $(event.relatedTarget).data('antrian');
      let modal = $(this)
      modal.find('#dataName').text("nip " + nip + " antrian " + no_antrian);
      $('#deleteButton').on('click', function() {
        $.ajax({
          url: `<?= base_url('PendaftarController/delete_pendaftar/') ?>${id_tabel_pendaftar}`,
          type: "GET",
          async: true,
          dataType: "JSON",
        })
        table.ajax.reload();
        $("#deleteModal").modal('hide');
      })
    });

    $('#tambahModal').on('show.bs.modal', function() {
      count_jadwal($(".tanggal").val());
    })

    $('#editModal').on('show.bs.modal', function() {
      count_jadwal($(".tanggal").val());
    })

    $('#tambahForm').on('submit', function(event) {
      event.preventDefault();
      let form = $(this);

      $.ajax({
        url: `<?= base_url('PendaftarController/add_pendaftar') ?>`,
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
      $("#no_antrian").val("");
      $("#usia_anak").val("");
      $("#tinggi_anak").val("");
      $("#berat_anak").val("");
      $("#keluhan").val("");
      $("#tanggal").val($("#tanggal option:first").val());
      $("input, select").closest('div.form-group').find("div.error").remove()
    })

    $('#editModal').on('show.bs.modal', function(event) {
      let id = $(event.relatedTarget).data('edit');

      $.ajax({
        url: `<?= base_url('PendaftarController/data_pendaftar_by_id/') ?>${id}`,
        type: "GET",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#nip-edit").val(data.nip);
            $("#tanggal-edit").val(data.id_jadwal);
            $("#tanggal-hidden").val(data.id_jadwal);
            $("#usia_anak-edit").val(data.usia_anak.split(" ")[0]);
            $("#usia-edit").val(data.usia_anak.split(" ")[1]);
            $("#tinggi_anak-edit").val(data.tinggi_anak.split(" ")[0]);
            $("#berat_anak-edit").val(data.berat_anak.split(" ")[0]);
            $("#keluhan-edit").val(data.keluhan);
          } else {
            console.log("error");
          }
        }
      })

      $('#editForm').on('submit', function(event) {
        event.preventDefault();
        let form = $(this);

        $.ajax({
          url: `<?= base_url('PendaftarController/update_pendaftar/') ?>${id}`,
          type: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function(res) {
            if (res.success == true) {
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

    $('#editModal').on('hide.bs.modal', function() {
      $("#no_antrian-edit").val("");
      $("#usia_anak-edit").val("");
      $("#tinggi_anak-edit").val("");
      $("#berat_anak-edit").val("");
      $("#keluhan-edit").val("");
      $("#tanggal-edit").val($("#tanggal-edit option:first").val());
      $("input, select").closest('div.form-group').find("div.error").remove()
    })

    $(".tanggal").on('change', function() {
      count_jadwal($(this).val())
    });
  });
</script>
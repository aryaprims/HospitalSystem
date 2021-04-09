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
    <table class="table table-dark table-hover table-bordered" id="mydata" style="width: 100%;">
      <thead>
        <tr>
          <th>Username</th>
          <th>Nama User</th>
          <th>Hak Akses</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    let table = $('#mydata').DataTable({
      "searching": false,
      "ordering": true,
      "order": [
        [2, 'asc']
      ],
      "ajax": {
        "url": "<?= site_url('AkunController/data_akun') ?>",
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
          "data": "hak_akses"
        },
        {
          "data": "hak_akses",
          "render": function(data, type, row) {
            return data != 1 ? `<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="${row.username}"><i class="fas fa-trash"></i></button>` : '';
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
          url: `<?= base_url('AkunController/delete_akun/') ?>${username}`,
          type: "GET",
          async: true,
          dataType: "JSON",
        })
        table.ajax.reload();
        $("#deleteModal").modal('hide');
      })
    });
  });
</script>
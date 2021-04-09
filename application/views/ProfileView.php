<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-12 p-3 p-md-0 d-flex flex-column align-items-center">
        <img src="<?= base_url('assets/bendi.png') ?>" alt="bendi.png" style="border-radius: 100px; border: 1px solid white; box-shadow: 1px 5px 15px rgba(0, 0, 0, 0.5);" width="200px" height="200px">
        <h3 class="my-3 text-wrap text-center">Profil <?= $this->session->userdata('nama'); ?></h3>
      </div>
      <div class="col-md-9 col-12 p-3 p-md-0 p-3">
        <div class="ml-md-5 ml-0">
          <form id="profileForm" method="POST">
            <div class="form-group">
              <label for="nip" class="col-form-label">NIP</label>
              <input type="text" id="nip" name="nip" class="form-control">
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Nama</label>
              <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="username" class="col-form-label">Username</label>
              <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <input type="hidden" id="hidden" name="hidden" class="form-control">
            </div>
            <div class="form-button text-right">
              <button type="submit" class="btn btn-primary" data-target="#modal" data-toggle="modal">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda ingin update profile anda?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    getData()
  
    function getData() {
      const username = "<?= $this->session->userdata("username"); ?>"
      const url = `<?= base_url("PasienController/data_pasien/") ?>${username}`
      $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#nip").val(data.nip);
            $("#name").val(data.nama);
            $("#username").val(data.username);
            $("#hidden").val(data.username);
          } else {
            console.log("error");
          }
        }
      })
    }

    $("#profileForm").on("submit", function(event) {
      event.preventDefault();
      let form = $(this);
      $("#update").on("click", function() {
        const username = $("#hidden").val();
        $.ajax({
          url: `<?= base_url("PasienController/update_profile/") ?>${username}`,
          type: 'post',
          data: form.serialize(),
          dataType: 'json',
          success: function(res) {
            if (res.success == true) {
              getData()
            } else {
              $.each(res.messages, function(key, value) {
                let el = $('#' + key);
                el.closest('div.form-group').find("div.error").remove();
                el.after(value);
              })
            }
            $("#modal").modal('hide');
          }
        });
      })
    })
  })
</script>
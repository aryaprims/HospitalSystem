<aside class="side-nav-wrapper col-lg-2 col-md-3 col-sm-12" id="sideNav">
  <div class="side-nav-container">
    <span class="d-md-none">
      <a class="d-flex justify-content-between align-items-center" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <span>
          Welcome!
          <?= $this->session->userdata('nama') ?>
        </span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <?php if ($this->session->userdata('hak_akses') == 3) { ?>
        <div class="collapse" id="collapseExample">
          <a href="<?= site_url('PasienController') ?>">
            <i class="fas fa-user-circle"></i>
            Profile
          </a>
          <a href="<?= site_url('Landing/logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            logout
          </a>
        </div>
      <?php } else { ?>
        <div class="collapse" id="collapseExample">
          <a href="<?= site_url('Landing/logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            logout
          </a>
        </div>
      <?php } ?>
    </span>

    <a href="<?= site_url('Landing/dashboard') ?>" class="<?php if ($title == "Dashboard") {
                                                            echo "active";
                                                          } ?>">
      <i class="fas fa-columns"></i>
      Dashboard
    </a>
    <a href="<?= site_url('AkunController') ?>" class="<?php if ($title == "Data Akun") {
                                                          echo "active";
                                                        } ?> <?php if ($this->session->userdata('hak_akses') != 1) {
                                                                echo "hide-nav";
                                                              } ?>">
      <i class="fas fa-users"></i>
      Akun
    </a>
    <a href="<?= site_url('AdminController') ?>" class="<?php if ($title == "Data Admin") {
                                                          echo "active";
                                                        } ?> <?php if ($this->session->userdata('hak_akses') != 1) {
                                                                echo "hide-nav";
                                                              } ?>">
      <i class="fas fa-user-cog"></i>
      Admin
    </a>
    <a href="<?= site_url('DokterController') ?>" class="<?php if ($title == "Data Dokter") {
                                                            echo "active";
                                                          } ?> <?php if ($this->session->userdata('hak_akses') == 3) {
                                                                  echo "hide-nav";
                                                                } ?>">
      <i class="fas fa-user-md"></i>
      Dokter
    </a>
    <a href="<?= site_url('PasienController') ?>" class="<?php if ($title == "Data Pasien") {
                                                            echo "active";
                                                          } ?> <?php if ($this->session->userdata('hak_akses') != 1) {
                                                                  echo "hide-nav";
                                                                } ?>">
      <i class="fas fa-hospital-user"></i>
      Pasien
    </a>
    <a href="<?= site_url('PendaftarController') ?>" class="<?php if ($title == "Data Pendaftaran") {
                                                              echo "active";
                                                            } ?>">
      <i class="fas fa-notes-medical"></i>
      Pendaftaran
    </a>
    <a href="<?= site_url('JadwalController') ?>" class="<?php if ($title == "Data Jadwal Imunisasi") {
                                                            echo "active";
                                                          } ?>">
      <i class="fas fa-calendar"></i>
      Jadwal Imunisasi
    </a>
  </div>
</aside>
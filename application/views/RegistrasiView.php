<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #ADB7D9;">
  <a class="navbar-brand landing-logo" href="<?= site_url() ?>">
    <img src="<?= base_url('assets/logo.png') ?>" alt="logo">
    Posyandu
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse landing-navbar-item" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Landing/login') ?>">Sign In</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Landing/registrasi') ?>">Sign Up</a>
      </li>
    </ul>
  </div>
</nav>

<div class="landing-content d-flex justify-content-center align-items-center flex-wrap">
  <div class="landing-vector">
    <img src="<?= base_url('assets/vector.png') ?>" alt="vector" width="100%">
  </div>
  <div class="sign-in-form p-xl-0 p-3 mt-3 m-xl-0">
    <div class="card ml-xl-5">
      <div class="card-header">Sign In to Posyandu</div>
      <div class="card-body">
        <?= $this->session->flashdata('message'); ?>

        <form class="user" method="post" action="<?= site_url('Landing/registrasi') ?>">
          <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP" value="<?= set_value('nip'); ?>">
            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class=" form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class=" form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="password1">Password</label>
              <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
              <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-sm-6">
              <label for="password2">Repeat Password</label>
              <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
            </div>
          </div>
          <div class="form-button text-center">
            <button type="submit" class="btn btn-user btn-dark">
              Sign Up
            </button>
          </div>
        </form>
        <div class="text-center mt-2">
          <a class="text-white" href="<?= site_url('Landing/login') ?>">Already have an account? Login!</a>
        </div>
      </div>
    </div>
  </div>
  <div class="big-circle"></div>
</div>
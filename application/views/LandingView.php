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
  <div class="landing-text-wrapper p-3 p-md-none">
    <div class="landing-text">
      <h1>Stay Healthy With Us</h1>
      <p>Health is a state of complete physical, mental and social well-being, and not merely the absence of disease or infirmity</p>
      <div class="text-center">
        <a href="<?= site_url('Landing/registrasi') ?>" class="big-sign-up-button">Sign Up Here !!!</a>
      </div>
    </div>
    <div class="small-circle"></div>
  </div>
  <div class="big-circle"></div>
</div>
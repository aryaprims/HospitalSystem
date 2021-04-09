<nav class="dashboard-navbar navbar navbar-light fixed-top bg-white flex-wrap-none" style="padding: 0;">
  <div class="dashboard-brand d-flex align-items-center pl-2 mr-auto">
    <button class="navbar-toggler">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a href="<?= site_url("Landing/dashboard") ?>" class="navbar-brand landing-logo ml-3">Posyandu</a>
  </div>

  <ul id="navbar-content" class="navbar-nav d-flex flex-row pr-3">
    <li class="nav-item d-md-block d-none" id="menuUser">
      <a class="nav-link">
        <span class="pr-2">
          Welcome!
          <?= $this->session->userdata('nama') ?>
        </span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <?php if ($this->session->userdata('hak_akses') == 3) { ?>
      <div class="d-none" id="floatingMenu">
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
      <div class="d-none" id="floatingMenu">
        <a href="<?= site_url('Landing/logout') ?>">
          <i class="fas fa-sign-out-alt"></i>
          logout
        </a>
      </div>
    <?php } ?>
    </li>
  </ul>
</nav>

<script type="text/javascript">
  $(document).ready(function() {
    if ($(window).width() < 769) {
      if (!($("#sideNav").hasClass("d-none"))) {
        $("#sideNav").toggleClass("d-none");
        $(".dashboard-container").toggleClass("col-lg-10");
        $(".dashboard-container").toggleClass("col-md-9");
        $(".dashboard-container").toggleClass("col-sm-12");
        $(".dashboard-container").toggleClass("col-12");
      }
    } else {
      if (($("#sideNav").hasClass("d-none"))) {
        $("#sideNav").toggleClass("d-none");
        $(".dashboard-container").toggleClass("col-lg-10");
        $(".dashboard-container").toggleClass("col-md-9");
        $(".dashboard-container").toggleClass("col-sm-12");
        $(".dashboard-container").toggleClass("col-12");
      }
    }

    $("#menuUser").click(function() {
      $("#floatingMenu").toggleClass("d-none");
    })

    $(".navbar-toggler").click(function() {
      $("#sideNav").toggleClass("d-none");
      if ($(window).width() > 769) {
        $(".dashboard-container").toggleClass("col-lg-10");
        $(".dashboard-container").toggleClass("col-md-9");
        $(".dashboard-container").toggleClass("col-sm-12");
        $(".dashboard-container").toggleClass("col-12");
      }
    })

    $(window).resize(function() {
      if ($(window).width() < 769) {
        if (!($("#sideNav").hasClass("d-none"))) {
          $("#sideNav").toggleClass("d-none");
          $(".dashboard-container").toggleClass("col-lg-10");
          $(".dashboard-container").toggleClass("col-md-9");
          $(".dashboard-container").toggleClass("col-sm-12");
          $(".dashboard-container").toggleClass("col-12");
          $("#floatingMenu").toggleClass("d-none");
        }
      } else {
        if (($("#sideNav").hasClass("d-none"))) {
          $("#sideNav").toggleClass("d-none");
          $(".dashboard-container").toggleClass("col-lg-10");
          $(".dashboard-container").toggleClass("col-md-9");
          $(".dashboard-container").toggleClass("col-sm-12");
          $(".dashboard-container").toggleClass("col-12");
        }
      }
    })
  })
</script>
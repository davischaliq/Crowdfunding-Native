<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title">
      <a href="admin.php" class="site_title"><i class="fa fa-user"></i><span>Admin</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu samping -->
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] != ""): ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li>
            <a href="<?= BASEURL; ?>Dashboard/index"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li>
            <a href="<?= BASEURL; ?>Dashboard/transaksi"><i class="fa fa-file-invoice"></i>Daftar Transaksi</a>
          </li>
          <li><a><i class="fas fa-desktop"></i>Invest<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li>
                <a href="Movie_P">Pemohon</a>
              </li>
              <li>
                <a href="Movie_PO">Progess</a>
              </li>
            </ul>
          </li>
          <!-- <li><a><i class="fas fa-eye"></i>Content<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li>
                <a href="movie_D">Movie</a>
              </li>
              <li>
                <a href="movie_DO">Movie Oncoming</a>
              </li>
              <li>
                <a href="news_D">News / Event</a>
              </li>
            </ul>
          </li> -->
        </ul>
      </div>
    </div>
  <?php endif; ?>
    <!-- menu samping -->

    <!-- menu samping -->
    <?php if (isset($_SESSION['head']) && $_SESSION['head'] != ""): ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li>
            <a href="<?= BASEURL; ?>Dashboard/transaksi"><i class="fa fa-file-invoice"></i>Penilaian</a>
          </li>
        </ul>
      </div>
    </div>
  <?php endif; ?>
    <!-- menu samping -->

  </div>
</div>

<!-- awal navigation atas -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle">
          <i class="fa fa-bars"></i>
        </a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            admin
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li>
              <a href="keluar.php"><i class="fa fa-sign-out pull-right"></i> Keluar</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- akhir navigation bawah -->

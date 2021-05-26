<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion toggled" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="darkmode-ignore sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <img src="resource/img/logo_circle.webp" width="50" height="auto">
    </div>
    <div class="sidebar-brand-text mx-3">XpoStream</div>
  </a>

  <?php if ($_SESSION['reg_type'] == 'host') { ?>
    <!-- Nav Item - Host Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminMenu" aria-expanded="true" aria-controls="collapseSocialMedia">
        <i class="fas fa-fw fa-user-lock"></i>
        <span>Host</span>
      </a>
      <div id="collapseAdminMenu" class="collapse" aria-labelledby="headingcollapseAdminMenu" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Stream</h6>
          <a class="collapse-item" href="create_stream.php">Create Stream</a>
        </div>
      </div>
    </li>
  <?php } ?>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-home"></i>
      <span>Dashboard</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="darkmode-ignore sidebar-heading">
    Database
  </div>

  <!-- Nav Item - AniDB -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDatabaseSeasonal" aria-expanded="true" aria-controls="collapseDatabaseSeasonal">
      <i class="fas fa-fw fa-database"></i>
      <span>View</span></a>
    </a>
    <div id="collapseDatabaseSeasonal" class="collapse" aria-labelledby="headingDatabaseSeasonal" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Schedule</h6>
        <a class="collapse-item" href="exhibitions.php">Exhibitions List</a>
        <h6 class="collapse-header">Profile</h6>
        <a class="collapse-item" href="all_profiles.php">All Profiles</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="darkmode-ignore text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
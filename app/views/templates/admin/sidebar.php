<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-fw fa-dolly-flatbed"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $_ENV["APP_NAME"]; ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Configurations
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= BASE_URL; ?>admin/dashboard">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profile
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL; ?>admin/profile">
            <i class="fas fa-fw fa-user"></i>
            <span>My Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL; ?>admin/editprofile">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Edit Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL; ?>admin/changepassword">
            <i class="fas fa-fw fa-key"></i>
            <span>Change Password</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL; ?>admin/logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Log Out</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
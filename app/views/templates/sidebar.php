<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-fw fa-dolly-flatbed"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $_ENV["APP_NAME"]; ?></div>
    </a>
    <hr class="sidebar-divider mb-0">
    <?php if ($params['menu']) : ?>
        <?php foreach ($params['menu'] as $menu) : ?>
            <li class="nav-item my-0">
                <?php
                $role = strpos($menu['role_menu'], "|") ? explode("|", $menu['role_menu']) : $menu['role_menu'];
                if (is_array($role)) {
                    if (in_array($_COOKIE['role'], $role)) {
                        if ((int) $_COOKIE['role'] === 0) {
                            $url = 'user';
                        } elseif ((int) $_COOKIE['role'] === 1) {
                            $url = 'petugas';
                        } else {
                            $url = 'admin';
                        }
                    }
                } else {
                    if ($_COOKIE['role'] === $role) {
                        if ((int) $_COOKIE['role'] === 0) {
                            $url = 'user';
                        } elseif ((int) $_COOKIE['role'] === 1) {
                            $url = 'petugas';
                        } else {
                            $url = 'admin';
                        }
                    }
                }
                ?>
                <a class="nav-link" href="<?= BASE_URL . $url . $menu['link_menu'] ?>">
                    <i class="fas fa-fw <?= $menu['icon_menu'] ?>"></i>
                    <span><?= $menu['nama_menu'] ?></span></a>
            </li>
        <?php endforeach; ?>
        <li class="nav-item">
            <a href="" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </li>
    <?php else : ?>
        <li class="nav-item">
            <a href="#!" class="nav-link"><span>Nothing Found</span></a>
        </li>
    <?php endif; ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
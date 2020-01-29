<?php
if ((int) $_COOKIE["role"] === 0) {
    $url = "user";
} elseif ((int) $_COOKIE['role'] === 1) {
    $url = "petugas";
} else {
    $url = "admin";
}
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu Lists</h1>
    <a href="<?= BASE_URL . $url . "/menu/addnewmenu" ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle mr-2 fa-sm text-white-50"></i> Create New Menu</a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive mb-0 p-0">
                    <table class="table table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Menu Name</th>
                                <th>Menu Link</th>
                                <th>Menu Icon</th>
                                <th>Accessment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($params['menu']) : ?>
                                <?php $c = 1; ?>
                                <?php foreach ($params['menu'] as $menu) : ?>
                                    <tr>
                                        <td><?= $c; ?></td>
                                        <td><?= $menu["nama_menu"]; ?></td>
                                        <td><?= $menu["link_menu"]; ?></td>
                                        <td>
                                            (<i class="fas fa-fw <?= $menu["icon_menu"]; ?>"></i>)
                                            fas fa-fw <?= $menu["icon_menu"]; ?>
                                        </td>
                                        <?php
                                        $access = strpos($menu["role_menu"], "|") ? explode("|", $menu['role_menu']) : $menu["role_menu"];
                                        ?>
                                        <td>
                                            <?php if (is_array($access)) : ?>
                                                <?php if (count($access) > 2) : ?>
                                                    <span class="badge badge-success">all allowed</span>
                                                <?php else : ?>
                                                    <?php foreach ($access as $acc) : ?>
                                                        <?php if ((int) $acc === 0) : ?>
                                                            <span class="badge badge-warning">user</span>
                                                        <?php elseif ((int) $acc  === 1) : ?>
                                                            <span class="badge badge-info">petugas</span>
                                                        <?php else : ?>
                                                            <span class="badge badge-primary">admin</span>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span class="badge badge-<?= (int) $access === 0 ? "warning" : (int) $access === 1 ? "info" : "primary"; ?>">
                                                    <?= (int) $access === 0 ? "user" : (int) $access === 1 ? "petugas" : "admin"; ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-circle btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Edit this menu.">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-circle btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Delete this menu.">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $c++;  ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>Oops! No data detected.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
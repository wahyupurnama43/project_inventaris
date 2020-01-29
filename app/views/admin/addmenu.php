<?php $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin"; ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Menu</h1>
    <a href="<?= BASE_URL . $url . "/menu/addnewmenu" ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle mr-2 fa-sm text-white-50"></i> Create New Menu</a>
</div>

<div class="row">
    <div class="col-6">
        <?php flash(); ?>
        <div class="card shadow">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="menu_name">Name of the menu : </label>
                        <input type="text" name="menu_name" id="menu_name" class="form-control" placeholder="Enter the name of the menu ..." autocomplete="off">
                        <?= showError("menu_name_empty"); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu_link">Link of the menu : </label>
                        <input type="text" name="menu_link" id="menu_link" class="form-control" placeholder="e.g : /some_where" autocomplete="off">
                        <?= showError("menu_link_empty"); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu_icon">Icon of the menu : </label>
                        <input type="text" name="menu_icon" id="menu_icon" class="form-control" placeholder="e.g : fa-home" autocomplete="off">
                        <?= showError("menu_icon_empty"); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu_access">Accessment of the menu : </label>
                        <div class="d-flex">
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input" id="access_user" name="access_user" value="true">
                                <label class="custom-control-label" for="access_user">User</label>
                            </div>
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input" id="access_petugas" name="access_petugas" value="true">
                                <label class="custom-control-label" for="access_petugas">Petugas</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="access_admin" name="access_admin" value="true">
                                <label class="custom-control-label" for="access_admin">Admin</label>
                            </div>
                        </div>
                        <?= showError("menu_access_empty"); ?>
                    </div>
                    <div class="form-group d-flex flex-row justify-content-end py-0 mb-0">
                        <a href="./" class="btn btn-outline-secondary">
                            <i class="fas fa-fw fa-trash mr-2"></i> Cancel
                        </a>
                        <button type="submit" name="addnewmenu" class="btn btn-primary ml-2">
                            <i class="fas fa-fw fa-paper-plane mr-2"></i> Create New Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
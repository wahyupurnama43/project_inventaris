<?php $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin"; ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Major</h1>
</div>

<div class="row">
    <div class="col-6">
        <?php flash(); ?>
        <div class="card shadow">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="major_name">Name of the major : </label>
                        <input type="text" name="major_name" id="major_name" class="form-control" placeholder="Enter the name of the menu ..." autocomplete="off">
                        <?= showError("major_name_empty"); ?>
                    </div>
                    <div class="form-group">
                        <label for="major_code">Code of the major : </label>
                        <input type="text" name="major_code" id="major_code" class="form-control" placeholder="e.g : RPL" autocomplete="off">
                        <?= showError("major_code_empty"); ?>
                    </div>
                    <div class="form-group">
                        <label for="major_head">Head of the major : </label>
                        <select name="major_head" id="major_head" class="form-control">
                            <option value="" selected>Select head major.</option>
                            <?php if ($params['kepala_jurusan']) : ?>
                                <?php foreach ($params['kepala_jurusan'] as $kepJur) : ?>
                                    <option value="<?= $kepJur['id_user'] ?>"><?= $kepJur['nama_user']; ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">-</option>
                            <?php endif; ?>
                        </select>
                        <?= showError("major_head_empty"); ?>
                    </div>
                    <div class="form-group d-flex flex-row justify-content-end py-0 mb-0">
                        <a href="./" class="btn btn-outline-secondary">
                            <i class="fas fa-fw fa-trash mr-2"></i> Cancel
                        </a>
                        <button type="submit" name="addnewmajor" class="btn btn-primary ml-2">
                            <i class="fas fa-fw fa-paper-plane mr-2"></i> Create New Major
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
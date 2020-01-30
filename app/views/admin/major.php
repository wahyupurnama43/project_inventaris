<?php
if ((int) $_COOKIE["role"] === 0) {
    $url = "user";
} elseif ((int) $_COOKIE['role'] === 1) {
    $url = "petugas";
} else {
    $url = "admin";
}
?>
<?php showNotification(); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Major Lists</h1>
    <div>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-fw fa-info-circle mr-2 fa-sm text-white-50"></i> Head Major</a>
        <a href="<?= BASE_URL . $url . "/major/addnewmajor" ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-fw fa-plus-circle mr-2 fa-sm text-white-50"></i> Create Major</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <?php flash(); ?>
    </div>
    <?php if ($params['jurusan']) : ?>
        <?php foreach ($params['jurusan'] as $jurusan) : ?>
            <div class="col-6 mb-2">
                <a href="<?= BASE_URL . $url . "/major/detail/" . $jurusan['id_jurusan'] ?>" class="text-decoration-none" data-toggle="tooltip" data-placement="top" title="show more <?= $jurusan['kode_jurusan']; ?> detail">
                    <div class="card border-left-primary shadow h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $jurusan['nama_jurusan']; ?></div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <span class="h6">Head of Major : </span> <?= $jurusan['nama_user']; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fa-user-graduate fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Asiap</p>
    <?php endif; ?>
</div>
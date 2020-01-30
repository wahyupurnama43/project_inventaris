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
    <h1 class="h3 mb-0 text-gray-800">Students Lists</h1>
</div>
<div class="row">
    <div class="col-12">
        <?= flash(); ?>
        <div class="card shadow mb-0 pb-0">
            <div class="card-body mb-0 pb-3">
                <?php if ($params['students']) : ?>
                    <div class="table-responsive mb-0 p-0">
                        <table class="table table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Majors</th>
                                    <th>Gender</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($params['students'] as $student) : ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><?= $student['nama_user']; ?></td>
                                        <td><?= $student['kelas_user']; ?></td>
                                        <td><?= $student['jurusan_user']; ?></td>
                                        <td><?= $student['jenis_kelamin'] === "L" ? "Male" : "Female"; ?></td>
                                        <td>
                                            <a href="<?= BASE_URL . $url . "/student/detail/" . $student['id_user']; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="left" title="see student details.">
                                                <i class="fas fa-fw fa-info-circle"></i> Detail
                                            </a>
                                        </td>
                                        <?php $count++; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <h5 class="text-gray-900">Oops! There are no student detected.</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
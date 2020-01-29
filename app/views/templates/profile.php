<?php showNotification(); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
</div>
<div class="row">
    <div class="col-8">
        <?php flash(); ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile View</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <img src="https://source.unsplash.com/QAB-WJcbgJk/" alt="profile picture" class="w-100 h-100 rounded">
                    </div>
                    <div class="col-6">
                        <div class="group mb-1">
                            <small>Name : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['userdata']['nama_user']; ?>
                            </span>
                        </div>
                        <div class="group mb-1">
                            <small>Majors : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['userdata']['jenis_kelamin'] === 'L' ? "Male" : "Female"; ?>
                            </span>
                        </div>
                        <div class="group mb-1">
                            <small>Class : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['userdata']['kelas_user']; ?>
                            </span>
                        </div>
                        <div class="group mb-1">
                            <small>Majors : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['userdata']['jurusan_user']; ?>
                            </span>
                        </div>
                        <div class="group">
                            <small>Username : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['userdata']['username']; ?>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ((int) $_COOKIE["role"] === 0) {
        $url = "user";
    } elseif ((int) $_COOKIE['role'] === 1) {
        $url = "petugas";
    } else {
        $url = "admin";
    }
    ?>
    <div class="col-4 d-block">
        <a href="<?= BASE_URL . $url . "/profile/editprofile" ?>" class="btn btn-primary btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Edit Profile</span>
        </a>
        <br>
        <a href="<?= BASE_URL . $url . "/profile/changepassword" ?>" class="btn btn-warning btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-key"></i>
            </span>
            <span class="text">Change Password</span>
        </a>
        <br>
        <?php if ((int) $_COOKIE['role'] !== 1) : ?>
            <?php if ((int) $_COOKIE['role'] !== 2) : ?>
                <a href="<?= BASE_URL . $url . "/profile/editprofile" ?>" class="btn btn-danger btn-icon-split mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Delete Account</span>
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
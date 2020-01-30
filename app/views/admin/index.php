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
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Welcome message</div>
                        <div class="h6 mb-0 text-gray-800">Hello there, <?= $params['userdata']['nama_user']; ?>. Looks there you have some many to do.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <a href="<?= BASE_URL . $url . "/student" ?>" class="text-decoration-none" data-toggle="tooltip" data-placement="top" title="show more students detail">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $params['students']; ?> Students
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
    <div class="col-3">
        <a href="<?= BASE_URL . $url . "/student" ?>" class="text-decoration-none" data-toggle="tooltip" data-placement="top" title="show more items detail">
            <div class="card border-left-danger shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Items</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $params['students']; ?> Items
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-pallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
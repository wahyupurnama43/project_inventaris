<a href="../">&larr; Back</a>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
</div>
<div class="row">
    <div class="col-8">
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
                                <?= $params['student']['nama_user']; ?>
                            </span>
                        </div>
                        <div class="group mb-1">
                            <small>Majors : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['student']['jenis_kelamin'] === 'L' ? "Male" : "Female"; ?>
                            </span>
                        </div>
                        <div class="group mb-1">
                            <small>Class : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['student']['kelas_user']; ?>
                            </span>
                        </div>
                        <div class="group mb-1">
                            <small>Majors : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['student']['jurusan_user']; ?>
                            </span>
                        </div>
                        <div class="group">
                            <small>Username : </small>
                            <br>
                            <span class="text-gray-900 h5">
                                <?= $params['student']['username']; ?>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
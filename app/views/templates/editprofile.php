<a href="./">&larr; Back</a>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
</div>
<div class="row">
    <div class="col-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $params['userdata']['id_user']; ?>">
                    <div class="form-group">
                        <label for="fullname">
                            <small>Your name : </small>
                        </label>
                        <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $params['userdata']['nama_user']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="fullname">
                            <small>Your name : </small>
                        </label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="male" name="gender" class="custom-control-input" value="L" <?= $params['userdata']['jenis_kelamin'] === "L" ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="female" name="gender" class="custom-control-input" value="P" <?= $params['userdata']['jenis_kelamin'] === "P" ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Majors : </label>
                        <select name="jurusan" id="jurusan" class="form-control" va>
                            <?php if ($params['jurusan']) : ?>
                                <?php foreach ($params['jurusan'] as $jurusan) : ?>
                                    <option <?= $jurusan['kode_jurusan'] === $params['userdata']['jurusan_user'] ? "selected" : ""; ?> value="<?= $jurusan['kode_jurusan']; ?>"><?= $jurusan['nama_jurusan']; ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="null">Oops! Fetching is going wrong.</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">
                            Class :
                        </label>
                        <input type="text" name="kelas" id="kelas" class="form-control" value="<?= $params['userdata']['kelas_user']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">
                            <small>Username : </small>
                        </label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $params['userdata']['username']; ?>">
                    </div>
                    <div class="form-group d-flex flex-row justify-content-end py-0 mb-0">
                        <a href="./" class="btn btn-outline-secondary">
                            <i class="fas fa-fw fa-trash mr-2"></i> Cancel
                        </a>
                        <button type="submit" name="edit" class="btn btn-primary ml-2">
                            <i class="fas fa-fw fa-paper-plane mr-2"></i> Send Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
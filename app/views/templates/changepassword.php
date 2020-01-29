<a href="./">&larr; Back</a>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
</div>
<div class="row">
    <div class="col-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $params['userdata']['id_user']; ?>">
                    <div class="form-group">
                        <label for="password_lama">
                            <small>Old Password : </small>
                        </label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama" value="">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">
                            <small>New Password : </small>
                        </label>
                        <input type="password" class="form-control" name="password_baru" id="password_baru" value="">
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">
                            <small>Confirm Your New Password : </small>
                        </label>
                        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" value="">
                    </div>
                    <div class="form-group d-flex flex-row justify-content-end py-0 mb-0">
                        <a href="./" class="btn btn-outline-secondary">
                            <i class="fas fa-fw fa-trash mr-2"></i> Cancel
                        </a>
                        <button type="submit" name="change" class="btn btn-primary ml-2">
                            <i class="fas fa-fw fa-paper-plane mr-2"></i> Send Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
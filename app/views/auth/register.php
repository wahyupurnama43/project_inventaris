<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900">Inventaris</h1>
                                <h3 class="h6 text-gray-800 mb-4">Let's Create New Account!</h3>
                            </div>
                            <form class="user" action="" method="POST">
                                <div class="form-group">
                                    <h6 class="text-gray-900">Personal Info</h6>
                                    <label for="fullname">
                                        <small>Fullname : </small>
                                    </label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="emailHelp" placeholder="Enter your fullname ...">
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">
                                        <small>Majors : </small>
                                    </label>
                                    <select name="jurusan" id="jurusan" class="form-control">
                                        <?php if ($params['jurusan']) : ?>
                                            <?php foreach ($params['jurusan'] as $jurusan) : ?>
                                                <option value="<?= $jurusan['kode_jurusan']; ?>">
                                                    <?= $jurusan['nama_jurusan']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="null">No jurusan detected.</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="class">
                                        <small>Class : </small>
                                    </label>
                                    <input type="text" class="form-control" id="class" name="class" aria-describedby="class" placeholder="eg: X DPIB 1">
                                </div>
                                <div class="form-group">
                                    <label for="username">
                                        <small>Username : </small>
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter your username ...">
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        Password :
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        Confirm your Password :
                                    </label>
                                    <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Confirm your password">
                                </div>
                                <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <small>Have any account? </small><a class="small" href="<?= BASE_URL; ?>auth">login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
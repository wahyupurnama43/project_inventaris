<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-7 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900">Inventaris</h1>
                                <h3 class="h6 text-gray-800 mb-4">Welcome Back!</h3>
                            </div>
                            <form class="user" action="" method="POST">
                                <?php flash(); ?>
                                <div class="form-group">
                                    <label for="username">
                                        <small>Username : </small>
                                    </label>
                                    <input type="text" class="form-control <?= showError("user_empty") || showError("user_error") ? "is-invalid" : ""; ?>" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter your username ..." value="<?= saved("username") ?>">
                                    <?= showError("user_empty"); ?>
                                    <?= showError("user_error"); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        <small>Password : </small>
                                    </label>
                                    <input type="password" class="form-control <?= showError("pass_empty") || showError("pass_error") ? "is-invalid" : ""; ?>" id="password" name="password" placeholder="Password">
                                    <?= showError("pass_empty"); ?>
                                    <?= showError("pass_error"); ?>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary btn-block">
                                    Login
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= BASE_URL; ?>auth/">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= BASE_URL; ?>auth/register">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
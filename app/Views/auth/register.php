<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets') ?>/production/images/favico.ico" type="image/ico" />

    <title> <?= $page_title ?> </title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('assets') ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">


            <div id="register" class=" form ">
                <section class="login_content">
                    <h1>Create Account</h1>

                    <form action="/register" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid ' : ''; ?>" placeholder="Username" name="username" value="<?= old('username') ?>" required autofocus>
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('username') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid ' : ''; ?>" placeholder="Email" name="email" value="<?= old('email') ?>" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid ' : ''; ?>" placeholder="Password" name="password" required>
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('password') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid ' : ''; ?>" placeholder="Repeat Password" name="password2" required>
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('password2') ?>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-outline-dark btn-block" type="submit">Create</button>
                        </div>

                    </form>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div>
                            <h1 style="color: black; letter-spacing:2px"><img src="<?= base_url('assets/production/images/hallroastery.png') ?>" width="20%" alt=""></h1>
                            <p>©2021 All Rights Reserved. Hall Roastery Coffe Company</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
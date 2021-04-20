<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>

<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<div class="row">
    <!-- Pemberitahuan -->

    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-users"></i> Tambah Akun</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4>Form tambah akun</h4>
                <div class="col-md-12 col-sm-6">
                    <form action="/newaccount/save" method="post" enctype="multipart/form-data">
                        <input type="text" name="id" id="" hidden value="<?= $karyawan['id'] ?>">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Lengkap <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="" class="form-control " readonly value="<?= $karyawan['fullname'] ?>">
                                <div class="invalid-feedback mt-0">
                                    test erro
                                </div>
                            </div>

                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Username <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="username" class="form-control  <?= ($validation->hasError('username')) ? 'is-invalid ' : ''; ?>">
                                <small>Username akan digunakan untuk login</small>
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('username') ?>
                                </div>
                            </div>

                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="email" name="email" class="form-control   <?= ($validation->hasError('email')) ? 'is-invalid ' : ''; ?>">
                                <small>Masukan email yang valid</small>
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>

                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 ">
                                <input type="password" name="password" class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid ' : ''; ?>">
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('password') ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 ">
                                <input type="password" name="password2" class="form-control  <?= ($validation->hasError('password2')) ? 'is-invalid ' : ''; ?>" placeholder="Ulang password">
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('password2') ?>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Level akses menu <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 ">
                                <select name="role_id" id="" class="form-control">
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small>User hanya dapat menghakses menu yang di izinkan(Level menu)</small>
                                <div class="invalid-feedback mt-0">
                                    test erro
                                </div>
                            </div>

                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> </label>
                            <div class="col-md-6 col-sm-6 ">
                                <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
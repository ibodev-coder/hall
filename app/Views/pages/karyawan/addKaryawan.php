<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<!-- End Alert -->
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-users"></i> Karyawan</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4> Form Tambah Karyawan</h4>
                <div class="col-md-12 col-sm-12">
                    <form action="/karyawan/save" method="post" enctype="multipart/form-data">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Lengkap <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="fullname" class="form-control  <?= ($validation->hasError('fullname')) ? 'is-invalid ' : ''; ?>">
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('fullname') ?>
                                </div>
                            </div>

                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tempat lahir <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" class="form-control  <?= ($validation->hasError('place')) ? 'is-invalid ' : ''; ?>  " name="place">
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('place') ?>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal lahir <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="date" class="form-control  <?= ($validation->hasError('date')) ? 'is-invalid ' : ''; ?>   " name="date">
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('date') ?>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Kelamin <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="pria" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="wanita" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Wanita
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" class="form-control  <?= ($validation->hasError('address')) ? 'is-invalid ' : ''; ?>  " name="address">
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('address') ?>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Upload Foto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" class="form-control" name="img">
                                <small>Foto Maximal 2MB</small>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Level <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select name="role" id="" class="form-control  <?= ($validation->hasError('role')) ? 'is-invalid ' : ''; ?>  ">
                                    <option>Barista</option>
                                    <option>Koki</option>
                                    <option>Marketing</option>
                                    <option>Admin</option>
                                </select>
                                <small>Default "BARISTA"</small>
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('role') ?>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Status Kerja <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select name="status" id="" class="form-control">

                                    <option>Trial</option>
                                    <option>Contract</option>
                                </select>
                                <small>Default "Trial"</small>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Account <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" class="form-control" name="account" readonly value="-">
                                <small>Akun tidak bisa ditambahkan saat ini</small>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Gaji<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" class="form-control  <?= ($validation->hasError('salary')) ? 'is-invalid ' : ''; ?>  " name="salary">
                                <div class="invalid-feedback mt-0">
                                    <?= $validation->getError('salary') ?>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <button type="submit" class="btn-primary btn btn-sm">Simpan</button>
                                <button type="reset" class="btn-danger btn btn-sm">Reset</button>
                            </div>
                        </div>

                    </form>

                </div>




            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>

<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<div class="row">
    <!-- Pemberitahuan -->
    <div class="alert alert-warning col-md-12">

    </div>
    <!-- <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-progress"></i> Bahan Produksi per Item</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4> Tabel Bahan per Item</h4>
                <a href="#addbahanitem"> <span><i class="fa fa-plus">Tambah item</i></span></a>
                <div class="col-md-12 col-sm-12">
                    <table id="datatable1" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Desc</th>
                                <th scope="col">Perintah</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div> -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-progress"></i> Bahan Produksi per Item</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4> Tambah Bahan per Item</h4>
                <a href="#" class="btn-addmore"><span><i class="fa fa-plus"></i>Tambah Row</span></a>
                <!-- <a href=""> <span><i class="fa fa-plus">Tambah item</i></span></a> -->
                <div class="col-md-12 col-sm-12">
                    <form action="/bahanitem/save" method="post">
                        <div class="form-group col-md-12">
                            <label for="">Pilih Item</label>
                            <select name="item[]" id="" class="form-control  <?= ($validation->hasError('item')) ? 'is-invalid ' : ''; ?>">
                                <option value="<?= old('item') ?>">Pilih Item</option>
                                <?php foreach ($item as $r) : ?>
                                    <option value="<?= $r['item_id'] ?>"><?= $r['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback mt-0">
                                <?= $validation->getError('item') ?>
                            </div>
                        </div>
                        <div class="clone-target">
                            <div class="field clone" id="clone">
                                <div class="form-group col-md-3">
                                    <label for="">Pilih Bahan</label>
                                    <select name="bahan[]" id="" class="form-control  <?= ($validation->hasError('bahan')) ? 'is-invalid ' : ''; ?>">
                                        <option value="<?= old('bahan') ?>">Pilih Bahan</option>
                                        <?php foreach ($bahan as $r) : ?>
                                            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback mt-0">
                                        <?= $validation->getError('bahan') ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Jumlah</label>
                                    <input type="text " class="form-control  <?= ($validation->hasError('jumlah')) ? 'is-invalid ' : ''; ?>" name="jumlah[]" value="<?= old('jumlah') ?>">
                                    <div class="invalid-feedback mt-0">
                                        <?= $validation->getError('jumlah') ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 ">
                                    <label for="">Satuan</label>
                                    <select name="satuan[]" id="" class="form-control  <?= ($validation->hasError('satuan')) ? 'is-invalid ' : ''; ?>">
                                        <option value="<?= old('satuan') ?>">Pilih satuan</option>
                                        <?php foreach ($satuan as $r) : ?>
                                            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback mt-0">
                                        <?= $validation->getError('satuan') ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-1 ">
                                    <label for="">Perintah</label>
                                    <button class="btn btn-danger btn-remove-clone"> <i class="fa fa-trash"></i></button>
                                </div>
                            </div>

                        </div>
                        <button class="form-control btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
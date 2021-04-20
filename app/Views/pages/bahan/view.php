<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-progress"></i> Bahan Produksi</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4> Data Bahan</h4>
                <div class="col-md-4 col-sm-6">
                    <form action="/bahan/update/<?= $bahan['id'] ?>" method="post">
                        <div class="form-group">
                            <label for="">Nama bahan produksi</label>
                            <input type="text" name="name" class="form-control" value="<?= $bahan['name'] ?>">

                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <input type="text" name="desc" class="form-control" value="<?= $bahan['desc'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah stok</label>
                            <input type="text" name="" readonly class="form-control" placeholder="-">
                            <small>Stok akan di update ketika ada transaksi pembelian bahan</small>
                        </div>
                        <div class="form-group ">
                            <label for="">Per Stok</label>
                            <div class="col-6">
                                <small>Ukuran/berat</small>
                                <div class="row">
                                    <input type="text" class="form-control col-6" name="perstok_ukuran" value="<?= $bahan['perstok_ukuran'] ?>">
                                    <select name="perstok_satuan" class="form-control col-6" id="">
                                        <option value="<?= $bahan['satuan'] ?>"><?= $bahan['alias'] ?></option>
                                        <?php foreach ($satuan as $r) : ?>
                                            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <small>Per BOX/PCS</small>
                                <select name="perstok_name" class="form-control" id="">
                                    <option>Box</option>
                                    <option>Pcs</option>
                                </select>
                            </div>
                            <small>Ex: Susu UHT 350ml/Box</small>
                        </div>
                        <div class="form-group">
                            <label for="">Satuan</label>
                            <select name="satuan" id="" class="form-control">
                                <option value="<?= $bahan['satuan'] ?>"><?= $bahan['satuan_name'] ?></option>
                                <?php foreach ($satuan as $r) : ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['name'] ?> (<?= $r['kd'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <small>Satuan transaksi bahan akan menyesuaikan dengan data bahan</small>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="/bahan" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
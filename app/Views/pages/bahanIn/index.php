<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>

<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<div class="row">
    <!-- Pemberitahuan -->
    <!-- <div class="alert alert-warning col-md-12">
        <span> Satuan di dapat di tambahkan pada menu
            <a href="/satuan">Set Satuan</a>
        </span> -->

    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-calculator"></i> Bahan In</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4>Bahan In</h4>
                <div class="col-md-8 col-sm-10">
                    <form action="/bahanin/save" method="post">
                        <div class="form-group">
                            <label for="">Nama bahan</label>
                            <select name="bahan_id" id="" class="form-control bahan_id">
                                <option>Pilih bahan</option>
                                <?php foreach ($bahan as $r) : ?>
                                    <option value="<?= $r['id'] ?>" data-satuan="<?= $r['kode'] ?>" data-satuanid="<?= $r['satuan_id'] ?>"><?= $r['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" name="satuan" class="form-control satuan" id="satuan" hidden>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <select name="supply_id" id="" class="form-control">
                                <option value="">Pilih Supllier</option>
                                <?php for ($i = 1; $i <= 100; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="">Stok masuk</label>
                                    <input type="text" name="stok" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">.</label>
                                    <span class=" form-control satuan" id="satuan" aria-hidden="true" style="text-transform:uppercase"></span>
                                </div>
                            </div>
                            <small>satuan menyesuaikan data pada <a href="/bahan">Bahan Olah</a></small>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal bahan masuk</label>
                            <input type="date" class="form-control" name="bahanin_at">
                        </div>
                        <div class="form-group">
                            <label for="">Total Harga</label>
                            <input type="text" name="total_harga" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-table"></i> Table Bahan In</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4>Table Bahan In</h4>
                <div class="col-md-12 col-sm-6">
                    <table id="datatable" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                        <thead>
                            <tr>

                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Stok Masuk</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Tanggal transaksi</th>
                                <th scope="col">Tanggal input</th>
                                <th scope="col">Perintah</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($bahanin as $r) : ?>
                                <tr>
                                    <td><?= $r['bahanName'] ?></td>
                                    <!-- Convert Kilogram -->
                                    <?php if ($r['satuan_id'] == 1) : ?>
                                        <td><?= $r['stok'] / 1000 ?></td>
                                    <?php else : ?>
                                        <td><?= $r['stok'] ?></td>
                                    <?php endif; ?>
                                    <td><?= $r['satuanName'] ?></td>
                                    <td><?= $r['total'] ?></td>
                                    <td><?= $r['supplier'] ?></td>
                                    <td><?= $r['bahanin_at'] ?></td>
                                    <td><?= $r['create_at'] ?></td>
                                    <td><a href="">Cetak Invoice</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
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
                    <form action="/bahan/save" method="post">
                        <div class="form-group">
                            <label for="">Nama bahan produksi</label>
                            <input type="text" name="name" class="form-control  <?= ($validation->hasError('name')) ? 'is-invalid ' : ''; ?>" value="<?= old('name') ?>">
                            <div class="invalid-feedback mt-0">
                                <?= $validation->getError('name') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <input type="text" name="desc" class="form-control">
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
                                    <input type="text" class="form-control col-6" name="perstok_ukuran">
                                    <select name="perstok_satuan" class="form-control col-6" id="">
                                        <?php foreach ($satuan as $r) : ?>
                                            <option value="<?= $r['id'] ?>"><?= $r['kd'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                            <label for="">Satuan hitung per produksi item</label>
                            <select name="satuan" id="" class="form-control">
                                <option>Satuan</option>
                                <?php foreach ($satuan as $r) : ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['name'] ?> (<?= $r['kd'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <small>Satuan transaksi bahan akan menyesuaikan dengan data bahan</small>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-sm-12">
                    <table id="datatable1" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Desc</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Alias</th>
                                <th scope="col">Per Stok</th>
                                <th scope="col">Perintah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bahan as $key => $r) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['desc'] ?></td>
                                    <!-- Tampilan stok serbelum di update -->
                                    <?php if ($r['stok'] == 0) : ?>
                                        <td><span class="badge badge-warning">Transaksi belum update</span></td>
                                    <?php else : ?>
                                        <!-- Convert Kilogram -->
                                        <?php if ($r['satuan_id'] == 1 || $r['satuan_id'] == 3) : ?>
                                            <td><?= floor($r['stok'] / 1000) ?></td>
                                        <?php else : ?>
                                            <td><?= $r['stok'] ?></td>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <td><?= $r['satuan_name'] ?></td>
                                    <td><?= $r['alias'] ?></td>
                                    <td><?= $r['perstok_ukuran'] . $r['alias'] . '/' . $r['perstok_name'] ?></td>
                                    <td>
                                        <a href="/bahan/view/<?= $r['id'] ?>" class="p-2"><i class="fa fa-pencil"></i></a>
                                        <a href="/bahan/delete/<?= $r['id'] ?>" class="p-2 btn-hapus"><i class="fa fa-trash"></i></a>
                                    </td>
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
<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><i class="fa fa-money"></i> Harga</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4> Set Harga</h4>
                <div class="col-md-4 col-sm-6">
                    <form action="/harga/save" method="post">
                        <div class="form-group">
                            <label for="">Nama item</label>
                            <select name="id" id="" class="form-control">
                                <option value="0">Pilih Item</option>
                                <?php foreach ($items as $r) : ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="">Pilih harga</label>
                            <select name="price_id" class="form-control">
                                <option value="">Set Harga</option>
                                <?php foreach ($price as $r) : ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['price'] ?></option>
                                <?php endforeach; ?>
                            </select>

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

                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Perintah</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($allItem->getResultArray() as $key => $r) : ?>
                                <tr>
                                    <td><input class="" type="checkbox" name="id[]" value="<?= $r['item_id'] ?>" id=""></td>
                                    <td><?= $r['name'] ?></td>

                                    <td><?= $r['kategori'] ?></td>
                                    <?php if ($r['price_id'] == 0) : ?>
                                        <td> <span class="badge badge-warning"> Harga item belum di set</span></td>
                                    <?php else : ?>
                                        <td> <?= number_format($r['price'], 2, ',', '.') ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="/harga/view/<?= $r['item_id'] ?>" class="p-2"><i class="fa fa-pencil"></i></a>
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
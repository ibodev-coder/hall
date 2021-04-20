<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<!-- End Alert -->
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile ">
        <div class="x_title">
            <h2><i class="fa fa-pencil"></i> Edit Item</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <h4> Item</h4>
            <div class="col-md-6 col-sm-12">
                <div class="img">

                    <img src=" <?= base_url('assets/production/images/items/') . '/' . $item['img'] ?>" alt="" class="img-fluid">
                    <small><?= base_url('assets/production/images/items') . '/' . $item['img'] ?></small>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <form action="/item/update/<?= $item['item_id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" value=" <?= $item['item_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="kategori_id" class="form-control">
                            <option value="<?= $item['id_kategori'] ?>"><?= $item['kategori_name'] ?></option>
                            <?php foreach ($kategori as $r) : ?>
                                <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" name="price" class="form-control" value="<?= $item['price'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <input type="text" name="desc" class="form-control" value="<?= $r['desc'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Ganti foto</label>
                        <input type="file" name="img" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a href="/item" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>

            <!-- <div class="col-md-6 col-sm-12">
                <div class="disclaim">
                    <div class="alert alert-warning">
                        Jika Kategori tidak ada, silahkan tambahnkan di menu <a href="/kategori">Kategori</a>
                    </div>
                    <div class="alert alert-info">
                        Harga di set pada Menu <a href="/harga">Harga</a>
                    </div>
                </div>

            </div> -->



        </div>
    </div>
</div>


<?= $this->endSection(); ?>
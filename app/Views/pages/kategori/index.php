<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<!-- End Alert -->
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile ">
        <div class="x_title">
            <h2>Kategori</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <h4>Tambah kategori</h4>
            <div class="col-md-6 col-sm-12">
                <form action="<?= base_url('kategori/save') ?>" method="post">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="name" placeholder="Coffe" autofocus class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <input type="text" name="desc" autofocus class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm " type="submit">Simpan</button>
                        <button class="btn btn-danger btn-sm " type="reset">Reset</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-12">
                <table id="datatable1" class="table table-striped table-sm table-bordered datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Perintah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori as $key => $r) : ?>
                            <tr>
                                <th><?= $key + 1 ?></th>
                                <th><?= $r['name'] ?></th>
                                <th><?= $r['desc'] ?></th>
                                <th><a href="/kategori/view/<?= $r['id'] ?>" class="p-2 "><i class="fa fa-pencil"></i></a>
                                    <a href="/kategori/delete/<?= $r['id'] ?>" class="p-2 btn-hapus"><i class="fa fa-trash"></i></a>
                                </th>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>
<!-- <div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile ">
        <div class="x_title">
            <h2>Tabel Kategori</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <h4>Tabel kategori</h4>
            <div class="col-md-12 col-sm-12">
                <table id="datatable1" class="table table-striped table-sm table-bordered datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Perintah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori as $key => $r) : ?>
                            <tr>
                                <th><?= $key + 1 ?></th>
                                <th><?= $r['name'] ?></th>
                                <th><?= $r['desc'] ?></th>
                                <th><a href="/kategori/view/<?= $r['id'] ?>" class="p-2 "><i class="fa fa-pencil"></i></a>
                                    <a href="/kategori/delete/<?= $r['id'] ?>" class="p-2 btn-hapus"><i class="fa fa-trash"></i></a>
                                </th>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>



            </div>



        </div>
    </div>
</div> -->

<?= $this->endSection(); ?>
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
            <h4>Edit kategori</h4>
            <div class="col-md-6 col-sm-12">
                <form action="/kategori/update/<?= $kategori['id'] ?>" method="post">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="name" placeholder="Coffe" autofocus class="form-control" value="<?= $kategori['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <input type="text" name="desc" value="<?= $kategori['desc'] ?>" autofocus class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm " type="submit">Simpan</button>
                        <button class="btn btn-danger btn-sm " type="reset">Reset</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
</div>


<?= $this->endSection(); ?>
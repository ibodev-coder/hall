<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<!-- End Alert -->
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile ">
        <div class="x_title">
            <h2>Menu Utama</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <h4>Tambah Menu</h4>
            <div class="col-md-4 col-sm-4">
                <form action="<?= base_url('menu/addMenu') ?>" method="post">
                    <div class="clone-target clone" id="clone">
                        <a href="" class="btn-addmore "><i class="fa fa-plus"></i> <small>Tambah form menu</small></a>
                        <div class="form-group">
                            <input type="text" name="name[]" class="form-control" placeholder="Nama Menu">
                        </div>
                        <!-- <div class="form-group">
                        <a href="" class="btn-addmore "><i class="fa fa-plus"></i> <small>Tambah Role</small></a>
                    </div>

                    <hr> -->
                        <small>Hanya role yang dipilih dapat mengakses menu</small>


                        <div class="form-group">
                            <select name="role_id[]" id="" class="form-control">
                                <option>Pilih role</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button class="btn btn-primary col-4">Simpan</button>
                        </div>
                    </div>
                </form>
                <!-- <div class="clone-target">
                    <div class="field item form-group clone" id=" clone">

                        <div class="col-md-3 col-sm-6">
                            <select name="id_bahan[]" class="form-control input-bahan">
                                <option> Pilih Bahan</option>

                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <input type="text" class="form-control input-jumlah" placeholder="Jumlah" name="jumlah[]">
                            <small>Gram/Pcs</small>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <select name="satuan[]" id="" class="form-control">
                                <option value="gram">Gram</option>

                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <button class="btn btn-danger btn-remove-clone" type="button"> <i class="fa fa-trash"></i></button>
                        </div>
                    </div>

                </div> -->
            </div>
            <div class="col-md-8 col-sm-8">
                <table id="datatable" class="table table-striped table-sm table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Perintah</th>

                        </tr>
                    </thead>


                    <tbody>
                        <?php $no = 1;
                        foreach ($getMenu as $m) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $m['menu'] ?></td>
                                <?php if ($m['role_id'] == 1) :
                                    $class = "badge badge-primary";
                                elseif ($m['role_id'] == 2) :
                                    $class = "badge badge-warning";
                                elseif ($m['role_id'] == 3) :
                                    $class = "badge badge-success";
                                else :
                                    $class = "badge badge-info";
                                ?>
                                <?php endif; ?>
                                <td><span class="<?= $class ?>"><?= $m['role'] ?></span></td>
                                <td><a href=" /hapusmenu/<?= $m['menu_id']  ?>" class="btn-hapus"><i class="fa fa-trash"></i></a>
                                    <a href="/updatemenu/<?= $m['menu_id'] ?>"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>

<?= $this->endSection(); ?>
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
                <h2><i class="fa fa-gift"></i> Item</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4> Tambah Item</h4>
                <div class=" col-md-6 col-sm-12">
                    <form action="/item/save" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="name" value="<?= old('name') ?>" autofocus class="form-control <?= ($validation->hasError('name')) ? 'is-invalid ' : ''; ?>">
                            <div class="invalid-feedback mt-0">
                                <?= $validation->getError('name') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <small><a href="" class="" data-toggle="modal" data-target="#add-kategori"> <span class="fa fa-plus"></span></a></small>
                            <select name="kategori_id" class="form-control <?= ($validation->hasError('kategori_id')) ? 'is-invalid ' : ''; ?>">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori as $r) : ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback mt-0">
                                <?= $validation->getError('kategori_id') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" name="price" class="form-control" placeholder="15000">
                            <small>Masukan angka tanpa tanda titik</small>
                        </div>
                        <div class="form-group">
                            <label for="">Upload Foto</label>
                            <input type="file" name="img" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <input type="text" name="desc" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
                <div class=" col-md-6 col-sm-12">
                    <table id="datatable1" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Perintah</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            foreach ($items->getResultArray() as $key => $r) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>

                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['desc'] ?></td>
                                    <td><?= $r['kategori'] ?></td>
                                    <td> <?= number_format($r['price'], 2, ',', '.') ?></td>
                                    <td>

                                        <a href="/item/view/<?= $r['item_id'] ?>" class="p-2"><i class="fa fa-pencil"></i></a>
                                        <a href="/item/delete/ <?= $r['item_id'] ?>" class="btn-hapus p-2"><i class="fa fa-trash"></i></a>
                                        <a href="" data-target="#detail-item" data-toggle="modal"> <i class="fa fa-eye"></i></a>
                                    </td>
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
                <h2><i class="fa fa-table"></i> Tabel Item</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4>Tabel Item</h4>
                <div class="col-md-12 col-sm-12">

                    <table id="datatable1" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Perintah</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            foreach ($items->getResultArray() as $key => $r) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>

                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['desc'] ?></td>
                                    <td><?= $r['kategori'] ?></td>
                                    <td> <?= number_format($r['price'], 2, ',', '.') ?></td>
                                    <td>

                                        <a href="/item/view/<?= $r['item_id'] ?>" class="p-2"><i class="fa fa-pencil"></i></a>
                                        <a href="/item/delete/ <?= $r['item_id'] ?>" class="btn-hapus p-2"><i class="fa fa-trash"></i></a>
                                        <a href="" data-target="#detail-item" data-toggle="modal"> <i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>




            </div>
        </div>
    </div> -->
    <!-- Modal add Kategori -->
    <div class="modal fade " id="add-kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategori Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('item/modalkategori') ?>" method="post">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Detail-item -->
    <div class="modal fade " id="detail-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategori Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <img src="" class="img-fluid" alt="">
                        <span>Affogato</span>
                        <span>Rp 15.000</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>
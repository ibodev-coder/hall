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
                <h2><i class="fa fa-users"></i> Karyawan</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h4> Tabel Karyawan</h4>
                <a href="/karyawan/addKaryawan" class="btn btn-outline-primary btn-sm"><span class="fa fa-plus"></span> Karyawan Baru</a>
                <a href="/export" class="btn btn-outline-success btn-sm"><span class="fa fa-file-o"></span> Export</a>
                <a href="<?= base_url('/pdf/karyawan') ?>" class="btn btn-outline-success btn-sm"><span class="fa fa-print"></span> Cetak</a>
                <div class="col-md-12 col-sm-12">
                    <br>
                    <table id="datatable1" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Tempat lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Level</th>
                                <th scope="col">Status</th>
                                <th scope="col">Account</th>
                                <th scope="col">Gaji</th>
                                <th scope="col">Perintah</th>
                            </tr>
                        </thead>

                        <tbody style="text-transform: capitalize;">
                            <?php foreach ($karyawan as $r) : ?>
                                <tr>
                                    <td><?= $r['id'] ?></td>
                                    <td><?= $r['fullname'] ?></td>
                                    <td><?= $r['place'] ?></td>
                                    <td><?= $r['date'] ?></td>
                                    <td><?= $r['gender'] ?></td>
                                    <td><?= $r['address'] ?></td>
                                    <td><?= $r['role'] ?></td>
                                    <td><span class="badge badge-primary"><?= $r['status'] ?></span></td>
                                    <?php if ($r['account'] == 1) : ?>
                                        <td><span class="badge badge-success"> Aktif</span></td>
                                    <?php else : ?>
                                        <td><span class="badge badge-warning"> Tidak aktif</span></td>
                                    <?php endif; ?>

                                    <td><?= number_format($r['salary'], 2, ',', '.',) ?></td>
                                    <td><a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a> | <a href="/newaccount/<?= $r['id'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Account"><i class="fa fa-plus"></i></a></td>
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
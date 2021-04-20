<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<!-- End Alert -->

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile ">
        <div class="x_title">
            <h2>Tabel User</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <h4>Tabel User</h4>
            <div class="col-md-12 col-sm-12">
                <table id="datatable1" class="table table-striped table-sm table-bordered datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Perintah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $r) : ?>
                            <tr>
                                <td><?= $r['email'] ?></td>
                                <td><?= $r['user'] ?></td>
                                <?php if (($r['role_name'] == 'admin')) {
                                    $class = 'badge badge-primary';
                                } elseif (($r['role_name'] == 'kasir')) {
                                    $class = 'badge badge-warning';
                                } else {
                                    $class = 'badge badge-success';
                                } ?>
                                <td><span class="<?= $class ?>"><?= $r['role_name'] ?></span></td>
                                <td>
                                    <img src="<?= base_url('assets') ?>/production/images/<?= $r['avatar'] ?>" alt="" width="35px" class="img-circle">

                                </td>
                                <td><a href=""><i class="fa fa-pencil"></i></a></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>



            </div>



        </div>
    </div>
</div>

<?= $this->endSection(); ?>
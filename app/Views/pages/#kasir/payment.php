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
                <h2><i class="fa fa-money"></i> Pembayaran</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12">
                        <div class="row invoice-info">


                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Pelanggan:</b><?= $order['costumer'] ?>

                                <br>
                                <b>Date:</b> <?= $order['create_at'] ?><br>
                                <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#payment">Proses</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <table id="datatab1" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Sub Total</th>

                                </tr>
                            </thead>

                            <tbody style="text-transform: capitalize;">
                                <?php foreach ($detail as $r) : ?>
                                    <tr>
                                        <td><?= $r['name'] ?></td>
                                        <td><?= number_format($r['price'], 2, ',', '.') ?></td>
                                        <td><?= $r['qty'] ?></td>
                                        <td><?= number_format($r['price'] * $r['qty'], 2, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td colspan="3"><b> Total Pembayaran</b></td>
                                    <td><b><?= number_format($total->total, 2, ',', '.') ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Payment -->
<div class="modal fade" id="payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Proses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <strong>Total Bayar</strong>
                <h5><?= "Rp", number_format($total->total, 2, ',', '.') ?></h5>
                <form action="<?= base_url('kasir/proses'), '/', session('id_costumer') ?>" method="post">
                    <input type="text" value="<?= $total->total ?>" hidden name="total">
                    <label for="">Masukan Jumlah uang</label>
                    <input type="text" class="form-control" name="input_payment" autofocus>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Proses</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
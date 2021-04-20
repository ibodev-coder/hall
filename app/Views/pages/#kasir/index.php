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
                <h2><i class="fa fa-money"></i> Transaksi</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-4">
                        <form action="/kasir/addOrders" method="post">
                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" placeholder="Nama Pelanggan" id="pelanggan" name="pelanggan" value="<?= session('costumer') ?>" <?= (session('costumer')) ? 'readonly' : '';  ?> required>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="id" hidden name="id">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" placeholder="Cari Item" name="name" readonly id="name" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                    <div class="input-group-prepend">
                                        <a href="" class="input-group-text" data-toggle="modal" data-target="#cari-item"><i class="fa fa-search fa-fw "></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" placeholder="Harga Item" readonly id="price">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" placeholder="Qty" id="qty" name="qty" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <button class="form-control btn btn-primary btn-block"> Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <a href="<?= base_url('kasir/reset') ?>" class="btn btn-outline-danger btn-sm btn-hapus">Reset</a>

                        <!-- <a href="<?= base_url('kasir/payment'), '/', session('id_costumer') ?>" class="btn btn-outline-success btn-sm">Bayar</a> -->
                        <a href="" class="btn btn-outline-success btn-sm" data-target="#altbayar" data-toggle="modal">Bayar</a>
                        <table id="" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Perintah</th>
                                </tr>
                            </thead>

                            <tbody style="text-transform: capitalize;">
                                <?php foreach ($detail_order as $r) : ?>
                                    <tr>
                                        <td><?= $r['name'] ?></td>
                                        <td><?= number_format($r['price'], 2, ',', '.') ?></td>
                                        <td><?= $r['qty'] ?></td>
                                        <td><?= number_format($r['qty'] * $r['price'], 2, ',', '.') ?></td>
                                        <td><a href="<?= base_url('kasir/delete/' . $r['item_id']) ?>" class="btn-hapus"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Cari Item -->
<div class="modal fade" id="cari-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="datatable2" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Perintah</th>
                        </tr>
                    </thead>

                    <tbody style="text-transform: capitalize;">
                        <?php foreach ($item->getResultArray() as $r) : ?>
                            <tr>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['price'] ?></td>
                                <td><button class="btn-tambah" data-item="<?= $r['name'] ?>" data-price="<?= $r['price'] ?> " data-id="<?= $r['item_id'] ?>"><i class=" fa fa-plus"></i></button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal Alt Bayar -->
<div class="modal fade" id="altbayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total harga</th>
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
                <strong>Total Bayar</strong>
                <h5><?= "Rp", number_format($total->total, 2, ',', '.') ?></h5>
                <form action="<?= base_url('kasir/proses'), '/', session('id_costumer') ?>" method="post">
                    <input type="text" value="<?= $total->total ?>" hidden name="total">
                    <label for="">Masukan Jumlah uang</label>
                    <input type="text" class="form-control" name="input_payment" autofocus>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Proses</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
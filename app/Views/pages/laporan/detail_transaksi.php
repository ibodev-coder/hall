<div class="row">
    <div class="col-md-4 col-sm-4">
        <span>ID Transaksi </span><br>
        <span>Nama Pelanggan </span>
        <span>Tanggal Transaksi</span>
    </div>
    <div class="col-md-1">
        : <br> : <br> :
    </div>
    <div class="col-md-6 col-sm-4">
        <span><?= $transaksi_id->id_order ?></span><br>
        <span><?= $transaksi_id->costumer ?></span><br>
        <span><?= $transaksi_id->create_at ?></span>
    </div>

</div>
<div class="row">
    <div class="container">
        <table class="table table-sm  " style="width:100%">
            <thead>
                <tr>
                    <td>Item</td>
                    <td>Qty</td>
                    <td>Harga</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $r) : ?>
                    <tr>
                        <td><?= $r['item'] ?></td>
                        <td><?= $r['qty'] ?></td>
                        <td><?= $r['qty'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- <tr>

                    <td colspan="2"><b>Total</b></td>
                    <td><b> <?= number_format($transaksi_id->total_transaksi, 2, ',', '.') ?></b></td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <span>Disc :0%</span><br>
        <span>Total :<?= number_format($transaksi_id->total_transaksi, 2, ',', '.') ?></span>

    </div>
</div>
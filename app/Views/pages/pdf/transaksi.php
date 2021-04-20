<div class="pdf-header">

    <h1>Rekap Transaksi</h1>
    <span><?= $label ?> </span>
</div>
<div class="pdf-content">
    <table border="1" align="center">
        <thead>
            <tr>
                <td>ID Transaksi</td>
                <td>Tanggal Transaksi</td>
                <td>Total Transaksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $r) : ?>
                <tr>
                    <td><?= $r['id_order'] ?></td>
                    <td><?= $r['create_at'] ?></td>
                    <td><?= number_format($r['total_transaksi'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2"> <b>Grand Total</b></td>
                <td> <b><?= number_format($total->total, 2, ',', '.') ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
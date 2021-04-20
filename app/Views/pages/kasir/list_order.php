<div class="option ml-auto">

    <a href="/kasir/resetorder" class="btn btn-sm btn-danger"><span class="fa fa-times"></span> Reset</a>
</div>
<div class="table">
    <input type="text" name="" id="" value="<?= session()->get('id_order') ?>">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Item</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Sub Total</th>
                <th>Perintah</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_order as $r) : ?>
                <tr>
                    <td><?= $r['name'] ?></td>
                    <td><?= number_format($r['price'], 0, ',', '.') ?></td>
                    <td><?= $r['qty'] ?></td>
                    <td><?= number_format($r['price'] * $r['qty'], 0, ',', '.') ?></td>
                    <td><a href="#" data-id="<?= $r['item'] ?>" class="hapusItem"><i class="fa fa-times-circle"></i></a></td>
                    <!-- <td><a href="/kasir/deleteorder/<?= $r['item'] ?>" data-id="<?= $r['item'] ?>" class="btn-hapus"><i class="fa fa-times-circle"></i></a></td> -->
                </tr>

            <?php endforeach ?>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2" data-total="<?= $total['total'] ?>" class="datatotal"><?= number_format($total['total'], 0, ',', '.') ?></th>
            </tr>

        </tbody>
    </table>

</div>
<script>
    $('.hapusItem').on('click', function(e) {
        e.preventDefault();
        var item = $(this).data('id')
        $.ajax({
            url: "<?= site_url('kasir/deleteOrder/') ?>" + item,
            dataType: "JSON",
            success: function(response) {
                console.log('Deleted');

            },
            error: function(xhr, ajaxOptions, ThrownError) {
                alert(xhr.status);
            }
        })
    })
</script>
<div class="notify" data-notify="<?= session()->get('notify') ?>"></div>
<?php
$no = 1;
foreach ($order as $r) : ?>
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2><b> Antrian : <?= $no ?> </b></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                $table = [
                    'items.id as item_id',
                    'items.name as name',
                    'orders.id_order as order',
                    'dapur.qty as qty',
                    'dapur.item as item'
                ];
                $dapur->join('items', 'items.id=dapur.item');
                $detail = $dapur->where('id_order', $r['id'])->findAll();
                foreach ($detail as $dap) : ?>
                    <div class=" row">
                        <div class="col-md-2">
                            <h5><?= $dap['name'] ?></h5>
                        </div>
                        <div class="col-md-2">
                            <h5><?= $dap['qty'] ?></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
                <hr>
                <a class="btn btn-success btn-sm" href="/dapur/endproses/<?= $r['id'] ?>">Selesai</a>
                <small>Klik tombol selesai jika pesanan telah siap</small>
            </div>
        </div>
    </div>
<?php $no++;
endforeach; ?>
<script>
    var notify = $('.notify').data('notify');

    if (notify == 1) {
        new PNotify({
            title: 'Pesanan baru',
            text: 'Heyy, ada pesanan baru, ayo cepat mereka menunggu mu',
            type: 'success',
            styling: 'bootstrap3'
        })
        console.log('Data baru');
        console.log(notify);

    } else {
        console.log('kosong ');
    }
</script>
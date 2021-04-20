<div class="thumbnail">
    <div class="image view view-first">
        <img style="width: 100%; display: block;" src="<?= base_url('assets/production/images/items') . '/' . $detail->img ?>" alt="image" />

    </div>
    <div class="mt-2">
        <span style="letter-spacing: 2px; font-weight: 600;"><?= $detail->name ?></span><br>
        <span style=" font-weight: 600;">Rp <?= number_format($detail->price, 2, ',', '.') ?></span><br>
        <input type="number" class="form-control col-md-4" placeholder="1" value="1" name="qty" id="qty">
        <input type="text" name="item" value="<?= $detail->id ?>" hidden id="item">
        <input type="text" name="id_order" value="<?= session()->get('id_order') ?>" id="order" hidden>
    </div>



</div>
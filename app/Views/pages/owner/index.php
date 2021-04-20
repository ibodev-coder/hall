<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>

<div class="store-stat">
    <h3><b> Hall Roastery</b></h3>
    <span>Status : </span>
    <span class="badge badge-success"><?= date('d-m-Y') ?></span>
    <span class="badge badge-success">Open</span>

</div>
<!-- 
<script>
    $(document).ready(function() {
        function notify() {
            $.ajax({
                url: "<?= site_url('owner/neworder') ?>",
                dataType: "Json",
                success: function(response) {
                    new PNotify({
                        title: 'Ada Pesanan Baru',
                        text: 'Hurry Up !!!',
                        type: 'warning',
                        styling: 'bootstrap3'
                    });

                }
            })
        }
        setInterval(notify, 5000);





    })
</script> -->


<?= $this->endSection(); ?>
<?= $this->extend('template/template') ?>
<?= $this->section('content'); ?>
<!-- Alert -->
<div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
<div class="param" data-param="<?= session()->get('param') ?>"></div>
<!-- End Alert -->

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel tile ">
        <div class="x_title">
            <h2>Laporan Transaksi</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <h4>Tabel Transaksi penjualan</h4>
            <a href="" data-target="#modal-print" data-toggle="modal"><span class="fa fa-print"></span> Cetak</a>
            <div class="col-md-12 col-sm-12" id="transaksi">
                <table id="datatable2" class="table table-striped table-sm table-bordered datatable " style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Perintah</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $r) : ?>
                            <tr>
                                <td><?= $r['id_order'] ?></td>
                                <td><?= $r['create_at'] ?></td>
                                <td><?= number_format($r['total_transaksi'], 2, ',', '.') ?></td>
                                <td><a href="" data-id="<?= $r['id_order'] ?>" data-toggle="modal" data-target="#modal-detail" class="detail1"><i>detail</i></a></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modal-print" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-print"></span> Print Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pdf/transaksi" method="post">
                    <div class="form-group">
                        <label for="">Tanggal Awal</label>
                        <input type="date" class="form-control" name="tgl_awal">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tgl_akhir">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Cetak</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal Detail -->
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-print"></span> Detail transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="content-detail">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.detail1').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            // console.log("<?= site_url('Laporan/transaksidetail/') ?>" + id);


            function getDetail() {
                $.ajax({
                    url: "<?= site_url('Laporan/transaksidetail/') ?>" + id,
                    dataType: "Json",
                    beforeSend: function(f) {
                        $('#content-detail').html('Load Files');
                    },
                    success: function(response) {
                        $('#content-detail').html(response.data);
                    },
                    error: function(xhr, ajaxOptions, ThrownError) {
                        alert(xhr.status);
                    }
                })
            }
            getDetail();

        });
    })
</script>
<?= $this->endSection(); ?>
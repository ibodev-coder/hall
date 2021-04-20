<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets') ?>/production/images/favico.ico" type="image/ico" />
    <!-- jQuery -->
    <script src="<?= base_url('assets') ?>/vendors/jquery/dist/jquery.min.js"></script>

    <!-- numpad -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/production/numpad/numpad-dark.css" />
    <script src="<?= base_url('assets') ?>/production/numpad/numpad.js"></script>

    <title>Kasir Halroastery </title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <!-- Datatable -->

    <!-- PNotify -->
    <link href="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">

</head>
<style>
    #head {
        letter-spacing: 2px;
        font-weight: 600;
        text-align: center
    }

    ;
</style>

<body class="" style="background-color:  #F7F7F7;">
    <!-- Alert -->
    <div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
    <div class="param" data-param="<?= session()->get('param') ?>"></div>



    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">

            <nav class="nav navbar-nav">
                <h3 id="head">HALLROASTERY</h3>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="col-md-8 col-sm-6  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-coffee"></i> Item <small></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Coffe</a>
                        </li> -->

                        <?php foreach ($kategori as $r) : ?>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#<?= $r['name'] ?>" role="tab" aria-controls="home" aria-selected="false"><?= $r['name'] ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <?php foreach ($kategori as $r) : ?>
                            <div class="tab-pane fade show " id="<?= $r['name'] ?>" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <?php $items = $item->where('kategori_id', $r['id'])->findAll(); ?>
                                    <?php foreach ($items as $r) : ?>
                                        <div class="col-md-55">
                                            <a href="" data-toggle="modal" data-target="#item-order" class="detail-item" data-id="<?= $r['id'] ?>">
                                                <div class="thumbnail">
                                                    <div class="image view view-first">
                                                        <img style="width: 100%; display: block;" src="<?= base_url('assets/production/images/items') . '/' . $r['img'] ?>" alt="image" />
                                                        <div class="mask">
                                                            <p><?= $r['name'] ?></p>
                                                            <!-- <small><?= base_url('assets/production/images/items/') . $r['img'] ?></small> -->
                                                        </div>
                                                    </div>
                                                    <div class="caption">
                                                        <span style="letter-spacing: 2px; font-weight: 600;"><?= $r['name'] ?></span><br>
                                                        <span style="letter-spacing: 2px; font-weight: 600;"> <?= number_format($r['price']) ?></span><br>

                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-money"></i> Cart <small></small></h2>

                    <div class="clearfix"></div>

                </div>
                <div class="x_content">

                    <div class="row" id="list">


                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <button class="btn btn-success btn-sm btn-block bayar" data-target="#payment" data-toggle="modal"> Bayar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- /top navigation -->

    <!-- page content -->

    <!-- /page content -->

    <!-- footer content -->


    </div>

    <!-- modal payment -->
    <div class="modal fade " tabindex="-1" role="dialog" aria-hidden="true" id="payment" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm  modal-dialog-centered">
            <div class="modal-content ">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-money "></i> Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/kasir/proses" class="payment" method="post">
                        <h5 style="font-weight: bold;">Total Pembayaran</h5>
                        <h5 style="font-weight: bold;" class="total"></h5>
                        <input type="text" name="total" hidden class="total-val">
                        <!-- <input type="text" name="id_order" value="123"> -->
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" required>

                        <label for="">Jumlah bayar</label>
                        <input type="text" class="form-control" name="pembayaran" id="pembayaran">
                        <label>Jenis pesanan</label>
                        <p>
                            Dine In
                            <input type="radio" class="flat" id="" value="" checked="" required /> Take Away
                            <input type="radio" class="flat" id="" value="" />
                        </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- detail -->
    <div class="modal fade " tabindex="-1" role="dialog" aria-hidden="true" id="item-order" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/kasir/addorder" method="post">
                    <div class="modal-body" id="detail">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary tambah" data-dismiss="modal" id="tambah">Tambah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Bill -->
    <div class="modal fade " tabindex="-1" role="dialog" aria-hidden="true" id="payment" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm  modal-dialog-centered">
            <div class="modal-content ">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-money "></i> Bill</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    MOdal bill
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>

                </div>

            </div>
        </div>
    </div>
    <script>
        window.addEventListener("load", function() {
            // BASIC
            numpad.attach({
                target: "pembayaran"
            });


        });

        $('.detail-item').on('click', function() {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: "<?= site_url('kasir/detailItem/') ?>" + id,
                dataType: "json",

                success: function(response) {
                    $('#detail').html(response.data);
                },
                error: function(xhr, ajaxOptions, ThrownError) {
                    alert(xhr.status);
                }
            })

        })
        $('#tambah').on('click', function() {
            var id_order = $('#order').val();
            var item = $('#item').val();
            var qty = $('#qty').val();
            $.ajax({
                url: "<?= site_url('kasir/addOrder') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    id_order: id_order,
                    item: item,
                    qty: qty
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, ajaxOptions, ThrownError) {
                    alert(xhr.status);
                }
            })
        })
        $(document).ready(function() {
            function list() {
                $.ajax({
                    url: "<?= site_url('kasir/showorder') ?>",
                    dataType: "JSON",
                    success: function(response) {
                        $('#list').html(response.data);
                    },
                    error: function(xhr, ajaxOptions, ThrownError) {
                        alert(xhr.status);
                    }
                })
            }
            list();
            setInterval(list, 1000);
        })
        $('.bayar').on('click', function() {
            var total = $('.datatotal').data('total');
            var total_val = $('.datatotal').data('total');
            $('.total-val').val(total_val);
            $('.total').text(total);
        })

        // $('.hapusItem').on('click', function(e) {
        //     e.preventDefault();
        //     var item = $(this).data('id')
        //     console.log(item);
        //     console.log('hapus item clicked');
        //     // $.ajax({
        //     //     url: "<?= site_url('kasir/deleteOrder') ?>" + item,
        //     //     dataType: "JSON",
        //     //     success: function(response) {
        //     //         alert('hapus ok');

        //     //     },
        //     //     error: function(xhr, ajaxOptions, ThrownError) {
        //     //         alert(xhr.status);
        //     //     }
        //     // })
        // })
    </script>

    <!-- Bootstrap -->
    <script src="<?= base_url('assets') ?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="<?= base_url('assets') ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Datatable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- PNotify -->
    <script src="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.nonblock.js"></script>



    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('assets') ?>/build/js/custom.min.js"></script>
    <script src="<?= base_url('assets') ?>/build/js/ajax.js"></script>
    <script src="<?= base_url('assets') ?>/build/js/myjs.js"></script>


</body>

</html>
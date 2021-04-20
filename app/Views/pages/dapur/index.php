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
    <title> <?= $page_title ?> </title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <!-- Canva -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!-- PNotify -->
    <link href="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">
    <style>
        #loading {
            width: 50px;
            height: 50px;
            border-radius: 100%;
            border: 5px solid #ccc;
            border-top-color: #2a3f54;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            z-index: 99;
            animation: putar 2s ease infinite;
        }

        @keyframes putar {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="nav-sm">
    <!-- Alert -->
    <div class="flashdata" data-flashdata="<?= session()->get('notif') ?>"></div>
    <div class="param" data-param="<?= session()->get('param') ?>"></div>

    <div id="loading"></div>
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col ">
                <div class="left_col scroll-view">
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    </div>
                </div>
            </div>
            <!-- page content -->
            <div class="right_col">
                <!-- Content -->
                <h1 style="text-align:center">HALL ROASTERY KITCHEN</h1>

                <div class="row ">
                    <div class="col-md-12 col-sm-12 " id="antrian">






                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            Hall Roastery - Development by <a href="ibobdb.github.io">Boby Nugraha Pratama</a>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    </div>
    </div>
    <script>
        $(document).ready(function() {
            function antrian() {
                $.ajax({
                    url: "<?= site_url('dapur/antrian') ?>",
                    dataType: "json",

                    success: function(response) {
                        $('#antrian').html(response.data);

                    },
                    // complete: function(f) {
                    //     new PNotify({
                    //         title: 'Regular Success',
                    //         text: 'That thing that you were trying to do worked!',
                    //         type: 'success',
                    //         styling: 'bootstrap3'
                    //     })
                    // }
                })
            }
            antrian();
            setInterval(antrian, 5000);


        })
    </script>

    <!-- Bootstrap -->
    <script src="<?= base_url('assets') ?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

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
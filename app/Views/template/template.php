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

<body class="nav-md">
    <div id="loading"></div>
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col ">
                <div class="left_col scroll-view">


                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= base_url('assets/production/images/' . user()->avatar)  ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?= user()->username ?></h2>


                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section" style="text-transform: capitalize;">

                            <ul class="nav side-menu">
                                <?php if (user()->role_id == 1) {
                                    $segment = '/owner';
                                } elseif (user()->role_id == 2) {
                                    $segment = '/admin';
                                } elseif (user()->role_id == 3) {
                                    $segment = '/kasir';
                                } else {
                                    $segment = '/dapur';
                                }
                                ?>
                                <li><a href="<?= $segment ?>"><i class="fa fa-home"></i>Beranda</span></a>
                                </li>
                                <?php
                                $this->menu = new App\Models\menu_model();
                                $menu = $this->menu->where('role_id', user()->role_id)->findAll();
                                $owner = $this->menu->findAll();
                                // Sub menu
                                $this->submenu = new App\Models\sub_menu_model();

                                ?>
                                <?php if (user()->role_id == 1) : ?>
                                    <?php foreach ($owner as $r) : ?>
                                        <li><a><i class="<?= $r['icon'] ?>"></i><?= $r['name'] ?><span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <?php
                                                $submenu = $this->submenu->where('menu_id', $r['id'])->findAll();
                                                foreach ($submenu as $r) : ?>
                                                    <li><a href="<?= $r['href'] ?>"><?= $r['name'] ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php foreach ($menu as $r) : ?>
                                        <li><a><i class="<?= $r['icon'] ?>"></i><?= $r['name'] ?><span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <?php
                                                $submenu = $this->submenu->where('menu_id', $r['id'])->findAll();
                                                foreach ($submenu as $r) : ?>
                                                    <li><a href="<?= $r['href'] ?>"><?= $r['name'] ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif; ?>
                                <!-- <li><a><i class="fa fa-coffee"></i>Penjualan<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/item">Item</a></li>
                                        <li><a href="/kategori">Kategori</a></li>
                                        <li><a href="/harga">Harga</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-gear"></i>Produksi<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/bahan">Bahan Olah</a></li>
                                        <li><a href="/bahanIn">Bahan In</a></li>
                                        <li><a href="/bahanOut">Bahan Out</a></li>
                                        <li><a href="#">Bahan per Item</a></li>
                                        <li><a href="/pending">Pending</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bell"></i>Marketing<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#">Event</a></li>
                                        <li><a href="#">Promosi</a></li>
                                        <li><a href="#">Diskon</a></li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-book"></i>Laporan<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="##">Laporan Bahan In & Out</a></li>
                                        <li><a href="#">Laporan Sisa</a></li>
                                        <li><a href="#">Income</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-users"></i>Karyawan<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/role">Level access menu</a></li>
                                        <li><a href="/karyawan">Karyawan</a></li>
                                        <li><a href="#">Absensi</a></li>
                                        <li><a href="#">Create Account (New User)</a></li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-folder-o"></i>Arsip<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#">Galeri</a></li>

                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-area-chart"></i>Chart</span></a>
                                </li>
                                <li><a><i class="fa fa-money"></i>Kasir<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li> <a href="/kasir_v2"></i>Kasir Versi 2</span></a></li>
                                    </ul>
                                </li>

                                <li><a href="#"><i class="fa fa-cutlery"></i>Dapur</span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-history"></i>History</span></a>
                                </li>
                                <li><a href="#"></i>Go to Coffe Shop</span></a>
                                </li> -->

                            </ul>
                        </div>
                    </div>



                    <!-- /sidebar menu -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('assets/production/images/' . user()->avatar)  ?>" alt=""><?= user()->username ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile"> Profile</a>
                                    <!-- <a class="dropdown-item" href="/menu"> Setting Menu</a> -->
                                    <a class="dropdown-item" href="/setting">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>


                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col">
                <!-- Content -->
                <?= $this->renderSection('content'); ?>
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
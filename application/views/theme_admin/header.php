<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?php echo base_url('vendors/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href=" <?php echo base_url('vendors/adminassets/assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href=" <?php echo base_url('vendors/adminassets/assets/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/adminassets/assets/css/style2.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/table/datatables/dataTables.bootstrap4.min.css') ?>">
    <link href="<?php echo base_url('vendors/swal/dist/sweetalert2.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <link rel="stylesheet" href="<?php echo base_url('vendors/adminassets/assets/css/customstyle.css') ?>">

    <style>
        .sidebar .nav .nav-item:hover{
            background: #202124!important;
        }

        .sidebar .nav .nav-item.active{
            background: #0277fa !important;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link:before{
            content: "\F054";
            font-family: "Material Design Icons";
            display: block;
            position: absolute;
            left: 0px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            color: #fff;
            font-size: .75rem;
        }
    </style>
</head>

<body>
    <!--navbar-->
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #fff;">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background: #4682B4;">
                <a class="navbar-brand brand-logo " style="width:15%;" href=""><img src="<?php echo base_url() ?>/assets/jawatengah1.png ?>" alt="logo" style="width:20px; height:20px; margin-right:5spx; " /></a>
                <h4 class="card-title text-white m-0">Sistem Cuti Pegawai</h4>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu text-black"></span>
                </button>
                <div class="navbar-nav navbar-nav-right">
                        <a class="" href="<?= base_url('user/logout'); ?>" style="text-decoration:none;">
                            <i class="mdi mdi-logout mr-2 text-primary"></i> Logout
                        </a>
                        <form id="logout-form" action="" method="POST" style="display: none;">
                        </form>
                    </div>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #4682B4;">
                <ul class="nav">
                <br> </br>
                    <li class="nav-item nav-profile">
                        <div class="nav-profile-text d-flex flex-column text-white">
                            <span class="font-weight-bold mb-2 text-center"><?= $user->nama ?></span>
                        </div>
                        <hr color="white">
                    </li>

                    <?php 
                        $a      = 'active';

                        $d      = $this->uri->segment(2) == 'Dashboard';
                        $pp     = $this->uri->segment(2) == 'Cuti';
                        $lp     = $this->uri->segment(2) == 'LaporanCuti';
                        $pd     = $this->uri->segment(2) == 'Pegawai';
                    ?>

                    <li class="nav-item <?php if($d){echo $a;} ?>">
                        <a class="nav-link" href="<?php echo base_url('admin/dashboard') ?>">
                            <span class="menu-title text-white">Dashboard</span>
                            <i class="mdi mdi-home menu-icon text-white"></i>
                        </a>
                    </li>
                    <li class="nav-item <?php if($pd){echo $a;} ?>">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
                            <span class="menu-title text-white">Data Pegawai</span>
                            <i class="menu-arrow text-white"></i>
                            <i class="fa fa-address-card menu-icon text-white"></i>
                        </a>
                        <div class="collapse" id="ui-basic1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/Pegawai/tambah') ?>">Tambah Pegawai</a></li>
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/Pegawai/index') ?>">Daftar Pegawai</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item <?php if($pp){echo $a;} ?>">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                            <span class="menu-title text-white">Data Cuti</span>
                            <i class="menu-arrow text-white"></i>
                            <i class="fa fa-book menu-icon text-white"></i>
                        </a>
                        <div class="collapse" id="ui-basic2">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/Cuti/cutiSakit') ?>">Cuti Sakit <= 14 Hari</a></li>
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/Cuti/cutiSakit14') ?>">Cuti Sakit > 14 Hari</a></li>
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/Cuti/cutiMelahirkan') ?>">Cuti Melahirkan</a></li>
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/Cuti/cutiAlasanPenting') ?>">Cuti Alasan Penting</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item <?php if($lp){echo $a;} ?>">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
                            <span class="menu-title text-white">Laporan Cuti</span>
                            <i class="menu-arrow text-white"></i>
                            <i class="fa fa-book menu-icon text-white"></i>
                        </a>
                        <div class="collapse" id="ui-basic3">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/LaporanCuti/cutiSakit') ?>">Cuti Sakit <= 14 Hari</a></li>
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/LaporanCuti/cutiSakit14') ?>">Cuti Sakit > 14 Hari</a></li>
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/LaporanCuti/cutiMelahirkan') ?>">Cuti Melahirkan</a></li>
                                <li class="nav-item"> <a class="nav-link text-white" href="<?= base_url('admin/LaporanCuti/cutiAlasanPenting') ?>">Cuti Alasan Penting</a></li>
                            </ul>
                        </div>
                    </li>
                    
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <!--content-->
                <div class="content-wrapper" style="background: #F5F5F5;">
                    <div class="page-header">
                        <h3 class="page-title" style="color: #4682B4;">
                            <span class="page-title-icon  text-white mr-2" style="background:#4682B4;">
                                <i class="mdi mdi-home" ></i>
                            </span> <?= $title ?>
                        </h3>

                        <!-- <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page" style="color: #fff;">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
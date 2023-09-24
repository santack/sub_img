<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>DEMO System</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/all.min.css">
    <!-- Main styles for this application-->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/chartjs/css/chartjs.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatable/css/dataTables.bootstrap4.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <!--FONT AWESOME 5 FREE-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/feather/css/feather.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>

    <!--SELECT2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <style>
        a {
            text-decoration: none;
            background-color: transparent;
            color: #321fdb;
        }

        .dropdown-menu>li>a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .note-icon-caret:before {
            content: "";
        }

        .note-editable {
            font-size: 1rem;
        }
    </style>
</head>

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-md-down-none">
            <span class="c-sidebar-brand-full" style="font-size:20px;">DEMO </span>
            <span class="c-sidebar-brand-minimized" style="font-size:20px;">DEMO</span>
        </div>
        <?php if ($this->session->userdata("login_data")['role_id'] == 1 || $this->session->userdata("login_data")['role_id'] == 2) {?>
            <ul class="c-sidebar-nav ps ps--active-y">
                <!-- <li class="c-sidebar-nav-title">DASHBOARD</li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'dashboard') {
                                                        echo 'c-active';
                                                    } ?>" href="<?= site_url('dashboard/index'); ?>">
                        <i class="feather icon-clipboard c-sidebar-nav-icon"></i>
                        Dashboard
                    </a>
                </li> -->
                <li class="c-sidebar-nav-title">Admin/Users</li>
                    <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'admin') {
                                                                echo 'c-active';
                                                            } ?>" href="<?= base_url() ?>admin">
                                <i class="feather icon-user c-sidebar-nav-icon"></i>
                                Admin
                            </a>
                        </li>
                        
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'dealer') {
                                                                echo 'c-active';
                                                            } ?>" href="<?= base_url() ?>dealer">
                                <i class="feather icon-user c-sidebar-nav-icon"></i>
                                Dealer Setup
                            </a>
                        </li>

                    <?php } ?>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'customer') {
                                                            echo 'c-active';
                                                        } ?>" href="<?= base_url() ?>customer">
                            <i class="feather icon-user c-sidebar-nav-icon"></i>
                            Customer
                        </a>
                    </li>
                <!-- <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'dividend') {
                                                        echo 'c-active';
                                                    } ?>" href="<?= site_url('dividend'); ?>">
                        <i class="feather icon-users c-sidebar-nav-icon"></i>
                        Dividend
                    </a>
                </li>
                <li class="c-sidebar-nav-title">ORDER</li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'orders') {
                                                        echo 'c-active';
                                                    } ?>" href="<?= site_url('orders'); ?>">
                        <i class="feather icon-shopping-cart c-sidebar-nav-icon"></i>
                        Orders
                    </a>
                </li> -->
                
                <li class="c-sidebar-nav-title">APPROVAL/REPORT</li>
                    <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'approval') {
                                                                echo 'c-active';
                                                            } ?>" href="<?= site_url('approval'); ?>">
                                <i class="feather icon-activity c-sidebar-nav-icon"></i>
                                Approval
                            </a>
                        </li>

                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'approved_customer') {
                                                                echo 'c-active';
                                                            } ?>" href="<?= site_url('approved_customer'); ?>">
                                <i class="feather icon-activity c-sidebar-nav-icon"></i>
                                Approved Customer
                            </a>
                        </li>
                    <?php } ?>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'report') {
                                                            echo 'c-active';
                                                        } ?>" href="<?= site_url('report'); ?>">
                            <i class="feather icon-activity c-sidebar-nav-icon"></i>
                            Report
                        </a>
                    </li>
                    <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                        <li class="c-sidebar-nav-title">SETTINGS</li>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'package') {
                                                                echo 'c-active';
                                                            } ?>" href="<?= site_url('package'); ?>">
                                <i class="feather icon-activity c-sidebar-nav-icon"></i>
                                Packages
                            </a>
                        </li>
                    <?php } ?>

            <!-- </ul>
            </li> -->

                <li class="c-sidebar-nav-divider"></li>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; height: 577px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 256px;"></div>
                </div>
            </ul>
        <?php } ?>

        <?php if ($this->session->userdata("login_data")['role_id'] == 2) {?>
            <ul class="c-sidebar-nav ps ps--active-y">
                <!-- <li class="c-sidebar-nav-title">DASHBOARD</li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php if ($this->router->fetch_class() == 'dashboard/agent_index') {
                                                        echo 'c-active';
                                                    } ?>" href="<?= site_url('dashboard/agent_index'); ?>">
                        <i class="feather icon-clipboard c-sidebar-nav-icon"></i>
                        Dashboard
                    </a>
                </li> -->

            
                    </ul>
                </li>

                <li class="c-sidebar-nav-divider"></li>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; height: 577px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 256px;"></div>
                </div>
            </ul>
        <?php }?>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-unfoldable"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show" style="line-height: 1;">
                <i class="cil-menu c-icon c-icon-lg"></i>
            </button>
            <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
                <!-- <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
                </svg> -->
            </a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true" style="line-height: 1;">
                <i class="cil-menu c-icon c-icon-lg"></i>
            </button>
            <!-- <ul class="c-header-nav d-md-down-none">
                <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="<?= base_url() ?>dashboard">Dashboard</a></li>
            </ul> -->
            <ul class="c-header-nav mfs-auto">
                <li class="c-header-nav-item px-3 c-d-legacy-none">
                    <button class="c-class-toggler c-header-nav-btn" type="button" id="headertooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="" data-original-title="Toggle Light/Dark Mode" aria-describedby="tooltip615585">
                        <i class="cil-moon c-icon c-d-dark-none"></i>
                        <i class="cil-sun c-icon c-d-default-none"></i>
                    </button>
                </li>
            </ul>
            <ul class="c-header-nav">
                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar"><img class="c-avatar-img" src="<?= base_url() ?>assets/img/core/aohsuehfu.png" alt=""></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <strong>Hello, <?= $this->session->userdata('login_data')['name']; ?></strong>
                        </div>
                        <!-- <a class="dropdown-item" href="#">
                            <i class="cil-user c-icon mfe-2"></i>
                            Profile
                        </a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url() ?>access/logout">
                            <i class="cil-account-logout c-icon mfe-2"></i>
                            Logout
                        </a>
                    </div>
                </li>
                <li class="c-header-nav-item px-2 c-d-legacy-none"></li>
            </ul>

        </header>
        <div class="c-body">
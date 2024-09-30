<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="gt-ie8 gt-ie9 not-ie">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

        <!-- Open Sans font from Google CDN -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

        <!-- Pixel Admin's stylesheets -->
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/themes.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url() ?>assets/admin/stylesheets/my.css" rel="stylesheet" type="text/css">

        <!--[if lt IE 9]>
        <script src="<?php echo base_url() ?>assets/admin/javascripts/ie.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/js/jquery-2.0.3.min.js">' + "<" + "/script>");</script>
        <!-- <![endif]-->
        <!--[if lte IE 9]>
        <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/js/jquery-1.8.3.min.js">'+"<"+"/script>"); </script>
        <![endif]-->
    </head>
    <body class="theme-default main-navbar-fixed px-navbar-fixed">
        <script>var init = [];</script>
        <div id="main-wrapper">
            <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
                <!-- Main menu toggle -->
                <button type="button" id="main-menu-toggle">
                    <i class="navbar-icon fa fa-bars icon"></i><span
                        class="hide-menu-text">HIDE MENU</span>
                </button>

                <div class="navbar-inner">
                    <!-- Main navbar header -->
                    <div class="navbar-header">

                        <!-- Logo -->
                        <a class="navbar-brand">
                            <div>
                                <img alt="Pixel Admin" src="<?php echo base_url() ?>assets/admin/images/pixel-admin/main-navbar-logo.png">
                            </div> Admin Control
                        </a>

                        <!-- Main navbar toggle -->
                        <button type="button" class="navbar-toggle collapsed"
                                data-toggle="collapse" data-target="#main-navbar-collapse">
                            <i class="navbar-icon fa fa-bars"></i>
                        </button>

                    </div>
                    <!-- / .navbar-header -->

                    <div id="main-navbar-collapse"
                         class="collapse navbar-collapse main-navbar-collapse">
                        <div>

                            <div class="right clearfix">
                                <ul class="nav navbar-nav pull-right right-navbar-nav">

                                    <li class="dropdown"><a href="#"
                                                            class="dropdown-toggle user-menu" data-toggle="dropdown"> <img
                                                src="<?php echo base_url() ?>assets/admin/demo/avatars/1.jpg"
                                                alt=""> <span class="text-slim">Welcome,</span><span><?php echo get_admin_login()->name ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo site_url('user/edit_profile') ?>">Profile</a></li>
                                            <?php if (get_admin_login()->is_level == '1') { ?>
                                                <li><a
                                                        href="<?php echo site_url('user') ?>">Account</a></li>
                                                <?php } ?>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo site_url('login/logout') ?>"><i
                                                        class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log
                                                    Out</a></li>
                                        </ul></li>
                                </ul>
                                <!-- / .navbar-nav -->
                            </div>
                            <!-- / .right -->
                        </div>
                    </div>
                    <!-- / #main-navbar-collapse -->
                </div>
                <!-- / .navbar-inner -->
            </div>
            <!-- / #main-navbar -->
            <!-- /2. $END_MAIN_NAVIGATION -->

            <div id="main-menu" role="navigation">
                <div id="main-menu-inner">
                    
                    <div class="menu-content top" id="menu-content-demo">

                        <div>
                            <div class="text-bg">
                                <span class="text-semibold"><?php echo get_admin_login()->name ?></span>
                            </div>

                            <img src="<?php echo base_url() ?>assets/admin/demo/avatars/1.jpg"
                                 alt="" class="">
                            <div class="btn-group">
                                <?php if (get_admin_login()->is_level == '1') { ?>
                                    <a
                                        href="<?php echo site_url('user') ?>"
                                        class="btn btn-xs btn-primary btn-outline dark"><i
                                            class="fa fa-user"></i></a>
                                    <?php } ?>
                                <a
                                    href="<?php echo site_url('user/edit_profile') ?>"
                                    class="btn btn-xs btn-primary btn-outline dark"><i
                                        class="fa fa-cog"></i></a> <a
                                    href="<?php echo site_url('login/logout') ?>"
                                    class="btn btn-xs btn-danger btn-outline dark"><i
                                        class="fa fa-power-off"></i></a>
                            </div>
                            <!--a href="#" class="close">&times;</a-->
                        </div>
                    </div>

                    <ul class="navigation">
                        <!-- <li>
                            <a href="<?php echo site_url('slide') ?>"><i class="menu-icon fa fa-tasks"></i><span class="mm-text">สไลด์โชว์</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('activity') ?>"><i class="menu-icon fa fa-calendar-o"></i><span class="mm-text">กิจกรรม</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('about') ?>"><i class="menu-icon fa fa-tasks"></i><span class="mm-text">เกี่ยวกับเรา</span></a>
                        </li>
                        
                        <li class="mm-dropdown mm-dropdown-root open">
                            <a href="#"><i class="menu-icon fa fa-camera-retro"></i><span class="mm-text">พื้นที่สุขภาวะสร้างสรรค์</span></a>
                            <ul class="mmc-dropdown-delay animated fadeInLeft">
                                <li><a href="<?php echo site_url('sandbox1/edit2/15') ?>"><span class="mm-text">แก้ไขพื้นที่สุขภาวะสร้างสรรค์</span></a></li>
                                <li></li>
                                <li><a href="<?php echo site_url('sandbox1') ?>"><span class="mm-text">Sandbox กรุงเทพมหานคร</span></a></li>
                                <li><a href="<?php echo site_url('sandbox2') ?>"><span class="mm-text">Sandbox ต่างจังหวัด</span></a></li>
                                <li><a href="<?php echo site_url('sandbox3') ?>"><span class="mm-text">โมเดล Health Station</span></a></li>
                            </ul>
                        </li> -->
                        
                        <li>
                            <a href="<?php echo site_url('faq') ?>"><i class="menu-icon fa fa-tasks"></i><span class="mm-text">FAQ</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('cases') ?>"><i class="menu-icon fa fa-leaf"></i><span class="mm-text">CASES</span></a>
                        </li>
                       

                        <?php if (get_admin_login()->is_level == '1') { ?>
                        <li>
                            <a href="<?php echo site_url('user') ?>">
                            <i class="menu-icon fa fa-user"></i><span class="mm-text">Users</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- / .navigation -->

                </div>
                <!-- / #main-menu-inner -->
            </div>
            <!-- / #main-menu -->
            <!-- /4. $MAIN_MENU -->

            <!-- / #content-wrapper -->
            <div id="content-wrapper">
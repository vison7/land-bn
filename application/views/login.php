<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="gt-ie8 gt-ie9 not-ie">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sign In - Admin Control</title>
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

        <!-- Open Sans font from Google CDN -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin"
            rel="stylesheet" type="text/css">

        <!-- Pixel Admin's stylesheets -->
        <link
            href="<?php echo base_url() ?>assets/admin/stylesheets/bootstrap.min.css"
            rel="stylesheet" type="text/css">
        <link
            href="<?php echo base_url() ?>assets/admin/stylesheets/pixel-admin.min.css"
            rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/pages.min.css"
              rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/admin/stylesheets/rtl.min.css"
              rel="stylesheet" type="text/css">
        <link
            href="<?php echo base_url() ?>assets/admin/stylesheets/themes.min.css"
            rel="stylesheet" type="text/css">

        <!--[if lt IE 9]>
                    <script src="<? echo base_url() ?>assets/admin/javascripts/ie.min.js"></script>
                <![endif]-->
    </head>

    <body class="theme-default page-signin">
        <script>
            var init = [];
        </script>

        <!-- Page background -->
        <div id="page-signin-bg">
            <!-- Background overlay -->
            <div class="overlay"></div>
            <!-- Replace this with your bg image -->
            <img src="<?php echo base_url() ?>assets/admin/demo/signin-bg-8.jpg"
                 alt="">
        </div>
        <!-- / Page background -->

        <!-- Container -->
        <div class="signin-container">

            <!-- Left side -->
            <div class="signin-info">
                <a href="index.html" class="logo">
                    <img src="<?php echo base_url() ?>/assets/admin/demo/logo-big.png" alt="" style="margin-top: -5px;">&nbsp;
                    LAND DEFENDERS
                </a> <!-- / .logo -->
                <!--div class="slogan">
                   Content Management
                </div--> <!-- / .slogan -->
                <ul>
                    <!-- <li><i class="fa fa-sitemap signin-icon"></i> Wat Management</li> -->
                    <li><i class="fa fa-file-text-o signin-icon"></i> Content Management</li>
                    <li><i class="fa fa-user signin-icon"></i> User Management</li>
                </ul> <!-- / Info list -->
            </div>
            <!-- / Left side -->

            <!-- Right side -->
            <div class="signin-form">

                <!-- Form -->
                <form action="<?php echo site_url('login/auth') ?>"
                      id="signin-form_id" method="post">
                    <div class="signin-text">
                        <span>Sign In to your account</span>
                    </div>
                    <!-- / .signin-text -->

                    <div class="form-group w-icon">
                        <input type="text" name="username" id="username_id"
                               class="form-control input-lg" placeholder="Username"> <span
                               class="fa fa-user signin-form-icon"></span>
                    </div>
                    <!-- / Username -->

                    <div class="form-group w-icon">
                        <input type="password" name="password" id="password_id"
                               class="form-control input-lg" placeholder="Password"> <span
                               class="fa fa-lock signin-form-icon"></span>
                    </div>
                    <!-- / Password -->

                    <div class="form-actions">
                        <input type="submit" value="SIGN IN" class="signin-btn bg-primary">
                    </div>
                    <!-- / .form-actions -->
                </form>
                <!-- / Form -->

                <!-- "Sign In with" block -->
                <div class="signin-with text-danger">
                    <!-- Facebook -->
                    <?php if (isset($_GET['str'])) echo $_GET['str']; ?>
                </div>
                <!-- / "Sign In with" block -->

                <!-- Password reset form -->
                <div class="password-reset-form" id="password-reset-form">
                    <div class="header">
                        <div class="signin-text">
                            <span>Password reset</span>
                            <div class="close">&times;</div>
                        </div>
                        <!-- / .signin-text -->
                    </div>
                    <!-- / .header -->

                    <!-- Form -->
                    <form action="index.html" id="password-reset-form_id">
                        <div class="form-group w-icon">
                            <input type="text" name="password_reset_email" id="p_email_id"
                                   class="form-control input-lg" placeholder="Enter your email"> <span
                                   class="fa fa-envelope signin-form-icon"></span>
                        </div>
                        <!-- / Email -->

                        <div class="form-actions">
                            <input type="submit" value="SEND PASSWORD RESET LINK"
                                   class="signin-btn bg-primary">
                        </div>
                        <!-- / .form-actions -->
                    </form>
                    <!-- / Form -->
                </div>
                <!-- / Password reset form -->
            </div>
            <!-- Right side -->
        </div>
        <!-- / Container -->


        <!-- Get jQuery from Google CDN -->
        <!--[if !IE]> -->
        <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/js/jquery-2.0.3.min.js">' + "<" + "/script>");</script>
        <!-- <![endif]-->
        <!--[if lte IE 9]>
                <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/js/jquery-1.8.3.min.js">'+"<"+"/script>"); </script>
            <![endif]-->

        <!-- Pixel Admin's javascripts -->
        <script
        src="<?php echo base_url() ?>assets/admin/javascripts/bootstrap.min.js"></script>
        <script
        src="<?php echo base_url() ?>assets/admin/javascripts/pixel-admin.min.js"></script>

        <script type="text/javascript">
            // Resize BG
            init.push(function () {
                var $ph = $('#page-signin-bg'),
                        $img = $ph.find('> img');

                $(window).on('resize', function () {
                    $img.attr('style', '');
                    if ($img.height() < $ph.height()) {
                        $img.css({
                            height: '100%',
                            width: 'auto'
                        });
                    }
                });
            });

            // Show/Hide password reset form on click
            init.push(function () {
                $('#forgot-password-link').click(function () {
                    $('#password-reset-form').fadeIn(400);
                    return false;
                });
                $('#password-reset-form .close').click(function () {
                    $('#password-reset-form').fadeOut(400);
                    return false;
                });
            });

            // Setup Sign In form validation
            init.push(function () {
                $("#signin-form_id").validate({focusInvalid: true, errorPlacement: function () {
                    }});

                // Validate username
                $("#username_id").rules("add", {
                    required: true
                });

                // Validate password
                $("#password_id").rules("add", {
                    required: true
                });
            });

            // Setup Password Reset form validation
            init.push(function () {
                $("#password-reset-form_id").validate({focusInvalid: true, errorPlacement: function () {
                    }});

                // Validate email
                $("#p_email_id").rules("add", {
                    required: true,
                    email: true
                });
            });

            window.PixelAdmin.start(init);
        </script>

    </body>
</html>

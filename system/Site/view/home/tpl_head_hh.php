<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="<?php echo BASE_URL; ?>">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>">    

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <meta name="google-site-verification" content="RujCbwXyQ-RPsoDLAJpSVKlNOySdfZwzKIJ6wa0SFUQ" />
        <link rel="shortcut icon" href="<?php echo SITE_IMAGE; ?>favicon.ico" type="image/png">
        <link rel="stylesheet" href="<?php echo SITE_CSS; ?>bootstrap.min.css" type="text/css">
        <link rel='stylesheet' href='<?php echo SITE_ASSETS; ?>fonts/font-awesome/css/font-awesome.min.css' type='text/css' media='all' />
        <link rel="stylesheet" href="<?php echo Util::auto_version(SITE_CSS . 'megajatszohaz.css'); ?>" type="text/css">


        <!-- IE 8 Fallback -->
        <!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie.css" />
        <![endif]-->


        <!-- OLDALSPECIFIKUS CSS LINKEK -->
        <?php
        if (isset($this->css_link)) {
            foreach ($this->css_link as $value) {
                echo $value;
            }
        }
        ?>

        <?php if (DEV == "production") { ?>
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-72773030-1', 'auto');
                ga('send', 'pageview');

            </script>      
        <?php } ?> 

    </head>

    <body class="boxed bg-cover sticky-header">


        <div class="global-wrap">

            <?php include "system/site/view/_template/tpl_top_header.php"; ?>

            <?php include "system/site/view/_template/tpl_header.php"; ?>

            <?php include "system/site/view/_template/tpl_login_dialog.php"; ?>

            <?php include "system/site/view/_template/tpl_register_dialog.php"; ?>

            <?php include "system/site/view/_template/tpl_newsletter_dialog.php"; ?>

            <?php include "system/site/view/_template/tpl_hello_popup_dialog.php"; ?>

            <?php include "system/site/view/_template/tpl_forgot_password_dialog.php"; ?>


            <!-- ******************** RENDEZVÉNYEK CAROUSEL ************************** -->


            <div class="total-events"><p class="text-center"><<  Összesen <span class="badge"><?php echo count($jatszohazak); ?></span> játszóház  >></p></div>

            <div class="owl-carousel" id="owl-carousel" data-items="4">



                <?php foreach ($jatszohazak as $value) { ?>

                    <div class="product-thumb">
                        <header class="product-header">
                            <img src="<?php echo Config::get('rendezvenyphoto.upload_path') . $value['rendezveny_photo']; ?>" alt="játszóház <?php echo $value['city_name']; ?>" title="játszóház <?php echo $value['city_name']; ?>" />
                        </header>
                        <div class="product-inner">
                            <h5 class="product-title"><?php echo $value['city_name']; ?></h5>
                            <p class="product-desciption"><?php echo Util::hun_month(strftime("%B %d, %Y", $value['rendezveny_start_timestamp'])); ?></p>
                            <?php if (time() < $value['rendezveny_start_timestamp']) { ?>
                                <div class="countdown" data-countdown="<?php echo strftime("%B %d, %Y %H:%M:00", $value['rendezveny_start_timestamp']); ?>"></div>
                            <?php } ?>
                            <?php if (time() < $value['rendezveny_expiry_timestamp'] && time() > $value['rendezveny_start_timestamp']) { ?>
                                <div class="countdown-text">Jöjjön el, még nyitva vagyunk!</div>
                            <?php } ?>
                            <ul class="product-actions-list">
                                <li>
                                    <a href="jatszohazak/<?php echo Util::string_to_slug($value['city_name'] . '-' . strftime("%Y-%m-%d", $value['rendezveny_start_timestamp'])); ?>/<?php echo $value['rendezveny_id']; ?>" class="btn btn-ghost"><i class="fa fa-arrow-circle-o-right"></i> Részletek</a>                                            </li>
                            </ul>
                        </div>
                    </div>

                <?php } ?>              


            </div>


            <?php include "system/site/view/_template/tpl_next_event.php"; ?>



            <!-- //////////////////////////////////
            //////////////END MAIN HEADER////////// 
            ////////////////////////////////////-->        

<?php $logged_in = Session::get('user_site_logged_in'); ?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="<?php echo $this->registry->site_url; ?>">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>">    
        <link rel="stylesheet" href="<?php echo SITE_CSS; ?>bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?php echo Util::auto_version(SITE_CSS . 'master.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_CSS; ?>layout-box.css" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_ASSETS . 'plugins/iview/css/iview.css'; ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_ASSETS . 'plugins/iview/css/skin/style.css'; ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_ASSETS . 'plugins/toastr/toastr.css'; ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo Util::auto_version(SITE_CSS . 'custom.css');?>" type="text/css">
        <link rel='stylesheet' href='<?php echo SITE_ASSETS; ?>fonts/font-awesome/css/font-awesome.min.css' type='text/css' media='all' />

        <link rel="shortcut icon" href="<?php echo SITE_IMAGE; ?>favicon.ico" type="image/png">

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

            </script>      
        <?php } ?>         

    </head>

    <body>
        <div class="layout-theme animated-css"  data-header="sticky" data-header-top="200"  >


            <?php include "system/site/view/_template/tpl_top_header.php"; ?>


            <?php include "system/site/view/_template/tpl_menu.php"; ?>

            <?php  include "system/site/view/_template/tpl_login_modal.php"; ?> 

            <?php  include "system/site/view/_template/tpl_register_modal.php"; ?>

            <?php // include "system/site/view/_template/tpl_newsletter_dialog.php"; ?>

            <?php // include "system/site/view/_template/tpl_hello_popup_dialog.php"; ?>

            <?php include "system/site/view/_template/tpl_forgottenpw_modal.php"; ?>

            <?php // include "system/site/view/_template/tpl_next_event.php";  ?>




            <!-- //////////////////////////////////
            //////////////END MAIN HEADER////////// 
            ////////////////////////////////////-->        

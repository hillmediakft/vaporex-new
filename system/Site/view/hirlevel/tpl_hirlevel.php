<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="<?php echo BASE_URL; ?>">
        <title>Megajátszóház hírlevélre feliratkozás hitelesítés</title>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="<?php echo SITE_IMAGE; ?>favicon.ico" type="image/png">
        <link rel="stylesheet" href="<?php echo SITE_CSS; ?>bootstrap.css" type="text/css">


        <!-- OLDALSPECIFIKUS CSS LINKEK -->
        <?php
        if (isset($this->css_link)) {
            foreach ($this->css_link as $value) {
                echo $value;
            }
        }
        ?>

    </head>
    <body>

        <div class="container" style="margin-top: 30px; margin-bottom: 20px;">
            <div class="row">
                <div class="text-center">
                    <div class="logo-wrapper span-md-12">

                        <div class="logo">
                            <a href="#" title="Home">
                                <img src="<?php echo SITE_IMAGE; ?>logo.png" alt="Home">
                            </a>
                        </div><!-- /.logo -->

                        <div class="site-slogan">
                            <h4>Játszóházak az ország minden részében</h4>
                        </div><!-- /.site-slogan -->
                    </div><!-- /.logo-wrapper -->

                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->

        <!-- TARTALOM -->
        <div class="container">
            <div class="row text-center well">
                <h2>Feliratkozás visszaigazolás</h2>
               
                <p><?php echo $message; ?></p>
                <p>A hírlevélről bármikor leiratkozhat. Leiratkozáshoz kattintson a hírlevélben található leiratkozás linkre.</p>
                <br />
                <a href="<?php echo BASE_URL; ?>" class="btn btn-primary">Tovább a Megajátszóhát weboldalra</a>
            </div>
        </div>



        <?php
        if (isset($this->js_link)) {
            foreach ($this->js_link as $value) {
                echo $value;
            }
        }
        ?>

    </body>
</html>
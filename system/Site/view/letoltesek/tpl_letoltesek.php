<?php 
use System\Libs\Config;
?>
<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Letöltések </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Letöltések</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<main class="main-content" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3"    >
                <?php include('system/site/view/_template/tpl_sidebar.php'); ?> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <div class="row">
                    <div class="col-md-12">
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <h2 class="heading"><span>Letöltések</span></h2>
                            </div>
                        </header>
                        <p>Az alábbi oldalon PDF formátumba letöltheti a biztonsági adatlapokat, az ÉMI bizonyítványokat valamint termékismertetőnket.</p>  
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <?php foreach($letoltesek as $key=>$value) : ?>
                        <h4><?php echo $key;?><h4>
                                <hr>
                         <ul class="list-style-download">
                            <?php foreach($value as $letoltes) : ?>
                         
                       
                            <li>
                                <a href="<?php echo BASE_URL . Config::get('documents.upload_path') . $letoltes['file'];?>" target="_blank" class="btn btn-link"> <?php echo $letoltes['title'];?></a>
                            </li>
                       
                        <?php endforeach ?>
                             </ul>
                        <?php endforeach ?>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Elérhetőségek</h2>
                        <?php echo $settings['ceg']; ?> | <i class="fa fa-phone"></i> <?php echo $settings['tel']; ?>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>
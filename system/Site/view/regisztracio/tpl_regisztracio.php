<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Regisztráció </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Regisztráció visszaigazolása</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<main class="main-content" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <?php if ($result) { ?>
                                    <h2 class="heading"><span>Regisztráció hitelesítve!</span></h2>
                                <?php } ?>
                                <?php if (!$result) { ?>
                                    <h2 class="heading"><span>Hiba történt!</span></h2>
                                <?php } ?>
                            </div>
                        </header>
                        <div class="well">
                            <?php if ($result) { ?>
                            <i class="fa fa-check fa-2x fa-pull-left fa-border" aria-hidden="true"></i> 
                                <p>A regisztráció sikeresen aktiválva! Megrendelés elküldéséhez lépjen be a regisztráció során használt email címével és jelszavával!</p> 
                                <p>Adatait a profil oldalon módosíthatja, amelynek eléréséhez kattintson a képernyő jobb felső sarkában található felhasználó névre (<i class="fa fa-user"></i> felhasználó név)!</p>
                            
                            <?php } ?>

                            <?php if (!$result) { ?>
                                <h4> <i class="fa fa-exclamation-circle fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Hiba történt: nem létező azonosító/visszaigazoló kód! A visszaigazolásra használt linkben hibás adatok szepelnek. </h4>  
                            <?php } ?>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3"    >
                <?php include('system/site/view/_template/tpl_sidebar.php'); ?> 
            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>
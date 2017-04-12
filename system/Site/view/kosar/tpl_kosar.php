<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Kosár </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Kosár</li>
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
                                <h2 class="heading"><span>Kosár</span></h2>
                            </div>
                        </header>
                        <p>A kosárba helyezett termékek</p>
                        <?php if (empty($items)) { ?>
                            <p>Nincs termék a kosárban</p>
                        <?php } ?>
                        <?php if (!empty($items)) { ?>
                            <form id="kosar_form" name="kosar_form" action="kosar/ajax" method="post">




                                <div id="kosar_submit">
                                    <button id="submit-button" name="submit-button" class="btn btn-primary" value="Kalkuláció" type="submit">Kalkuláció</button>
                                </div>
                            </form>                       
                        <?php } ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>
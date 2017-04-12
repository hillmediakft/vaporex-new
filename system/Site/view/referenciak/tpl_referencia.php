<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Refrenciák </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li><a href="referenciak">referenciák</a></li>
                    <li class="active"><?php echo $referencia['project_category_name']; ?> referencia</li> 
                </ol>
            </div>
        </div>
    </div>
</section>
<main class="main-content" >
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <div class="row">
                    <div class="col-md-12">
                        
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <h2 class="heading"><span><?php echo $referencia['project_category_name']; ?> referencia</span></h2>
                            </div>
                        </header>
                    </div>
                    <div class="col-xs-12 col-md-5">
                        <a href="<?php echo $referencia['project_photo']; ?>" class="magnific"> 
                            <img src="<?php echo $referencia['project_photo']; ?>" class="responsive-img img-thumbnail" height="350" width="598">
                        </a> 
                    </div>
                    <div class="col-xs-12 col-md-7">
                        <h2><?php echo $referencia['project_title']; ?></h2>
                        <?php echo $referencia['project_description']; ?> 

                    </div>
                </div>

                <hr>


            </div>
            <div class="col-xs-12 col-sm-12 col-md-3"    >
                <?php include($this->path('tpl_sidebar')); ?> 
            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>



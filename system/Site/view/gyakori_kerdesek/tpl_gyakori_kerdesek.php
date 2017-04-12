<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Gyakori kérdések </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Gyakori kérdések</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<main class="main-content" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3"    >
                <?php include($this->path('tpl_sidebar')); ?> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <div class="row">
                    <div class="col-md-12">
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <h2 class="heading"><span>Gyakori kérdések</span></h2>
                            </div>
                        </header>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis iaculis mi. Integer in turpis dictum, rutrum leo dictum, hendrerit metus. Nam ac malesuada odio. Phasellus ullamcorper, magna eget aliquam vehicula, mi augue gravida metus, eget lobortis quam risus id lorem. </p>  

                    </div>
                </div>


                <?php if (!empty($gyik_rendezett)) : ?>
                    <?php foreach ($gyik_rendezett as $key => $value) { ?>

                        <h4><?php echo $key; ?></h4>


                        <?php foreach ($value as $key2 => $value2) { ?>


                            <h5>
                                <a data-toggle="collapse" href="#collapseExample-<?php echo $value2['gyik_id'];?>"><?php echo $value2['gyik_title']; ?> 
                                     <i class="fa fa-arrow-down fa-border" aria-hidden="true"></i>
                                </a>
                            </h5>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="collapse" id="collapseExample-<?php echo $value2['gyik_id'];?>">

                                        <?php echo $value2['gyik_description']; ?>
                                    </div>
                                </div>
                            </div>




                        <?php } ?>

                        <!--end of accordion--> 
                    <?php } ?>
                <?php endif ?>




                <hr>


            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>
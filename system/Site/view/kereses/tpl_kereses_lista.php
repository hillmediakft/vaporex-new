<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Keresés </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Keresés</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<main class="main-content search" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <div class="row">
                    <div class="col-md-12">
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <h2 class="heading"><span>Találatok a következő kifejezésre: "<?php echo $keyword; ?>"</span></h2>
                            </div>
                        </header>
                        
 <ul class="list-style-check list-style-check-blue">
                    <?php if (count($result_list) > 0) : ?>    
                       
                        <?php foreach ($result_list as $key => $value) { ?> 
                                <h4><?php echo $key . ' (' . count($result_list[$key]) . ')'; ?></h4>
                            <?php foreach ($result_list[$key] as $val) { ?>
                                <li> 
                                    <?php echo $val['title']; ?>
                                    <br>
                                    <a href="<?php echo $val['link']; ?>">
                                        <?php echo $val['link']; ?>
                                    </a>
                                </li> 
                            <?php } ?>

                        <?php } ?>
                    <?php endif ?>
                    <?php if (count($result_list) == 0) : ?>
                        <li class="pull-left"><i class="fa fa-warning"></i> <?php echo 'Nincs_találat'; ?></li> 
                        <?php endif ?>
                </ul>                        
                        
                        
                        
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


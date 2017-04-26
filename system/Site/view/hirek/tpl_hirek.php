<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Cégünkről </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Cégünkről</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<main class="main-content" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                    <div class="heading-wrap">
                        <h2 class="heading"><span>Hírek</span></h2>
                    </div>
                </header>
                <hr>
                <?php foreach ($hirek_list as $value) { ?> 
                    <article class="post media-image   format-image animated" data-animation="bounceInUp">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <div class="entry-media">
                                    <div class="entry-thumbnail">
                                        <a href="<?php echo $this->request->get_uri('site_url') . 'hirek/' . $value['slug'] . '/' . $value['id']; ?>" >
                                            <img class="img-responsive" src="<?php echo $this->getConfig('blogphoto.upload_path') . $value['picture']; ?>" alt="<?php echo $value['title']; ?>"/>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="entry-main">

                                    <div class="entry-meta clearfix">
                                        <ul class="unstyled clearfix">
                                            <li>Kategória: <a href="<?php echo $this->request->get_uri('site_url') . 'hirek/kategoria/' . $value['category_id']; ?>"><?php echo $value['category_name']; ?></a></li>
                                            <li>/</li>
                                            <li> <i class="fa fa-calendar"></i> <?php echo $value['add_date']; ?></li>
                                        </ul>
                                    </div>
                                    <h3 class="entry-title"> 
                                        <a href="<?php echo $this->request->get_uri('site_url') . 'hirek/' . $value['slug'] . '/' . $value['id']; ?>" ><?php echo $value['title']; ?>
                                        </a> 
                                    </h3>
                                    <div class="entry-content">
                                        <p><?php echo $this->str_helper->sentenceTrim($value['body'], 3); ?></p>
                                        <div class="entry-footer"> 
                                            <a href="<?php echo $this->request->get_uri('site_url') . 'hirek/' . $value['slug'] . '/' . $value['id']; ?>" class="btn btn-sm btn-primary">Tovább <i class="fa fa-angle-double-right"></i></a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </article>
                <?php } ?>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="text-center">
                        <?php echo $pagine_links; ?>
                    </div>            
                </div> 

            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <?php include($this->path('tpl_sidebar')); ?> 
            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>





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
                    <li><a href="hírek">Hírek</a></li>
                    <li class="active">Kategóriák</li>
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
                        <h2 class="heading"><span>Hírek - <?php echo $category_name; ?> kategória</span></h2>
                    </div>
                </header>
                <hr>
                <?php if (!empty($blog_list)): ?>
                    <?php foreach ($blog_list as $value) { ?> 
                        <article class="post media-image   format-image animated" data-animation="bounceInUp">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 ">
                                    <div class="entry-media">
                                        <div class="entry-thumbnail"><a href="<?php echo $this->registry->site_url . 'hirek/' . $value['blog_slug'] . '/' . $value['blog_id']; ?>" ><img src="<?php echo $value['blog_picture']; ?>" alt="<?php echo $value['blog_title']; ?>"/></a> </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8">
                                    <div class="entry-main">

                                        <div class="entry-meta clearfix">
                                            <ul class="unstyled clearfix">
                                                <li>Kategória: <a href="<?php echo $this->registry->site_url . 'hirek/kategoria/' . $value['blog_category']; ?>"><?php echo $value['category_name']; ?></a></li>
                                                <li>/</li>
                                                <li> <i class="fa fa-calendar"></i> <?php echo $value['blog_add_date']; ?></li>
                                            </ul>
                                        </div>
                                        <h3 class="entry-title"> 
                                            <a href="<?php echo $this->registry->site_url . 'hirek/' . $value['blog_slug'] . '/' . $value['blog_id']; ?>" ><?php echo $value['blog_title']; ?>
                                            </a> 
                                        </h3>
                                        <div class="entry-content">
                                            <p><?php echo Util::sentence_trim($value['blog_body'], 3); ?></p>
                                            <div class="entry-footer"> 
                                                <a href="<?php echo $this->registry->site_url . 'hirek/' . $value['blog_slug'] . '/' . $value['blog_id']; ?>" class="btn btn-sm btn-primary">Tovább <i class="fa fa-angle-double-right"></i>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </article>
                    <?php } ?>
                <?php endif ?>
                <?php if (empty($content)): ?>
                    <div class="alert alert-info"><p><i class="fa fa-exclamation-triangle"></i> Nincs megjeleníthető bejegyzés!</p></div>
                <?php endif ?>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="text-center">
                        <?php echo $pagine_links; ?>
                    </div>            
                </div> 

            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <?php include('system/site/view/_template/tpl_sidebar.php'); ?> 
            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>


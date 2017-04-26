<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Hírek </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li><a href="hirek">Hírek</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>


<main class="main-content" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                
                    <article class="post media-image   format-image animated" data-animation="bounceInUp">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 ">
                                <div class="entry-media">
                                    <div class="entry-thumbnail">
                                        <a href="<?php echo $this->request->get_uri('site_url') . 'hirek/' . $blog['slug'] . '/' . $blog['id']; ?>" >
                                            <img src="<?php echo $this->getConfig('blogphoto.upload_path') . $blog['picture']; ?>" alt="<?php echo $blog['title']; ?>"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="entry-main">

                                    <div class="entry-meta clearfix">
                                        <ul class="unstyled clearfix">
                                            <li>Kategória: <a href="<?php echo $this->request->get_uri('site_url') . 'hirek/kategoria/' . $blog['category_id']; ?>"><?php echo $blog['category_name']; ?></a></li>
                                            <li>/</li>
                                            <li> <i class="fa fa-calendar"></i> <?php echo $blog['add_date']; ?></li>
                                        </ul>
                                    </div>
                                    <h3 class="entry-title"> 
                                        <a href="<?php echo $this->request->get_uri('site_url') . 'hirek/' . $blog['slug'] . '/' . $blog['id']; ?>" ><?php echo $blog['title']; ?>
                                        </a> 
                                    </h3>
                                    <div class="entry-content">
                                        <p><?php echo $blog['body']; ?></p>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </article>
      

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





<?php 
use System\Libs\Config;
?>
<section class="no-bg-color-parallax parallax-black theme-section">
  <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS;?>media/paralax/paralax1.png)" ></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h1 class="text-uppercase paralax-header">Termékek</h1>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb">
          <li><a href="/">Kezdőlap</a></li>
          <li class="active">Termékek</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<main class="section main-content" >
    <div class="container">
        <div class="row">
            <?php include($this->path('tpl_sidebar_termekek')); ?> 
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <section class="main-content" role="main">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="pull-left">
                                <p class="category-path"><?php echo $product_category_path; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="catalog-grid">
                        <?php echo $products_area; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
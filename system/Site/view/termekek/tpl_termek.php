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
          <li><a href="termekek">Termékek</a></li>
          <li class="active">Termék</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<main class="main-content" >
    <div class="container">
        <div class="row">
            <?php include($this->path('tpl_sidebar_termekek')); ?> 
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <section role="main" class="mt-40">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-right animated" data-animation="bounceInUp">
                                <p class="category-path"><?php echo $product_category_path; ?> <?php echo $product['product_title']; ?></p>
                                <h3 class="product-name"><?php echo $product['product_title']; ?></h3>
                                <div class="product-rating-box product-desc">
                                    <?php echo $product['product_description']; ?>
                                </div>
                                <div class="product-info-top">
                                    <div class="price-box"> 
                                        <span class="price-regular-single"><i class="fa fa-tag"></i> <?php echo $product['product_price']; ?> Ft</span> 
                                    </div>
                                </div>
                                <div class="product-button-group">
                                    <form id="add_to_cart_form" action="kosar/additem" method="POST">
                                    <div class="btn-group cart">
                                        <button id="add_to_cart_button" type="submit" class="btn btn-primary"> Hozzáadás a kosárhoz  </button>
                                    </div>
                                    <div class="qty">
                                        <input type="text" name="quantity" class="txtbox" placeholder="1" >
                                    </div>
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>">
                                    </form>
                                </div>
                                <div class="meta-list">
                                    <span><i class="fa fa-list"></i> Kategória:</span>
                                    <a href="termekek/kategoria/<?php echo $this->str_helper->stringToSlug($product['product_category_name']) . '/' . $product['product_category_id']; ?>"><?php echo $product['product_category_name']; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-image-left animated" data-animation="bounceInUp">
                                <div class="clearfix" id="image-block">
                                    <div>
                                        <ul class="slides">
                                            <li> <a class="magnific" href="<?php echo Config::get('productphoto.upload_path') . $product['product_photo']; ?>"> <img src="<?php echo Config::get('productphoto.upload_path') . $product['product_photo']; ?>" alt="<?php echo $product['product_title']; ?>"/></a> </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12  col-sm-12 product-info animated" data-animation="bounceInUp">
                            <div id="tab-info-anchore"></div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab1" role="tab" data-toggle="tab"> Leírás </a></li>
                                <li role="presentation"><a href="#tab2" role="tab" data-toggle="tab"> Használat  </a></li>
                                <li role="presentation"><a href="#tab3" role="tab" data-toggle="tab"> Fizikai jellemzők  </a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab1">
                                    <p> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab2">
                                    <p> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab3">

                                    <p>  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
</main>


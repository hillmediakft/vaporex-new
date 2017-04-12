<?php 
use System\Libs\Config;
?>
<!-- *****************SLIDER ****** -->
<div id="iview">
    <?php foreach ($slider as $value) : ?>
        <div data-iview:thumbnail="<?php echo $this->url_helper->thumbPath(Config::get('slider.upload_path') . $value['picture']); ?>" data-iview:image="<?php echo Config::get('slider.upload_path') . $value['picture']; ?>" data-iview:transition="block-drop-random" >
            <div class="container">
                <div class="iview-caption  bg-no-caption" data-x="70" data-y="50" data-transition="expandLeft">
                    <div class="custom-caption">
                        <h3><?php echo $value['title']; ?></h3>
                        <h5><?php echo $value['text']; ?></h5>
                        <div class="text-right"> <a href="<?php echo $value['target_url']; ?>"  class="btn btn-primary btn-lg">Részletek </a> </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<section class="home-section  animated " data-animation="fadeInUp">
    <div class="container">
        <div class="row">
            <ul class="bxslider" 
                data-max-slides="1" 
                data-width-slides="1170" 
                data-margin-slides="0" 
                data-auto-slides="false" 
                data-move-slides="1"   
                data-infinite-slides="true" >
                <li>
                    <div class="pp-box-wrap">
                        <div class="pp-box-item">
                            <div class="pp-box pp-image">
                                <div class="media"> <img src="<?php echo SITE_IMAGE; ?>home1.jpg" width="290" height="250" alt="alt"/> </div>
                            </div>
                            <div class="pp-box ">
                                <div class="pp-content bottom">
                                    <div class="arrow"></div>
                                    <h5>Miért pont vaporex?</h5>
                                    <p>Az elmúlt évek tapasztalatai bizonyítják, hogy a technológia gazdaságos és tartós megoldást kínál…</p>
                                </div>
                            </div>
                        </div>
                        <div class="pp-box-item">
                            <div class="pp-box ">
                                <div class="pp-content top">
                                    <div class="arrow"></div>
                                    <h5>Hol jutok hozzá?</h5>
                                    <p>Az ország nagy részén találhatóak értékesítési pontok, ahol hozzájuthat eredeti VAPOREX adalékszerekhez. Az Önhöz legközelebbi beszerzési forrásról...</p>
                                </div>
                            </div>
                            <div class="pp-box pp-image">
                                <div class="media"> <img src="<?php echo SITE_IMAGE; ?>home3.jpg" width="290" height="250" alt="alt"/> </div>
                            </div>
                        </div>
                    </div>
                    <div class="pp-box-wrap">
                        <div class="pp-box-item">
                            <div class="pp-box pp-image">
                                <div class="media"> <img src="<?php echo SITE_IMAGE; ?>home2.jpg" width="290" height="250" alt="alt"/> </div>
                            </div>
                            <div class="pp-box">
                                <div class="pp-content bottom">
                                    <div class="arrow"></div>
                                    <h5>Mennyibe kerül?</h5>
                                    <p>Ide kattintva betekintés kaphat, mennyire is gazdaságos a Vaporex-technológia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="pp-box-item">
                            <div class="pp-box">
                                <div class="pp-content top">
                                    <div class="arrow"></div>
                                    <h5>Hogyan müködik?</h5>
                                    <p>Pár sorban összefoglaljuk a VAPOREX-technológia hatásmechanizmusát termékenként.</p>
                                    <a class="btn btn-primary " href="#">Tovább</a>
                                </div>
                            </div>
                            <div class="pp-box pp-image">
                                <div class="media"> <img src="<?php echo SITE_IMAGE; ?>home4.jpg" width="290" height="250" alt="alt"/> </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<div class="banner-full-width" id="banner01">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <p>Látogassa meg kalkulátor oldalunkat!</p>
            </div>
            <div class="col-lg-4 col-md-4 text-right">
                <div class="btn-fw-banner"><a href="kalkulator" class="btn btn-primary btn-lg ">Tovább</a></div>
            </div>
        </div>
    </div>
</div>

<section class="theme-section">
    <div class="row">
        <div class="col-md-offset-1 col-md-6">
            <header class="section-header">
                <div class="icon-line"> <i class="fa flaticon-multiple25 "></i></div>
                <div class="heading-wrap">
                    <h2 class="heading"><span>Termékeink</span></h2>
                </div>
            </header>
        </div>
    </div>

    <section class="carousel ">
        <ul class="product-grid carousel-6 bxslider" 
            data-max-slides="4" 
            data-width-slides="270" 
            data-margin-slides="10" 
            data-auto-slides="false" 
            data-move-slides="1"   
            data-infinite-slides="false" >
                <?php $i = 0;
                foreach ($termekek as $value) {
                    if ($i <= 6) { ?>   
                    <li >
                        <div class="product-container">
                            <div class="product-image"> 
                                <a href="termekek/<?php echo $this->str_helper->stringToSlug($value['product_title']) . '/' . $value['product_id'];?>"> 
                                    <img class="" src="<?php echo $this->url_helper->thumbPath(Config::get('productphoto.upload_path') . $value['product_photo']); ?>"  alt="img"/>
                                </a> 
                            </div>
                            <div class="product-bottom"> 
                                <a class="product-name"  href="termekek/<?php echo $this->str_helper->stringToSlug($value['product_title']) . '/' . $value['product_id'];?>">
                                <?php echo $value['product_title']; ?>
                                </a>
                                <?php echo $value['product_description']; ?>
                                <div class="price-box"> <span class="price-regular"><?php echo $value['product_price']; ?> Ft</span> </div>
                                <div class="btn-group"> <a href="termekek/<?php echo $this->str_helper->stringToSlug($value['product_title']) . '/' . $value['product_id'];?>" class="btn btn-primary ">Részletek </a> </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                $i = $i + 1;
            }
            ?>
        </ul>

    </section>
</section>
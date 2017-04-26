<aside class="sidebar animated " data-animation="fadeInLeft" > 

    <!-- ARCHIVE WIDGET -->

    <div class="widget widget-category cms-category-list">
        <div class="block_content">
            <ul class="category-list unstyled clearfix">
                <li><a href="cegunkrol"><i class="fa fa-long-arrow-right"></i>Cégünkről</a></li>
                <li><a href="termekek"><i class="fa fa-long-arrow-right"></i>Termékek</a></li>
                <li><a href="referenciak"><i class="fa fa-long-arrow-right"></i>Referenciák</a></li>
                <li><a href="kalkulator"><i class="fa fa-long-arrow-right"></i>Kalkulátor</a></li>
                <li><a href="letoltesek"><i class="fa fa-long-arrow-right"></i>Letöltések</a></li>
                <li class="li-last"><a href="gyakori-kerdesek"><i class="fa fa-long-arrow-right"></i>Gyakori kérdések</a></li>
            </ul>
        </div>
    </div>
    
    <div class="widget widget-img-link">
        <div class="block_content">
            <img src="<?php echo SITE_IMAGE;?>miert-vaporex.jpg">
            <h4>Miért pont Vaporex?</h4>
            <p>Az elmúlt évek tapasztalatai bizonyítják, hogy a technológia gazdaságos és tartós megoldást kínál…</p>
            <a class="btn btn-sm btn-primary" href="cegunkrol/miert-pont-vaporex">Tovább <i class="fa fa-arrow-right"></i></a>
        </div>
    </div> 
    
    <div class="widget widget-img-link">
        <div class="block_content">
            <img src="<?php echo SITE_IMAGE;?>mennyibe-kerul.jpg">
            <h4>Mennyibe kerül??</h4>
            <p>Ide kattintva betekintés kaphat, mennyire is gazdaságos a Vaporex-technológia.</p>
            <a class="btn btn-sm btn-primary" href="cegunkrol/mennyibe-kerul">Tovább <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>     

    <div class="widget widget-products">
        <h3 class="widget-title"><span>Legújabb termékeink</span></h3>
        <div class="block_content">
            <ul class="product-mini-list  unstyled ">
                <?php foreach ($new_products as $value) : ?>
                    <li>
                        <div class="entry-thumbnail"> <a href="termekek/<?php echo $value['product_id']; ?>" class="img"> <img src="<?php echo $this->getConfig('productphoto.upload_path') . $value['product_photo']; ?>"  alt="img"/></a> </div>
                        <div class="entry-main">
                            <div class="entry-header">
                                <h5 class="entry-title"><a href="termekek/<?php echo $value['product_id']; ?>"><?php echo $value['product_title']; ?></a></h5>
                            </div>
                            <div class="entry-meta">
                                <div class="price-box"> <span class="price-regular"><?php echo $value['product_price']; ?> Ft</span> </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>

            </ul>
        </div>
    </div>

</aside>


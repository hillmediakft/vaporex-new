<?php use System\Libs\Config; ?>
<div class="col-xs-12 col-sm-12 col-md-3">             
    <aside class="sidebar animated" data-animation="fadeInLeft" > 
        <div class="widget widget-category">
            <nav class="sidebar-nav">
                <ul class="metismenu" id="menu">
                    <li class="">
                        <a href="javascript:void(0)">
                            <span class="sidebar-nav-item-icon fa fa-search-plus fa-lg"></span>
                            <span class="sidebar-nav-item">Termékek</span>
                        </a>
                    </li>
                    <?php echo $category_menu; ?>   
                </ul>
            </nav>
        </div>

        <div class="widget widget-products">
            <h3 class="widget-title"><span>Legújabb termékeink</span></h3>
            <div class="block_content">
                <ul class="product-mini-list  unstyled ">
                    <?php foreach($new_products as $value) : ?>
                    <li>
                        <div class="entry-thumbnail"> <a href="termekek/<?php echo $value['product_id'];?>" class="img"> <img src="<?php echo Config::get('productphoto.upload_path') . $value['product_photo'];?>"  alt="img"/></a> </div>
                        <div class="entry-main">
                            <div class="entry-header">
                                <h5 class="entry-title"><a href="termekek/<?php echo $value['product_id'];?>"><?php echo $value['product_title'];?></a></h5>
                            </div>
                            <div class="entry-meta">
                                <div class="price-box"> <span class="price-regular"><?php echo $value['product_price'];?> Ft</span> </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach?>

                </ul>
            </div>
        </div>
    </aside>
</div>
<!-- //////////////////////////////////
//////////////PAGE CONTENT///////////// 
////////////////////////////////////-->

<div class="page-content">

    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <div class="row">

                    <div class="col-md-12">
                        <div class="product-info box">
                            <!-- SOCIAL SHARE -->
                            <div class="well well-sm">
                                <div class="social-share">
                                    <div class="fb-like" data-href="<?php echo $this->registry->current_url; ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
                                    <div class="g-plus" data-action="share" data-annotation="none" data-height="22" data-href="<?php echo $this->registry->current_url; ?>"></div>
                                </div>
                            </div>  
                            <!-- SOCIAL SHARE VÉGE-->
                            <?php echo $content; ?>
                            <div class="gap gap-top"></div>

                            <ul class="mix-filter">

                                <li class="filter" data-filter="all">
                                    Összes
                                </li>
                                <?php foreach ($category_list as $value) { ?>
                                    <li class="filter" data-filter="category_<?php echo $value['id']; ?>">
                                        <?php echo $value['category_name']; ?>
                                    </li>

                                <?php } ?>
                            </ul>

                            <div class="row" id="popup-gallery">
                                <div class="mix-grid">

                                    <?php foreach ($photo_gallery as $value) { ?>		
                                        <div class="col-sm-4 mix category_<?php echo $value['photo_category']; ?>">
                                            <a class="hover-img popup-gallery-image" href="<?php echo $value['photo_filename']; ?>" data-effect="mfp-zoom-out">
                                                <img src="<?php echo Util::thumb_path($value['photo_filename']); ?>" alt="<?php echo $value['photo_caption']; ?>" title="<?php echo $value['photo_caption']; ?>" /><i class="fa fa-resize-full hover-icon"></i>


                                                <p class='hover-title'><?php echo $value['photo_caption']; ?></p>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>                            





                        </div>

                    </div>
                </div>

                <div class="gap gap-big"></div>

            </div>

            <?php include "system/site/view/_template/tpl_sidebar.php"; ?>

        </div>
    </div>
</div>

<!-- //////////////////////////////////
//////////////END PAGE CONTENT///////// 
////////////////////////////////////-->

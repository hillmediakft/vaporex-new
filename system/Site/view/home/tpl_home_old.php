<!-- //////////////////////////////////
     //////////////PAGE CONTENT///////////// 
     ////////////////////////////////////-->

<div class="page-content">

    <div class="container">




        <div class="row">

            <div class="col-md-4">

                <h1>MEGA Játszóház </h1>
                <p class="text-bigger">A MEGA Játszóház egy gyermekeknek szóló utazó program, melynek lényege, hogy városról városra járva sportcsarnokok teljes területét játékokkal töltjük meg. Az eszközöket, melyek elsősorban felfújható játékok, a belépő megfizetése után szabadon lehet használni. A program helyszínenként eltérhet, de mindig törekszünk rá, hogy nyújtsunk produkciót is a gyerekeknek, pl.: bohóc műsort vagy animációt.</p>

            </div>
            <div class="col-md-4">
                <iframe width="240" height="170" frameborder="0" title="JoomlaWorks AllVideos Player" allowfullscreen="" src="http://www.youtube.com/embed/GrHp68UB3qo"></iframe>
            </div>

            <div class="col-md-4">
                <div class="box">
                    <h1>Fizetés szép kártyával</h1>
                    <p>Nulla hendrerit sociis ante pretium ad placerat justo felis enim dignissim condimentum nisl ullamcorper fermentum. ad placerat justo felis enim dignissim condimentum nisl ullamcorper fermentum.</p>
                    <a class="btn btn-ghost" href="#">További info</a>
                </div>
            </div>


        </div>            
        <div class="gap"></div>

        <div class="box">
            <div class="row row-wrap">
                <div class="col-md-4">
                    <div class="sale-point"><i class="fa fa-smile-o sale-point-icon"></i>
                        <h5 class="sale-point-title">Több mint 12 játék</h5>
                        <p class="sale-point-description">Duis class iaculis massa vitae ad ipsum luctus ut praesent imperdiet etiam vel dapibus tristique</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sale-point"><i class="fa fa-video-camera sale-point-icon"></i>
                        <h5 class="sale-point-title">3D mozi</h5>
                        <p class="sale-point-description">Nulla hendrerit sociis ante pretium ad placerat justo felis enim dignissim condimentum nisl ullamcorper fermentum</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sale-point"><i class="fa fa-money sale-point-icon"></i>
                        <h5 class="sale-point-title">Kedvező árú belépők</h5>
                        <p class="sale-point-description">Posuere felis habitant mollis faucibus penatibus inceptos senectus mauris himenaeos interdum nunc ipsum parturient duis</p>
                    </div>
                </div>
            </div>  
        </div>
        <div class="gap"></div>
        <?php if (!empty($jatszohazak)) { ?> 
            <div class="row row-wrap">
                <div class="col-md-12">
                    <h1>Következő 3 Megajátszóház <a class="btn btn-ghost" href="jatszohazak">Összes megtekintése</a></h1>
                </div>

                <?php
                $i = 0;
                foreach ($jatszohazak as $value) {
                    if ($i <= 2) {
                        ?>    
                        <div class="col-md-4">
                            <div class="product-banner">
                                <img src="<?php echo Config::get('rendezvenyphoto.upload_path') . $value['rendezveny_photo']; ?>" alt="játszóház <?php echo $value['city_name']; ?>" title="játszóház <?php echo $value['city_name']; ?>" />
                                <div class="product-banner-inner">
                                    <h3><?php echo $value['city_name']; ?></h3>
                                    <h5><?php echo $value['rendezveny_location']; ?></h5>
                                    <h5><?php echo Util::hun_month(strftime("%B %d, %Y", $value['rendezveny_start_timestamp'])); ?></h5>
                                    <a class="btn btn-white btn-ghost" href="jatszohazak/<?php echo Util::string_to_slug($value['city_name'] . '-' . strftime("%Y-%m-%d", $value['rendezveny_start_timestamp'])); ?>/<?php echo $value['rendezveny_id']; ?>">Részletek</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    $i = $i + 1;
                }
                ?>

            </div>
<?php } ?>

        <div class="gap gap-small"></div>

        <div class="row">
            <div class="col-md-6">
                <h1>Vendégeink mondták</h1>
<?php foreach ($testimonials as $value) { ?>
                    <div class="testimonial testimonial-color">
                        <div class="testimonial-inner">
                            <blockquote>
                                <p><?php echo $value['text']; ?></p>
                            </blockquote>
                        </div>
                        <div class="testimonial-author">
                            <img title="Rólunk mondták" alt="Rólunk mondta <?php echo $value['name']; ?>" src="<?php echo SITE_IMAGE; ?>smile.png">
                            <p class="testimonial-author-name"><?php echo $value['name']; ?> (<?php echo $value['title']; ?>)</p>
                        </div>
                    </div>

                    <div class="gap gap-small"></div>
<?php } ?>


            </div>
            <div class="col-md-6">
                <h1>Képgaléria </h1>
                <div id="my-carousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php $flag = 1; ?>
                        <?php foreach ($photos as $value) { ?>
                            <div class="<?php echo($flag == 1) ? 'active' : ''; ?> item">
                                <img src="<?php echo $value['photo_filename']; ?>" alt="<?php echo $value['photo_caption']; ?>" title="<?php echo $value['photo_caption']; ?>" />
                            </div>
    <?php $flag = $flag + 1; ?>
<?php } ?>

                    </div>
                    <a class="carousel-control left" href="#my-carousel" data-slide="prev"></a>
                    <a class="carousel-control right" href="#my-carousel" data-slide="next"></a>
                </div>

            </div>

        </div>


        <div class="gap"></div>
    </div>
</div> <!-- end of page-content -->


<!-- //////////////////////////////////
//////////////END PAGE CONTENT///////// 
////////////////////////////////////-->
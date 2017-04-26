<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?><?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Refrenciák </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">referenciák</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<main class="main-content" >
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <div class="row">
                    <div class="col-md-12">
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <h2 class="heading"><span>Tekintse meg referenciáinkat!</span></h2>
                            </div>
                        </header>
                        <?php echo $content; ?> 

                        <hr class="separator_10" >


                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-left filter " >
                                    <ul id="filter" class="clearfix">
                                        <li class="title-action"><a href="" class="current btn" data-filter="*">Összes</a></li>
                                        <?php foreach ($category_list as $value) { ?>
                                            <li><a href="" class="btn" data-filter=".<?php echo $value['project_category_id']; ?>"><?php echo $value['project_category_name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="isotope-frame isotope-skin2  animated" data-animation="bounceInUp">
                                <div class="isotope-filter">
                                    <?php foreach ($referenciak as $value) { ?>
                                        <div class="isotope-item  <?php echo $value['project_category_id']; ?>"> <img src="<?php echo $this->getConfig('projectphoto.upload_path') . $value['project_photo']; ?>" width="400" height="350" alt="img">
                                            <div class="slide-desc">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <h4><?php echo $value['project_title']; ?></h4>
                                                            <div class="isotope-desc-content">
                                                                <p>Levir meus, priusquam oppugnarent tempus quis, admonere dicitur. Credo quod idem mihi praesidium. </p>
                                                            </div>
                                                            <a class="btn btn-primary btn-lg " href="referenciak/<?php echo $this->str_helper->stringToSlug($value['project_title'] . '/' . $value['project_id']); ?>">Részletek</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>


                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <hr>


            </div>
            <div class="col-xs-12 col-sm-12 col-md-3"    >
                <?php include($this->path('tpl_sidebar')); ?> 
            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>



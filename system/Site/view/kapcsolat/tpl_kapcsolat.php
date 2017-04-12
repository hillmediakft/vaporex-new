<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Kapcsolat </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Kapcsolat</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<main class="main-content" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                    <div class="heading-wrap">
                        <h2 class="heading"><span>Kapcsolat felvétel és partnerek</span></h2>
                    </div>
                </header>        
                <?php echo $content; ?>
                <div class="row">
                    <div class="col-md-4">
                        <div  data-animation="fadeInLeft" class="animated">

                            <div class="person-info">
                                <div class="person-avatar"> <img class="img-thumbnail" src="<?php echo SITE_IMAGE; ?>nevai-maria.jpg" alt="Névai Mária"> </div>
                                <div class="person-name">
                                    <h5>Névai Mária</h5>
                                    <p>okleveles vegyészmérnök</p>
                                    <p>Telefon: 06-20-934-8233, 06-30-986-2495<br>
                                        (hívható minden nap kb. 8-20-ig);<br>
                                        Tel/fax.: 06-1-367-4615</p>
                                </div>
                            </div>                           

                            <div class="person-info">
                                <div class="person-avatar"> <img class="img-thumbnail" src="<?php echo SITE_IMAGE; ?>barabas-botond.jpg" alt="Barabas Botond"> </div>
                                <div class="person-name">
                                    <h5>Barabás Botond </h5>
                                    <p>06-20-255-6835, 06-30-986-2473<br>
                                        <?php echo $this->url_helper->safe_mailto('megrendeles@vaporex.hu'); ?></p>
                                </div>
                            </div>  



                        </div>
                    </div>
                    <div class="col-md-3">
                        <div  data-animation="fadeInLeft" class="animated">

                            <div class="table-contact">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><i class="fa fa-map-marker"></i></td>
                                            <td>Levelezési cím:<br> <?php echo $settings['cim']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-phone"></i></td>
                                            <td><?php echo $settings['tel']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-envelope"></i></td>
                                            <td><?php echo $this->url_helper->safe_mailto($settings['email']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                           
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div data-animation="fadeInRight" class="full-width-right animated ">
                            <form id="contactform" class="contactForm2" data-animation="bounceInUp" ction="<?php echo $this->request->get_uri('site_url'); ?>kapcsolat">
                                <h4>Küldjön üzenetet</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mezes_bodon">
                                            <input type="text" name="mezes_bodon">
                                        </div> 
                                        <div class="form-group">
                                            <input type="text" required id="name" name="name" placeholder="Név *" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" required id="email" name="email" placeholder="E-mail *" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" required id="phone" name="phone"  placeholder="Telefonszám *" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea required id="message" name="message" placeholder="Üzenet *" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary ">Küldés </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                <h4>Partnereink</h4>
                
                <div class="table-contact">
                    <table>
                        <tbody>
                            <tr>
                                <td><i class="fa fa-arrow-right"></i></td>
                                <td><a href="http://kohazy.hu/?id=elerhetosegeink&amp;nyelv=hun" target="_blank">Kőházy festékdiszkontok és webáruház</a></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-arrow-right"></i></td>
                                <td><a href="http://raabkarcher.hu/kereskedeseink" target="_blank">STAVMAT / Raab Karcher tüzépek</a></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-arrow-right"></i></td>
                                <td><a href="http://www.trendsys.hu" target="_blank">Trendsys – munkavédelem<br>
                                    </a></td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
                    </div>
                <div class="col-md-8">
                    <div id="map"> </div>
                </div>
                </div>


            </div>
        </div>
    </div>
</main>



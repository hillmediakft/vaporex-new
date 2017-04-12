<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Felhasználói adatok </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Felhasználói adatok</li>
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
                        <div id="feedback_message">
                            <?php $this->renderFeedbackMessages(); ?>
                        </div>
                    </div>
                </div>                

                <!-- ÜZENETEK -->	
                <div class="row">
                    <div class="col-md-12">
                        <div id="validator_error">
                            <?php $this->renderFeedbackMessages(); ?>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-12">
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <h2 class="heading"><span>Felhasználó adatok módosítása</span></h2>
                            </div>
                        </header>
                        <p>Amennyiben módosítani szeretné felhasználói adatait, módosítsa a kívánt adatot/adatokat, majd kattintson az adatok mentése gombra! Jelszót csak akkor írjon be, ha módosítani kívánja a jelszót!</p>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="profil/ajax" method="POST" id="edit_user_form" name="edit_user_form">	
                            <div class="row">
                                <div class="col-md-12">
                                    <h3><strong>1.</strong> <span>Bejelentkezési adatok</span></h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name" class="control-label">Felhasználó név <span class="form-required">*</span></label>
                                        <input type="text" name="user_name" value="<?php echo $profile_data['user_name']; ?>" class="form-control input-xlarge"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_email" class="control-label">E-mail cím <span class="form-required">*</span></label>
                                        <input type="text" name="user_email" value="<?php echo $profile_data['user_email']; ?>" class="form-control input-xlarge"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_passsword" class="control-label">Jelszó <span class="form-required">*</span></label>
                                        <input type="text" name="user_password" value="" class="form-control input-xlarge"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_password_again" class="control-label">Jelszó újra <span class="form-required">*</span></label>
                                        <input type="text" name="user_password_again" value="" class="form-control input-xlarge"/>
                                    </div>
                                </div> <!-- személyes adatok end -->




                                <!-- Ezt majd css-ben kell eltüntetni!! -->
                                <!-- <input type="hidden"  name="security_name" />-->
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <h3><strong>1.</strong> <span>Szállítási/számlázási adatok</span></h3>
                                    <div class="form-group">
                                        <label for="name_or_company" class="control-label">Teljes név / cégnév </label>
                                        <input type="text" name="name_or_company" value="<?php echo $profile_data['name_or_company']; ?>" class="form-control input-xlarge"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery_address" class="control-label">Szállítási cím</label>
                                        <input type="text" name="delivery_address" value="<?php echo $profile_data['delivery_address']; ?>" class="form-control input-xlarge"/>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="invoice_address" class="control-label">Számlázási cím  <a id="copy_address"><i class="fa fa-copy" ></i> szállítási cím másolása</a></label>
                                        <input type="text" name="invoice_address" value="<?php echo $profile_data['invoice_address']; ?>" class="form-control input-xlarge"/>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button name="edit_user_submit" value="submitted" class="btn btn-primary" id="edit_user_submit">Adatok módosítása</button>
                                </div>   
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3"    >
                <?php include('system/site/view/_template/tpl_sidebar.php'); ?> 
            </div>
        </div>
    </div>
</main>


<div class="pre-footer-wrap">
    <div class="pre-footer">
        <div class="container">
            <div class="row"> <span class="btn-location-open"> Rendelési információk <i class="icon-arrow-down"></i></span> </div>
        </div>
    </div>
</div>
<footer class="footer footer-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="fot-box">
                    <h3 class="fot-logo"><img src="img/logo2.jpg"  alt="logo"></h3>
                    <p>A rutinos profik nagy része tudja, hogy az eredeti VAPOREX az igazi megoldás. </p>
                </div>
                <div class="row">
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <div class="social-box">
                            <ul class="social-links">
                                <?php if (!empty($settings['facebook_link'])) { ?>
                                    <li><a target="_blank" href="<?php echo $settings['facebook_link']; ?>"><i class="icomoon-facebook"></i></a></li>
                                <?php } ?>
                                <?php if (!empty($settings['googleplus_link'])) { ?>
                                    <li><a target="_blank" href="https://www.google.com/"><i class="icomoon-googleplus"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="fot-box">
                    <h3 class="fot-title">Menü</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <ul class="menu-list">
                                <li> <a href="/"> Kezdőlap</a></li>
                                <li> <a href="cegunkrol"> Cégünkről</a></li>
                                <li> <a href="termekek"> Termékek</a></li>
                                <li> <a href="kalkulator"> Kalkulátor</a></li>
                                <li> <a href="hirek"> Aktuális</a></li>

                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <ul class="menu-list">
                                <li> <a href="gyakori-kerdesek"> GYIK</a></li>
                                <li> <a href="letoltesek"> Letöltések</a></li>
                                <li> <a href="referenciak"> Refrenciák</a></li>
                                <li> <a href="#"> Kapcsolat</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="fot-box">
                    <h3 class="fot-title">Kapcsolat</h3>
                    <div class="fot-contact">
                        <div class="media-body">
                            <table>
                                <tr>
                                    <td><i class="fa fa-map-marker"></i></td>
                                    <td><?php echo $settings['ceg']; ?><br> <?php echo $settings['cim']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-mobile-phone"></i></td>
                                    <td><?php echo $settings['tel']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-envelope"></i></td>
                                    <td><?php echo Util::safe_mailto($settings['email']); ?><br><?php echo Util::safe_mailto('megrendeles@vaporex.hu');?></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-comment"></i></td>
                                    <td>Szaktanácsadás: 06-20-934-8233, 06-30-986-2495</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-male"></i></td>
                                    <td>Értékesítés: 06-20-934-8233, 06-30-986-2495</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-phone"></i></td>
                                    <td>Tel./fax: 06-1-367-4615</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="fot-box">
                    <h3 class="fot-title">Értékesítési pontok</h3>

                    <div class="fot-contact">
                        <div class="media-body">
                            <p><strong>Információkérés az országos értékesítési pontokról</strong>:<br>
                                06-20-255-6835, 06-30-986-2473, megrendeles(a)vaporex.hu<br>
                                <strong>Országos kiemelt forgalmazó:</strong><br>
                                <a href="http://raabkarcher.hu/kereskedeseink" target="_blank">RAAB KARCHER tüzépek
                                </a><br>
                                Budapesti kiemelt forgalmazó:<br>
                                <a href="http://kohazy.hu/?id=elerhetosegeink&amp;nyelv=hun" target="_blank">
                                    Kőházy Festékáruház</a><br>

                                Bp. III., Vörösvári út 125. Tel: 367-3414<br>
                                Bp. XIII., Véső u. 5. Tel: 350-7759</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-absolute">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="copy aligncenter">
                    <p>© Copyright <?php echo date("Y"); ?> | <?php echo $settings['ceg']; ?> | <a href="http://www.onlinemarketingguru.hu/weboldal-keszites.html" target="_blank">Weboldal készítés</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<a class="scroll-top"> <i class="fa fa-angle-up"> </i></a>


<script type="text/javascript" src="<?php echo SITE_JS; ?>jquery-1.11.1.min.js"></script>
<script src= "<?php echo SITE_JS; ?>jquery-migrate-1.2.1.js" ></script>
<script src="<?php echo SITE_JS; ?>jquery-ui.min.js"></script>
<script src="<?php echo SITE_JS; ?>bootstrap-3.1.1.min.js"></script>
<script src="<?php echo SITE_JS; ?>modernizr.custom.js"></script>

<!-- SCRIPTS --> 
<script type="text/javascript" src="<?php echo SITE_ASSETS; ?>plugins/isotope/jquery.isotope.min.js"></script> 
<script src="<?php echo SITE_JS; ?>waypoints.min.js"></script> 
<script src="<?php echo SITE_ASSETS; ?>plugins/bxslider/jquery.bxslider.min.js"></script> 
<script src="<?php echo SITE_ASSETS; ?>plugins/magnific/jquery.magnific-popup.js"></script> 
<script src="<?php echo SITE_ASSETS; ?>plugins/prettyphoto/js/jquery.prettyPhoto.js"></script> 
<script src="<?php echo SITE_JS; ?>classie.js"></script> 
<script src="<?php echo SITE_JS; ?>dialog_handler.js"></script> 
<script type="text/javascript" src="<?php echo SITE_ASSETS; ?>plugins/jquery-validation/core.js"></script>
<script async type="text/javascript" src="<?php echo SITE_ASSETS; ?>plugins/jquery-validation/localization/messages_hu.js"></script>
<script src="<?php echo SITE_ASSETS; ?>plugins/toastr/toastr.min.js"></script> 
<!--THEME--> 
<script src="<?php echo SITE_JS; ?>cssua.min.js"></script> 
<script src="<?php echo SITE_JS; ?>custom.js"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
if (isset($this->js_link)) {
    foreach ($this->js_link as $value) {
        echo $value;
    }
}
?>

</body>
</html>
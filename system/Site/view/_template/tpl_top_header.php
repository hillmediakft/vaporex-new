<?php 
use System\Libs\Auth;
?>
<div class="navbar-header top-header">
    <div class="container">
        <div class="row">
            <div class="info-top col-md-6"> <?php echo $settings['ceg']; ?> | <i class="fa fa-phone"></i> <?php echo $settings['tel']; ?></div>
            <div class="info-top col-md-6 text-right">
                <div class="social-box">
                    <ul class="social-links">
                        <?php if (!empty($settings['facebook_link'])) { ?>
                            <li><a target="_blank" href="<?php echo $settings['facebook_link']; ?>"><i class="icomoon-facebook"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($settings['googleplus_link'])) { ?>
                            <li><a target="_blank" href="<?php echo $settings['googleplus_link']; ?>"><i class="icomoon-google"></i></a></li>
                        <?php } ?>

                        <?php if ($logged_in) { ?>
                            <li><span><a href="profil"><i class="fa fa-user"></i> <?php echo Auth::getUser('name'); ?></a>&nbsp; | </span><a href="felhasznalok/kijelentkezes"><i class="fa fa-sign-out"></i> Kijelentkezés</a></li>
                        <?php } else { ?>
                            <li><a href="javascript:void();" data-toggle="modal" data-target="#modal_register"><i class="fa fa-edit"></i>Regisztráció</a></li>
                            <li><a href="javascript:void();" data-toggle="modal" data-target="#modal_login"><i class="fa fa-sign-in"></i> Bejelentkezés</a></li>
                        <?php } ?>	
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
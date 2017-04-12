<?php if (!isset($logged_in)) { ?>
    <div class="title">
        <h2><i class="fa fa-sign-in"></i> Bejelentkezés</h2>
    </div>

    <div class="login-box pull-right">
        <div class="content">
            <a class="btn btn-primary btn-block margin-bottom-10" href="#" data-toggle="modal" data-target="#modal_login">Bejelentkezek</a>
            <p class="text-center">Lépj be és jelentkezz munkára!</p>
            <div class="login-box-inside">
                <p>Ha még nem regisztráltál oldalunkon:</p>  
                <ul>
                    <li><a class="margin-bottom-10" href="#" data-toggle="modal" data-target="#modal_register">Regisztrálj</a></li>
                    <li>Add meg az adataid</li>
                    <li>Jelentkezz munkára</li>
                </ul>
                <p><a class="margin-bottom-10" href="#" data-toggle="modal" data-target="#modal_registration_info"><i class="fa fa-info-circle"></i> Miért érdemes regisztrálni?</a></p>
            </div>
        </div>

    </div>


<?php } ?>


<div class="clearfix"></div>

<div class="title">
    <h2>Legfrissebb munkák</h2>
</div>


<div class="new-jobs-box pull-right">
    <?php
    $i = 0;
    foreach ($latest_jobs as $value) {
        ?>
        <div class="property">
            <div class="wrapper">
                <div>
                    <h4>
                        <a href="munka/<?php echo Replacer::filterName($value['job_title']); ?>/<?php echo $value['job_id']; ?>"><?php echo $value['job_title']; ?></a>
                    </h4>
                </div><!-- /.title -->
                <div class="location">
                    <?php
                    $location = $value['city_name'];
                    if (!empty($value['district_name'])) {
                        $location .=', ' . $value['district_name'] . ' kerület';
                    }
                    echo $location;
                    ?>
                </div><!-- /.location -->

            </div><!-- /.wrapper -->
        </div><!-- /.property -->
        <hr>
        <?php
        $i++;
        if ($i >= 10) {
            break;
        }
    }
    ?>
</div>
<div class="clearfix"></div>

<?php if (isset($settings['facebook_link']) && ((!empty($settings['facebook_link']) || $settings['facebook_link'] != ''))) { ?>
    <!-- FACEBOOK BOX -->
    <div class="title">
        <h5>Csatlakozz hozzánk a Facebookon</h5>
    </div>
    <div class="facebook-frame">

        <div class="fb-page" data-href="<?php echo $settings['facebook_link']; ?>" 
             data-width="270" 
             data-height="320" 
             data-small-header="false" 
             data-adapt-container-width="true" 
             data-hide-cover="false" 
             data-show-facepile="true" 
             data-show-posts="false"></div>

    </div>
<?php } ?>
<!--
<div class="title">
    <h5>Töltsd le a mobil applikációnkat</h5>
</div>
<a target="_blank" title="App" href="https://play.google.com/store/apps/details?id=Multi.Job&feature=search_result#?t=W251bGwsMSwyLDEsIk11bHRpLkpvYiJd">
    <img style="width:100%" src="<?php //echo SITE_IMAGE;   ?>multijob_app.jpg" alt="Mobil applikáció">
</a> -->

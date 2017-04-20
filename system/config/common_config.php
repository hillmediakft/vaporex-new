<?php

$config['hash_cost_factor'] = 10;
$config['language_default'] = 'hu';
$config['allowed_languages'] = array('hu');
$config['reg_email_verify'] = true;

//default html layout beállítása
$config['layout'] = array(
    'default_site' => 'tpl_layout',
    'default_admin' => 'tpl_layout'
);

//log fileok adatai
$config['log'] = array(
    'error' => 'logs_error.log',
    'notice' => 'logs_notice.log'
);

$config['email'] = array(
    'password_reset' => array(
        'admin_url' => BASE_URL . 'admin/login/verifypasswordreset',
        'site_url' => BASE_URL . 'users/verifypasswordreset',
        'subject' => 'Új jelszó kérése.',
        'link' => 'Kattints a linkre a jelszó reseteléséhez.'
    ),
    'verification' => array(
        'site_url' => BASE_URL . 'felhasznalok/ellenorzes',
        'subject' => 'Regisztráció hitelesítése.',
        'link' => 'Kattints erre a linkre a regisztrációd aktiválásához.'
    ),
    'verification_newsletter' => array(
        'site_url' => BASE_URL . 'felhasznalok/ellenorzes_hirlevel',
        'subject' => 'Hírlevélre feliratkozás hitelesítése.',
        'link' => 'Kattints erre a linkre a feliratkozás aktiválásához.'
    )    
);

$config['slider'] = array(
    'width' => 1200,
    'height' => 475,
    'thumb_width' => 200,
    'upload_path' => UPLOADS . 'slider_photo/'
);

$config['blogphoto'] = array(
    'width' => 600,
    'height' => 400,
    'thumb_width' => 150,
    'upload_path' => UPLOADS . 'blog_photo/'
);

$config['photogallery'] = array(
    'width' => 800,
    'height' => 600,
    'thumb_width' => 320,
    'thumb_height' => 240,
    'upload_path' => UPLOADS . 'photo_gallery/'
);

$config['clientphoto'] = array(
    'width' => 150,
    'height' => 100,
    'thumb_width' => 150,
    'upload_path' => UPLOADS . 'client_photo/',
    'default_photo' => 'client_placeholder.png'
);

$config['categoryphoto'] = array(
    'width' => 400,
    'height' => 400,
    'thumb_width' => 80,
    'upload_path' => UPLOADS . 'product_category_photo/',
    'default_photo' => 'default.jpg'
);

$config['productphoto'] = array(
    'width' => 400,
    'height' => 300,
    'thumb_width' => 100,
    'thumb_height' => 75,
    'upload_path' => UPLOADS . 'product_photo/',
    'default_photo' => 'default.jpg'
);

$config['user'] = array(
    'width' => 600,
    'height' => 200,
    //'thumb_width' => 80,
    'upload_path' => UPLOADS . 'user_photo/',
    'default_photo' => 'user_placeholder.png'
);

$config['projectphoto'] = array(
    'width' => 800,
    'height' => 600,
    'thumb_width' => 400,
    'thumb_height' => 300,
    'upload_path' => UPLOADS . 'project_photo/',
    'default_photo' => 'default.jpg'
);

$config['projectcategoryphoto'] = array(
    'width' => 800,
    'height' => 600,
    'thumb_width' => 400,
    'thumb_height' => 300,
    'upload_path' => UPLOADS . 'project_category_photo/',
    'default_photo' => 'default.jpg'
);

$config['documents'] = array(
    'upload_path' => UPLOADS . 'documents/'
);

$config['session'] = array(
    'expire_time_admin' => 3600,
    'expire_time_site' => 3600
   // 'last_activity_name_admin' => 'user_last_activity', // A $_SESSION['last_activity'] elem fogja tárolni az utolsó aktivitás idejét
   // 'last_activity_name_site' => 'user_site_last_activity' // A $_SESSION['last_activity'] elem fogja tárolni az utolsó aktivitás idejét
);



        $config['brandphoto'] = array(
            'width' => 200,
        //  'height' => 100,
            'thumb_width' => 150,
            'upload_path' => UPLOADS . 'brand_photo/',
            'default_photo' => 'brand_placeholder.png'
        );

        $config['login'] = array(
            'facebook_login' => false,
            'facebook_login_app_id' => 'xxx',
            'facebook_login_app_secret' => 'xxx',
            'facebook_login_path' => 'login/loginWithFacebook',
            'facebook_register_path' => 'login/registerWithFacebook',
            'use_gravatar' => false,
            'avatar_size' => 44,
            'avatar_jpeg_quality' => 85,
            'avatar_default_image' => 'default.jpg',
            'avatar_path' => ''
        );

        $config['cookie'] = array(
            'runtime' => 1209600,
            'domain' => '.localhost'
        );

?>
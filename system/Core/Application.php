<?php
namespace System\Core;

use System\Libs\DI;
use System\Libs\Message;
use System\Libs\Language;
use System\Libs\Auth;
use System\Libs\EventManager;
use System\Libs\Config;

class Application {

    protected $request;

    public function __construct() {
        // request objektum visszaadása (itt már létrejön az uri és router objektum is!)
        $this->request = DI::get('request');

        // area állandó létrehozása
        define('AREA', $this->request->get_uri('area'));
        define('LANG', $this->request->get_uri('langcode'));
        // Betöltjük az aktuális nyelvnek megfelelő üzenet fájlt
        Message::init('messages_' . AREA, $this->request->get_uri('langcode'));

        if (AREA == 'site' && MULTILANG_SITE == true) {
            // nyelvi fájl betöltése
            //Language::init(LANG, DI::get('connect'));
            // egyeb fordítások
            //Config::load('translations');
        }
        // Megadjuk az Auth osztály alapbeállításait ('auth.php' config file betöltése)
        Auth::init('auth');

        // események inicializálása
        EventManager::init('events');

        // route-ok megadása, controller file betöltése és a megfelelő action behívása
        $this->_loadController();
    }

    private function _loadController() {
        $router = DI::get('router');

        /*         * ************************************************** */
        /*         * ************* SITE ******************************* */
        /*         * ************************************************** */
        if (AREA == 'site') {

            $router->get('/', 'home@index');
            
            // cégünkről
            $router->get('/cegunkrol', 'cegunkrol@index');
            $router->get('/cegunkrol/miert-pont-vaporex', 'cegunkrol@miert_pont_vaporex');
            $router->get('/cegunkrol/mennyibe-kerul', 'cegunkrol@mennyibe_kerul');
            
            //termékek
            $router->get('/termekek', 'termekek@index');
            $router->get('/termekek/:id', 'termekek@termek');
            $router->get('/termekek/kategoria/:title/:id', 'termekek@category');

            //referenciák
            $router->get('/referenciak', 'referenciak@index');
            $router->get('/referenciak/:title/:id', 'referenciak@referencia');

            //letöltések
            $router->get('/letoltesek', 'letoltesek@index');
            // ???? $router->get('/letoltesek/kategoria', 'letoltesek@category');

            // kalkulátor
            $router->get('/kalkulator', 'kalkulator@index');

            //hírek
            $router->get('/hirek', 'hirek@index');
            $router->get('/hirek/:title/:id', 'hirek@reszletek');
            $router->get('/hirek/kategoria/:id', 'hirek@kategoria');

            // gyakori kérdések
            $router->get('/gyakori-kerdesek', 'Gyakori_kerdesek@index');

            // kapcsolat
            $router->match('GET|POST', '/kapcsolat', 'Kapcsolat@index');

            // keresés
            $router->get('/kereses', 'Kereses@index');
            
            // kosár
            $router->get('/kosar', 'Kosar@index');





            $router->get('/profil', 'Profile@index');
            $router->post('/profile/change_userdata', 'Profile@changeUserdata'); // ajax
            $router->post('/profile/change_password', 'Profile@changePassword'); // ajax

            $router->post('/user/login', 'user@login'); // ajax
            $router->get('/felhasznalo/kijelentkezes', 'user@logout');
            $router->post('/user/register', 'user@register'); // ajax
            $router->post('/user/forgottpw', 'user@forgottpw'); // ajax
            $router->get('/felhasznalo/ellenorzes/:id/:hash', 'user@verify', array('id', 'activation_hash')); // ajax
            
            $router->post('/sendemail/init/:title', 'SendEmail@init', array('type'));

            $router->set404('error@index');
            
        }
        /*         * ************************************************** */
        /*         * **************** ADMIN *************************** */
        /*         * ************************************************** */
        elseif (AREA == 'admin') {

            $router->mount('/admin', function() use ($router) {

                $router->before('GET|POST', '/?((?!login).)*', function() {
                    if (!Auth::check()) {
                        $response = DI::get('response');
                        $response->redirect('admin/login');
                    }
                });


                $router->get('/', 'home@index');
                $router->get('/home', 'home@index');

            // login logout	
                $router->match('GET|POST', '/login', 'login@index');
                $router->get('/login/logout', 'login@logout');

            // pages	
                $router->get('/pages', 'pages@index');
                $router->match('GET|POST', '/pages/update/:id', 'pages@update', array('id'));

                // content	
                //$router->get('/content', 'content@index');
                //$router->match('GET|POST', '/content/edit/:id', 'content@edit', array('id'));

            // termékek
                $router->get('/products', 'products@index');
                $router->get('/products/view/:id', 'products@view');
                $router->match('GET|POST', '/products/insert', 'products@insert');
                $router->match('GET|POST', '/products/update/:id', 'products@update');
                $router->post('/products/delete', 'products@delete');
                $router->post('/products/change_status', 'products@change_status');
                // termék kategória
                $router->match('GET|POST', '/products/category', 'products@category');
                $router->match('GET|POST', '/products/category_insert', 'products@category_insert');
                $router->match('GET|POST', '/products/category_update/:id', 'products@category_update');
                $router->get('/products/category_delete/:id', 'products@category_delete');
                // termék és termékkategória képek feltöltése, vágása
                $router->post('/products/product_crop_img_upload/(upload)', 'products@product_crop_img_upload', array('upload'));
                $router->post('/products/product_crop_img_upload/(crop)', 'products@product_crop_img_upload', array('crop'));
                $router->post('/products/product_category_crop_img_upload/(upload)', 'products@product_category_crop_img_upload', array('upload'));
                $router->post('/products/product_category_crop_img_upload/(crop)', 'products@product_category_crop_img_upload', array('crop'));

            // referenciák
                $router->get('/projects', 'projects@index');
                $router->get('/projects/view_project/:id', 'projects@view_project');
                $router->match('GET|POST', '/projects/new_project', 'projects@new_project');
                $router->match('GET|POST', '/projects/update_project/:id', 'projects@update_project');
                $router->post('/projects/delete', 'projects@delete'); // AJAX
                $router->post('/projects/change_status', 'projects@change_status'); // AJAX
                // referencia kategória
                $router->get('/projects/category', 'projects@category');
                $router->match('GET|POST', '/projects/category_insert', 'projects@category_insert');
                $router->match('GET|POST', '/projects/category_update/:id', 'projects@category_update');
                $router->post('/projects/category_delete', 'projects@category_delete'); // AJAX
                // referencia képek feltöltése, vágása
                $router->post('/projects/project_crop_img_upload/(upload)', 'projects@project_crop_img_upload', array('upload'));
                $router->post('/projects/project_crop_img_upload/(crop)', 'projects@project_crop_img_upload', array('crop'));

            // GYIK
                $router->get('/gyik', 'gyik@index');
                $router->get('/gyik/view_gyik/:id', 'gyik@view_gyik');
                $router->match('GET|POST', '/gyik/insert', 'gyik@insert');
                $router->match('GET|POST', '/gyik/update/:id', 'gyik@update/:id');
                $router->post('/gyik/delete', 'gyik@delete'); // AJAX
                $router->post('/gyik/change_status', 'gyik@change_status'); // AJAX
                // gyik kategória
                $router->get('/gyik/category', 'gyik@category');
                $router->match('GET|POST', '/gyik/category_insert', 'gyik@category_insert');
                $router->match('GET|POST', '/gyik/category_update/:id', 'gyik@category_update');
                $router->post('/gyik/category_delete', 'gyik@category_delete'); //AJAX

            // user	
                $router->get('/user', 'user@index');
                $router->match('GET|POST', '/user/insert', 'user@insert');
                $router->match('GET|POST', '/user/profile/:id', 'user@profile', array('id'));
                $router->post('/user/delete', 'user@delete');
                $router->post('/user/change_status', 'user@change_status');
                $router->post('/user/user_img_upload/(upload)', 'user@user_img_upload', array('upload'));
                $router->post('/user/user_img_upload/(crop)', 'user@user_img_upload', array('crop'));
                $router->match('GET|POST', '/user/user_roles', 'user@user_roles');
                $router->match('GET|POST', '/user/edit_roles/:id', 'user@edit_roles', array('id'));
                $router->post('/user/deleteimage', 'User@deleteImage');

            // photo gallery	
                $router->get('/photo-gallery', 'photo_gallery@index');
                $router->post('/photo-gallery/delete_photo', 'photo_gallery@delete_photo');
                $router->post('/photo-gallery/delete_category', 'photo_gallery@delete_category');
                $router->match('GET|POST', '/photo-gallery/insert', 'photo_gallery@insert');
                $router->match('GET|POST', '/photo-gallery/update/:id', 'photo_gallery@update', array('id'));
                $router->get('/photo-gallery/category', 'photo_gallery@category');

            // slider	
                $router->get('/slider', 'slider@index');
                $router->post('/slider/delete', 'slider@delete');
                $router->match('GET|POST', '/slider/insert', 'slider@insert');
                $router->match('GET|POST', '/slider/update/:id', 'slider@update', array('id'));
                $router->post('/slider/order', 'slider@order');

            // testimonials	
                $router->get('/testimonials', 'testimonials@index');
                $router->match('GET|POST', '/testimonials/insert', 'testimonials@insert');
                $router->match('GET|POST', '/testimonials/update/:id', 'testimonials@update', array('id'));
                $router->get('/testimonials/delete/:id', 'testimonials@delete', array('id'));

            // clients	
                $router->get('/clients', 'clients@index');
                $router->post('/clients/client_img_upload/(upload)', 'clients@client_img_upload', array('upload'));
                $router->post('/clients/client_img_upload/(crop)', 'clients@client_img_upload', array('crop'));
                $router->post('/clients/delete', 'clients@delete');
                $router->match('GET|POST', '/clients/insert', 'clients@insert');
                $router->match('GET|POST', '/clients/update/:id', 'clients@update', array('id'));
                $router->post('/clients/order', 'clients@order');

            // file manager	
                $router->get('/filemanager', 'FileManager@index');

            // settings	
                $router->match('GET|POST', '/settings', 'settings@index');

            // user manual	
                $router->get('/user-manual', 'UserManual@index');

            // newsletter	
                $router->get('/newsletter', 'newsletter@index');
                $router->get('/newsletter/newsletter_stats', 'newsletter@newsletter_stats');
                $router->post('/newsletter/delete', 'newsletter@delete');
                $router->match('GET|POST', '/newsletter/insert', 'newsletter@insert');
                $router->match('GET|POST', '/newsletter/update/:id', 'newsletter@update', array('id'));

            // blog	
                $router->get('/blog', 'blog@index');
                $router->post('/blog/delete', 'blog@delete');
                $router->match('GET|POST', '/blog/insert', 'blog@insert');
                $router->match('GET|POST', '/blog/update/:id', 'blog@update', array('id'));
                $router->get('/blog/category', 'blog@category');
                $router->post('/blog/category_insert_update', 'blog@category_insert_update');
                $router->post('/blog/category_delete', 'blog@category_delete');
                $router->post('/blog/change_status', 'blog@change_status');

            //documents
                $router->get('/documents', 'documents@index');
                $router->match('GET|POST', '/documents/insert', 'documents@insert');
                $router->match('GET|POST', '/documents/update/:id', 'documents@update', array('id'));
                $router->post('/documents/delete_document_AJAX', 'documents@delete_document_AJAX');
                $router->post('/documents/insert_update_data_ajax', 'documents@insert_update_data_ajax');
                $router->get('/documents/category', 'documents@category');
                $router->post('/documents/category_insert_update', 'documents@category_insert_update');
                $router->post('/documents/category_delete', 'documents@category_delete');
                $router->post('/documents/show_file_list', 'documents@show_file_list');
                $router->post('/documents/doc_upload_ajax', 'documents@doc_upload_ajax');
                $router->post('/documents/file_delete', 'documents@file_delete');
                $router->get('/documents/download/:filename', 'documents@download', array('file'));
                                
            // log lista oldal
                $router->get('/logs', 'Logs@index');

            // error	
                $router->set404('error@index');
            });
        }

        // dispatcher objektum példányosítása
        $dispatcher = new \System\Libs\Dispatcher();
        // controller névtérének beállítása
        $dispatcher->setControllerNamespace('System\\' . ucfirst(AREA) . '\Controller\\');

        // before útvonalak bejárása, a megadott elemek futtatása
        $before_callbacks = $router->runBefore();
        $dispatcher->dispatch($before_callbacks);

        // útvonalak bejárása, controller példányosítása, action indítása
        $callback = $router->run();
        $dispatcher->dispatch($callback);
    }

}

// osztály vége
?>
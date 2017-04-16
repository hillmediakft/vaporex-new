<?php
namespace System\Admin\Controller;
use System\Core\AdminController;
use System\Core\View;
use System\Libs\Auth;
use System\Libs\Message;
use System\Libs\Config;
use System\Libs\DI;
use System\Libs\Uploader;

class Products extends AdminController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('products_model');
        $this->loadModel('product_categories_model');
/*
var_dump($this->products_model->product_number_in_category(33));
var_dump($this->products_model->productCategoryCounter());
var_dump($this->product_categories_model->productCategories());
var_dump($this->product_categories_model->productCategories_2());
var_dump($data['product_category_list'] = $this->product_categories_model->productCategories() );
die;
*/
    }

    /**
     * 
     */
    public function index()
    {
        Auth::hasAccess('products.index', $this->request->get_httpreferer());    

        $data['title'] = 'Termékek oldal';
        $data['description'] = 'Termékek oldal description';
        $data['all_products'] = $this->products_model->allProducts();

        $view = new View();
        $view->setHelper(array('url_helper'));
        $view->add_links(array('select2', 'datatable', 'bootbox', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/products.js');
        $view->render('products/tpl_products', $data);
    }

    /**
     * 	Termék minden adatának megjelenítése
     *
     * @param integer $id
     */
    public function view($id)
    {
        $id = (int)$id;    
        $data['title'] = 'Admin termék részletek oldal';
        $data['description'] = 'Admin termék részletek oldal description';
        $data['content'] = $this->products_model->oneProduct($id);

        $view = new View();
        $view->add_link('js', ADMIN_JS . 'pages/common.js');
        $view->render('products/tpl_product_view', $data);
    }

    /**
     * 	Termék minden adatának megjelenítése Ajax-szal
     */
    public function view_product_ajax($id)
    {
        if ($this->request->is_ajax()) {
            $data['content'] = $this->products_model->oneProduct($id);

            $view = new View();
            $view->set_layout(null);
            $view->render('products/tpl_product_view_modal', $data);
        } else {
            $this->response->redirect('admin/error');
        }
    }

    /**
     * 	Új termék hozzáadása
     */
    public function insert()
    {
        // új termék hozzáadása
        if ($this->request->is_post()) {

            if (empty($this->request->get_post('img_url'))) {
                $data['product_photo'] = Config::get('productphoto.default_photo');
            } else {
                $path_parts = pathinfo($this->request->get_post('img_url'));
                $data['product_photo'] = $path_parts['filename'] . '.' . $path_parts['extension'];
            }

            $data['product_title'] = $this->request->get_post('product_title');
            $data['product_description'] = $this->request->get_post('product_description');
            $data['product_price'] = $this->request->get_post('product_price', 'integer');
            $data['product_tax'] = $this->request->get_post('product_tax', 'integer');
            $data['product_category_id'] = $this->request->get_post('product_category_id', 'integer');
            $data['product_status'] = $this->request->get_post('product_status', 'integer');
            //létrehozás dátuma timestamp
            $data['product_create_timestamp'] = time();

            $have_subcategories = (!empty($data['product_category_id'])) ? $this->product_categories_model->get_subcategory($data['product_category_id']) : '';
            $error_counter = 0;
            
            //megnevezés ellenőrzése    
            if (empty($data['product_title'])) {
                $error_counter++;
                Message::set('error', 'A termék megnevezése nem lehet üres!');
            }
            if (empty($data['product_description'])) {
                $error_counter++;
                Message::set('error', 'A termék leírása nem lehet üres!');
            }
            if (empty($data['product_category_id'])) {
                $error_counter++;
                Message::set('error', 'Választani kell egy kategóriát!');
            }
            if (empty($data['product_price'])) {
                $error_counter++;
                Message::set('error', 'Adja meg a termék árát!');
            }
            if (!empty($have_subcategories)) {
                $error_counter++;
                Message::set('error', 'A katagória már tartalmaz alkategóriát, ezért nem hozhat létre terméket! Hozzon létre új alkategóriát');
            }

            if ($error_counter != 0) {
                $this->response->redirect('admin/products/insert');
            }

            // új adatok az adatbázisba
            $result = $this->products_model->insert($data);

            if ($result !== false) {
                Message::set('success', 'Termék sikeresen hozzáadva.');
                $this->response->redirect('admin/products');
            } else {
                Message::set('error', 'Adatbázis lekérdezési hiba.');
                $this->response->redirect('admin/products/insert');
            }
        }

        $data['title'] = 'Új termék oldal';
        $data['description'] = 'Új termék description';
        $data['product_category_list'] = $this->product_categories_model->productCategories();
        $data['product_category_list_with_path'] = $this->product_categories_with_path($data['product_category_list']);

        $view = new View();
        $view->add_links(array('bootstrap-fileupload', 'croppic', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/product_insert.js');
        $view->render('products/tpl_product_insert', $data);
    }

    /**
     * 	Termék módosítása
     *
     */
    public function update($id)
    {
        $id = (int)$id;

        if ($this->request->is_post()) {

            $data['product_title'] = $this->request->get_post('product_title');
            $data['product_description'] = $this->request->get_post('product_description');
            $data['product_price'] = $this->request->get_post('product_price', 'integer');
            $data['product_tax'] = $this->request->get_post('product_tax', 'integer');
            $data['product_category_id'] = $this->request->get_post('product_category_id', 'integer');
            $data['product_status'] = $this->request->get_post('product_status', 'integer');

            $img_url = $this->request->get_post('img_url');
            $old_img_path = $this->request->get_post('old_img');

            if (!empty($img_url)) {
                $path_parts = pathinfo($img_url);
                $data['product_photo'] = $path_parts['filename'] . '.' . $path_parts['extension'];

                $old_img_path_parts = pathinfo($old_img_path);
                $old_img_name = $old_img_path_parts['filename'] . '.' . $old_img_path_parts['extension'];

                //megnézzük, hogy a régi kép a default-e, mert azt majd nem akarjuk törölni
                if ($old_img_name == Config::get('productphoto.default_photo')) {
                    $default_photo = true;
                } else {
                    $default_photo = false;
                    $old_thumb_path = DI::get('url_helper')->thumbPath($old_img_path);
                }
            }

            // módosítás dátuma timestamp formátumban
            $data['product_update_timestamp'] = time();

            $have_subcategories = (!empty($data['product_category_id'])) ? $this->product_categories_model->get_subcategory($data['product_category_id']) : '';

            $error_counter = 0;
            //megnevezés ellenőrzése    
            if (empty($data['product_title'])) {
                $error_counter++;
                Message::set('error', 'A termék megnevezése nem lehet üres!');
            }
            if (empty($data['product_description'])) {
                $error_counter++;
                Message::set('error', 'A termék leírása nem lehet üres!');
            }
            if (empty($data['product_category_id'])) {
                $error_counter++;
                Message::set('error', 'Választani kell egy kategóriát!');
            }
            if (empty($data['product_price'])) {
                $error_counter++;
                Message::set('error', 'Adja meg a termék árát!');
            }
            if (!empty($has_subcategories)) {
                $error_counter++;
                Message::set('error', 'A katagória már tartalmaz alkategóriát, ezért nem hozhat létre terméket! Hozzon létre új alkategóriát');
            }

            if ($error_counter != 0) {
                $this->response->redirect('admin/products/update/' . $id);
            }

            // új adatok az adatbázisba
            $result = $this->products_model->update($id, $data);

            if ($result !== false) {
                // megvizsgáljuk, hogy létezik-e új feltöltött kép és a régi kép, nem a default
                if (!empty($img_url) && $default_photo === false) {
                    //régi képek törlése
                    DI::get('file_helper')->delete(array($old_img_path, $old_thumb_path));
                }

                Message::set('success', 'Termék adatai sikeresen módosítva.');
                $this->response->redirect('admin/products');
            } else {
                Message::set('error', 'Adatbázis lekérdezési hiba!');
                $this->response->redirect('admin/products/update/' . $id);
            }
        }

        $data['title'] = 'Termék módosítása oldal';
        $data['description'] = 'Termék módosítása description';
        // a módosítandó termék adatai
        $data['actual_product'] = $this->products_model->oneProduct($id);
        // munka kategóriák lekérdezése az option listához
        $data['product_category_list'] = $this->product_categories_model->productCategories();
        $data['product_category_list_with_path'] = $this->product_categories_with_path($data['product_category_list']);

        $view = new View();

        $view->add_links(array('bootstrap-fileupload', 'croppic', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/product_update.js');
        $view->render('products/tpl_product_update', $data);
    }

    /**
     * DELETE
     */
    public function delete()
    {
        if($this->request->is_ajax()){
                
            if(!Auth::hasAccess('products.delete')){
                $this->response->json(array(
                    'status' => 'error',
                    'message' => 'Nincs engedélye a művelet végrehajtásához!'
                ));
            }               
            // a POST-ban kapott item_id egy tömb
            $id_arr = $this->request->get_post('item_id');

            // a sikeres törlések számát tárolja
            $success_counter = 0;
            // a sikeresen törölt id-ket tartalmazó tömb
            $success_id = array();      
            // a sikertelen törlések számát tárolja
            $fail_counter = 0; 
            
            // helperek példányosítása
            $file_helper = DI::get('file_helper');
            $url_helper = DI::get('url_helper');

            // bejárjuk a $id_arr tömböt és minden elemen végrehajtjuk a törlést
            foreach($id_arr as $id) {
                //átalakítjuk a integer-ré a kapott adatot
                $id = (int)$id;
                //lekérdezzük a törlendő blog képének a nevét, hogy törölhessük a szerverről
                $photo_name = $this->products_model->selectPicture($id);
                
                //blog törlése  
                $result = $this->products_model->delete($id);
                
                if($result !== false) {
                    // ha a törlési sql parancsban nincs hiba
                    if($result > 0){
                        //ha van feltöltött képe a bloghoz (az adatbázisban szerepel a file-név)
                        if(!empty($photo_name)){
                            $picture_path = Config::get('productphoto.upload_path') . $photo_name;
                            $thumb_picture_path = $url_helper->thumbPath($picture_path);
                            // képek törlése
                            $file_helper->delete(array($picture_path, $thumb_picture_path));
                        }               
                        //sikeres törlés
                        $success_counter += $result;
                        $success_id[] = $id;
                    }
                    else {
                        //sikertelen törlés
                        $fail_counter++;
                    }
                }
                else {
                    // ha a törlési sql parancsban hiba van
                    $this->response->json(array(
                        'status' => 'error',
                        'message_error' => 'Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!',                  
                    ));
                }
            }

            // üzenetek visszaadása
            $respond = array();
            $respond['status'] = 'success';
            
            if ($success_counter > 0) {
                $respond['message_success'] = $success_counter . ' termék törölve.';
            }
            if ($fail_counter > 0) {
                $respond['message_error'] = $fail_counter . ' terméket már töröltek!';
            }

            // respond tömb visszaadása
            $this->response->json($respond);

        }    
    } 

    /**
     * 	Termék kategóriák megjelenítése
     */
    public function category()
    {
        // adatok bevitele a view objektumba
        $data['title'] = 'Termékek kategória oldal';
        $data['description'] = 'termékek kategória description';
        $data['all_product_category'] = $this->product_categories_model->productCategories_2();
        $data['category_counter'] = $this->products_model->productCategoryCounter();
        $data['category_tree'] = $this->_get_category_tree_2();

//var_dump($data);die;

        $view = new View();
        $view->setHelper(array('url_helper'));
        $view->add_links(array('datatable', 'bootbox', 'vframework'));
        $view->add_link('css', ADMIN_ASSETS . 'plugins/jstree/dist/themes/default/style.min.css');
        $view->add_link('js', ADMIN_ASSETS . 'plugins/jstree/dist/jstree.min.js');
        $view->add_link('js', ADMIN_JS . 'pages/product_category.js');
        $view->render('products/tpl_product_category', $data);
    }

    /**
     * 	Új termék kategória hozzáadása
     */
    public function category_insert()
    {
        if ($this->request->is_post()) {
 
            //ha üresen küldték el a formot
            if (empty($this->request->get_post('product_category_name'))) {
                Message::set('error', 'Meg kell adni a kategória nevét!');
                $this->response->redirect('admin/category_insert');
            }

            $data['product_category_name'] = $this->request->get_post('product_category_name');

            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->product_categories_model->categoryList();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                $data['product_category_name'] = trim($data['product_category_name']);
                if (strtolower($data['product_category_name']) == strtolower($value['product_category_name'])) {
                    Message::set('error', 'category_already_exists');
                    $this->response->redirect('admin/category_insert');
                }
            }

            $img_url = $this->request->get_post('img_url');
            if (empty($img_url)) {
                $data['product_category_photo'] = Config::get('categoryphoto.default_photo');
            } else {
                $path_parts = pathinfo($img_url);
                $data['product_category_photo'] = $path_parts['filename'] . '.' . $path_parts['extension'];
            }

            $data['product_category_parent'] = $this->request->get_post('product_category_parent_id', 'integer');

            // adataok adatbázisb írása
            $result = $this->product_categories_model->insert($data);

            // ha sikeres az insert visszatérési érték egy id
            if ($result !== false) {
                Message::set('success', 'category_created');
                $this->response->redirect('admin/products/category');
            } else {
                Message::set('error', 'unknown_error');
                $this->response->redirect('admin/products/category_insert');
            }


        }

        $data['title'] = 'Új kategória hozzáadása oldal';
        $data['description'] = 'Új kategória description';
        
        $data['product_category_list'] = $this->product_categories_model->productCategories();
        $data['product_category_list_with_path'] = $this->product_categories_with_path($data['product_category_list']);

        $view = new View();
        $view->add_links(array('bootstrap-fileupload', 'croppic', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/product_category_insert.js');
        $view->render('products/tpl_product_category_insert', $data);
    }

    /**
     * 	Termék kategória módosítása
     */
    public function category_update($id)
    {
        $id = (int)$id;

        if ($this->request->is_post()) {

            //ha üresen küldték el a formot
            if ( empty($this->request->get_post('product_category_name')) ) {
                Message::set('error', 'Meg kell adni a kategória nevét!');
                $this->response->redirect('admin/products/category_update/' . $id);
            }

            $data['product_category_name'] = $this->request->get_post('product_category_name');
            $data['product_category_parent'] = $this->request->get_post('product_category_parent_id', 'integer');
 
            $old_category = $this->request->get_post('old_category');

            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->product_categories_model->categoryList();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                $data['product_category_name'] = trim($data['product_category_name']);
                if (strtolower($data['product_category_name']) == strtolower($value['product_category_name']) && $id != $value['product_category_id']) {
                    Message::set('error', 'category_already_exists');
                    $this->response->redirect('admin/products/category_update/' . $id);
                }
            }


            $img_url = $this->request->get_post('img_url');
            $old_img_url = $this->request->get_post('old_img');

            if (!empty($img_url)) {
                $path_parts = pathinfo($img_url);
                $data['product_category_photo'] = $path_parts['filename'] . '.' . $path_parts['extension'];

                $old_img_path_parts = pathinfo($old_img_url);
                $old_img_name = $old_img_path_parts['filename'] . '.' . $old_img_path_parts['extension'];
                
                //megnézzük, hogy a régi kép a default-e, mert azt majd nem akarjuk törölni
                if ($old_img_name == Config::get('categoryphoto.default_photo')) {
                    $default_photo = true;
                } else {
                    $default_photo = false;
                    $old_thumb_path = $this->url_helper->thumbPath($old_img_url);
                }
            }

            // adatok adatbázisba írása
            $result = $this->product_categories_model->update($id, $data);

            // ha sikeres az insert visszatérési érték true
            if ($result !== false) {
                // megvizsgáljuk, hogy létezik-e új feltöltött kép és a régi kép, nem a default
                if (!empty($img_url) && $default_photo === false) {
                    //régi képek törlése
                    $this->file_helper->delete(array($old_img_url, $old_thumb_path));
                }
                Message::set('success', 'category_updated');
                $this->response->redirect('admin/products/category');
            } else {
                Message::set('error', 'unknown_error');
                $this->response->redirect('admin/products/category_update/' . $id);
            }

        }

        $data['title'] = 'Admin termék kategória módosítása oldal';
        $data['description'] = 'Admin termék kategória módosítása description';

        $data['product_category_list'] = $this->product_categories_model->productCategories();
        $data['product_category_list_with_path'] = $this->product_categories_with_path($data['product_category_list']);
        $data['category_content'] = $this->product_categories_model->oneCategory($id);

        $view = new View();
        $view->add_links(array('bootstrap-fileupload', 'croppic', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/product_category_update.js');
        $view->render('products/tpl_product_category_update', $data);
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete($id)
    {
        $id = (int)$id;
        if (!$this->isCategoryDeletable($id)) {
            Message::set('error', 'A kategória nem törölhető! A kategória terméket tartalmaz, vagy alkategóriái vannak!');
            $this->response->redirect('admin/products/category');
        }

        // kategória törlése
        $result = $this->product_categories_model->delete($id);

        if ($result !== false) {
            Message::set('success', 'A kategória törlése sikerült.');
        } else {
            Message::set('error', 'A kategória törlése nem sikerült!');
        }
        
        $this->response->redirect('admin/products/category');
    }

    /**
     * Ellenőrizzük, hogy a kategória törölhető-e: tartalmaz-e terméket     
     *
     * @param integer $id
     * @return boolean $result
     */
    public function isCategoryDeletable($id)
    {
        $result = $this->products_model->selectCategoryById($id);

        if (!empty($result)) {
            return false;
        }

        $path_info = $this->product_categories_model->get_subcategory($id);

        if (!empty($path_info)) {
            foreach ($path_info as $value) {
                if (in_array($id, $value)) {
                    return false;
                }
            }
        }
        return true;
    }
  


    /**
     * (AJAX) Az products táblában módosítja a product_status mező értékét
     *
     * @return void
     */
    public function change_status()
    {
        if ( $this->request->is_ajax() ) {
            // jogosultság vizsgálat
            if (!Auth::hasAccess('products.change_status')) {
                $this->response->json(array(
                    "status" => 'error',
                    "message" => 'Nincs engedélye a művelet végrehajtásához.'
                ));         
            }               
            
            if ( $this->request->has_post('action') && $this->request->has_post('id') ) {
            
                $id = $this->request->get_post('id', 'integer');
                $action = $this->request->get_post('action');

                if($action == 'make_active') {
                    $result = $this->products_model->changeStatus($id, 1);
                    if($result !== false){
                        $this->response->json(array(
                            "status" => 'success',
                            "message" => 'A termék aktiválása megtörtént!'
                        ));     
                    } else {
                        $this->response->json(array(
                            "status" => 'error',
                            "message" => 'Adatbázis hiba! A termék státusza nem változott meg!'
                        ));
                    }
                }
                if($action == 'make_inactive') {
                    $result = $this->products_model->changeStatus($id, 0);
                    if($result !== false){
                        $this->response->json(array(
                            "status" => 'success',
                            "message" => 'A termék blokkolása megtörtént!'
                        ));     
                    } else {
                        $this->response->json(array(
                            "status" => 'error',
                            "message" => 'Adatbázis hiba! A termék státusza nem változott meg!'
                        ));
                    }
                    
                }
            } else {
                $this->response->json(array(
                    "status" => 'error',
                    "message" => 'unknown_error'
                ));
            }

        } else {
            $this->response->redirect('admin/error');
        }
    }

    /**
     *  A termék képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *  Ez a metódus kettő XHR kérést dolgoz fel.
     *  Meghívásakor kap egy paramétert melynek értékei upload vagy crop
     *  upload paraméterrel meghívva: feltölti a kiválasztott képet
     *  crop paraméterrel meghívva: megvágja az eredeti képet és feltölti   
     *
     * @param string $parameter
     * @return void
     */
    public function product_crop_img_upload($parameter)
    {
        if( $this->request->is_ajax() ){
            // feltöltés helye
            $upload_path = Config::get('productphoto.upload_path');
            // Kiválasztott kép feltöltése

            if ($parameter == 'upload') {
                //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül) 
                $image = new Uploader($this->request->getFiles('img'));
                $tempfilename = 'temp_' . uniqid();
                $image->allowed(array('image/*'));
                $image->resize(Config::get('productphoto.width', 400), null);
                $image->save($upload_path, $tempfilename);
                    
                if ($image->checkError()) {
                    $this->response->json(array(
                        "status" => 'error',
                        "message" => $image->getError()
                    ));
                } else {
                    $this->response->json(array(
                        "status" => 'success',
                        "url" => $upload_path . $image->getDest('filename'),
                        "width" => $image->getDest('width'),
                        "height" => $image->getDest('height')
                    ));
                }
            }

            // Kiválasztott kép vágása és vágott kép feltöltése
            else if ($parameter == 'crop') {

                // a croppic js küldi ezeket a POST adatokat    
                $imgUrl = $this->request->get_post('imgUrl');
                // original sizes
                $imgInitW = $this->request->get_post('imgInitW');
                $imgInitH = $this->request->get_post('imgInitH');
                // resized sizes
                //kerekítjük az értéket, mert lebegőpotos számot is kaphatunk és ez hibát okozna a kép generálásakor
                $imgW = round($this->request->get_post('imgW'));
                $imgH = round($this->request->get_post('imgH'));
                // offsets
                // megadja, hogy mennyit kell vágni a kép felső oldalából
                $imgY1 = $this->request->get_post('imgY1');
                // megadja, hogy mennyit kell vágni a kép bal oldalából
                $imgX1 = $this->request->get_post('imgX1');
                // crop box
                $cropW = $this->request->get_post('cropW');
                $cropH = $this->request->get_post('cropH');
                // rotation angle
                //$angle = $this->request->get_post('rotation');
                //a $right_crop megadja, hogy mennyit kell vágni a kép jobb oldalából
                $right_crop = ($imgW - $imgX1) - $cropW;
                //a $bottom_crop megadja, hogy mennyit kell vágni a kép aljából
                $bottom_crop = ($imgH - $imgY1) - $cropH;

                //képkezelő objektum létrehozása (a feltöltött kép elérése a paraméter) 
                $image = new Uploader($imgUrl);
                $newfilename = 'product_' . md5(uniqid());
                $image->resize($imgW, null);
                $image->crop(array($imgY1, $right_crop, $bottom_crop, $imgX1));
                $image->save($upload_path, $newfilename);

                // hibaellenőrzés
                if ($image->checkError()) {
                    $this->response->json(array(
                        "status" => 'error',
                        "message" => $image->getError()
                    ));                    
                } else {
                    // temp kép törlése
                    DI::get('file_helper')->delete($imgUrl);

                    // nézőkép a vágott képről
                    $thumb_image = new Uploader($upload_path . $image->getDest('filename'));
                    $thumb_width = Config::get('productphoto.thumb_width', 100);
                    $thumb_height = Config::get('productphoto.thumb_height', 75);
                    $thumb_image->cropToSize($thumb_width, $thumb_height);
                    $thumb_image->save($upload_path, $newfilename . '_thumb');

                    $this->response->json(array(
                        "status" => 'success',
                        "url" => $upload_path . $image->getDest('filename')
                    ));
                }

            }
        }
    }
    
    /**
     * 	A termék kategória képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     */
    public function product_category_crop_img_upload($parameter)
    {
        if( $this->request->is_ajax() ){
            // feltöltés helye
            $upload_path = Config::get('categoryphoto.upload_path');
            // Kiválasztott kép feltöltése

            if ($parameter == 'upload') {
                //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül) 
                $image = new Uploader($this->request->getFiles('img'));
                $tempfilename = 'temp_' . uniqid();
                $image->allowed(array('image/*'));
                $image->resize(Config::get('categoryphoto.width', 400), null);
                $image->save($upload_path, $tempfilename);
                    
                if ($image->checkError()) {
                    $this->response->json(array(
                        "status" => 'error',
                        "message" => $image->getError()
                    ));
                } else {
                    $this->response->json(array(
                        "status" => 'success',
                        "url" => $upload_path . $image->getDest('filename'),
                        "width" => $image->getDest('width'),
                        "height" => $image->getDest('height')
                    ));
                }
            }

            // Kiválasztott kép vágása és vágott kép feltöltése
            else if ($parameter == 'crop') {

                // a croppic js küldi ezeket a POST adatokat    
                $imgUrl = $this->request->get_post('imgUrl');
                // original sizes
                $imgInitW = $this->request->get_post('imgInitW');
                $imgInitH = $this->request->get_post('imgInitH');
                // resized sizes
                //kerekítjük az értéket, mert lebegőpotos számot is kaphatunk és ez hibát okozna a kép generálásakor
                $imgW = round($this->request->get_post('imgW'));
                $imgH = round($this->request->get_post('imgH'));
                // offsets
                // megadja, hogy mennyit kell vágni a kép felső oldalából
                $imgY1 = $this->request->get_post('imgY1');
                // megadja, hogy mennyit kell vágni a kép bal oldalából
                $imgX1 = $this->request->get_post('imgX1');
                // crop box
                $cropW = $this->request->get_post('cropW');
                $cropH = $this->request->get_post('cropH');
                // rotation angle
                //$angle = $this->request->get_post('rotation');
                //a $right_crop megadja, hogy mennyit kell vágni a kép jobb oldalából
                $right_crop = ($imgW - $imgX1) - $cropW;
                //a $bottom_crop megadja, hogy mennyit kell vágni a kép aljából
                $bottom_crop = ($imgH - $imgY1) - $cropH;

                //képkezelő objektum létrehozása (a feltöltött kép elérése a paraméter) 
                $image = new Uploader($imgUrl);
                $newfilename = 'productcategory_' . md5(uniqid());
                $image->resize($imgW, null);
                $image->crop(array($imgY1, $right_crop, $bottom_crop, $imgX1));
                $image->save($upload_path, $newfilename);

                // hibaellenőrzés
                if ($image->checkError()) {
                    $this->response->json(array(
                        "status" => 'error',
                        "message" => $image->getError()
                    ));                    
                } else {
                    // temp kép törlése
                    DI::get('file_helper')->delete($imgUrl);

                    // nézőkép a vágott képről
                    $thumb_image = new Uploader($upload_path . $image->getDest('filename'));
                    $thumb_width = Config::get('categoryphoto.thumb_width', 100);
                    $thumb_height = Config::get('categoryphoto.thumb_height', 75);
                    $thumb_image->cropToSize($thumb_width, $thumb_height);
                    $thumb_image->save($upload_path, $newfilename . '_thumb');

                    $this->response->json(array(
                        "status" => 'success',
                        "url" => $upload_path . $image->getDest('filename')
                    ));
                }

            }
        }
    }    



    /**
     *  Minden termék kategória tömbhöz hozzáilleszti a kategória elérési útvonalát
     * 
     *  @return array a kategóriák + path tömbben   
     */
    public function product_categories_with_path($categories_arr)
    {
        // a termékek root kategória eltávolítása a tömbből 
        array_shift($categories_arr);

        foreach ($categories_arr as $key => $value) {
            $categories_arr[$key]['category_path'] = $this->product_categories_model->product_category_path($value['cat_id']);
        }

        return $categories_arr;
    }

            /**
             *  Termék kategóriákból lista létrehozása fa generáláshoz  
             *
             *  @return string html kód
             */
            private function _get_category_tree()
            {
                $result = $this->product_categories_model->get_subcategory(1);
                $list = '<ul>';
                foreach ($result as $value) {

                    $list .= '<li>' . $value['product_category_name'] . ' (' . $this->_get_product_count($value['product_category_id']) . ')';
                    $list .= '<ul>';

                    $sub_result = $this->product_categories_model->get_subcategory($value['product_category_id']);

                    foreach ($sub_result as $sub_value) {

                        $list .= '<li>' . $sub_value['product_category_name'] . ' (' . $this->_get_product_count($sub_value['product_category_id']) . ')';
                        $list .= '<ul>';
                        $sub_sub_result = $this->product_categories_model->get_subcategory($sub_value['product_category_id']);

                        foreach ($sub_sub_result as $sub_sub_value) {
                            $list .= '<li>' . $sub_sub_value['product_category_name'] . ' (' . $this->_get_product_count($sub_sub_value['product_category_id']) . ')';
                            $list .= '<ul>';
                            $sub_sub_sub_result = $this->product_categories_model->get_subcategory($sub_sub_value['product_category_id']);
                            foreach ($sub_sub_sub_result as $sub_sub_sub_value) {
                                $list .= '<li>' . $sub_sub_sub_value['product_category_name'] . ' (' . $this->_get_product_count($sub_sub_sub_value['product_category_id']) . ')' . '</li>';
                            }

                            $list .= '</ul>';
                            $list .= '</li>';
                        }
                        $list .= '</ul>';
                        $list .= '</li>';
                    }
                    $list .= '</ul>';
                    $list .= '</li>';
                }
                $list .= '</ul>';

                return $list;
            }

    /**
     *  Termék kategóriákból lista létrehozása fa generáláshoz  
     *
     *  @return string html kód
     */
    private function _get_category_tree_2()
    {
        $result = $this->product_categories_model->get_subcategory(0);
        $list = '<ul>';
        foreach ($result as $value) {

            $list .= '<li>' . $value['product_category_name'] . ' (' . $this->products_model->product_number_in_category($value['product_category_id']) . ')';
            $list .= '<ul>';

            $sub_result = $this->product_categories_model->get_subcategory($value['product_category_id']);

            foreach ($sub_result as $sub_value) {

                $list .= '<li>' . $sub_value['product_category_name'] . ' (' . $this->products_model->product_number_in_category($sub_value['product_category_id']) . ')';
                $list .= '<ul>';
                $sub_sub_result = $this->product_categories_model->get_subcategory($sub_value['product_category_id']);

                foreach ($sub_sub_result as $sub_sub_value) {
                    $list .= '<li>' . $sub_sub_value['product_category_name'] . ' (' . $this->products_model->product_number_in_category($sub_sub_value['product_category_id']) . ')';
                    $list .= '<ul>';
                    $sub_sub_sub_result = $this->product_categories_model->get_subcategory($sub_sub_value['product_category_id']);
                    foreach ($sub_sub_sub_result as $sub_sub_sub_value) {
                        $list .= '<li>' . $sub_sub_sub_value['product_category_name'] . ' (' . $this->products_model->product_number_in_category($sub_sub_sub_value['product_category_id']) . ')' . '</li>';
                    }

                    $list .= '</ul>';
                    $list .= '</li>';
                }
                $list .= '</ul>';
                $list .= '</li>';
            }
            $list .= '</ul>';
            $list .= '</li>';
        }
        $list .= '</ul>';

        return $list;
    }


    /**
     * Termékekek száma kategóriában és az alá tartozó kategóriákban    
     *
     * @param integer $cat_id kategória id-je
     * @return int a termékek száma
     */
    private function _get_product_count($cat_id)
    {
        $count = $this->products_model->product_number_in_category($cat_id);

        $children = $this->product_categories_model->get_children($cat_id);
        if (!empty($children)) {
            foreach ($children as $value) {
                $count = $count + $this->products_model->product_number_in_category($value);
                $sub_children = $this->product_categories_model->get_children($value);
                if (!empty($sub_children)) {
                    foreach ($sub_children as $sub_value) {
                        $count = $count + $this->products_model->product_number_in_category($sub_value);
                        $sub_sub_children = $this->product_categories_model->get_children($sub_value);
                        if (!empty($sub_sub_children)) {
                            foreach ($sub_sub_children as $sub_sub_value) {
                                $count = $count + $this->products_model->product_number_in_category($sub_sub_value);
                            }
                        }
                    }
                }
            }
        }

        return $count;
    }
    
}
?>
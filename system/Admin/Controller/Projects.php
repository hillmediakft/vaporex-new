<?php
namespace System\Admin\Controller;
use System\Core\AdminController;
use System\Core\View;
use System\Libs\Auth;
use System\Libs\Config;
use System\Libs\Message;
use System\Libs\DI;
use System\Libs\Uploader;

class Projects extends AdminController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('projects_model');
        $this->loadModel('project_categories_model');
    }

    /**
     * index metódus
     */
    public function index()
    {
        Auth::hasAccess('projects.index', $this->request->get_httpreferer());

        $data['title'] = 'Termékek oldal';
        $data['description'] = 'Termékek oldal description';
        $data['all_projects'] = $this->projects_model->allProjects();

        $view = new View();
        $view->setHelper(array('url_helper'));
        $view->add_links(array('datatable', 'bootbox', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/projects.js');
        $view->render('projects/tpl_projects', $data);
    }

    /**
     * 	Termék minden adatának megjelenítése
     */
    public function view_project($id)
    {
        $id = (int)$id;
        $data['title'] = 'Admin termék részletek oldal';
        $data['description'] = 'Admin termék részletek oldal description';
        
        $data['content'] = $this->projects_model->oneProjectAlldata($id);

        $view = new View();
        $view->add_link('js', ADMIN_JS . 'pages/common.js');
        $view->render('projects/tpl_project_view', $data);
    }

    /**
     * 	Termék minden adatának megjelenítése Ajax-szal
     */
    public function view_project_ajax()
    {
        if ($this->request->is_ajax()) {
            $data['content'] = $this->projects_model->oneProjectAlldata_ajax();

            $view = new View();
            $view->set_layout(null);
            $view->render('projects/tpl_project_view_modal', $data);
        } else {
            $this->response->redirect('admin/error');
        }
    }

    /**
     * (AJAX) Az products táblában módosítja a project_status mező értékét
     *
     * @return void
     */
    public function change_status()
    {
        if ( $this->request->is_ajax() ) {
            // jogosultság vizsgálat
            if (!Auth::hasAccess('projects.change_status')) {
                $this->response->json(array(
                    "status" => 'error',
                    "message" => 'Nincs engedélye a művelet végrehajtásához.'
                ));         
            }               
            
            if ( $this->request->has_post('action') && $this->request->has_post('id') ) {
            
                $id = $this->request->get_post('id', 'integer');
                $action = $this->request->get_post('action');

                if($action == 'make_active') {
                    $result = $this->projects_model->changeStatus($id, 1);
                    if($result !== false){
                        $this->response->json(array(
                            "status" => 'success',
                            "message" => 'A projekt aktiválása megtörtént!'
                        ));     
                    } else {
                        $this->response->json(array(
                            "status" => 'error',
                            "message" => 'Adatbázis hiba! A projekt státusza nem változott meg!'
                        ));
                    }
                }
                if($action == 'make_inactive') {
                    $result = $this->projects_model->changeStatus($id, 0);
                    if($result !== false){
                        $this->response->json(array(
                            "status" => 'success',
                            "message" => 'A projekt blokkolása megtörtént!'
                        ));     
                    } else {
                        $this->response->json(array(
                            "status" => 'error',
                            "message" => 'Adatbázis hiba! A projekt státusza nem változott meg!'
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
     * 	Új termék hozzáadása
     */
    public function new_project()
    {
        Auth::hasAccess('projects.new_project', $this->request->get_httpreferer());

        // új referencia hozzáadása
        if ($this->request->is_post()) {
            
            if (empty($this->request->get_post('img_url'))) {
                $data['project_photo'] = Config::get('projectphoto.default_photo');
            } else {
                $path_parts = pathinfo($this->request->get_post('img_url'));
                $data['project_photo'] = $path_parts['filename'] . '.' . $path_parts['extension'];
            }

            $data['project_title'] = $this->request->get_post('project_title');
            $data['project_description'] = $this->request->get_post('project_description');
            $data['project_category_id'] = $this->request->get_post('project_category_id', 'integer');
            $data['project_status'] = $this->request->get_post('project_status', 'integer');
            //létrehozás dátuma timestamp
            $data['project_create_timestamp'] = time();
            
            $error_counter = 0;
            //megnevezés ellenőrzése    
            if (empty($data['project_title'])) {
                $error_counter++;
                Message::set('error', 'A referencia magyar megnevezése nem lehet üres!');
            }
            if (empty($data['project_category_id'])) {
                $error_counter++;
                Message::set('error', 'Választani kell egy kategóriát!');
            }

            if ($error_counter != 0) {
                $this->response->redirect('admin/projects/new_project');
            }

            // új adatok az adatbázisba
            $result = $this->projects_model->insert($data);

            if ($result !== false) {
                Message::set('success', 'Referencia sikeresen hozzáadva.');
                $this->response->redirect('admin/projects');
            } else {
                Message::set('error', 'Adatbázis lekérdezési hiba!');
                $this->response->redirect('admin/projects/new_project');
            }

        }

        $data['title'] = 'Új refrencia oldal';
        $data['description'] = 'Új refrencia description';

        $data['project_category_list'] = $this->project_categories_model->selectAllCategories();

        $view = new View();
        $view->add_links(array('bootstrap-fileupload', 'croppic', 'ckeditor', 'validation', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/new_project.js');
        $view->render('projects/tpl_new_project', $data);
    }

    /**
     * DELETE referencia
     */
    public function delete()
    {
        if($this->request->is_ajax()){

            if(!Auth::hasAccess('projects.delete')){
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
                //lekérdezzük a törlendő record képének a nevét, hogy törölhessük a szerverről
                $photo_name = $this->projects_model->selectPicture($id);
                
                // referencia törlése  
                $result = $this->projects_model->delete($id);
                
                if($result !== false) {
                    // ha a törlési sql parancsban nincs hiba
                    if($result > 0){
                        //ha van feltöltött kép
                        if(!empty($photo_name)){
                            $picture_path = Config::get('projectphoto.upload_path') . $photo_name;
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
                $respond['message_success'] = $success_counter . ' referencia törölve.';
            }
            if ($fail_counter > 0) {
                $respond['message_error'] = $fail_counter . ' referenciát már töröltek!';
            }

            // respond tömb visszaadása
            $this->response->json($respond);

        }    
    } 

    /**
     * 	Termék módosítása
     */
    public function update_project($id)
    {
        $id = (int)$id;

        if ($this->request->is_post()) {

            $data['project_title'] = $this->request->get_post('project_title');
            $data['project_description'] = $this->request->get_post('project_description');
            $data['project_category_id'] = $this->request->get_post('project_category_id', 'integer');
            $data['project_status'] = $this->request->get_post('project_status', 'integer');
            // módosítás dátuma timestamp formátumban
            $data['project_update_timestamp'] = time();

            $img_url = $this->request->get_post('img_url');
            $old_img_path = $this->request->get_post('old_img');

            if (!empty($img_url)) {
                $path_parts = pathinfo($img_url);
                $data['project_photo'] = $path_parts['filename'] . '.' . $path_parts['extension'];

                $old_img_path_parts = pathinfo($old_img_path);
                $old_img_name = $old_img_path_parts['filename'] . '.' . $old_img_path_parts['extension'];

                //megnézzük, hogy a régi kép a default-e, mert azt majd nem akarjuk törölni
                if ($old_img_name == Config::get('projectphoto.default_photo')) {
                    $default_photo = true;
                } else {
                    $default_photo = false;
                    $old_thumb_path = DI::get('url_helper')->thumbPath($old_img_path);
                }
            }

            $error_counter = 0;
            //megnevezés ellenőrzése    
            if (empty($data['project_title'])) {
                $error_counter++;
                Message::set('error', 'A termék magyar megnevezése nem lehet üres!');
            }
            if (empty($data['project_category_id'])) {
                $error_counter++;
                Message::set('error', 'Választani kell egy kategóriát!');
            }

            if ($error_counter != 0) {
                $this->response->redirect('admin/projects/update_project/' . $id);
            }

            // új adatok az adatbázisba
            $result = $this->projects_model->update($id, $data);

            if ($result !== false) {
              // megvizsgáljuk, hogy létezik-e új feltöltött kép és a régi kép, nem a default
                if (!empty($img_url) && $default_photo === false) {
                    //régi képek törlése
                    DI::get('file_helper')->delete(array($old_img_path, $old_thumb_path));
                }

                $this->response->redirect('admin/projects');
            } else {
                $this->response->redirect('admin/projects/update_project/' . $id);
            }
        }

        $data['title'] = 'Termék módosítása oldal';
        $data['description'] = 'Termék módosítása description';

        $data['actual_project'] = $this->projects_model->selectOneProject($id);
        $data['project_category_list'] = $this->project_categories_model->selectAllCategories();

        $view = new View();
        $view->add_links(array('bootstrap-fileupload', 'croppic', 'ckeditor', 'validation', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/edit_project.js');
        $view->render('projects/tpl_project_update', $data);
    }


/* ----------------- */



    /**
     * 	Kategóriák megjelenítése
     */
    public function category()
    {
        $data['title'] = 'Admin referencia kategóriák kategória oldal';
        $data['description'] = 'Admin referencia kategóriák description';

        $data['all_projects_category'] = $this->project_categories_model->selectAllCategories();
        $data['category_counter'] = $this->projects_model->categoryCounter();

        $view = new View();
        $view->add_links(array('datatable', 'bootbox', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/project_category.js');
        $view->render('projects/tpl_project_category', $data);
    }

    /**
     * 	Kategória hozzáadása
     */
    public function category_insert()
    {
        if ($this->request->is_post()) {

            $data['project_category_name'] = $this->request->get_post('project_category_name');
           
            //ha üresen küldték el a formot
            if (empty($data['project_category_name'])) {
                Message::set('error', 'Meg kell adni a kategória magyar nevét!');
                $this->response->redirect('admin/projects/category_insert');
            }

            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->project_categories_model->selectAllCategories();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                $data['project_category_name'] = trim($data['project_category_name']);
                if (strtolower($data['project_category_name']) == strtolower($value['project_category_name'])) {
                    Message::set('error', 'category_already_exists');
                    $this->response->redirect('admin/projects/category_insert');
                }
            }

            // adatbázis lekérdezés 
            $result = $this->project_categories_model->insert($data);

            if ($result !== false) {
                Message::set('success', 'category_created');
                $this->response->redirect('admin/projects/category');
            } else {
                Message::set('error', 'unknown_error');
                $this->response->redirect('admin/projects/category_insert');
            }
        }

        $data['title'] = 'Újreferencia kategória hozzáadása oldal';
        $data['description'] = 'Új referencia kategória description';
        $data['project_category_list'] = $this->project_categories_model->selectAllCategories();

        $view = new View();
        $view->add_links(array('validation', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/project_category_insert_update.js');
        $view->render('projects/tpl_project_category_insert', $data);
    }

    /**
     * 	Kategória módosítása
     */
    public function category_update($id)
    {
        $id = (int)$id;

        if ($this->request->is_post()) {

            $data['project_category_name'] = $this->request->get_post('project_category_name');
           
            //ha üresen küldték el a formot
            if (empty($data['project_category_name'])) {
                Message::set('error', 'Meg kell adni a kategória nevét!');
                $this->response->redirect('admin/projects/category_update/' . $id);
            }

            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->project_categories_model->selectAllCategories();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                $data['project_category_name'] = trim($data['project_category_name']);
                if (strtolower($data['project_category_name']) == strtolower($value['project_category_name']) && $id != $value['project_category_id']) {
                    Message::set('error', 'category_already_exists');
                    $this->response->redirect('admin/projects/category_update/' . $id);
                }
            }

            // adatok adabázisba írása
            $result = $this->project_categories_model ->update($id, $data);

            if ($result !== false) {
                Message::set('success', 'category_updated');
                $this->response->redirect('admin/projects/category');
            } else {
                Message::set('error', 'unknown_error');
                $this->response->redirect('admin/projects/category_update/' . $id);
            }
        }

        $data['title'] = 'Admin termék kategória módosítása oldal';
        $data['description'] = 'Admin termék kategória módosítása description';

        $data['project_category_list'] = $this->project_categories_model->selectAllCategories();
        $data['category_content'] = $this->project_categories_model->selectOneCategory($id);

        $view = new View();
        $view->add_links(array('validation', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/project_category_insert_update.js');
        $view->render('projects/tpl_project_category_update', $data);
    }


    /**
     * DELETE - Kategória törlése
     */
    public function category_delete()
    {
        if($this->request->is_ajax()){

            if(!Auth::hasAccess('projects.category_delete')){
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

            // bejárjuk a $id_arr tömböt és minden elemen végrehajtjuk a törlést
            foreach($id_arr as $id) {
                //átalakítjuk a integer-ré a kapott adatot
                $id = (int)$id;

                // ha a kategória nem törölhető
                if (!$this->projects_model->is_category_deletable($id)) {
                    $this->response->json(array(
                        'status' => 'error',
                        'message_error' => 'A kategória nem törölhető! A kategória referenciát tartalmaz!',                  
                    ));
                }
                 
                //kategória törlése  
                $result = $this->project_categories_model->delete($id);
                
                if($result !== false) {
                    // ha a törlési sql parancsban nincs hiba
                    if($result > 0){
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
                $respond['message_success'] = 'Kategória törölve.';
            }
            if ($fail_counter > 0) {
                $respond['message_error'] = 'A kategóriát már törölték!';
            }

            // respond tömb visszaadása
            $this->response->json($respond);

        }    
    } 



    /**
     * Termékekek száma kategóriában és az alá tartozó kategóriákban    
     *
     * @param integer $cat_id kategória id-je
     * @return int a termékek száma
     */
    public function get_project_count($cat_id)
    {
        $count = $this->projects_model->project_number_in_category($cat_id);

        $children = $this->project_categories_model->get_children($cat_id);
        if (!empty($children)) {
            foreach ($children as $value) {
                $count = $count + $this->projects_model->project_number_in_category($value);
                $sub_children = $this->project_categories_model->get_children($value);
                if (!empty($sub_children)) {
                    foreach ($sub_children as $sub_value) {
                        $count = $count + $this->projects_model->project_number_in_category($sub_value);
                        $sub_sub_children = $this->project_categories_model->get_children($sub_value);
                        if (!empty($sub_sub_children)) {
                            foreach ($sub_sub_children as $sub_sub_value) {
                                $count = $count + $this->projects_model->project_number_in_category($sub_sub_value);
                            }
                        }
                    }
                }
            }
        }

        return $count;
    }

    /**
     * 	A referencia képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     */
    public function project_crop_img_upload($parameter)
    {
        if ($this->request->is_ajax()) {

            // feltöltés helye
            $upload_path = Config::get('projectphoto.upload_path');
            // Kiválasztott kép feltöltése

            if ($parameter == 'upload') {
                //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül) 
                $image = new Uploader($this->request->getFiles('img'));
                $tempfilename = 'temp_' . uniqid();
                $image->allowed(array('image/*'));
                $image->resize(Config::get('projectphoto.width', 400), null);
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
                $newfilename = 'project_' . md5(uniqid());
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
                    $thumb_width = Config::get('projectphoto.thumb_width', 100);
                    $thumb_height = Config::get('projectphoto.thumb_height', 75);
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


}
?>
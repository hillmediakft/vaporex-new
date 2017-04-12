<?php
namespace System\Admin\Controller;
use System\Core\AdminController;
use System\Core\View;
use System\Libs\Auth;
use System\Libs\Config;
use System\Libs\DI;

class Projects extends AdminController {

    function __construct() {
        parent::__construct();
        $this->loadModel('projects_model');
        $this->loadModel('product_categories_model');
    }

    /**
     * index metódus
     *
     * 
     */
    public function index()
    {
        Auth::hasAccess('projects.index', $this->request->get_httpreferer());

        $data['title'] = 'Termékek oldal';
        $data['description'] = 'Termékek oldal description';
        $data['all_projects'] = $this->projects_model->all_projects_query();

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
        
        $data['content'] = $this->projects_model->one_project_alldata_query($id);

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
            $data['content'] = $this->projects_model->one_project_alldata_query_ajax();

            $view = new View();
            $view->set_layout(null);
            $view->render('projects/tpl_project_view_modal', $data);
        } else {
            $this->response->redirect('admin/error');
        }
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
        // új termék hozzáadása
        if ($this->request->is_post()) {
            


            $result = $this->projects_model->insert_project();
            if ($result) {
                Util::redirect('projects');
            } else {
                Util::redirect('projects/new_project');
            }

        }

        $data['title'] = 'Új refrencia oldal';
        $data['description'] = 'Új refrencia description';

        $data['project_category_list'] = $this->projects_model->category_list_query();

        $view = new View();
        $view->add_links(array('bootstrap-fileupload', 'croppic', 'ckeditor', 'validation', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/new_project.js');
        $view->render('projects/tpl_new_project', $data);
    }

    /**
     * 	Termék törlése
     *
     */
    public function delete_project() {
        // ez a metódus true-val tér vissza (false esetén kivételt dob!)
        $this->projects_model->delete_project();
        Util::redirect('projects');
    }


    /**
     * DELETE
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
                //lekérdezzük a törlendő blog képének a nevét, hogy törölhessük a szerverről
                $photo_name = $this->projects_model->selectPicture($id);
                
                //blog törlése  
                $result = $this->projects_model->delete($id);
                
                if($result !== false) {
                    // ha a törlési sql parancsban nincs hiba
                    if($result > 0){
                        //ha van feltöltött képe a bloghoz (az adatbázisban szerepel a file-név)
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
     * 	Termék módosítása
     *
     */
    public function update_project() {
        if (!empty($_POST)) {
            $result = $this->projects_model->update_project($this->registry->params['id']);

            if ($result) {
                Util::redirect('projects');
            } else {
                Util::redirect('projects/update_project/' . $this->registry->params['id']);
            }
        }

        // HTML oldal megjelenítése
        // adatok bevitele a view objektumba
        $this->view->title = 'Termék módosítása oldal';
        $this->view->description = 'Termék módosítása description';
        $this->view->css_link[] = $this->make_link('css', ADMIN_ASSETS, 'plugins/bootstrap-fileupload/bootstrap-fileupload.css');
        $this->view->css_link[] = $this->make_link('css', ADMIN_ASSETS, 'plugins/croppic/croppic.css');
        // js linkek generálása
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/croppic/croppic.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/bootstrap-fileupload/bootstrap-fileupload.js');
                //form validator	
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');

        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/edit_project.js');

        // ck_editor bekapcsolása
        $this->view->ckeditor = true;

        // a módosítandó termék adatai
        $this->view->actual_project = $this->projects_model->one_project_query($this->registry->params['id']);

        $this->view->project_photo = $this->view->actual_project[0]['project_photo'];

        $this->view->project_category_list = $this->projects_model->category_list_query();

        $this->view->render('projects/tpl_project_update');
    }

/**
     * 	Munka kategóriák megjelenítése
     */
    public function category() {

        // adatok bevitele a view objektumba
        $this->view->title = 'Admin referencia kategóriák kategória oldal';
        $this->view->description = 'Admin referencia kategóriák description';

        $this->view->css_link[] = $this->make_link('css', ADMIN_ASSETS, 'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');

        // az oldalspecifikus javascript linkeket berakjuk a view objektum js_link tulajdonságába (ami egy tömb)
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/datatables/media/js/jquery.dataTables.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/bootbox/bootbox.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'datatable.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/project_category.js');

        $this->view->all_projects_category = $this->projects_model->project_categories_query();
        
        $this->view->category_counter = $this->projects_model->project_category_counter_query();

//$this->view->debug(true);			

        $this->view->render('projects/tpl_project_category');
    }

    /**
     * 	Új termék kategória hozzáadása
     */
    public function category_insert() {

        if (isset($_POST['project_category_name'])) {

            $result = $this->projects_model->category_insert();

            if ($result) {
                Util::redirect('projects/category');
            } else {
                Util::redirect('projects/category_insert');
            }
        }

        $this->view->title = 'Újreferencia kategória hozzáadása oldal';
        $this->view->description = 'Új referencia kategória description';
                //form validator	
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/project_category_insert_update.js');
        //$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');	
        // termék kategóriák lekérdezése az option listához
        $this->view->project_category_list = $this->projects_model->project_categories_query();

        // template betöltése
        $this->view->render('projects/tpl_project_category_insert');
    }

    /**
     * 	Termék kategória módosítása
     */
    public function category_update() {
        if (isset($_POST['project_category_name'])) {
            $result = $this->projects_model->category_update($this->registry->params['id']);
            if ($result) {
                Util::redirect('projects/category');
            } else {
                Util::redirect('projects/category_update/' . $this->registry->params['id']);
            }
        }

        $this->view->title = 'Admin termék kategória módosítása oldal';
        $this->view->description = 'Admin termék kategória módosítása description';

        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/project_category_insert_update.js');


        //$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');	   
        $this->view->project_category_list = $this->projects_model->project_categories_query();
        $this->view->category_content = $this->projects_model->one_project_category($this->registry->params['id']);

        $this->view->render('projects/tpl_project_category_update');
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete() {

        $this->projects_model->delete_category();
        Util::redirect('projects/category');
    }


    /**
     * 	A termék képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function project_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->projects_model->project_crop_img_upload();
        }
    }

    /**
     * 	A termék kategória képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function project_category_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->projects_model->project_category_crop_img_upload();
        }
    }

}

?>
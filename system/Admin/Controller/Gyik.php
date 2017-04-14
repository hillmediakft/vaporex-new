<?php
namespace System\Admin\Controller;
use System\Core\AdminController;
use System\Core\View;
use System\Libs\Auth;

class Gyik extends AdminController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('gyik_model');
        $this->loadModel('gyikCategory_model');
    }

    /**
     * index metódus
     */
    public function index()
    {
        Auth::hasAccess('gyik.index', $this->request->get_httpreferer());

        $data['title'] = 'GYIK oldal';
        $data['description'] = 'GYIK oldal description';
        $data['all_gyik'] = $this->gyik_model->all_gyik_query();

        $view = new View();
        $view->add_links(array('datatable', 'bootbox', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/gyik.js');
        $view->render('gyik/tpl_gyik', $data);
    }

    /**
     * 	Termék minden adatának megjelenítése
     */
    public function view_gyik($id)
    {
        $id = (int)$id;    
        $data['title'] = 'Admin termék részletek oldal';
        $data['description'] = 'Admin termék részletek oldal description';
        $data['content'] = $this->gyik_model->one_gyik_alldata_query($id);

        $view = new View();
        $view->add_link('js', ADMIN_JS . 'pages/common.js');
        $view->render('gyik/tpl_gyik_view', $data);
    }

    /**
     * 	Termék minden adatának megjelenítése Ajax-szal
     */
    public function view_gyik_ajax()
    {
        if ($this->request->is_ajax()) {
            $data['content'] = $this->gyik_model->one_gyik_alldata_query_ajax();

            $view = new View();
            $view->set_layout(null);
            $view->render('gyik/tpl_gyik_view_modal', $data);
        } else {
            $this->response->redirect('admin/error');
        }
    }

    /**
     * 	Új gyik hozzáadása
     */
    public function new_gyik()
    {
        if ($this->request->is_post()) {

            $data['gyik_title'] = $this->request->get_post('gyik_title');
            $data['gyik_description'] = $this->request->get_post('gyik_description');
            $data['gyik_category_id'] = $this->request->get_post('gyik_category_id', 'integer');
            $data['gyik_status'] = $this->request->get_post('gyik_status', 'integer');
            //létrehozás dátuma timestamp
            $data['gyik_create_timestamp'] = time();


            $error_counter = 0;
            //megnevezés ellenőrzése    
            if (empty($data['gyik_title'])) {
                $error_counter++;
                Message::set('error', 'A referencia magyar megnevezése nem lehet üres!');
            }
            if (empty($data['gyik_category_id'])) {
                $error_counter++;
                Message::set('error', 'Választani kell egy kategóriát!');
            }

            if ($error_counter != 0) {
                $this->response->redirect('admin/gyik/new_gyik');
            }

            // új adatok az adatbázisba
            $result = $this->gyik_model->insert($data);

            if ($result !== false) {
                Message::set('success', 'Referencia sikeresen hozzáadva.');
                $this->response->redirect('admin/gyik');
            } else {
                Message::set('error', 'Adatbázis lekérdezési hiba!');
                $this->response->redirect('admin/gyik/new_gyik');
            }
        }

        $data['title'] = 'Új refrencia oldal';
        $data['description'] = 'Új refrencia description';
        $data['gyik_category_list'] = $this->gyik_model->category_list_query();

        $view = new View();
        $view->add_links(array('validation', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/new_gyik.js');
        $view->render('gyik/tpl_new_gyik', $data);
    }

    /**
     * 	Termék törlése
     *
     */
    public function delete_gyik() {
        // ez a metódus true-val tér vissza (false esetén kivételt dob!)
        $this->gyik_model->delete_gyik();
        Util::redirect('gyik');
    }

    /**
     * 	UPDATE
     */
    public function update_gyik($id)
    {
        $id = (int)$id;

        if ($this->request->is_post()) {

            $data['gyik_title'] = $this->request->get_post('gyik_title');
            $data['gyik_description'] = $this->request->get_post('gyik_description');
            $data['gyik_category_id'] = $this->request->get_post('gyik_category_id', 'integer');
            $data['gyik_status'] = $this->request->get_post('gyik_status', 'integer');
            // módosítás dátuma timestamp formátumban
            $data['gyik_update_timestamp'] = time();


            $error_counter = 0;
            //megnevezés ellenőrzése    
            if (empty($data['gyik_title'])) {
                $error_counter++;
                Message::set('error', 'A termék magyar megnevezése nem lehet üres!');
            }
            if (empty($data['gyik_category_id'])) {
                $error_counter++;
                Message::set('error', 'Választani kell egy kategóriát!');
            }

            if ($error_counter != 0) {
                $this->response->redirect('admin/gyik/update_gyik/' . $id);
            }

            // új adatok az adatbázisba
            $result = $this->gyik_model->update($id, $data);

            if ($result !== false) {
                Message::set('success', 'Gyik adatai sikeresen módosítva.');
                $this->response->redirect('admin/gyik');
            } else {
                Message::set('error', 'Adatbázis lekérdezési hiba!');
                $this->response->redirect('admin/gyik/update_gyik/' . $id);
            }
        }

        $data['title'] = 'Termék módosítása oldal';
        $data['description'] = 'Termék módosítása description';
        $data['actual_gyik'] = $this->gyik_model->one_gyik_query($id);
        $data['gyik_category_list'] = $this->gyik_model->category_list_query();

        $view = new View();
        $view->add_links(array('validation', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/edit_gyik.js');
        $view->render('gyik/tpl_gyik_update', $data);
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
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/gyik_category.js');

        $this->view->all_gyik_category = $this->gyik_model->gyik_categories_query();
        
        $this->view->category_counter = $this->gyik_model->gyik_category_counter_query();

//$this->view->debug(true);			

        $this->view->render('gyik/tpl_gyik_category');
    }

    /**
     * 	Új termék kategória hozzáadása
     */
    public function category_insert() {

        if (isset($_POST['gyik_category_name'])) {

            $result = $this->gyik_model->category_insert();

            if ($result) {
                Util::redirect('gyik/category');
            } else {
                Util::redirect('gyik/category_insert');
            }
        }

        $this->view->title = 'Újreferencia kategória hozzáadása oldal';
        $this->view->description = 'Új referencia kategória description';
                //form validator	
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/gyik_category_insert_update.js');
        //$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');	
        // termék kategóriák lekérdezése az option listához
        $this->view->gyik_category_list = $this->gyik_model->gyik_categories_query();

        // template betöltése
        $this->view->render('gyik/tpl_gyik_category_insert');
    }

    /**
     * 	Termék kategória módosítása
     */
    public function category_update() {
        if (isset($_POST['gyik_category_name'])) {
            $result = $this->gyik_model->category_update($this->registry->params['id']);
            if ($result) {
                Util::redirect('gyik/category');
            } else {
                Util::redirect('gyik/category_update/' . $this->registry->params['id']);
            }
        }

        $this->view->title = 'Admin termék kategória módosítása oldal';
        $this->view->description = 'Admin termék kategória módosítása description';

        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/gyik_category_insert_update.js');


        //$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');	   
        $this->view->gyik_category_list = $this->gyik_model->gyik_categories_query();
        $this->view->category_content = $this->gyik_model->one_gyik_category($this->registry->params['id']);

        $this->view->render('gyik/tpl_gyik_category_update');
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete() {

        $this->gyik_model->delete_category();
        Util::redirect('gyik/category');
    }

    /**
     * (AJAX) A gyik táblában módosítja az gyik_status mező értékét
     *
     * @return void
     */
    public function change_status() {
        if (Util::is_ajax()) {
            if (isset($_POST['action']) && isset($_POST['id'])) {

                $id = (int) $_POST['id'];

                if ($_POST['action'] == 'make_active') {
                    $this->gyik_model->change_status_query($id, 1);
                }
                if ($_POST['action'] == 'make_inactive') {
                    $this->gyik_model->change_status_query($id, 0);
                }
            }
        } else {
            Util::redirect('error');
        }
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
    public function gyik_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->gyik_model->gyik_crop_img_upload();
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
    public function gyik_category_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->gyik_model->gyik_category_crop_img_upload();
        }
    }

}

?>
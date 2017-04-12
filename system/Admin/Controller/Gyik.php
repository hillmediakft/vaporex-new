<?php

/**
 * Class gyik
 *
 * @author Várnagy Attila
 * 
 */
class Gyik extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        require_once "system/libs/logged_in_user.php";
        $this->user = new Logged_in_user();
        $this->check_access("menu_gyik");
        $this->view->user = $this->user;
        $this->loadModel('gyik_model');
    }

    /**
     * index metódus
     *
     * 
     */
    public function index() {
        $this->view->title = 'GYIK oldal';
        $this->view->description = 'GYIK oldal description';

        // az oldalspecifikus css linkeket berakjuk a view objektum css_link tulajdonságába (ami egy tömb)
        // a make_link() metódus az anyakontroller metódusa (így egyszerűen meghívható bármelyik kontrollerben)
        $this->view->css_link[] = $this->make_link('css', ADMIN_ASSETS, 'plugins/select2/select2.css');
        $this->view->css_link[] = $this->make_link('css', ADMIN_ASSETS, 'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');

        // az oldalspecifikus javascript linkeket berakjuk a view objektum js_link tulajdonságába (ami egy tömb)
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/select2/select2.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/datatables/media/js/jquery.dataTables.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/bootbox/bootbox.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'datatable.js');

        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/gyik.js');

        $this->view->all_gyik = $this->gyik_model->all_gyik_query();

        $this->view->render('gyik/tpl_gyik');
    }

    /**
     * 	Termék minden adatának megjelenítése
     */
    public function view_gyik() {
        $this->view->title = 'Admin termék részletek oldal';
        $this->view->description = 'Admin termék részletek oldal description';
        // az oldalspecifikus css linkeket berakjuk a view objektum css_link tulajdonságába (ami egy tömb)
        // az oldalspecifikus javascript linkeket berakjuk a view objektum js_link tulajdonságába (ami egy tömb)
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');

        $this->view->content = $this->gyik_model->one_gyik_alldata_query($this->registry->params['id']);

        $this->view->render('gyik/tpl_gyik_view');
    }

    /**
     * 	Termék minden adatának megjelenítése Ajax-szal
     */
    public function view_gyik_ajax() {
        if (Util::is_ajax()) {
            $this->view->content = $this->gyik_model->one_gyik_alldata_query_ajax();


            $this->view->render('gyik/tpl_gyik_view_modal', true);
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Új termék hozzáadása
     */
    public function new_gyik() {
        // új termék hozzáadása
        if (!empty($_POST)) {
            $result = $this->gyik_model->insert_gyik();
            if ($result) {
                Util::redirect('gyik');
            } else {
                Util::redirect('gyik/new_gyik');
            }
        }

        $this->view->title = 'Új refrencia oldal';
        $this->view->description = 'Új refrencia description';

       
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/ckeditor/ckeditor.js');
        //form validator	
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');

        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/new_gyik.js');

// termék kategóriák lekérdezése az option listához
        $this->view->gyik_category_list = $this->gyik_model->category_list_query();
        //       $this->view->gyik_category_list_with_path = $this->category->gyik_categories_with_path($this->view->gyik_category_list);
        // template betöltése
        $this->view->render('gyik/tpl_new_gyik');
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
     * 	Termék módosítása
     *
     */
    public function update_gyik() {
        if (!empty($_POST)) {
            $result = $this->gyik_model->update_gyik($this->registry->params['id']);

            if ($result) {
                Util::redirect('gyik');
            } else {
                Util::redirect('gyik/update_gyik/' . $this->registry->params['id']);
            }
        }

        // HTML oldal megjelenítése
        // adatok bevitele a view objektumba
        $this->view->title = 'Termék módosítása oldal';
        $this->view->description = 'Termék módosítása description';
        // js linkek generálása
                //form validator	
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/ckeditor/ckeditor.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/edit_gyik.js');

        // a módosítandó termék adatai
        $this->view->actual_gyik = $this->gyik_model->one_gyik_query($this->registry->params['id']);

        $this->view->gyik_category_list = $this->gyik_model->category_list_query();

        $this->view->render('gyik/tpl_gyik_update');
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
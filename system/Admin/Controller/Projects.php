<?php

/**
 * Class projects
 *
 * @author Várnagy Attila
 * 
 */
class Projects extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        require_once "system/libs/logged_in_user.php";
        $this->user = new Logged_in_user();
        $this->check_access("menu_referenciak");
        $this->view->user = $this->user;
        $this->loadModel('projects_model');
        $this->loadClass('category');
    }

    /**
     * index metódus
     *
     * 
     */
    public function index() {
        $this->view->title = 'Termékek oldal';
        $this->view->description = 'Termékek oldal description';

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

        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/projects.js');

        $this->view->all_projects = $this->projects_model->all_projects_query();

        $this->view->render('projects/tpl_projects');
    }

    /**
     * 	Termék minden adatának megjelenítése
     */
    public function view_project() {
        $this->view->title = 'Admin termék részletek oldal';
        $this->view->description = 'Admin termék részletek oldal description';
        // az oldalspecifikus css linkeket berakjuk a view objektum css_link tulajdonságába (ami egy tömb)
        // az oldalspecifikus javascript linkeket berakjuk a view objektum js_link tulajdonságába (ami egy tömb)
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');

        $this->view->content = $this->projects_model->one_project_alldata_query($this->registry->params['id']);

        $this->view->render('projects/tpl_project_view');
    }

    /**
     * 	Termék minden adatának megjelenítése Ajax-szal
     */
    public function view_project_ajax() {
        if (Util::is_ajax()) {
            $this->view->content = $this->projects_model->one_project_alldata_query_ajax();


            $this->view->render('projects/tpl_project_view_modal', true);
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Új termék hozzáadása
     */
    public function new_project() {
        // új termék hozzáadása
        if (!empty($_POST)) {
            $result = $this->projects_model->insert_project();
            if ($result) {
                Util::redirect('projects');
            } else {
                Util::redirect('projects/new_project');
            }
        }

        $this->view->title = 'Új refrencia oldal';
        $this->view->description = 'Új refrencia description';

        $this->view->css_link[] = $this->make_link('css', ADMIN_ASSETS, 'plugins/bootstrap-fileupload/bootstrap-fileupload.css');
        $this->view->css_link[] = $this->make_link('css', ADMIN_ASSETS, 'plugins/croppic/croppic.css');
        // js linkek generálása
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/croppic/croppic.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/bootstrap-fileupload/bootstrap-fileupload.js');
        
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/ckeditor/ckeditor.js');
        //form validator	
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/jquery.validate.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/dist/additional-methods.min.js');
        $this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/jquery-validation/localization/messages_hu.js');

        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/new_project.js');

// termék kategóriák lekérdezése az option listához
        $this->view->project_category_list = $this->projects_model->category_list_query();
        //       $this->view->project_category_list_with_path = $this->category->project_categories_with_path($this->view->project_category_list);
        // template betöltése
        $this->view->render('projects/tpl_new_project');
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
     * (AJAX) A projects táblában módosítja az project_status mező értékét
     *
     * @return void
     */
    public function change_status() {
        if (Util::is_ajax()) {
            if (isset($_POST['action']) && isset($_POST['id'])) {

                $id = (int) $_POST['id'];

                if ($_POST['action'] == 'make_active') {
                    $this->projects_model->change_status_query($id, 1);
                }
                if ($_POST['action'] == 'make_inactive') {
                    $this->projects_model->change_status_query($id, 0);
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
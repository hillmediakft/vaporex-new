<?php
namespace System\Admin\Controller;
use System\Core\AdminController;
use System\Core\View;
use System\Libs\Auth;
use System\Libs\Message;

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
        $data['all_gyik'] = $this->gyik_model->allGyik();

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
        $data['gyik'] = $this->gyik_model->oneGyik($id);
//var_dump($data);die;
        $view = new View();
        $view->add_link('js', ADMIN_JS . 'pages/common.js');
        $view->render('gyik/tpl_gyik_view', $data);
    }

    /**
     * 	Termék minden adatának megjelenítése Ajax-szal
     */
    public function view_gyik_ajax($id)
    {
        if ($this->request->is_ajax()) {
            $id = (int)$id;
            $data['content'] = $this->gyik_model->oneGyik($id, 'ajax');
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
    public function insert()
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
                $this->response->redirect('admin/gyik/insert');
            }

            // új adatok az adatbázisba
            $result = $this->gyik_model->insert($data);

            if ($result !== false) {
                Message::set('success', 'Kérdés sikeresen hozzáadva.');
                $this->response->redirect('admin/gyik');
            } else {
                Message::set('error', 'Adatbázis lekérdezési hiba!');
                $this->response->redirect('admin/gyik/insert');
            }
        }

        $data['title'] = 'Új gyik oldal';
        $data['description'] = 'Új gyik description';
        $data['gyik_category_list'] = $this->gyikCategory_model->allCategory();

        $view = new View();
        $view->add_links(array('validation', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/new_gyik.js');
        $view->render('gyik/tpl_new_gyik', $data);
    }

    /**
     * 	UPDATE
     */
    public function update($id)
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
                $this->response->redirect('admin/gyik/update/' . $id);
            }

            // új adatok az adatbázisba
            $result = $this->gyik_model->update($id, $data);

            if ($result !== false) {
                Message::set('success', 'Gyik adatai sikeresen módosítva.');
                $this->response->redirect('admin/gyik');
            } else {
                Message::set('error', 'Adatbázis lekérdezési hiba!');
                $this->response->redirect('admin/gyik/update/' . $id);
            }
        }

        $data['title'] = 'Termék módosítása oldal';
        $data['description'] = 'Termék módosítása description';
        $data['actual_gyik'] = $this->gyik_model->oneGyik($id);
        $data['gyik_category_list'] = $this->gyikCategory_model->allCategory();

        $view = new View();
        $view->add_links(array('validation', 'ckeditor', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/gyik_update.js');
        $view->render('gyik/tpl_gyik_update', $data);
    }

    /**
     *  DELETE
     */
    public function delete()
    {
        if($this->request->is_ajax()){
                
            if(!Auth::hasAccess('gyik.delete')){
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

                //gyik törlése  
                $result = $this->gyik_model->delete($id);
                
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
                $respond['message_success'] = $success_counter . ' gyik törölve.';
            }
            if ($fail_counter > 0) {
                $respond['message_error'] = $fail_counter . ' rekordot már töröltek!';
            }

            // respond tömb visszaadása
            $this->response->json($respond);

        }
    }

    /**
     * (AJAX) A gyik táblában módosítja a status mező értékét
     *
     * @return void
     */
    public function change_status()
    {
        if ( $this->request->is_ajax() ) {
            // jogosultság vizsgálat
            if (!Auth::hasAccess('gyik.change_status')) {
                $this->response->json(array(
                    "status" => 'error',
                    "message" => 'Nincs engedélye a művelet végrehajtásához.'
                ));         
            }               
            
            if ( $this->request->has_post('action') && $this->request->has_post('id') ) {
            
                $id = $this->request->get_post('id', 'integer');
                $action = $this->request->get_post('action');

                if($action == 'make_active') {
                    $result = $this->gyik_model->changeStatus($id, 1);
                    if($result !== false){
                        $this->response->json(array(
                            "status" => 'success',
                            "message" => 'Az aktiválás megtörtént!'
                        ));     
                    } else {
                        $this->response->json(array(
                            "status" => 'error',
                            "message" => 'Adatbázis hiba! A gyik státusza nem változott meg!'
                        ));
                    }
                }
                if($action == 'make_inactive') {
                    $result = $this->gyik_model->changeStatus($id, 0);
                    if($result !== false){
                        $this->response->json(array(
                            "status" => 'success',
                            "message" => 'A blokkolás megtörtént!'
                        ));     
                    } else {
                        $this->response->json(array(
                            "status" => 'error',
                            "message" => 'Adatbázis hiba! A státusz nem változott meg!'
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


/* ------------------------------ */


    /**
     * 	Kategóriák megjelenítése
     */
    public function category()
    {
        $data['title'] = 'Admin Gyik kategóriák oldal';
        $data['description'] = 'Admin Gyik kategóriák description';
        $data['all_gyik_category'] = $this->gyikCategory_model->allCategory();
        $data['category_counter'] = $this->gyik_model->categoryCounter();

        $view = new View();
        $view->add_links(array('datatable', 'bootbox', 'vframework'));
        $view->add_link('js', ADMIN_JS . 'pages/gyik_category.js');
        $view->render('gyik/tpl_gyik_category', $data);
    }

    /**
     * 	Új kategória hozzáadása
     */
    public function category_insert()
    {
        if ($this->request->is_post()) {

            $data['gyik_category_name'] = $this->request->get_post('gyik_category_name');

            //ha üresen küldték el a formot
            if (empty($data['gyik_category_name'])) {
                Message::set('error', 'Meg kell adni a kategória magyar nevét!');
                $this->response->redirect('admin/gyik/category_insert');
            }

            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->gyikCategory_model->allCategory();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                $data['gyik_category_name'] = trim($data['gyik_category_name']);
                if (strtolower($data['gyik_category_name']) == strtolower($value['gyik_category_name'])) {
                    Message::set('error', 'category_already_exists');
                    $this->response->redirect('admin/gyik/category_insert');
                }
            }

            // adatbázis lekérdezés 
            $result = $this->gyikCategory_model->insert($data);

            if ($result !== false) {
                Message::set('success', 'category_created');
                $this->response->redirect('admin/gyik/category');
            } else {
                Message::set('error', 'unknown_error');
                $this->response->redirect('admin/gyik/category_insert');
            }
        }

        $data['title'] = 'Új gyik kategória hozzáadása oldal';
        $data['description'] = 'Új gyik kategória description';
        
        $data['gyik_category_list'] = $this->gyikCategory_model->allCategory();

        $view = new View();
        $view->add_links(array('validation'));
        $view->add_link('js', ADMIN_JS . 'pages/gyik_category_insert_update.js');
        $view->render('gyik/tpl_gyik_category_insert', $data);
    }

    /**
     * 	Kategória módosítása
     */
    public function category_update($id)
    {
        $id = (int)$id;

        if ($this->request->is_post()) {

            $data['gyik_category_name'] = $this->request->get_post('gyik_category_name');

        //ha üresen küldték el a formot
            if (empty($data['gyik_category_name'])) {
                Message::set('error', 'Meg kell adni a kategória nevét!');
                $this->response->redirect('admin/gyik/category_update/' . $id);
            }

            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->gyikCategory_model->allCategory();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                $data['gyik_category_name'] = trim($data['gyik_category_name']);
                if (strtolower($data['gyik_category_name']) == strtolower($value['gyik_category_name']) && $id != $value['gyik_category_id']) {
                    Message::set('error', 'category_already_exists');
                    $this->response->redirect('admin/gyik/category_update/' . $id);
                }
            }

            $result = $this->gyikCategory_model->update($id, $data);

            if ($result !== false) {
                Message::set('success', 'category_updated');
                $this->response->redirect('admin/gyik/category');
            } else {
                Message::set('error', 'unknown_error');
                $this->response->redirect('admin/gyik/category_update/' . $id);
            }
        }

        $data['title'] = 'Admin termék kategória módosítása oldal';
        $data['description'] = 'Admin termék kategória módosítása description';
        $data['gyik_category_list'] = $this->gyikCategory_model->allCategory();
        $data['category_content'] = $this->gyikCategory_model->oneCategory($id);

        $view = new View();
        $view->add_links(array('validation'));
        $view->add_link('js', ADMIN_JS . 'pages/gyik_category_insert_update.js');
        $view->render('gyik/tpl_gyik_category_update', $data);
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete($id)
    {
        $id = (int)$id;

        if (!$this->gyik_model->is_category_deletable($id)) {
            Message::set('error', 'A kategória nem törölhető!');
            $this->response->redirect('admin/gyik/category');
        }

        $result = $this->gyikCategory_model->delete($id);

        if ($result !== false) {
            Message::set('success', 'A kategória törlése sikerült.');
        } else {
            Message::set('error', 'A kategória törlése nem sikerült!');
        }

        $this->response->redirect('admin/gyik/category');
    }



    /**
     * Termékekek száma kategóriában és az alá tartozó kategóriákban    
     *
     * @param integer $cat_id kategória id-je
     * @return int a termékek száma
     */
    public function get_gyik_count($cat_id)
    {
        $count = $this->gyik_model->gyik_number_in_category($cat_id);

        $children = $this->gyikCategory_model->get_children($cat_id);
        if (!empty($children)) {
            foreach ($children as $value) {
                $count = $count + $this->gyik_model->gyik_number_in_category($value);
                $sub_children = $this->gyikCategory_model->get_children($value);
                if (!empty($sub_children)) {
                    foreach ($sub_children as $sub_value) {
                        $count = $count + $this->gyik_model->gyik_number_in_category($sub_value);
                        $sub_sub_children = $this->gyikCategory_model->get_children($sub_value);
                        if (!empty($sub_sub_children)) {
                            foreach ($sub_sub_children as $sub_sub_value) {
                                $count = $count + $this->gyik_model->gyik_number_in_category($sub_sub_value);
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
<?php

class Profil extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('profil_model');
    }

    public function index() {

        $this->view->js_link[] = $this->make_link('js', SITE_ASSETS, 'plugins/bootstrap.validator/bootstrapValidator.min.js');
        $this->view->js_link[] = $this->make_link('js', SITE_JS, 'pages/profil.js');

        $this->view->profile_data = $this->profil_model->get_profile_data(Session::get('user_site_id'));

        $this->view->title = "Felhasználói profil";
        $this->view->description = "Profil";
        $this->view->keywords = "profil";
//$this->view->debug(true); 	

        $this->view->render('profil/tpl_profil');
    }
    
    public function ajax() {

        if (Util::is_ajax() && isset($_POST['user_name'])) {
            $result = $this->profil_model->edit_user(Session::get('user_site_id'));
            echo 'success';
        } else {
            echo 'error';
        }
        
    }    

}

?>
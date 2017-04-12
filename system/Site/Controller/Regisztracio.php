<?php

class Regisztracio extends Site_Controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('regisztracio_model');
    }

    public function index() {

        if (isset($this->registry->params['user_id']) && isset($this->registry->params['user_activation_verification_code'])) {

            // új regisztráció ellenőrzése
            $this->view->result = $this->regisztracio_model->verifyNewUser($this->registry->params['user_id'], $this->registry->params['user_activation_verification_code']);

            $this->view->content = $this->regisztracio_model->get_page_data('cegunkrol');
            $this->view->title = $this->view->content['page_metatitle'];
            $this->view->description = $this->view->content['page_metadescription'];
            $this->view->keywords = $this->view->content['page_metakeywords'];
            $this->view->content = $this->view->content['page_body'];

            $this->view->render('regisztracio/tpl_regisztracio');
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) Felhasználó regisztráció
     */
    public function ajax_register() {
        if (Util::is_ajax()) {

            $respond = $this->regisztracio_model->register_user();
            echo $respond;
            exit();
        } else {
            Util::redirect('error');
        }
    }

}

?>
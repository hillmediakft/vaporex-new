<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;
use System\Libs\Emailer;

class Kapcsolat extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('kapcsolat_model');
    }

    public function index()
    {
        if ($this->request->has_post('name')) {
            if ($this->request->has_post('mezes_bodon') && $this->request->get_post('mezes_bodon') === '') {
                
                $to_email = $this->global_data['settings']['email'];
                $to_name = $this->global_data['settings']['ceg'];
                $from_email = '';
                $from_name = '';
                $subject = '';

                $template_data = array(

                    );

                $template = '';


                $emailer = new Emailer($from_email, $from_name, $to_email, $to_name, $subject, $template_data, $template);

                if ($emailer->send()) {
                    exit();
                    
                } else {
                    exit();
                }

            }
        }

        $page_data = $this->kapcsolat_model->getPageData('kapcsolat');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $data['footer_social'] = $this->kapcsolat_model->get_content_data('footer_social');
        $data['footer_online_fizetes'] = $this->kapcsolat_model->get_content_data('footer_online_fizetes');

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->add_link('js', 'http://maps.google.com/maps/api/js?key=AIzaSyDoU5BWhXCTpaRJPgZq-ILXqW8A-CNZjeg');
        $view->add_link('js', SITE_ASSETS . 'plugins/gmaps/gmaps.js');
        $view->add_link('js', SITE_ASSETS . 'plugins/bootstrap.validator/bootstrapValidator.min.js');
        $view->add_link('js', SITE_JS . 'pages/kapcsolat.js');
//$view->debug(true); 	
        $view->render('kapcsolat/tpl_kapcsolat', $data);
    }

}
?>
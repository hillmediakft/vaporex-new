<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;

class Home extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('home_model');
    }

    public function index()
    {
        $page_data = $this->home_model->getPageData('home');
        $data = $this->addGlobalData();

        $data['slider'] = $this->home_model->slider_query();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];
        
        $data['footer_social'] = $this->home_model->get_content_data('footer_social');
        $data['footer_online_fizetes'] = $this->home_model->get_content_data('footer_online_fizetes');

        $data['termekek'] = $this->termekek_model->all_products_query();
        $data['testimonials'] = $this->home_model->get_testimonials();

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->add_link('js', SITE_ASSETS . 'plugins/iview/js/iview.js');
        $view->add_link('js', SITE_ASSETS . 'plugins/equalheights/jquery.equalheights.min.js');
        $view->add_link('js', SITE_ASSETS . 'pages/home.js');
// $view->debug(true); 
        $view->render('home/tpl_home', $data);
    }

}

?>
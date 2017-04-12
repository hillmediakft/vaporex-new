<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;

class Error extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('error_model');
    }

    public function index()
    {
        $page_data = $this->error_model->getPageData('error');
        $data = $this->addGlobalData();
        
        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        
        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        header('HTTP/1.0 404 Not Found');
        $view->render('error/404', $data);
    }

}
?>
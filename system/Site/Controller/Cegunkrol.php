<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;

class Cegunkrol extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('cegunkrol_model');
    }

    public function index()
    {
        $page_data = $this->cegunkrol_model->getPageData('cegunkrol');
        $data = $this->addGlobalData();
        
        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));        
        $view->render('cegunkrol/tpl_cegunkrol', $data);
    }
    
    public function miert_pont_vaporex()
    {
        $page_data = $this->cegunkrol_model->getPageData('miert-pont-vaporex');
        $data = $this->addGlobalData();
        
        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('cegunkrol/tpl_miert_pont_vaporex', $data);
    }  
    
    public function mennyibe_kerul()
    {
        $page_data = $this->cegunkrol_model->getPageData('mennyibe-kerul');
        $data = $this->addGlobalData();
        
        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('cegunkrol/tpl_mennyibe_kerul', $data);
    }    

}
?>
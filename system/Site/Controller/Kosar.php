<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;
use System\Libs\Cart;

class Kosar extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('kosar_model');
    }

    /**
     * 
     */
    public function index()
    {
        $page_data = $this->kosar_model->getPageData('kosar');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];
       
        $cart = new Cart();      
        $data['items'] = $cart->getItems();

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->add_link('js', $view->url_helper->autoVersion(SITE_JS . 'pages/kosar.js'));
        $view->render('kosar/tpl_kosar', $data);
    }

    /**
     * 
     */
    public function ajax()
    {

    }
}
?>
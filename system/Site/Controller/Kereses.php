<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;

class Kereses extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('kereses_model');
    }

    public function index()
    {
        $page_data = $this->kereses_model->getPageData('kereses');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];        
        
        $data['search_results'] = $this->kereses_model->search($this->request->get_query('search'));
        $data['result_list'] = $data['search_results'][0];
        $data['keyword'] = $data['search_results'][1];

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('kereses/tpl_kereses_lista', $data);
    }

}
?>
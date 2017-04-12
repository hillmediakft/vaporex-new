<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;

class Referenciak extends SiteController {

    function __construct() {
        parent::__construct();
        $this->loadModel('referenciak_model');
    }

    /**
     * 
     */
    public function index()
    {
        $page_data = $this->referenciak_model->getPageData('referenciak');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $data['category_list'] = $this->referenciak_model->project_category_list();
        $data['referenciak'] = $this->referenciak_model->all_projects_query();
        $data['referencia_kategoriak'] = $this->referenciak_model->referencia_kategoriak();

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('referenciak/tpl_referenciak', $data);
    }
    
    /**
     * 
     */
    public function referencia($title, $id)
    {
        $id = (int)$id;
        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));

        $page_data = $this->referenciak_model->getPageData('referenciak');
        $data = $this->addGlobalData();

        $data['referencia'] = $this->referenciak_model->get_project($id);

        $data['title'] = $data['referencia']['project_title'];
        $data['description'] = strip_tags($view->str_helper->substrWord($data['referencia']['project_description'], 150));
        $data['keywords'] = $data['referencia']['project_title'];
        $data['content'] = $page_data['body'];

        $view->render('referenciak/tpl_referencia', $data);
    }    

}
?>
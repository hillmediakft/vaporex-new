<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;
use System\Libs\DI;

class Letoltesek extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('letoltesek_model');
    }

    public function index()
    {
        $page_data = $this->letoltesek_model->getPageData('letoltesek');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $data['category_list'] = $this->letoltesek_model->findCategories();
        $data['letoltesek'] = DI::get('arr_helper')->group_array_by_field($this->letoltesek_model->getDocuments(), 'name');
        
        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('letoltesek/tpl_letoltesek', $data);
    }
    
    /**
     * 
     */
    public function category($id)
    {
        $id =(int)$id;

        $data['referencia'] = $this->letoltesek_model->get_project($id);

        $data['title'] = $data['referencia']['project_title'];
        $data['description'] = DI::get('str_helper')->substrWord($data['referencia']['project_description'], 150);
        $data['keywords'] = $data['referencia']['project_title'];

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('letoltesek/tpl_referencia', $data);
    }    

}

?>
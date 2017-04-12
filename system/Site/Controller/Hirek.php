<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;
use System\Libs\Paginator;


class Hirek extends SiteController {

    private $hirek_per_page = 6;

    function __construct()
    {
        parent::__construct();
        $this->loadModel('hirek_model');
    }

    /**
     * 
     */
    public function index()
    {
        $page_data = $this->hirek_model->getPageData('hirek');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        // lapozó objektum
        $pagine = new Paginator('page', $this->hirek_per_page);
        // adatok lekérdezése limittel
        $data['hirek_list'] = $this->hirek_model->blog_pagination_query($pagine->get_limit(), $pagine->get_offset());
        // szűrési feltételeknek megfelelő összes rekord száma
        $hirek_count = $this->hirek_model->blog_pagination_count_query();
        $pagine->set_total($hirek_count);
        //$language_code = ($this->registry->lang == 'hu') ? '' : $this->registry->lang;
        // lapozó linkek
        $data['pagine_links'] = $pagine->page_links($this->request->get_uri('path_full'));

        //hír kategóriák
        $data['hirek_categories'] = $this->hirek_model->get_blog_categories();

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('hirek/tpl_hirek', $data);
    }

    /**
     * 
     */
    public function reszletek($title, $id)
    {
        $id = (int)$id;
        
        $page_data = $this->hirek_model->getPageData('hirek');
        $data = $this->addGlobalData();

        $content = $this->hirek_model->blog_query($id);

        if (empty($content)) {
            $this->response->redirect('error');
        }

        $data['title'] = $content['blog_title'] . ' | Vaporex';
        $data['description'] = $content['blog_title'];
        $data['blog'] = $content;

        $data['keywords'] = '';

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('hirek/tpl_hir', $data);
    }

    /**
     * 
     */
    public function kategoria($id)
    {
        $category_id = (int)$id;

        $category_data = $this->hirek_model->blog_category_query($category_id);
        $data['category_name'] = $category_data['category_name'];
        $data['content'] = $this->hirek_model->blog_query_by_category($category_id);

        $pagine = new Paginator('page', $this->hirek_per_page);
        // adatok lekérdezése limittel
        $data['blog_list'] = $this->hirek_model->blog_query_by_category_pagination($category_id, $pagine->get_limit(), $pagine->get_offset());

        // szűrési feltételeknek megfelelő összes rekord száma
        $blog_count = $this->hirek_model->blog_pagination_count_query();

        $pagine->set_total($blog_count);
        // lapozó linkek
        //$language_code = ($this->registry->lang == 'hu') ? '' : $this->registry->lang;
        $data['pagine_links'] = $pagine->page_links($this->request->get_uri('path_full'));

        $data['title'] = $this->view->category_name;
        $data['description'] = $this->view->category_name;
        $data['keywords'] = 'blog: ' . $this->view->category_name;

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('hirek/tpl_hirek_category', $data);
    }

}
?>
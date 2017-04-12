<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;


class Termekek extends SiteController {

    function __construct() {
        parent::__construct();
        $this->loadModel('termekek_model');
    }


    public function index()
    {
        $page_data = $this->termekek_model->getPageData('termekek');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];

        $data['category_menu'] = $this->termekek_model->get_category_menu();

        $data['products_area'] = $this->termekek_model->product_categories();
        $data['product_category_path'] = 'Termékek';

        $view = new View();
        
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->add_link('js', SITE_ASSETS . 'plugins/equalheights/jquery.equalheights.min.js');
        $view->add_link('css', SITE_ASSETS . 'plugins/metis-menu/src/metisMenu.css');
        $view->add_link('css', SITE_ASSETS . 'plugins/metis-menu/src/metis_demo.css');
        $view->add_link('js', SITE_ASSETS . 'plugins/metis-menu/src/metisMenu.js');
        $view->add_link('js', SITE_JS . 'pages/termekek.js');

        $view->render('termekek/tpl_termekek', $data);
    }



    /**
     * termék részletei oldal - url: termekek/id
     */
    public function termek($id)
    {
        $page_data = $this->termekek_model->getPageData('termekek');
        $data = $this->addGlobalData();

        $data['category_menu'] = $this->termekek_model->get_category_menu();

        $data['product_category_id'] = $this->termekek_model->get_product_category_by_id($id);
        $data['product_name'] = $this->termekek_model->get_product_name_by_id($id);
        $data['product'] = $this->termekek_model->product_details($id);
        $data['product_category_path'] = $this->termekek_model->product_category_path_with_link($data['product_category_id']);
//var_dump($data);die;
        $data['title'] = $data['product_name']['product_title'];
        $data['description'] = $data['product_name']['product_title'];
        $data['keywords'] = '';

        $view = new View();

        $view->setHelper(array('url_helper', 'str_helper'));        
        $view->add_link('js', SITE_ASSETS . 'plugins/equalheights/jquery.equalheights.min.js');
        $view->add_link('css', SITE_ASSETS . 'plugins/metis-menu/src/metisMenu.css');
        $view->add_link('css', SITE_ASSETS . 'plugins/metis-menu/src/metis_demo.css');
        $view->add_link('js', SITE_ASSETS . 'plugins/metis-menu/src/metisMenu.js');
        $view->add_link('js', SITE_JS . 'pages/termekek.js');
        
        $view->render('termekek/tpl_termek', $data);
    }  

    /**
     * termék kategória oldal - url: termekek/kategoria/category_name/category_id
     */
    public function category($category, $id)
    {
        $id = (int)$id;
        
        $page_data = $this->termekek_model->getPageData('termekek');
        $data = $this->addGlobalData();
        
        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));

        $data['category_menu'] = $this->termekek_model->get_category_menu();
        $data['category_name'] = $this->termekek_model->get_category_name_by_id($id);
        $is_product_in_category = $this->termekek_model->is_products_in_category($id);

        if (empty($is_product_in_category)) {
            $data['products_area'] = $this->termekek_model->product_categories($id);
        } else {
            $data['products_area'] = $this->termekek_model->products_in_category($id);
        }
        $data['new_products'] = $this->termekek_model->get_new_products(3);

        $data['product_category_path'] = '<a href="' . $this->request->get_uri('site_url') . 'termekek' . '">' . 'termekek' . '</a> / ' . '<a href="' . $this->request->get_uri('site_url') . 'termekek' . '/' . 'kategoria/' . $view->str_helper->stringToSlug($data['category_name']['product_category_name']) . '/' . $id . '">' . $data['category_name']['product_category_name'] . '</a>';


        $data['title'] = 'kategória' . ': ' . $category;
        $data['description'] = 'kategória' . ': ' . $category;
        $data['keywords'] = '';

        $view->add_link('js', SITE_ASSETS . 'plugins/equalheights/jquery.equalheights.min.js');
        $view->add_link('css', SITE_ASSETS . 'plugins/metis-menu/src/metisMenu.css');
        $view->add_link('css', SITE_ASSETS . 'plugins/metis-menu/src/metis_demo.css');
        $view->add_link('js', SITE_ASSETS . 'plugins/metis-menu/src/metisMenu.js');
        $view->add_link('js', SITE_JS . 'pages/termekek.js');
        $view->render('termekek/tpl_termekek', $data);
    }



}
?>
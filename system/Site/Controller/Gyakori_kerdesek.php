<?php
namespace System\Site\Controller;
use System\Core\SiteController;
use System\Core\View;
use System\Libs\DI;

class Gyakori_kerdesek extends SiteController {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('gyik_model');
    }

    public function index()
    {
        $page_data = $this->gyik_model->getPageData('gyakori-kerdesek');
        $data = $this->addGlobalData();

        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];
        $data['content'] = $page_data['body'];

        $data['gyik'] = $this->gyik_model->allGyik();
        $data['gyik_rendezett'] = DI::get('arr_helper')->arraySort($data['gyik'], 'gyik_category_name');

        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->render('gyakori_kerdesek/tpl_gyakori_kerdesek', $data);
    }


    /**
     * Termékekek száma kategóriában és az alá tartozó kategóriákban    
     *
     * @param integer $cat_id kategória id-je
     * @return int a termékek száma
     */
    private function _getGyikCount($cat_id)
    {
        $this->loadModel('GyikCategory_model');

        $count = $this->gyik_model->gyik_number_in_category($cat_id);

        $children = $this->GyikCategory_model->getChildren($cat_id);
        if (!empty($children)) {
            foreach ($children as $value) {
                $count = $count + $this->gyik_model->gyik_number_in_category($value);
                $sub_children = $this->GyikCategory_model->getChildren($value);
                if (!empty($sub_children)) {
                    foreach ($sub_children as $sub_value) {
                        $count = $count + $this->gyik_model->gyik_number_in_category($sub_value);
                        $sub_sub_children = $this->GyikCategory_model->getChildren($sub_value);
                        if (!empty($sub_sub_children)) {
                            foreach ($sub_sub_children as $sub_sub_value) {
                                $count = $count + $this->gyik_model->gyik_number_in_category($sub_sub_value);
                            }
                        }
                    }
                }
            }
        }

        return $count;
    }

}
?>
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
       
        $data['items'] = $this->cart->getItems();

        if (!empty($data['items'])) {
            # code...
        }


//var_dump($data);
        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->add_link('js', $view->url_helper->autoVersion(SITE_JS . 'pages/kosar.js'));
        $view->render('kosar/tpl_kosar', $data);
    }

    /**
     * Elem hozzáadása a kosárhoz
     */
    public function addItem()
    {
        if ($this->request->is_ajax()) {
            $id = $this->request->get_post('product_id', 'integer');    
            $qty = (int)$this->request->get_post('quantity');    
            $qty = ($qty == 0) ? 1 : $qty;    
            // hozzáadás a kosárhoz
            $this->cart->add($id, $qty);
            // kosár összes elemszáma
            $items_number = $this->cart->getItemsNumber();

            $this->response->json(array(
                'status' => 'success',
                'message' => $qty . ' elem hozzáadva a kosárhoz.',
                'items_number' => $items_number,
                'product_id' => $id
                ));
        }    
    }

    /**
     * Elem kivétele a kosárból
     */
    public function removeItem()
    {
        if ($this->request->is_ajax()) {
            $id = $this->request->get_post('product_id', 'integer');    
            // elem eltávolítása a kosárból
            $this->cart->remove($id);
            // kosár összes elemszáma
            $items_number = $this->cart->getItemsNumber();

            $this->response->json(array(
                'status' => 'success',
                'message' => 'Elem eltávolítva a kosárból.',
                'items_number' => $items_number,
                'product_id' => $id
                ));
        }   
    }

    /**
     * Kosár teljes tartalmának törlése
     */
    public function removeAllItem()
    {
        if ($this->request->is_ajax()) {
            // kosár ürítése
            $this->cart->clear();

            $this->response->json(array(
                'status' => 'success',
                'message' => 'Kosár kiürítve.',
                'items_number' => 0
                ));
        }   
    }

    /**
     * 
     */
    public function ajax()
    {

    }
}
?>
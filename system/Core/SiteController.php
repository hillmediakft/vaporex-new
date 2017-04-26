<?php
namespace System\Core;
use System\Libs\Auth;
use System\Libs\Cart;

class SiteController extends Controller {

	/**
	 * Minden site oldalon megjelenő adatokat tartalmazó tömb
	 */
    protected $global_data = array();

    /**
     * Minden site controllerben elérhető, és a nyelvi kódot tartalmazza
     */
    protected $lang = LANG;
    
    /**
     * Kosár objektumot tartalmazza
     */
    protected $cart; 

    /**
     * Minden site oldali controllerben lefut
     */
    public function __construct()
    {
        parent::__construct();

        // megnézzük, hogy be van-e jelentkezve a user 
        if (Auth::isUserLoggedIn()) {
            
            $this->global_data['logged_in'] = true;

            // megnézzük, hogy lejárt-e a session időkorlát 
            if (!Auth::checkExpire()) {
                $this->response->redirect($this->request->get_uri('current_url'));
            }
        } else {
            $this->global_data['logged_in'] = false;
        }

        // KOSÁR objektum létrehozása, ha nem ajaxos a kérés
            $this->cart = new Cart();
            $this->global_data['cart_items_number'] = $this->cart->getItemsNumber();


        if (!$this->request->is_ajax()) {
            // settings betöltése és hozzárendelése a controllereken belül elérhető a global_data változóhoz
            $this->loadModel('settings_model');
            $this->global_data['settings'] = $this->settings_model->get_settings();

            $this->loadModel('termekek_model');
            $this->global_data['new_products'] = $this->termekek_model->get_new_products(3);
        }

    }
}
?>
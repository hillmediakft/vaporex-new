<?php 
namespace System\Site\Controller;

use System\Core\SiteController;
use System\Core\View;
use System\Libs\Config;
use System\Libs\Session;
use System\Libs\Message;
use System\Libs\Auth;
use System\Libs\DI;
use System\Libs\Validate;

class Profile extends SiteController {

	function __construct()
	{
		parent::__construct();
		$this->loadModel('user_model');
	}

	/**
	 *	Profil oldal
	 */
	public function index()
	{
		if (!Auth::isUserLoggedIn()) {
			$this->response->redirect();
		}

        $page_data = $this->user_model->getPageData('profil');
        
        $data = $this->addGlobalData();
        $data['title'] = $page_data['metatitle'];
        $data['description'] = $page_data['metadescription'];
        $data['keywords'] = $page_data['metakeywords'];	

        $id = (int)Auth::getUser('id');
        // ha nincs bejelentkezve
        if (is_null($id)) {
        	$this->response->redirect('error');
        }
        
        // bejelentkezett user adatainak lekérdezése
        $data['user'] = $this->user_model->selectUser($id);


        $view = new View();
        $view->setHelper(array('url_helper', 'str_helper'));
        $view->add_link('js', SITE_ASSETS . 'plugins/bootstrap.validator/bootstrapValidator.min.js');
        $view->add_link('js', SITE_JS . 'pages/profil.js');
        $view->render('profil/tpl_profil', $data);        	
	}

	/**
	 * Profil adatok módosítása
	 */
	public function update()
	{
		if ($this->request->is_ajax()) {

			//bejelentkezett user id-je
			$user_id = Auth::getUser('id');

			$data = array();

/* NAME, EMAIL ADATOK */
			$data['name'] = $this->request->get_post('user_name');
			$data['email'] = $this->request->get_post('user_email');
			
            if (!preg_match('/^[\_\sa-záöőüűóúéíÁÖŐÜŰÓÚÉÍ\d]{2,64}$/i', $data['name'])) {
                //Message::set('error', 'username_does_not_fit_pattern');
                $this->response->json(array(
					'status' => 'error',
					'message' => Message::show('username_does_not_fit_pattern')
					));
            }

			//Megvizsgáljuk, hogy van-e már ilyen nevű user, de nem az amit módosítani akarunk
			$result_name = $this->user_model->checkUserNoLoggedIn($user_id, $data['name']);
			if ($result_name) {
				//Message::set('error', 'Már létezik ilyen felhasználó név!');
				$this->response->json(array(
					'status' => 'error',
					'message' => 'Már létezik ilyen felhasználó név!'
					));
			}

			//Megvizsgáljuk, hogy van-e már ilyen email cím (de nem az amit módosítani akarunk)
			$result_email = $this->user_model->checkEmailNoLoggedIn($user_id, $data['email']);
			if ($result_email) {
				//Message::set('error', 'Már létezik ilyen e-mail cím!');
				$this->response->json(array(
					'status' => 'error',
					'message' => 'Már létezik ilyen e-mail cím!'
					));
			}
/* NAME, EMAIL ADATOK */

/* PASSWORD ADATOK */
			$password_new = $this->request->get_post('user_password');
			$password_new_again = $this->request->get_post('user_password_again');

			if ( (empty($password_new) && !empty($password_new_again)) || (!empty($password_new) && empty($password_new_again)) ) {
				//Message::set('error', 'Mindegyik jelszó mezőt ki kell töltenie!');
				$this->response->json(array(
					'status' => 'error',
					'message' => 'Mindegyik jelszó mezőt ki kell töltenie!'
					));
		    }


		    // ha mindkét password mező ki van töltve
		    if (!empty($password_new) && !empty($password_new_again)) {

		    	// ha nem egyezik a két jelszó mező 
		    	if ($password_new !== $password_new_again) {
					//Message::set('error', 'A két jelszónak meg kell egyeznie!');
					$this->response->json(array(
						'status' => 'error',
						'message' => 'A két jelszónak meg kell egyeznie!'
						));
		    	}
	
	            if (strlen($password_new) < 6) {
	                //Message::set('error', 'password_too_short');
					$this->response->json(array(
						'status' => 'error',
						'message' => 'A jelszónak legalább 6 karakter hosszúnak kell lennie!'
						));                
	            }

				// jelszó kompatibilitás library betöltése régebbi php verzió esetén
				$this->user_model->load_password_compatibility();
				// crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character
				// hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4,
				// by the password hashing compatibility library. the third parameter looks a little bit shitty, but that's
				// how those PHP 5.5 functions want the parameter: as an array with, currently only used with 'cost' => XX
				$hash_cost_factor = (Config::get('hash_cost_factor') !== null) ? Config::get('hash_cost_factor') : null;

				// új jelszó titkosítva
				$data['password_hash'] = password_hash($password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
		    
		    }
/* PASSWORD ADATOK */

/* CÉG / CÍM / SZÁMLÁZÁSI ADATOK */
            $data['name_or_company'] = $this->request->get_post('name_or_company');
            $data['invoice_address'] = $this->request->get_post('invoice_address');
            $data['delivery_address'] = $this->request->get_post('delivery_address');
/* CÉG / CÍM / SZÁMLÁZÁSI ADATOK */


			// update rekord
			$update = $this->user_model->update($user_id, $data);

			if ($update !== false) {
				
				Message::set('success', 'A felhasználó adatai módosítva!');

		        Session::set('user_data.name', $data['name']);
		        Session::set('user_data.email', $data['email']);

				$this->response->json(array(
					'status' => 'success',
					'message' => 'A felhasználó adatai módosítva!',
					'new_name' => $data['name']
					));
			} else {
				$this->response->json(array(
					'status' => 'error',
					'message' => Message::show('unknown_error')
					));				
			}


		} else {
			$this->response->redirect('error');
		}


	}

}
?>
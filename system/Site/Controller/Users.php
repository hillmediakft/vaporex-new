<?php 

class users extends Controller {

	function __construct()
	{
		parent::__construct();
		$this->loadModel('user_model');
	}


	/**
	 *	Ne legyen 'sima' user oldal
	 */
	public function index()
	{
		Util::redirect('error');
	}


	/**
	 *	Felhasználó bejelentkezés
	 *
	 */
	public function ajax_login()
	{
		if(Util::is_ajax()){

			$respond = $this->user_model->login();
			echo $respond;
			exit();

		} else {
			Util::redirect('error');
		}
	}
    
    
	/**
	 *	Új jelszó küldése a felhasználónak (elfelejtett jelszó esetén)
     *  - lekérdezi, hogy van-e a $_POST-ban kapott email címmel rendelkező felhasználó
     *  - generál egy 8 karakter hosszú jelszót és egy new_password_hash-t
     *  - az új password hash-t az adatbázisba írja
     *  - elküldi email-ben az új jelszót a felhasználónak
     *  - ha az email küldése sikertelen, visszaírja az adatbázisba a régi password hash-t
	 */
	public function ajax_forgottenpw()
	{
		if(Util::is_ajax()){
            
            // a felhasználó email címe, amire küldjük az új jelszót
            $to_email = strip_tags($_POST['user_email']);
            
            // lekérdezzük, hogy ehhez az email címhez tartozik-e user (lekérdezzük a nevet, és a password hash-t)
            $result = $this->user_model->user_name_pw_query($to_email);
                // ha nincsen ilyen e-mail címmel regisztrált felhasználó 
                if(empty($result)){
                    $message = array(
                      'status' => 'error',
                      'message' => 'Nincsen ilyen e-mail címmel regisztrált felhasználó!'
                    );
                    echo json_encode($message);
                    exit();                
                }
            
            $to_name = $result[0]['user_name'];
            $old_pw = $result[0]['user_password_hash'];
                  
                // 8 karakter hosszú új jelszó generálása (str_shuffle összekeveri a stringet, substr levágja az első 8 karaktert)
                $new_password = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
                $hash_cost_factor = (Config::get('hash_cost_factor') !== null) ? Config::get('hash_cost_factor') : null;
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));            
            
            // új jelszó hash beírása az adatbázisba
            $result = $this->user_model->set_user_password($to_email, $new_password_hash);
                // ha hiba történt a adatbázisba íráskor
                if(($result == 0) || ($result === false)){
                    $message = array(
                        'status' => 'error',
                        'message' => 'Adatbázis hiba!'
                    );
                    echo json_encode($message);
                    exit();    
                }
            
            
            // settings adatok lekérdezése az adatbázisból
            $data = $this->user_model->get_settings();            
            
            $from_email = $data['email'];
            $from_name = $data['ceg'];

            $subject = 'Üzenet érkezett a Multijob weblaptól';
            $msg = <<<_msg

            <html>    
            <body>
                <h2>Új jelszó</h2>
                <div>
                    <p>
                        Az ön új jelszava a Multijob weblaphoz.
                    </p>
                    <p>
                        <strong>Az ön új jelszava: </strong> {$new_password}
                    </p>
                </div> 
            </body>
            </html>    
_msg;
            
            $result = $this->user_model->send_email($from_email, $from_name, $subject, $msg, $to_email, $to_name);

            if ($result) {
                $message = array(
                  'status' => 'success',
                  'message' => 'Új jelszó elküldve!'
                );
                echo json_encode($message);
                exit();
            } else {
                // régi password hash visszaírása az adatbázisba
                $this->user_model->set_user_password($to_email, $old_pw);
                
                $message = array(
                  'status' => 'error',
                  'message' => 'Az új jelszó küldése sikertelen!'
                );
                echo json_encode($message);
                exit();
            }

		} else {
			Util::redirect('error');
		}
		
	}    


    /**
     * The logout action, users/logout
     */
    function logout()
    {
        $this->user_model->logout();
        // redirect user to base URL
		header('location: ' . BASE_URL);
		exit;
    }	

}
?>
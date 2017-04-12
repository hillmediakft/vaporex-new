<?php

class Regisztracio_model extends Site_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    function __destruct() {
        parent::__destruct();
    }

    /**
     * 	Ellenőrzi a felhasználótól kapott adatokat
     * 	
     * 	@param	array	$data
     * 	@return	bool
     */
    private function verify_user_data($data) {
        $messages = array();

        // User név ellenőrzés
        if (empty($data['user_name'])) {
            $messages[] = Message::send('username_field_empty');
        } else {
            if (strlen($data['user_name']) > 64 OR strlen($data['user_name']) < 2) {
                $messages[] = Message::send('username_too_short_or_too_long');
            }
            if (!preg_match('/^[\_\sa-záöőüűóúéíÁÖŐÜŰÓÚÉÍ\d]{2,64}$/i', $data['user_name'])) {
                $messages[] = Message::send('username_does_not_fit_pattern');
            }
        }
        // Jelszó ellenőrzés
        if (empty($data['password'])) {
            $messages[] = Message::send('password_field_empty');
        } else {
            if (strlen($data['password']) < 6) {
                $messages[] = Message::send('password_too_short');
            }
            if (isset($data['password_again'])) {
                if (empty($data['password_again'])) {
                    $messages[] = Message::send('password_field_empty');
                } else {
                    if ($data['password'] !== $data['password_again']) {
                        $messages[] = Message::send('password_repeat_wrong');
                    }
                }
            }
        }
        // E-mail ellenőrzés
        if (empty($data['user_email'])) {
            $messages[] = Message::send('email_field_empty');
        } else {
            if (strlen($data['user_email']) > 64) {
                $messages[] = Message::send('email_too_long');
            }
            if (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL)) {
                $messages[] = Message::send('email_does_not_fit_pattern');
            }
        }


        if (empty($messages)) {

            // lekérdezzük, hogy létezik-e már ilyen felhasználói név 
            $this->query->reset();
            $this->query->set_table(array('site_users'));
            $this->query->set_columns('user_id');
            $this->query->set_where('user_name', '=', $data['user_name']);
            $result = $this->query->select();
            if (count($result) == 1) {
                $messages[] = Message::send('username_already_taken');
            }

            // lekérdezzük, hogy létezik-e már ilyen e-mail cím
            $this->query->reset();
            $this->query->set_table(array('site_users'));
            $this->query->set_columns('user_id');
            $this->query->set_where('user_email', '=', $data['user_email']);
            $result = $this->query->select();
            if (count($result) == 1) {
                $messages[] = Message::send('user_email_already_taken');
            }

            if (empty($messages)) {
                // ha nincs semmilyen hiba
                return true;
            } else {
                //hibaüzeneteket tartalmazó tömb
                return $messages;
            }
        } else {
            //hibaüzeneteket tartalmazó tömb
            return $messages;
        }
    }

    /**
     * 	Felhasználó regisztrálása a site_users táblába
     * 	(Normál regisztráció)
     */
    public function register_user() {
        // ellenőrzi a usertől kapott adatokat
        $verify_result = $this->verify_user_data($_POST);

        // ha a verify_user_data() metódus TRUE-t ad vissza	nincs hiba
        if ($verify_result === true) {

            $data = $_POST;

            $success_messages = array();
            $error_messages = array();

            // Ha egy robot töltötte ki a formot
            /*
              if($data['security_name'] != ''){
              return false;
              }
              unset($data['security_name']);
             */

            // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character
            // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4,
            // by the password hashing compatibility library. the third parameter looks a little bit shitty, but that's
            // how those PHP 5.5 functions want the parameter: as an array with, currently only used with 'cost' => XX
            $hash_cost_factor = (Config::get('hash_cost_factor') !== null) ? Config::get('hash_cost_factor') : null;
            $data['user_password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
            unset($data['password']);
            unset($data['password_again']);

            // kér-e hírlevelet
            $data['user_newsletter'] = (isset($data['user_newsletter'])) ? 1 : 0;
            // generálunk egy kódot ami majd a hírlevélről leiratkozáshoz kell (40 char string)
            $data['user_unsubscribe_code'] = sha1(uniqid(mt_rand(), true));
            // generálunk egy ellenőrző kódot a regisztráció email-es ellenőrzéshez (40 char string)
            $data['user_activation_hash'] = sha1(uniqid(mt_rand(), true));
            // a user_active alapállapotban 0 lesz (vagyis inaktív)
            $data['user_active'] = 0;
            //felhasználó hatásköre
            $data['user_role_id'] = 3;
            // generate integer-timestamp for saving of account-creating date
            $data['user_creation_timestamp'] = time();
            //a felhasználó "típusa" (csak hírlevélre feliratkozóknek: news_only)
            $data['user_provider_type'] = 'default';

            $this->query->reset();
            $this->query->set_table(array('site_users'));
            $user_id = $this->query->insert($data);

            if (!$user_id) {
                $message = Message::send('account_creation_failed');
                return json_encode(array(
                    "status" => 'error',
                    "message" => $message
                ));
            }


            // ellenőrző email küldése, (ha az ellenőrző email küldése sikertelen: töröljük a user adatait az adatbázisból)
            if ($this->sendVerificationEmail($data['user_name'], $user_id, $data['user_email'], $data['user_activation_hash'])) {

                $messages[] = Message::send('account_successfully_created');
                $messages[] = Message::send('verification_mail_sending_successful');
                $messages[] = Message::send('click_verification_link');

                return json_encode(array(
                    "status" => 'success',
                    "message" => $messages
                ));
            } else {
                $this->query->reset();
                $this->query->set_table(array('site_users'));
                $this->query->delete('user_id', '=', $user_id);
                $message[] = Message::send('verification_mail_sending_failed');

                return json_encode(array(
                    "status" => 'error',
                    "message" => $message
                ));
            }
        } else {
            // ha valamilyen hiba volt a form adataiban
            return json_encode(array(
                "status" => 'error',
                "message" => $verify_result
            ));
        }
    }

    /**
     * sends an email to the provided email address
     *
     * @param string 	$user_name 					felhasznalo neve
     * @param int 		$user_id 					user's id
     * @param string 	$user_email 				user's email
     * @param string 	$user_activation_hash 		user's mail verification hash string

     * @return boolean
     */
    private function sendVerificationEmail($user_name, $user_id, $user_email, $user_activation_hash) {

        $data = array();
        $settings = $this->get_settings();
        
        $to_email = $user_email;
        $to_name = $user_name;
        $subject = 'Regisztráció visszaigazolása - vaporex.hu';
        $template = 'regisztracio';
        $data['link'] = '<p><a href="' . BASE_URL . 'regisztracio/' . $user_id . '/' . $user_activation_hash . '">Kattintson erre a linkre a regisztráció aktiválásához.</a></p>';
        $data['user_name'] = $user_name;
        $data['user_email'] = $user_email;
        $data['ceg'] = $settings['ceg'];
        $data['cim'] = $settings['cim'];
        $data['tel'] = $settings['tel'];
        $data['email'] = $settings['email'];
        
        $emailer = new Emailer($settings['email'], $settings['ceg'], $to_email, $to_name, $subject, $data, $template);
        // final sending and check
        if ($emailer->send()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * checks the email/verification code combination and set the user's activation status to true in the database
     * @param int $user_id user id
     * @param string $user_activation_verification_code verification token
     * @return bool success status
     */
    public function verifyNewUser($user_id, $user_activation_verification_code) {
        // megnézzük, hogy már sikerült-e a regisztráció (ha frissíti az oldalt)
        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_columns(array('user_id'));
        $this->query->set_where('user_id', '=', $user_id);
        $this->query->set_where('user_active', '=', 1, 'and');
        $this->query->set_where('user_activation_hash', '=', null, 'and');

        $result = $this->query->select();
        if ($result) {
            return true;
        }


        $data['user_active'] = 1;
        $data['user_activation_hash'] = null;

        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_where('user_id', '=', $user_id);
        $this->query->set_where('user_activation_hash', '=', $user_activation_verification_code, 'and');
        $result = $this->query->update($data);

        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

}

?>
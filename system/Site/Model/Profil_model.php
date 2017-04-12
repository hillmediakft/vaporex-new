<?php

class Profil_model extends Site_model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 	Egy user (bizonyos) adatait kérdezi le az adatbázisból
     * 	(user_id, user_name, user_first_name, user_last_name, user_phone, user_email, user_role_id és a role táblából: role_name)
     *
     * 	@param	$user_id String or Integer
     * 	@return	Array or false
     */
    public function get_profile_data($user_id) {
        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_columns('*');
        $this->query->set_where('user_id', '=', $user_id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	Ellenőrzi a felhasználótól kapott adatokat
     * 	
     * 	@param	array	$data
     * 	@return	bool
     */
    private function verify_user_name_and_email() {
        $messages = array();

        // User név ellenőrzés
        if (empty($_POST['user_name'])) {
            $messages[] = Message::set('error', 'username_field_empty');
        } else {
            if (!preg_match('/^[\_\sa-záöőüűóúéíÁÖŐÜŰÓÚÉÍ\d]{2,64}$/i', $_POST['user_name'])) {
                $messages[] = Message::set('error', 'username_does_not_fit_pattern');
            }
        }
        // E-mail ellenőrzés
        if (empty($_POST['user_email'])) {
            $messages[] = Message::set('error', 'email_field_empty');
            return false;
        }
        if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $messages[] = Message::set('error', 'email_does_not_fit_pattern');
        }

        if (empty($messages)) {
            return true;
        } else {
            //hibaüzeneteket tartalmazó tömb
            return false;
        }
    }

    /**
     * 	Ellenőrzi a felhasználótól kapott adatokat
     * 	
     * 	@param	array	$data
     * 	@return	bool
     */
    private function verify_user_password() {
        $messages = array();

        // ha üres a password és az ellenőrző password mezö
        if (empty($_POST['user_password']) AND empty($_POST['user_password_again'])) {
            return;
        } else {
            if (empty($_POST['user_password']) OR empty($_POST['user_password_again'])) {
                $messages[] = Message::set('error', 'password_field_empty');
                return false;
            }
            if (strlen($_POST['user_password']) < 6) {
                $messages[] = Message::set('error', 'password_too_short');
            }
            if ($_POST['user_password'] !== $_POST['user_password_again']) {
                $messages[] = Message::set('error', 'password_repeat_wrong');
            }
        }

        if (empty($messages)) {
            return true;
        } else {
            // a hibaüzeneteket tartalmazó tömb nem üres
            return false;
        }
    }

    /**
     * 	Felhasználó adatainak módosítása
     *
     * @param  integer $user_id
     */
    public function edit_user($user_id) {

        // végrehajtás, ha nincs hiba	
        if ($this->verify_user_name_and_email()) {

            // clean the input
            $data['user_name'] = $_POST['user_name'];
            //       $data['user_first_name'] = $_POST['first_name'];
            //       $data['user_last_name'] = $_POST['last_name'];
            $data['user_email'] = $_POST['user_email'];

            $verify_password = $this->verify_user_password();
            if ($verify_password === true) {
                /* crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions want the parameter: as an array with, currently only used with 'cost' => XX */
                $hash_cost_factor = (Config::get('hash_cost_factor') !== null) ? Config::get('hash_cost_factor') : null;
                $data['user_password_hash'] = password_hash($_POST['user_password'], PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
            } elseif ($verify_password === false) {
                return false;
            }

            /*

              // Megvizsgáljuk, hogy van-e már ilyen nevű user (de nem az amit módosítani akarunk)
              $this->query->reset();
              $this->query->set_table(array('site_users'));
              $this->query->set_columns(array('user_id'));
              $this->query->set_where('user_name', '=', $data['user_name']);
              //itt megadjuk, hogy nem vonatkozik a bejelentkezett user-re (mert ha nem módosítja a nevet akkor már van ilyen user név)
              $this->query->set_where('user_id', '!=', $user_id);
              $result = $this->query->select();

              // ha már van ilyen nevű felhasználó
              if (count($result) == 1) {
              Message::set('error', 'username_already_taken');
              return false;
              }
             */

            if (!is_null($data['user_email'])) {
                // Megvizsgáljuk, hogy van-e már ilyen email cím user (de nem az amit módosítani akarunk)
                $this->query->reset();
                $this->query->set_table(array('site_users'));
                $this->query->set_columns(array('user_email'));
                $this->query->set_where('user_email', '=', $data['user_email']);
                //itt megadjuk, hogy nem vonatkozik a bejelentkezett user-re (mert ha nem módosítja a nevet akkor már van ilyen user név)
                $this->query->set_where('user_id', '!=', $user_id);
                $result = $this->query->select();


                // ha már van ilyen email cím
                if (count($result) == 1) {
                    Message::set('error', 'user_email_already_taken');
                    return false;
                }
            }
            // hírlevélre feliratkozás check box $_POST adat
            if (isset($_POST['user_newsletter'])) {
                $data['user_newsletter'] = (int) $_POST['user_newsletter'];
            } else {
                $data['user_newsletter'] = 0;
            }
            
            $data['name_or_company'] = $_POST['name_or_company'];
            $data['invoice_address'] = $_POST['invoice_address'];
            $data['delivery_address'] = $_POST['delivery_address'];

            // új adatok beírása az adatbázisba (update) a $data tömb tartalmazza a frissítendő adatokat 
            $this->query->reset();
            $this->query->set_table(array('site_users'));
            $this->query->set_where('user_id', '=', $user_id);
            $result = $this->query->update($data);

            if ($result >= 0) {
                // ha a bejelentkezett user adatait módosítjuk, akkor a session adataokat is frissíteni kell

                if (Session::get('user_site_id') == $user_id) {
                    // Módosítjuk a $_SESSION tömben is a user adatait!
                    Session::set('user_site_name', $data['user_name']);
                    Session::set('user_site_email', $data['user_email']);
                }
                Message::set('success', 'user_data_update_success');
                return true;
            } else {
                Message::set('error', 'unknown_error');
                return false;
            }
        } else {
            // ha valamilyen hiba volt a form adataiban
            // a hibaüzenetek beíródnak a session-be a metódus elején
            return false;
        }
    }

    function __destruct() {
        parent::__destruct();
    }

}

?>
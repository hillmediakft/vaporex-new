<?php 

class user_model extends Site_model {

	function __construct()
	{
		parent::__construct();
	}
	
	function __destruct()
	{
		parent::__destruct();
	}	

	/**
	 *	Felhasználók listája (lekérdezés)
	 *
	 */
	public function site_users_query()
	{
		$this->query->reset();
		$this->query->set_table(array('site_users'));
		$this->query->set_columns(array('user_id', 'user_name', 'user_email', 'user_active', 'user_newsletter'));
		//$this->query->set_where('user_active', '=', 1);
		$result = $this->query->select();
	
		return $result;
	}

	/**
	 *	Ellenőrzi a felhasználótól kapott adatokat
	 *	
	 *	@param	array	$data
	 *	@return	bool
	 */	
	private function verify_user_data($data)
	{
		$messages = array();
	
		// User név ellenőrzés
		if (empty($data['user_name'])) {
			$messages[] = Message::send('username_field_empty');
		}  
    /*
        else {
			if (!preg_match('/^[\_a-záöőüűóúéíÁÖŐÜŰÓÚÉÍ\d]{2,64}$/i', $data['user_name'])) {
				$messages[] = Message::send('username_does_not_fit_pattern');
			} 	
		} 
    */
		// Jelszó ellenőrzés
		if (empty($data['user_password'])) {
			$messages[] = Message::send('password_field_empty');
		}

		if (empty($messages)) {
			return true;
		} else {
			//hibaüzeneteket tartalmazó tömb
			return $messages;
		}
	}
	
	
    /**
     * Login process (for DEFAULT user accounts).
     * Users who login with Facebook etc. are handled with loginWithFacebook()
     * @return bool success state
     */
    public function login()
    {
		// ha már be van jelentkezve
		if(isset($_SESSION['user_site_logged_in']) && ($_SESSION['user_site_logged_in'] === true)){
			$message[] = Message::send('Ön már be van jelentkezve.');
			return json_encode(array(
				"status" => 'error',
				"message" => $message
			));
		}
		
        // felhasználótól kapott adatok tisztítása
        if(isset($_POST['user_name'])){
            $_POST['user_name'] = strip_tags($_POST['user_name']);
        }
        if(isset($_POST['user_password'])){
            $_POST['user_password'] = strip_tags($_POST['user_password']);
        }
        
		$verify_result = $this->verify_user_data($_POST);
	
		if($verify_result === true){
		
		    // get user's data
			// (we check if the password fits the password_hash via password_verify() some lines below)
			$sth = $this->connect->prepare("SELECT user_id,
											  user_name,
											  user_email,
											  user_password_hash,
											  user_active,
											  user_role_id,
											  user_failed_logins,
											  user_last_failed_login
									   FROM   site_users
									   WHERE  (user_name = :user_name OR user_email = :user_name)
											  AND user_provider_type = :provider_type");
			// DEFAULT is the marker for "normal" accounts (that have a password etc.)
			// There are other types of accounts that don't have passwords etc. (FACEBOOK)
			$sth->execute(array(':user_name' => $_POST['user_name'], ':provider_type' => 'default'));
			$count =  $sth->rowCount();
			// if there's NOT one result
			
			if ($count != 1) {
				// was USER_DOES_NOT_EXIST before, but has changed to LOGIN_FAILED
				// to prevent potential attackers showing if the user exists
				$message[] = Message::send('Hibás felhasználónév!');
				return json_encode(array(
					"status" => 'error',
					"message" => $message
				));				
			}

			// fetch one row (we only have one result)
			$result = $sth->fetch(PDO::FETCH_OBJ);
			
			// block login attempt if somebody has already failed 3 times and the last login attempt is less than 30sec ago
			if (($result->user_failed_logins >= 3) AND ($result->user_last_failed_login > (time()-30))) {
				
				$message[] = Message::send('password_wrong_3_times');
				return json_encode(array(
					"status" => 'error',
					"message" => $message
				));				
				
			}
			// check if hash of provided password matches the hash in the database
			if (password_verify($_POST['user_password'], $result->user_password_hash)) {

				// HA MÉG NINCS EMAILEN AKTIVÁLVA (a user_active -nak 1-nek lennie) 		
				if ($result->user_active != 1) {
					$message[] = Message::send('account_not_activated_yet');
					return json_encode(array(
						"status" => 'error',
						"message" => $message
					));	
				}
				

				// login process, write the user data into session
				Session::init();
				Session::set('user_site_logged_in', true);
                Session::set('user_site_last_activity', time()); // bejelentkezés, illetve utolsó aktivitás ideje
				Session::set('user_site_id', $result->user_id);
				Session::set('user_site_name', $result->user_name);
				Session::set('user_site_email', $result->user_email);
				Session::set('user_site_role_id', $result->user_role_id);
				Session::set('user_site_provider_type', 'default');
				

				// reset the failed login counter for that user (if necessary)
				if ($result->user_last_failed_login > 0) {
					$sql = "UPDATE site_users SET user_failed_logins = 0, user_last_failed_login = NULL
							WHERE user_id = :user_id AND user_failed_logins != 0";
					$sth = $this->connect->prepare($sql);
					$sth->execute(array(':user_id' => $result->user_id));
				}

				// generate integer-timestamp for saving of last-login date
				$user_last_login_timestamp = time();
				// write timestamp of this login into database (we only write "real" logins via login form into the
				// database, not the session-login on every page request
				$sql = "UPDATE site_users SET user_last_login_timestamp = :user_last_login_timestamp WHERE user_id = :user_id";
				$sth = $this->connect->prepare($sql);
				$sth->execute(array(':user_id' => $result->user_id, ':user_last_login_timestamp' => $user_last_login_timestamp));

				// if user has checked the "remember me" checkbox, then write cookie
				if (isset($_POST['user_rememberme'])) {

					// generate 64 char random string
					$random_token_string = hash('sha256', mt_rand());

					// write that token into database
					$sql = "UPDATE site_users SET user_rememberme_token = :user_rememberme_token WHERE user_id = :user_id";
					$sth = $this->connect->prepare($sql);
					$sth->execute(array(':user_rememberme_token' => $random_token_string, ':user_id' => $result->user_id));

					// generate cookie string that consists of user id, random string and combined hash of both
					$cookie_string_first_part = $result->user_id . ':' . $random_token_string;
					$cookie_string_hash = hash('sha256', $cookie_string_first_part);
					$cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;

					// set cookie
					setcookie('rememberme', $cookie_string, time() + COOKIE_RUNTIME, "/", COOKIE_DOMAIN);
				}
	
				// return true to make clear the login was successful
				return json_encode(array(
					"status" => 'logged_in'
				));	

			} else {
				// increment the failed login counter for that user
				$sql = "UPDATE site_users
						SET user_failed_logins = user_failed_logins+1, user_last_failed_login = :user_last_failed_login
						WHERE user_name = :user_name OR user_email = :user_name";
				$sth = $this->connect->prepare($sql);
				$sth->execute(array(':user_name' => $_POST['user_name'], ':user_last_failed_login' => time() ));

				// feedback message
				$message[] = Message::send('password_wrong');
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
     * Log out process, deletes cookie, deletes session
     */
    public function logout()
    {
        // set the remember-me-cookie to ten years ago (3600sec * 365 days * 10).
        // that's obviously the best practice to kill a cookie via php
        // @see http://stackoverflow.com/a/686166/1114320
        setcookie('rememberme', false, time() - (3600 * 3650), '/');

        // delete the session
        Session::destroy();
    }
	
    /*
     * Lekérdezzük egy bizonyos e-mail címmel rendelkező user nevét és password-ját (elfelejtett jelszó esetén)
     *
     *  @param  string  $email_address
     */
    public function user_name_pw_query($email_address)
    {
        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_columns(array('user_name', 'user_password_hash'));
        $this->query->set_where('user_email', '=', $email_address);
        return $this->query->select();
    }
    
    /*
     * Új jelszó adatbázisba írása (elfelejtett jelszó esetén)
     *
     *  @param  string  $email_address
     *  @param  string  $password_hash
     */
    public function set_user_password($email_address, $password_hash)
    {
        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_where('user_email', '=', $email_address);
        return $this->query->update(array('user_password_hash' => $password_hash));
    }
    
    /**
     * performs the login via cookie (for DEFAULT user account, FACEBOOK-accounts are handled differently)
     * @return bool success state
     */
    public function loginWithCookie()
    {
        $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';

        // do we have a cookie var ?
        if (!$cookie) {
            Message::set('error', 'cookie_invalid');
            return false;
        }

        // check cookie's contents, check if cookie contents belong together
        list ($user_id, $token, $hash) = explode(':', $cookie);
        if ($hash !== hash('sha256', $user_id . ':' . $token)) {
            Message::set('error', 'cookie_invalid');
            return false;
        }

        // do not log in when token is empty
        if (empty($token)) {
            Message::set('error', 'cookie_invalid');
            return false;
        }

        // get real token from database (and all other data)
        $query = $this->connect->prepare("SELECT user_id, user_name, user_email, user_password_hash, user_active,
                                          user_role_id,  user_has_avatar, user_failed_logins, user_last_failed_login
                                     FROM users
                                     WHERE user_id = :user_id
                                       AND user_rememberme_token = :user_rememberme_token
                                       AND user_rememberme_token IS NOT NULL
                                       AND user_provider_type = :provider_type");
        $query->execute(array(':user_id' => $user_id, ':user_rememberme_token' => $token, ':provider_type' => 'default'));
        $count =  $query->rowCount();
        if ($count == 1) {
            // fetch one row (we only have one result)
            $result = $query->fetch(PDO::FETCH_OBJ);
            // TODO: this block is same/similar to the one from login(), maybe we should put this in a method
            // write data into session
            Session::init();
            Session::set('user_logged_in', true);
            Session::set('user_id', $result->user_id);
            Session::set('user_name', $result->user_name);
            Session::set('user_email', $result->user_email);
            Session::set('user_role_id', $result->user_role_id);
            Session::set('user_provider_type', 'default');
            

            // generate integer-timestamp for saving of last-login date
            $user_last_login_timestamp = time();
            // write timestamp of this login into database (we only write "real" logins via login form into the
            // database, not the session-login on every page request
            $sql = "UPDATE users SET user_last_login_timestamp = :user_last_login_timestamp WHERE user_id = :user_id";
            $sth = $this->connect->prepare($sql);
            $sth->execute(array(':user_id' => $user_id, ':user_last_login_timestamp' => $user_last_login_timestamp));

            // NOTE: we don't set another rememberme-cookie here as the current cookie should always
            // be invalid after a certain amount of time, so the user has to login with username/password
            // again from time to time. This is good and safe ! ;)
            Message::set('success', 'cookie_login_successful');
            return true;
        } else {
            Message::set('error', 'cookie_invalid');
            return false;
        }
    }


    /**
     * Gets the last page the user visited
     * writeUrlCookie() in libs/Application.php writes the URL of the user's page location into the cookie at every
     * page request. This is useful to redirect the user (after login via cookie) back to the last seen page before
     * his/her session expired or he/she closed the browser
     * @return string view/location the user visited
     */
    public function getCookieUrl()
    {
        $url = '';
        if (!empty($_COOKIE['lastvisitedpage'])) {
            $url = $_COOKIE['lastvisitedpage'];
        }
        return $url;
    }

     /**
     * Deletes the (invalid) remember-cookie to prevent infinitive login loops
     */
    public function deleteCookie()
    {
        // set the rememberme-cookie to ten years ago (3600sec * 365 days * 10).
        // that's obviously the best practice to kill a cookie via php
        // @see http://stackoverflow.com/a/686166/1114320
        setcookie('rememberme', false, time() - (3600 * 3650), '/');
    }

    /**
     * Returns the current state of the user's login
     * @return bool user's login status
     */
    public function isUserLoggedIn()
    {
        return Session::get('user_site_logged_in');
    }

}
?>
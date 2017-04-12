<?php
use System\Libs\LogIntoDb;
use System\Libs\Emailer;
use System\Libs\DI;
use System\Libs\Query;
use System\Libs\Auth;
 
$config['events'] = array(

	'insert_user' => function($type, $message){

		$log = new LogIntoDb();
		$log->index($type, $message);

	},
	'update_user' => function($type, $message){

		$log = new LogIntoDb();
		$log->index($type, $message);

	},
	'delete_user' => function($type, $message){

		$log = new LogIntoDb();
		$log->index($type, $message);

	},
 	'insert_property' => function($type, $message){

		$log = new LogIntoDb();
		$log->index($type, $message);

	},
	'update_property' => function($type, $message){

		$log = new LogIntoDb();
		$log->index($type, $message);

	},
	'delete_property' => function($type, $message, $id_arr){

		$log = new LogIntoDb();
		$log->addLog($type, $message, $id_arr);

	},

	'change_property_status' => function($type, $message, $id_arr){

		$log = new LogIntoDb();
		$log->changePropertyStatus($type, $message, $id_arr);

	},


	'active_property' => function($type, $message){

		$log = new LogIntoDb();
		$log->index($type, $message);

	},
	'inactive_property' => function($type, $message){

		$log = new LogIntoDb();
		$log->index($type, $message);

	},	
	'change_price' => function($price_change_data){

		$connect = DI::get('connect');	
		$query = new Query($connect);

		$from_email = $price_change_data['settings']['email'];
		$from_name = $price_change_data['settings']['ceg'];
		$subject = 'Ingatlan árváltozás értesítés';
		$template_data = array(
			'ingatlan_ref_id' => $price_change_data['ingatlan_ref_id'],
			'ingatlan_nev' => $price_change_data['ingatlan_nev'],
			'ingatlan_tipus' => $price_change_data['ingatlan_tipus'],
            'ar_eredeti' => $price_change_data['ar_eredeti'],
            'ar_uj' => $price_change_data['ar_uj'],
            'url' => $price_change_data['url'],
            'from_name' => $from_name
			);

		// email küldése a felhasználóknak
		foreach ($price_change_data['user_id_array'] as $user_id) {

			$query->set_table('users');
			$query->set_columns(array(
				'name',
				'email'
				));
			$query->set_where('id', '=', $user_id);
			$user = $query->select();

			$to_email = $user[0]['email'];
			$to_name = $user[0]['name'];

			$template_data['user_name'] = $user[0]['name'];

	        // paraméterek: ($from_email, $from_name, $to_email, $to_name, $subject, $form_data, $template)
	        $emailer = new Emailer($from_email, $from_name, $to_email, $to_name, $subject, $template_data, 'arvaltozas');
	        $emailer->send();

		}
       		
	},
	/**
	 * Email küldés (a beállított elemknél) ingatlan változás esetén
	 *
	 * @param array $ref_num_arr  - referencia számokat tartalmazó tömb
	 * @param string $message 	  - üzenet (pl.: referencia számú ingatlan létrehozva)
	 */
	'send_info_email' => function($ref_num_arr, $message){

		$connect = DI::get('connect');	
		$query = new Query($connect);

		$query->set_table('settings');
		$query->set_columns('*');
		$settings = $query->select();

		$agent = Auth::getUser('first_name') . ' ' . Auth::getUser('last_name');

		$from_email = $settings[0]['email'];
		$from_name = 'Admin rendszer üzenet';
		$subject = 'Admin rendszer üzenet - értesítés változásról';
		$to_email = $settings[0]['email'];
		$to_name = $settings[0]['ceg'];

            $html_data = "";
            foreach ($ref_num_arr as $key => $ref_num) {
                $html_data .= "<tr>\r\n";
                $html_data .= "<td><strong>#" . $ref_num . "</strong></td>";
                $html_data .= "<td>" . $message . "</td>";
                $html_data .= "</tr>\r\n";
            }

            $html_data .= "<tr>\r\n";
            $html_data .= "<td colspan='2'>&nbsp;</td>\r\n";
            $html_data .= "</tr>\r\n";

            $html_data .= "<tr>\r\n";
            $html_data .= "<td colspan='2'><strong>Referens:</strong> " . $agent . "</td>\r\n";
            $html_data .= "</tr>\r\n";


		$template_data = array(
			'html_data' => $html_data,
			);

        // paraméterek: ($from_email, $from_name, $to_email, $to_name, $subject, $form_data, $template)
        $emailer = new Emailer($from_email, $from_name, $to_email, $to_name, $subject, $template_data, 'ertesites_valtozasrol');
        $emailer->setArea('admin');
//$emailer->setDebug(true);        
        $emailer->send();
	},	 


);
?>
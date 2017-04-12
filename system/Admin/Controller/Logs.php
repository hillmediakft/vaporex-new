<?php
namespace System\Admin\Controller;
use System\Core\AdminController;
//use System\Libs\DI;
//use System\Libs\Message;
use System\Libs\Cookie;
use System\Core\View;

class Logs extends AdminController {

    function __construct() {
        parent::__construct();
        $this->loadModel('logs_model');
    }

    public function index()
    {
        // last_log_id beállítása
        $last_log_id = $this->logs_model->lastLogId();
        Cookie::set('last_log_id', $last_log_id, -1);
        // last_log_number értéke 0
        Cookie::set('last_log_number', 0, -1);

        $data['title'] = 'Naplózás oldal';
        $data['description'] = 'Naplózás oldal description';
        // userek adatainak lekérdezése
        $data['logs'] = $this->logs_model->get_logs();
 //var_dump($data);die;
        $view = new View();
        $view->add_links(array('datatable', 'vframework', 'logs'));
//$view->debug(true);   
        $view->render('logs/tpl_logs', $data);
    }

}
?>
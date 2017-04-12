<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Logs_model extends AdminModel {

    protected $table = 'logs';

    function __construct()
    {
        parent::__construct();
    }

    /**
     *  Felhasználók adatainak lekérdezése
     *
     *  @param  string|integer    $user_id (csak ennek a felhasználónak az adatait adja vissza)
     *  @return array|false
     */
    public function get_logs($user_id = null)
    {
        $this->query->set_columns(array(
            'logs.*',
            'users.first_name',
            'users.last_name',
            ));

        $this->query->set_join('left', 'users', 'users.id', '=', 'logs.user_id');
        if(!is_null($user_id)){
            $this->query->set_where('user_id', '=', $user_id);
        }
        return $this->query->select();
    }


    /**
     *  rekordok számának lekérdezése
     *
     *  @param  integer    $id (csak az ennél magyobb id-jű elemeket adja vissza)
     *  @return integer
     */
    public function lastLogs($id = null)
    {
        $this->query->set_columns(array('id'));

        if(!is_null($id)){
            $this->query->set_where('id', '>', $id);
        }

        $result = $this->query->select();
        return count($result);
    }

    /**
     *  A legnagyon id-jű rekord id lekérdezése
     *
     *  @param  integer    $id (csak az ennél magyobb id-jű elemeket adja vissza)
     *  @return integer
     */
    public function lastLogId()
    {
        $this->query->set_columns('MAX(`id`) AS `id`');
        $result = $this->query->select();
        return (int)$result[0]['id'];
    }    

}
?>
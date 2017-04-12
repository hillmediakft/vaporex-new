<?php
namespace System\Site\Model;
use System\Core\SiteModel;

class Gyik_model extends SiteModel {

    protected $table = 'gyik';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     *  Egy rekord minden adatát lekérdezi
     */
    public function oneGyik($id)
    {
        $id = (int) $id;
        $this->query->set_where('gyik_id', '=', $id);
        return $this->query->select();
    }

    /**
     *  A termékek táblázathoz kérdezi le az adatokat
     *  @return array
     */
    public function allGyik()
    {
        $this->query->set_columns(array(
          'gyik.*',
          'gyik_categories.gyik_category_name'
        ));
        $this->query->set_join('left', 'gyik_categories', 'gyik.gyik_category_id', '=', 'gyik_categories.gyik_category_id');
        return $this->query->select();
    }

    /**
     * 	Egy termék minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function oneGyikAlldata($id)
    {
        $id = (int)$id;
        $this->query->set_columns(array(
          'gyik.*',
          'gyik_categories.gyik_category_name'
        ));
        $this->query->set_join('left', 'gyik_categories', 'gyik.gyik_category_id', '=', 'gyik_categories.gyik_category_id');
        $this->query->set_where('gyik_id', '=', $id);
        return $this->query->select();
    
/*
        $result[0]['gyik_create_timestamp'] = date('Y-m-d H:i', $result[0]['gyik_create_timestamp']);
        $result[0]['gyik_update_timestamp'] = (!empty($result[0]['gyik_update_timestamp'])) ? date('Y-m-d H:i', $result[0]['gyik_update_timestamp']) : $result[0]['gyik_update_timestamp'];

        return $result[0];
*/  
    }


    /**
     * Visszaadja a gyik tábla gyik_category_id oszlop tartalmát
     * Egy kategóriához tartozó termékek számának meghatározásához kell
     * @return array
     */
    public function gyik_category_counter_query()
    {
        $this->query->set_columns('gyik_category_id');
        return $this->query->select();
    }

    /**
     * Visszaadja a gyik tábla gyik_category_id oszlop tartalmát
     * Egy kategóriához tertozó termékek számának meghatározásához kell
     * 
     * @param integer $id
     * @return array
     */
    public function gyik_number_in_category($id)
    {
        $this->query->set_columns('COUNT(*)');
        $this->query->set_where('gyik_category_id', '=', $id);
        $count = $this->query->select();
        return $count[0]['COUNT(*)'];
    }

}
?>
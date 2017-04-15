<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Gyik_model extends AdminModel {

    protected $table = 'gyik';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     *  INSERT
     */
    public function insert($data)
    {
        return $this->query->insert($data);
    }

    /**
     *  UPDATE
     */
    public function update($id, $data)
    {
        $this->query->set_where('gyik_id', '=', $id);    
        return $this->query->update($data);
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        return $this->query->delete('gyik_id', '=', $id);
    }

   /**
     *  Status mező értékét módosítja
     *  
     *  @param  integer $id 
     *  @param  integer $data (0 vagy 1)    
     *  @return integer
     */
    public function changeStatus($id, $data)
    {
        $this->query->set_where('gyik_id', '=', $id);
        return $this->query->update(array('gyik_status' => $data));
    }

    /**
     * 	Egy Gyik minden adatát lekérdezi id alapján
     *
     * @param integer $id
     * @param mixed $ajax (értéke bármi lehet ami nem false, vagy null, vagy üres string)
     */
    public function oneGyik($id, $ajax = false)
    {
        $this->query->set_columns(array(
          'gyik.*',
          'gyik_categories.gyik_category_name'
        ));
        $this->query->set_join('left', 'gyik_categories', 'gyik.gyik_category_id', '=', 'gyik_categories.gyik_category_id');
        $this->query->set_where('gyik_id', '=', $id);
        $result = $this->query->select();

        if ($ajax) {
            $result[0]['gyik_create_timestamp'] = date('Y-m-d H:i', $result[0]['gyik_create_timestamp']);
            $result[0]['gyik_update_timestamp'] = (!empty($result[0]['gyik_update_timestamp'])) ? date('Y-m-d H:i', $result[0]['gyik_update_timestamp']) : $result[0]['gyik_update_timestamp'];
        }

        return $result[0];
    }

    /**
     * 	Az összes gyik adata 
     * 	@return array
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
     * Visszaadja a gyik tábla gyik_category_id oszlop tartalmát
     * Egy kategóriához tertozó termékek számának meghatározásához kell
     * @return array
     */
    public function categoryCounter()
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
        $this->query->set_table('gyik');
        $this->query->set_columns('COUNT(*)');
        $this->query->set_where('gyik_category_id', '=', $id);
        $count = $this->query->select();
        return $count[0]['COUNT(*)'];
    }

    /**
     * Ellenőrizzük, hogy a kategória törölhető-e: tartalmaz-e terméket 	
     *
     * @param integer $id
     * @return boolean $result
     */
    public function is_category_deletable($id)
    {
        $this->query->set_table(array('gyik'));
        $this->query->set_columns('gyik_id');
        $this->query->set_where('gyik_category_id', '=', $id);
        $result = $this->query->select();

        if (!empty($result)) {
            return false;
        }
        return true;
    }


}
?>
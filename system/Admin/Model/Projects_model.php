<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Projects_model extends AdminModel {

    protected $table = 'projects';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
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
        $this->query->set_where('project_id', '=', $id);    
        return $this->query->update($data);
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        return $this->query->delete('project_id', '=', $id);
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
        $this->query->set_where('project_id', '=', $id);
        return $this->query->update(array('project_status' => $data));
    }

    /**
     * Egy referenciához tartozó kép nevét adja vissza
     */
    public function selectPicture($id)
    {
        $this->query->set_columns(array('project_photo'));
        $this->query->set_where('project_id', '=', $id);
        $result = $this->query->select();
        return $result[0]['project_photo'];
    }

    /**
     * 	Egy referencia minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function oneProjectAlldata($id)
    {
        $this->query->set_table(array('projects'));
        $this->query->set_columns(array(
          'projects.*',
          'project_categories.project_category_name'
        ));
        $this->query->set_join('left', 'project_categories', 'projects.project_category_id', '=', 'project_categories.project_category_id');
        $this->query->set_where('project_id', '=', $id);
        return $this->query->select();
    }

    /**
     * 	Egy referencia minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function oneProjectAlldata_ajax($id)
    {
        $this->query->set_table(array('projects'));
        $this->query->set_columns(array(
          'projects.*',
          'project_categories.project_category_name'
        ));
        $this->query->set_join('left', 'project_categories', 'projects.project_category_id', '=', 'project_categories.project_category_id');
        $this->query->set_where('project_id', '=', $id);
        $result = $this->query->select();

        $result[0]['project_create_timestamp'] = date('Y-m-d H:i', $result[0]['project_create_timestamp']);
        $result[0]['project_update_timestamp'] = (!empty($result[0]['project_update_timestamp'])) ? date('Y-m-d H:i', $result[0]['project_update_timestamp']) : $result[0]['project_update_timestamp'];

        return $result[0];
    }

    /**
     * 	Egy termék minden "nyers" adatát lekérdezi
     * 	A termék módosításához kell 
     */
    public function selectOneProject($id)
    {
        $this->query->set_where('project_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	A termékek táblázathoz kérdezi le az adatokat
     * 	@return array
     */
    public function allProjects()
    {
        $this->query->set_table(array('projects'));
        $this->query->set_columns(array(
          'projects.*',
          'project_categories.project_category_name'
        ));
        $this->query->set_join('left', 'project_categories', 'projects.project_category_id', '=', 'project_categories.project_category_id');

        return $this->query->select();
    }


    /**
     * Visszaadja a projects tábla project_category_id oszlop tartalmát
     * Egy kategóriához tertozó termékek számának meghatározásához kell
     * @return array
     */
    public function categoryCounter()
    {
        $this->query->set_columns('project_category_id');
        return $this->query->select();
    }

    /**
     * Visszaadja az egy kategóriához tartozó rekordok számát
     * 
     * @param integer $id
     * @return array
     */
    public function project_number_in_category($id)
    {
        $this->query->set_columns('COUNT(*)');
        $this->query->set_where('project_category_id', '=', $id);
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
        $this->query->set_columns('project_id');
        $this->query->set_where('project_category_id', '=', $id);
        $result = $this->query->select();

        if (!empty($result)) {
            return false;
        }
        return true;
    }

}
?>
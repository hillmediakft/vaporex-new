<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Project_categories_model extends AdminModel {

    protected $table = 'project_categories';

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
        $this->query->set_where('project_category_id', '=', $id);    
        return $this->query->update($data);
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        return $this->query->delete('project_category_id', '=', $id);
    }

    /**
     * 	Lekérdezi a termékkategóriát a project_categories táblából 
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni)
     * 	@return	array	
     */
    public function selectOneCategory($id)
    {
        $this->query->set_where('project_category_id', '=', $id);
        return $this->query->select();
    }

    /**
     *  Lekérdezi a termék kategóriákat a projects_categories táblából (és az id-ket)
     *  @param  integer $id  (ha csak egy elemet akarunk lekérdezni)
     *  @return array   
     */
    public function selectAllCategories()
    {
        return $this->query->select();
    }
 

    /**
     * Kategória alá tartozó kategóriák (children nodes) 
     *  
     * @param integer $cat_id
     * @return array $children_array a leszármazottak 
     */
    public function get_children($cat_id)
    {
        $this->query->set_columns('project_category_id');
        $this->query->set_where('project_category_parent', '=', $cat_id);
        $children = $this->query->select();
        $children_array = array();
        if (!empty($children)) {
            foreach ($children as $key => $value) {
                $children_array[] = $children[$key]['project_category_id'];
            }
        }
        return $children_array;
    }

}
?>
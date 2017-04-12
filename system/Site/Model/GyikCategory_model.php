<?php
namespace System\Site\Model;
use System\Core\SiteModel;

class GyikCategory_model extends SiteModel {

    protected $table = 'gyik_categories';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 	Lekérdezi a termékkategóriát a gyik_categories táblából 
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni)
     * 	@return	array	
     */
    public function selectOneCategory($id)
    {
        $id = (int)$id;    
        $this->query->set_where('gyik_category_id', '=', $id);
        return $this->query->select();
    }

    /**
     * 	Lekérdezi a kategóriák nevét és id-jét 
     */
    public function selectAllCategory()
    {
        $result = $this->query->select();
    }

    /**
     * INSERT
     */
    public function insert($data)
    {
        return $this->query->insert($data);
    }

    /**
     * UPDATE
     */
    public function update($id, $data)
    {
        $this->query->set_where('gyik_category_id', '=', $id);    
        return $this->query->update($data);
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        return $this->query->delete('gyik_category_id', '=', $id);
    }

    /**
     * Kategória alá tartozó kategóriák (children nodes) 
     *  
     * @param integer $cat_id
     * @return array $children_array a leszármazottak 
     */
    public function getChildren($cat_id)
    {
        $this->query->set_columns('gyik_category_id');
        $this->query->set_where('gyik_category_parent', '=', $cat_id);
        $children = $this->query->select();
        $children_array = array();
        if (!empty($children)) {
            foreach ($children as $key => $value) {
                $children_array[] = $children[$key]['gyik_category_id'];
            }
        }
        return $children_array;
    }    

}
?>
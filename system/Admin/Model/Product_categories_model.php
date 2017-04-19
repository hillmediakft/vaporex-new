<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Product_categories_model extends AdminModel {

    protected $table = 'product_categories';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Kategória hozzzáadása
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
        $this->query->set_where('product_category_id', '=', $id);    
        return $this->query->update($data);
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        return $this->query->delete('product_category_id', '=', $id);
    }

    /**
     * Egy termékhez tartozó kép nevét adja vissza
     */
    public function selectPicture($id)
    {
        $this->query->set_columns(array('product_category_photo'));
        $this->query->set_where('product_category_id', '=', $id);
        $result = $this->query->select();
        return $result[0]['product_category_photo'];
    }

    /**
     *  Lekérdezi a termékkategóriát a product_categories táblából 
     *  @param  integer $id  (ha csak egy elemet akarunk lekérdezni)
     *  @return array   
     */
    public function oneCategory($id)
    {
        $this->query->set_where('product_category_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     *  Lekérdezi a kategóriák nevét és id-jét 
     */
    public function categoryList()
    {
        $this->query->set_columns(array('product_category_id', 'product_category_name'));
        return $this->query->select();
    }


    /**
     * 	Lekérdezi a termék kategóriákat, a szülő adataival a products_categories táblából 
     * 
     * 	@return	array a kategóriák tömbben	
     */
    public function productCategories()
    {
        $this->query->set_table('product_categories a');
        $this->query->set_columns(
            'a.product_category_id AS cat_id,
            a.product_category_name AS cat_name,
            b.product_category_id AS parent_id,
            b.product_category_name AS parent_name,
            a.product_category_photo'
            );

        $this->query->set_join('left', 'product_categories b', 'a.product_category_parent = b.product_category_id');
        $this->query->set_orderby('cat_id', 'ASC');
        return $this->query->select();
    }

    /**
     * 	Lekérdezi a termék kategóriákat, a szülőv dataival a products_categories táblából 
     * 
     * 	@return	array a kategóriák tömbben	
     */
    public function categoriesLevels($category_id)
    {
        $this->query->set_table('product_categories AS t1');
        $this->query->set_columns(
            't1.product_category_name AS lev1,
            t2.product_category_name as lev2,
            t3.product_category_name as lev3,
            t4.product_category_name as lev4'
        );
        $this->query->set_join('left', 'product_categories AS t2', 't1.product_category_parent = t2.product_category_id');
        $this->query->set_join('left', 'product_categories AS t3', 't2.product_category_parent = t3.product_category_id');
        $this->query->set_join('left', 'product_categories AS t4', 't3.product_category_parent = t4.product_category_id');
        $this->query->set_where('t1.product_category_id', '=', $category_id);
        $result = $this->query->select();
        return $result[0];
  }

    /**
     * Egy kategória alá tartozó alkategóriák lekérdezése  
     *
     * @param integer $id
     * @return array kategóriák tömbje
     */
    public function get_subcategory($cat_id)
    {
        $this->query->set_columns(array('product_category_id', 'product_category_parent', 'product_category_name'));
        $this->query->set_where('product_category_parent', '=', $cat_id);
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
        $this->query->set_columns('product_category_id');
        $this->query->set_where('product_category_parent', '=', $cat_id);
        $children = $this->query->select();
        $children_array = array();
        if (!empty($children)) {
            foreach ($children as $key => $value) {
                $children_array[] = $children[$key]['product_category_id'];
            }
        }
        return $children_array;
    }

}
?>
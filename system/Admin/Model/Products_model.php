<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Products_model extends AdminModel {

    protected $table = 'products'; 

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
        $this->query->set_where('product_id', '=', $id);    
        return $this->query->update($data);
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        return $this->query->delete('product_id', '=', $id);
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
        $this->query->set_where('product_id', '=', $id);
        return $this->query->update(array('product_status' => $data));
    }

    /**
     * Egy termékhez tartozó kép nevét adja vissza
     */
    public function selectPicture($id)
    {
        $this->query->set_columns(array('product_photo'));
        $this->query->set_where('product_id', '=', $id);
        $result = $this->query->select();
        return $result[0]['product_photo'];
    }

    /**
     * Visszaada az egy bizonyos kategóriához tartozó rekordok id-jét
     */
    public function selectCategoryById($id)
    {
        $this->query->set_columns('product_id');
        $this->query->set_where('product_category_id', '=', $id);
        return $this->query->select();
    }

    /**
     * 	Egy termék minden adatát lekérdezi + a kategória nevét join-al
     */
    public function oneProduct($id)
    {
        $this->query->set_columns(array(
            'products.*',
            'product_categories.product_category_name'
        ));
        $this->query->set_join('left', 'product_categories', 'products.product_category_id', '=', 'product_categories.product_category_id');
        $this->query->set_where('product_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	A termékek táblázathoz kérdezi le az adatokat
     * 	@return array
     */
    public function allProducts()
    {
        $this->query->set_columns(array(
          'products.*',
          'product_categories.product_category_name'
        ));
        $this->query->set_join('left', 'product_categories', 'products.product_category_id', '=', 'product_categories.product_category_id');
        return $this->query->select();
    }

    /**
     * Visszaadja a products tábla product_category_id oszlop tartalmát
     * Egy kategóriához tartozó termékek számának meghatározásához kell
     * @return array
     */
    public function productCategoryCounter()
    {
        $this->query->set_columns('product_category_id');
        return $this->query->select();
/*    
        $temp = array();
        // temp tomb feltöltése: kulcs a product_category_id, érték termék darabszáma
        foreach ($result as $value) {
            if (isset($temp[$value['product_category_id']])) {
                $temp[$value['product_category_id']] ++;
            } else {
                $temp[$value['product_category_id']] = 1;
            }
        }

        return $temp;
*/        
    }

    /**
     * Visszaadja hogy egy bizonyos id-jű termék kategóriához mennyi termék tartozik
     * 
     * @param integer $id
     * @return integer
     */
    public function product_number_in_category($id)
    {
        $this->query->set_table('products');
        $this->query->set_columns('COUNT(*)');
        $this->query->set_where('product_category_id', '=', $id);
        $count = $this->query->select();
        return intval($count[0]['COUNT(*)']);
    }

}
?>
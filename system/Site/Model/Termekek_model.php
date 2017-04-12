<?php
namespace System\Site\Model;
use System\Core\SiteModel;
use System\Libs\DI;
use System\Libs\Config;

class Termekek_model extends SiteModel {

    protected $table = 'products';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 	A kategóriák megjelenítése a termékek oldalon
     */
    public function product_categories($id = 0)
    {
        $html = '';

        $str_helper = DI::get('str_helper');

        $product_categories = $this->get_categories($id);

        if (!empty($product_categories)) {
            $html .= '<ul class="product-grid">';
            foreach ($product_categories as $key => $value) {

                $subcategories = $this->get_subcategories($value['product_category_id']);
                $html .= '<li class="animated " data-animation="fadeInUp" >';
                $html .= '<div class="product-container">';
                $html .= '<div class="product-image">';
                $html .= '<img src="' . Config::get('categoryphoto.upload_path') . $value['product_category_photo'] . '" alt="">';
                $html .= '</a>';
                $html .= '</div>';

                $html .= '<div class="product-bottom">';
                $html .= '<a href="' . $this->request->get_uri('site_url') . 'termekek/' . 'kategoria/' . $str_helper->stringToSlug($value['product_category_name']) . '/' . $value['product_category_id'] . '">' . $value['product_category_name'] . ' (' . $this->get_product_count($value['product_category_id']) . ')</a>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</li>';
            }
            $html .= '</ul>';
        } else {
            $html = '<div class="alert alert-info">Nem található termék</div>';
        }
        return $html;
    }

    /**
     * 	A fókategóriák megjelenítése a termékek oldalon
     */
    public function is_products_in_category($cat_id) {

        $products = $this->all_products_in_category($cat_id);
        if (empty($products)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 	A fókategóriák megjelenítése a termékek oldalon
     */
    public function products_in_category($cat_id) {
        $html = '';
        $products = $this->all_products_in_category($cat_id);

        $html .= '<ul class="product-grid">';
        foreach ($products as $key => $value) {


            $html .= '<li class="animated " data-animation="fadeInUp" >';
            $html .= '<div class="product-container">';
            $html .= '<div class="product-image">';
            $html .= '<img src="' . Config::get('productphoto.upload_path') . $value['product_photo'] . '" alt="">';
            $html .= '</a>';
            $html .= '</div>';

            $html .= '<div class="product-bottom">';

            $html .= '<span class="product-name">';
            $html .= $value['product_title'];
            $html .= '</span>';
            $html .= $value['product_description'];
            $html .= '<div class="price-box"> <span class="price-regular">' . $value['product_price'] . 'Ft</span> </div>';
            $html .= '<div class="btn-group"> <a href="termekek/' . $value['product_id'] . '" class="btn btn-primary ">Részletek </a> </div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    /**
     * 	A főkategóriák megjelenítése a termékek oldalon
     */
    public function product_details($id) {

        $products = $this->one_product_alldata_query($id);

        return $products[0];
    }

    /**
     * 	Fő kategóriák lekérdezése - ahol a parent == 0  	
     *
     * 	@return array
     */
    public function get_categories($id = 0)
    {
        $this->query->set_table('product_categories');
        $this->query->set_columns('*');
        $this->query->set_where('product_category_parent', '=', $id);
        return $this->query->select();
    }

    /**
     * 	Egy termék minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function one_product_alldata_query($id)
    {
        $id = (int) $id;

        $this->query->set_table(array('products'));
        $this->query->set_columns(array('products.*', 'product_categories.product_category_name'));
        $this->query->set_where('product_id', '=', $id);
        $this->query->set_join('left', 'product_categories', 'products.product_category_id', '=', 'product_categories.product_category_id');
        return $this->query->select();
    }

    /**
     * 	Egy termék minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function get_product_category_by_id($id)
    {
        $id = (int) $id;

        $this->query->set_table(array('products'));
        $this->query->set_columns(array(
            'product_category_id'
        ));
        $this->query->set_where('product_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	Egy munka minden "nyers" adatát lekérdezi
     * 	A munka módosításához kell (itt az id-kre van szükség, és nem a hozzájuk tartozó névre)	
     */
    public function one_product_query($id)
    {
        $id = (int) $id;
        $this->query->set_table(array('products'));
        $this->query->set_columns('*');
        $this->query->set_where('product_id', '=', $id);
        return $this->query->select();
    }

    /**
     * 	Egy munka minden "nyers" adatát lekérdezi
     * 	A munka módosításához kell (itt az id-kre van szükség, és nem a hozzájuk tartozó névre)	
     */
    public function get_product_name_by_id($id)
    {
        $id = (int) $id;
        $this->query->set_table(array('products'));
        $this->query->set_columns('*');
        $this->query->set_where('product_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	kategória nevét kérdezi le id alapján
     * 	A munka módosításához kell (itt az id-kre van szükség, és nem a hozzájuk tartozó névre)	
     */
    public function get_category_name_by_id($id)
    {
        $id = (int) $id;
        $this->query->set_table(array('product_categories'));
        $this->query->set_columns('*');
        $this->query->set_where('product_category_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	Egy kategórához tartozó termékeket kérdezi le
     * 	@param integer $cat_id a termék kategória
     */
    public function all_products_in_category($cat_id)
    {
        $this->query->set_table(array('products'));
        $this->query->set_columns('*');
        $this->query->set_where('product_category_id', '=', $cat_id);

        return $this->query->select();
    }

    /**
     * 	A munkák táblázathoz kérdezi le az adatokat
     * 	Itt nem kell minden adat egy munkáról
     */
    public function all_products_query()
    {
        $this->query->set_table(array('products'));
        $this->query->set_columns(array(
            'products.product_id',
            'products.product_title',
            'products.product_description',
            'products.product_status',
            'products.product_photo',
            'products.product_price',
            'products.product_create_timestamp',
            'products.product_update_timestamp',
            'products.product_category_id',
            'product_categories.product_category_name'
        ));
        $this->query->set_join('left', 'product_categories', 'products.product_category_id', '=', 'product_categories.product_category_id');

        return $this->query->select();
    }

    /**
     * 	Lekérdezi a munka típusokat a product_categories táblából
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni, pl.: munka kategória módosításhoz)
     * 	@return	array	
     */
    public function product_categories_query($id = null)
    {
        $this->query->set_table('product_categories a');
        $this->query->set_columns('a.product_category_id AS cat_id, a.product_category_name_hu AS cat_name,b.product_category_id AS parent_id, b.product_category_name AS parent_name, a.product_category_photo'
        );

        /*
         * 


          $sql2 = '
          SELECT a.product_category_id AS "Cat_ID",
          a.product_category_name_hu AS "Category Name",
          b.product_category_id AS "Parent ID",
          b.product_category_name_hu AS "Parent Name"
          FROM product_categories a
          LEFT JOIN product_categories b ON a.product_category_parent = b.product_category_id';
          $sql = '
         */


        $this->query->set_join('left', 'product_categories b', 'a.product_category_parent', '=', 'b.product_category_id');

        return $this->query->select();
    }

    /**
     * 	Lekérdezi a munka típusokat a products_list táblából (és az id-ket)
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni, pl.: munka kategória módosításhoz)
     * 	@return	array	
     */
    public function product_categories_query_ORIG($id = null) {
        $this->query->reset();
        $this->query->set_table(array('product_categories'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('product_category_id', '=', $id);
        }

        return $this->query->select();
    }

    /**
     * 	Termék kategóriákból menu létrehozása  	
     *
     * 	@return string html lista
     */
    public function get_category_menu() {
        $categories = $this->get_categories();
        $list = '';
        foreach ($categories as $value) {
            // fő kategória kezdete
            $list .= '<li>';
            // fő kategória neve
            $list .= '<a href="#">' . $value['product_category_name'] . ' (' . $this->get_product_count(($value['product_category_id'])) . ') ' . '<span class="glyphicon arrow"></span></a>';
            // fő kategórián belüli lista kezdete
            $list .= '<ul>';
            // alkategória kezdete
            $sub_categories = $this->get_subcategories($value['product_category_id']);

// *************** ALKATEGÓRIA CIKLUS ***************** //
            foreach ($sub_categories as $sub_value) {
                // alketegória neve
                $list .= '<li><a href="#">' . $sub_value['product_category_name'] . ' (' . $this->get_product_count(($sub_value['product_category_id'])) . ') ' . '<span class="fa plus-times"></span></a>';
                // alkategórián belüli lista kezdete
                $list .= '<ul>';

                // al-alkategória kezdete
                $sub_sub_categories = $this->get_subcategories($sub_value['product_category_id']);

                // al-alkategória ciklus
                foreach ($sub_sub_categories as $sub_sub_value) {
                    // al-alkategória neve
                    $list .= '<li><a href="#">' . $sub_sub_value['product_category_name'] . ' (' . $this->get_product_count(($sub_sub_value['product_category_id'])) . ') ' . '<span class="fa plus-times"></span></a>';
                    // alkategórián belüli lista kezdete
                    $list .= '<ul>';

                    // al-al-alkategória kezdete
                    $sub_sub_sub_categories = $this->get_subcategories($sub_sub_value['product_category_id']);

                    // al-al-alkategória ciklus
                    foreach ($sub_sub_sub_categories as $sub_sub_sub_value) {
                        // al-al-alkategória neve
                        $list .= '<li><a href="#">' . $sub_sub_sub_value['product_category_name'] . ' (' . $this->get_product_count(($sub_sub_sub_value['product_category_id'])) . ') ' . '<span class="fa plus-times"></span></a>';
                        // alkategórián belüli lista kezdete
                        $list .= '<ul>';


                        // AL-AL-ALKATEGÓRIA TERMÉKEI
                        $sub_sub_sub_products = $this->get_products($sub_sub_sub_value['product_category_id']);
                        foreach ($sub_sub_sub_products as $sub_sub_sub_product_value) {

                            $list .= '<li><a href="' . $this->request->get_uri('site_url') . 'termekek/' . $sub_sub_sub_product_value['product_id'] . '">' . $sub_sub_sub_product_value['product_title'] . '</a></li>';
                        }
                        $list .= '</ul>';
                        $list .= '</li>';
                    }

                    // AL-ALKATEGÓRIA TERMÉKEI
                    $sub_sub_products = $this->get_products($sub_sub_value['product_category_id']);
                    foreach ($sub_sub_products as $sub_sub_product_value) {

                        $list .= '<li><a href="' . $this->request->get_uri('site_url') . 'termekek/' . $sub_sub_product_value['product_id'] . '">' . $sub_sub_product_value['product_title'] . '</a></li>';
                    }
                    $list .= '</ul>';
                    $list .= '</li>';
                }

                // ALKATEGÓRIA TERMÉKEI
                $sub_products = $this->get_products($sub_value['product_category_id']);
                foreach ($sub_products as $sub_product_value) {

                    $list .= '<li><a href="' . $this->request->get_uri('site_url') . 'termekek/' . $sub_product_value['product_id'] . '">' . $sub_product_value['product_title'] . '</a></li>';
                }
                $list .= '</ul>';
                $list .= '</li>';
            }

            // FŐKATEGÓRIA TERMÉKEI
            $products = $this->get_products($value['product_category_id']);
            foreach ($products as $product_value) {

                $list .= '<li><a href="' . $this->request->get_uri('site_url') . 'termekek/' . $product_value['product_id'] . '">' . $product_value['product_title'] . '</a></li>';
            }

            // fő kategória vége
            $list .= '</ul>';
            $list .= '</li>';
        }
        return $list;
    }

    /**
     * Kategória közvetlen alkategóriáinak lekérdezése (children nodes)  	
     *
     * @param integer $cat_id kategória id-je
     * @return array
     */
    public function get_subcategories($cat_id) {
        $this->query->reset();
        $this->query->set_table('product_categories');
        $this->query->set_columns('*');
        $this->query->set_where('product_category_parent', '=', $cat_id);
        return $this->query->select();
    }

    /**
     * Kategória közvetlen alkategóriáinak lekérdezése (children nodes)  	
     *
     * @param integer $cat_id kategória id-je
     * @return array
     */
    public function get_subcategory_count($cat_id) {
        $this->query->reset();
        $this->query->set_table('product_categories');
        $this->query->set_columns(array('product_category_id'));
        $this->query->set_where('product_category_parent', '=', $cat_id);
        return count($this->query->select());
    }

    /**
     * Termékek lekérdezése kategória szerint 	
     *
     * @param integer $cat_id kategória id-je
     * @return array 
     */
    public function get_products($cat_id) {
        $this->query->reset();
        $this->query->set_table('products');
        $this->query->set_columns('*');
        $this->query->set_where('product_category_id', '=', $cat_id);
        return $this->query->select();
    }

    /**
     * Termékekek száma kategóriában és az alá tartozó kategóriákban 	
     *
     * @param integer $cat_id kategória id-je
     * @return int a termékek száma
     */
    public function get_product_count($cat_id) {
        $count = $this->get_product_count_in_category($cat_id);

        $children = $this->get_children($cat_id);
        if (!empty($children)) {
            foreach ($children as $value) {
                $count = $count + $this->get_product_count_in_category($value);
                $sub_children = $this->get_children($value);
                if (!empty($sub_children)) {
                    foreach ($sub_children as $sub_value) {
                        $count = $count + $this->get_product_count_in_category($sub_value);
                        $sub_sub_children = $this->get_children($sub_value);
                        if (!empty($sub_sub_children)) {
                            foreach ($sub_sub_children as $sub_sub_value) {
                                $count = $count + $this->get_product_count_in_category($sub_sub_value);
                            }
                        }
                    }
                }
            }
        }

        return $count;
    }

    /**
     * Kategória alá tartozó kategóriák (children nodes) 
     * 	
     * @param integer $cat_id
     * @return array $children_array a leszármazottak 
     */
    public function get_children($cat_id) {
        $this->query->reset();
        $this->query->set_table('product_categories');
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

    /**
     * Termékekek száma a kategóriában  	
     *
     * @param integer $id termék kategória id-je
     * @return int a termékek száma
     */
    public function get_product_count_in_category($cat_id) {
        $this->query->reset();
        $this->query->set_table('products');
        $this->query->set_columns('COUNT(*)');
        $this->query->set_where('product_category_id', '=', $cat_id);
        $count = $this->query->select();

        return $count[0]['COUNT(*)'];
    }

    /**
     * 	Lekérdezi a termék kategóriákat, a szülőv dataival a products_categories táblából 
     * 
     * 	@return	array a kategóriák tömbben	
     */
    public function product_category_path_with_link($category_id)
    {
        $path = '';

        $str_helper = DI::get('str_helper');

        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table('product_categories AS t1');
        $this->query->set_columns('t1.product_category_name' . ' AS lev1, t2.product_category_name' . ' AS lev2, t3.product_category_name' . ' AS lev3, t4.product_category_name' . ' AS lev4, t1.product_category_id AS id1, t2.product_category_id as id2, t3.product_category_id as id3, t4.product_category_id as id4'
        );

        /*
         * 

          $sql2 = '
          SELECT t1.product_category_name_hu AS lev1, t2.product_category_name_hu as lev2, t3.product_category_name_hu as lev3, t4.product_category_name_hu as lev4
          FROM product_categories AS t1
          LEFT JOIN product_categories AS t2 ON t2.product_category_parent = t1.product_category_id
          LEFT JOIN product_categories AS t3 ON t3.product_category_parent = t2.product_category_id
          LEFT JOIN product_categories AS t4 ON t4.product_category_parent = t3.product_category_id
          WHERE
          t4.product_category_name_hu = "Cranes sub-sub-sub-category" OR
          t3.product_category_name_hu = "Cranes sub-sub-sub-category" OR
          t2.product_category_name_hu = "Cranes sub-sub-sub-category" OR
          t1.product_category_name_hu = "Cranes sub-sub-sub-category"
         * 
         * ;
          $sql = '
         */

        // $this->query->set_join('left', 'product_categories AS t2', 't2.product_category_parent', '=', 't1.product_category_id');
        // $this->query->set_join('left', 'product_categories AS t3', 't3.product_category_parent', '=', 't2.product_category_id');
        // $this->query->set_join('left', 'product_categories AS t4', 't4.product_category_parent', '=', 't3.product_category_id');
        
        $this->query->set_join('left', 'product_categories AS t2', 't2.product_category_parent = t1.product_category_id');
        $this->query->set_join('left', 'product_categories AS t3', 't3.product_category_parent = t2.product_category_id');
        $this->query->set_join('left', 'product_categories AS t4', 't4.product_category_parent = t3.product_category_id');

        $this->query->set_where('t4.product_category_id', '=', $category_id, 'OR');
        $this->query->set_where('t3.product_category_id', '=', $category_id, 'OR');
        $this->query->set_where('t2.product_category_id', '=', $category_id, 'OR');
        $this->query->set_where('t1.product_category_id', '=', $category_id, 'OR');
//$this->query->debug();        
        $result = $this->query->select();

        $path = '<a href="' . $this->request->get_uri('site_url') . 'termekek">Termékek</a> / ';
        foreach ($result as $value) {
            $path .= '<a href="' . $this->request->get_uri('site_url') . 'termekek/' . 'kategoria/' . $str_helper->stringToSlug($value['lev1']) . '/' . $value['id1'] . '">' . $value['lev1'] . '</a> / ';
        }
        return $path;
    }

    /**
     * 	A home oldal új termékek adatait kérdezi le az adatbázisból
     *
     * 	@return	array $result a termékek adatai
     */
    public function get_new_products($limit) {

        $this->query->reset();
        $this->query->set_table(array('products'));
        $this->query->set_columns('*');
        $this->query->set_where('product_status', '=', 1);
        $this->query->set_orderby('product_create_timestamp', 'DESC');
        $this->query->set_limit($limit);
        $result = $this->query->select();
        return $result;
    }

}

?>
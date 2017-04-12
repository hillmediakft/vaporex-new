<?php
namespace System\Site\Model;
use System\Core\SiteModel;

class Hirek_model extends SiteModel {

    protected $table = 'blog';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * 	Visszaadja a blog tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function blog_query($id = null)
    {
        $this->query->reset();
        $this->query->set_table(array('blog'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('blog_id', '=', $id);
        }
        $this->query->set_where('blog_title', '!=', '');
        $this->query->set_join('left', 'blog_category', 'blog.blog_category', '=', 'blog_category.category_id');
        $this->query->set_orderby(array('blog.blog_add_date'), 'DESC');
        $result = $this->query->select();
        
        return $result[0];
    }

    /**
     * 	Visszaadja a blog tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function blog_pagination_query($limit = null, $offset = null) {

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('blog'));
        $this->query->set_columns('SQL_CALC_FOUND_ROWS blog_id, blog_title, blog_slug, blog_body, blog_picture, blog_category, blog_add_date, blog_category.category_name');
        if (!is_null($limit)) {
            $this->query->set_limit($limit);
        }
        if (!is_null($offset)) {
            $this->query->set_offset($offset);
        }
        $this->query->set_where('blog_title', '!=', '');
        $this->query->set_join('left', 'blog_category', 'blog.blog_category', '=', 'blog_category.category_id');
        $this->query->set_orderby(array('blog.blog_add_date'), 'DESC');
        return $this->query->select();
    }

    /**
     * 	A jobs_filter_query() metódus után kell meghívni,
     *  és visszaadja a limittel lekérdezett de a szűrésnek megfelelő összes sor számát
     */
    public function blog_pagination_count_query() {
        return $this->query->found_rows();
    }

    /**
     * 	Kategória szerint adj avissza  ablog bejegyzéseket
     * 	
     *
     * 	@return array az adott kategóriájú blog bejegyzések tömbje  
     */
    public function blog_query_by_category($category) {
        $this->query->reset();
        $this->query->set_table(array('blog'));
        $this->query->set_columns('*');
        $this->query->set_where('blog_category', '=', $category);
        $this->query->set_where('blog_title', '!=', '');
        $this->query->set_join('left', 'blog_category', 'blog.blog_category', '=', 'blog_category.category_id');
        $this->query->set_orderby(array('blog.blog_add_date'), 'DESC');
        return $this->query->select();
    }

    /**
     * 	Visszaadja a blog_category tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function get_blog_categories() {
        $this->query->reset();
        $this->query->set_table(array('blog_category'));
        $this->query->set_columns('*');
        return $this->query->select();
    }

    /**
     * 	Visszaadja a blog_category tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function blog_category_query($id = null) {
        $this->query->reset();
        $this->query->set_table(array('blog_category'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('category_id', '=', $id);
        }
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	Visszaadja a blog_category tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function blog_query_by_category_pagination($id, $limit = null, $offset = null) {

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('blog'));
        $this->query->set_columns('SQL_CALC_FOUND_ROWS blog_id, blog_title, blog_slug, blog_body, blog_picture, blog_category, blog_add_date, blog_category.category_name');
        $this->query->set_where('blog_category', '=', $id);
        $this->query->set_join('left', 'blog_category', 'blog.blog_category', '=', 'blog_category.category_id');

        if (!is_null($limit)) {
            $this->query->set_limit($limit);
        }
        if (!is_null($offset)) {
            $this->query->set_offset($offset);
        }
        $this->query->set_where('blog_title', '!=', '');
        $this->query->set_orderby(array('blog.blog_add_date'), 'DESC');
        return $this->query->select();
    }

}
?>
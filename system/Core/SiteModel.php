<?php
namespace System\Core;
// use System\Core\Model;

class SiteModel extends Model {

    /**
     * Minden site modelben elérhető, és a nyelvi kódot tartalmazza
     */
    protected $lang = LANG;

    function __construct() {
        parent::__construct();
    }

    /**
     * 	Oldal tartalmak lekérdezése (title, body, metatitle, metadescription, metakeywords)
     *
     * 	@param	string	$page_name (az oldal friendlyurl-je a pages táblában)
     * 	@return array
     */
    public function getPageData($page_name)
    {
        $this->query->set_table(array('pages'));
        $this->query->set_columns('*');
        $this->query->set_where('friendlyurl', '=', $page_name);
        $result = $this->query->select();
        //return (isset($result[0])) ? $result[0] : null;
        return $result[0];
    }

    /**
     *  Oldal tartalmak lekérdezése
     *
     *  @param  integer $id     (page_id az oldal id-je a pages táblában)
     *  @return array
     */
    public function get_content_data($content_name)
    {
        $this->query->reset();      
        $this->query->set_table(array('content'));      
        $this->query->set_columns('content_body');
        $this->query->set_where('content_name', '=', $content_name);
        $result = $this->query->select();
        return $result[0]['content_body'];
    }  

    /**
     * Partnerek (clients) lekérdezése a testimonials táblából
     *
     * @return array $result a vélemények adatai tömbben
     */
    public function get_clients()
    {
        $this->query->reset();
        $this->query->set_table(array('clients'));
        $this->query->set_columns('*');
        $this->query->set_orderby(array('client_id'), 'DESC');
        return $this->query->select();
    }  
    
    /**
     *  Lekérdezi a megyék nevét és id-jét a county_list táblából (az option listához)
     */
    public function county_list_query()
    {
        $this->query->reset();
        $this->query->set_table(array('county_list'));
        $this->query->set_columns(array('county_id', 'county_name'));
        return $this->query->select();
    }    
    
     public function slider_query()
     {
        $this->query->reset();
        $this->query->set_table(array('slider'));
        $this->query->set_columns('*');
        $this->query->set_where('active', '=', 1);
        $this->query->set_orderby(array('slider_order'), 'ASC');
        return $this->query->select();
    }
    
    /**
     * A vélemények lekérdezése a testimonials táblából
     *
     * @return array $result a vélemények adatai tömbben
     */
    public function get_testimonials()
    {
        $this->query->reset();
        $this->query->set_table(array('testimonials'));
        $this->query->set_columns();
        $this->query->set_orderby(array('id'), 'DESC');
        return $this->query->select();
    }


}
?>
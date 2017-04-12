<?php
namespace System\Site\Model;
use System\Core\SiteModel;

class Letoltesek_model extends SiteModel {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();

    }
    
    /**
     * 	Visszaadja a document tábla egy kategóriájának elemeit
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function getDocuments($id = null) {
        $this->query->debug(false);
        $this->query->set_table(array('documents'));
        $this->query->set_columns(array('documents.id', 'documents.title', 'documents.description', 'documents.file', 'documents.created', 'document_category.name'));
        $this->query->set_join('left', 'document_category', 'documents.category_id', '=', 'document_category.id');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('documents.id', '=', $id);
        }

        return $this->query->select();
    }    

    /**
     * 	Egy termék minden "nyers" adatát lekérdezi
     * 	A termék módosításához kell 
     */
    public function get_download($id) {
        $id = (int) $id;
        $this->query->reset();
        $this->query->set_table(array('downloads'));
                $this->query->set_columns(array(
            'downloads.download_id',
            'downloads.download_title',
            'downloads.download_description',
            'downloads.download_status',
            'downloads.download_create_timestamp',
            'downloads.download_update_timestamp',
            'downloads.download_category_id',
            'downloads.download_photo',
            'download_categories.download_category_name'
        ));
        $this->query->set_join('left', 'download_categories', 'downloads.download_category_id', '=', 'download_categories.download_category_id');
        $this->query->set_where('download_status', '=', 1);
        $this->query->set_where('download_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	A termékek táblázathoz kérdezi le az adatokat
     * 	@return array
     */
    public function all_downloads_query() {
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('downloads'));
        $this->query->set_columns(array(
            'downloads.download_id',
            'downloads.download_title',
            'downloads.download_description',
            'downloads.download_status',
            'downloads.download_create_timestamp',
            'downloads.download_update_timestamp',
            'downloads.download_category_id',
            'downloads.download_photo',
            'download_categories.download_category_name'
        ));
        $this->query->set_join('left', 'download_categories', 'downloads.download_category_id', '=', 'download_categories.download_category_id');
        $this->query->set_where('download_status', '>', 0);
        return $this->query->select();
        /*
          $result = $this->query->query_sql(
          'SELECT `downloads`.`download_id`,`downloads`.`download_title_hu`,`downloads`.`download_description_hu`,`downloads`.`download_title_en`,`downloads`.`download_description_en`,`downloads`.`download_status`,`downloads`.`download_create_timestamp`,`downloads`.`download_update_timestamp`,`downloads`.`download_category_id`,`downloads`.`download_photo`,`download_categories`.`download_category_name_hu` FROM `downloads` LEFT JOIN download_categories ON downloads.download_category_id = download_categories.download_category_id GROUP BY `download_category_id`'
          );

          return $result; */
    }

    /**
     * 	Lekérdezi a termék kategóriákat a downloads_categories táblából (és az id-ket)
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni)
     * 	@return	array	
     */
    public function referencia_kategoriak() {
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table('download_categories');
        $this->query->set_columns('download_category_id, download_category_name');
        return $this->query->select();
    }

    public function arraySort($input, $sortkey) {
        foreach ($input as $key => $val)
            $output[$val[$sortkey]][] = $val;
        return $output;
    }
    
    /**
     * 	Lekérdezi kategóriák nevét és id-jét a photo_category táblából (az option listához)
     */
    public function download_category_list() {
        $this->query->reset();
        $this->query->set_table(array('download_categories'));
        $this->query->set_columns('*');
        $result = $this->query->select();
        return $result;
    }   
    
    /**
     * 	Visszaadja a document_category tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function findCategories($id = null) {
         $this->query->reset();
        $this->query->set_table(array('document_category'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('id', '=', $id);
        }
        return $this->query->select();
    }    

}

?>
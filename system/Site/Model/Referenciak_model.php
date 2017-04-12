<?php
namespace System\Site\Model;
use System\Core\SiteModel;

class Referenciak_model extends SiteModel {

    protected $table = 'projects';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * 	Egy termék minden "nyers" adatát lekérdezi
     * 	A termék módosításához kell 
     */
    public function get_project($id)
    {
        $id = (int) $id;
        $this->query->reset();
        $this->query->set_table(array('projects'));
                $this->query->set_columns(array(
            'projects.project_id',
            'projects.project_title',
            'projects.project_description',
            'projects.project_status',
            'projects.project_create_timestamp',
            'projects.project_update_timestamp',
            'projects.project_category_id',
            'projects.project_photo',
            'project_categories.project_category_name'
        ));
        $this->query->set_join('left', 'project_categories', 'projects.project_category_id', '=', 'project_categories.project_category_id');
        $this->query->set_where('project_status', '=', 1);
        $this->query->set_where('project_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	A termékek táblázathoz kérdezi le az adatokat
     * 	@return array
     */
    public function all_projects_query()
    {
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('projects'));
        $this->query->set_columns(array(
            'projects.project_id',
            'projects.project_title',
            'projects.project_description',
            'projects.project_status',
            'projects.project_create_timestamp',
            'projects.project_update_timestamp',
            'projects.project_category_id',
            'projects.project_photo',
            'project_categories.project_category_name'
        ));
        $this->query->set_join('left', 'project_categories', 'projects.project_category_id', '=', 'project_categories.project_category_id');
        $this->query->set_where('project_status', '>', 0);
        return $this->query->select();
        /*
          $result = $this->query->query_sql(
          'SELECT `projects`.`project_id`,`projects`.`project_title_hu`,`projects`.`project_description_hu`,`projects`.`project_title_en`,`projects`.`project_description_en`,`projects`.`project_status`,`projects`.`project_create_timestamp`,`projects`.`project_update_timestamp`,`projects`.`project_category_id`,`projects`.`project_photo`,`project_categories`.`project_category_name_hu` FROM `projects` LEFT JOIN project_categories ON projects.project_category_id = project_categories.project_category_id GROUP BY `project_category_id`'
          );

          return $result; */
    }

    /**
     * 	Lekérdezi a termék kategóriákat a projects_categories táblából (és az id-ket)
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni)
     * 	@return	array	
     */
    public function referencia_kategoriak()
    {
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table('project_categories');
        $this->query->set_columns('project_category_id, project_category_name');
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
    public function project_category_list()
    {
        $this->query->reset();
        $this->query->set_table(array('project_categories'));
        $this->query->set_columns('*');
        $result = $this->query->select();
        return $result;
    }    

}

?>
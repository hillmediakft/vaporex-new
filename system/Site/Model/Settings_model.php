<?php
namespace System\Site\Model;
use System\Core\SiteModel;

class Settings_model extends SiteModel {

    protected $table = 'settings';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Oldal szintű beállítások lekérdezése a settings táblából
     *
     * @return array a beállítások tömbje
     */
    public function get_settings() {
        $this->query->reset();
        $this->query->set_table(array('settings'));
        $this->query->set_columns('*');
        $result = $this->query->select();
        return $result[0];
    }

}
?>
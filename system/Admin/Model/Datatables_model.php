<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Datatables_model extends AdminModel {

    /**
     * A tábla nevek és az ingatlanok táblában az oszlop nevek párosításai
     */
    public $jellemzok = array(
      'ingatlan_allapot' => 'allapot',
      'ingatlan_kategoria' => 'kategoria',
      'ingatlan_futes' => 'futes',
      'ingatlan_energetika' => 'energetika',
      'ingatlan_kert' => 'kert',
      'ingatlan_kilatas' => 'kilatas',
      'ingatlan_parkolas' => 'parkolas',
      'ingatlan_szerkezet' => 'szerkezet'  
    );

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Jellemző tábla tartalmát adja vissza
     * 
     * @param   string  $table a tábla neve 
     * @return  array   a paraméterként átadott tábla tartalma
     */
    public function get_jellemzo_list($table)
    {
        $this->query->set_table(array($table));
        $this->query->set_columns();
        return $this->query->select();
    }

    /**
     * Jellemző törlése
     * 
     * @param   string  $id - a jellemző id-je
     * @param   string  $table - a jellemző tábla neve (pl.: ingatlan_allapot)
     * @param   string  $id_name - a jellemző táblában az id oszlop neve (pl. all_id)
     * @return  integer || false  integer ha sikeres, false, ha sikertelen a törlés
     */
    public function delete($id, $table, $id_name)
    {
        $id = (int) $id;

        if ($this->is_deletable($id, $table)) {

            $this->query->set_table(array($table));
            return $this->query->delete($id_name, '=', $id);

        } else {
            return false;
        }
    }

    /**
     * Kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
     * @param string tábla neve
     * @param string id oszlop neve
     * @param string oszlop neve
     * @return array
     */
    public function existingCategorys($table, $id_name, $leiras_name)
    {
        $this->query->set_table(array($table));
        $this->query->set_columns(array($id_name, $leiras_name));
        return $this->query->select();         
    }

    /**
     * Jellemző update
     * 
     * @param   string  $id - a jellemző id-je
     * @param   string  $table - a jellemző tábla neve (pl.: ingatlan_allapot)
     * @param   string  $id_name - a jellemző táblában az id oszlop neve (pl. all_id)
     * @param   string  $leiras_name - a leírás oszlop neve (pl.: all_leiras)
     * @param   string  $data - hozzáadandó jellemző megnevezése
     * @return  boolean true ha sikeres, false, ha sikertelen a törlés
     */
    public function update_insert($id, $table, $id_name, $leiras_name, $data)
    {
        //$data = array($leiras_name => $data);

        if (is_null($id)) {
            // insert
            $this->query->set_table(array($table));
            return $this->query->insert($data);
        } else {
            // update
            $id = (int) $id;
            $this->query->set_table(array($table));
            $this->query->set_where($id_name, '=', $id);
            return $this->query->update($data);
        }
    }

    /**
     * Ellenőrzi, hogy a jellemző törlöhető-e: van ingatlan ilyen jellemzővel
     * 
     * @param   string  $id - a jellező id-je
     * @param   string  $table - a jellemző tábla neve (pl.: ingatlan_allapot)
     * @return   boolean true ha törölhető, false, ha nem
     */
    public function is_deletable($id, $table)
    {
        $this->query->set_table(array('ingatlanok'));
        $this->query->set_columns('id');
        $this->query->set_where($this->jellemzok[$table], '=', $id);
        $result = $this->query->select();
        
        if (empty($result)) {
            return true;
        } else {
            return false;
        }
    }

}
?>
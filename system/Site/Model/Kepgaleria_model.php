<?php

class Kepgaleria_model extends Site_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * A paraméterként átadott képgalériába tartozó képek lekérdezése
     *
     * @return array az összes kép adatai tömbben
     */
    public function get_photo_gallery($category) {

        try {
            $this->query->reset();
            $this->query->set_table(array('photo_gallery'));
            $this->query->set_columns(array('photo_filename', 'photo_caption'));
            $this->query->set_where('photo_category', '=', $category);
            $result = $this->query->select();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $result;
    }

    /**
     * A paraméterként átadott képgalériába tartozó képek lekérdezése
     *
     * @return array az összes kép adatai tömbben
     */
    public function get_all_photo() {

        try {
            $this->query->reset();
            $this->query->set_table(array('photo_gallery'));
            $this->query->set_columns(array('photo_filename', 'photo_caption', 'photo_category'));
            $result = $this->query->select();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $result;
    }

    /**
     * 	Lekérdezi kategóriák nevét és id-jét a photo_category táblából (az option listához)
     */
    public function photo_category_list_query() {
        try {
            $this->query->reset();
            $this->query->set_table(array('photo_category'));
            $this->query->set_columns(array('id', 'category_name'));
            $result = $this->query->select();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $result;
    }

}

?>
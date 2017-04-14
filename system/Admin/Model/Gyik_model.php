<?php
namespace System\Admin\Model;
use System\Core\AdminModel;

class Gyik_model extends AdminModel {

    protected $table = 'gyik';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
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
        $this->query->set_where('gyik_id', '=', $id);    
        return $this->query->update($data);
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        return $this->query->delete('gyik_id', '=', $id);
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
        $this->query->set_where('gyik_id', '=', $id);
        return $this->query->update(array('gyik_status' => $data));
    }



    /**
     * 	Egy termék minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function one_gyik_alldata_query($id = null) {
        $id = (int) $id;

        $this->query->reset();
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('gyik'));

        $this->query->set_columns(array(
          'gyik.gyik_id',
          'gyik.gyik_title',
          'gyik.gyik_description',
          'gyik.gyik_status',
          'gyik.gyik_create_timestamp',
          'gyik.gyik_update_timestamp',
          'gyik.gyik_category_id',
          'gyik_categories.gyik_category_name'
        ));
        $this->query->set_join('left', 'gyik_categories', 'gyik.gyik_category_id', '=', 'gyik_categories.gyik_category_id');
        $this->query->set_where('gyik_id', '=', $id);
        return $this->query->select();
    }

    /**
     * 	Egy termék minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function one_gyik_alldata_query_ajax() {
        //$id = (int)$_POST['id'];
        $id = (int) $this->registry->params['id'];

        $this->query->reset();
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('gyik'));
        $this->query->set_columns(array(
          'gyik.gyik_id',
          'gyik.gyik_title',
          'gyik.gyik_description',
          'gyik.gyik_status',
          'gyik.gyik_create_timestamp',
          'gyik.gyik_update_timestamp',
          'gyik.gyik_category_id',
          'gyik_categories.gyik_category_name'
        ));
        $this->query->set_join('left', 'gyik_categories', 'gyik.gyik_category_id', '=', 'gyik_categories.gyik_category_id');
        $this->query->set_where('gyik_id', '=', $id);
        $result = $this->query->select();

        $result[0]['gyik_create_timestamp'] = date('Y-m-d H:i', $result[0]['gyik_create_timestamp']);
        $result[0]['gyik_update_timestamp'] = (!empty($result[0]['gyik_update_timestamp'])) ? date('Y-m-d H:i', $result[0]['gyik_update_timestamp']) : $result[0]['gyik_update_timestamp'];

        return $result[0];
    }

    /**
     * 	Egy termék minden "nyers" adatát lekérdezi
     * 	A termék módosításához kell 
     */
    public function one_gyik_query($id) {
        $id = (int) $id;
        $this->query->reset();
        $this->query->set_table(array('gyik'));
        $this->query->set_columns('*');
        $this->query->set_where('gyik_id', '=', $id);
        return $this->query->select();
    }

    /**
     * 	A termékek táblázathoz kérdezi le az adatokat
     * 	@return array
     */
    public function all_gyik_query() {
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('gyik'));
        $this->query->set_columns(array(
          'gyik.gyik_id',
          'gyik.gyik_title',
          'gyik.gyik_description',
          'gyik.gyik_status',
          'gyik.gyik_create_timestamp',
          'gyik.gyik_update_timestamp',
          'gyik.gyik_category_id',
          'gyik_categories.gyik_category_name'
        ));
        $this->query->set_join('left', 'gyik_categories', 'gyik.gyik_category_id', '=', 'gyik_categories.gyik_category_id');

        return $this->query->select();
    }













    /**
     * 	Lekérdezi a termék kategóriákat a gyik_categories táblából (és az id-ket)
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni)
     * 	@return	array	
     */
    public function gyik_categories_query() {
        $this->query->reset();
        $this->query->set_table('gyik_categories');
        $this->query->set_columns('gyik_category_id, gyik_category_name');
        return $this->query->select();
    }

    /**
     * 	Lekérdezi a termékkategóriát a gyik_categories táblából 
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni)
     * 	@return	array	
     */
    public function one_gyik_category($id = null) {
        $this->query->reset();
        $this->query->set_table(array('gyik_categories'));
        $this->query->set_columns('*');
        $id = (int) $id;
        $this->query->set_where('gyik_category_id', '=', $id);
        return $this->query->select();
    }

    /**
     * 	Lekérdezi a kategóriák nevét és id-jét 
     */
    public function category_list_query() {
        $this->query->reset();
        $this->query->set_table(array('gyik_categories'));
        $this->query->set_columns(array('gyik_category_id', 'gyik_category_name'));
        $result = $this->query->select();
        return $result;
    }


    /**
     * Termék (illetve termékek) törlése
     * @return true, ha sikeres a törlés, false, ha hibás az sql parancs
     */
    public function delete_gyik() {
        // a sikeres törlések számát tárolja
        $success_counter = 0;
        // a sikertelen törlések számát tárolja
        $fail_counter = 0;

        // Több user törlése
        if (!empty($_POST)) {
            $data_arr = $_POST;

            //eltávolítjuk a tömbből a felesleges elemeket	
            /* if(isset($data_arr['delete_gyik'])) {
              unset($data_arr['delete_gyik']);
              } */
            if (isset($data_arr['gyik_length'])) {
                unset($data_arr['gyik_length']);
            }
        } else {
            // egy user törlése (nem POST adatok alapján)
            if (!isset($this->registry->params['id'])) {
                throw new Exception('Nincs id-t tartalmazo parameter az url-ben (ezert nem tudunk torolni id alapjan)!');
                return false;
            }
            //berakjuk a $data_arr tömbbe a törlendő felhasználó id-jét
            $data_arr = array($this->registry->params['id']);
        }

        // bejárjuk a $data_arr tömböt és minden elemen végrehajtjuk a törlést
        foreach ($data_arr as $value) {
            //átalakítjuk a integer-ré a kapott adatot
            $value = (int) $value;
            
            //termék törlése	
            $this->query->reset();
            $this->query->set_table(array('gyik'));
            //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
            $result = $this->query->delete('gyik_id', '=', $value);

        }

        // üzenetek eltárolása
        if ($success_counter > 0) {
            Message::set('success', $success_counter . ' referencia törlése sikerült.');
        }
        if ($fail_counter > 0) {
            Message::set('error', $fail_counter . ' referencia törlése nem sikerült!');
        }

        // default visszatérési érték (akkor tér vissza false-al ha hibás az sql parancs)	
        return true;
    }

    /**
     * Termék kategória hozzáadása
     * 
     * @return true, ha sikeres, false, ha nem
     */
    public function category_insert() {
        //ha üresen küldték el a formot
        if (empty($_POST['gyik_category_name'])) {
            Message::set('error', 'Meg kell adni a kategória magyar nevét!');
            return false;
        }

        $data['gyik_category_name'] = $_POST['gyik_category_name'];
        // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
        $existing_categorys = $this->category_list_query();
        // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
        foreach ($existing_categorys as $value) {
            $data['gyik_category_name'] = trim($data['gyik_category_name']);
            if (strtolower($data['gyik_category_name']) == strtolower($value['gyik_category_name'])) {
                Message::set('error', 'category_already_exists');
                return false;
            }
        }

        // adatbázis lekérdezés	
        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table(array('gyik_categories'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték egy id
        if ($result) {
            Message::set('success', 'category_created');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    /**
     * Termék kategória módosítása
     * 
     * @param int $id a kategória azonosítója
     * @return true, ha sikeres, false, ha nem
     */
    public function category_update($id) {

        //ha üresen küldték el a formot
        if (empty($_POST['gyik_category_name'])) {
            Message::set('error', 'Meg kell adni a kategória nevét!');
            return false;
        }


        $data['gyik_category_name'] = $_POST['gyik_category_name'];

        // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
        $existing_categorys = $this->category_list_query();
        // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
        foreach ($existing_categorys as $value) {
            $data['gyik_category_name'] = trim($data['gyik_category_name']);
            if (strtolower($data['gyik_category_name']) == strtolower($value['gyik_category_name']) && $id != $value['gyik_category_id']) {
                Message::set('error', 'category_already_exists');
                return false;
            }
        }

        // módosítjuk az adatbázisban a kategória nevét	és kép elérési utat ha kell
        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table(array('gyik_categories'));
        $this->query->set_where('gyik_category_id', '=', $id);
        $result = $this->query->update($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            Message::set('success', 'category_updated');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    /**
     * Kategória törlése
     * 
     * @return true, ha sikeres, false, ha nem
     */
    public function delete_category() {

        if (!isset($this->registry->params['id'])) {
            throw new Exception('Nincs id-t tartalmazo parameter az url-ben (ezert nem tudunk torolni id alapjan)!');
            return false;
        }
        //berakjuk a $data_arr tömbbe a törlendő felhasználó id-jét
        $id = (int) $this->registry->params['id'];

        $is_deletable = $this->is_category_deletable($id);

        if (!$is_deletable) {
            Message::set('error', 'A kategória nem törölhető! A kategória referenciát tartalmaz!');
            return;
        }

        $this->query->reset();
        $this->query->set_table(array('gyik_categories'));
        //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
        $result = $this->query->delete('gyik_category_id', '=', $id);

        if ($result !== false) {
            // ha a törlési sql parancsban nincs hiba
            if ($result > 0) {
                 Message::set('success', 'A kategória törlése sikerült.');
            } else {
                //sikertelen törlés
                Message::set('error', 'A kategória törlése nem sikerült!');
            }
        } else {
            // ha a törlési sql parancsban hiba van
            throw new Exception('Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!');
            return false;
        }


        // default visszatérési érték (akkor tér vissza false-al ha hibás az sql parancs)	
        return true;
    }

    /**
     * Visszaadja a gyik tábla gyik_category_id oszlop tartalmát
     * Egy kategóriához tertozó termékek számának meghatározásához kell
     * @return array
     */
    public function gyik_category_counter_query() {
        $this->query->reset();
        $this->query->set_table(array('gyik'));
        $this->query->set_columns('gyik_category_id');
        return $this->query->select();
    }

    /**
     * Visszaadja a gyik tábla gyik_category_id oszlop tartalmát
     * Egy kategóriához tertozó termékek számának meghatározásához kell
     * 
     * @param integer $id
     * @return array
     */
    public function gyik_number_in_category($id) {
        $this->query->reset();
        $this->query->set_table('gyik');
        $this->query->set_columns('COUNT(*)');
        $this->query->set_where('gyik_category_id', '=', $id);
        $count = $this->query->select();
        return $count[0]['COUNT(*)'];
    }

    /**
     * 	(AJAX) A gyik tábla gyik_status mezőjének ad értéket
     * 	siker vagy hiba esetén megy vissza az üzenet a javascriptnek 	
     *
     * 	@param	integer	$id	
     * 	@param	integer	$data (0 vagy 1)	
     * 	@return void
     */
    public function change_status_query($id, $data) {
        $this->query->reset();
        $this->query->set_table(array('gyik'));
        $this->query->set_where('gyik_id', '=', $id);
        $result = $this->query->update(array('gyik_status' => $data));

        if ($result) {
            echo json_encode(array("status" => 'success'));
        } else {
            echo json_encode(array("status" => 'error'));
        }
    }

    /**
     * 	termék képet méretezi és tölti fel a szerverre (thumb képet is)
     * 	(ez a metódus a category_insert() metódusban hívódik meg!)
     *
     * 	@param	$files_array	Array ($_FILES['valami'])
     * 	@return	String (kép elérési útja) or false
     */
    private function upload_gyik_photo($files_array) {
        include(LIBS . "/upload_class.php");
        // feltöltés helye
        $imagePath = Config::get('gyikphoto.upload_path');
        //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
        $handle = new Upload($files_array);
        // fájlneve utáni random karakterlánc
        $suffix = md5(uniqid());

        //file átméretezése, vágása, végleges helyre mozgatása
        if ($handle->uploaded) {
            // kép paramétereinek módosítása
            $handle->file_auto_rename = true;
            $handle->file_safe_name = true;
            $handle->allowed = array('image/*');
            $handle->file_new_name_body = "gyik_" . $suffix;
            $handle->image_resize = true;
            $handle->image_x = Config::get('gyikphoto.width', 300); //gyikphoto kép szélessége
            $handle->image_y = Config::get('gyikphoto.height', 200); //gyikphoto kép magassága
            //$handle->image_ratio_y           = true;
            //képarány meghatározása a nézőképhez
            $ratio = ($handle->image_x / $handle->image_y);

            // Slide kép készítése
            $handle->Process($imagePath);
            if ($handle->processed) {
                //kép elérési útja és új neve (ezzel tér vissza a metódus, ha nincs hiba!)
                //$dest_imagePath = $imagePath . $handle->file_dst_name;
                //a kép neve (ezzel tér vissza a metódus, ha nincs hiba!)
                $image_name = $handle->file_dst_name;
            } else {
                Message::set('error', $handle->error);
                return false;
            }

            // Nézőkép készítése
            //nézőkép nevének megadása (kép új neve utána _thumb)	
            $handle->file_new_name_body = $handle->file_dst_name_body;
            $handle->file_name_body_add = '_thumb';

            $handle->image_resize = true;
            $handle->image_x = Config::get('gyikphoto.thumb_width', 80); //gyikphoto nézőkép szélessége
            $handle->image_y = round($handle->image_x / $ratio);
            //$handle->image_ratio_y           = true;

            $handle->Process($imagePath);
            if ($handle->processed) {
                //temp file törlése a szerverről
                $handle->clean();
            } else {
                Message::set('error', $handle->error);
                return false;
            }
        } else {
            // Message::set('error', $handle->error);
            return false;
        }
        // ha nincs hiba visszadja a feltöltött kép elérési útját
        return $image_name;
    }

    /**
     * 	Munka kategória képet méretezi és tölti fel a szerverre (thumb képet is)
     * 	(ez a metódus a category_insert() metódusban hívódik meg!)
     *
     * 	@param	$files_array	Array ($_FILES['valami'])
     * 	@return	String (kép elérési útja) or false
     */
    private function upload_gyik_category_photo($files_array) {
        include(LIBS . "/upload_class.php");
        // feltöltés helye
        $imagePath = Config::get('gyikcategoryphoto.upload_path');
        //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
        $handle = new Upload($files_array);
        // fájlneve utáni random karakterlánc
        $suffix = md5(uniqid());

        //file átméretezése, vágása, végleges helyre mozgatása
        if ($handle->uploaded) {
            // kép paramétereinek módosítása
            $handle->file_auto_rename = true;
            $handle->file_safe_name = true;
            $handle->allowed = array('image/*');
            $handle->file_new_name_body = "gyikcategory_" . $suffix;
            $handle->image_resize = true;
            $handle->image_x = Config::get('gyikcategoryphoto.width', 300); //gyikphoto kép szélessége
            $handle->image_y = Config::get('gyikcategoryphoto.height', 200); //gyikphoto kép magassága
            //$handle->image_ratio_y           = true;
            //képarány meghatározása a nézőképhez
            $ratio = ($handle->image_x / $handle->image_y);

            // Slide kép készítése
            $handle->Process($imagePath);
            if ($handle->processed) {
                //kép elérési útja és új neve (ezzel tér vissza a metódus, ha nincs hiba!)
                //$dest_imagePath = $imagePath . $handle->file_dst_name;
                //a kép neve (ezzel tér vissza a metódus, ha nincs hiba!)
                $image_name = $handle->file_dst_name;
            } else {
                Message::set('error', $handle->error);
                return false;
            }

            // Nézőkép készítése
            //nézőkép nevének megadása (kép új neve utána _thumb)	
            $handle->file_new_name_body = $handle->file_dst_name_body;
            $handle->file_name_body_add = '_thumb';

            $handle->image_resize = true;
            $handle->image_x = Config::get('gyikcategoryphoto.thumb_width', 80); //gyikphoto nézőkép szélessége
            $handle->image_y = round($handle->image_x / $ratio);
            //$handle->image_ratio_y           = true;

            $handle->Process($imagePath);
            if ($handle->processed) {
                //temp file törlése a szerverről
                $handle->clean();
            } else {
                Message::set('error', $handle->error);
                return false;
            }
        } else {
            // Message::set('error', $handle->error);
            return false;
        }
        // ha nincs hiba visszadja a feltöltött kép elérési útját
        return $image_name;
    }


    /**
     * Ellenőrizzük, hogy a kategória törölhető-e: tartalmaz-e terméket 	
     *
     * @param integer $id
     * @return boolean $result
     */
    public function is_category_deletable($id) {

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('gyik'));
        $this->query->set_columns('gyik_id');
        $this->query->set_where('gyik_category_id', '=', $id);
        $result = $this->query->select();

        if (!empty($result)) {
            return false;
        }
        return true;
    }

    /**
     * Crew member képének vágása és feltöltése
     * Az $this->registry->params['id'] paraméter értékétől függően feltölti a kiválasztott képet
     * upload paraméter esetén: feltölti a kiválasztott képet
     * crop paraméter esetén: megvágja a kiválasztott képet és feltölti	
     *
     */
    public function gyik_crop_img_upload() {


        if (isset($this->registry->params['id'])) {



            include(LIBS . "/upload_class.php");

            // Kiválasztott kép feltöltése
            if ($this->registry->params['id'] == 'upload') {

                // feltöltés helye
                $imagePath = Config::get('gyikphoto.upload_path');

                //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
                $handle = new Upload($_FILES['img']);

                if ($handle->uploaded) {
                    // kép paramétereinek módosítása
                    $handle->file_auto_rename = true;
                    $handle->file_safe_name = true;
                    //$handle->file_new_name_body   	 = 'lorem ipsum';
                    $handle->allowed = array('image/*');
                    $handle->image_resize = true;
                    $handle->image_x = Config::get('gyikphoto.width', 400);
                    $handle->image_ratio_y = true;

                    //végrehajtás: kép átmozgatása végleges helyére
                    $handle->Process($imagePath);

                    if ($handle->processed) {
                        //temp file törlése a szerverről
                        $handle->clean();

                        $response = array(
                          "status" => 'success',
                          //"url" => $handle->file_dst_name,
                          "url" => $imagePath . $handle->file_dst_name,
                          "width" => $handle->image_dst_x,
                          "height" => $handle->image_dst_y
                        );
                        return json_encode($response);
                    } else {
                        $response = array(
                          "status" => 'error',
                          "message" => $handle->error . ': Can`t upload File; no write Access'
                        );
                        return json_encode($response);
                    }
                } else {
                    $response = array(
                      "status" => 'error',
                      "message" => $handle->error . ': Can`t upload File; no write Access'
                    );
                    return json_encode($response);
                }
            }


            // Kiválasztott kép vágása és vágott kép feltöltése
            if ($this->registry->params['id'] == 'crop') {

                // a croppic js küldi ezeket a POST adatokat 	
                $imgUrl = $_POST['imgUrl'];
                // original sizes
                $imgInitW = $_POST['imgInitW'];
                $imgInitH = $_POST['imgInitH'];
                // resized sizes
                //kerekítjük az értéket, mert lebegőpotos számot is kaphatunk és ez hibát okozna a kép generálásakor
                $imgW = round($_POST['imgW']);
                $imgH = round($_POST['imgH']);
                // offsets
                // megadja, hogy mennyit kell vágni a kép felső oldalából
                $imgY1 = $_POST['imgY1'];
                // megadja, hogy mennyit kell vágni a kép bal oldalából
                $imgX1 = $_POST['imgX1'];
                // crop box
                $cropW = $_POST['cropW'];
                $cropH = $_POST['cropH'];
                // rotation angle
                //$angle = $_POST['rotation'];
                //a $right_crop megadja, hogy mennyit kell vágni a kép jobb oldalából
                $right_crop = ($imgW - $imgX1) - $cropW;
                //a $bottom_crop megadja, hogy mennyit kell vágni a kép aljából
                $bottom_crop = ($imgH - $imgY1) - $cropH;

                // feltöltés helye
                $imagePath = Config::get('gyikphoto.upload_path');

                //képkezelő objektum létrehozása (a feltöltött kép elérése a paraméter)	
                $handle = new Upload($imgUrl);

                // fájlneve utáni random karakterlánc
                $suffix = md5(uniqid());

                if ($handle->uploaded) {

                    // kép paramétereinek módosítása
                    //$handle->file_auto_rename 		 = true;
                    //$handle->file_safe_name 		 = true;
                    //$handle->file_name_body_add   	 = '_thumb';
                    $handle->file_new_name_body = "gyik_" . $suffix;
                    //kép átméretezése
                    $handle->image_resize = true;
                    $handle->image_x = $imgW;
                    $handle->image_ratio_y = true;
                    //utána kép vágása
                    $handle->image_crop = array($imgY1, $right_crop, $bottom_crop, $imgX1);

                    //végrehajtás: kép átmozgatása végleges helyére
                    $handle->Process($imagePath);

                    if ($handle->processed) {

                        $response = array(
                          "status" => 'success',
                          //"url" => $handle->file_dst_name
                          "url" => $imagePath . $handle->file_dst_name
                        );

                        $img_on_server = $handle->file_dst_name;

                        $handle->clean();
                        // Nézőkép készítése
                        $handle = new upload($imagePath . $img_on_server);
                        $handle->file_name_body_add = '_thumb';

                        $handle->image_resize = true;
                        $handle->image_x = Config::get('gyikphoto.thumb_width', 100); //gyikphoto nézőkép szélessége
                        $handle->image_ratio_y = true;

                        $handle->Process($imagePath);


                        return json_encode($response);
                    } else {
                        $response = array(
                          "status" => 'error',
                          "message" => $handle->error . ': Can`t upload File; no write Access'
                        );
                        return json_encode($response);
                    }
                } else {
                    $response = array(
                      "status" => 'error',
                      "message" => $handle->error . ': Can`t upload File; no write Access'
                    );
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * Termék kategória képének vágása és feltöltése
     * Az $this->registry->params['id'] paraméter értékétől függően feltölti a kiválasztott képet
     * upload paraméter esetén: feltölti a kiválasztott képet
     * crop paraméter esetén: megvágja a kiválasztott képet és feltölti	
     *
     */
    public function gyik_category_crop_img_upload() {


        if (isset($this->registry->params['id'])) {



            include(LIBS . "/upload_class.php");

            // Kiválasztott kép feltöltése
            if ($this->registry->params['id'] == 'upload') {

                // feltöltés helye
                $imagePath = Config::get('categoryphoto.upload_path');

                //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
                $handle = new Upload($_FILES['img']);

                if ($handle->uploaded) {
                    // kép paramétereinek módosítása
                    $handle->file_auto_rename = true;
                    $handle->file_safe_name = true;
                    //$handle->file_new_name_body   	 = 'lorem ipsum';
                    $handle->allowed = array('image/*');
                    $handle->image_resize = true;
                    $handle->image_x = Config::get('categoryphoto.width', 400);
                    $handle->image_ratio_y = true;

                    //végrehajtás: kép átmozgatása végleges helyére
                    $handle->Process($imagePath);

                    if ($handle->processed) {
                        //temp file törlése a szerverről
                        $handle->clean();

                        $response = array(
                          "status" => 'success',
                          //"url" => $handle->file_dst_name,
                          "url" => $imagePath . $handle->file_dst_name,
                          "width" => $handle->image_dst_x,
                          "height" => $handle->image_dst_y
                        );
                        return json_encode($response);
                    } else {
                        $response = array(
                          "status" => 'error',
                          "message" => $handle->error . ': Can`t upload File; no write Access'
                        );
                        return json_encode($response);
                    }
                } else {
                    $response = array(
                      "status" => 'error',
                      "message" => $handle->error . ': Can`t upload File; no write Access'
                    );
                    return json_encode($response);
                }
            }


            // Kiválasztott kép vágása és vágott kép feltöltése
            if ($this->registry->params['id'] == 'crop') {

                // a croppic js küldi ezeket a POST adatokat 	
                $imgUrl = $_POST['imgUrl'];
                // original sizes
                $imgInitW = $_POST['imgInitW'];
                $imgInitH = $_POST['imgInitH'];
                // resized sizes
                //kerekítjük az értéket, mert lebegőpotos számot is kaphatunk és ez hibát okozna a kép generálásakor
                $imgW = round($_POST['imgW']);
                $imgH = round($_POST['imgH']);
                // offsets
                // megadja, hogy mennyit kell vágni a kép felső oldalából
                $imgY1 = $_POST['imgY1'];
                // megadja, hogy mennyit kell vágni a kép bal oldalából
                $imgX1 = $_POST['imgX1'];
                // crop box
                $cropW = $_POST['cropW'];
                $cropH = $_POST['cropH'];
                // rotation angle
                //$angle = $_POST['rotation'];
                //a $right_crop megadja, hogy mennyit kell vágni a kép jobb oldalából
                $right_crop = ($imgW - $imgX1) - $cropW;
                //a $bottom_crop megadja, hogy mennyit kell vágni a kép aljából
                $bottom_crop = ($imgH - $imgY1) - $cropH;

                // feltöltés helye
                $imagePath = Config::get('categoryphoto.upload_path');

                //képkezelő objektum létrehozása (a feltöltött kép elérése a paraméter)	
                $handle = new Upload($imgUrl);

                // fájlneve utáni random karakterlánc
                $suffix = md5(uniqid());

                if ($handle->uploaded) {

                    // kép paramétereinek módosítása
                    //$handle->file_auto_rename 		 = true;
                    //$handle->file_safe_name 		 = true;
                    //$handle->file_name_body_add   	 = '_thumb';
                    $handle->file_new_name_body = "gyikcategory_" . $suffix;
                    //kép átméretezése
                    $handle->image_resize = true;
                    $handle->image_x = $imgW;
                    $handle->image_ratio_y = true;
                    //utána kép vágása
                    $handle->image_crop = array($imgY1, $right_crop, $bottom_crop, $imgX1);

                    //végrehajtás: kép átmozgatása végleges helyére
                    $handle->Process($imagePath);

                    if ($handle->processed) {


                        $response = array(
                          "status" => 'success',
                          //"url" => $handle->file_dst_name
                          "url" => $imagePath . $handle->file_dst_name
                        );

                        $img_on_server = $handle->file_dst_name;

                        $handle->clean();
                        // Nézőkép készítése
                        $handle = new upload($imagePath . $img_on_server);
                        $handle->file_name_body_add = '_thumb';

                        $handle->image_resize = true;
                        $handle->image_x = Config::get('categoryphoto.thumb_width', 100); //gyikphoto nézőkép szélessége
                        $handle->image_ratio_y = true;

                        $handle->Process($imagePath);

                        return json_encode($response);
                    } else {
                        $response = array(
                          "status" => 'error',
                          "message" => $handle->error . ': Can`t upload File; no write Access'
                        );
                        return json_encode($response);
                    }
                } else {
                    $response = array(
                      "status" => 'error',
                      "message" => $handle->error . ': Can`t upload File; no write Access'
                    );
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * Termékekek száma kategóriában és az alá tartozó kategóriákban 	
     *
     * @param integer $cat_id kategória id-je
     * @return int a termékek száma
     */
    public function get_gyik_count($cat_id) {
        $count = $this->gyik_number_in_category($cat_id);

        $children = $this->get_children($cat_id);
        if (!empty($children)) {
            foreach ($children as $value) {
                $count = $count + $this->gyik_number_in_category($value);
                $sub_children = $this->get_children($value);
                if (!empty($sub_children)) {
                    foreach ($sub_children as $sub_value) {
                        $count = $count + $this->gyik_number_in_category($sub_value);
                        $sub_sub_children = $this->get_children($sub_value);
                        if (!empty($sub_sub_children)) {
                            foreach ($sub_sub_children as $sub_sub_value) {
                                $count = $count + $this->gyik_number_in_category($sub_sub_value);
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
        $this->query->set_table('gyik_categories');
        $this->query->set_columns('gyik_category_id');
        $this->query->set_where('gyik_category_parent', '=', $cat_id);
        $children = $this->query->select();
        $children_array = array();
        if (!empty($children)) {
            foreach ($children as $key => $value) {
                $children_array[] = $children[$key]['gyik_category_id'];
            }
        }
        return $children_array;
    }

}

?>
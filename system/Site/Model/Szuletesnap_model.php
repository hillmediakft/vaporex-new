<?php 
class Szuletesnap_model extends Site_model {

	function __construct()
	{
		parent::__construct();
	}
	
	function __destruct()
	{
		parent::__destruct();
	}
	
/**
     * 	A rendezvények táblázathoz kérdezi le a legközelebbi játszóház adatait
     * 	Itt nem kell minden adat egy rendezvényről
     */
    public function get_kovetkezo_jatszohaz() {
        $this->query->reset();
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('rendezvenyek'));
        $this->query->set_columns(array(
          'rendezvenyek.rendezveny_id',
          'rendezvenyek.rendezveny_city_id',
          'rendezvenyek.rendezveny_location',
          'rendezvenyek.rendezveny_start_timestamp',
          'city_list.city_name'
        ));
        $this->query->set_join('left', 'city_list', 'rendezvenyek.rendezveny_city_id', '=', 'city_list.city_id');
        $this->query->set_where('rendezveny_status', '=', 1);
        $this->query->set_where('rendezveny_expiry_timestamp', '>', time());
        $this->query->set_orderby('rendezveny_start_timestamp', 'ASC');
        $this->query->set_limit(1);
        return $this->query->select();
    }
    


}
?>
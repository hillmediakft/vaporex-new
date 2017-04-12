<?php

class Munkak_model extends Site_model {

    function __construct() {
        parent::__construct();
    }

    function __destruct() {
        parent::__destruct();
    }

    public function get_count() {
        return $this->query->count('jobs');
    }

    /**
     * 	Munkák lekéderzése szűrési feltételekkel
     *
     */
    public function jobs_filter_query($limit = null, $offset = null) {
        $params = $_GET;

        $this->query->reset();
        $this->query->set_table(array('jobs'));
        $this->query->set_columns('SQL_CALC_FOUND_ROWS 
			`jobs`.`job_id`,
			`jobs`.`job_title`,
			`jobs`.`job_pay`,
			`city_list`.`city_name`,
			`district_list`.`district_name`,
			`jobs_list`.`job_list_name`,
			`jobs_list`.`job_list_photo`'
        );
        //$this->query->set_orderby(array('slider_order'));
        $this->query->set_join('left', 'jobs_list', 'jobs.job_category_id', '=', 'jobs_list.job_list_id');
        $this->query->set_join('left', 'city_list', 'jobs.job_city_id', '=', 'city_list.city_id');
        $this->query->set_join('left', 'district_list', 'jobs.job_district_id', '=', 'district_list.district_id');

        if (!is_null($limit)) {
            $this->query->set_limit($limit);
        }
        if (!is_null($offset)) {
            $this->query->set_offset($offset);
        }

        $this->query->set_orderby(array('job_id'), 'DESC');

        $this->query->set_where('job_status', '=', 1);
        $this->query->set_where('job_expiry_timestamp', '>', time());

        if (isset($params['megye']) && !empty($params['megye'])) {
            $this->query->set_where('job_county_id', '=', $params['megye']);
        }
        if (isset($params['kerulet']) && !empty($params['kerulet'])) {
            $this->query->set_where('job_district_id', '=', $params['kerulet']);
        }
        if (isset($params['varos']) && !empty($params['varos'])) {
            $this->query->set_where('job_city_id', '=', $params['varos']);
        }
        if (isset($params['kategoria']) && !empty($params['kategoria'])) {
            $this->query->set_where('job_category_id', '=', $params['kategoria']);
        }

        return $this->query->select();
    }

    /**
     * 	A jobs_filter_query() metódus után kell meghívni,
     *  és visszaadja a limittel lekérdezett de a szűrésnek megfelelő összes sor számát
     */
    public function jobs_filter_count_query() {
        return $this->query->found_rows();
    }

}

?>
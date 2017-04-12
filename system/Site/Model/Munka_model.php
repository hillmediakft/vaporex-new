<?php 
class Munka_model extends Site_model {

	function __construct()
	{
		parent::__construct();
	}

	function __destruct()
	{
		parent::__destruct();
	}	
	

	/**
	 *	Egy munka minden adatát lekérdezi a részletek megjelenítéséhez
	 */
	public function get_job($id)
	{
		$id = (int)$id;
		
		$this->query->reset();	
		// a query tulajdonság ($this->query) tartalmazza a query objektumot
		$this->query->set_table(array('jobs')); 
		$this->query->set_columns(array(
			'jobs.job_id',
			//'jobs.job_ref_id',
			'jobs.job_title',
			'jobs.job_description',
			'jobs.job_pay',
			'jobs.job_working_hours',
			'jobs.job_conditions',
			'jobs.job_expiry_timestamp',
			'employer.employer_name',
			'employer.employer_contact_person',
			'employer.employer_contact_tel',
			'employer.employer_contact_email',
			'jobs_list.job_list_name',
			'county_list.county_name',
			'district_list.district_name',
			'city_list.city_name',
            'users.user_first_name',
            'users.user_last_name',
            'users.user_phone',
            'users.user_email',
            'users.user_photo'
		)); 
		
        $this->query->set_join('left', 'users', 'jobs.job_ref_id', '=', 'users.user_id'); 
        $this->query->set_join('left', 'employer', 'jobs.job_employer_id', '=', 'employer.employer_id'); 
		$this->query->set_join('left', 'jobs_list', 'jobs.job_category_id', '=', 'jobs_list.job_list_id'); 
		$this->query->set_join('left', 'county_list', 'jobs.job_county_id', '=', 'county_list.county_id'); 
		$this->query->set_join('left', 'city_list', 'jobs.job_city_id', '=', 'city_list.city_id'); 
		$this->query->set_join('left', 'district_list', 'jobs.job_district_id', '=', 'district_list.district_id'); 
		$this->query->set_where('job_id', '=', $id);
		$this->query->set_limit(1);
		$result = $this->query->select();
		return $result[0];
	}	

}
?>
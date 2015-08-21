<?php if ( ! defined('BASEPATH')) exit();
class Slug_gen extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('email_sending');
		$this->load->helper("url");
	}

	public function run()
	{
		$table_name = "tbl_subcategory_master";
		$slug_field = "slug";
		$slug_target = "subcategory_name";
		$prim_key_field ="subcategory_id";

		$arr_records = $this->master_model->getRecords($table_name);

		if(sizeof($arr_records)>0)
		{
			foreach ($arr_records as $key => $rec) 
			{
				$tmp_key = $rec[$prim_key_field];
				$tmp_slug =  url_title($rec[$slug_target]);

				$arr_data = array($slug_field=>$tmp_slug);
				$this->db->where(array($prim_key_field=>$tmp_key));
				$this->db->update($table_name,$arr_data);
			}
		}
	}
}	

	

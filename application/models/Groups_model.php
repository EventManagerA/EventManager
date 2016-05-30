<?php
class Groups_model extends CI_Model {

	public $id;
	public $name;

	public function get_rowset_desc($page ='',$perPage =''){

		$this->db->order_by('id','desc');

		if(!$page){
			$page = 1;
		}

		if(!is_numeric($page)){
			$page = 1;
		}

 		if (isset($page,$perPage))
 		{
			$offset = ($page - 1) * $perPage;
			$query = $this->db->get('groups',$perPage,$offset);
 		}else{

 			$query = $this->db->get('groups');
 		}

		return $query->result('Groups_model');
	}

	public function total_count(){
	   return $this->db->count_all('groups');
	}

	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('groups', array('id' => $id));
		return $query->row(0,'Groups_model');
	}



	public function update($id,$val){

		$this->db->where('id', $id);
		$this->db->update('groups', $val);
	}

	public function insert($val) {
		 return $this->db->insert('groups',$val);
	}

	public function delete($val) {
		$this->db->where('id', $val);
		$this->db->delete('groups');
	}



//  idの取得
	public function get_id() {
		return isset($this->id) ? $this->id : false;
	}

	public function get_name() {
		return isset($this->name) ? $this->name : false;
	}

	//イベント登録時の部署リスト取得
	public function get_list_for_form() {

		$query = $this->db->get('groups');
		$group_rowset_array = $query->result_array();

		$group_list[''] = '全員';
		foreach ($group_rowset_array as $group_row_array){
			$group_list[$group_row_array['id']] = $group_row_array['name'];
		}

		return $group_list;
	}

	//ユーザ登録時の部署リスト取得
	public function get_list_for_userform() {

		$query = $this->db->get('groups');
		$group_rowset_array = $query->result_array();

		foreach ($group_rowset_array as $group_row_array){
			$group_list[$group_row_array['id']] = $group_row_array['name'];
		}

		return $group_list;
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_project extends CI_Model {

	var $table = 'barang';
	var $column_order = array('ID_BARANG','NAMA_BARANG','JUMLAH_BARANG','ID_KATEGORI',null); //set column field database for datatable orderable
	var $column_search = array('ID_BARANG','NAMA_BARANG','JUMLAH_BARANG','ID_KATEGORI'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('ID_BARANG' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//LOGIN MODEL
	var $details;
	function validate_user( $nama, $password ) {
	    // Build a query to retrieve the user's details
	    // based on the received username and password
	    $this->db->from('user');
	    $this->db->where('NAMA_ADMIN',$nama );
	    $this->db->where( 'PWD_ADMIN',$password);
	    $login = $this->db->get()->result();

	    // The results of the query are stored in $login.
	    // If a value exists, then the user account exists and is validated
	    if ( is_array($login) && count($login) == 1 ) {
	        // Set the users details into the $details property of this class
	        $this->details = $login[0];
	        // Call set_session to set the user's session vars via CodeIgniter
	        $this->set_session();
	        return true;
	    }

	    return false;
	}

	function set_session() {
	    // session->set_userdata is a CodeIgniter function that
	    // stores data in a cookie in the user's browser.  Some of the values are built in
	    // to CodeIgniter, others are added (like the IP address).  See CodeIgniter's documentation for details.
	    $this->session->set_userdata( array(
	            'ID_ADMIN'=>$this->details->ID_ADMIN,
	            'NAMA_ADMIN'=> $this->details->NAMA_ADMIN,
	            'PWD_ADMIN'=>$this->details->PWD_ADMIN,
	            'isLoggedIn'=>true
	        )
	    );
	}
	//MODEL LOGIN

	//moel barang start
	public function kategori_barang(){
		return $this->db->get('kategori');
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('ID_BARANG',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id)
	{
		$this->db->where('ID_BARANG', $id);
		$this->db->delete($this->table);
	}

	public function print_data($where,$table)
	{
		return $this->db->get_where($table, $where);
	}

	


}

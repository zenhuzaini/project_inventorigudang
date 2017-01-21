<?php
/**
* 
*/
class M_printsemua extends CI_Model
{
	function print_data($thedata)
	{
		$this->db->where('TGL_IN >=' , ''.$thedata['tawal'].'');
		$this->db->where('TGL_IN <=' , ''.$thedata['tahir'].'');

		$data =  $this->db->get($thedata['tabelnya']);
		return $data->result(); 
	}	

	function print_data_outbarang($thedata)
	{
		$this->db->where('TGL_OUT >=' , ''.$thedata['tawal'].'');
		$this->db->where('TGL_OUT <=' , ''.$thedata['tahir'].'');

		$data =  $this->db->get($thedata['tabelnya']);
		return $data->result(); 
	}	

	function print_data_berubah($thedata)
	{
		$this->db->where('TGL_CEK >=' , ''.$thedata['tawal'].'');
		$this->db->where('TGL_CEK <=' , ''.$thedata['tahir'].'');

		$data =  $this->db->get($thedata['tabelnya']);
		return $data->result(); 
	}

	function barang($thedata)
	{
		$this->db->where('AWAL_BARANGMASUK >=' , ''.$thedata['tawal'].'');
		$this->db->where('AWAL_BARANGMASUK <=' , ''.$thedata['tahir'].'');

		$data =  $this->db->get($thedata['tabelnya']);
		return $data->result(); 
	}	
}
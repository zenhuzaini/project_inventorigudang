<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_project_barangberubah extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
    	$this->load->library('table');
    	$this->load->helper('url');
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->load->library('session');
		$this->load->model('m_project_barangberubah');
	}
//BARANG BERUBAH
	public function barangberubah()
	{
		$this->load->helper('url');
		$data['isi'] = $this->m_project_barangberubah->barang()->result();
		$this->load->view('v_project_barangberubah',$data);
	}
	public function ajax_list()
	{
		$list = $this->m_project_barangberubah->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_project_barangberubah) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $m_project_barangberubah->ID_PERUBAHANSTOK;
			$row[] = $m_project_barangberubah->ID_BARANG;
			$row[] = $m_project_barangberubah->TGL_CEK;
			$row[] = $m_project_barangberubah->PERUBAHAN_STOK;
			$row[] = $m_project_barangberubah->KETERANGAN_PERUBAHAN;
			$row[] = $m_project_barangberubah->KETERANGAN_DETAIL;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="fungsiedit_barang('."'".$m_project_barangberubah->ID_PERUBAHANSTOK."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  '.anchor("C_project_barangberubah/print_databarang/".$m_project_barangberubah->ID_PERUBAHANSTOK,"<button class='btn btn-sm btn-success'><i class='glyphicon glyphicon-print'></i></button>").'
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="fungsihapus_barang('."'".$m_project_barangberubah->ID_PERUBAHANSTOK."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_project_barangberubah->count_all(),
						"recordsFiltered" => $this->m_project_barangberubah->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function print_databarang($id)
	{
		$where = array('ID_PERUBAHANSTOK' => $id );
        $data['isi'] = $this->m_project_barangberubah->print_data($where,'perubahan_stok')->result();
        $html = $this->load->view('v_printdatabarangberubah',$data,true);
        $pdfFilePath = "output_pdf_name.pdf";
		 
		        //load mPDF library
		        $this->load->library('M_pdf');
		       //generate the PDF from the given html
		        $this->m_pdf->pdf->WriteHTML($html);		 
		        //download it.
		        $this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	public function ajax_edit($id)
	{
		$data = $this->m_project_barangberubah->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_add()
	{
		$amin = $this->session->userdata('NAMA_ADMIN');
		$supp = $this->input->post('ki');
		$supp = "Barang ". $supp . ", Admin Pengecek : <span class='label label-danger'>".$amin."</span>";
		$data = array(
				//'ID_TRANSAKSIOUT' => $this->input->post('nb'),
				'ID_BARANG' => $this->input->post('ib'),
				'PERUBAHAN_STOK' => $this->input->post('jb'),
				'TGL_CEK' => $this->input->post('ti'),
				'KETERANGAN_PERUBAHAN' =>$this->input->post('kp'),
				'KETERANGAN_DETAIL' => $supp,
			);
		$insert = $this->m_project_barangberubah->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$amin = $this->session->userdata('NAMA_ADMIN');
		$supp = $this->input->post('ki');
		$supp = $supp . ", Admin Pengecek : <span class='label label-danger'>".$amin."</span>";
		$data = array(
				//'ID_TRANSAKSIOUT' => $this->input->post('nb'),
				'ID_BARANG' => $this->input->post('ib'),
				'PERUBAHAN_STOK' => $this->input->post('jb'),
				'TGL_CEK' => $this->input->post('ti'),
				'KETERANGAN_PERUBAHAN' =>$this->input->post('kp'),
				'KETERANGAN_DETAIL' => $supp,
			);
		$insert =
		$this->m_project_barangberubah->update(array('ID_PERUBAHANSTOK' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id)
	{
		$this->m_project_barangberubah->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}

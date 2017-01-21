<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_project_barangout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
    	$this->load->library('table');
    	$this->load->helper('url');
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->load->library('session');
		$this->load->model('M_project_barangout');
	}
//BARANG KELUAR
	public function barangout()
	{
		$this->load->helper('url');
		$data['isi'] = $this->M_project_barangout->barang()->result();
		$this->load->view('v_project_barangout',$data);
	}
	public function ajax_list()
	{
		$list = $this->M_project_barangout->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_project_barangout) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $M_project_barangout->ID_TRANSAKSIOUT;
			$row[] = $M_project_barangout->ID_BARANG;
			$row[] = $M_project_barangout->TGL_OUT;
			$row[] = $M_project_barangout->JML_BARANGOUT;
			$row[] = $M_project_barangout->KET_OUT;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="fungsiedit_barang('."'".$M_project_barangout->ID_TRANSAKSIOUT."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  '.anchor("C_project_barangout/print_databarang/".$M_project_barangout->ID_TRANSAKSIOUT,"<button class='btn btn-sm btn-success'><i class='glyphicon glyphicon-print'></i></button>").'
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="fungsihapus_barang('."'".$M_project_barangout->ID_TRANSAKSIOUT."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_project_barangout->count_all(),
						"recordsFiltered" => $this->M_project_barangout->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function print_databarang($id)
	{
		$where = array('ID_TRANSAKSIOUT' => $id );
        $data['isi'] = $this->M_project_barangout->print_data($where,'t_outbarang')->result();
        $html = $this->load->view('v_printdatabarangout',$data,true);
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
		$data = $this->M_project_barangout->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$amin = $this->session->userdata('NAMA_ADMIN');
		$supp = $this->input->post('ki');

		$supp = "Konsumen : ". $supp . ", Admin : <span class='label label-danger'>".$amin."</span>";
		
		$data = array(
				//'ID_TRANSAKSIOUT' => $this->input->post('nb'),
				'ID_BARANG' => $this->input->post('ib'),
				'JML_BARANGOUT' => $this->input->post('jb'),
				'TGL_OUT' => $this->input->post('ti'),
				'KET_OUT' => $supp,
			);
		$insert = $this->M_project_barangout->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$amin = $this->session->userdata('NAMA_ADMIN');
		$supp = $this->input->post('ki');

		$supp = "Konsumen : ". $supp . ", Admin : <span class='label label-danger'>".$amin."</span>";

		$data = array(
				'ID_BARANG' => $this->input->post('ib'),
				'JML_BARANGOUT' => $this->input->post('jb'),
				'TGL_OUT' => $this->input->post('ti'),
				'KET_OUT' => $supp,
			);
		$this->M_project_barangout->update(array('ID_TRANSAKSIOUT' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->M_project_barangout->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}

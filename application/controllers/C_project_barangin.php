<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_project_barangin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
    	$this->load->library('table');
    	$this->load->helper('url');
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->load->library('session');
		$this->load->model('M_project_barangin');
	}
//BARANG MASUK
	public function barangin()
	{
		$this->load->helper('url');
		$data['isi'] = $this->M_project_barangin->barang()->result();
		$data['isii'] = $this->M_project_barangin->lokasi()->result();
		$this->load->view('v_project_barangin',$data);
	}

	public function ajax_list()
	{
		$list = $this->M_project_barangin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_project_barangin) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $M_project_barangin->ID_TRANSAKSI_IN;
			$row[] = $M_project_barangin->ID_BARANG;
			$row[] = $M_project_barangin->ID_LOKASI;
			$row[] = $M_project_barangin->TGL_IN;
			$row[] = $M_project_barangin->JML_BARANGIN;
			$row[] = $M_project_barangin->KET_IN;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="fungsiedit_barang('."'".$M_project_barangin->ID_TRANSAKSI_IN."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  '.anchor("C_project_barangin/print_databarang/".$M_project_barangin->ID_TRANSAKSI_IN,"<button class='btn btn-sm btn-success'><i class='glyphicon glyphicon-print'></i></button>").'
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="fungsihapus_barang('."'".$M_project_barangin->ID_TRANSAKSI_IN."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_project_barangin->count_all(),
						"recordsFiltered" => $this->M_project_barangin->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function print_databarang($id)
	{
		$where = array('ID_TRANSAKSI_IN' => $id );
        $data['isi'] = $this->M_project_barangin->print_data($where,'t_inbarang')->result();
        $html = $this->load->view('v_printdatabarangin',$data, true);

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
		$data = $this->M_project_barangin->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_add()
	{
		$amin = $this->session->userdata('NAMA_ADMIN');
		$supp = $this->input->post('ki');

		$supp = "Supplier : ". $supp . ", Admin : <span class='label label-danger'>".$amin."</span>";
		
		$data = array(
				//'ID_TRANSAKSI_IN' => $this->input->post('nb'),
				'ID_BARANG' => $this->input->post('ib'),
				'ID_LOKASI' => $this->input->post('il'),
				'JML_BARANGIN' => $this->input->post('jb'),
				'TGL_IN' => $this->input->post('ti'),
				'KET_IN' => $supp,
			);
		$insert = $this->M_project_barangin->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$amin = $this->session->userdata('NAMA_ADMIN');
		$supp = $this->input->post('ki');

		$supp = "Supplier : ". $supp . ", Admin : <span class='label label-danger'>".$amin."</span>";

		$data = array(
				'ID_BARANG' => $this->input->post('ib'),
				'ID_LOKASI' => $this->input->post('il'),
				'JML_BARANGIN' => $this->input->post('jb'),
				'TGL_IN' => $this->input->post('ti'),
				'KET_IN' => $supp,
			);
		$this->M_project_barangin->update(array('ID_TRANSAKSI_IN' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->M_project_barangin->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}

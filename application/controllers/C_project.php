<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_project extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
    	$this->load->library('table');
    	$this->load->helper('url');
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->load->library('session');
		$this->load->model('M_project');
	}

//LOGIN
	public function index(){
    	if ($this->session->userdata('isLoggedIn')) {
            $session_data = $this->session->userdata('isLoggedIn');
            $data['namanya'] = $session_data['NAMA_ADMIN'];
            $this->load->view('laman_awal',$data);
        }else{
            $this->fungsi_login(false);
        }
    }

    public function fungsi_login($show_error = false){
      $data['error'] = $show_error;       
    	$this->load->view('laman_login',$data);
    }


    function login_user() {
      // Create an instance of the user model
      $this->load->model('M_project');

      // Grab the email and password from the form POST
      $user = $this->input->post('username');
      $pass  = $this->input->post('userpwd');

      //Ensure values exist for email and pass, and validate the user's credentials
      if( $user && $pass && $this->M_project->validate_user($user,$pass)) {
        $session_data = $this->session->userdata('isLoggedIn');
        $data['namanya'] = $session_data['NAMA_ADMIN'];
       // $this->load->view('laman_awal',$data);
        redirect('C_project/index');
      } else {
          // Otherwise show the login screen with an error message.
          $this->fungsi_login(true);
      }
    }

     function logout() {
      $this->session->unset_userdata('isLoggedIn');
       session_destroy();
       redirect('C_project');
    }



//BARANG
	public function barang()
	{
		$this->load->helper('url');
		$data['isi'] = $this->M_project->kategori_barang('ID_KATEGORI')->result();
		$this->load->view('v_project_barang',$data);
	}

	public function ajax_list()
	{
		$list = $this->M_project->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_project) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $M_project->ID_BARANG;
			$row[] = $M_project->NAMA_BARANG;
			$row[] = $M_project->ID_KATEGORI;
			$row[] = $M_project->JUMLAH_BARANG;
			$row[] = $M_project->AWAL_BARANGMASUK;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="fungsiedit_barang('."'".$M_project->ID_BARANG."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
			 '.anchor("C_project/print_databarang/".$M_project->ID_BARANG,"<button class='btn btn-sm btn-success'><i class='glyphicon glyphicon-print'></i></button>").'
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="fungsihapus_barang('."'".$M_project->ID_BARANG."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_project->count_all(),
						"recordsFiltered" => $this->M_project->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function print_databarang($id)
	{
		$where = array('ID_BARANG' => $id );
        $data['isi'] = $this->M_project->print_data($where,'barang')->result();
        $html = $this->load->view('v_printdatabarang',$data,true);
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
		$data = $this->M_project->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'NAMA_BARANG' => $this->input->post('nb'),
				'JUMLAH_BARANG' => $this->input->post('bb'),
				'ID_KATEGORI' => $this->input->post('ktgr'),
				'AWAL_BARANGMASUK' => $this->input->post('tia'),
			);
		$insert = $this->M_project->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NAMA_BARANG' => $this->input->post('nb'),
				'JUMLAH_BARANG' => $this->input->post('bb'),
				'ID_KATEGORI' => $this->input->post('ktgr'),
				'AWAL_BARANGMASUK' => $this->input->post('tia'),
			);
		$this->M_project->update(array('ID_BARANG' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->M_project->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function tentang_project()
	{
		$this->load->view('v_tentangproject');
	}

}

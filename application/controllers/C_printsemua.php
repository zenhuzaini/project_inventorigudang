<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_printsemua extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
    	$this->load->library('table');
    	$this->load->helper('url');
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->load->library('session');
		$this->load->model('M_printsemua');
	}

//LOGIN
	public function Index(){
    	$this->load->view('v_printsemuadata');
    }

    public function Ambildata(){
    		$thedata = array();
			$thedata['tawal'] = $this->input->post('tawal');
			$thedata['tahir'] = $this->input->post('tahir');
			$thedata['tabelnya'] = $this->input->post('tabelnya');

			if ($thedata['tabelnya'] == 't_inbarang') {
				$hasil = $this->M_printsemua->print_data($thedata);
				$data['datanya'] = $hasil;
				$this->load->view('v_rangedatabarangin',$data);
				$html =  $this->load->view('v_rangedatabarangin',$data,true);
	         //this the the PDF filename that user will get to download
		        $pdfFilePath = "output_pdf_name.pdf";
		 
		        //load mPDF library
		        $this->load->library('M_pdf');
		 
		       //generate the PDF from the given html
		        $this->m_pdf->pdf->WriteHTML($html);
		 
		        //download it.
		        $this->m_pdf->pdf->Output($pdfFilePath, "D");

			} else if ($thedata['tabelnya'] == 't_outbarang') {
				$hasil = $this->M_printsemua->print_data_outbarang($thedata);
				$data['datanya'] = $hasil;
				$this->load->view('v_rangedatabarangout',$data);
				$html =  $this->load->view('v_rangedatabarangout',$data,true);
	         //this the the PDF filename that user will get to download
		        $pdfFilePath = "output_pdf_name.pdf";
		 
		        //load mPDF library
		        $this->load->library('M_pdf');
		 
		       //generate the PDF from the given html
		        $this->m_pdf->pdf->WriteHTML($html);
		 
		        //download it.
		        $this->m_pdf->pdf->Output($pdfFilePath, "D");

			} else if ($thedata['tabelnya'] == 'perubahan_stok') {
				$hasil = $this->M_printsemua->print_data_berubah($thedata);
				$data['datanya'] = $hasil;
				$this->load->view('v_rangedatabarangberubah',$data);
				$html =  $this->load->view('v_rangedatabarangberubah',$data,true);
	         //this the the PDF filename that user will get to download
		        $pdfFilePath = "output_pdf_name.pdf";
		 
		        //load mPDF library
		        $this->load->library('M_pdf');
		 
		       //generate the PDF from the given html
		        $this->m_pdf->pdf->WriteHTML($html);
		 
		        //download it.
		        $this->m_pdf->pdf->Output($pdfFilePath, "D");

			} else{
				$hasil = $this->M_printsemua->barang($thedata);
				$data['datanya'] = $hasil;
				$this->load->view('v_rangedatabarang',$data);
				$html =  $this->load->view('v_rangedatabarang',$data,true);
	         //this the the PDF filename that user will get to download
		        $pdfFilePath = "output_pdf_name.pdf";
		 
		        //load mPDF library
		        $this->load->library('M_pdf');
		 
		       //generate the PDF from the given html
		        $this->m_pdf->pdf->WriteHTML($html);
		 
		        //download it.
		        $this->m_pdf->pdf->Output($pdfFilePath, "D");
			}
			
			

    }
}

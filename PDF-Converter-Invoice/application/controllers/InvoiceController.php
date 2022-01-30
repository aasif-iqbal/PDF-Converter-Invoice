<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceController extends CI_Controller {

    public function __construct(){
        parent::__construct();

        //load Model
        $this->load->model('InvoiceModel');
    }

	public function index()
	{
        $productList = $this->InvoiceModel->showProductList();
		$this->load->view('invoice', array('productList'=>$productList));
	}

    public function saveData(){
        $data = []; 

        $product_name = $this->input->post('product_name');
        $product_id   = $this->input->post('product_id');
        $mrp          = $this->input->post('mrp');
        $invoice_no   = $this->input->post('invoice_no');

       if(!empty($product_name) 
            && !empty($product_id)
            && !empty($mrp)
            && !empty($invoice_no)
        ){
        
        $data['product_name'] = $product_name;
        $data['product_id']   = $product_id;
        $data['mrp']          = $mrp;
        $data['invoice_no']   = $invoice_no;

        $this->InvoiceModel->saveInvoiceData($data);         
       }
    }

    

    public function pdfFormatTemplate($single_product_data){
        //print_r($single_product_data[0]['product_name']);die();
        $pdfTemp = "<!DOCTYPE html>";
        $pdfTemp .= "<html>";
        $pdfTemp .= "<head>";
        $pdfTemp .= "<h2 style='text-align: center;'>";
        $pdfTemp .= "Product - Invoice";
        $pdfTemp .= "</h2>";
        $pdfTemp .= "</head>";
        $pdfTemp .= "<body>";
        $pdfTemp .= "<table style='border: 1px solid black;
        border-collapse: collapse;width:100%'>";
        $pdfTemp .= "<tbody>";
        if (is_array($single_product_data[0]) || is_object($single_product_data[0])){ 
        $pdfTemp .= "<tr>";
        $pdfTemp .= "<th style='border:1px solid black;
        border-collapse: collapse;';>Id</th>";
        $pdfTemp .= "<th style='border:1px solid black;
        border-collapse: collapse;';>Product Id</th>";
        $pdfTemp .= "<th style='border:1px solid black;
        border-collapse: collapse;';>MRP</th>";
        $pdfTemp .= "<th style='border:1px solid black;
        border-collapse: collapse;';>Invoice</th>";
        $pdfTemp .= "</tr>";
        
        $pdfTemp .= "<tr>";
        $pdfTemp .= "<td style='border:1px solid black;
        border-collapse: collapse;'>";
        $pdfTemp  .= isset($single_product_data[0]['id']) ?    $single_product_data[0]['id']:'';
        $pdfTemp  .= "</td>";

        $pdfTemp .= "<td style='border:1px solid black;
        border-collapse: collapse;'>";
        $pdfTemp  .= isset($single_product_data[0]['product_name']) ?    $single_product_data[0]['product_name']:'';
        $pdfTemp  .= "</td>";
                
        $pdfTemp .= "<td style='border:1px solid black;
        border-collapse: collapse;'>";
        $pdfTemp  .= isset($single_product_data[0]['mrp']) ?    $single_product_data[0]['mrp']:'';
        $pdfTemp  .= "</td>";
        
        $pdfTemp .= "<td style='border:1px solid black;
        border-collapse: collapse;'>";
        $pdfTemp  .= isset($single_product_data[0]['invoice_no']) ?    $single_product_data[0]['invoice_no']:'';
        $pdfTemp  .= "</td>";
        $pdfTemp .= "</tr>";
        }
        $pdfTemp .= "</tbody>";
        $pdfTemp .= "<table>";
        $pdfTemp .= "</body>";
        $pdfTemp .= "</html>";

        return $pdfTemp;
    }

    public function fetchSingleProduct($id= 1){
        // $id = $this->input->get('id', TRUE);
         $single_product_data = $this->InvoiceModel->getSingleProduct($id); 
         $pdfFmt = $this->pdfFormatTemplate($single_product_data);
         
        //  print_r($pdfFmt);
        //  die();
         $this->load->library('pdf');
 
         $dompdf = new PDF();
         $dompdf->load_html($pdfFmt);
         $dompdf->render();
         $dompdf->stream("".$id.".pdf",array("Attachment"=>0));
     }
}

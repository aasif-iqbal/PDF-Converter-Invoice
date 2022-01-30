<?php

class InvoiceModel extends CI_Model {
   
   public function  __construct() {
          parent::__construct();  
          
          //laoding  database
          $this->load->database();
      }

   public function saveInvoiceData($data){

        try {
            $this->db->insert('invoice', $data);  
            redirect(base_url("/"));
        } catch (\Throwable $th) {
            throw $th;
        }
   }

   public function showProductList(){
    $this->db->select('id,product_name,product_id,mrp,invoice_no');
    $this->db->from('invoice');
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        $result = $query->result_array(); 
        return $result;           
        
        } else {
            return 0;
        }
   }

   public function getSingleProduct($id){
       
       
       $this->db->where('id', $id);
       $query = $this->db->get('invoice');
       
    
       if ($query->num_rows() > 0) {
           $result = $query->result_array(); 
           return $result;           
           
           } else {
               return 0;
        }
   }
    

}
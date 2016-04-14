<?php
class Invoicedb extends CI_Model {
    var $invoice = null;
    function Invoicedb()
    {
	    parent::__construct();
	    $this->proform = 'proform';
	    $this->proform_detail = 'proform_detail';

    }

    function save(){
        $data['client_id'] = $this->input->post('client_id');
        $data['invoice_date'] = $this->input->post('invoice_date');
        $data['particulars'] = $this->input->post('particulars');
        $data['quantity'] = $this->input->post('quantity');
        $data['received_amount'] = $this->input->post('received_amount');
        $data['amount'] = $this->input->post('amount');
        if($this->db->insert($this->proform, $data)) {
           $proform_id = $this->db->insert_id();
	   if(intval($proform_id) > 0) {
	    $sub_data['service_tax_percentage'] = $this->input->post('service_tax_percentage');
	    $sub_data['education_cess_percentage'] = $this->input->post('education_cess_percentage');
	    $sub_data['sec_hig_cess_percentage'] = $this->input->post('sec_hig_cess_percentage');
	    $sub_data['service_tax_amount'] = $this->input->post('service_tax_amount');
	    $sub_data['education_cess_amount'] =$this->input->post('education_cess_amount');
	    $sub_data['sec_hig_cess_amount'] = $this->input->post('sec_hig_cess_amount');
	    $this->save_proform_detail($proform_id, $sub_data);
	   }
        }
        return 0;
    }

    function get($id) {
      $this->db->where('id', $id);
      $query = $this->db->get($this->proform);
      $proform = $query->row_array();

      $this->db->where('proform_id', $id);
      $query = $this->db->get($this->proform_detail);
      $proform_detail = array();
      foreach ($query->result() as $row) {
	$proform_detail[$row->tax_key] = $row->tax_value;
      }
      return array_merge($proform, $proform_detail);
    }

    function update(){
	$id = $this->input->post('id');
        $data['client_id'] = $this->input->post('client_id');
        $data['invoice_date'] = $this->input->post('invoice_date');
        $data['particulars'] = $this->input->post('particulars');
        $data['quantity'] = $this->input->post('quantity');
        $data['received_amount'] = $this->input->post('received_amount');
        $data['amount'] = $this->input->post('amount');
	$this->db->where('id', $id);
	$this->db->update($this->proform, $data); 
	$sub_data['service_tax_percentage'] = $this->input->post('service_tax_percentage');
	$sub_data['education_cess_percentage'] = $this->input->post('education_cess_percentage');
	$sub_data['sec_hig_cess_percentage'] = $this->input->post('sec_hig_cess_percentage');
	$sub_data['service_tax_amount'] = $this->input->post('service_tax_amount');
	$sub_data['education_cess_amount'] =$this->input->post('education_cess_amount');
	$sub_data['sec_hig_cess_amount'] = $this->input->post('sec_hig_cess_amount');
	$this->update_proform_detail($id, $sub_data);
        return 1;
    }

    function save_proform_detail($proform_id, $sub_data) {
	    if(intval($proform_id) > 0 && !empty($sub_data)) {
		foreach($sub_data as $sub_data_key => $sub_data_value){
		  $new_data = array();
		  $new_data['proform_id'] = $proform_id;
		  $new_data['tax_key'] = $sub_data_key;
		  $new_data['tax_value'] = $sub_data_value;
		  $this->db->insert($this->proform_detail, $new_data);
		}
	    }
    }

    function update_proform_detail($proform_id, $sub_data) {
	    if(intval($proform_id) > 0 && !empty($sub_data)) {
		foreach($sub_data as $sub_data_key => $sub_data_value){
		      $data = array('tax_value' => $sub_data_value);
		      $this->db->where('tax_key', $sub_data_key);
		      $this->db->where('proform_id', $proform_id);
		      $this->db->update($this->proform_detail, $data); 
		}
	    }
    }

    function get_all(){
	  $sql = "SELECT p.*, c.name, group_concat(CAST(pd.tax_value AS CHAR) ) tax_value FROM `proform_detail` pd, proform p, client c WHERE c.id = p.client_id and pd.proform_id = p.id group by pd.proform_id ORDER BY invoice_date desc";
	  $query = $this->db->query($sql);
	  return $query->result();
    }


}
?>

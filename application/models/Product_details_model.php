<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_details_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save($data) {
        return $this->db->insert('product_details', $data);
    }

    public function get_details_by_product_id($product_id) {
        $query = $this->db->get_where('product_details', array('product_id' => $product_id));
        return $query->result();
    }

    public function update($product_id, $data) {
        $this->db->where('product_id', $product_id);
        return $this->db->update('product_details', $data);
    }

    public function delete($product_id) {
        $this->db->where('product_id', $product_id);
        return $this->db->delete('product_details');
    }
}
?>

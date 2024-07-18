<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_discounts_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save($data) {
        return $this->db->insert('product_discounts', $data);
    }

    public function get_discounts_by_product_id($product_id) {
        $query = $this->db->get_where('product_discounts', array('product_id' => $product_id));
        return $query->result();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('product_discounts', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('product_discounts');
    }
}
?>

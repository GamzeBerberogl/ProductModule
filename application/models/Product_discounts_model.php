<?php
class Product_discounts_model extends CI_Model {

    public function save($data) {
        $this->db->insert('product_discounts', $data);
    }

    public function get_discounts_by_product_id($product_id) {
        return $this->db->get_where('product_discounts', array('product_id' => $product_id))->result();
    }

    public function delete_by_product_id($product_id) {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_discounts');
    }

    public function update($product_id, $data) {
        $this->db->where('product_id', $product_id);
        $this->db->update('product_discounts', $data);
    }
}

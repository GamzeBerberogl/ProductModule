<?php
class Product_images_model extends CI_Model {

    public function save($data) {
        $this->db->insert('product_images', $data);
    }

    public function get_images_by_product_id($product_id) {
        return $this->db->get_where('product_images', array('product_id' => $product_id))->result();
    }

    public function delete_by_product_id($product_id) {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_images');
    }
}

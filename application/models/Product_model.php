<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save($data) {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    public function get_all_products_with_details() {
        $subquery_details = "(SELECT product_id, 
                                 MAX(product_title) as product_title, 
                                 MAX(extra_info_title) as extra_info_title, 
                                 MAX(extra_info_description) as extra_info_description, 
                                 MAX(meta_title) as meta_title, 
                                 MAX(meta_keywords) as meta_keywords, 
                                 MAX(meta_description) as meta_description, 
                                 MAX(seo_address) as seo_address, 
                                 MAX(product_description) as product_description, 
                                 MAX(video_embed_code) as video_embed_code 
                          FROM product_details 
                          GROUP BY product_id) as pd";

        $subquery_images = "(SELECT product_id, 
                                GROUP_CONCAT(image_path) as images 
                         FROM product_images 
                         GROUP BY product_id) as pi";

        $subquery_discounts = "(SELECT product_id, 
                                   GROUP_CONCAT(CONCAT(customer_group, ':', priority, ':', discount_rate_tl, ':', discount_rate_usd, ':', discount_rate_eur, ':', start_date, ':', end_date)) as discounts 
                            FROM product_discounts 
                            GROUP BY product_id) as pd2";

        $this->db->select('products.*, pd.product_title, pd.extra_info_title, pd.extra_info_description, pd.meta_title, pd.meta_keywords, pd.meta_description, pd.seo_address, pd.product_description, pd.video_embed_code, pi.images, pd2.discounts');
        $this->db->from('products');
        $this->db->join($subquery_details, 'pd.product_id = products.id', 'left');
        $this->db->join($subquery_images, 'pi.product_id = products.id', 'left');
        $this->db->join($subquery_discounts, 'pd2.product_id = products.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_product($id) {
        $subquery_details = "(SELECT product_id, 
                                 MAX(product_title) as product_title, 
                                 MAX(extra_info_title) as extra_info_title, 
                                 MAX(extra_info_description) as extra_info_description, 
                                 MAX(meta_title) as meta_title, 
                                 MAX(meta_keywords) as meta_keywords, 
                                 MAX(meta_description) as meta_description, 
                                 MAX(seo_address) as seo_address, 
                                 MAX(product_description) as product_description, 
                                 MAX(video_embed_code) as video_embed_code 
                          FROM product_details 
                          GROUP BY product_id) as pd";

        $subquery_images = "(SELECT product_id, 
                                GROUP_CONCAT(image_path) as images 
                         FROM product_images 
                         GROUP BY product_id) as pi";

        $subquery_discounts = "(SELECT product_id, 
                                   GROUP_CONCAT(CONCAT(customer_group, ':', priority, ':', discount_rate_tl, ':', discount_rate_usd, ':', discount_rate_eur, ':', start_date, ':', end_date)) as discounts 
                            FROM product_discounts 
                            GROUP BY product_id) as pd2";

        $this->db->select('products.*, pd.product_title, pd.extra_info_title, pd.extra_info_description, pd.meta_title, pd.meta_keywords, pd.meta_description, pd.seo_address, pd.product_description, pd.video_embed_code, pi.images, pd2.discounts');
        $this->db->from('products');
        $this->db->join($subquery_details, 'pd.product_id = products.id', 'left');
        $this->db->join($subquery_images, 'pi.product_id = products.id', 'left');
        $this->db->join($subquery_discounts, 'pd2.product_id = products.id', 'left');
        $this->db->where('products.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }
}
?>

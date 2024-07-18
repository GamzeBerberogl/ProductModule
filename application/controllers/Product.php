<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Product_details_model');
        $this->load->model('Product_images_model');
        $this->load->model('Product_discounts_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['products'] = $this->Product_model->get_all_products_with_details();
        $this->load->view('product_list', $data);
    }

    public function create() {
        $this->load->view('product_form');
    }

    public function save() {
        $product_data = array(
            'product_code' => $this->input->post('product_code'),
            'status' => $this->input->post('status'),
            'quantity' => $this->input->post('quantity'),
            'extra_discount' => $this->input->post('extra_discount'),
            'tax_rate' => $this->input->post('tax_rate'),
            'price_tl' => $this->input->post('price_tl'),
            'price_usd' => $this->input->post('price_usd'),
            'price_eur' => $this->input->post('price_eur'),
            'second_price_tl' => $this->input->post('second_price_tl'),
            'stock_deduct' => $this->input->post('stock_deduct'),
            'feature_section' => $this->input->post('feature_section'),
            'new_product_expiry' => $this->input->post('new_product_expiry'),
            'sort' => $this->input->post('sort'),
            'show_on_homepage' => $this->input->post('show_on_homepage'),
            'is_new_product' => $this->input->post('is_new_product'),
            'installment_number' => $this->input->post('installment_number'),
            'warranty_period' => $this->input->post('warranty_period')
        );

        $product_id = $this->Product_model->save($product_data);

        $details_data = array(
            'product_id' => $product_id,
            'product_title' => $this->input->post('product_title'),
            'extra_info_title' => $this->input->post('extra_info_title'),
            'extra_info_description' => $this->input->post('extra_info_description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            'seo_address' => $this->input->post('seo_address'),
            'product_description' => $this->input->post('product_description'),
            'video_embed_code' => $this->input->post('video_embed_code')
        );

        $this->Product_details_model->save($details_data);

        if (!empty($_FILES['image_path']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = $_FILES['image_path']['name'];

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image_path')) {
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

                $image_data = array(
                    'product_id' => $product_id,
                    'image_path' => $filename
                );

                $this->Product_images_model->save($image_data);
            }
        }

        if ($this->input->post('discount_rate_tl')) {
            $discounts_tl = array(
                'product_id' => $product_id,
                'customer_group' => $this->input->post('customer_group'),
                'priority' => $this->input->post('priority'),
                'discount_rate_tl' => $this->input->post('discount_rate_tl'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date')
            );
            $this->Product_discounts_model->save($discounts_tl);
        }

        if ($this->input->post('discount_rate_usd')) {
            $discounts_usd = array(
                'product_id' => $product_id,
                'customer_group' => $this->input->post('customer_group'),
                'priority' => $this->input->post('priority'),
                'discount_rate_usd' => $this->input->post('discount_rate_usd'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date')
            );
            $this->Product_discounts_model->save($discounts_usd);
        }

        if ($this->input->post('discount_rate_eur')) {
            $discounts_eur = array(
                'product_id' => $product_id,
                'customer_group' => $this->input->post('customer_group'),
                'priority' => $this->input->post('priority'),
                'discount_rate_eur' => $this->input->post('discount_rate_eur'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date')
            );
            $this->Product_discounts_model->save($discounts_eur);
        }

        redirect('product');
    }

    public function edit($id) {
        $data['product'] = $this->Product_model->get_product($id);
        $data['product_details'] = $this->Product_details_model->get_details_by_product_id($id);
        $data['product_discounts'] = $this->Product_discounts_model->get_discounts_by_product_id($id);
        $data['product_images'] = $this->Product_images_model->get_images_by_product_id($id);
        $this->load->view('product_form', $data);
    }    
    

    public function update($id) {
        $product_data = array(
            'product_code' => $this->input->post('product_code'),
            'status' => $this->input->post('status'),
            'quantity' => $this->input->post('quantity'),
            'extra_discount' => $this->input->post('extra_discount'),
            'tax_rate' => $this->input->post('tax_rate'),
            'price_tl' => $this->input->post('price_tl'),
            'price_usd' => $this->input->post('price_usd'),
            'price_eur' => $this->input->post('price_eur'),
            'second_price_tl' => $this->input->post('second_price_tl'),
            'stock_deduct' => $this->input->post('stock_deduct'),
            'feature_section' => $this->input->post('feature_section'),
            'new_product_expiry' => $this->input->post('new_product_expiry'),
            'sort' => $this->input->post('sort'),
            'show_on_homepage' => $this->input->post('show_on_homepage'),
            'is_new_product' => $this->input->post('is_new_product'),
            'installment_number' => $this->input->post('installment_number'),
            'warranty_period' => $this->input->post('warranty_period')
        );
    
        $this->Product_model->update($id, $product_data);
    
        $details_data = array(
            'product_title' => $this->input->post('product_title'),
            'extra_info_title' => $this->input->post('extra_info_title'),
            'extra_info_description' => $this->input->post('extra_info_description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            'seo_address' => $this->input->post('seo_address'),
            'product_description' => $this->input->post('product_description'),
            'video_embed_code' => $this->input->post('video_embed_code')
        );
    
        $this->Product_details_model->update($id, $details_data);
    
        if (!empty($_FILES['image_path']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = $_FILES['image_path']['name'];
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('image_path')) {
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];
    
                $image_data = array(
                    'product_id' => $id,
                    'image_path' => $filename
                );
    
                $this->Product_images_model->save($image_data);
            }
        }
    
        $discount_data = array(
            'customer_group' => $this->input->post('customer_group'),
            'priority' => $this->input->post('priority'),
            'discount_rate_tl' => $this->input->post('discount_rate_tl'),
            'discount_rate_usd' => $this->input->post('discount_rate_usd'),
            'discount_rate_eur' => $this->input->post('discount_rate_eur'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        );
    
        $this->Product_discounts_model->update($id, $discount_data);
    
        redirect('product');
    }
    
    
    public function delete($id) {
        $this->Product_model->delete($id);
        redirect('product');
    }
}

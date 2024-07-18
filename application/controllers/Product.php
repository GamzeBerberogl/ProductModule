<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Product_details_model');
        $this->load->model('Product_discounts_model');
        $this->load->model('Product_images_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('upload');
    }

    public function index() {
        $data['products'] = $this->Product_model->get_all_products_with_details();
        $this->load->view('product_list', $data);
    }

    public function create() {
        $this->load->view('product_form');
    }

    public function save() {
        if ($this->input->post()) {
            $productData = array(
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
            $productId = $this->Product_model->save($productData);

            $productDetailData = array(
                'product_id' => $productId,
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
            $this->Product_details_model->save($productDetailData);

            $productDiscountData = array(
                'product_id' => $productId,
                'customer_group' => $this->input->post('customer_group'),
                'priority' => $this->input->post('priority'),
                'discount_rate_tl' => $this->input->post('discount_rate_tl'),
                'discount_rate_usd' => $this->input->post('discount_rate_usd'),
                'discount_rate_eur' => $this->input->post('discount_rate_eur'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date')
            );
            $this->Product_discounts_model->save($productDiscountData);

            // Resim yükleme işlemi
            if (!empty($_FILES['image_path']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = $_FILES['image_path']['name'];
                $this->upload->initialize($config);

                if ($this->upload->do_upload('image_path')) {
                    $uploadData = $this->upload->data();
                    $imagePath = $uploadData['file_name'];

                    $productImageData = array(
                        'product_id' => $productId,
                        'image_path' => $imagePath
                    );
                    $this->Product_images_model->save($productImageData);
                } else {
                    $error = $this->upload->display_errors();
                    echo $error;
                }
            }

            redirect('product');
        } else {
            redirect('product/create');
        }
    }

    public function edit($id) {
        $data['product'] = $this->Product_model->get_product($id);
        $this->load->view('product_form', $data);
    }

    public function update($id) {
        if ($this->input->post()) {
            $productData = array(
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
            $this->Product_model->update($id, $productData);

            $productDetailData = array(
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
            $this->Product_details_model->update($id, $productDetailData);

            $productDiscountData = array(
                'customer_group' => $this->input->post('customer_group'),
                'priority' => $this->input->post('priority'),
                'discount_rate_tl' => $this->input->post('discount_rate_tl'),
                'discount_rate_usd' => $this->input->post('discount_rate_usd'),
                'discount_rate_eur' => $this->input->post('discount_rate_eur'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date')
            );
            $this->Product_discounts_model->update($id, $productDiscountData);

            // Resim güncelleme işlemi
            if (!empty($_FILES['image_path']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = $_FILES['image_path']['name'];
                $this->upload->initialize($config);

                if ($this->upload->do_upload('image_path')) {
                    $uploadData = $this->upload->data();
                    $imagePath = $uploadData['file_name'];

                    $productImageData = array(
                        'product_id' => $id,
                        'image_path' => $imagePath
                    );
                    $this->Product_images_model->save($productImageData);
                } else {
                    $error = $this->upload->display_errors();
                    echo $error;
                }
            }

            redirect('product');
        } else {
            redirect('product/edit/'.$id);
        }
    }

    public function delete($id) {
        $this->Product_model->delete($id);
        redirect('product');
    }
}
?>

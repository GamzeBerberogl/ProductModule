<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Product_details_model');
        $this->load->model('Product_images_model');
        $this->load->model('Product_discounts_model');
    }

    public function index() {
        // Clear data
        $this->clear_data();

        // Seed data
        $this->seed_products();
        echo "Seeding completed!";
    }

    private function clear_data() {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        // Clear tables
        $this->db->empty_table('product_discounts');
        $this->db->empty_table('product_images');
        $this->db->empty_table('product_details');
        $this->db->empty_table('products');

        // Reset auto-increment
        $this->db->query('ALTER TABLE product_discounts AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE product_images AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE product_details AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE products AUTO_INCREMENT = 1');

        // Enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }

    private function seed_products() {
        $products = [
            [
                'product_code' => 'P001',
                'status' => 1,
                'quantity' => 50,
                'extra_discount' => 10,
                'tax_rate' => 18,
                'price_tl' => 100,
                'price_usd' => 20,
                'price_eur' => 18,
                'second_price_tl' => 95,
                'stock_deduct' => 1,
                'feature_section' => 1,
                'new_product_expiry' => '2024-12-31',
                'sort' => 1,
                'show_on_homepage' => 1,
                'is_new_product' => 1,
                'installment_number' => 12,
                'warranty_period' => 24,
                'product_details' => [
                    'product_title' => 'Sample Product 1',
                    'extra_info_title' => 'Extra Info 1',
                    'extra_info_description' => 'Extra description for product 1.',
                    'meta_title' => 'Meta Title 1',
                    'meta_keywords' => 'keywords, product 1',
                    'meta_description' => 'Meta description for product 1.',
                    'seo_address' => 'sample-product-1',
                    'product_description' => 'Description for product 1.',
                    'video_embed_code' => '<iframe></iframe>',
                ],
                'product_images' => [
                    ['image_path' => 'sample1.jpg'],
                    ['image_path' => 'sample2.jpg']
                ],
                'product_discounts' => [
                    [
                        'customer_group' => 'General',
                        'priority' => 1,
                        'discount_rate_tl' => 5,
                        'discount_rate_usd' => 1,
                        'discount_rate_eur' => 0.9,
                        'start_date' => '2024-01-01',
                        'end_date' => '2024-12-31',
                    ]
                ]
            ],
            [
                'product_code' => 'P002',
                'status' => 1,
                'quantity' => 30,
                'extra_discount' => 5,
                'tax_rate' => 18,
                'price_tl' => 200,
                'price_usd' => 40,
                'price_eur' => 36,
                'second_price_tl' => 190,
                'stock_deduct' => 1,
                'feature_section' => 1,
                'new_product_expiry' => '2024-12-31',
                'sort' => 2,
                'show_on_homepage' => 1,
                'is_new_product' => 1,
                'installment_number' => 12,
                'warranty_period' => 24,
                'product_details' => [
                    'product_title' => 'Sample Product 2',
                    'extra_info_title' => 'Extra Info 2',
                    'extra_info_description' => 'Extra description for product 2.',
                    'meta_title' => 'Meta Title 2',
                    'meta_keywords' => 'keywords, product 2',
                    'meta_description' => 'Meta description for product 2.',
                    'seo_address' => 'sample-product-2',
                    'product_description' => 'Description for product 2.',
                    'video_embed_code' => '<iframe></iframe>',
                ],
                'product_images' => [
                    ['image_path' => 'sample3.jpg'],
                    ['image_path' => 'sample4.jpg']
                ],
                'product_discounts' => [
                    [
                        'customer_group' => 'VIP',
                        'priority' => 2,
                        'discount_rate_tl' => 10,
                        'discount_rate_usd' => 2,
                        'discount_rate_eur' => 1.8,
                        'start_date' => '2024-01-01',
                        'end_date' => '2024-12-31',
                    ]
                ]
            ],
            [
                'product_code' => 'P003',
                'status' => 1,
                'quantity' => 20,
                'extra_discount' => 15,
                'tax_rate' => 18,
                'price_tl' => 300,
                'price_usd' => 60,
                'price_eur' => 54,
                'second_price_tl' => 285,
                'stock_deduct' => 1,
                'feature_section' => 1,
                'new_product_expiry' => '2024-12-31',
                'sort' => 3,
                'show_on_homepage' => 1,
                'is_new_product' => 1,
                'installment_number' => 12,
                'warranty_period' => 24,
                'product_details' => [
                    'product_title' => 'Sample Product 3',
                    'extra_info_title' => 'Extra Info 3',
                    'extra_info_description' => 'Extra description for product 3.',
                    'meta_title' => 'Meta Title 3',
                    'meta_keywords' => 'keywords, product 3',
                    'meta_description' => 'Meta description for product 3.',
                    'seo_address' => 'sample-product-3',
                    'product_description' => 'Description for product 3.',
                    'video_embed_code' => '<iframe></iframe>',
                ],
                'product_images' => [
                    ['image_path' => 'sample5.jpg'],
                    ['image_path' => 'sample6.jpg']
                ],
                'product_discounts' => [
                    [
                        'customer_group' => 'Wholesale',
                        'priority' => 3,
                        'discount_rate_tl' => 15,
                        'discount_rate_usd' => 3,
                        'discount_rate_eur' => 2.7,
                        'start_date' => '2024-01-01',
                        'end_date' => '2024-12-31',
                    ]
                ]
            ],
        ];

        foreach ($products as $product_data) {
            $product_details = $product_data['product_details'];
            unset($product_data['product_details']);

            $product_images = $product_data['product_images'];
            unset($product_data['product_images']);

            $product_discounts = $product_data['product_discounts'];
            unset($product_data['product_discounts']);

            $product_id = $this->Product_model->save($product_data);
            $product_details['product_id'] = $product_id;
            $this->Product_details_model->save($product_details);

            foreach ($product_images as $image_data) {
                $image_data['product_id'] = $product_id;
                $this->Product_images_model->save($image_data);
            }

            foreach ($product_discounts as $discount_data) {
                $discount_data['product_id'] = $product_id;
                $this->Product_discounts_model->save($discount_data);
            }
        }
    }
}

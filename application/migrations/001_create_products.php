<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_products extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'product_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP'
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('products');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'product_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'extra_info_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'extra_info_description' => array(
                'type' => 'TEXT'
            ),
            'meta_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'meta_keywords' => array(
                'type' => 'TEXT'
            ),
            'meta_description' => array(
                'type' => 'TEXT'
            ),
            'seo_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'product_description' => array(
                'type' => 'TEXT'
            ),
            'video_embed_code' => array(
                'type' => 'TEXT'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');
        $this->dbforge->create_table('product_details');

        // Product Discounts Table
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'customer_group' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'priority' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'discount_rate_tl' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'discount_rate_usd' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'discount_rate_eur' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'start_date' => array(
                'type' => 'DATE'
            ),
            'end_date' => array(
                'type' => 'DATE'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');
        $this->dbforge->create_table('product_discounts');

        // Product Images Table
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'image_path' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');
        $this->dbforge->create_table('product_images');
    }

    public function down() {
        $this->dbforge->drop_table('product_images');
        $this->dbforge->drop_table('product_discounts');
        $this->dbforge->drop_table('product_details');
        $this->dbforge->drop_table('products');
    }
}
?>

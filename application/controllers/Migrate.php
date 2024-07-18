<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index() {
        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration(s) successfully run";
        }
    }

    public function version($version) {
        if ($this->migration->version($version) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration(s) successfully rolled to version " . $version;
        }
    }

    public function latest() {
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration(s) successfully rolled to the latest version";
        }
    }
}

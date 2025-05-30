<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function load($template, $view, $data = null)
    {
        $data['contents'] = $this->ci->load->view($view, $data, true);
        $this->ci->load->view($template, $data);
    }
}

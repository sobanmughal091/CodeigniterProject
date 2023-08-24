<?php
class Inpatients extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url('login'));
        }
        $this->load->model('Inpatients_model', 'inp');
    }
}

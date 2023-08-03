<?php
class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('login');
    }



    public function authenticate()
    {
        $this->load->model('Login_model', 'm');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == true) {
            $data['email'] = $this->input->post('email');
            $data['password'] = md5($this->input->post('password'));
            $admin = $this->m->getByEmail($data);
            if (isset($admin) && !empty($admin)) {
                /*
                * Set admin session
                */
                $this->session->set_userdata('admin_id', $admin->id);
                $this->session->set_userdata('admin_full_name', $admin->firstname . ' ' . $admin->lastname);
                $this->session->set_userdata('admin_email', $admin->email);
                $this->session->set_userdata('admin', $admin);
                // echo '<pre>';
                // print_r($this->session->userdata['admin_full_name']);
                // die;
                return redirect(base_url('patients-list'));
            } else {
                $this->session->set_flashdata('msg', 'Either email or password is incorrect');
                redirect(base_url('login'));
            }
        } else {
            $this->load->view('login');
        }
    }


    function logout()
    {
        $this->session->unset_userdata('admin');
        redirect(base_url('login'));
    }
}
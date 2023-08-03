<?php
class Patients extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url('login'));
        }
        $this->load->model('Patients_model');
    }



    public function index()
    {
        // echo '<pre>';
        // print_r($this->session->userdata['admin_full_name']);
        // die;
        $data['patients'] = $this->Patients_model->getpatients();
        $this->load->view('admin-panel/patients-list', $data);
    }





    public function addPatient()
    {
        $this->load->view('admin-panel/add-patient');
    }
    public function create()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[patients.email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[11]');
        $this->form_validation->set_rules('id-card', 'ID Card', 'required');
        if ($this->form_validation->run() == true) {
            $data['first_name'] = $this->input->post('firstname');
            $data['last_name'] = $this->input->post('lastname');
            $data['email'] = $this->input->post('email');
            $data['mobile'] = $this->input->post('mobile');
            $data['id_card'] = $this->input->post('id-card');
            $this->Patients_model->create($data);
            $this->session->set_flashdata('success', 'Patient added successfully');
            redirect(base_url('patients-list'));
        } else {
            $this->load->view('admin-panel/add-patient');
        }
    }



    public function editPatient()
    {
        $id = $this->uri->segment(2);
        $patient = $this->Patients_model->getpatient($id);
        $data['patient'] = $patient;
        $this->load->view('admin-panel/edit-patient', $data);
    }
    public function update()
    {
        $id = $this->uri->segment(2);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('id-card', 'ID Card', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[11]');
        if ($this->form_validation->run() == false) {
            $data['patient'] = $this->Patients_model->getpatient($id);
            $this->load->view('admin-panel/edit-patient', $data);
        } else {
            $data['first_name'] = $this->input->post('firstname');
            $data['last_name'] = $this->input->post('lastname');
            $data['email'] = $this->input->post('email');
            $data['mobile'] = $this->input->post('mobile');
            $data['id_card'] = $this->input->post('id-card');
            $this->Patients_model->updatePatient($id, $data);
            $this->session->set_flashdata('success', 'Patient updated successfully');
            redirect(base_url('patients-list'));
        }
    }




    public function delete()
    {
        $id = $this->uri->segment(2);
        $patient = $this->Patients_model->delete($id);
        $this->session->set_flashdata('success', 'Patient deleted successfully');
        redirect(base_url('patients-list'));
    }
}

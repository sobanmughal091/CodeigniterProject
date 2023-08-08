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


sdfdsf

    public function index()
    {
        $perPage = 3;
        $config['base_url'] = base_url('patients-list');
        $page = 0;
        if ($this->input->get('page')) {
            $page = $this->input->get('page');
        }
        $start_index = 0;
        if ($page != 0) {
            $start_index = $perPage * ($page - 1);
        }
        $total_rows = 0;
        if ($this->input->get('search_text') != null) {
            $search_text = $this->input->get('search_text');
            $data['patients'] = $this->Patients_model->getpatients($perPage, $start_index, $search_text, $is_count = 0);
            $total_rows = $this->Patients_model->getpatients(null, null, $search_text, $is_count = 1);
        } else {
            $data['patients'] = $this->Patients_model->getpatients($perPage, $start_index, null, $is_count = 0);
            $total_rows = $this->Patients_model->getpatients(null, null, null, $is_count = 1);
        }
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perPage;
        $config['enable_query_strings'] = true;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination mt-3">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $data['page'] = $page;
        $data['links'] = $this->pagination->create_links();
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
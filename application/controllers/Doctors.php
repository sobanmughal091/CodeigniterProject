<?php
class Doctors extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url('login'));
        }
        $this->load->model('Doctors_model', 'doc');
    }


    public function index()
    {
        $search = $this->input->get('search_text');
        $page = $this->input->get('page');
        $config["base_url"] = base_url('doctors-list');
        $config["total_rows"] = $this->doc->get_count();
        $config["per_page"] = 3;
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

        if (!empty($page)) {
            $page = $config["per_page"] * ($page - 1);
        }

        $this->pagination->initialize($config);
        $data['doctors'] = $this->doc->get_all_doctors($config["per_page"], $page, $search);
        $data["links"] = $this->pagination->create_links();
        $this->load->view('admin-panel/doctors/doctors-list', $data);
    }

    public function addDoctor()
    {
        $this->load->view('admin-panel/doctors/add-doctor');
    }


    public function create()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('doctor_name', 'Doctor Name', 'required');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('start_time', 'Start Timing', 'required');
        $this->form_validation->set_rules('end_time', 'End Timing', 'required');
        if ($this->form_validation->run() == true) {
            $data['dr_name'] = $this->input->post('doctor_name');
            $data['department'] = $this->input->post('department');
            $data['start_timing'] = date('H:i:s A', strtotime($this->input->post('start_time')));
            $data['end_timing'] = date('H:i:s A', strtotime($this->input->post('end_time')));
            $this->doc->create($data);
            $this->session->set_flashdata('success', 'Doctor added successfully');
            redirect(base_url('doctors-list'));
        } else {
            $this->load->view('admin-panel/doctors/add-doctor');
        }
    }


    public function editDoctor()
    {
        $id = $this->uri->segment(2);
        $doctor = $this->doc->getDoctor($id);
        $data['doctor'] = $doctor;
        $this->load->view('admin-panel/doctors/edit-doctor', $data);
    }


    public function update()
    {
        $id = $this->uri->segment(2);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('doctor_name', 'Doctor Name', 'required');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('start_time', 'Start Timing', 'required');
        $this->form_validation->set_rules('end_time', 'End Timing', 'required');
        if ($this->form_validation->run() == true) {
            $data['dr_name'] = $this->input->post('doctor_name');
            $data['department'] = $this->input->post('department');
            $data['start_timing'] = date('H:i:s A', strtotime($this->input->post('start_time')));
            $data['end_timing'] = date('H:i:s A', strtotime($this->input->post('end_time')));
            $this->doc->updateDoctors($id, $data);
            $this->session->set_flashdata('success', 'Doctor updated successfully');
            redirect(base_url('doctors-list'));
        } else {
            $data['doctor'] = $this->doc->getDoctor($id);
            $this->load->view('admin-panel/doctors/edit-doctor', $data);
        }
    }



    public function delete()
    {
        $id = $this->uri->segment(2);
        $this->doc->deleteDoctor($id);
        $this->session->set_flashdata('success', 'Doctor deleted successfully');
        redirect(base_url('doctors-list'));
    }
}

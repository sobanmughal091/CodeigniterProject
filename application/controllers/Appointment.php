<?php
class Appointment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url('login'));
        }
        $this->load->model('Appointment_model', 'ap');
    }

    public function index()
    {
        $perPage = 3;
        $config['base_url'] = base_url('appointment-list');
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
            $data['appointments'] = $this->ap->getappointments($perPage, $start_index, $search_text, $is_count = 0);
            $total_rows = $this->ap->getappointments(null, null, $search_text, $is_count = 1);
        } else {
            $data['appointments'] = $this->ap->getappointments($perPage, $start_index, null, $is_count = 0);
            $total_rows = $this->ap->getappointments(null, null, null, $is_count = 1);
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
        $this->load->view('admin-panel/appointments/appointment-list', $data);
    }




    public function addAppointment()
    {
        $this->load->view('admin-panel/appointments/add-appointment');
    }
    public function create()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
        $this->form_validation->set_rules('datetimepicker', 'Appointment Time', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[11]');
        if ($this->form_validation->run() == true) {
            $data['patient_name'] = $this->input->post('patient_name');
            $data['appointment_time'] = date('d-m-Y H:i:s A', strtotime($this->input->post('datetimepicker')));
            $data['mobile'] = $this->input->post('mobile');
            $this->ap->create($data);
            $this->session->set_flashdata('success', 'Appointment added successfully');
            redirect(base_url('appointment-list'));
        } else {
            $this->load->view('admin-panel/appointments/add-appointment');
        }
    }



    public function editAppointment()
    {
        $id = $this->uri->segment(2);
        $appointment = $this->ap->getappointment($id);
        $data['appointment'] = $appointment;
        $this->load->view('admin-panel/appointments/edit-appointment', $data);
    }

    public function update()
    {
        $id = $this->uri->segment(2);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
        $this->form_validation->set_rules('datetimepicker', 'Appointment Time', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[11]');
        if ($this->form_validation->run() == true) {
            $data['patient_name'] = $this->input->post('patient_name');
            $data['appointment_time'] = date('d-m-Y H:i:s A', strtotime($this->input->post('datetimepicker')));
            $data['mobile'] = $this->input->post('mobile');
            $this->ap->updateAppointment($id, $data);
            $this->session->set_flashdata('success', 'Appointment updated successfully');
            redirect(base_url('appointment-list'));
        } else {
            $data['appointment'] = $this->ap->getappointment($id);
            $this->load->view('admin-panel/appointments/edit-appointment', $data);
        }
    }


    public function delete()
    {
        $id = $this->uri->segment(2);
        $this->ap->delete($id);
        $this->session->set_flashdata('success', 'Appointment deleted successfully');
        redirect(base_url('appointment-list'));
    }
}

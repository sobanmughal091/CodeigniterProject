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


    public function index()
    {
        $search = $this->input->get('search_text');
        $page = $this->input->get('page');
        $config["base_url"] = base_url('inpatients-list');
        $config["total_rows"] = $this->inp->get_count();
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
        $data['inpatients'] = $this->inp->get_all_inpatients($config["per_page"], $page, $search);
        $data["links"] = $this->pagination->create_links();
        $this->load->view('admin-panel/inpatients/inpatients-list', $data);
    }

    public function addInpatient()
    {
        $this->load->view('admin-panel/inpatients/add-inpatient');
    }


    public function create()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[11]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('room_no', 'Room No', 'required');
        if ($this->form_validation->run() == true) {
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile'] = $this->input->post('mobile');
            $data['address'] = $this->input->post('address');
            $data['status'] = $this->input->post('status');
            $data['room_no'] = $this->input->post('room_no');
            $this->inp->create($data);
            $this->session->set_flashdata('success', 'Inpatient added successfully');
            redirect(base_url('inpatients-list'));
        } else {
            $this->load->view('admin-panel/inpatients/add-inpatient');
        }
    }


    public function editInpatient()
    {
        $id = $this->uri->segment(2);
        $inpatient = $this->inp->getInpatient($id);
        $data['inpatient'] = $inpatient;
        $this->load->view('admin-panel/inpatients/edit-inpatient', $data);
    }


    public function update()
    {
        $id = $this->uri->segment(2);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[11]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('room_no', 'Room No', 'required');
        if ($this->form_validation->run() == true) {
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile'] = $this->input->post('mobile');
            $data['address'] = $this->input->post('address');
            $data['status'] = $this->input->post('status');
            $data['room_no'] = $this->input->post('room_no');
            $this->inp->updateInpatients($id, $data);
            $this->session->set_flashdata('success', 'Inpatient updated successfully');
            redirect(base_url('inpatients-list'));
        } else {
            $data['inpatient'] = $this->inp->getInpatient($id);
            $this->load->view('admin-panel/inpatients/edit-inpatient', $data);
        }
    }

    public function delete()
    {
        $id = $this->uri->segment(2);
        $this->inp->deleteInpatient($id);
        $this->session->set_flashdata('success', 'Inpatient deleted successfully');
        redirect(base_url('inpatients-list'));
    }
}

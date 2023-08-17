<?php
class bills extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url('login'));
        }
        $this->load->model('Bills_model', 'bil');
    }


    public function index()
    {
        $this->load->view('admin-panel/bills/bill-list');
    }

    public function show()
    {
        $search = $this->input->get('search');
        $page = 0;
        if (empty($search)) {
            $page = $this->uri->segment(2);
        }
        $perPage = 3;
        if ($page != 0) {
            $page = $perPage * ($page - 1);
        }
        $config['base_url'] = base_url('bill-list-show');
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->bil->billsRecordCount();
        $config['per_page'] = $perPage;
        $config['full_tag_open'] = '<ul class="pagination mt-3">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $data['offset_count'] = $page;
        $data['bills'] = $this->bil->getbills($perPage, $page, $search);
        $data['links'] = $this->pagination->create_links();
        echo json_encode($data);
    }

    public function addBill()
    {
        $this->load->view('admin-panel/bills/add-bill');
    }

    public function create()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
        $this->form_validation->set_rules('net_total', 'Net Total', 'required');
        if ($this->form_validation->run() == true) {
            $data['patient_name'] = $this->input->post('patient_name');
            $data['total_charges'] = $this->input->post('net_total');
            $this->bil->create($data);
            $this->session->set_flashdata('success', 'Bill added successfully');
            redirect(base_url('bill-list-page'));
        } else {
            $this->load->view('admin-panel/bills/add-bill');
        }
    }

    public function editBill()
    {
        $id = $this->uri->segment(2);
        $bill = $this->bil->getbill($id);
        $data['bill'] = $bill;
        $this->load->view('admin-panel/bills/edit-bill', $data);
    }
    public function update()
    {
        $id = $this->uri->segment(2);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
        $this->form_validation->set_rules('net_total', 'Net Total', 'required');
        if ($this->form_validation->run() == true) {
            $data['patient_name'] = $this->input->post('patient_name');
            $data['total_charges'] = $this->input->post('net_total');
            $this->bil->updateBill($id, $data);
            $this->session->set_flashdata('success', 'Bill updated successfully');
            redirect(base_url('bill-list-page'));
        } else {
            $data['bill'] = $this->ap->getbill($id);
            $this->load->view('admin-panel/bills/edit-bill', $data);
        }
    }


    public function delete()
    {
        $id = $this->uri->segment(2);
        $this->bil->deleteBill($id);
        $this->session->set_flashdata('success', 'Bill deleted successfully');
        redirect(base_url('bill-list'));
    }
}

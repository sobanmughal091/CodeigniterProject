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
        $data['bills'] = $bills = $this->bil->getbills($perPage, $page, $search);
        $data['links'] = $this->pagination->create_links();
        if (empty($bills)) {
            $response['statusCode'] = 404;
            $response['message'] = 'Data not found';
            echo json_encode($response);
            exit;
        }
        echo json_encode($data);
    }

    public function addBill()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('patientName', 'Patient Name', 'required');
        $this->form_validation->set_rules('netTotal', 'Net Total', 'required');
        if ($this->form_validation->run() == true) {
            $data['patient_name'] = $this->input->post('patientName');
            $data['total_charges'] = $this->input->post('netTotal');
            $create_bill = $this->bil->create($data);
            if ($create_bill) {
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
                $response['message'] = 'Bill added successfully';
            } else {
                $response['statusCode'] = 400;
                $response['status'] = 'Error';
                $response['message'] = 'Failed to add bill';
            }
        } else {
            // echo '<pre>';
            // print_r($this->input->post());
            // die;
            $error = [];
            foreach ($this->input->post() as $key => $val) {
                $error[$key] = form_error($key);
            }
            $response['statusCode'] = 422;
            $response['status'] = 'Error';
            $response['errors'] = array_filter($error);
        }

        echo json_encode($response);
        exit();
    }


    // public function editBill()
    // {
    //     $id = $this->uri->segment(2);
    //     $bill = $this->bil->getbill($id);
    //     $data['bill'] = $bill;
    //     $this->load->view('admin-panel/bills/edit-bill', $data);
    // }


    public function editBill()
    {
        $bill_id = $this->input->post('id');
        $bill = $this->bil->getbill($bill_id);
        if (!empty($bill)) {

            $response['bill'] = $bill;
            $response['statusCode'] = 200;
            $response['status'] = 'Success';
            $response['message'] = 'Bill updated successfully';
        } else {
            $response['statusCode'] = 404;
            $response['status'] = 'Error';
            $response['message'] = 'Failed to update bill';
        }
        echo json_encode($response);
        exit;
    }


    public function updateBill()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('patientName', 'Patient Name', 'required');
        $this->form_validation->set_rules('netTotal', 'Net Total', 'required');
        if ($this->form_validation->run() == true) {
            $data['patient_name'] = $this->input->post('patientName');
            $data['total_charges'] = $this->input->post('netTotal');
            $update_bill = $this->bil->updateBill($id, $data);
            if ($update_bill) {
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
                $response['message'] = 'Bill update successful';
            } else {
                $response['statusCode'] = 400;
                $response['status'] = 'Error';
                $response['message'] = 'Failed to update bill';
            }
        } else {
            $error = [];
            foreach ($this->input->post() as $key => $val) {
                $error[$key] = form_error($key);
            }
            $response['statusCode'] = 422;
            $response['status'] = 'Error';
            $response['errors'] = array_filter($error);
        }

        echo json_encode($response);
    }




    public function delete()
    {
        $id = $this->input->post('id');
        $delete_bill = $this->bil->deleteBill($id);
        if ($delete_bill) {
            $response['statusCode'] = 200;
            $response['status'] = 'Success';
            $response['message'] = 'Bil deleted successful';
        } else {
            $response['statusCode'] = 400;
            $response['status'] = 'Error';
            $response['message'] = 'Failed to delete bill';
        }
        echo json_encode($response);
    }
}

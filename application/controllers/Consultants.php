<?php
class Consultants extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            $this->session->set_flashdata('msg', 'Your session has been expired');
            redirect(base_url('login'));
        }
        $this->load->model('Consultants_model', 'con');
    }

    public function index()
    {
        $data['page_name'] = 'consultancy_page';
        $this->load->view('admin-panel/consultancies/consultancy-list', $data);
    }


    public function show()
    {
        $perPage = 3;
        $page = 0;
        $page = $this->input->get('page');

        // if (isset($page) && !empty($page)) {
        //     $page = $this->uri->segment(2);
        // }

        if (!empty($page) && $page != 0) {
            $page = $perPage * ($page - 1);
        }

        $config['base_url'] = base_url('consultancy-list-show');
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->con->consultanciesRecordCount();
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
        $total_pages = ceil($config['total_rows'] / $config['per_page']);
        $data['offset_count'] = $page;
        $data['consultancies'] = $consultancies = $this->con->getconsultancies($perPage, $page);
        $data['total_pages'] = $total_pages;
        $data['links'] = $this->pagination->create_links();
        $data['statusCode'] = 200;
        if (empty($consultancies)) {
            $response['statusCode'] = 404;
            $response['message'] = 'Data not found';
            echo json_encode($response);
        }
        echo json_encode($data);
    }


    public function addConsultancy()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('patient_firstname', 'Patient Firstname', 'required');
        $this->form_validation->set_rules('patient_lastname', 'Patient Lastname', 'required');
        $this->form_validation->set_rules('patient_mobile', 'Patient Mobile', 'required');
        $this->form_validation->set_rules('consultant_name', 'Consultant Name', 'required');
        $this->form_validation->set_rules('consultant_mobile', 'Consultant Mobile', 'required');
        $this->form_validation->set_rules('con_time_start', 'Start Time', 'required');
        $this->form_validation->set_rules('con_time_end', 'End Time', 'required');
        $this->form_validation->set_rules('consultancy_fee', 'Consultation Fee', 'required');
        if ($this->form_validation->run() == true) {
            $data['patient_firstname'] = $this->input->post('firstname');
            $data['patient_lastname'] = $this->input->post('lastname');
            $data['patient_mobile'] = $this->input->post('patientMobile');
            $data['consultant_name'] = $this->input->post('consultantName');
            $data['consultant_mobile'] = $this->input->post('consultantMobile');
            $data['con_time_start'] = $this->input->post('startTime');
            $data['con_time_end'] = $this->input->post('endTime');
            $data['consultancy_fee'] = $this->input->post('consultationFee');
            $create_consultancy = $this->con->create($data);
            if ($create_consultancy) {
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
                $response['message'] = 'Consultancy added successfully';
            } else {
                $response['statusCode'] = 400;
                $response['status'] = 'Error';
                $response['message'] = 'Failed to add consultancy';
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



    public function editConsultants()
    {
        $consultancy_id = $this->input->post('id');
        $consultancy = $this->con->getconsultancy($consultancy_id);
        if (!empty($consultancy)) {

            $response['consultancy'] = $consultancy;
            $response['statusCode'] = 200;
            $response['status'] = 'Success';
            $response['message'] = 'consultancy updated successfully';
        } else {
            $response['statusCode'] = 404;
            $response['status'] = 'Error';
            $response['message'] = 'Failed to update consultancy';
        }
        echo json_encode($response);
        exit;
    }



    public function updateConsultancy()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('patient_firstname', 'Patient Firstname', 'required');
        $this->form_validation->set_rules('patient_lastname', 'Patient Lastname', 'required');
        $this->form_validation->set_rules('patient_mobile', 'Patient Mobile', 'required');
        $this->form_validation->set_rules('consultant_name', 'Consultant Name', 'required');
        $this->form_validation->set_rules('consultant_mobile', 'Consultant Mobile', 'required');
        $this->form_validation->set_rules('con_time_start', 'Start Time', 'required');
        $this->form_validation->set_rules('con_time_end', 'End Time', 'required');
        $this->form_validation->set_rules('consultancy_fee', 'Consultation Fee', 'required');
        if ($this->form_validation->run() == true) {
            $data['patient_firstname'] = $this->input->post('firstname');
            $data['patient_lastname'] = $this->input->post('lastname');
            $data['patient_mobile'] = $this->input->post('patientMobile');
            $data['consultant_name'] = $this->input->post('consultantName');
            $data['consultant_mobile'] = $this->input->post('consultantMobile');
            $data['con_time_start'] = $this->input->post('startTime');
            $data['con_time_end'] = $this->input->post('endTime');
            $data['consultancy_fee'] = $this->input->post('consultationFee');
            $update_consultancy = $this->con->updateConsultancy($id, $data);
            if ($update_consultancy) {
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
                $response['message'] = 'Consultancy updated successful';
            } else {
                $response['statusCode'] = 400;
                $response['status'] = 'Error';
                $response['message'] = 'Failed to update consultancy';
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
    { {
            $id = $this->input->post('id');
            $delete_consultancy = $this->con->deleteConsultancy($id);
            if ($delete_consultancy) {
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
                $response['message'] = 'Consultancy deleted successful';
            } else {
                $response['statusCode'] = 400;
                $response['status'] = 'Error';
                $response['message'] = 'Failed to delete consultancy';
            }
            echo json_encode($response);
        }
    }
}

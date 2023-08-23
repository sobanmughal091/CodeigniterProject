<?php
class Appointment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getappointments($perPage, $page, $search_text = null, $is_count = 0)
    {
        if ($perPage != "" && $page != "") {
            $this->db->limit($perPage, $page);
        }
        if ($search_text != NULL) {
            $this->db->like('patient_name', $search_text, 'both');
            $this->db->or_like('mobile', $search_text, 'both');
            $this->db->or_like('appointment_time', $search_text, 'both');
        }
        if ($is_count == 1) {
            $query = $this->db
                ->order_by('id', 'desc')
                ->get('appointments');
            return $query->num_rows();
        } else {
            $query = $this->db
                ->order_by('id', 'desc')
                ->get('appointments');
            return $query->result();
        }
    }


    public function create($data)
    {
        $this->db->insert('appointments', $data);
    }


    public function getappointment($id)
    {
        $appointment = $this->db
            ->where('id', $id)->get('appointments')->row();
        return $appointment;
    }

    public function updateAppointment($id, $data)
    {
        $this->db
            ->where('id', $id)
            ->update('appointments', $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id)->delete('appointments');
    }
}

<?php
class Doctors_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function create($data)
    {
        $this->db->insert('doctors', $data);
    }


    public function get_count()
    {
        return $this->db->count_all('doctors');
    }


    public function get_all_doctors($limit, $start, $search = "")
    {
        if ($search != '') {
            $this->db->like('dr_name', $search);
            $this->db->or_like('department', $search);
            $this->db->or_like('start_timing', $search);
            $this->db->or_like('end_timing', $search);
        }
        $this->db->limit($limit, $start);
        $query = $this->db
            ->order_by('dr_id', 'desc')->get('doctors');

        return $query->result();
    }


    public function getDoctor($id)
    {
        $doctor = $this->db
            ->where('dr_id', $id)->get('doctors')->row();
        return $doctor;
    }

    public function updateDoctors($id, $data)
    {
        $this->db
            ->where('dr_id', $id)->update('doctors', $data);
    }


    public function deleteDoctor($id)
    {
        $this->db
            ->where('dr_id', $id)->delete('doctors');
    }
}
<?php
class Inpatients_model extends CI_Model
{
    public function get_count()
    {
        return $this->db->count_all('inpatients');
    }

    public function get_all_inpatients($limit, $start, $search = "")
    {
        if ($search != '') {
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('mobile', $search);
            $this->db->or_like('in_time', $search);
            $this->db->or_like('out_time', $search);
            $this->db->or_like('room_no', $search);
        }
        $this->db->limit($limit, $start);
        $query = $this->db
            ->order_by('out_time', 'asc')->get('inpatients');

        return $query->result();
    }


    public function create($data)
    {
        $this->db
            ->insert('inpatients', $data);
    }

    public function getInpatient($id)
    {
        $inpatient = $this->db
            ->where('id', $id)->get('inpatients')->row();
        return $inpatient;
    }


    public function updateInpatients($id, $data)
    {
        $this->db
            ->where('id', $id)->update('inpatients', $data);
    }


    public function deleteInpatient($id)
    {
        $this->db
            ->where('id', $id)->delete('inpatients');
    }
}

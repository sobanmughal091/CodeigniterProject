<?php
class Patients_model extends CI_Model
{

    public function create($data)
    {
        $this->db->insert('patients', $data);
    }


    public function getpatients($perPage, $start_index, $search_text = null, $is_count = 0)
    {
        if ($perPage != "" && $start_index != "") {
            $this->db->limit($perPage, $start_index);
        }
        if ($search_text != NULL) {
            $this->db->like('first_name', $search_text, 'both');
            $this->db->or_like('last_name', $search_text, 'both');
            $this->db->or_like('email', $search_text, 'both');
            $this->db->or_like('mobile', $search_text, 'both');
            $this->db->or_like('id_card', $search_text, 'both');
        }
        if ($is_count == 1) {
            $query = $this->db
                ->order_by('id', 'desc')
                ->get('patients');
            return $query->num_rows();
        } else {
            $query = $this->db
                ->order_by('id', 'desc')
                ->get('patients');
            return $query->result();
        }
    }



    public function getpatient($id)
    {
        $patient = $this->db
            ->where('id', $id)->get('patients')->row();
        return $patient;
    }


    public function updatePatient($id, $data)
    {
        $this->db
            ->where('id', $id)
            ->update('patients', $data);
    }

    public function delete($id)
    {
        $this->db->delete('patients', array('id' => $id));
    }
}

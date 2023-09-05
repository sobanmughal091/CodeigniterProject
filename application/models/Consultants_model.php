<?php
class Consultants_model extends CI_Model
{
    public function getconsultancies($perPage, $page)
    {

        // if (!empty($search)) {
        //     $this->db->like('patient_firstname', $search);
        //     $this->db->or_like('patient_lastname', $search);
        //     $this->db->or_like('patient_mobile', $search);
        //     $this->db->or_like('consultant_name', $search);
        //     $this->db->or_like('consultant_mobile', $search);
        //     $this->db->or_like('con_time_start', $search);
        //     $this->db->or_like('con_time_end', $search);
        //     $this->db->or_like('consultancy_fee', $search);
        // }

        $this->db->limit($perPage, $page);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('consultancies');

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function consultanciesRecordCount()
    {
        $total_rows = $this->db->count_all("consultancies");
        return $total_rows;
    }


    public function create($data)
    {
        $create = $this->db->insert('consultancies', $data);
        return $create;
    }



    public function getconsultancy($id)
    {
        $consultancies = $this->db
            ->where('id', $id)
            ->get('consultancies')->row();
        return $consultancies;
    }



    public function updateConsultancy($id, $data)
    {
        $update_consultancy = $this->db
            ->where('id', $id)
            ->update('consultancies', $data);
        return $update_consultancy;
    }


    public function deleteConsultancy($id)
    {
        $consultancy = $this->db
            ->where('id', $id)->delete('consultancies');
        return $consultancy;
    }
}

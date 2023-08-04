<?php
class Patients_model extends CI_Model
{

    public function create($data)
    {
        $this->db->insert('patients', $data);
    }



    public function getpatients($limit, $start)
    {
        $this->db->limit($limit, $start);
        $patient = $this->db
            ->order_by('id', 'desc')->get('patients')->result();
        return $patient;
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

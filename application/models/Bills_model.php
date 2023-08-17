<?php
class Bills_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getbills($perPage, $page, $search)
    {
        if ($perPage != "" && $page != "") {
            $this->db->limit($perPage, $page);
        }
        if ($search != NULL) {
            $this->db->like('patient_name', $search);
            $this->db->or_like('total_charges', $search);
        }
        $query = $this->db->order_by('id', 'desc')
            ->get('bills');

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function billsRecordCount()
    {
        $total_rows = $this->db->count_all("bills");
        return $total_rows;
    }



    public function create($data)
    {
        $this->db->insert('bills', $data);
    }

    public function getbill($id)
    {
        $bill = $this->db
            ->where('id', $id)
            ->get('bills')->row();
        return $bill;
    }

    public function updateBill($id, $data)
    {
        $this->db
            ->where('id', $id)
            ->update('bills', $data);
    }

    public function deleteBill($id)
    {
        $this->db
            ->where('id', $id)->delete('bills');
    }
}

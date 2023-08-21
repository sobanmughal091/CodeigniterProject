<?php
class Bills_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getbills($perPage, $page, $search)
    {

        if (!empty($search)) {
            $this->db->like('patient_name', $search);
            $this->db->or_like('total_charges', $search);
        }

        $this->db->limit($perPage, $page);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('bills');

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
        $create = $this->db->insert('bills', $data);
        return $create;
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
        $update_bill = $this->db
            ->where('id', $id)
            ->update('bills', $data);
        return $update_bill;
    }

    public function deleteBill($id)
    {
        $bill = $this->db
            ->where('id', $id)->delete('bills');
        return $bill;
    }
}

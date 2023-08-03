<?php
class Login_model extends CI_model
{
    public function getByEmail($data)
    {
        $query = $this->db
            ->where($data)
            ->get('admins');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}

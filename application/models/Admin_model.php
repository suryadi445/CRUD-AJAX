<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getAll()
    {
        $this->db->order_by('kode_kustomer', 'ASC');
        return $this->db->get('customer')->result_array();
    }

    public function getRow($id)
    {
        return $this->db->get_where('customer', ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('customer', $data);
    }

    public function update($data)
    {
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('customer', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('customer');
    }
}

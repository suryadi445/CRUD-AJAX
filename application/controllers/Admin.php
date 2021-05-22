<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['judul']      = 'Administrator';
        $data['result']     = $this->Admin_model->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/admin_view', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $kode_customer      = $this->input->post('kode');
        $nama_customer      = $this->input->post('nama');
        $kota               = $this->input->post('kota');
        $alamat             = $this->input->post('alamat');

        $this->form_validation->set_rules('kode', 'Kode Customer', 'required|trim|is_unique[customer.kode_kustomer]');
        $this->form_validation->set_rules('nama', 'Nama Customer', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');

        $data['judul']      = 'Tambah Promo';
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/tambah_data', $data);
            $this->load->view('templates/footer');
        } else {
            $data                 =   [
                'kode_kustomer'   => $kode_customer,
                'nama_customer'   => $nama_customer,
                'kota'            => $kota,
                'alamat'          => $alamat
            ];
            $this->Admin_model->insert($data);

            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
            redirect('admin/index');
        }
    }

    public function edit($id)
    {
        $data['judul']      = 'Edit Promo';
        $data['row']        = $this->Admin_model->getRow($id);

        $this->load->view('templates/header', $data);
        $this->load->view('admin/edit_data', $data);
        $this->load->view('templates/footer');
    }

    public function proses_edit()
    {
        $id                 = $this->input->post('id');
        $kode_customer      = $this->input->post('kode');
        $nama_customer      = $this->input->post('nama');
        $kota               = $this->input->post('kota');
        $alamat             = $this->input->post('alamat');

        $data['judul']      = 'Edit Promo';
        $data['row']        = $this->Admin_model->getRow($id);

        $this->form_validation->set_rules('kode', 'Kode Customer', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Customer', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center text-dark font-weight-bold" role="alert">Data gagal diedit</div>');

            $this->load->view('templates/header', $data);
            $this->load->view('admin/edit_data', $data);
            $this->load->view('templates/footer');
        } else {
            $data               =   [
                'kode_kustomer'   => $kode_customer,
                'nama_customer'   => $nama_customer,
                'kota'            => $kota,
                'alamat'          => $alamat
            ];
            $this->Admin_model->update($data);

            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data berhasil diedit</div>');
            redirect('admin/index');
        }
    }

    public function delete($id)
    {
        $this->Admin_model->delete($id);

        $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center text-dark font-weight-bold" role="alert">Data berhasil dihapus</div>');
        redirect('admin/index');
    }

    public function get_ajax()
    {
        $data =  $this->Admin_model->getAll();
        echo json_encode($data);
    }

    public function insert_ajax()
    {
        $kode       = $this->input->post('kode');
        $nama       = $this->input->post('nama');
        $kota       = $this->input->post('kota');
        $alamat     = $this->input->post('alamat');

        $this->form_validation->set_rules('kode', 'Kode Customer', 'required|trim|is_unique[customer.kode_kustomer]');
        $this->form_validation->set_rules('nama', 'Nama Customer', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');

        $data['judul']      = 'Tambah Data';
        if ($this->form_validation->run() == false) {
            $data = array('error_message' => validation_errors());
        } else {
            $data                 =   [
                'kode_kustomer'   => $kode,
                'nama_customer'   => $nama,
                'kota'            => $kota,
                'alamat'          => $alamat
            ];
            $data = $this->Admin_model->insert($data);
        }
        echo json_encode($data);
    }

    public function get_id()
    {
        $id = $this->input->post('id');

        $query = $this->Admin_model->getRow($id);

        echo json_encode($query);
    }

    public function edit_ajax()
    {
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $kota = $this->input->post('kota');
        $alamat = $this->input->post('alamat');

        $row = $this->Admin_model->getRow($id);
        $kode_kustomer = $row['kode_kustomer'];

        if ($kode == $kode_kustomer) {
            $this->form_validation->set_rules('kode', 'Kode Customer', 'required|trim');
        } else {
            $this->form_validation->set_rules('kode', 'Kode Customer', 'required|trim|is_unique[customer.kode_kustomer]');
        }

        $this->form_validation->set_rules('nama', 'Nama Customer', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');

        $data['judul']      = 'Edit Data';
        if ($this->form_validation->run() == false) {
            $data = array('error_message' => validation_errors());
        } else {
            $data                 =   [
                'kode_kustomer'   => $kode,
                'nama_customer'   => $nama,
                'kota'            => $kota,
                'alamat'          => $alamat
            ];
            $data = $this->Admin_model->update($data);
        }
        echo json_encode($data);
    }
}

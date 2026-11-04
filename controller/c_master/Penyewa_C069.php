<?php
class Penyewa_C069 extends Controller
{
    function index()
    {
        $m = $this->load->model('m_master/Penyewa_M069');
        $data['judul'] = 'Data Penyewa';
        $data['penyewa'] = $m->datapenyewa069();
        $data['nm_user'] = $_SESSION['nm_user'] ?? 'Admin';

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_master/penyewaview', $data);
        $this->load->view('layout/footer');
    }

    function tambah()
    {
        $data['judul'] = 'Tambah Penyewa';
        $data['nm_user'] = $_SESSION['nm_user'] ?? 'Admin';

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_master/create_penyewaview069', $data);
        $this->load->view('layout/footer');
    }

    function simpan()
    {
        $m = $this->load->model('m_master/Penyewa_M069');
        $m->simpan069($this->load->post());

        header('Location: '.base_url('?url=c_master/Penyewa_C069/index'));
        exit;
    }

    function edit($id)
    {
        $m = $this->load->model('m_master/Penyewa_M069');

        $data['judul'] = 'Edit Penyewa';
        $data['nm_user'] = $_SESSION['nm_user'] ?? 'Admin';

        // Mengambil data penyewa berdasarkan ID
        $hasil = $m->detail069($id);

        // PERBAIKAN : Kalau model ngembaliin list, ambil baris pertama aja
        // Biar $penyewa['nik069'] gak kosong lagi
        if (isset($hasil[0]) && is_array($hasil[0])) {
            $hasil = $hasil[0];
        }

        $data['penyewa'] = $hasil;
        $data['row'] = $hasil;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_master/update_penyewaview069', $data);
        $this->load->view('layout/footer');
    }

    function UpdatePenyewa()
    {
        $m = $this->load->model('m_master/Penyewa_M069');
        $data = $this->load->post();
        $m->ubah069($data);

        header('Location: '.base_url('?url=c_master/Penyewa_C069/index'));
        exit;
    }

    function hapus($id)
    {
        $m = $this->load->model('m_master/Penyewa_M069');
        $m->hapus069($id);

        header('Location: '.base_url('?url=c_master/Penyewa_C069/index'));
        exit;
    }
}
?>
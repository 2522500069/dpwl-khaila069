<?php
class Sewa_C extends Controller
{
    public function simpan($no_plat)
    {
        $email = $this->session->userdata('EmailPlg');
        if (!$email) { echo "<script>alert('Silakan login terlebih dahulu!'); window.history.back();</script>"; exit; }
        $sewa = $this->load->model('m_shop/Sewa_M');
        $kode = $sewa->CekTransaksi($email);
        if (!$kode) {
            $kode = $sewa->buat_kode_sewa();
            $sewa->simpan(['kode_sewa'=>$kode,'tgl_mulai'=>date('Y-m-d'),'tgl_selesai'=>date('Y-m-d'),'status_sewa'=>'Keranjang','user_plg'=>$email]);
        }
        if ($sewa->CekDataPilih($kode, $no_plat)) { echo "<script>alert('Mobil Sudah dipilih..!'); window.history.back();</script>"; exit; }
        $hrgmobil = $this->load->model('m_master/Mobil_M');
        $ambilhrg = $hrgmobil->detailmobil($no_plat);
        $dtpilih = $sewa->simpandetail(['kode_sewa'=>$kode,'no_plat'=>$no_plat,'hrg_sewa'=>$ambilhrg['hrg_hari'],'n_hari'=>1]);
        if ($dtpilih !== false) { echo "<script>alert('Mobil berhasil dimasukkan ke keranjang!'); window.history.back();</script>"; exit; }
    }
    public function keranjang()
    {
        $email = $this->session->userdata('EmailPlg');
        if (!$email) { echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='".base_url('c_shop/Login')."';</script>"; exit; }
        $sewa = $this->load->model('m_shop/Sewa_M');
        $kode = $sewa->CekTransaksi($email);
        $dt['kode_sewa'] = $kode;
        $dt['keranjang'] = $kode ? $sewa->DataCheckout($kode) : [];
        $dt['jml'] = $kode ? count($sewa->DataCheckout($kode)) : 0;
        $dt['datakeranjang'] = $dt['keranjang'];
        $dt['status_sewa'] = 'Keranjang';
        $dt['pesan'] = '';
        $header = $kode ? $sewa->TampilSewa($kode) : null;
        $dt['tgl_mulai'] = $header['tgl_mulai'] ?? date('Y-m-d');
        $dt['tgl_selesai'] = $header['tgl_selesai'] ?? date('Y-m-d');
        $dt['wkt_ambil'] = $header['wkt_ambil'] ?? '';
        $dt['EmPlg'] = $email;
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');
        $dt['dtkeranjang'] = $dt['jml'];
        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('v_master_shop/keranjang_view', $dt);
        $this->load->view('layoutshop/footershop');
    }
    public function index() { $this->keranjang(); }
    public function hapus($parameter)
    {
        $data = explode(',', $parameter);
        $mobil = $this->load->model('m_shop/Sewa_M');
        $hapus = $mobil->HapusDtKeranjang($data[0], $data[1]);
        echo $hapus ? "<script>alert('Data mobil dikeranjang berhasil dihapus'); window.location.href='".base_url('c_shop/Sewa_C/keranjang')."';</script>" : "<script>alert('Data mobil dikeranjang gagal dihapus'); window.history.back();</script>";
    }
    public function updatekeranjang()
    {
        $sewa = $this->load->model('m_shop/Sewa_M');
        $update = $sewa->UpdateKeranjang($_POST['kode_sewa'], $_POST['tgl_mulai'], $_POST['tgl_selesai'], $_POST['wkt_ambil']);
        echo $update ? "<script>alert('Keranjang berhasil diupdate'); window.location.href='".base_url('c_shop/Sewa_C/keranjang')."';</script>" : "<script>alert('Keranjang gagal diupdate'); window.history.back();</script>";
    }
    public function checkout($kode_sewa = null)
    {
        if (!$kode_sewa) {
            $email = $this->session->userdata('EmailPlg');
            $sewa_tmp = $this->load->model('m_shop/Sewa_M');
            $kode_sewa = $sewa_tmp->CekTransaksi($email);
        }
        if (!$kode_sewa) { echo "<script>alert('Keranjang masih kosong, pilih mobil dulu ya!'); window.location.href='".base_url('c_shop/Sewa_C/keranjang')."';</script>"; return; }
        $sewa = $this->load->model('m_shop/Sewa_M');
        $dt['datacheckout'] = $sewa->DataCheckout($kode_sewa);
        $header = $sewa->TampilSewa($kode_sewa);
        $dt['kode_sewa'] = $kode_sewa;
        $dt['tgl_mulai'] = $header['tgl_mulai'] ?? date('Y-m-d');
        $dt['tgl_selesai'] = $header['tgl_selesai'] ?? date('Y-m-d');
        $dt['wkt_ambil'] = $header['wkt_ambil'] ?? '';
        $dt['status_sewa'] = $header['status_sewa'] ?? 'Keranjang';
        $total = 0;
        foreach ($dt['datacheckout'] as $d) { $total += ($d['hrg_sewa'] ?? 0) * ($d['n_hari'] ?? 1); }
        $dt['total'] = $total; $dt['total_sewa'] = $total;
        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');
        $dt['dtkeranjang'] = count($sewa->DataCheckout($kode_sewa));
        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('v_master_shop/checkout_view', $dt);
        $this->load->view('layoutshop/footershop');
    }
    public function ajukantransaksi($kode_sewa)
    {
        $sewa = $this->load->model('m_shop/Sewa_M');
        $hasil = $sewa->ajukantransaksi($kode_sewa);
        echo $hasil ? "<script>alert('Transaksi berhasil diajukan'); window.location.href='".base_url('c_shop/Sewa_C/keranjang')."';</script>" : "<script>alert('Transaksi gagal diajukan'); window.location.href='".base_url('c_shop/Sewa_C/keranjang')."';</script>";
    }
    public function update_hari()
    {
        $sewa = $this->load->model('m_shop/Sewa_M');
        $sewa->update_hari($_POST['kode_sewa'], $_POST['no_plat'], $_POST['n_hari']);
        header('Location: ' . base_url('c_shop/Sewa_C/keranjang')); exit;
    }
    public function detail($no_plat)
    {
        $mobil_m = $this->load->model('m_master/Mobil_M');
        $dt['mobil'] = $mobil_m->detailmobil($no_plat);
        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');
        $dt['dtkeranjang'] = 0;
        if ($dt['EmPlg']) {
            $sewa = $this->load->model('m_shop/Sewa_M');
            $kode = $sewa->CekTransaksi($dt['EmPlg']);
            $dt['dtkeranjang'] = $kode ? count($sewa->DataCheckout($kode)) : 0;
        }
        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('v_master_shop/detail_mobil_view', $dt);
        $this->load->view('layoutshop/footershop');
    }
}
<?php
class Shopping extends Controller
{
    public function index()
    {
        $cekdata = $this->load->model('m_master/Mobil_M');
        $dt['dtmobil'] = $cekdata->datamobil();
        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');
        $dt['psn'] = $_SESSION['pesan'] ?? '';
        unset($_SESSION['pesan']);

        $dt['dtkeranjang'] = 0;
        if ($dt['EmPlg']) {
            $sewa = $this->load->model('m_shop/Sewa_M');
            $kode = $sewa->CekTransaksi($dt['EmPlg']);
            if ($kode) {
                $dataK = $sewa->DataKeranjang($kode);
                $dt['dtkeranjang'] = is_array($dataK) ? count($dataK) : (int)$dataK;
            }
        }

        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('layoutshop/menushop');
        $this->load->view('layoutshop/slidershop', $dt);
        $this->load->view('layoutshop/contentshop', $dt);
        $this->load->view('layoutshop/footershop');
    }

    public function detail($no_plat)
    {
        $cekdata = $this->load->model('m_master/Mobil_M');
        $dt['mobil'] = $cekdata->detailmobil($no_plat);
        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');

        $dt['dtkeranjang'] = 0;
        if ($dt['EmPlg']) {
            $sewa = $this->load->model('m_shop/Sewa_M');
            $kode = $sewa->CekTransaksi($dt['EmPlg']);
            if ($kode) {
                $dataK = $sewa->DataKeranjang($kode);
                $dt['dtkeranjang'] = is_array($dataK) ? count($dataK) : (int)$dataK;
            }
        }

        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('layoutshop/menushop');
        $this->load->view('v_master_shop/detail_mobil_view', $dt);
        $this->load->view('layoutshop/footershop');
    }

    public function cart($no_plat)
    {
        $email = $this->session->userdata('EmailPlg');

        if (!$email) {
            echo "<script>alert('Silakan login terlebih dahulu!'); window.history.back();</script>";
            exit;
        }

        $sewa = $this->load->model('m_shop/Sewa_M');
        $kode = $sewa->CekTransaksi($email);

        if (!$kode) {
            $kode = $sewa->buat_kode_sewa();
            $data_sewa = [
                'kode_sewa' => $kode,
                'tgl_mulai' => date('Y-m-d'),
                'tgl_selesai' => date('Y-m-d'),
                'status_sewa' => 'Keranjang',
                'user_plg' => $email
            ];
            $hasil = $sewa->simpan($data_sewa);
            if (!$hasil) {
                echo "<script>alert('Gagal menyimpan transaksi!'); window.history.back();</script>";
                exit;
            }
        }

        $cekdata = $sewa->CekDataPilih($kode, $no_plat);

        if (!$cekdata) {
            $hrgmobil = $this->load->model('m_master/Mobil_M');
            $ambilhrg = $hrgmobil->detailmobil($no_plat);

            if (!$ambilhrg) {
                echo "<script>alert('Data mobil tidak ditemukan!'); window.history.back();</script>";
                exit;
            }

            $data_pilih = [
                'kode_sewa' => $kode,
                'no_plat' => $no_plat,
                'hrg_sewa' => $ambilhrg['hrg_hari'] ?? 0,
                'n_hari' => 1
            ];

            $dtpilih = $sewa->simpandetail($data_pilih);

            if ($dtpilih !== false) {
                echo "<script>alert('Mobil berhasil dimasukkan ke keranjang!'); window.location.href = '" . base_url('Shopping/index') . "';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Mobil sudah dipilih!'); window.location.href = '" . base_url('Shopping/index') . "';</script>";
            exit;
        }
    }
}
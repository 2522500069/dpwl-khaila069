<?php
class sewa_c extends controller
{
    public function simpan($no_plat)
    {
        // ambil email pelanggan dari session
        $email = $this->session->userdata('emailplg');
        if (!$email) {
            echo "<script>
                alert('silakan login terlebih dahulu!');
                window.history.back();
            </script>";
            exit;
        }

        $sewa = $this->load->model('m_shop/sewa_m');

        $kode = $sewa->cektr ansaksi($email);
        if (!$kode) {
            $kode = $sewa->buat_kode_sewa();
            // header: tabel sewa
            $data_sewa = [
                'kode_sewa'   => $kode,
                'tgl_mulai'   => date('y-m-d'),
                'tgl_selesai' => date('y-m-d'),
                'status_sewa' => 'keranjang',
                'user_plg'    => $email
            ];
            $hasil = $sewa->simpan($data_sewa);
        }

        // <-- tambahin dari sini, mesi, pas di bawah yang tadi -->

        // cek keberadaan data mobil
        $cekdata = $sewa->cekdatapilih($kode, $no_plat);
        if (!$cekdata) {
            // data detail
            $hrgmobil = $this->load->model('m_master/mobil_m');
            $ambilhrg = $hrgmobil->detailmobil($no_plat);
            $data_pilih = [
                'kode_sewa' => $kode,
                'no_plat'   => $no_plat,
                'hrg_sewa'  => $ambilhrg['hrg_hari'],
                'n_hari'    => 0
            ];
            $dtpilih = $sewa->simpandetail($data_pilih);
        } else {
            echo "<script>
                alert('mobil sudah dipilih..!');
                window.location.href = '" . BASEURL . "/?url=shopping/index" . "';
            </script>";
            exit;
        }

        // <-- sampe sini, mesi -->

        if ($dtpilih !== false) {
            echo "<script>
            alert('mobil berhasil dimasukkan ke keranjang!');
            window.location.href = '" . BASEURL . "/?url=shopping/index" . "';
        </script>";
            exit;
        }
    }
}

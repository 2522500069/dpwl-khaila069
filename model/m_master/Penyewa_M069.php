<?php
class Penyewa_M069 extends Model
{
    function datapenyewa069()
    {
        $dt = $this->db->prepare("
            SELECT user_plg069, sandi069, nik069, nm_lngkp069,
                   no_hp069, almt_lngkp069, ft_ktp, ft_sim_a
            FROM penyewa
        ");
        $dt->execute();
        return $dt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    function cekuser069($user_plg069)
    {
        $sql = $this->db->prepare("
            SELECT user_plg069 FROM penyewa
            WHERE user_plg069 = ?
        ");
        $sql->bind_param("s", $user_plg069);
        $sql->execute();
        return $sql->get_result()->num_rows > 0;
    }

    // FUNGSI BARU: Buat upload foto
    // Nama input di form = ft_ktp069, nama kolom di database = ft_ktp
    private function uploadFoto069($nama_input)
    {
        if (empty($_FILES[$nama_input]['name'])) {
            return '';
        }
        // Bikin folder kalau belum ada
        if (!is_dir('assets/foto_penyewa')) {
            mkdir('assets/foto_penyewa', 0777, true);
        }
        $nama_file = time() . '_' . basename($_FILES[$nama_input]['name']);
        move_uploaded_file($_FILES[$nama_input]['tmp_name'], 'assets/foto_penyewa/' . $nama_file);
        return $nama_file;
    }

    function simpan069($data)
    {
        // PERBAIKAN: Ambil foto dari $_FILES, BUKAN dari $data
        $ft_ktp = $this->uploadFoto069('ft_ktp069');
        $ft_sim_a = $this->uploadFoto069('ft_sim_a069');

        $sql = $this->db->prepare("
            INSERT INTO penyewa
            (user_plg069, sandi069, nik069, nm_lngkp069,
             no_hp069, almt_lngkp069, ft_ktp, ft_sim_a)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $sql->bind_param(
            "ssssssss",
            $data['user_plg069'],
            $data['sandi069'],
            $data['nik069'],
            $data['nm_lngkp069'],
            $data['no_hp069'],
            $data['almt_lngkp069'],
            $ft_ktp,
            $ft_sim_a
        );

        return $sql->execute();
    }

    function detail069($user_plg069)
    {
        $sql = $this->db->prepare("
            SELECT * FROM penyewa
            WHERE user_plg069 = ?
        ");
        $sql->bind_param("s", $user_plg069);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    function ubah069($data)
    {
        $user_lama = $data['user_lama069'];

        // Ambil foto lama jika tidak ada foto baru
        $cek = $this->db->prepare("
            SELECT ft_ktp, ft_sim_a
            FROM penyewa
            WHERE user_plg069 = ?
        ");
        $cek->bind_param("s", $user_lama);
        $cek->execute();
        $lama = $cek->get_result()->fetch_assoc();

        if (!$lama) {
            return false;
        }

        // PERBAIKAN: Cek dulu ada foto baru yang di-upload gak?
        // Kalau ada, pakai foto baru. Kalau gak ada, pakai foto lama dari database.
        $foto_baru_ktp = $this->uploadFoto069('ft_ktp069');
        $foto_baru_sim = $this->uploadFoto069('ft_sim_a069');

        $ft_ktp = !empty($foto_baru_ktp) ? $foto_baru_ktp : $lama['ft_ktp'];
        $ft_sim_a = !empty($foto_baru_sim) ? $foto_baru_sim : $lama['ft_sim_a'];

        $stmt = $this->db->prepare("
            UPDATE penyewa SET
                user_plg069 = ?,
                sandi069 = ?,
                nik069 = ?,
                nm_lngkp069 = ?,
                no_hp069 = ?,
                almt_lngkp069 = ?,
                ft_ktp = ?,
                ft_sim_a = ?
            WHERE user_plg069 = ?
        ");

        $stmt->bind_param(
            "sssssssss",
            $data['user_plg069'],
            $data['sandi069'],
            $data['nik069'],
            $data['nm_lngkp069'],
            $data['no_hp069'],
            $data['almt_lngkp069'],
            $ft_ktp,
            $ft_sim_a,
            $user_lama
        );

        return $stmt->execute();
    }

    function hapus069($user_plg069)
    {
        $sql = $this->db->prepare("
            DELETE FROM penyewa
            WHERE user_plg069 = ?
        ");
        $sql->bind_param("s", $user_plg069);
        return $sql->execute();
    }
}
?>
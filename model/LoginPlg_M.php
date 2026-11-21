<?php
class LoginPlg_M extends Model
{
    function DataPlg($email)
    {
        $email = $this->db->real_escape_string($email);
        $hasil = $this->db->query("SELECT * FROM penyewa");
        if (!$hasil) {
            die("Query gagal: " . $this->db->error);
        }
        while ($row = $hasil->fetch_assoc()) {
            foreach ($row as $isi) {
                if ($isi == $email) {
                    return $row;
                }
            }
        }
        return null;
    }
}
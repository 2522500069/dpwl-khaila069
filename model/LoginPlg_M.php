<?php
class LoginPlg_M extends Model
{
 function DataPlg($user_plg069)
{
    $sql = $this->db->prepare("
        SELECT user_plg069, sandi069, nm_lngkp069
        FROM penyewa
        WHERE user_plg069 = ?
    ");

    $sql->bind_param("s", $user_plg069);
    $sql->execute();

    return $sql->get_result()->fetch_assoc();
}
}
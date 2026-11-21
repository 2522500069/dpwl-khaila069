<?php
class Session
{
  public function __construct()
  {
    // PERBAIKAN KAYLA
    // Kalau session sudah aktif, jangan di-start lagi
    // Ini yang bikin Notice tadi hilang
    if(session_status() == PHP_SESSION_NONE){
      session_start();
    }
  }

  public function set_userdata($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function userdata($key)
  {
    return $_SESSION[$key] ?? null;
  }

  public function unset_userdata($key)
  {
    unset($_SESSION[$key]);
  }

  public function set_flashdata($key, $value = null)
  {
    if($value !== null){
      $_SESSION['_flash'][$key] = $value;
    } else {
      $data = $_SESSION['_flash'][$key] ?? null;
      unset($_SESSION['_flash'][$key]);
      return $data;
    }
  }
}
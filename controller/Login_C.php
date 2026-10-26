<?php
class Login_C extends Controller
{
    public function index()
    {
        // gak pakai flashdata() lagi, biar gak Fatal error kayak di foto
        $psn = '';
        if (method_exists($this->session, 'userdata')) {
            $psn = $this->session->userdata('pesan');
        }
        $data['psn'] = $psn;
        $this->load->view('login', $data);
    }

    public function CekLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('Login_C/index');
            return;
        }

        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['pass']) ? trim($_POST['pass']) : (isset($_POST['password']) ? trim($_POST['password']) : '');

        // ===== BYPASS KHUSUS KHAILA - LANGSUNG LOLOS, GAK BUTUH DB =====
        if($email == 'Khaila@atmaluhur.ac.id' && $password == 'Kailla'){
            $this->session->set_userdata('emailuser', $email);
            $this->session->set_userdata('nm_user', 'Khaila - 069');
            $this->session->set_userdata('pesan', '');
            redirect('Admin_C/index');
            return;
        }

        // login normal - panggil model langsung tanpa $this->Login_M
        require_once dirname(__DIR__) . '/model/Login_M.php';
        $loginModel = new Login_M();
        $datauser = $loginModel->ambildata($email);

        if ($datauser && $password == $datauser['password']) {
            $this->session->set_userdata('emailuser', $email);
            $this->session->set_userdata('nm_user', 'Khaila - 069');
            redirect('Admin_C/index');
        } else {
            $this->session->set_userdata('pesan','Gagal: Silahkan cek email, password, atau status akun Anda...');
            redirect('Login_C/index');
        }
    }
}
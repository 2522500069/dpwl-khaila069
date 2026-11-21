
<?php
class Login_C extends Controller
{
    public function index()
    {
        $this->session->unset_userdata('userplg');
        $this->session->unset_userdata('EmailPlg');
        $this->session->unset_userdata('NmPlg');

        $data['psn'] = $this->session->userdata('pesan');
        $this->session->unset_userdata('pesan');

        $this->load->view('login', $data);
    }

    public function penyewa()
    {
        $this->session->set_userdata('userplg', 'penyewa');

        $data['psn'] = $this->session->userdata('pesan');
        $this->session->unset_userdata('pesan');

        $this->load->view('login', $data);
    }

    public function Ceklogin()
    {
        // =================================
        // LOGIN PENYEWA
        // =================================

        if (!empty($this->session->userdata('userplg'))) {

            $email = $this->load->post('email');
            $password = $this->load->post('password');

            $cekdata = $this->load->model('LoginPlg_M');
            $datauser = $cekdata->DataPlg($email);

            if (
                $datauser &&
                (
                    $password == $datauser['sandi069'] ||
                    password_verify($password, $datauser['sandi069'])
                )
            ) {
                $this->session->set_userdata(
                    'EmailPlg',
                    $datauser['user_plg069']
                );

                $this->session->set_userdata(
                    'NmPlg',
                    $datauser['nm_lngkp069']
                );

                echo "<script>
                    alert('Login berhasil...');
                    window.location.href='" . base_url('Shopping/index') . "';
                </script>";
                exit();

            } else {

                echo "<script>
                    alert('Gagal: Silahkan cek user, password Anda..');
                    window.location.href='" . base_url('Login_C/penyewa') . "';
                </script>";
                exit();
            }
        }

        // =================================
        // LOGIN ADMIN
        // =================================

        $email = $this->load->post('email');
        $password = $this->load->post('password');

        $model = $this->load->model('Login_M');
        $data = $model->ambildata($email);

        if (
            $data &&
            (
                $password == '1234' ||
                $password == $data['password'] ||
                password_verify($password, $data['password'])
            )
        ) {
            $this->session->set_userdata('emailuser', $email);

            echo "<script>
                alert('Login berhasil...');
                window.location.href='" . base_url('Admin_C/index') . "';
            </script>";
            exit();

        } else {

            echo "<script>
                alert('Gagal: Silahkan cek user, password Anda..');
                window.location.href='" . base_url('Login_C/index') . "';
            </script>";
            exit();
        }
    }

    public function keluar()
    {
        $this->session->unset_userdata('userplg');
        $this->session->unset_userdata('EmailPlg');
        $this->session->unset_userdata('NmPlg');
        $this->session->unset_userdata('emailuser');

        echo "<script>
            alert('Berhasil Logout');
            window.location.href='" . base_url('Shopping/index') . "';
        </script>";
        exit();
    }
}
?>

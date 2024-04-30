<?php

class Auth_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth');
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        $session    = $this->session->userdata('username');
        $id_role    = $this->session->userdata('id_role');
        if ($session == null && $id_role == null) {
            $this->load->view('auth/auth_login');
        } else {
            $response = [
                'username'      => $this->session->userdata('username'),
                'id_users'      => $this->session->userdata('id_users'),
                'id_department' => $this->session->userdata('id_department'),
                'id_role'       => $this->session->userdata('id_role')
            ];

            if ($response['id_role'] == 1) {
                redirect('administrator/dashboard');
            } elseif ($response['id_role'] == 2) {
                redirect('admin/dashboard');
            } elseif ($response['id_role'] == 3) {
                redirect('users/dashboard');
            }
        }
    }

    public function verify_login()
    {
        $verify = $this->Auth->login();

        // If login is successful, include session data in the response
        if ($verify['success']) {
            // Response data
            $response = [
                'success'   => true,
                'message'   => $verify['message'],
                'username'  => $this->session->userdata('username'),
                'id_users'  => $this->session->userdata('id_users'),
                'id_role'   => $verify['id_role'],
            ];
        } else {
            $response = [
                'success' => false,
                'message' => $verify['message'],
            ];
        }
        echo json_encode($response);
    }

    public function logout()
    {
        $id_users   = $this->session->userdata('id_users');

        $logout     = $this->Auth->logout($id_users);

        if ($logout) {
            $this->session->sess_destroy();
            redirect('auth/login');
        }
    }
}

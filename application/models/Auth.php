<?php

class Auth extends CI_Model
{
    public $username;
    public $password;
    public $id_users;
    public $old_password;
    public $new_password;

    public function login()
    {
        $this->username = htmlspecialchars($this->input->post('username'), TRUE);
        $this->password = htmlspecialchars($this->input->post('password'), TRUE);

        $check_login    = $this->check_login($this->username);

        if ($check_login) {
            if (password_verify($this->password, $check_login['password'])) {
                if ($check_login['is_active'] == 1) {

                    $session_data = [
                        'username'      => $check_login['username'],
                        'id_users'      => $check_login['id_users'],
                        'id_role'       => $check_login['id_role'],
                    ];
                    $this->session->set_userdata($session_data);

                    if ($check_login['id_role'] == 1) {
                        return [
                            'success'   => true,
                            'message'   => 'Login Successfully as Administrator',
                            'id_role'   => 1
                        ];
                    } elseif ($check_login['id_role'] == 2) {
                        return [
                            'success'   => true,
                            'message'   => 'Login Successfully as Maintenance Admin',
                            'id_role'   => 2
                        ];
                    } elseif ($check_login['id_role'] == 3) {
                        return [
                            'success'   => true,
                            'message'   => 'Login Successfully as User',
                            'id_role'   => 3
                        ];
                    }
                } else {
                    return [
                        'success'   => false,
                        'message'   => 'Account Not Active'
                    ];
                }
            } else {
                return [
                    'success'   => false,
                    'message'   => 'username Or Password Is Wrong'
                ];
            }
        } else {
            return [
                'success'   => false,
                'message'   => 'username Not Found'
            ];
        }
    }

    public function check_login($username)
    {
        $query = $this->db->get_where('tbl_users', ['username' => $username]);
        return $query->row_array();
    }

    public function check_password($id_users)
    {
        $this->db->where('id_users', $id_users);
        $query = $this->db->get('tbl_users');

        if ($query) {
            return $query->row_array();
        }
    }

    public function change_password($id_users, $old_password, $new_password)
    {
    
        $this->id_users     = $id_users;
        $this->old_password = $old_password;
        $this->new_password = $new_password;

        $check_password     = $this->check_password($id_users);

        $data = [
            'password'  => $this->new_password
        ];

        if (password_verify($this->old_password, $check_password['password'])) {
            $query = $this->db->update('tbl_users', $data, ['id_users' => $this->id_users]);
            if ($query) {
                return [
                    'success'   => true,
                    'message'   => 'Password changed successfully'
                ];
            }
        } else {
            return [
                'success'   => false,
                'message'   => 'Password Tidak Sesuai'
            ];
        }
    }

    public function logout($id_users)
    {
        $this->id_users = $id_users;

        date_default_timezone_set('Asia/Jakarta');
        $current_datetime = date('Y-m-d H:i:s');

        $data = [
            'last_login'    => $current_datetime
        ];
        $query = $this->db->update('tbl_users', $data, ['id_users' => $id_users]);
        if ($query) {
            return true;
        }
    }
}

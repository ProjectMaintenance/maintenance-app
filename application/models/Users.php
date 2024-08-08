<?php

class Users extends CI_Model
{
    public $id_users;
    public $name;
    public $username;
    public $id_role;
    public $role;
    public $password;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Area');
        $this->load->model('Auth');
        $this->load->model('Category');
        $this->load->model('Line');
        $this->load->model('Location');
        $this->load->model('Machine');
        $this->load->model('Material');
        $this->load->model('Transaction');
        $this->load->model('Uom');
        $this->load->model('Users');
        $this->load->model('Req_order');
    }
    public function count_users()
    {
        $this->db->where('id_role !=', 1);
        $count = $this->db->count_all_results('tbl_users');
        return $count;
    }

    public function get_count_transaction()
    {
        return $this->Transaction->count_transaction();
    }

    public function get_all_users()
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_role', 'tbl_users.id_role = tbl_role.id_role', 'left');
        $this->db->where("(tbl_users.id_role = 0 OR tbl_users.id_role = 2 OR tbl_users.id_role = 3)"); // Menggunakan tanda kurung dan OR
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_role()
    {
        $query = $this->db->get('tbl_role');
        return $query->result();
    }

    public function check_username($username, $original_username, $id_users)
    {
        // Jika kode baris tidak berubah, tidak perlu memeriksa keberadaannya di data lain
        if ($username === $original_username) {
            return false;
        }

        // Memeriksa apakah kode baris sudah ada dalam data lain (kecuali data yang sedang diedit)
        $this->db->where('username', $username);
        $this->db->where('id_users !=', $id_users);
        $query = $this->db->get('tbl_users');
        return $query->num_rows() > 0;
    }

    public function save_data_users()
    {
        // Mengatur zona waktu ke Waktu Indonesia Barat (WIB)
        date_default_timezone_set('Asia/Jakarta');

        // Mendapatkan datetime saat ini di zona waktu Jakarta
        $current_datetime = date('Y-m-d H:i:s');

        $this->name     = htmlspecialchars($this->input->post('name'), TRUE);
        $this->username = htmlspecialchars($this->input->post('username'), TRUE);
        $this->role     = $this->input->post('role');
        $this->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $data = [
            'id_users'      => uniqid(),
            'name'          => $this->name,
            'username'      => $this->username,
            'password'      => $this->password,
            'id_role'       => $this->role,
            'is_active'     => 1,
            'date_created'  => $current_datetime,
            'last_login'     => $current_datetime
        ];

        $query = $this->db->insert('tbl_users', $data);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Registration Success'
            ];
        }
    }

    public function update_data_users($id_users)
    {
        $this->id_users = htmlspecialchars($id_users, TRUE);
        $this->name     = htmlspecialchars($this->input->post('name'), TRUE);
        $this->username = htmlspecialchars($this->input->post('username'), TRUE);
        $this->id_role  = htmlspecialchars($this->input->post('id_role'), TRUE);

        $data = [
            'name'          => $this->name,
            'username'      => $this->username,
            'id_role'       => $this->id_role
        ];

        $query = $this->db->update('tbl_users', $data, ['id_users' => $id_users]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Update Data Users Successfully'
            ];
        }
    }

    public function delete_users($id_users)
    {
        $this->id_users = $id_users;

        $query = $this->db->delete('tbl_users', ['id_users' => $this->id_users]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete'
            ];
        }
    }

    public function reset_password_users($id_users)
    {
        $this->id_users     = $id_users;
        $defult_password    = '1234567890';
        $data = [
            'password'  => password_hash($defult_password, PASSWORD_DEFAULT)
        ];

        $query = $this->db->update('tbl_users', $data, ['id_users' => $this->id_users]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Password has been reset'
            ];
        }
    }

    //---------------------------------------------------------------------------------------------------\\





    //------------------------------------- Area -------------------------------------\\
    public function get_all_area()
    {
        return $this->Area->get_all_area();
    }

    public function check_code_area($code_area, $original_code_area, $id_area)
    {
        return $this->Area->check_code_area($code_area, $original_code_area, $id_area);
    }

    public function save_area()
    {
        return $this->Area->save_area();
    }

    public function update_area($id_area)
    {
        return $this->Area->update_area($id_area);
    }

    public function delete_area($id_area)
    {
        return $this->Area->delete_area($id_area);
    }
    //------------------------------------- Category -------------------------------------\\
    public function get_all_category()
    {
        return $this->Category->get_all_category();
    }
    public function check_code_category($code_category, $original_code_category, $id_category)
    {
        return $this->Category->check_code_category($code_category, $original_code_category, $id_category);
    }

    public function save_category()
    {
        return $this->Category->save_category();
    }

    public function update_category()
    {
        $id_category = $this->input->post('id_category');
        return $this->Category->update_category($id_category);
    }

    public function delete_category()
    {
        $id_category = $this->input->post('id_category');
        return $this->Category->delete_category($id_category);
    }

    public function check_code_category_upload($code_category)
    {
        return $this->Category->check_code_category_upload($code_category);
    }

    public function upload_category($data)
    {
        return $this->Category->upload_excel($data);
    }

    //------------------------------------- Line -------------------------------------\\
    public function get_all_line()
    {
        return $this->Line->get_all_line();
    }

    public function get_line_by_area($code_area)
    {
        return $this->Line->get_line_by_area($code_area);
    }

    public function check_code_line($code_line, $original_code_line, $id_line)
    {
        return $this->Line->check_code_line($code_line, $original_code_line, $id_line);
    }

    public function save_line()
    {
        return $this->Line->save_line();
    }
    public function update_line($id_line)
    {
        return $this->Line->update_line($id_line);
    }

    public function delete_line($id_line)
    {
        return $this->Line->delete_line($id_line);
    }

    //------------------------------------- Location -------------------------------------\\
    public function get_all_location()
    {
        return $this->Location->get_all_location();
    }

    public function check_code_location($code_location, $original_code_location, $id_location)
    {
        return $this->Location->check_code_location($code_location, $original_code_location, $id_location);
    }

    public function save_location()
    {
        return $this->Location->save_location();
    }

    public function update_location($id_location)
    {
        return $this->Location->update_location($id_location);
    }

    public function delete_location($id_location)
    {
        return $this->Location->delete_location($id_location);
    }

    public function check_code_location_upload($code_location)
    {
        return $this->Location->check_code_location_upload($code_location);
    }

    public function upload_location($data)
    {
        return $this->Location->upload_excel($data);
    }


    //------------------------------------- Login / Logout -------------------------------------\\
    public function check_login($session)
    {
        return $this->Auth->check_login($session);
    }

    //------------------------------------- Machine -------------------------------------\\
    public function get_all_machine()
    {
        return $this->Machine->get_all_machine();
    }
    public function get_machine_by_line()
    {
        $code_line = $this->input->get('code_line');
        return $this->Machine->get_machine_by_line($code_line);
    }

    public function check_code_machine($code_machine, $original_code_machine, $id_machine)
    {
        return $this->Machine->check_code_machine($code_machine, $original_code_machine, $id_machine);
    }

    public function save_machine()
    {
        return $this->Machine->save_machine();
    }

    public function get_data_machine_by_id($id_machine)
    {
        return $this->Machine->get_data_machine_by_id($id_machine);
    }

    public function update_machine($id_machine)
    {
        return $this->Machine->update_machine($id_machine);
    }

    public function save_update_machine()
    {
        $id_machine = $this->input->post('id_machine');
        return $this->Machine->update_machine($id_machine);
    }

    public function delete_machine($id_machine)
    {
        return $this->Machine->delete_machine($id_machine);
    }

    public function check_code_line_code_machine($code_line, $code_machine)
    {
        return $this->Machine->check_code_line_code_machine($code_line, $code_machine);
    }

    public function upload_machine($data)
    {
        return $this->Machine->upload_excel($data);
    }

    //------------------------------------- Material -------------------------------------\\
    public function get_count_material()
    {
        return $this->Material->count_material_list();
    }

    public function get_material_by_code_material()
    {
        $code_material = $this->input->post('code_material');
        return $this->Material->get_material_by_code_material($code_material);
    }

    public function get_all_material()
    {
        return $this->Material->get_all_material();
    }

    public function generate_material_code()
    {
        $code_category = $this->input->post('code_category');
        return $this->Material->generate_material_code($code_category);
    }

    public function save_material()
    {
        return $this->Material->save_material();
    }
    public function save_update_material()
    {
        $id_material = $this->input->post('id_material');
        return $this->Material->save_update_material($id_material);
    }

    public function delete_material()
    {
        $code_material  = $this->input->post('code_material');
        return $this->Material->delete_material($code_material);
    }

    public function get_data_material_by_id($id_material)
    {
        return $this->Material->get_data_material_by_id($id_material);
    }

    public function get_code_category($part_name)
    {
        return $this->Material->get_code_category($part_name);
    }

    public function generate_material_code_upload($code_category)
    {
        return $this->Material->generate_material_code($code_category);
    }

    public function check_specification_material($specification_material)
    {
        return $this->Material->check_specification_material($specification_material);
    }

    public function check_code_material($code_material)
    {
        return $this->Material->check_code_material($code_material);
    }
    public function upload_material($data)
    {
        return $this->Material->upload_excel($data);
    }

    public function get_data_by_code_material($code_material)
    {
        return $this->Material->get_data_by_code_material($code_material);
    }

    //------------------------------------- Transaction -------------------------------------\\
    //------------------------------------- Goods Receive
    public function get_count_goods_receive()
    {
        return $this->Transaction->count_goods_receive();
    }

    public function get_all_goods_receive()
    {
        return $this->Transaction->get_all_good_receive();
    }

    public function save_goods_receive()
    {
        return $this->Transaction->save_good_receive();
    }

    public function update_goods_receive()
    {
        return $this->Transaction->update_goods_receive();
    }

    //------------------------------------- Goods Issue
    public function get_count_goods_issue()
    {
        return $this->Transaction->count_goods_issue();
    }
    public function get_all_goods_issue()
    {
        return $this->Transaction->get_all_good_issue();
    }

    public function save_goods_issue()
    {
        return $this->Transaction->save_good_issue();
    }

    public function update_goods_issue()
    {
        return $this->Transaction->update_goods_issue();
    }

    public function delete_transaction()
    {
        return $this->Transaction->delete_transaction();
    }

    public function get_transaction_detail()
    {
        return $this->Transaction->get_transaction_detail();
    }

    public function get_filtered_data($start_date, $end_date)
    {
        return $this->Transaction->get_filtered_data($start_date, $end_date);
    }

    //------------------------------------- Uom -------------------------------------\\
    public function get_all_uom()
    {
        return $this->Uom->get_all_uom();
    }

    public function check_code_uom($code_uom, $original_code_uom, $id_uom)
    {
        return $this->Uom->check_code_uom($code_uom, $original_code_uom, $id_uom);
    }

    public function save_uom()
    {
        return $this->Uom->save_uom();
    }

    public function update_uom($id_uom)
    {
        return $this->Uom->update_uom($id_uom);
    }

    public function delete_uom($id_uom)
    {
        return $this->Uom->delete_uom($id_uom);
    }

    //------------------------------------- Request Order -------------------------------------\\

    public function get_count_req_order()
    {
        return $this->Req_order->get_count_req_order();
    }

    public function get_count_status_ppbj_on_progress()
    {
        return $this->Req_order->get_count_status_ppbj_on_progress();
    }

    public function get_count_status_ppbj_delay()
    {
        return $this->Req_order->get_count_status_ppbj_delay();
    }

    public function get_count_status_ppbj_done()
    {
        return $this->Req_order->get_count_status_ppbj_done();
    }

    public function get_count_status_ppbj_cancel()
    {
        return $this->Req_order->get_count_status_ppbj_cancel();
    }

    public function get_count_status_sr_on_progress()
    {
        return $this->Req_order->get_count_status_sr_on_progress();
    }

    public function get_count_status_sr_delay()
    {
        return $this->Req_order->get_count_status_sr_delay();
    }

    public function get_count_status_sr_done()
    {
        return $this->Req_order->get_count_status_sr_done();
    }

    public function get_count_status_sr_cancel()
    {
        return $this->Req_order->get_count_status_sr_cancel();
    }

    public function get_count_status_pr_on_progress()
    {
        return $this->Req_order->get_count_status_pr_on_progress();
    }

    public function get_count_status_pr_delay()
    {
        return $this->Req_order->get_count_status_pr_delay();
    }

    public function get_count_status_pr_done()
    {
        return $this->Req_order->get_count_status_pr_done();
    }

    public function get_count_status_pr_cancel()
    {
        return $this->Req_order->get_count_status_pr_cancel();
    }

    public function get_count_status_po_on_progress()
    {
        return $this->Req_order->get_count_status_po_on_progress();
    }

    public function get_count_status_po_delay()
    {
        return $this->Req_order->get_count_status_po_delay();
    }

    public function get_count_status_po_done()
    {
        return $this->Req_order->get_count_status_po_done();
    }

    public function get_count_status_po_cancel()
    {
        return $this->Req_order->get_count_status_po_cancel();
    }

    public function get_count_jugdment_on_progress()
    {
        return $this->Req_order->get_count_jugdment_on_progress();
    }

    public function get_count_jugdment_delay()
    {
        return $this->Req_order->get_count_jugdment_delay();
    }

    public function get_count_jugdment_received()
    {
        return $this->Req_order->get_count_jugdment_received();
    }

    public function get_count_jugdment_cancel()
    {
        return $this->Req_order->get_count_jugdment_cancel();
    }

    public function get_count_jugdment_process_delivery_material()
    {
        return $this->Req_order->get_count_jugdment_process_delivery_material();
    }

    public function get_all_req_order()
    {
        return $this->Req_order->get_all_req_order();
    }
    
    public function create_no_ppbj($department_code)
    {
        return $this->Req_order->create_no_ppbj($department_code);
    }

    public function check_register_no($register_no, $original_register_no, $regist_no)
    {
        return $this->Req_order->check_register_no($register_no, $original_register_no, $regist_no);
    }

    public function save_req_order()
    {
        return $this->Req_order->save_req_order();
    }

    public function print_req_order_by_regist_no($regist_no)
    {
        return $this->Req_order->get_print_req_order_by_regist_no($regist_no);
    }

    public function get_print_req_order_by_regist_no($regist_no)
    {
        return $this->Req_order->get_req_order_by_regist_no_print($regist_no);
    }
    

    //------------------------------------- Users -------------------------------------\\
    public function get_count_users()
    {
        return $this->Users->count_users();
    }

    public function change_password()
    {
        $id_users       = $this->session->userdata('id_users');
        $old_password   = $this->input->post('old_password');
        $new_password   = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);

        return $this->Auth->change_password($id_users, $old_password, $new_password);
    }
}

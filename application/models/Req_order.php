<?php

class Req_order extends CI_Model
{
    public $id_req_order;
    public $register_no;
    public $date;
    public $department;
    public $category_item;
    public $reason;
    public $type_of_payment;
    public $order_type;
    public $code_material;
    public $qty;
    public $uom;
    public $eta;
    public $category_req;
    public $remark;
    public $date_created;
    public $date_required;
    public $klasifikasi_order;
    public $user;
    public $note;
    public $no_ppbj;
    public $status_ppbj;
    public $no_sr;
    public $status_sr;
    public $no_pr;
    public $status_pr;
    public $no_po;
    public $status_po;
    public $jugdment;
    public $regist_no;

    public function get_count_req_order()
    {
        $query = $this->db->count_all('tbl_req_order');
        return $query;
    }

    //count Status PPBJ
    public function get_count_status_ppbj_on_progress()
    {
        $this->db->where('status_ppbj', 'ON PROGRESS');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }


    public function get_count_status_ppbj_delay()
    {
        $this->db->where('status_ppbj', 'DELAY');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_ppbj_done()
    {
        $this->db->where('status_ppbj', 'DONE');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_ppbj_cancel()
    {
        $this->db->where('status_ppbj', 'CANCEL');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    //count Status SR
    public function get_count_status_sr_on_progress()
    {
        $this->db->where('status_sr', 'ON PROGRESS');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_sr_delay()
    {
        $this->db->where('status_sr', 'DELAY');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_sr_done()
    {
        $this->db->where('status_sr', 'DONE');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_sr_cancel()
    {
        $this->db->where('status_sr', 'CANCEL');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    //count Status PR
    public function get_count_status_pr_on_progress()
    {
        $this->db->where('status_pr', 'ON PROGRESS');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_pr_delay()
    {
        $this->db->where('status_pr', 'DELAY');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_pr_done()
    {
        $this->db->where('status_pr', 'DONE');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_pr_cancel()
    {
        $this->db->where('status_pr', 'CANCEL');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    //count Status PO
    public function get_count_status_po_on_progress()
    {
        $this->db->where('status_po', 'ON PROGRESS');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_po_delay()
    {
        $this->db->where('status_po', 'DELAY');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_po_done()
    {
        $this->db->where('status_po', 'DONE');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_status_po_cancel()
    {
        $this->db->where('status_po', 'CANCEL');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    //count Status Jugdment Atau Overall Status
    public function get_count_jugdment_on_progress()
    {
        $this->db->where('jugdment', 'ON PROGRESS');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_jugdment_delay()
    {
        $this->db->where('jugdment', 'DELAY');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_jugdment_received()
    {
        $this->db->where('jugdment', 'RECEIVED');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_count_jugdment_cancel()
    {
        $this->db->where('jugdment', 'CANCEL');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }
    public function get_count_jugdment_process_delivery_material()
    {
        $this->db->where('jugdment', 'PROCESS DELIVERY MATERIAL');
        $this->db->from('tbl_req_order');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_req_order_by_regist_no($regist_no)
    {
        $this->db->where('regist_no', $regist_no);
        $query = $this->db->get('tbl_req_order');
        return $query->result();
    }

    public function get_all_req_order()
    {
        $this->db->select('*');
        $this->db->from('tbl_req_order');
        // $this->db->join('tbl_material', 'tbl_req_order.code_material = tbl_material.code_material', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_req_order_by_regist_no_print($regist_no)
    {
        $this->db->where('regist_no', $regist_no);
        $query = $this->db->get('tbl_req_order');
        return $query->result();
    }

    public function get_print_req_order_by_regist_no($regist_no)
    {
        $this->db->where('regist_no', $regist_no);
        $query = $this->db->get('tbl_req_order');
        return $query->row();
    }

    public function get_data_req_order_by_regist_no($regist_no)
    {
        $this->db->select('*');
        $this->db->from('tbl_req_order');
        $this->db->join('tbl_material', 'tbl_req_order.code_material = tbl_material.code_material', 'left');
        $this->db->where('tbl_req_order.regist_no', $regist_no);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_list_select_material_req_order_by_regist_no($regist_no)
    {
        $this->db->select('*');
        $this->db->from('tbl_req_order');
        $this->db->join('tbl_material', 'tbl_req_order.code_material = tbl_material.code_material', 'left');
        $this->db->where('tbl_req_order.regist_no', $regist_no);
        $query = $this->db->get();

        return $query->result();
    }


    public function get_data_req_order_by_id($id_req_order)
    {
        $this->db->select('*');
        $this->db->from('tbl_req_order');
        $this->db->where('tbl_req_order.id_req_order', $id_req_order);
        $this->db->join('tbl_material', 'tbl_req_order.code_material = tbl_material.code_material', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Mengembalikan array dari objek jika data ditemukan
        } else {
            return []; // Mengembalikan array kosong jika tidak ada data yang ditemukan
        }
    }

    public function save_req_order()
    {
        date_default_timezone_set('Asia/Jakarta');
        $formattedDate = date('Y-m-d H:i:s');

        $this->id_req_order         = uniqid();
        $this->code_material        = $this->input->post('code_material');
        $this->qty                  = $this->input->post('quantity');
        $this->date_created         = $formattedDate;
        $this->date_required        = $this->input->post('date_required');
        $this->klasifikasi_order    = $this->input->post('klasifikasi_order');
        $this->user                 = $this->input->post('user');
        $this->uom                  = $this->input->post('uom');
        $this->no_ppbj              = $this->input->post('no_ppbj');
        $this->status_ppbj          = $this->input->post('status_ppbj');
        $this->no_sr                = $this->input->post('no_sr');
        $this->status_sr            = $this->input->post('status_sr');
        $this->no_pr                = $this->input->post('no_pr');
        $this->status_pr            = $this->input->post('status_pr');
        $this->no_po                = $this->input->post('no_po');
        $this->status_po            = $this->input->post('status_po');
        $this->jugdment             = 'ON PROGRESS';

        // Menyiapkan data untuk disimpan
        $data = [
            'id_req_order'          => $this->id_req_order,
            'code_material'         => $this->code_material,
            'quantity'              => $this->qty,
            'date_created'          => $formattedDate,
            'date_required'         => $this->date_required,
            'klasifikasi_order'     => strtoupper($this->klasifikasi_order),
            'user'                  => strtoupper($this->user),
            'uom'                   => strtoupper($this->uom),
            'no_ppbj'               => $this->no_ppbj,
            'status_ppbj'           => $this->status_ppbj,
            'no_sr'                 => $this->no_sr,
            'status_sr'             => $this->status_sr,
            'no_pr'                 => $this->no_pr,
            'status_pr'             => $this->status_pr,
            'no_po'                 => $this->no_po,
            'status_po'             => $this->status_po,
            'jugdment'              => $this->jugdment,
        ];

        $query = $this->db->insert('tbl_req_order', $data);

        if ($query) {
            return [
                'success' => true,
                'message' => 'Request Order Successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Request Order Failed'
            ];
        }
    }

    public function save_update_req_order($id_req_order)
    {
        date_default_timezone_set('Asia/Jakarta');
        $formattedDate = date('Y-m-d H:i:s');
        $this->id_req_order         = $id_req_order;
        $this->code_material        = $this->input->post('code_material');
        $this->qty                  = $this->input->post('quantity');
        $this->date_created         = $formattedDate;
        $this->date_required        = $this->input->post('date_required');
        $this->klasifikasi_order    = $this->input->post('klasifikasi_order');
        $this->user                 = $this->input->post('user');
        $this->uom                  = $this->input->post('uom');
        $this->no_ppbj              = $this->input->post('no_ppbj');
        $this->status_ppbj          = $this->input->post('status_ppbj');
        $this->no_sr                = $this->input->post('no_sr');
        $this->status_sr            = $this->input->post('status_sr');
        $this->no_pr                = $this->input->post('no_pr');
        $this->status_pr            = $this->input->post('status_pr');
        $this->no_po                = $this->input->post('no_po');
        $this->status_po            = $this->input->post('status_po');
        $this->jugdment             = $this->input->post('jugdment');

        $data = [
            'id_req_order'          => $this->id_req_order,
            'code_material'         => $this->code_material,
            'quantity'              => $this->qty,
            'date_created'          => $formattedDate,
            'date_required'         => $this->date_required,
            'klasifikasi_order'     => $this->klasifikasi_order,
            'user'                  => $this->user,
            'uom'                   => $this->uom,
            'no_ppbj'               => $this->no_ppbj,
            'status_ppbj'           => $this->status_ppbj,
            'no_sr'                 => $this->no_sr,
            'status_sr'             => $this->status_sr,
            'no_pr'                 => $this->no_pr,
            'status_pr'             => $this->status_pr,
            'no_po'                 => $this->no_po,
            'status_po'             => $this->status_po,
            'jugdment'              => $this->jugdment,
        ];
        $query = $this->db->update('tbl_req_order', $data, ['id_req_order' => $this->id_req_order]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Update Success'
            ];
        }
    }


    public function delete_req_order($regist_no)
    {
        $this->db->where_in('regist_no', $regist_no);
        $query = $this->db->delete('tbl_req_order');

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete !'
            ];
        }
    }

    public function check_register_no($register_no, $original_register_no, $regist_no)
    {
        if ($register_no === $original_register_no) {
            return false;
        }

        $this->db->where('register_no', $register_no);
        $this->db->where('regist_no !=', $regist_no);
        $query = $this->db->get('tbl_req_order');
        return $query->num_rows() > 0;
    }


    public function create_no_ppbj($department_code)
    {
        // Mulai transaksi
        $this->db->trans_start();

        try {
            // Ambil tahun dan bulan saat ini
            $currentYear    = date('y'); // Ambil 2 digit tahun
            $currentMonth   = date('m'); // Ambil bulan 01 - 12

            // Tentukan tahun dan bulan untuk nomor PPBJ
            if ($currentMonth >= 4) {
                // Jika bulan saat ini adalah April atau setelahnya, gunakan tahun saat ini
                $year = $currentYear;
            } else {
                // Jika bulan saat ini sebelum Maret, gunakan tahun sebelumnya
                $year = $currentYear - 1;
            }

            // Reset nomor jika tanggal saat ini adalah 1 April
            $currentDate = date('d');
            if ($currentMonth == 4 && $currentDate == 1) {
                $lastNumber = 0;
            } else {
                // Menggunakan locking untuk mendapatkan nomor terakhir
                $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj LIKE ? FOR UPDATE', ["PPBJ/{$department_code}/{$year}%"]);

                // Tunggu sampai transaksi sebelumnya selesai
                while ($this->db->trans_status() === FALSE) {
                    // Tunggu 1 detik sebelum mencoba lagi
                    sleep(1);
                    $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj LIKE ? FOR UPDATE', ["PPBJ/{$department_code}/{$year}%"]);
                }

                // Query untuk mendapatkan nomor terakhir dengan locking
                $query = $this->db->query('SELECT MAX(CAST(SUBSTRING_INDEX(no_ppbj, "/", -1) AS UNSIGNED)) AS last_number FROM tbl_req_order WHERE no_ppbj LIKE ?', ["PPBJ/{$department_code}/{$year}%"]);

                $lastNumber = 0; // Nilai default jika tidak ada record
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $lastNumber = intval($row->last_number);
                }

                // Increment dan format nomor terakhir
                $currentNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

                // Konstruksi nomor PPBJ
                $ppbjNumber = "PPBJ/{$department_code}/{$year}{$currentMonth}/{$currentNumber}";
            }

            // Cek jika nomor PPBJ sudah ada
            $query = $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj = ?', [$ppbjNumber]);
            if ($query->num_rows() > 0) {
                // Jika nomor PPBJ sudah ada, maka increment nomor terakhir
                $lastNumber = $lastNumber + 1;
                $currentNumber = str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
                $ppbjNumber = "PPBJ/{$department_code}/{$year}{$currentMonth}/{$currentNumber}";
            }

            // Commit transaction
            $this->db->trans_complete();

            return $ppbjNumber;
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $this->db->trans_rollback();
            throw $e;
        }
    }


    // public function create_no_ppbj()
    // {
    //     // Mulai transaksi
    //     $this->db->trans_start();

    //     try {
    //         // Ambil tahun dan bulan saat ini
    //         $currentYear    = date('y'); // Ambil 4 digit tahun
    //         $currentMonth   = date('m'); // Ambil bulan 01 - 12
    //         $department     = $this->input->post('department');

    //         // Tentukan tahun dan bulan untuk nomor PPBJ
    //         if ($currentMonth >= 4) {
    //             // Jika bulan saat ini adalah April atau setelahnya, gunakan tahun saat ini
    //             $year = $currentYear;
    //         } else {
    //             // Jika bulan saat ini sebelum Maret, gunakan tahun sebelumnya
    //             $year = $currentYear - 1;
    //         }

    //         // Reset nomor jika tanggal saat ini adalah 1 April
    //         $currentDate = date('d');
    //         if ($currentMonth == 4 && $currentDate == 1) {
    //             $lastNumber = 0;
    //         } else {
    //             // Menggunakan locking untuk mendapatkan nomor terakhir
    //             $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj LIKE ? FOR UPDATE', ["PPBJ/MTN/{$year}%"]);

    //             // Tunggu sampai transaksi sebelumnya selesai
    //             while ($this->db->trans_status() === FALSE) {
    //                 // Tunggu 1 detik sebelum mencoba lagi
    //                 sleep(1);
    //                 $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj LIKE ? FOR UPDATE', ["PPBJ/MTN/{$year}%"]);
    //             }

    //             // Query untuk mendapatkan nomor terakhir dengan locking
    //             $query = $this->db->query('SELECT MAX(CAST(SUBSTRING_INDEX(no_ppbj, "/", -1) AS UNSIGNED)) AS last_number FROM tbl_req_order WHERE no_ppbj LIKE ?', ["PPBJ/MTN/{$year}%"]);

    //             $lastNumber = 0; // Nilai default jika tidak ada record
    //             if ($query->num_rows() > 0) {
    //                 $row = $query->row();
    //                 $lastNumber = intval($row->last_number);
    //             }

    //             // Increment dan format nomor terakhir
    //             $currentNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

    //             // Konstruksi nomor PPBJ
    //             $ppbjNumber = "PPBJ/MTN/{$year}{$currentMonth}/{$currentNumber}";
    //         }

    //         // Cek jika nomor PPBJ sudah ada
    //         $query = $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj = ?', [$ppbjNumber]);
    //         if ($query->num_rows() > 0) {
    //             // Jika nomor PPBJ sudah ada, maka increment nomor terakhir
    //             $lastNumber = $lastNumber + 1;
    //             $currentNumber = str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
    //             $ppbjNumber = "PPBJ/MTN/{$year}{$currentMonth}/{$currentNumber}";
    //         }

    //         // Commit transaction
    //         $this->db->trans_complete();

    //         return $ppbjNumber;
    //     } catch (Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         $this->db->trans_rollback();
    //         throw $e;
    //     }
    // }

    //------------------------------------------- PPBJ
    public function update_ppbj($regist_no)
    {
        // Ambil data input
        $this->no_ppbj      = $this->input->post('no_ppbj');
        $this->status_ppbj  = $this->input->post('status_ppbj');

        // Pastikan $this->no_ppbj tidak null sebelum menggunakannya dalam md5()
        if ($this->no_ppbj !== null) {
            // Generate new regist_no from no_ppbj
            $new_regist_no = md5($this->no_ppbj);
        } else {
            // Berikan nilai default jika $this->no_ppbj null
            $new_regist_no = md5('');
        }

        // Siapkan data untuk update
        $data = [
            'no_ppbj'       => $this->no_ppbj,
            'status_ppbj'   => $this->status_ppbj,
            'register_no'   => $this->no_ppbj,
            'regist_no'     => $new_regist_no
        ];

        // Lakukan update menggunakan old regist_no untuk menemukan record yang benar
        $this->db->where('regist_no', $regist_no);
        $query = $this->db->update('tbl_req_order', $data);

        // Kembalikan response yang sesuai berdasarkan keberhasilan update
        if ($query) {
            return [
                'success' => true,
                'message' => 'Data Updated Successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to Update Data'
            ];
        }
    }



    public function update_sr($id_req_order)
    {
        $this->id_req_order = $id_req_order;
        $this->no_sr        = $this->input->post('no_sr');
        $this->status_sr    = $this->input->post('status_sr');

        $this->db->where('id_req_order', $id_req_order);
        $data = [
            'no_sr'     => $this->no_sr,
            'status_sr' => $this->status_sr,
        ];

        $query = $this->db->update('tbl_req_order', $data);

        if ($query) {
            return [
                'success' => true,
                'message' => 'Data Updated Successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to Update Data'
            ];
        }
    }

    // Model untuk update_pr
    public function update_pr($id_req_order)
    {
        $this->id_req_order = $id_req_order;
        $this->no_pr        = $this->input->post('no_pr');
        $this->status_pr    = $this->input->post('status_pr');

        $this->db->where('id_req_order', $id_req_order);

        $data = [
            'no_pr'     => $this->no_pr,
            'status_pr' => $this->status_pr,
        ];

        $query = $this->db->update('tbl_req_order', $data);

        if ($query) {
            return [
                'success' => true,
                'message' => 'Data Updated Successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to Update Data'
            ];
        }
    }

    // Model untuk update_po
    public function update_po($id_req_order)
    {
        $this->id_req_order = $id_req_order;
        $this->no_po        = $this->input->post('no_po');
        $this->status_po    = $this->input->post('status_po');

        $this->db->where('id_req_order', $id_req_order);

        $data = [
            'no_po'     => $this->no_po,
            'status_po' => $this->status_po,
        ];

        $query = $this->db->update('tbl_req_order', $data);

        if ($query) {
            return [
                'success' => true,
                'message' => 'Data Updated Successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to Update Data'
            ];
        }
    }

    public function get_data_by_req_order($register_no)
    {
        $this->db->where('register_no', $register_no);
        $query = $this->db->get('tbl_req_order');
        return $query->result();
    }


    //------------------------------------------- Jugdment
    public function update_jugdment($id_req_order)
    {
        $this->id_req_order = $id_req_order;
        $this->jugdment     = $this->input->post('jugdment');

        $data = [
            'jugdment' => $this->jugdment,
        ];

        $query = $this->db->update('tbl_req_order', $data, ['id_req_order' => $this->id_req_order]);

        if ($query) {
            return [
                'success' => true,
                'message' => 'Data Updated Successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to Update Data'
            ];
        }
    }

    public function get_no_status($regist_no)
    {
        $this->db->where('regist_no', $regist_no);
        $query = $this->db->get('tbl_req_order');
        return $query->result();
    }
}
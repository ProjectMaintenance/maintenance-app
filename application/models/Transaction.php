<?php

class Transaction extends CI_Model
{
    public $id_transaction;
    public $transaction_type;
    public $date;
    public $code_material;
    public $qty;
    public $identity_pic;
    public $description;
    //------------------------------------- Goods Receive -------------------------------------\\

    public function count_goods_receive()
    {
        $this->db->where('transaction_type', 'GR');
        $count = $this->db->count_all_results('tbl_transaction');
        return $count;
    }

    public function get_all_good_receive()
    {
        $this->db->select('tbl_transaction.*, tbl_material.*');
        $this->db->from('tbl_transaction');
        $this->db->join('tbl_material', 'tbl_transaction.code_material = tbl_material.code_material', 'left');
        $this->db->where('tbl_transaction.transaction_type', 'GR');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_transaction()
    {
        $query = $this->db->count_all_results('tbl_transaction');
        return $query;
    }

    public function save_good_receive()
    {
        $this->id_transaction = $this->input->post('id_transaction');
        $this->transaction_type = 'GR';
        $this->date = $this->input->post('datetime');
        $formatted_datetime = date('Y-m-d H:i:s', strtotime($this->date));
        $this->code_material = $this->input->post('code_material');
        $this->qty = $this->input->post('quantity');
        $this->identity_pic = $this->input->post('identity_pic');
        $this->description = $this->input->post('description');
        $data = [
            'id_transaction'    => strtoupper($this->id_transaction),
            'transaction_type'  => strtoupper($this->transaction_type),
            'date'              => $formatted_datetime,
            'code_material'     => strtoupper($this->code_material),
            'quantity'          => $this->qty,
            'identity_pic'      => strtoupper($this->identity_pic),
            'description'       => strtoupper($this->description),
        ];


        // Menggunakan try-catch untuk menangkap kesalahan SQL
        try {
            $query = $this->db->insert('tbl_transaction', $data);
            if ($query) {
                return [
                    'success' => true,
                    'message' => 'Data Receive Success'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Failed to insert data'
                ];
            }
        } catch (Exception $e) {
            // Tangkap pesan kesalahan dari exception
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function update_goods_receive()
    {
        // Set zona waktu ke 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');

        // Ambil nilai input tanggal dari POST data
        $date_transaction = $this->input->post('date_transaction');

        // Jika tanggal transaksi diubah, perbarui waktu sesuai dengan waktu saat ini
        if ($this->input->post('date_transaction') != $this->input->post('old_date_transaction')) {
            // Perbarui nilai input waktu dengan waktu saat ini
            $current_time = date('H:i:s');
            $date_transaction .= ' ' . $current_time;
        }

        // Format ulang tanggal dan waktu
        $formatted_datetime = date('Y-m-d H:i:s', strtotime($date_transaction));

        // Tetapkan nilai ke properti objek
        $this->id_transaction   = $this->input->post('id_transaction');
        $this->transaction_type = 'GR';
        $this->date             = $formatted_datetime;
        $this->code_material    = $this->input->post('code_material');
        $this->qty              = $this->input->post('quantity');
        $this->identity_pic     = $this->input->post('identity_pic');
        $this->description      = $this->input->post('description');

        // Bentuk data untuk update
        $data = [
            'transaction_type'  => strtoupper($this->transaction_type),
            'date'              => $formatted_datetime,
            'code_material'     => strtoupper($this->code_material),
            'quantity'          => $this->qty,
            'identity_pic'      => strtoupper($this->identity_pic),
            'description'       => strtoupper($this->description),
        ];

        // Lakukan update di database
        $query = $this->db->update('tbl_transaction', $data, ['id_transaction' => $this->id_transaction]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Issue Success'
            ];
        } else {
            return [
                'success'   => false,
                'message'   => 'Failed to update data'
            ];
        }
    }



    //------------------------------------- Goods Issue -------------------------------------\\


    public function count_goods_issue()
    {
        $this->db->where('transaction_type', 'GI');
        $count = $this->db->count_all_results('tbl_transaction');
        return $count;
    }

    public function get_all_good_issue()
    {
        $this->db->select('tbl_transaction.*, tbl_material.*');
        $this->db->from('tbl_transaction');
        $this->db->join('tbl_material', 'tbl_transaction.code_material = tbl_material.code_material', 'left');
        $this->db->where('tbl_transaction.transaction_type', 'GI');
        $query = $this->db->get();
        return $query->result();
    }

    public function save_good_issue()
    {
        // Mengambil data dari input
        $id_transaction = strtoupper($this->input->post('id_transaction'));
        $date = $this->input->post('datetime');
        $formatted_datetime = date('Y-m-d H:i:s', strtotime($date));
        $code_material = strtoupper($this->input->post('code_material'));
        $qty_requested = $this->input->post('quantity');
        $identity_pic = strtoupper($this->input->post('identity_pic'));
        $description = strtoupper($this->input->post('description'));

        // Memeriksa stok barang yang tersedia
        $available_stock = $this->get_available_stock($code_material);

        // Memeriksa apakah permintaan melebihi stok yang tersedia
        if ($qty_requested > $available_stock) {
            return [
                'success' => false,
                'message' => 'Quantity requested exceeds existing stock'
            ];
        }

        // Menyiapkan data untuk disimpan
        $data = [
            'id_transaction'    => $id_transaction,
            'transaction_type'  => 'GI',
            'date'              => $formatted_datetime,
            'code_material'     => $code_material,
            'quantity'          => $qty_requested,
            'identity_pic'      => $identity_pic,
            'description'       => $description,
        ];

        // Menyisipkan data ke dalam tabel
        try {
            $query = $this->db->insert(
                'tbl_transaction',
                $data
            );
            if ($query) {
                return [
                    'success' => true,
                    'message' => 'Data Receive Success'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Failed to insert data'
                ];
            }
        } catch (Exception $e) {
            // Tangkap pesan kesalahan dari exception
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    // Fungsi untuk mendapatkan stok barang yang tersedia
    private function get_available_stock($code_material)
    {
        // Query ke tabel tbl_material untuk mendapatkan stok barang berdasarkan $code_material
        $this->db->select('qty_stock');
        $this->db->where('code_material', $code_material);
        $query = $this->db->get('tbl_material');

        // Memeriksa apakah ada hasil dari query
        if ($query->num_rows() > 0) {
            // Mengambil nilai stok dari hasil query
            $stock = $query->row()->qty_stock;
            return $stock;
        } else {
            // Jika tidak ada hasil, maka stok dianggap 0
            return 0;
        }
    }


    public function update_goods_issue()
    {
        // Set zona waktu ke 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');

        // Ambil nilai input tanggal dari POST data
        $date_transaction = $this->input->post('date_transaction');

        // Jika tanggal transaksi diubah, perbarui waktu sesuai dengan waktu saat ini
        if ($this->input->post('date_transaction') != $this->input->post('old_date_transaction')) {
            // Perbarui nilai input waktu dengan waktu saat ini
            $current_time = date('H:i:s');
            $date_transaction .= ' ' . $current_time;
        }

        // Format ulang tanggal dan waktu
        $formatted_datetime = date('Y-m-d H:i:s', strtotime($date_transaction));

        // Tetapkan nilai ke properti objek
        $this->id_transaction   = $this->input->post('id_transaction');
        $this->transaction_type = 'GI';
        $this->date             = $formatted_datetime;
        $this->code_material    = $this->input->post('code_material');
        $this->qty              = $this->input->post('quantity');
        $this->identity_pic     = $this->input->post('identity_pic');
        $this->description      = $this->input->post('description');

        // Bentuk data untuk update
        $data = [
            'transaction_type'  => strtoupper($this->transaction_type),
            'date'              => $formatted_datetime,
            'code_material'     => strtoupper($this->code_material),
            'quantity'          => $this->qty,
            'identity_pic'      => strtoupper($this->identity_pic),
            'description'       => strtoupper($this->description),
        ];

        // Lakukan update di database
        $query = $this->db->update('tbl_transaction', $data, ['id_transaction' => $this->id_transaction]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Issue Success'
            ];
        }
    }

    public function delete_transaction()
    {
        $this->id_transaction = $this->input->post('id_transaction');

        $query = $this->db->delete('tbl_transaction', ['id_transaction' => $this->id_transaction]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete !'
            ];
        }
    }

    public function get_transaction_detail()
    {
        $query = $this->db->get('tbl_transaction');
        return $query->result();
    }

    public function get_filtered_data($start_date, $end_date)
    {
        // Lakukan query ke database untuk mengambil data berdasarkan rentang tanggal
        $this->db->select('*');
        $this->db->from('tbl_transaction'); // Ganti 'your_table' dengan nama tabel yang sesuai
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $query = $this->db->get();

        // Kembalikan hasil query sebagai array objek
        return $query->result();
    }
}

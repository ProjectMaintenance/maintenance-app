<?php

class Transaction extends CI_Model
{
    public $id_transaction;
    public $transaction_type;
    public $date;
    public $code_material;
    public $code_area;
    public $code_line;
    public $code_machine;
    public $qty;
    public $identity_pic;
    public $other_identity_pic;
    public $price;
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
        date_default_timezone_set('Asia/Jakarta');
        $formattedDate = date('Y-m-d H:i:s');

        $this->id_transaction       = $this->input->post('id_transaction');
        $this->transaction_type     = 'GR';
        $this->date                 = $formattedDate;
        $this->code_material        = $this->input->post('code_material');
        $this->qty                  = $this->input->post('quantity');
        $this->identity_pic         = $this->input->post('identity_pic');
        $this->other_identity_pic   = $this->input->post('other_identity_pic');
        $price_input                = $this->input->post('price');
        $this->price = str_replace(['Rp ', '.', ','], ['', ''], $price_input);
        if (!empty($price_input)) {
            $this->price = str_replace(['Rp ', '.', ','], ['', ''], $price_input);
            if (!is_numeric($this->price)) {
                // Handle the error if the price is not numeric
                echo "Invalid price input.";
                return;
            }
        } else {
            // Handle the error if the price is empty
            echo "Price input is required.";
            return;
        }
        $this->description          = $this->input->post('description');
        if ($this->identity_pic     == "0") {
            $this->identity_pic     = $this->other_identity_pic;
        }

        $data = [
            'id_transaction'        => strtoupper($this->id_transaction),
            'transaction_type'      => strtoupper($this->transaction_type),
            'date'                  => $formattedDate,
            'code_material'         => strtoupper($this->code_material),
            'quantity'              => $this->qty,
            'identity_pic'          => strtoupper($this->identity_pic),
            'price'                 => $this->price,
            'description'           => strtoupper($this->description),
        ];


        // Menggunakan try-catch untuk menangkap kesalahan SQL
        try {
            $query = $this->db->insert('tbl_transaction', $data);
            if ($query) {
                return [
                    'success' => true,
                    'message' => 'Transaction Good Receive Successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Transaction Good Receive Failed'
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
        date_default_timezone_set('Asia/Jakarta');
        $formattedDate = date('Y-m-d H:i:s');

        $this->id_transaction       = $this->input->post('id_transaction');
        $this->transaction_type     = 'GR';
        $this->date                 = $formattedDate;
        $this->code_material        = $this->input->post('code_material');
        $this->qty                  = $this->input->post('quantity');
        $this->identity_pic         = $this->input->post('identity_pic');
        $this->other_identity_pic   = $this->input->post('other_identity_pic');
        $price_input = $this->input->post('price');
        $this->price = str_replace(['Rp ', '.', ','], ['', '', '.'], $price_input);
        if (!is_numeric($this->price)) {
            // Handle the error if the price is not numeric
            echo "Invalid price input.";
            return;
        }
        $this->description          = $this->input->post('description');

        if ($this->identity_pic     == "0") {
            $this->identity_pic     = $this->other_identity_pic;
        }

        $data = [
            'transaction_type'      => strtoupper($this->transaction_type),
            'date'                  => $this->date,
            'code_material'         => strtoupper($this->code_material),
            'quantity'              => $this->qty,
            'identity_pic'          => strtoupper($this->identity_pic),
            'price'                 => $this->price,
            'description'           => strtoupper($this->description),
        ];

        // Lakukan update di database
        $query = $this->db->update('tbl_transaction', $data, ['id_transaction' => $this->id_transaction]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Update Transaction Good Receive Successfully'
            ];
        } else {
            return [
                'success'   => false,
                'message'   => 'Update Transaction Good Receive Failed'
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
        $this->db->select('*');
        $this->db->from('tbl_transaction');
        $this->db->join('tbl_material', 'tbl_transaction.code_material = tbl_material.code_material', 'left');
        $this->db->join('tbl_area', 'tbl_transaction.code_area = tbl_area.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_transaction.code_line = tbl_line.code_line', 'left');
        $this->db->where('tbl_transaction.transaction_type', 'GI');
        $query = $this->db->get();
        return $query->result();
    }

    public function save_good_issue()
    {
        date_default_timezone_set('Asia/Jakarta');
        $formattedDate = date('Y-m-d H:i:s');

        $this->id_transaction       = $this->input->post('id_transaction');
        $this->transaction_type     = 'GI';
        $this->date                 = $formattedDate;
        $this->code_material        = $this->input->post('code_material');
        $this->code_area            = $this->input->post('area');
        $this->code_line            = $this->input->post('line');
        $this->code_machine         = $this->input->post('machine') ? implode(', ', $this->input->post('machine')) : ''; // Menggunakan implode untuk menyimpan array nilai machine
        $this->qty                  = $this->input->post('quantity');
        $this->identity_pic         = $this->input->post('identity_pic');
        $this->other_identity_pic   = $this->input->post('other_identity_pic');
        $this->description          = $this->input->post('description');

        if ($this->identity_pic     == "0") {
            $this->identity_pic     = $this->other_identity_pic;
        }

        // Memeriksa stok barang yang tersedia
        $available_stock    = $this->get_available_stock($this->code_material);

        // Memeriksa apakah permintaan melebihi stok yang tersedia
        if ($this->qty > $available_stock) {
            return [
                'success' => false,
                'message' => 'Quantity requested exceeds existing stock'
            ];
        }

        // Menyiapkan data untuk disimpan
        $data = [
            'id_transaction'        => strtoupper($this->id_transaction),
            'transaction_type'      => strtoupper($this->transaction_type),
            'date'                  => $formattedDate,
            'code_material'         => strtoupper($this->code_material),
            'code_area'             => $this->code_area,
            'code_line'             => $this->code_line,
            'name_machine'          => $this->code_machine,
            'quantity'              => $this->qty,
            'identity_pic'          => strtoupper($this->identity_pic),
            'description'           => strtoupper($this->description),
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
                    'message' => 'Transaction Good Issue Successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Transaction Good Issue Failed'
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
        date_default_timezone_set('Asia/Jakarta');
        $formattedDate = date('Y-m-d H:i:s');

        $this->id_transaction       = $this->input->post('id_transaction');
        $this->transaction_type     = 'GI';
        $this->date                 = $formattedDate;
        $this->code_material        = $this->input->post('code_material');
        $this->code_area            = $this->input->post('area');
        $this->code_line            = $this->input->post('line');
        $this->code_machine         = $this->input->post('machine') ? implode(', ', $this->input->post('machine')) : ''; // Menggunakan implode untuk menyimpan array nilai machine
        $this->qty                  = $this->input->post('quantity');
        $this->identity_pic         = $this->input->post('identity_pic');
        $this->other_identity_pic   = $this->input->post('other_identity_pic');
        $this->description          = $this->input->post('description');

        if ($this->identity_pic     == "0") {
            $this->identity_pic     = $this->other_identity_pic;
        }

        $data = [
            'transaction_type'  => strtoupper($this->transaction_type),
            'date'              => $this->date,
            'code_material'     => strtoupper($this->code_material),
            'code_area'         => $this->code_area,
            'code_line'         => $this->code_line,
            'name_machine'      => $this->code_machine,
            'quantity'          => $this->qty,
            'identity_pic'      => strtoupper($this->identity_pic),
            'description'       => strtoupper($this->description),
        ];

        // Lakukan update di database
        $query = $this->db->update('tbl_transaction', $data, ['id_transaction' => $this->id_transaction]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Update Transaction Good Issue Successfully'
            ];
        } else {
            return [
                'success'   => false,
                'message'   => 'Update Transaction Good Issue Failed'
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
        $this->db->select('*');
        $this->db->from('tbl_transaction');
        $this->db->join('tbl_material', 'tbl_material.code_material = tbl_transaction.code_material');
        $this->db->join('tbl_area', 'tbl_transaction.code_area = tbl_area.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_transaction.code_line = tbl_line.code_line', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data($start_date, $end_date)
    {
        // Konversi format tanggal jika perlu
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));

        // Lakukan query ke database untuk mengambil data berdasarkan rentang tanggal
        $this->db->select('*');
        $this->db->from('tbl_transaction'); // Ganti 'your_table' dengan nama tabel yang sesuai
        $this->db->where('DATE(date) >=', $start_date);
        $this->db->where('DATE(date) <=', $end_date);
        $this->db->join('tbl_material', 'tbl_material.code_material = tbl_transaction.code_material');
        $this->db->join('tbl_area', 'tbl_transaction.code_area = tbl_area.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_transaction.code_line = tbl_line.code_line', 'left');
        $query = $this->db->get();

        // Kembalikan hasil query sebagai array objek
        return $query->result();
    }
  
}

<?php

class Machine extends CI_Model
{
    public $id_machine;
    public $code_area;
    public $code_line;
    public $code_machine;
    public $name_machine;
    public function get_all_machine()
    {
        $this->db->select('tbl_machine.*, tbl_area.name_area, tbl_line.name_line');
        $this->db->from('tbl_machine');
        $this->db->join('tbl_area', 'tbl_machine.code_area = tbl_area.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_machine.code_line = tbl_line.code_line', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_machine_by_line($code_line)
    {
        $this->db->where('code_line', $code_line);
        $query = $this->db->get('tbl_machine');
        return $query->result();
    }

    public function check_code_machine($code_machine, $original_code_machine, $id_machine)
    {
        // Jika kode baris tidak berubah, tidak perlu memeriksa keberadaannya di data lain
        if ($code_machine === $original_code_machine) {
            return false;
        }

        // Memeriksa apakah kode baris sudah ada dalam data lain (kecuali data yang sedang diedit)
        $this->db->where('code_machine', $code_machine);
        $this->db->where('id_machine !=', $id_machine);
        $query = $this->db->get('tbl_machine');
        return $query->num_rows() > 0;
    }

    public function check_code_line_code_machine($code_line, $code_machine)
    {
        $this->db->where('code_line', $code_line);
        $this->db->where('code_machine', $code_machine);
        $query = $this->db->get('tbl_machine');
        return $query->num_rows() > 0;
    }

    public function save_machine()
    {
        $this->id_machine       = uniqid();
        $this->code_area        = strtoupper($this->input->post('area'));
        $this->code_line        = strtoupper($this->input->post('line'));
        $this->code_machine     = strtoupper(htmlspecialchars($this->input->post('code_machine')));
        $this->name_machine     = strtoupper(htmlspecialchars($this->input->post('name_machine')));
        $data = [
            'id_machine'        => $this->id_machine,
            'code_area'         => $this->code_area,
            'code_line'         => $this->code_line,
            'code_machine'      => $this->code_machine,
            'name_machine'      => $this->name_machine
        ];

        $query  = $this->db->insert('tbl_machine', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function get_data_machine_by_id($id_machine)
    {
        $this->db->select('*');
        $this->db->from('tbl_machine');
        $this->db->where('tbl_machine.id_machine', $id_machine);
        $this->db->join('tbl_area', 'tbl_machine.code_area = tbl_area.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_machine.code_line = tbl_line.code_line', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Mengembalikan array dari objek jika data ditemukan
        } else {
            return []; // Mengembalikan array kosong jika tidak ada data yang ditemukan
        }
    }

    public function update_machine($id_machine)
    {
        $this->id_machine       = $id_machine;
        $this->code_area        = strtoupper($this->input->post('code_area'));
        $this->code_line        = strtoupper($this->input->post('code_line'));
        $this->code_machine     = strtoupper(htmlspecialchars($this->input->post('code_machine')));
        $this->name_machine     = strtoupper(htmlspecialchars($this->input->post('name_machine')));

        $data = [
            'code_area'         => $this->code_area,
            'code_line'         => $this->code_line,
            'code_machine'      => $this->code_machine,
            'name_machine'      => $this->name_machine
        ];

        $query  = $this->db->update('tbl_machine', $data, ['id_machine' => $this->id_machine]);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Update successfully'
            ];
        }
    }

    public function delete_machine($id_machine)
    {
        $this->id_machine = $id_machine;

        $query = $this->db->delete('tbl_machine', ['id_machine' => $this->id_machine]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete'
            ];
        }
    }

    public function upload_excel($data)
    {
        $query = $this->db->insert('tbl_machine', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Machine data uploaded successfully'
            ];
        }
    }
}

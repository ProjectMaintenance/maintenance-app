<?php

class Line extends CI_Model
{
    public $id_line;
    public $code_area;
    public $code_line;
    public $name_line;
    
    public function get_all_line()
    {
        $this->db->select('*');
        $this->db->from('tbl_line');
        $this->db->join('tbl_area', 'tbl_area.code_area = tbl_line.code_area', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_line_by_area($code_area)
    {
        $this->db->where('code_area', $code_area);
        $query = $this->db->get('tbl_line');
        return $query->result();
    }

    public function check_code_line($code_line, $original_code_line, $id_line)
    {
        // Jika kode baris tidak berubah, tidak perlu memeriksa keberadaannya di data lain
        if ($code_line === $original_code_line) {
            return false;
        }

        // Memeriksa apakah kode baris sudah ada dalam data lain (kecuali data yang sedang diedit)
        $this->db->where('code_line', $code_line);
        $this->db->where('id_line !=', $id_line);
        $query = $this->db->get('tbl_line');
        return $query->num_rows() > 0;
    }



    public function save_line()
    {
        $this->id_line      = uniqid();
        $this->code_area    = strtoupper($this->input->post('area'));
        $this->code_line    = strtoupper(htmlspecialchars($this->input->post('code_line')));
        $this->name_line    = strtoupper(htmlspecialchars($this->input->post('name_line')));

        $data = [
            'id_line'       => $this->id_line,
            'code_area'     => $this->code_area,
            'code_line'     => $this->code_line,
            'name_line'     => $this->name_line
        ];

        $query  = $this->db->insert('tbl_line', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function update_line($id_line)
    {
        $this->id_line      = $id_line;
        $this->code_area    = strtoupper($this->input->post('code_area'));
        $this->code_line    = strtoupper(htmlspecialchars($this->input->post('code_line')));
        $this->name_line    = strtoupper(htmlspecialchars($this->input->post('name_line')));

        $data = [
            'code_area'     => $this->code_area,
            'code_line'     => $this->code_line,
            'name_line'     => $this->name_line
        ];

        $query  = $this->db->update('tbl_line', $data, ['id_line' => $this->id_line]);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function delete_line($id_line)
    {
        $this->id_line = $id_line;

        $query = $this->db->delete('tbl_line', ['id_line' => $this->id_line]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete'
            ];
        }
    }
}

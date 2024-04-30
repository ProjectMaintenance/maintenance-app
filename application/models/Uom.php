<?php

class Uom extends CI_Model
{
        public $id_uom;
        public $code_uom;
        public $name_uom;
    public function get_all_uom()
    {
        $query = $this->db->get('tbl_uom');
        return $query->result();
    }

    public function check_code_uom($code_uom, $original_code_uom, $id_uom)
    {
        // Jika kode baris tidak berubah, tidak perlu memeriksa keberadaannya di data lain
        if ($code_uom === $original_code_uom) {
            return false;
        }

        // Memeriksa apakah kode baris sudah ada dalam data lain (kecuali data yang sedang diedit)
        $this->db->where('code_uom', $code_uom);
        $this->db->where('id_uom !=', $id_uom);
        $query = $this->db->get('tbl_uom');
        return $query->num_rows() > 0;
    }

    public function save_uom()
    {
        $this->id_uom      = uniqid();
        $this->code_uom    = strtoupper(htmlspecialchars($this->input->post('code_uom'), TRUE));
        $this->name_uom    = strtoupper(htmlspecialchars($this->input->post('name_uom'), TRUE));
        $data = [
            'id_uom'   => $this->id_uom,
            'code_uom' => strtoupper($this->code_uom),
            'name_uom' => strtoupper($this->name_uom)
        ];

        $query  = $this->db->insert('tbl_uom', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function update_uom($id_uom)
    {
        $this->id_uom      = $id_uom;
        $this->code_uom    = strtoupper(htmlspecialchars($this->input->post('code_uom')));
        $this->name_uom    = strtoupper(htmlspecialchars($this->input->post('name_uom')));

        $data = [
            'code_uom'     => $this->code_uom,
            'name_uom'     => $this->name_uom
        ];

        $query  = $this->db->update('tbl_uom', $data, ['id_uom' => $this->id_uom]);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function delete_uom($id_uom)
    {
        $this->id_uom = htmlspecialchars($id_uom, TRUE);

        $query = $this->db->delete('tbl_uom', ['id_uom' => $this->id_uom]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete'
            ];
        }
    }
}
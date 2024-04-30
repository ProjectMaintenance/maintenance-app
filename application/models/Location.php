<?php

class Location extends CI_Model
{
    public $code_location;
    public $id_location;
    public $name_location;
    public function get_all_location()
    {
        $query = $this->db->get('tbl_location');
        return $query->result();
    }

    public function check_code_location($code_location, $original_code_location, $id_location)
    {
        // Jika kode baris tidak berubah, tidak perlu memeriksa keberadaannya di data lain
        if ($code_location === $original_code_location) {
            return false;
        }

        // Memeriksa apakah kode baris sudah ada dalam data lain (kecuali data yang sedang diedit)
        $this->db->where('code_location', $code_location);
        $this->db->where('id_location !=', $id_location);
        $query = $this->db->get('tbl_location');
        return $query->num_rows() > 0;
    }

    public function check_code_location_upload($code_location)
    {
        $this->db->where('code_location', $code_location);
        $query = $this->db->get('tbl_location');
        return $query->num_rows() > 0;
    }

    public function save_location()
    {
        $this->id_location      = uniqid();
        $this->code_location    = strtoupper(htmlspecialchars($this->input->post('code_location'), TRUE));
        $this->name_location    = strtoupper(htmlspecialchars($this->input->post('name_location'), TRUE));

        $data = [
            'id_location'   => $this->id_location,
            'code_location' => strtoupper($this->code_location),
            'name_location' => strtoupper($this->name_location)
        ];

        $query  = $this->db->insert('tbl_location', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function update_location($id_location)
    {
        $this->id_location      = $id_location;
        $this->code_location    = strtoupper(htmlspecialchars($this->input->post('code_location')));
        $this->name_location    = strtoupper(htmlspecialchars($this->input->post('name_location')));

        $data = [
            'code_location'     => $this->code_location,
            'name_location'     => $this->name_location
        ];

        $query  = $this->db->update('tbl_location', $data, ['id_location' => $this->id_location]);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function delete_location($id_location)
    {
        $this->id_location = htmlspecialchars($id_location, TRUE);

        $query = $this->db->delete('tbl_location', ['id_location' => $this->id_location]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete'
            ];
        }
    }

    public function upload_excel($data)
    {
        $query = $this->db->insert('tbl_location', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Location data uploaded successfully'
            ];
        }
    }
}
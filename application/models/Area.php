<?php

class Area extends CI_Model
{
    public $code_area;
    public $original_code_Area;
    public $id_area;
    public $name_area;
    public function get_all_area()
    {
        $query = $this->db->get('tbl_area');
        return $query->result();
    }

    public function check_code_area($code_area, $original_code_area, $id_area)
    {
        if ($code_area === $original_code_area) {
            return false;
        }

        $this->db->where('code_area', $code_area);
        $this->db->where('id_area !=', $id_area);
        $query = $this->db->get('tbl_area');
        return $query->num_rows() > 0;
    }


    public function save_area()
    {
        $this->id_area      = uniqid();
        $this->code_area    = strtoupper(htmlspecialchars($this->input->post('code_area'), TRUE));
        $this->name_area    = strtoupper(htmlspecialchars($this->input->post('name_area'), TRUE));

        $data = [
            'id_area'   => $this->id_area,
            'code_area' => strtoupper($this->code_area),
            'name_area' => strtoupper($this->name_area)
        ];

        $query  = $this->db->insert('tbl_area', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function update_area($id_area)
    {
        $this->id_area      = $id_area;
        $this->code_area    = strtoupper(htmlspecialchars($this->input->post('code_area')));
        $this->name_area    = strtoupper(htmlspecialchars($this->input->post('name_area')));

        $data = [
            'code_area'     => $this->code_area,
            'name_area'     => $this->name_area
        ];

        $query  = $this->db->update('tbl_area', $data, ['id_area' => $this->id_area]);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data added successfully'
            ];
        }
    }

    public function delete_area($id_area)
    {
        $this->id_area = htmlspecialchars($id_area, TRUE);

        $query = $this->db->delete('tbl_area', ['id_area' => $this->id_area]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Success Delete'
            ];
        }
    }
}

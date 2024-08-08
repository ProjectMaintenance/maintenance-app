<?php

class Material extends CI_Model
{
    public $id_material;
    public $code_material;
    public $code_category;
    public $part_name;
    public $part_type;
    public $part_number_maker;
    public $part_code_machine;
    public $part_drawing;
    public $maker;
    public $additional_description;
    public $code_area;
    public $code_line;
    public $code_machine;
    public $spesification_material;
    public $life_time_part;
    public $qty_on_machine;
    public $qty_stock;
    public $uom;
    public $location;
    public $minimum_stock;
    public $maximal_stock;
    public $safety_stock;
    public $rop;
    public function count_material_list()
    {
        $query = $this->db->count_all('tbl_material');
        return $query;
    }

    public function get_all_material()
    {
        $this->db->select('*');
        $this->db->from('tbl_material');
        $this->db->join('tbl_category', 'tbl_category.code_category = tbl_material.code_category', 'left');
        $this->db->join('tbl_area', 'tbl_area.code_area = tbl_material.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_line.code_line = tbl_material.code_line', 'left');
        $this->db->join('tbl_uom', 'tbl_uom.code_uom = tbl_material.code_uom', 'left');
        $this->db->join('tbl_location', 'tbl_location.code_location = tbl_material.code_location', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_material_by_code_material($code_material)
    {
        $this->db->where('code_material', $code_material);
        $query = $this->db->get('tbl_material');
        return $query->row_array();
    }

    public function get_data_material_by_id($id_material)
    {
        $this->db->select('*');
        $this->db->from('tbl_material');
        $this->db->where('tbl_material.id_material', $id_material);
        $this->db->join('tbl_category', 'tbl_category.code_category = tbl_material.code_category', 'left');
        $this->db->join('tbl_area', 'tbl_area.code_area = tbl_material.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_line.code_line = tbl_material.code_line', 'left');
        $this->db->join('tbl_uom', 'tbl_uom.code_uom = tbl_material.code_uom', 'left');
        $this->db->join('tbl_location', 'tbl_location.code_location = tbl_material.code_location', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Mengembalikan array dari objek jika data ditemukan
        } else {
            return []; // Mengembalikan array kosong jika tidak ada data yang ditemukan
        }
    }

    public function generate_material_code($code_category, $count = null)
    {
        // Mengunci tabel untuk operasi membaca dan menulis (gunakan transaksi untuk alternatif yang lebih baik)
        $this->db->trans_start();

        if (is_null($count)) {
            // Menghitung jumlah kode yang ada berdasarkan kategori
            $this->db->select('COUNT(*) as count');
            $this->db->where('code_category', $code_category);
            $query = $this->db->get('tbl_material');
            $result = $query->row();

            // Menambah jumlah kode dengan 1
            $count = $result->count + 1;
        }

        // Menghasilkan kode material baru
        do {
            $material_code = 'MNV-' . substr($code_category, 0, 3) . '-' . str_pad($count, 6, '0', STR_PAD_LEFT);

            // Cek apakah kode material sudah ada
            $this->db->where('code_material', $material_code);
            $query = $this->db->get('tbl_material');
            $count++;
        } while ($query->num_rows() > 0);

        // Selesai transaksi
        $this->db->trans_complete();

        return $material_code;
    }


    public function save_material()
    {
        $this->id_material = uniqid();
        $this->code_category = $this->input->post('category');
        $this->code_material = $this->generate_material_code($this->code_category);
        $this->part_name = $this->input->post('part_name');
        $this->part_type = $this->input->post('part_type');
        $this->part_number_maker = $this->input->post('part_number_maker');
        $this->part_code_machine = $this->input->post('part_code_machine');
        $this->part_drawing = $this->input->post('part_drawing');
        $this->maker = $this->input->post('maker');
        $this->additional_description = $this->input->post('additional_description');
        $this->code_area = $this->input->post('area') ?: null;
        $this->code_line = $this->input->post('line') ?: null;
        $this->code_machine = $this->input->post('machine') ? implode(', ', $this->input->post('machine')) : '';
        $this->spesification_material = strtoupper(implode(', ', array_filter([$this->part_name, $this->part_type, $this->part_number_maker, $this->part_code_machine, $this->part_drawing, $this->maker, $this->additional_description])));
        $this->life_time_part = $this->input->post('life_time_part');
        $this->qty_on_machine = $this->input->post('quantity_on_machine');
        $this->qty_stock = $this->input->post('quantity_stock');
        $this->uom = $this->input->post('uom') ?: null;
        $this->location = $this->input->post('location') ?: null;
        $this->minimum_stock = $this->input->post('minimum_stock');
        $this->maximal_stock = $this->input->post('maximal_stock');
        $this->safety_stock = $this->input->post('safety_stock');
        $this->rop = $this->input->post('rop');

        // Mulai transaksi
        $this->db->trans_start();

        // Cek apakah code_material sudah ada
        $this->db->where('code_material', $this->code_material);
        $query = $this->db->get('tbl_material');

        if ($query->num_rows() > 0) {
            // Rollback transaksi jika code_material sudah ada
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Code Material ' . $this->code_material . ' Already Exists'
            ];
        }

        if ($this->check_specification_material($this->spesification_material)) {
            // Jika spesifikasi sudah ada, tampilkan pesan toastr
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Specification already exists, please check again.'
            ];
        } else {
            $data = [
                'id_material' => $this->id_material,
                'code_material' => $this->code_material,
                'code_category' => $this->code_category,
                'part_name' => $this->part_name,
                'part_type' => $this->part_type,
                'part_number_maker' => $this->part_number_maker,
                'part_code_machine' => $this->part_code_machine,
                'part_drawing' => $this->part_drawing,
                'maker' => $this->maker,
                'additional_description' => $this->additional_description,
                'code_area' => $this->code_area,
                'code_line' => $this->code_line,
                'code_machine' => $this->code_machine,
                'specification_material' => $this->spesification_material,
                'life_time_part' => $this->life_time_part,
                'qty_on_machine' => $this->qty_on_machine,
                'qty_stock' => $this->qty_stock,
                'code_uom' => $this->uom,
                'code_location' => $this->location,
                'minimum_stock' => $this->minimum_stock,
                'maximal_stock' => $this->maximal_stock,
                'safety_stock' => $this->safety_stock,
                'rop' => $this->rop
            ];

            // Insert data
            $query = $this->db->insert('tbl_material', $data);

            // Selesaikan transaksi
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return [
                    'success' => false,
                    'message' => 'Data material saved failed'
                ];
            } else {
                usleep(500000);
                return [
                    'success' => true,
                    'message' => 'Data material saved successfully <b>' . $this->code_material . '</b>',
                    'code_material' => $this->code_material
                ];
            }
        }
    }


    public function save_update_material($id_material)
    {
        $this->id_material              = $id_material;
        $this->code_material            = $this->input->post('code_material');
        $this->code_category            = $this->input->post('category');
        $this->part_name                = $this->input->post('part_name');
        $this->part_type                = $this->input->post('part_type');
        $this->part_number_maker        = $this->input->post('part_number_maker');
        $this->part_code_machine        = $this->input->post('part_code_machine');
        $this->part_drawing             = $this->input->post('part_drawing');
        $this->maker                    = $this->input->post('maker');
        $this->additional_description   = $this->input->post('additional_description');
        $this->additional_description   = $this->input->post('additional_description');
        $this->code_area                = $this->input->post('area') ?: null;
        $this->code_line                = $this->input->post('line') ?: null;
        $this->code_machine             = $this->input->post('name_machine');
        $this->spesification_material   = strtoupper(implode(', ', array_filter([$this->part_name, $this->part_type, $this->part_number_maker, $this->part_code_machine, $this->part_drawing, $this->maker, $this->additional_description])));
        $this->life_time_part           = $this->input->post('life_time_part');
        $this->qty_on_machine           = $this->input->post('quantity_on_machine');
        $this->qty_stock                = $this->input->post('quantity_stock');
        $this->uom                      = $this->input->post('code_uom');
        $this->location                 = $this->input->post('code_location');
        $this->minimum_stock            = $this->input->post('minimum_stock');
        $this->maximal_stock            = $this->input->post('maximal_stock');
        $this->safety_stock             = $this->input->post('safety_stock');
        $this->rop                      = $this->input->post('rop');



        // if ($this->check_specification_material($this->spesification_material)) {
        //     // Jika spesifikasi sudah ada, tampilkan pesan toastr
        //     return [
        //         'success'   => false,
        //         'message'   => 'Specification already exists, please check again.'
        //     ];
        // } else {
        $data = [
            'code_material'             => $this->code_material,
            'code_category'             => $this->code_category,
            'part_name'                 => $this->part_name,
            'part_type'                 => $this->part_type,
            'part_number_maker'         => $this->part_number_maker,
            'part_code_machine'         => $this->part_code_machine,
            'part_drawing'              => $this->part_drawing,
            'maker'                     => $this->maker,
            'additional_description'    => $this->additional_description,
            'code_area'                 => $this->code_area,
            'code_line'                 => $this->code_line,
            'code_machine'              => $this->code_machine,
            'specification_material'    => $this->spesification_material,
            'life_time_part'            => $this->life_time_part,
            'qty_on_machine'            => $this->qty_on_machine,
            'qty_stock'                 => $this->qty_stock,
            'code_uom'                  => $this->uom,
            'code_location'             => $this->location,
            'minimum_stock'             => $this->minimum_stock,
            'maximal_stock'             => $this->maximal_stock,
            'safety_stock'              => $this->safety_stock,
            'rop'                       => $this->rop

        ];

        $query = $this->db->update('tbl_material', $data, ['id_material' => $this->id_material]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Update Success'
            ];
        }
        // }
    }

    public function delete_material($code_material)
    {
        $this->code_material = $code_material;
        $query = $this->db->delete('tbl_material', ['code_material' => $this->code_material]);

        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Data Material Deleted Successfully'
            ];
        }
    }

    public function delete_material_batch($material_code)
    {
        if (empty($material_code)) {
            return [
                'success' => false,
                'message' => 'No material codes provided for deletion'
            ];
        }

        $this->db->where_in('code_material', $material_code);
        $query = $this->db->delete('tbl_material');

        if ($query) {
            return [
                'success' => true,
                'message' => count($material_code) . ' records deleted successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to delete records'
            ];
        }
    }




    public function check_specification_material($specification_material)
    {
        $this->db->where('specification_material', $specification_material);
        $query = $this->db->get('tbl_material');
        return $query->num_rows() > 0;
    }

    public function check_code_material($code_material)
    {
        $this->db->where('code_material', $code_material);
        $query = $this->db->get('tbl_material');
        return $query->num_rows() > 0;
    }

    public function get_code_category($part_name)
    {
        if ($part_name !== null) { // Check if $part_name is not null
            // Cari kategori yang sesuai dalam tabel alternatif
            $mapping = $this->db->get_where('tbl_category', array('name_category' => $part_name))->row();
            if ($mapping) {
                // Jika ada pemetaan langsung, gunakan ID kategori yang terkait
                return $mapping->id_kategory;
            } else {
                // Jika tidak, coba mencari kategori berdasarkan pencocokan parsial
                $categories = $this->db->get('tbl_category')->result();
                foreach ($categories as $category) {
                    // Jika kategori dalam database mengandung kategori dari file Excel
                    if (stripos($category->name_category, $part_name) !== false) {
                        return $category->code_category;
                    }
                }
                // Jika tidak ada yang cocok, kembalikan false
                return false;
            }
        } else {
            return false; // Return false if $part_name is null
        }
    }


    public function upload_excel($data)
    {
        $query = $this->db->insert('tbl_material', $data);
        if ($query) {
            return [
                'success'   => true,
                'message'   => 'Material data uploaded successfully'
            ];
        }
    }

    public function get_data_by_code_material($code_material)
    {
        // Pilih hanya kolom yang diperlukan
        $this->db->select('*');

        // Join dengan INNER JOIN jika memungkinkan
        $this->db->from('tbl_material');
        $this->db->join('tbl_category', 'tbl_category.code_category = tbl_material.code_category', 'left');
        $this->db->join('tbl_area', 'tbl_area.code_area = tbl_material.code_area', 'left');
        $this->db->join('tbl_line', 'tbl_line.code_line = tbl_material.code_line', 'left');
        $this->db->join('tbl_uom', 'tbl_uom.code_uom = tbl_material.code_uom', 'left');
        $this->db->join('tbl_location', 'tbl_location.code_location = tbl_material.code_location', 'left');
        // Ubah kondisi where menjadi where_in agar dapat menangani array material codes
        $this->db->where_in('code_material', $code_material);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}

<?php
require 'vendor/autoload.php';

class Users_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users');
    }

    public function get_csrf_token()
    {
        // Mengambil token CSRF yang baru
        $csrf_token = $this->security->get_csrf_hash();

        // Mengirimkan token CSRF dalam format JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['csrf_token' => $csrf_token]));
    }

    //------------------------------------- Dashboard -------------------------------------\\

    public function index()
    {
        redirect('users/dashboard');
    }

    public function dashboard()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab'             => 'users | Dashboard',
                'title_page'            => 'Dashboard',
                'bread_crumb'           => 'Dashboard',
                'title_card'            => 'APPLICATION WAREHOUSE MAINTENANCE SYSTEM',
                'session'               => $this->users->check_login($session),
                'id_users'              => $this->session->userdata('id_users'),
                'count_material'        => $this->users->get_count_material(),
                'count_goods_receive'   => $this->users->get_count_goods_receive(),
                'count_goods_issue'     => $this->users->get_count_goods_issue(),
                'count_transaction'     => $this->users->get_count_transaction(),
                'count_req_order'       => $this->users->get_count_req_order(),
                'count_status_ppbj_on_progress'             => $this->Users->get_count_status_ppbj_on_progress(),
                'count_status_ppbj_delay'                   => $this->Users->get_count_status_ppbj_delay(),
                'count_status_ppbj_done'                    => $this->Users->get_count_status_ppbj_done(),
                'count_status_ppbj_cancel'                  => $this->Users->get_count_status_ppbj_cancel(),
                'count_status_sr_on_progress'               => $this->Users->get_count_status_sr_on_progress(),
                'count_status_sr_delay'                     => $this->Users->get_count_status_sr_delay(),
                'count_status_sr_done'                      => $this->Users->get_count_status_sr_done(),
                'count_status_sr_cancel'                    => $this->Users->get_count_status_sr_cancel(),
                'count_status_pr_on_progress'               => $this->Users->get_count_status_pr_on_progress(),
                'count_status_pr_delay'                     => $this->Users->get_count_status_pr_delay(),
                'count_status_pr_done'                      => $this->Users->get_count_status_pr_done(),
                'count_status_pr_cancel'                    => $this->Users->get_count_status_pr_cancel(),
                'count_status_po_on_progress'               => $this->Users->get_count_status_po_on_progress(),
                'count_status_po_delay'                     => $this->Users->get_count_status_po_delay(),
                'count_status_po_done'                      => $this->Users->get_count_status_po_done(),
                'count_status_po_cancel'                    => $this->Users->get_count_status_po_cancel(),
                'count_jugdment_on_progress'                => $this->Users->get_count_jugdment_on_progress(),
                'count_jugdment_delay'                      => $this->Users->get_count_jugdment_delay(),
                'count_jugdment_received'                   => $this->Users->get_count_jugdment_received(),
                'count_jugdment_cancel'                     => $this->Users->get_count_jugdment_cancel(),
                'count_jugdment_process_delivery_material'  => $this->Users->get_count_jugdment_process_delivery_material(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/dashboard/v_dashboard');
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    //------------------------------------- Dashboard -------------------------------------\\



    //------------------------------------- Material -------------------------------------\\
    public function material_list()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab'     => 'users | Material List',
                'title_page'    => 'Material List',
                'bread_crumb'   => 'Material List',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'material'      => $this->users->get_all_material(),
            ];
            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/material/material_list/v_material_list', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    // public function generate_material_code()
    // {
    //     $material_code = $this->users->generate_material_code();
    //     echo json_encode(['material_code' => $material_code]);
    // }

    public function get_material_by_code_material()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $data = $this->users->get_material_by_code_material();
            echo json_encode($data);
        } else {
            redirect('auth/login');
        }
    }

    public function add_material_list()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'users | Add Material List',
                'title_page'    => 'Material List',
                'title_card'    => 'Form Add Material List',
                'bread_crumb'   => 'Form Add Material List',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'category'      => $this->users->get_all_category(),
                'area'          => $this->users->get_all_area(),
                'line'          => $this->users->get_line_by_area($code_area),
                'machine'       => $this->users->get_machine_by_line(),
                'uom'           => $this->users->get_all_uom(),
                'location'      => $this->users->get_all_location(),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/material/material_list/v_add_material_list', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function save_material()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_material();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
                $this->session->set_flashdata('msg_code_material' . $this->session->userdata('username'), $save['code_material']);
            } else {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function upload_excel_material()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_status = $this->upload_doc_material();
            if ($upload_status != false) {
                $inputFileName = 'assets/uploads/material/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $success_count = 0;
                $duplicate_count = 0; // Tambahkan variabel untuk menghitung jumlah duplikat
                foreach ($sheet->getRowIterator() as $key => $row) {
                    if ($key != 1) { // Mulai dari baris kedua
                        $code_material          = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue();
                        $code_category          = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue();
                        $part_name              = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex())->getValue();
                        $part_type              = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex())->getValue();
                        $part_number_maker      = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex())->getValue();
                        $part_code_machine      = $spreadsheet->getActiveSheet()->getCell('F' . $row->getRowIndex())->getValue();
                        $part_drawing           = $spreadsheet->getActiveSheet()->getCell('G' . $row->getRowIndex())->getValue();
                        $maker                  = $spreadsheet->getActiveSheet()->getCell('H' . $row->getRowIndex())->getValue();
                        $additional_description = $spreadsheet->getActiveSheet()->getCell('I' . $row->getRowIndex())->getValue();
                        $code_area              = $spreadsheet->getActiveSheet()->getCell('J' . $row->getRowIndex())->getValue();
                        $code_line              = $spreadsheet->getActiveSheet()->getCell('K' . $row->getRowIndex())->getValue();
                        $machine                = $spreadsheet->getActiveSheet()->getCell('L' . $row->getRowIndex())->getValue();
                        $life_time_part         = $spreadsheet->getActiveSheet()->getCell('M' . $row->getRowIndex())->getValue();
                        $qty_on_machine         = $spreadsheet->getActiveSheet()->getCell('N' . $row->getRowIndex())->getValue();
                        $qty_stock              = $spreadsheet->getActiveSheet()->getCell('O' . $row->getRowIndex())->getValue();
                        $uom                    = $spreadsheet->getActiveSheet()->getCell('P' . $row->getRowIndex())->getValue();
                        $location               = $spreadsheet->getActiveSheet()->getCell('Q' . $row->getRowIndex())->getValue();
                        $minimum_stock          = $spreadsheet->getActiveSheet()->getCell('R' . $row->getRowIndex())->getValue();
                        $maximal_stock          = $spreadsheet->getActiveSheet()->getCell('S' . $row->getRowIndex())->getValue();
                        $safety_stock           = $spreadsheet->getActiveSheet()->getCell('T' . $row->getRowIndex())->getValue();
                        $rop                    = $spreadsheet->getActiveSheet()->getCell('U' . $row->getRowIndex())->getValue();
                        $specification_material = strtoupper(implode(', ', array_filter([$part_name, $part_type, $part_number_maker, $part_code_machine, $part_drawing, $maker, $additional_description])));

                        // Cek apakah kode material kosong
                        if ($code_material == null) {
                            // Jika kosong, cek apakah kode kategori kosong juga
                            if ($code_category == null) {
                                // Jika keduanya kosong, cari kode kategori berdasarkan nama bagian
                                $code_category = $this->users->get_code_category($part_name);
                            }
                            // Setelah mendapatkan kode kategori, generate kode material berdasarkan kategori
                            $code_material = $this->users->generate_material_code_upload($code_category);
                        }

                        // Cek apakah spesifikasi ada yang sama persis
                        $check_specification = $this->users->check_specification_material($specification_material);
                        if (!$check_specification) {
                            // Jika tidak ada yang sama persis, lanjutkan proses
                            // Cek apakah kode material sudah ada
                            $is_exist = $this->users->check_code_material($code_material);
                            if (!$is_exist) {
                                $id_material = uniqid();
                                $data = array(
                                    'id_material'               => $id_material,
                                    'code_material'             => $code_material,
                                    'code_category'             => $code_category,
                                    'part_name'                 => $part_name,
                                    'part_type'                 => $part_type,
                                    'part_number_maker'         => $part_number_maker,
                                    'part_code_machine'         => $part_code_machine,
                                    'part_drawing'              => $part_drawing,
                                    'maker'                     => $maker,
                                    'additional_description'    => $additional_description,
                                    'specification_material'    => $specification_material,
                                    'code_area'                 => $code_area,
                                    'code_line'                 => $code_line,
                                    'code_machine'              => $machine,
                                    'life_time_part'            => $life_time_part,
                                    'qty_on_machine'            => $qty_on_machine,
                                    'qty_stock'                 => $qty_stock,
                                    'code_uom'                  => $uom,
                                    'code_location'             => ($location),
                                    'minimum_stock'             => $minimum_stock,
                                    'maximal_stock'             => $maximal_stock,
                                    'safety_stock'              => $safety_stock,
                                    'rop'                       => $rop
                                );

                                $this->users->upload_material($data);
                                $success_count++;
                            } else {
                                $duplicate_count++; // Tambahkan jumlah duplikat
                            }
                        } else {
                            $duplicate_count++; // Tambahkan jumlah duplikat karena spesifikasi yang sama telah ada
                        }

                        $count_Rows++;
                    }
                }

                unlink($inputFileName);
                $response = [
                    'success' => true,
                    'message' => [
                        'success' => $success_count,
                        'total' => $count_Rows
                    ]
                ];

                if ($duplicate_count > 0) {
                    // Tambahkan pesan untuk duplikat jika ada
                    $response['message']['duplicate_count'] = $duplicate_count;
                }
            } else {
                $response = [
                    'success'   => false,
                    'message'   => 'upload hanya mendukung file dalam format csv|xlsx|xls'
                ];
            }
            echo json_encode($response);
        } else {
            redirect('users/material');
        }
    }

    function upload_doc_material()
    {
        $uploadPath = 'assets/uploads/material/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('upload_material')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

    public function post_to_pdf()
    {
        $material_codes = $this->input->post('material_codes');

        if (!empty($material_codes)) {
            // Simpan material codes dalam sesi
            $this->session->set_userdata('material_codes', $material_codes);

            // Respon sukses
            $response = [
                'success' => true,
                'message' => 'Material codes received successfully',
                'data' => $material_codes
            ];
        } else {
            // Respon gagal jika tidak ada material codes
            $response = [
                'success' => false,
                'message' => 'No material codes received'
            ];
        }

        echo json_encode($response);
    }
    public function print_label_pdf()
    {
        $material_codes = $this->session->userdata('material_codes');

        if (!empty($material_codes)) {
            // Query database untuk mendapatkan data sesuai dengan material codes yang dipilih
            $selected_data = $this->Users->get_data_by_code_material($material_codes);

            if (!empty($selected_data)) {
                $this->data['title_pdf'] = 'Print Label Material';
                $this->data['material_codes'] = $selected_data;

                // Render view dengan data
                $this->load->view('users/material/material_list/print_label_pdf', $this->data);
            } else {
                // Respon gagal jika tidak ada data sesuai material codes
                $response = [
                    'success' => false,
                    'message' => 'No material codes available'
                ];

                echo json_encode($response);
            }
        } else {
            // Respon gagal jika tidak ada material codes dalam sesi
            $response = [
                'success' => false,
                'message' => 'No material codes found in session'
            ];

            echo json_encode($response);
        }
    }

    public function material_list_pdf()
    {
        $this->load->library('pdfgenerator');

        // Ambil material codes dari sesi
        $material_codes = $this->session->userdata('material_codes');

        if (!empty($material_codes)) {


            // Query database untuk mendapatkan data sesuai dengan material codes yang dipilih
            $selected_data = $this->Material->get_data_by_code_material($material_codes);

            if (!empty($selected_data)) {
                // Jika data ditemukan, lanjutkan dengan menghasilkan PDF
                // ...
                // (kode untuk menghasilkan PDF)
                // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
                $this->load->library('pdfgenerator');

                // title dari pdf
                $this->data['title_pdf'] = 'Materia List';
                $this->data['material_codes'] = $selected_data;

                // filename dari pdf ketika didownload
                $file_pdf = 'Material List';
                // setting paper
                $paper = 'A4';
                //orientasi paper potrait / landscape
                $orientation = "landscape";

                $html = $this->load->view('users/material/material_list/material_list_pdf', $this->data, true);

                // run dompdf
                $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

                // Hapus material codes dari sesi setelah digunakan
                $this->session->unset_userdata('material_codes');

                // Respon sukses
                $response = [
                    'success' => true,
                    'message' => 'PDF generated successfully'
                ];
            } else {
                // Respon gagal jika data tidak ditemukan
                $response = [
                    'success' => false,
                    'message' => 'No data found for selected material codes'
                ];
            }
        } else {
            // Respon gagal jika tidak ada material codes
            $response = [
                'success' => false,
                'message' => 'No material codes available'
            ];
        }

        echo json_encode($response);
    }

    //------------------------------------- Category -------------------------------------\\
    public function category()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab'     => 'users | Category',
                'title_page'    => 'Category',
                'bread_crumb'   => 'Category',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'category'      => $this->users->get_all_category(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/category/v_category', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_category()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab' => 'users | Add Category',
                'title_page' => 'Form Add Category',
                'title_card' => 'Form Add Category',
                'bread_crumb' => 'Form Add Category',
                'session' => $this->users->check_login($session),
                'id_users' => $this->session->userdata('id_users'),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/category/v_add_category', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function check_code_category()
    {
        $code_category = $this->input->post('code_category');
        $original_code_category = $this->input->post('original_code_category'); // kode baris asli sebelum diedit
        $id_category = $this->input->post('id_category'); // ID baris yang sedang diedit

        // Memeriksa apakah kode baris sudah ada dalam data, kecuali data yang sedang diedit
        $existing_code_category = $this->users->check_code_category($code_category, $original_code_category, $id_category);

        if ($existing_code_category) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function save_category()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_category();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function upload_category()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_status = $this->upload_doc_category();
            if ($upload_status != false) {
                $inputFileName = 'assets/uploads/category/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $success_count = 0;
                $duplicate_count = 0; // Tambahkan variabel untuk menghitung jumlah duplikat
                foreach ($sheet->getRowIterator() as $key => $row) {
                    if ($key != 1) { // Mulai dari baris kedua
                        $code_category  = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue();
                        $name_category  = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue();

                        // Periksa apakah kode kategori sudah ada
                        $is_exist = $this->users->check_code_category_upload($code_category);
                        if (!$is_exist) {
                            $id_category = uniqid();
                            $data = array(
                                'id_category'   => $id_category,
                                'code_category' => $code_category,
                                'name_category' => $name_category,
                            );

                            $this->users->upload_category($data);
                            $success_count++;
                        } else {
                            $duplicate_count++; // Tambahkan jumlah duplikat
                        }
                        $count_Rows++;
                    }
                }
                unlink($inputFileName);
                $response = [
                    'success' => true,
                    'message' => [
                        'success' => $success_count,
                        'total' => $count_Rows
                    ]
                ];

                if ($duplicate_count > 0) {
                    // Tambahkan pesan untuk duplikat jika ada
                    $response['message']['duplicate_count'] = $duplicate_count;
                }
            } else {
                $response = [
                    'success'   => false,
                    'message'   => 'upload hanya mendukung file dalam format csv|xlsx|xls'
                ];
            }
            echo json_encode($response);
        } else {
            redirect('users/category');
        }
    }

    function upload_doc_category()
    {
        $uploadPath = 'assets/uploads/category/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('upload_category')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

    //------------------------------------- Area -------------------------------------\\
    public function area()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $data = [
                'title_tab'     => 'users | Area',
                'title_page'    => 'Area',
                'bread_crumb'   => 'Area',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'area'          => $this->users->get_all_area(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/area/v_area', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function get_area()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $data = [
                'area'          => $this->users->get_all_area(),
            ];

            echo json_encode($data);
        } else {
            redirect('auth/login');
        }
    }

    public function add_area()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab' => 'users | Add Area',
                'title_page' => 'Form Add Area',
                'title_card' => 'Form Add Area',
                'bread_crumb' => 'Form Add Area',
                'session' => $this->users->check_login($session),
                'id_users' => $this->session->userdata('id_users'),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/area/v_add_area', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function check_code_area()
    {
        $code_area = $this->input->post('code_area');
        $original_code_area = $this->input->post('original_code_area');
        $id_area = $this->input->post('id_area');

        $existing_code_area = $this->users->check_code_area($code_area, $original_code_area, $id_area);

        if ($existing_code_area) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }


    public function save_area()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_area();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function update_area()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_area = $this->input->post('id_area');
            $update = $this->users->update_area($id_area);

            if ($update['success'] == true) {
                $response = [
                    'success'   => $update['success'],
                    'message'   => $update['message']
                ];
            }
        }
        echo json_encode($response);
    }

    public function delete_area()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_area = $this->input->post('id_area');
            $delete = $this->users->delete_area($id_area);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }



    //------------------------------------- Line -------------------------------------\\
    public function line()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $data = [
                'title_tab'     => 'users | Line',
                'title_page'    => 'Line',
                'bread_crumb'   => 'Line',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'line'          => $this->users->get_all_line(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/line/v_line', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function get_line_by_area()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $code_area = $this->input->post('code_area');

            $data = [
                'line'          => $this->users->get_line_by_area($code_area),
            ];

            echo json_encode($data);
        } else {
            redirect('auth/login');
        }
    }

    public function add_line()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab'     => 'users | Add Line',
                'title_page'    => 'Form Add Line',
                'title_card'    => 'Form Add Line',
                'bread_crumb'   => 'Form Add Line',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'area'          => $this->users->get_all_area(),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/material/line/v_add_line', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function check_code_line()
    {
        $code_line = $this->input->post('code_line');
        $original_code_line = $this->input->post('original_code_line'); // kode baris asli sebelum diedit
        $id_line = $this->input->post('id_line'); // ID baris yang sedang diedit

        // Memeriksa apakah kode baris sudah ada dalam data, kecuali data yang sedang diedit
        $existing_code_line = $this->users->check_code_line($code_line, $original_code_line, $id_line);

        if ($existing_code_line) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function save_line()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_line();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function update_line()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_line    = $this->input->post('id_line');
            $save       = $this->users->update_line($id_line);

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function delete_line()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_line    = $this->input->post('id_line');
            $delete = $this->users->delete_line($id_line);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }

    //------------------------------------- Machine -------------------------------------\\

    public function machine()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $data = [
                'title_tab'     => 'users | Machine',
                'title_page'    => 'Machine',
                'bread_crumb'   => 'Machine',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'machine'       => $this->users->get_all_machine(),
                'line'          => $this->users->get_all_line()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/machine/v_machine', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function get_machine_by_line()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $data = [
                'machine'       => $this->users->get_machine_by_line(),
            ];

            echo json_encode($data);
        } else {
            redirect('auth/login');
        }
    }

    public function add_machine()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'users | Add Material List',
                'title_page'    => 'Material List',
                'title_card'    => 'Form Add Material List',
                'bread_crumb'   => 'Form Add Material List',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'area'          => $this->users->get_all_area(),
                'line'          => $this->users->get_line_by_area($code_area),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/material/machine/v_add_machine', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function check_code_machine()
    {
        $code_machine = $this->input->post('code_machine');
        $original_code_machine = $this->input->post('original_code_machine'); // kode baris asli sebelum diedit
        $id_machine = $this->input->post('id_machine'); // ID baris yang sedang diedit

        // Memeriksa apakah kode baris sudah ada dalam data, kecuali data yang sedang diedit
        $existing_code_machine = $this->users->check_code_machine($code_machine, $original_code_machine, $id_machine);

        if ($existing_code_machine) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function save_machine()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_machine();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function update_machine($id_machine)
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $get_data_machine = $this->users->get_data_machine_by_id($id_machine);
            if ($get_data_machine) {

                $code_area = $this->input->get('code_area');
                $data = [
                    'title_tab'     => 'users | Update Machine',
                    'title_page'    => 'Update Machine',
                    'title_card'    => 'Form Update Machine',
                    'bread_crumb'   => 'Form Update Machine',
                    'session'       => $this->users->check_login($session),
                    'id_users'      => $this->session->userdata('id_users'),
                    'area'          => $this->users->get_all_area(),
                    'line'          => $this->users->get_line_by_area($code_area),
                    'data_machine'  => $get_data_machine
                ];
            }

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/material/machine/v_update_machine', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function save_update_machine()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_update_machine();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            } else {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function delete_machine()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_machine    = $this->input->post('id_machine');
            $delete = $this->users->delete_machine($id_machine);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }

    public function upload_excel_machine()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_status = $this->upload_doc_machine();
            if ($upload_status != false) {
                $inputFileName = 'assets/uploads/machine/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $success_count = 0;
                $duplicate_count = 0; // Tambahkan variabel untuk menghitung jumlah duplikat
                foreach ($sheet->getRowIterator() as $key => $row) {
                    if ($key != 1) { // Mulai dari baris kedua
                        $code_area  = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue();
                        $code_line  = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue();
                        $code_machine  = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex())->getValue();
                        $name_machine  = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex())->getValue();

                        // Periksa apakah kode kategori sudah ada
                        $is_exist = $this->users->check_code_line_code_machine($code_line, $code_machine);
                        if (!$is_exist) {
                            $id_machine = uniqid();
                            $data = array(
                                'id_machine'    => $id_machine,
                                'code_area'     => $code_area,
                                'code_line'     => $code_line,
                                'code_machine'  => $code_machine,
                                'name_machine'  => $name_machine,
                            );

                            $this->users->upload_machine($data);
                            $success_count++;
                        } else {
                            $duplicate_count++; // Tambahkan jumlah duplikat
                        }
                        $count_Rows++;
                    }
                }
                unlink($inputFileName);
                $response = [
                    'success' => true,
                    'message' => [
                        'success' => $success_count,
                        'total' => $count_Rows
                    ]
                ];

                if ($duplicate_count > 0) {
                    // Tambahkan pesan untuk duplikat jika ada
                    $response['message']['duplicate_count'] = $duplicate_count;
                }
                echo json_encode($response);
            } else {
                $response = [
                    'success'   => false,
                    'message'   => 'upload hanya mendukung file dalam format csv|xlsx|xls'
                ];
                echo json_encode($response);
            }
        } else {
            redirect('users/machine');
        }
    }

    function upload_doc_machine()
    {
        $uploadPath = 'assets/uploads/machine/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('upload_machine')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

    //------------------------------------- UOM -------------------------------------\\

    public function uom()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $data = [
                'title_tab'     => 'users | UOM',
                'title_page'    => 'UOM',
                'bread_crumb'   => 'UOM',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'uom'           => $this->users->get_all_uom(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/uom/v_uom', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_uom()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'users | Add UOM',
                'title_page'    => 'UOM',
                'title_card'    => 'Form Add UOM',
                'bread_crumb'   => 'Form Add UOM',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/material/uom/v_add_uom', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function check_code_uom()
    {
        $code_uom = $this->input->post('code_uom');
        $original_code_uom = $this->input->post('original_code_uom'); // kode baris asli sebelum diedit
        $id_uom = $this->input->post('id_uom'); // ID baris yang sedang diedit

        // Memeriksa apakah kode baris sudah ada dalam data, kecuali data yang sedang diedit
        $existing_code_uom = $this->users->check_code_uom($code_uom, $original_code_uom, $id_uom);

        if ($existing_code_uom) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function save_uom()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_uom();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function delete_uom()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_uom    = $this->input->post('id_uom');
            $delete = $this->users->delete_uom($id_uom);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }

    public function update_uom()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_uom = $this->input->post('id_uom');
            $update = $this->users->update_uom($id_uom);

            if ($update['success'] == true) {
                $response = [
                    'success'   => $update['success'],
                    'message'   => $update['message']
                ];
            }
        }
        echo json_encode($response);
    }

    //------------------------------------- Location -------------------------------------\\

    public function location()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if (
            $session && $role == 3
        ) {
            $data = [
                'title_tab'     => 'users | Location',
                'title_page'    => 'Location',
                'bread_crumb'   => 'Location',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'location'      => $this->users->get_all_location(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/location/v_location', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_location()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'users | Add Location',
                'title_page'    => 'Location',
                'title_card'    => 'Form Add Location',
                'bread_crumb'   => 'Form Add Location',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/material/location/v_add_location', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }
    public function check_code_location()
    {
        $code_location = $this->input->post('code_location');
        $original_code_location = $this->input->post('original_code_location'); // kode baris asli sebelum diedit
        $id_location = $this->input->post('id_location'); // ID baris yang sedang diedit

        // Memeriksa apakah kode baris sudah ada dalam data, kecuali data yang sedang diedit
        $existing_code_location = $this->users->check_code_location($code_location, $original_code_location, $id_location);

        if ($existing_code_location) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function save_location()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_location();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function update_location()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_location = $this->input->post('id_location');
            $update = $this->users->update_location($id_location);

            if ($update['success'] == true) {
                $response = [
                    'success'   => $update['success'],
                    'message'   => $update['message']
                ];
            }
        }
        echo json_encode($response);
    }

    public function delete_location()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_location    = $this->input->post('id_location');
            $delete = $this->users->delete_location($id_location);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }

    public function upload_excel_location()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_status = $this->upload_doc_location();
            if ($upload_status != false) {
                $inputFileName = 'assets/uploads/location/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $success_count = 0;
                $duplicate_count = 0; // Tambahkan variabel untuk menghitung jumlah duplikat
                foreach ($sheet->getRowIterator() as $key => $row) {
                    if ($key != 1) { // Mulai dari baris kedua
                        if (!empty($spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue())) {
                            $code_location  = trim($spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue());
                        } else {
                            continue; // Lanjut ke baris berikutnya jika kolom kosong
                        }

                        // Periksa kolom B
                        if (!empty($spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue())) {
                            $name_location  = trim($spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue());
                        } else {
                            continue; // Lanjut ke baris berikutnya jika kolom kosong
                        }

                        // Periksa apakah kode kategori sudah ada
                        $is_exist = $this->users->check_code_location_upload($code_location);
                        if (!$is_exist) {
                            $id_location = uniqid();
                            $data = array(
                                'id_location'   => strtoupper($id_location),
                                'code_location' => strtoupper($code_location),
                                'name_location' => strtoupper($name_location),
                            );

                            $this->users->upload_location($data);
                            $success_count++;
                        } else {
                            $duplicate_count++; // Tambahkan jumlah duplikat
                        }
                        $count_Rows++;
                    }
                }
                unlink($inputFileName);
                $response = [
                    'success' => true,
                    'message' => [
                        'success' => $success_count,
                        'total' => $count_Rows
                    ]
                ];

                if ($duplicate_count > 0) {
                    // Tambahkan pesan untuk duplikat jika ada
                    $response['message']['duplicate_count'] = $duplicate_count;
                }
            } else {
                $response = [
                    'success'   => false,
                    'message'   => 'upload hanya mendukung file dalam format csv|xlsx|xls'
                ];
            }
            echo json_encode($response);
        } else {
            redirect('users/location');
        }
    }

    function upload_doc_location()
    {
        $uploadPath = 'assets/uploads/location/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('upload_location')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

    //-------------------------------- Detail Material List ---------------------------------------\\

    public function detail_material_list()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $length = 10;
            $data = [
                'title_tab'     => 'users | Material List',
                'title_page'    => 'Material List',
                'bread_crumb'   => 'Material List',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'material'      => $this->users->get_all_material(),
                'location'      => $this->users->get_all_location()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/material/detail_material_list/v_detail_material_list', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    //-------------------------------- TRANSACTION ---------------------------------------\\

    //-------------------------------- Goods Receive
    public function goods_receive()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $data = [
                'title_tab'     => 'users | Goods Receive',
                'title_page'    => 'Goods Receive',
                'bread_crumb'   => 'Goods Receive',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'goods_receive' => $this->users->get_all_goods_receive(),
                'uom'           => $this->users->get_all_uom()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/transaction/goods_receive/v_goods_receive', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_goods_receive()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $length = 10;
            $data = [
                'title_tab'         => 'users | Add Goods Receive',
                'title_page'        => 'Goods Receive',
                'title_card'        => 'Form Add Goods Receive',
                'bread_crumb'       => 'Form Add Goods Receive',
                'session'           => $this->users->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
                'id_transaction'    => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length)
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/transaction/goods_receive/v_add_goods_receive', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function save_good_receive()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_goods_receive();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function update_goods_receive()
    {
        $session = $this->session->userdata('username');
        $response = ['success' => false, 'message' => ''];

        if ($session) {
            $update = $this->users->update_goods_receive(); // Perbaikan: Panggil model Transaction

            if ($update['success'] == true) {
                $response = [
                    'success' => $update['success'],
                    'message' => $update['message']
                ];
            }
        } else {
            $response['message'] = 'Session is not active';
        }

        echo json_encode($response);
    }


    //-------------------------------- Goods Issue
    public function goods_issue()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $data = [
                'title_tab'     => 'users | Goods Issue',
                'title_page'    => 'Goods Issue',
                'bread_crumb'   => 'Goods Issue',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'goods_issue'   => $this->users->get_all_goods_issue()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/transaction/goods_issue/v_goods_issue', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_goods_issue()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $length = 10;
            $data = [
                'title_tab'         => 'users | Add Goods Issue',
                'title_page'        => 'Goods Issue',
                'title_card'        => 'Form Add Goods Issue',
                'bread_crumb'       => 'Form Add Goods Issue',
                'session'           => $this->users->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
                'id_transaction'    => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length)
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/transaction/goods_issue/v_add_goods_issue', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function save_goods_issue()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_goods_issue();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            } else {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function update_goods_issue()
    {
        $session = $this->session->userdata('username');
        $response = ['success' => false, 'message' => ''];

        if ($session) {
            $update = $this->users->update_goods_issue(); // Perbaikan: Panggil model Transaction

            if ($update['success'] == true) {
                $response = [
                    'success' => $update['success'],
                    'message' => $update['message']
                ];
            }
        } else {
            $response['message'] = 'Session is not active';
        }

        echo json_encode($response);
    }

    public function delete_transaction()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $delete = $this->users->delete_transaction();

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }

    //-------------------------------- History Transaction
    public function history_transaction()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab'     => 'users | History Transaction',
                'title_page'    => 'History Transaction',
                'bread_crumb'   => 'History Transaction',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'transaction_detail'    => $this->users->get_transaction_detail()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/transaction/history/v_history', $data);
            $this->load->view('template/footer');
        }
    }

    public function search_filter()
    {
        // Ambil nilai dari input form
        $start_date = $this->input->post('start_filter');
        $end_date = $this->input->post('end_filter');

        // Lakukan validasi tanggal
        if ($start_date == '' || $end_date == '') {
            $response = [
                'success'   => false,
                'message'   => 'Pilih Tanggal Awal dan Tanggal Akhir', // menggunakan toastr info
                'date'      => null
            ];
        } else if ($start_date > $end_date) {
            $response = [
                'success'   => false,
                'message'   => 'End date cannot be earlier than start date.', // menggunakan toastr error
                'date'      => false
            ];
        } else {
            // Lakukan pencarian data berdasarkan rentang tanggal
            $filtered_data = $this->users->get_filtered_data($start_date, $end_date);

            // Jika tidak ada data yang ditemukan
            if (empty($filtered_data)) {
                $response = [
                    'success' => true,
                    'message' => 'No data found for the selected date range.', // menggunakan toastr info
                    'data'    => null
                ];
            } else {
                // Tambahkan nomor urutan (no) ke setiap baris data
                $counter = 1;
                foreach ($filtered_data as &$row) {
                    $row->no = $counter++;
                }

                // Kembalikan data beserta nomor urutan sebagai bagian dari respons
                $response = [
                    'success' => true,
                    'message' => 'Data successfully retrieved.', // menggunakan toastr success
                    'data'    => $filtered_data
                ];
            }
        }

        // Keluarkan respons sebagai JSON
        echo json_encode($response);
    }

    //-------------------------------- Request Order ---------------------------------------\\
    public function req_order()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $data = [
                'title_tab'     => 'Users | Request Order',
                'title_page'    => 'Request Order',
                'bread_crumb'   => 'Request Order',
                'session'       => $this->Users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'req_order'   => $this->Users->get_all_req_order(),

            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/req_order/v_req_order', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_req_order()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $length = 10;
            $data = [
                'title_tab'         => 'Users | Add Request Order',
                'title_page'        => 'Request Order',
                'title_card'        => 'Form Add Request Order ',
                'bread_crumb'       => 'Form Add Request Order',
                'session'           => $this->Users->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
                'id_req_order'      => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length),
                'material'          => $this->Users->get_all_material(),
                // 'no_ppbj'           => $this->Req_order->create_no_ppbj()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/req_order/v_add_req_order', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }
    public function add_material_for_req_order()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 3) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'users | Add Material For Request Order',
                'title_page'    => 'Add Material For Request Order',
                'title_card'    => 'Form Add Material For Request Order ',
                'bread_crumb'   => 'Form Add Material For Request Order',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'category'      => $this->users->get_all_category(),
                'area'          => $this->users->get_all_area(),
                'line'          => $this->users->get_line_by_area($code_area),
                'machine'       => $this->users->get_machine_by_line(),
                'uom'           => $this->users->get_all_uom(),
                'location'      => $this->users->get_all_location(),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/req_order/v_add_material_for_req_order', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function check_register_no()
    {
        $register_no            = $this->input->post('register_no');
        $original_register_no   = $this->input->post('original_register_no');
        $regist_no              = $this->input->post('regist_no');

        $existing_register_no = $this->Users->check_register_no($register_no, $original_register_no, $regist_no);

        if ($existing_register_no) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function save_req_order()
    {
        // Mulai transaksi
        $this->db->trans_start();

        try {
            // Add delay of 3 seconds before generating unique regist_no and no_ppbj
            sleep(1);

            date_default_timezone_set("Asia/Jakarta");

            $json_data = $this->input->post('material_data');

            if ($json_data !== null && $json_data !== '') {

                $material_data = json_decode($json_data, true);
            } else {
                $material_data = null;
            }

            if (
                $material_data === null && json_last_error() !== JSON_ERROR_NONE
            ) {
                // Handle JSON decoding error if needed
                $response = ['error' => 'Failed to decode JSON data'];
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                return;
            }

            $register_no    = $this->input->post('register_no');

            // Generate unique regist_no once for the entire input session
            if (!empty($register_no)) {
                $regist_no = md5($register_no);
            } else {
                $regist_no = md5(uniqid(rand(), true)); // Generate a unique MD5 hash
            }

            // Menggunakan locking untuk mendapatkan regist_no yang unik
            $this->db->query('SELECT * FROM tbl_req_order WHERE regist_no = ? FOR UPDATE', [$regist_no]);

            // Tunggu sampai transaksi sebelumnya selesai
            while ($this->db->trans_status() === FALSE) {
                // Tunggu 1 detik sebelum mencoba lagi
                sleep(1);
                $this->db->query('SELECT * FROM tbl_req_order WHERE regist_no = ? FOR UPDATE', [$regist_no]);
            }

            // Menggunakan locking untuk mendapatkan no_ppbj yang unik
            $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj = ? FOR UPDATE', [$register_no]);

            // Tunggu sampai transaksi sebelumnya selesai
            while ($this->db->trans_status() === FALSE) {
                // Tunggu 1 detik sebelum mencoba lagi
                sleep(1);
                $this->db->query('SELECT * FROM tbl_req_order WHERE no_ppbj = ? FOR UPDATE', [$register_no]);
            }

            if (is_array($material_data)) {
                foreach ($material_data as $material) {
                    $material_code      = $material['material_code'];
                    $item_description   = $material['item_description'];
                    $quantity           = $material['quantity'];
                    $uom                = $material['uom'];
                    $eta                = $material['eta'];
                    $category_req       = $material['category_req'];
                    $remark_user        = $material['remark']['user'];
                    $remark_for         = $material['remark']['for'];

                    // Construct data array for each material entry
                    $data = [
                        'code_material'                 => strtoupper($material_code),
                        'item_description'              => strtoupper($item_description),
                        'quantity'                      => strtoupper($quantity),
                        'uom'                           => strtoupper($uom),
                        'eta'                           => $eta,
                        'category_req'                  => strtoupper($category_req),
                        'remark_user'                   => strtoupper($remark_user),
                        'remark_for'                    => strtoupper($remark_for),
                        'regist_no'                     => $regist_no,
                        'register_no'                   => strtoupper($register_no),
                        'date_created'                  => date('Y-m-d H:i:s'),
                        'date_required'                 => $this->input->post('date_required'),
                        'department'                    => strtoupper($this->input->post('department')),
                        'category_item_service'         => strtoupper($this->input->post('category_item_service')),
                        'b3_product'                    => strtoupper($this->input->post('b3_product')),
                        'reason'                        => strtoupper($this->input->post('reason')),
                        'level_of_request'              => strtoupper($this->input->post('level_of_request')),
                        'type_of_payment'               => strtoupper($this->input->post('type_of_payment')),
                        'order_type'                    => strtoupper($this->input->post('order_type')),
                        'attachment'                    => strtoupper($this->input->post('attachment') ? implode(', ', $this->input->post('attachment')) : ''),
                        'created_by_pic'                => strtoupper($this->input->post('pic_maintenance')),
                        'approved_by_manager'           => strtoupper($this->input->post('manager_maintenance')),
                        'approved_by_general_manager'   => strtoupper($this->input->post('g_manager_maintenance')),
                        'approved_by'                   => strtoupper($this->input->post('approved_by')),
                        'requester_name'                => strtoupper($this->input->post('requester_name')),
                        'no_ppbj'                       => $register_no
                    ];

                    // Insert each material entry into database
                    $this->db->insert('tbl_req_order', $data);
                }
            }

            // Commit transaction
            $this->db->trans_complete();

            // Respond with JSON success message
            $response = [
                'success'   => true,
                'message'   => 'Data saved successfully'
            ];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $this->db->trans_rollback();
            throw $e;
        }
    }

    public function get_req_order_by_register_no()
    {
        $register_no    = $this->input->post('register_no');
        $regist_no      = $this->input->post('regist_no');

        $data = $this->Req_order->get_req_order_by_regist_no($register_no, $regist_no);

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(array()); // Atau kirim pesan error jika tidak ada data
        }
    }

    public function generate_no_ppbj()
    {
        $department = $this->input->post('department');

        // Determine the appropriate department code
        $department_code = '';
        if ($department == 'MAINTENANCE') {
            $department_code = 'MTN';
        } elseif ($department == 'PRODUCTION ASM') {
            $department_code = 'PROD-ASM';
        } elseif ($department == 'PRODUCTION MCH') {
            $department_code = 'PROD-MCH';
        } elseif ($department == 'MANUFACTURING ENGINEERING') {
            $department_code = 'ME';
        } elseif ($department == 'QUALITY CONTROL') {
            $department_code = 'QC';
        } elseif ($department == 'PPC') {
            $department_code = 'PPC';
        } elseif ($department == 'GA') {
            $department_code = 'GA';
        }

        // Generate the no_ppbj using the model function
        $no_ppbj = $this->Users->create_no_ppbj($department_code);

        if ($no_ppbj) {
            echo json_encode(['success' => true, 'no_ppbj' => $no_ppbj]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function print_req_order($regist_no)
    {
        $row_req_order      = $this->Users->print_req_order_by_regist_no($regist_no);
        $result_req_order   = $this->Users->get_print_req_order_by_regist_no($regist_no);

        $data       = [
            'title_tab'         => 'PRINT PROPOSAL PERMINTAAN BARANG & JASA',
            'row_req_order'     => $row_req_order,
            'result_req_order'  => $result_req_order
        ];

        $this->load->view('template/header', $data);
        $this->load->view('users/req_order/print_req_order', $data);
    }

    //-------------------------------- Manage Users ---------------------------------------\\

    public function manage_user()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab'     => 'users | Manage User',

                'title_page'    => 'Manage User',
                'bread_crumb'   => 'Manage User',
                'session'       => $this->users->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'users'  => $this->users->get_all_users(),
                'role'          => $this->users->get_all_role(),
                'category'      => $this->users->get_all_category(),
                'area'          => $this->users->get_all_area()
            ];
            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('users/sidebar/v_sidebar', $data);
                $this->load->view('users/manage_user/v_manage_user', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function check_username()
    {
        $username = $this->input->post('username');
        $original_username = $this->input->post('original_username'); // kode baris asli sebelum diedit
        $id_users = $this->input->post('id_users'); // ID baris yang sedang diedit

        // Memeriksa apakah kode baris sudah ada dalam data, kecuali data yang sedang diedit
        $existing_username = $this->users->check_username($username, $original_username, $id_users);

        if ($existing_username) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function save_data_users()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->save_data_users();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function update_data_users()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_users   = $this->input->post('id_users');
            $update     = $this->users->update_data_users($id_users); // Perbaikan: Panggil model Transaction

            if ($update['success'] == true) {
                $response = [
                    'success' => $update['success'],
                    'message' => $update['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }

    public function delete_users()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_users = $this->input->post('id_users');
            $delete = $this->users->delete_users($id_users);
            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }

    public function reset_password_users()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $id_users   = $this->input->post('id_users');
            $update     = $this->users->reset_password_users($id_users);

            if ($update['success'] == true) {
                $response = [
                    'success' => $update['success'],
                    'message' => $update['message']
                ];
            }
        }
        echo json_encode($response);
    }

    //-------------------------------- Change Password ---------------------------------------\\

    public function change_password()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 3) {
            $data = [
                'title_tab'         => 'users | Change Password',
                'title_page'        => 'Changer Password',
                'title_card'        => 'Changer Password',
                'bread_crumb'       => 'Changer Password',
                'session'           => $this->users->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('users/sidebar/v_sidebar', $data);
            $this->load->view('users/change_password/v_change_password', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function save_change_password()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->users->change_password();

            if ($save['success'] == true) {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            } else {
                $response = [
                    'success'   => $save['success'],
                    'message'   => $save['message']
                ];
            }
        } else {
            redirect('auth/login');
        }

        echo json_encode($response);
    }
}
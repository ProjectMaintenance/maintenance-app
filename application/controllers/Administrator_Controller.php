<?php
require 'vendor/autoload.php';

class Administrator_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Administrator');
    }

    //------------------------------------- Dashboard -------------------------------------\\

    public function index()
    {
        redirect('administrator/dashboard');
    }

    public function dashboard()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $data = [
                'title_tab'                                 => 'Administrator | Dashboard',
                'title_page'                                => 'Dashboard',
                'bread_crumb'                               => 'Dashboard',
                'title_card'                                => 'APPLICATION WAREHOUSE MAINTENANCE SYSTEM',
                'session'                                   => $this->Administrator->check_login($session),
                'id_users'                                  => $this->session->userdata('id_users'),
                'count_material'                            => $this->Administrator->get_count_material(),
                'count_goods_receive'                       => $this->Administrator->get_count_goods_receive(),
                'count_goods_issue'                         => $this->Administrator->get_count_goods_issue(),
                'count_users'                               => $this->Administrator->get_count_users(),
                'count_transaction'                         => $this->Administrator->get_count_transaction(),
                'count_status_ppbj_on_progress'             => $this->Administrator->get_count_status_ppbj_on_progress(),
                'count_status_ppbj_delay'                   => $this->Administrator->get_count_status_ppbj_delay(),
                'count_status_ppbj_done'                    => $this->Administrator->get_count_status_ppbj_done(),
                'count_status_ppbj_cancel'                  => $this->Administrator->get_count_status_ppbj_cancel(),
                'count_status_sr_on_progress'               => $this->Administrator->get_count_status_sr_on_progress(),
                'count_status_sr_delay'                     => $this->Administrator->get_count_status_sr_delay(),
                'count_status_sr_done'                      => $this->Administrator->get_count_status_sr_done(),
                'count_status_sr_cancel'                    => $this->Administrator->get_count_status_sr_cancel(),
                'count_status_pr_on_progress'               => $this->Administrator->get_count_status_pr_on_progress(),
                'count_status_pr_delay'                     => $this->Administrator->get_count_status_pr_delay(),
                'count_status_pr_done'                      => $this->Administrator->get_count_status_pr_done(),
                'count_status_pr_cancel'                    => $this->Administrator->get_count_status_pr_cancel(),
                'count_status_po_on_progress'               => $this->Administrator->get_count_status_po_on_progress(),
                'count_status_po_delay'                     => $this->Administrator->get_count_status_po_delay(),
                'count_status_po_done'                      => $this->Administrator->get_count_status_po_done(),
                'count_status_po_cancel'                    => $this->Administrator->get_count_status_po_cancel(),
                'count_jugdment_on_progress'                => $this->Administrator->get_count_jugdment_on_progress(),
                'count_jugdment_delay'                      => $this->Administrator->get_count_jugdment_delay(),
                'count_jugdment_received'                   => $this->Administrator->get_count_jugdment_received(),
                'count_jugdment_cancel'                     => $this->Administrator->get_count_jugdment_cancel(),
                'count_jugdment_process_delivery_material'  => $this->Administrator->get_count_jugdment_process_delivery_material(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/dashboard/v_dashboard');
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
        if ($session && $role == 1) {
            $data = [
                'title_tab'     => 'Administrator | Material List',
                'title_page'    => 'Material List',
                'bread_crumb'   => 'Material List',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'material'      => $this->Administrator->get_all_material(),
            ];
            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('Administrator/sidebar/v_sidebar', $data);
                $this->load->view('Administrator/material/material_list/v_material_list', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    // public function generate_material_code()
    // {
    //     $material_code = $this->Administrator->generate_material_code();
    //     echo json_encode(['material_code' => $material_code]);
    // }

    public function get_material_by_code_material()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 1) {

            $data = $this->Administrator->get_material_by_code_material();
            echo json_encode($data);
        } else {
            redirect('auth/login');
        }
    }

    public function add_material_list()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'Administrator | Add Material List',
                'title_page'    => 'Material List',
                'title_card'    => 'Form Add Material List',
                'bread_crumb'   => 'Form Add Material List',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'category'      => $this->Administrator->get_all_category(),
                'area'          => $this->Administrator->get_all_area(),
                'line'          => $this->Administrator->get_line_by_area($code_area),
                'machine'       => $this->Administrator->get_machine_by_line(),
                'uom'           => $this->Administrator->get_all_uom(),
                'location'      => $this->Administrator->get_all_location(),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/material/material_list/v_add_material_list', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }
    public function update_material($id_material)
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $get_data_material = $this->Administrator->get_data_material_by_id($id_material);
            if ($get_data_material) {

                $code_area = $this->input->get('code_area');
                $data = [
                    'title_tab'     => 'Administrator | Update Material List',
                    'title_page'    => 'Update Material List',
                    'title_card'    => 'Form Update Material List',
                    'bread_crumb'   => 'Form Update Material List',
                    'session'       => $this->Administrator->check_login($session),
                    'id_users'      => $this->session->userdata('id_users'),
                    'category'      => $this->Administrator->get_all_category(),
                    'area'          => $this->Administrator->get_all_area(),
                    'line'          => $this->Administrator->get_line_by_area($code_area),
                    'machine'       => $this->Administrator->get_machine_by_line(),
                    'uom'           => $this->Administrator->get_all_uom(),
                    'location'      => $this->Administrator->get_all_location(),
                    'data_material' => $get_data_material
                ];
            }

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/material/material_list/v_update_material_list', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function save_material()
    {
        // Cek apakah sesi pengguna ada
        $session = $this->session->userdata('username');

        if ($session) {
            // Panggil fungsi save_material dari model Administrator
            $save = $this->Administrator->save_material();

            if ($save['success'] == true) {
                // Set flashdata jika operasi berhasil
                $response = [
                    'success' => true,
                    'message' => $save['message'],
                    'code_material' => $save['code_material']
                ];
                $this->session->set_flashdata('msg_code_material' . $this->session->userdata('username'), $save['code_material']);
            } else {
                // Kembalikan respons jika operasi gagal
                $response = [
                    'success' => false,
                    'message' => $save['message']
                ];
            }
        } else {
            // Redirect ke halaman login jika sesi tidak ada
            redirect('auth/login');
        }

        // Kembalikan respons dalam format JSON
        echo json_encode($response);
    }


    public function save_update_material()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->Administrator->save_update_material();

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

    public function delete_material()
    {
        $session = $this->session->userdata('username');
        $material_code  = $this->input->post('code_material');
        if ($session) {
            $delete = $this->Administrator->delete_material($material_code);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }

    public function delete_material_select_all()
    {
        $session = $this->session->userdata('username');

        // Dekode data JSON yang dikirim dari AJAX
        $input = file_get_contents('php://input');
        $decoded_data = json_decode($input, true);
        $material_code = isset($decoded_data['code_material']) ? $decoded_data['code_material'] : null;

        $response = [];

        if ($session) {
            if (is_array($material_code) && !empty($material_code)) {
                $delete = $this->Administrator->delete_material_batch($material_code);

                $response = [
                    'success' => $delete['success'],
                    'message' => $delete['message']
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'No material codes provided for deletion'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'User not logged in.'
            ];
        }

        echo json_encode($response); // Send JSON response back to AJAX
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
                        $code_material = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue();
                        $code_material = $code_material !== null ? strtoupper($code_material) : null;

                        // Periksa kolom B
                        $code_category = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue();
                        if (!empty($code_category)) {
                            $code_category = strtoupper(trim($code_category));
                        } else {
                            continue; // Lanjut ke baris berikutnya jika kolom kosong
                        }

                        $part_name = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex())->getValue();
                        $part_name = $part_name !== null ? strtoupper($part_name) : null;

                        $part_type = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex())->getValue();
                        $part_type = $part_type !== null ? strtoupper($part_type) : null;

                        $part_number_maker = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex())->getValue();
                        $part_number_maker = $part_number_maker !== null ? strtoupper($part_number_maker) : null;

                        $part_code_machine = $spreadsheet->getActiveSheet()->getCell('F' . $row->getRowIndex())->getValue();
                        $part_code_machine = $part_code_machine !== null ? strtoupper($part_code_machine) : null;

                        $part_drawing = $spreadsheet->getActiveSheet()->getCell('G' . $row->getRowIndex())->getValue();
                        $part_drawing = $part_drawing !== null ? strtoupper($part_drawing) : null;

                        $maker = $spreadsheet->getActiveSheet()->getCell('H' . $row->getRowIndex())->getValue();
                        $maker = $maker !== null ? strtoupper($maker) : null;

                        $additional_description = $spreadsheet->getActiveSheet()->getCell('I' . $row->getRowIndex())->getValue();
                        $additional_description = $additional_description !== null ? strtoupper($additional_description) : null;

                        $code_area = $spreadsheet->getActiveSheet()->getCell('J' . $row->getRowIndex())->getValue();
                        $code_area = $code_area !== null ? strtoupper($code_area) : null;

                        $code_line = $spreadsheet->getActiveSheet()->getCell('K' . $row->getRowIndex())->getValue();
                        $code_line = $code_line !== null ? strtoupper($code_line) : null;

                        $machine = $spreadsheet->getActiveSheet()->getCell('L' . $row->getRowIndex())->getValue();
                        $machine = $machine !== null ? strtoupper($machine) : null;

                        $life_time_part = $spreadsheet->getActiveSheet()->getCell('M' . $row->getRowIndex())->getValue();
                        $life_time_part = $life_time_part !== null ? strtoupper($life_time_part) : null;

                        $qty_on_machine = $spreadsheet->getActiveSheet()->getCell('N' . $row->getRowIndex())->getValue();
                        $qty_on_machine = $qty_on_machine !== null ? strtoupper($qty_on_machine) : null;

                        $qty_stock = $spreadsheet->getActiveSheet()->getCell('O' . $row->getRowIndex())->getValue();
                        $qty_stock = $qty_stock !== null ? strtoupper($qty_stock) : null;

                        $uom = $spreadsheet->getActiveSheet()->getCell('P' . $row->getRowIndex())->getValue();
                        $uom = $uom !== null ? strtoupper($uom) : null;

                        $location = $spreadsheet->getActiveSheet()->getCell('Q' . $row->getRowIndex())->getValue();
                        $location = $location !== null ? strtoupper($location) : null;

                        $minimum_stock = $spreadsheet->getActiveSheet()->getCell('R' . $row->getRowIndex())->getValue();
                        $minimum_stock = $minimum_stock !== null ? strtoupper($minimum_stock) : null;

                        $maximal_stock = $spreadsheet->getActiveSheet()->getCell('S' . $row->getRowIndex())->getValue();
                        $maximal_stock = $maximal_stock !== null ? strtoupper($maximal_stock) : null;

                        $safety_stock = $spreadsheet->getActiveSheet()->getCell('T' . $row->getRowIndex())->getValue();
                        $safety_stock = $safety_stock !== null ? strtoupper($safety_stock) : null;

                        $rop = $spreadsheet->getActiveSheet()->getCell('U' . $row->getRowIndex())->getValue();
                        $rop = $rop !== null ? strtoupper($rop) : null;

                        $specification_material = strtoupper(implode(', ', array_filter([$part_name, $part_type, $part_number_maker, $part_code_machine, $part_drawing, $maker, $additional_description])));

                        // Check if $code_material is null
                        if ($code_material == null) {
                            // If it's null, check if $code_category is null too
                            if ($code_category == null) {
                                // If both are null, get code category based on part name
                                $code_category = strtoupper($this->Administrator->get_code_category($part_name));
                            }
                            // After getting the code category, generate material code based on category
                            $code_material = strtoupper($this->Administrator->generate_material_code_upload($code_category));
                        }

                        // Check if there's an exact duplicate specification
                        $check_specification = $this->Administrator->check_specification_material($specification_material);
                        if (!$check_specification) {
                            // If there's no exact duplicate, proceed
                            // Check if material code already exists
                            $is_exist = $this->Administrator->check_code_material($code_material);
                            if (!$is_exist) {
                                $id_material = uniqid();
                                $data = [
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
                                    'code_location'             => $location,
                                    'minimum_stock'             => $minimum_stock,
                                    'maximal_stock'             => $maximal_stock,
                                    'safety_stock'              => $safety_stock,
                                    'rop'                       => $rop
                                ];

                                $this->Administrator->upload_material($data);
                                $success_count++;
                            } else {
                                $duplicate_count++; // Increase duplicate count
                            }
                        } else {
                            $duplicate_count++; // Increase duplicate count due to same specification
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
            redirect('administrator/material');
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

    public function post_to_print_label()
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

    public function print_label()
    {
        $material_codes = $this->session->userdata('material_codes');

        if (!empty($material_codes)) {
            // Query database untuk mendapatkan data sesuai dengan material codes yang dipilih
            $selected_data = $this->Administrator->get_data_by_code_material($material_codes);

            if (!empty($selected_data)) {
                $this->data['title_pdf'] = 'Print Label Material';
                $this->data['material_codes'] = $selected_data;

                // Render view dengan data
                $this->load->view('administrator/material/material_list/print_label', $this->data);
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


    // public function post_to_pdf()
    // {
    //     $material_codes = $this->input->post('material_codes');

    //     if (!empty($material_codes)) {
    //         // Simpan material codes dalam sesi
    //         $this->session->set_userdata('material_codes', $material_codes);

    //         // Respon sukses
    //         $response = [
    //             'success' => true,
    //             'message' => 'Material codes received successfully',
    //             'data' => $material_codes
    //         ];
    //     } else {
    //         // Respon gagal jika tidak ada material codes
    //         $response = [
    //             'success' => false,
    //             'message' => 'No material codes received'
    //         ];
    //     }

    //     echo json_encode($response);
    // }



    // public function print_label_pdf()
    // {
    //     $this->load->library('pdfgenerator');

    //     // Ambil material codes dari sesi
    //     $material_codes = $this->session->userdata('material_codes');

    //     if (!empty($material_codes)) {


    //         // Query database untuk mendapatkan data sesuai dengan material codes yang dipilih
    //         $selected_data = $this->Administrator->get_data_by_code_material($material_codes);

    //         if (!empty($selected_data)) {
    //             // Jika data ditemukan, lanjutkan dengan menghasilkan PDF
    //             // ...
    //             // (kode untuk menghasilkan PDF)
    //             // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
    //             $this->load->library('pdfgenerator');

    //             // title dari pdf
    //             $this->data['title_pdf'] = 'Print Label Material Code';
    //             $this->data['material_codes'] = $selected_data;

    //             // filename dari pdf ketika didownload
    //             $file_pdf = 'Print Label Material Code';
    //             // setting paper
    //             $paper = 'A4';
    //             //orientasi paper potrait / landscape
    //             $orientation = "portrait";

    //             $html = $this->load->view('administrator/material/material_list/print_label_pdf', $this->data, true);

    //             // run dompdf
    //             $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

    //             // Hapus material codes dari sesi setelah digunakan
    //             $this->session->unset_userdata('material_codes');

    //             // Respon sukses
    //             $response = [
    //                 'success' => true,
    //                 'message' => 'PDF generated successfully'
    //             ];
    //         } else {
    //             // Respon gagal jika data tidak ditemukan
    //             $response = [
    //                 'success' => false,
    //                 'message' => 'No data found for selected material codes'
    //             ];
    //         }
    //     } else {
    //         // Respon gagal jika tidak ada material codes
    //         $response = [
    //             'success' => false,
    //             'message' => 'No material codes available'
    //         ];
    //     }

    //     echo json_encode($response);
    // }


    public function material_list_pdf()
    {
        $this->load->library('pdfgenerator');

        // Ambil material codes dari sesi
        $material_codes = $this->session->userdata('material_codes');

        if (!empty($material_codes)) {


            // Query database untuk mendapatkan data sesuai dengan material codes yang dipilih
            $selected_data = $this->Administrator->get_data_by_code_material($material_codes);

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

                $html = $this->load->view('administrator/material/material_list/material_list_pdf', $this->data, true);

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
        if ($session && $role == 1) {
            $data = [
                'title_tab'     => 'Administrator | Category',
                'title_page'    => 'Category',
                'bread_crumb'   => 'Category',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'category'      => $this->Administrator->get_all_category(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('Administrator/sidebar/v_sidebar', $data);
            $this->load->view('Administrator/material/category/v_category', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_category()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $data = [
                'title_tab' => 'Administrator | Add Category',
                'title_page' => 'Form Add Category',
                'title_card' => 'Form Add Category',
                'bread_crumb' => 'Form Add Category',
                'session' => $this->Administrator->check_login($session),
                'id_users' => $this->session->userdata('id_users'),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('Administrator/sidebar/v_sidebar', $data);
            $this->load->view('Administrator/material/category/v_add_category', $data);
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
        $existing_code_category = $this->Administrator->check_code_category($code_category, $original_code_category, $id_category);

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
            $save   = $this->Administrator->save_category();

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

    public function update_category()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $update = $this->Administrator->update_category();

            if ($update['success'] == true) {
                $response = [
                    'success'   => $update['success'],
                    'message'   => $update['message']
                ];
            }
        }
        echo json_encode($response);
    }

    public function delete_category()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $delete = $this->Administrator->delete_category();

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
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
                        $is_exist = $this->Administrator->check_code_category_upload($code_category);
                        if (!$is_exist) {
                            $id_category = uniqid();
                            $data = array(
                                'id_category'   => $id_category,
                                'code_category' => $code_category,
                                'name_category' => $name_category,
                            );

                            $this->Administrator->upload_category($data);
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
            redirect('admin/category');
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
            $session && $role == 1
        ) {
            $data = [
                'title_tab'     => 'Administrator | Area',
                'title_page'    => 'Area',
                'bread_crumb'   => 'Area',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'area'          => $this->Administrator->get_all_area(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('Administrator/sidebar/v_sidebar', $data);
            $this->load->view('Administrator/material/area/v_area', $data);
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
            $session && $role == 1
        ) {
            $http_response_header = [
                'area'  => $this->Administrator->get_all_area()
            ];

            echo json_encode($http_response_header);
        } else {
            redirect('auth/login');
        }
    }

    public function add_area()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $data = [
                'title_tab' => 'Administrator | Add Area',
                'title_page' => 'Form Add Area',
                'title_card' => 'Form Add Area',
                'bread_crumb' => 'Form Add Area',
                'session' => $this->Administrator->check_login($session),
                'id_users' => $this->session->userdata('id_users'),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('Administrator/sidebar/v_sidebar', $data);
            $this->load->view('Administrator/material/area/v_add_area', $data);
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

        $existing_code_area = $this->Administrator->check_code_area($code_area, $original_code_area, $id_area);

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
            $save   = $this->Administrator->save_area();

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
            $update = $this->Administrator->update_area($id_area);

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
            $delete = $this->Administrator->delete_area($id_area);

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
            $session && $role == 1
        ) {
            $data = [
                'title_tab'     => 'Administrator | Line',
                'title_page'    => 'Line',
                'bread_crumb'   => 'Line',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'line'          => $this->Administrator->get_all_line(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('Administrator/sidebar/v_sidebar', $data);
            $this->load->view('Administrator/material/line/v_line', $data);
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
            $session && $role == 1
        ) {
            $code_area = $this->input->post('code_area');

            $http_response_header = [
                'line'  => $this->Administrator->get_line_by_area($code_area)
            ];

            echo json_encode($http_response_header);
        } else {
            redirect('auth/login');
        }
    }

    public function add_line()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $data = [
                'title_tab'     => 'Administrator | Add Line',
                'title_page'    => 'Form Add Line',
                'title_card'    => 'Form Add Line',
                'bread_crumb'   => 'Form Add Line',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'area'          => $this->Administrator->get_all_area(),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('Administrator/sidebar/v_sidebar', $data);
                $this->load->view('Administrator/material/line/v_add_line', $data);
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
        $existing_code_line = $this->Administrator->check_code_line($code_line, $original_code_line, $id_line);

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
            $save   = $this->Administrator->save_line();

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
            $save       = $this->Administrator->update_line($id_line);

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
            $delete = $this->Administrator->delete_line($id_line);

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
            $session && $role == 1
        ) {
            $data = [
                'title_tab'     => 'Administrator | Machine',
                'title_page'    => 'Machine',
                'bread_crumb'   => 'Machine',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'machine'       => $this->Administrator->get_all_machine(),
                'line'          => $this->Administrator->get_all_line()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/material/machine/v_machine', $data);
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
            $session && $role == 1
        ) {
            $http_response_header = [
                'machine'   => $this->Administrator->get_machine_by_line()
            ];

            echo json_encode($http_response_header);
        } else {
            redirect('auth/login');
        }
    }

    public function add_machine()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'Administrator | Add Material List',
                'title_page'    => 'Material List',
                'title_card'    => 'Form Add Material List',
                'bread_crumb'   => 'Form Add Material List',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'area'          => $this->Administrator->get_all_area(),
                'line'          => $this->Administrator->get_line_by_area($code_area),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/material/machine/v_add_machine', $data);
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
        $existing_code_machine = $this->Administrator->check_code_machine($code_machine, $original_code_machine, $id_machine);

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
            $save   = $this->Administrator->save_machine();

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
        if ($session && $role == 1) {
            $get_data_machine = $this->Administrator->get_data_machine_by_id($id_machine);
            if ($get_data_machine) {

                $code_area = $this->input->get('code_area');
                $data = [
                    'title_tab'     => 'Administrator | Update Machine',
                    'title_page'    => 'Update Machine',
                    'title_card'    => 'Form Update Machine',
                    'bread_crumb'   => 'Form Update Machine',
                    'session'       => $this->Administrator->check_login($session),
                    'id_users'      => $this->session->userdata('id_users'),
                    'area'          => $this->Administrator->get_all_area(),
                    'line'          => $this->Administrator->get_line_by_area($code_area),
                    'data_machine'  => $get_data_machine
                ];
            }

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/material/machine/v_update_machine', $data);
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
            $save   = $this->Administrator->save_update_machine();

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
            $delete = $this->Administrator->delete_machine($id_machine);

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
                        $is_exist = $this->Administrator->check_code_line_code_machine($code_line, $code_machine);
                        if (!$is_exist) {
                            $id_machine = uniqid();
                            $data = array(
                                'id_machine'    => $id_machine,
                                'code_area'     => $code_area,
                                'code_line'     => $code_line,
                                'code_machine'  => $code_machine,
                                'name_machine'  => $name_machine,
                            );

                            $this->Administrator->upload_machine($data);
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
            redirect('administrator/machine');
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
            $session && $role == 1
        ) {
            $data = [
                'title_tab'     => 'Administrator | UOM',
                'title_page'    => 'UOM',
                'bread_crumb'   => 'UOM',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'uom'           => $this->Administrator->get_all_uom(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/material/uom/v_uom', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_uom()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'Administrator | Add UOM',
                'title_page'    => 'UOM',
                'title_card'    => 'Form Add UOM',
                'bread_crumb'   => 'Form Add UOM',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/material/uom/v_add_uom', $data);
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
        $existing_code_uom = $this->Administrator->check_code_uom($code_uom, $original_code_uom, $id_uom);

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
            $save   = $this->Administrator->save_uom();

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
            $delete = $this->Administrator->delete_uom($id_uom);

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
            $update = $this->Administrator->update_uom($id_uom);

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
            $session && $role == 1
        ) {
            $data = [
                'title_tab'     => 'Administrator | Location',
                'title_page'    => 'Location',
                'bread_crumb'   => 'Location',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'location'      => $this->Administrator->get_all_location(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/material/location/v_location', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_location()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'Administrator | Add Location',
                'title_page'    => 'Location',
                'title_card'    => 'Form Add Location',
                'bread_crumb'   => 'Form Add Location',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/material/location/v_add_location', $data);
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
        $existing_code_location = $this->Administrator->check_code_location($code_location, $original_code_location, $id_location);

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
            $save   = $this->Administrator->save_location();

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
            $update = $this->Administrator->update_location($id_location);

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
            $delete = $this->Administrator->delete_location($id_location);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }
    public function delete_material_batch()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $code_material = $data['code_material'];

            if (!empty($code_material)) {
                $delete = $this->Administrator->delete_material_batch($code_material);

                if ($delete['success']) {
                    $response = [
                        'success' => true,
                        'message' => $delete['message']
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => $delete['message']
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'No material codes provided'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'User session not found'
            ];
        }

        echo json_encode($response);
    }


    public function delete_location_batch()
    {
        $session = $this->session->userdata('username');
        $response = ['success' => false, 'message' => 'Unauthorized request'];

        if ($session) {
            $location_codes = $this->input->post('location_codes');
            if (!empty($location_codes)) {
                $delete = $this->Administrator->delete_location_batch($location_codes);

                if ($delete['success'] == true) {
                    $response = [
                        'success' => $delete['success'],
                        'message' => $delete['message']
                    ];
                } else {
                    $response['message'] = $delete['message'];
                }
            } else {
                $response['message'] = 'No location codes provided';
            }
        }

        echo json_encode($response);
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


                        // Periksa apakah kolom kosong
                        if (empty($code_location) || empty($name_location)) {
                            continue; // Lewati baris ini jika ada kolom yang kosong
                        }

                        // Periksa apakah kode lokasi sudah ada
                        $is_exist = $this->Administrator->check_code_location_upload($code_location);
                        if (!$is_exist) {
                            $id_location = uniqid();
                            $data = array(
                                'id_location'   => strtoupper($id_location),
                                'code_location' => strtoupper($code_location),
                                'name_location' => strtoupper($name_location),
                            );

                            $this->Administrator->upload_location($data);
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
            redirect('administrator/location');
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
        if ($session && $role == 1) {
            $length = 10;
            $data = [
                'title_tab'     => 'Administrator | Material List',
                'title_page'    => 'Material List',
                'bread_crumb'   => 'Material List',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'material'      => $this->Administrator->get_all_material(),
                'location'      => $this->Administrator->get_all_location()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/material/detail_material_list/v_detail_material_list', $data);
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
        if ($session && $role == 1) {

            $data = [
                'title_tab'     => 'Administrator | Goods Receive',
                'title_page'    => 'Goods Receive',
                'bread_crumb'   => 'Goods Receive',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'goods_receive' => $this->Administrator->get_all_goods_receive(),
                'uom'           => $this->Administrator->get_all_uom()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/transaction/goods_receive/v_goods_receive', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_goods_receive()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $length = 10;
            $data = [
                'title_tab'         => 'Administrator | Add Goods Receive',
                'title_page'        => 'Goods Receive',
                'title_card'        => 'Form Add Goods Receive',
                'bread_crumb'       => 'Form Add Goods Receive',
                'session'           => $this->Administrator->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
                'id_transaction'    => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length)
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/transaction/goods_receive/v_add_goods_receive', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function save_good_receive()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->Administrator->save_goods_receive();

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
            $update = $this->Administrator->update_goods_receive(); // Perbaikan: Panggil model Transaction

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
        if ($session && $role == 1) {

            $data = [
                'title_tab'     => 'Administrator | Goods Issue',
                'title_page'    => 'Goods Issue',
                'bread_crumb'   => 'Goods Issue',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'goods_issue'   => $this->Administrator->get_all_goods_issue()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/transaction/goods_issue/v_goods_issue', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function add_goods_issue()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $length = 10;
            $data = [
                'title_tab'         => 'Administrator | Add Goods Issue',
                'title_page'        => 'Goods Issue',
                'title_card'        => 'Form Add Goods Issue',
                'bread_crumb'       => 'Form Add Goods Issue',
                'session'           => $this->Administrator->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
                'id_transaction'    => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length)
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/transaction/goods_issue/v_add_goods_issue', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function save_goods_issue()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->Administrator->save_goods_issue();

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
            $update = $this->Administrator->update_goods_issue(); // Perbaikan: Panggil model Transaction

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
            $delete = $this->Administrator->delete_transaction();

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
        if ($session && $role == 1) {
            $data = [
                'title_tab'     => 'Administrator | History Transaction',
                'title_page'    => 'History Transaction',
                'bread_crumb'   => 'History Transaction',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'transaction_detail'    => $this->Administrator->get_transaction_detail()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/transaction/history/v_history', $data);
            $this->load->view('template/footer');
        }
    }
    public function delete_history_batch()
    {
        $session = $this->session->userdata('username');
        $response = ['success' => false, 'message' => 'Unauthorized request'];

        if ($session) {
            $transaction_type = $this->input->post('transaction_type');
            if (!empty($transaction_type)) {
                $delete = $this->Administrator->delete_history_batch($transaction_type);

                if ($delete['success']) {
                    $response = [
                        'success' => true,
                        'message' => $delete['message']
                    ];
                } else {
                    $response['message'] = $delete['message'];
                }
            } else {
                $response['message'] = 'No transaction types provided';
            }
        }

        echo json_encode($response); // Send JSON response back to AJAX
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
            $filtered_data = $this->Administrator->get_filtered_data($start_date, $end_date);

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
        if ($session && $role == 1) {

            $data = [
                'title_tab'     => 'Administrator | Req Order',
                'title_page'    => 'Request Order',
                'bread_crumb'   => 'Request Order',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'req_order'     => $this->Administrator->get_all_req_order()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/req_order/v_req_order', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function update_req_order($regist_no)
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $get_data_req_order     = $this->Administrator->get_data_req_order_by_regist_no($regist_no);
            $list_select_material   = $this->Administrator->get_list_select_material_req_order_by_regist_no($regist_no);
            if ($get_data_req_order) {

                $data = [
                    'title_tab'             => 'Administrator | Update Request Order',
                    'title_page'            => 'Update Request Order',
                    'title_card'            => 'Form Update Request Order',
                    'bread_crumb'           => 'Form Update Request Order',
                    'session'               => $this->Administrator->check_login($session),
                    'id_users'              => $this->session->userdata('id_users'),
                    'req_order'             => $this->Administrator->get_all_req_order(),
                    'data_req_order'        => $get_data_req_order,
                    'list_select_material'  => $list_select_material,
                    'material'              => $this->Administrator->get_all_material(),
                ];

                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/req_order/v_update_req_order', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function get_list_material_req_order_by_regist_no()
    {
        $regist_no = $this->input->post('regist_no');

        // Fetch materials based on regist_no
        $this->db->select('*');
        $this->db->from('tbl_req_order');
        $this->db->where('regist_no', $regist_no);
        $query = $this->db->get();

        $data = $query->result_array();

        // Format the response for DataTables
        $response = array(
            "data" => $data
        );

        echo json_encode($response);
    }


    public function add_req_order()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $length = 10;
            $data = [
                'title_tab'         => 'Administrator | Add Request Order',
                'title_page'        => 'Request Order',
                'title_card'        => 'Form Add Request Order ',
                'bread_crumb'       => 'Form Add Request Order',
                'session'           => $this->Administrator->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
                'id_req_order'      => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length),
                'material'          => $this->Administrator->get_all_material(),
                // 'no_ppbj'           => $this->Administrator->create_no_ppbj()

            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/req_order/v_add_req_order', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function generate_no_ppbj()
    {
        $department = $this->input->post('department');

        // Determine the appropriate department code
        $department_code = 'MAINTENACE';
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
        $no_ppbj = $this->Administrator->create_no_ppbj($department_code);

        if ($no_ppbj) {
            echo json_encode(['success' => true, 'no_ppbj' => $no_ppbj]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function add_material_for_req_order()
    {
        $session = $this->session->userdata('username');
        $role = $this->session->userdata('id_role');
        if ($session && $role == 1) {

            $code_area = $this->input->get('code_area');
            $data = [
                'title_tab'     => 'Administrator | Add Material For Request Order',
                'title_page'    => 'Add Material For Request Order',
                'title_card'    => 'Form Add Material For Request Order',
                'bread_crumb'   => 'Form Add Material For Request Order',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'category'      => $this->Administrator->get_all_category(),
                'area'          => $this->Administrator->get_all_area(),
                'line'          => $this->Administrator->get_line_by_area($code_area),
                'machine'       => $this->Administrator->get_machine_by_line(),
                'uom'           => $this->Administrator->get_all_uom(),
                'location'      => $this->Administrator->get_all_location(),
            ];

            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('Administrator/sidebar/v_sidebar', $data);
                $this->load->view('Administrator/req_order/v_add_material_for_req_order', $data);
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

        $existing_register_no = $this->Administrator->check_register_no($register_no, $original_register_no, $regist_no);

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

            if ($material_data === null && json_last_error() !== JSON_ERROR_NONE) {
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


    // public function save_req_order()
    // {
    //     // date_default_timezone_set("Asia/Jakarta");
    //     // $material_data = json_decode($this->input->post('material_data'), true);

    //     // if ($material_data === null && json_last_error() !== JSON_ERROR_NONE) {
    //     //     // Handle JSON decoding error if needed
    //     //     $response = ['error' => 'Failed to decode JSON data'];
    //     //     header('Content-Type: application/json; charset=utf-8');
    //     //     echo json_encode($response);
    //     //     return;
    //     // }

    //     // $register_no    = strtoupper($this->input->post('register_no'));

    //     // Generate unique regist_no once for the entire input session
    //     if (!empty($register_no)) {
    //         $regist_no = md5($register_no);
    //     } else {
    //         $regist_no = md5(uniqid(rand(), true)); // Generate a unique MD5 hash
    //     }

    //     // foreach ($material_data as $material) {
    //     //     $material_code      = $material['material_code'];
    //     //     $item_description   = $material['item_description'];
    //     //     $quantity           = $material['quantity'];
    //     //     $uom                = $material['uom'];
    //     //     $eta                = $material['eta'];
    //     //     $category_req       = $material['category_req'];
    //     //     $remark_user        = $material['remark']['user'];
    //     //     $remark_for         = $material['remark']['for'];

    //     //     // Construct data array for each material entry
    //     //     $data = [
    //     //         'code_material'                 => strtoupper($material_code),
    //     //         'item_description'              => strtoupper($item_description),
    //     //         'quantity'                      => strtoupper($quantity),
    //     //         'uom'                           => strtoupper($uom),
    //     //         'eta'                           => $eta,
    //     //         'category_req'                  => strtoupper($category_req),
    //     //         'remark_user'                   => strtoupper($remark_user),
    //     //         'remark_for'                    => strtoupper($remark_for),
    //     //         'regist_no'                     => $regist_no,
    //     //         'register_no'                   => strtoupper($register_no),
    //     //         'date_created'                  => date('Y-m-d H:i:s'),
    //     //         'date_required'                 => $this->input->post('date_required'),
    //     //         'category_item_service'         => strtoupper($this->input->post('category_item_service')),
    //     //         'b3_product'                    => strtoupper($this->input->post('b3_product')),
    //     //         'reason'                        => strtoupper($this->input->post('reason')),
    //     //         'level_of_request'              => strtoupper($this->input->post('level_of_request')),
    //     //         'type_of_payment'               => strtoupper($this->input->post('type_of_payment')),
    //     //         'order_type'                    => strtoupper($this->input->post('order_type')),
    //     //         'attachment'                    => strtoupper($this->input->post('attachment') ? implode(', ', $this->input->post('attachment')) : ''),
    //     //         'created_by_pic'                => strtoupper($this->input->post('pic_maintenance')),
    //     //         'approved_by_manager'           => strtoupper($this->input->post('manager_maintenance')),
    //     //         'approved_by_general_manager'   => strtoupper($this->input->post('g_manager_maintenance')),
    //     //         'approved_by'                   => strtoupper($this->input->post('approved_by')),
    //     //         'requester_name'                => strtoupper($this->input->post('requester_name')),
    //     //         'no_ppbj'                       => $register_no
    //     //     ];

    //     //     // var_dump($data);
    //     //     // Insert each material entry into database
    //     //     $this->db->insert('tbl_req_order', $data);
    //     // }

    //     // Respond with JSON success message
    //     $response = [
    //         'success'   => true,
    //         'message'   => 'Data saved successfully'
    //     ];
    //     header('Content-Type: application/json; charset=utf-8');
    //     echo json_encode($response);
    // }



    public function save_update_req_order()
    {
        date_default_timezone_set("Asia/Jakarta");

        $json_data = $this->input->post('material_data');

        if ($json_data !== null && $json_data !== '') {

            $material_data = json_decode($json_data, true);
        } else {
            $material_data = null;
        }

        if ($material_data === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error if needed
            $response = ['error' => 'Failed to decode JSON data'];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            return;
        }

        // Mendapatkan regist_no dari input
        $register_no    = $this->input->post('register_no');

        $regist_no      = $this->input->post('regist_no');

        // Hapus data yang sudah ada dengan regist_no yang sama sebelum menambahkan data baru

        $this->db->where('regist_no', $regist_no);
        $this->db->delete('tbl_req_order');

        if ($register_no !== null) {
            $regist_no = md5($register_no);
        } else {
            $regist_no = md5('');
        }

        if (is_array($material_data)) {
            // Loop untuk menyimpan data baru
            foreach ($material_data as $material) {
                $material_code      = $material['material_code'];
                $item_description   = $material['item_description'];
                $quantity           = $material['quantity'];
                $uom                = $material['uom'];
                $eta                = $material['eta'];
                $category_req       = $material['category_req'];
                $remark_user        = $material['remark']['user'];
                $remark_for         = $material['remark']['for'];
                $no_ppbj            = $material['no_ppbj'];
                $status_ppbj        = $material['status_ppbj'];
                $no_sr              = $material['no_sr'];
                $status_sr          = $material['status_sr'];
                $no_pr              = $material['no_pr'];
                $status_pr          = $material['status_pr'];
                $no_po              = $material['no_po'];
                $status_po          = $material['status_po'];
                $jugdment           = $material['jugdment'];
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
                    'no_ppbj'                       => strtoupper($register_no),
                    'status_ppbj'                   => strtoupper($status_ppbj),
                    'no_sr'                         => strtoupper($no_sr),
                    'status_sr'                     => strtoupper($status_sr),
                    'no_pr'                         => strtoupper($no_pr),
                    'status_pr'                     => strtoupper($status_pr),
                    'no_po'                         => strtoupper($no_po),
                    'status_po'                     => strtoupper($status_po),
                    'jugdment'                      => strtoupper($jugdment),
                ];

                // Insert each material entry into database
                $this->db->insert('tbl_req_order', $data);
            }
        }

        // Respond with JSON success message
        $response = [
            'success'   => true,
            'message'   => 'Data saved successfully'
        ];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }


    public function delete_req_order()
    {
        $session = $this->session->userdata('username');
        $regist_no = $this->input->post('regist_no');
        if ($session) {
            $delete = $this->Administrator->delete_req_order($regist_no);

            if ($delete['success'] == true) {
                $response = [
                    'success'   => $delete['success'],
                    'message'   => $delete['message']
                ];
            }
        }
        echo json_encode($response); // Send JSON response back to AJAX
    }
    public function post_to_print_req_order()
    {
        $register_no = $this->input->post('register_no');

        if (!empty($register_no)) {
            $this->session->set_userdata('register_no', $register_no);

            // Respon sukses
            $response = [
                'success' => true,
                'message' => 'req order received successfully',
                'data' => $register_no
            ];
        } else {
            // Respon gagal jika tidak ada material codes
            $response = [
                'success' => false,
                'message' => 'No req order received'
            ];
        }

        echo json_encode($response);
    }

    public function get_req_order_by_register_no()
    {
        $regist_no      = $this->input->post('regist_no');

        $data = $this->Administrator->get_req_order_by_regist_no($regist_no);

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(array()); // Atau kirim pesan error jika tidak ada data
        }
    }

    public function update_no_status()
    {
        $id_req_order       = $this->input->post('id_req_order');
        $regist_no          = $this->input->post('regist_no');

        // Memanggil metode update_ppbj dan menyimpan hasilnya
        $update_ppbj        = $this->Administrator->update_ppbj($regist_no);
        $update_sr          = $this->Administrator->update_sr($id_req_order);
        $update_pr          = $this->Administrator->update_pr($id_req_order);
        $update_po          = $this->Administrator->update_po($id_req_order);
        $update_jugdment    = $this->Administrator->update_jugdment($id_req_order);

        // Mengatur header sebagai JSON
        $this->output->set_content_type('application/json');

        if ($update_ppbj['success'] && $update_sr['success'] && $update_pr['success'] && $update_po['success'] && $update_jugdment['success']) {
            echo json_encode([
                'success'   => true,
                'message'   => 'Data Updated Successfully'
            ]);
        } else {
            echo json_encode([
                'success'   => false,
                'message'   => 'Failed to Update Data'
            ]);
        }
    }




    public function print_req_order($regist_no)
    {
        $row_req_order      = $this->Administrator->print_req_order_by_regist_no($regist_no);
        $result_req_order   = $this->Administrator->get_print_req_order_by_regist_no($regist_no);

        $data       = [
            'title_tab'         => 'PRINT PROPOSAL PERMINTAAN BARANG & JASA',
            'row_req_order'     => $row_req_order,
            'result_req_order'  => $result_req_order
        ];

        $this->load->view('template/header', $data);
        $this->load->view('administrator/req_order/print_req_order', $data);
    }


    //------------------------------------------- PPBJ 
    public function update_ppbj($regist_no)
    {
        $session = $this->session->userdata('username');

        if ($session) {

            $regist_no      = $this->input->post('regist_no');

            $save           = $this->Administrator->update_ppbj($regist_no);

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

    //------------------------------------------- SR
    public function update_sr($id_req_order)
    {
        $session = $this->session->userdata('username');

        if ($session) {

            $save           = $this->Administrator->update_sr($id_req_order);

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

    //------------------------------------------- PR
    public function update_pr()
    {
        $session = $this->session->userdata('username');

        if ($session) {

            $id_req_order   = $this->input->post('id_req_order');

            $save           = $this->Administrator->update_pr($id_req_order);

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

    //------------------------------------------- PO
    public function update_po()
    {
        $session = $this->session->userdata('username');

        if ($session) {

            $id_req_order   = $this->input->post('id_req_order');

            $save           = $this->Administrator->update_po($id_req_order);

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


    //------------------------------------------- PO
    public function update_jugdment()
    {
        $session = $this->session->userdata('username');

        if ($session) {

            $id_req_order   = $this->input->post('id_req_order');

            $save           = $this->Administrator->update_jugdment($id_req_order);

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

    //-------------------------------- Manage Users ---------------------------------------\\

    public function manage_user()
    {
        $session    = $this->session->userdata('username');
        $role       = $this->session->userdata('id_role');
        if ($session && $role == 1) {
            $data = [
                'title_tab'     => 'Administrator | Manage User',

                'title_page'    => 'Manage User',
                'bread_crumb'   => 'Manage User',
                'session'       => $this->Administrator->check_login($session),
                'id_users'      => $this->session->userdata('id_users'),
                'users'         => $this->Administrator->get_all_users(),
                'role'          => $this->Administrator->get_all_role(),
                'category'      => $this->Administrator->get_all_category(),
                'area'          => $this->Administrator->get_all_area()
            ];
            if ($this->input->is_ajax_request()) {
                echo json_encode($data);
            } else {
                $this->load->view('template/header', $data);
                $this->load->view('template/datatable');
                $this->load->view('administrator/sidebar/v_sidebar', $data);
                $this->load->view('administrator/manage_user/v_manage_user', $data);
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
        $existing_username = $this->Administrator->check_username($username, $original_username, $id_users);

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
            $save   = $this->Administrator->save_data_users();

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
            $update     = $this->Administrator->update_data_users($id_users); // Perbaikan: Panggil model Transaction

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
            $delete = $this->Administrator->delete_users($id_users);
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
            $update     = $this->Administrator->reset_password_users($id_users);

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
        if ($session && $role == 1) {
            $data = [
                'title_tab'         => 'Administrator | Change Password',
                'title_page'        => 'Changer Password',
                'title_card'        => 'Changer Password',
                'bread_crumb'       => 'Changer Password',
                'session'           => $this->Administrator->check_login($session),
                'id_users'          => $this->session->userdata('id_users'),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/datatable');
            $this->load->view('administrator/sidebar/v_sidebar', $data);
            $this->load->view('administrator/change_password/v_change_password', $data);
            $this->load->view('template/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function save_change_password()
    {
        $session = $this->session->userdata('username');

        if ($session) {
            $save   = $this->Administrator->change_password();

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

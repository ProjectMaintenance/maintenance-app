<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$auth           = 'auth_controller/';
$administrator  = 'administrator_controller/';
$admin          = 'admin_controller/';
$users          = 'users_controller/';

$route['default_controller']                        = $auth;

$route['auth/login']                                = $auth . 'login';
$route['auth/verify_login']                         = $auth . 'verify_login';
$route['auth/get_csrf_token']                       = $auth . 'get_csrf_token';
$route['auth/logout']                               = $auth . 'logout';

//------------------------------------------------- ADMINISTRATOR -------------------------------------------------\\
$route['administrator/dashboard']                   = $administrator . 'dashboard';

$route['administrator/material_list']               = $administrator . 'material_list';
$route['administrator/get_category']                = $administrator . 'get_category';
$route['administrator/generate_material_code']      = $administrator . 'generate_material_code';
$route['administrator/add_material_list']           = $administrator . 'add_material_list';
$route['administrator/save_material']               = $administrator . 'save_material';
$route['administrator/save_update_material']        = $administrator . 'save_update_material';
$route['administrator/delete_material']             = $administrator . 'delete_material';
$route['administrator/update_material_list/(:any)'] = $administrator . 'update_material/$1';
$route['administrator/upload_material']             = $administrator . 'upload_excel_material';
// $route['administrator/posttopdf']                   = $administrator . 'post_to_pdf';
$route['administrator/posttoprintlabel']                   = $administrator . 'post_to_print_label';
// $route['administrator/print_label_pdf']             = $administrator . 'print_label_pdf';
$route['administrator/print_label']                 = $administrator . 'print_label';
$route['administrator/material_list_pdf']           = $administrator . 'material_list_pdf';
$route['administrator/delete_material_select_all']       = $administrator . 'delete_material_select_all';
$route['administrator/get_material_by_code_material'] = $administrator . 'get_material_by_code_material';


$route['administrator/category']                    = $administrator . 'category';
$route['administrator/add_category']                = $administrator . 'add_category';
$route['administrator/check_code_category']         = $administrator . 'check_code_category';
$route['administrator/save_category']               = $administrator . 'save_category';
$route['administrator/update_category']             = $administrator . 'update_category';
$route['administrator/delete_category']             = $administrator . 'delete_category';
$route['administrator/upload_category']             = $administrator . 'upload_category';

$route['administrator/area']                        = $administrator . 'area';
$route['administrator/get_area']                    = $administrator . 'get_area';
$route['administrator/add_area']                    = $administrator . 'add_area';
$route['administrator/check_code_area']             = $administrator . 'check_code_area';
$route['administrator/save_area']                   = $administrator . 'save_area';
$route['administrator/update_area']                 = $administrator . 'update_area';
$route['administrator/delete_area']                 = $administrator . 'delete_area';

$route['administrator/line']                        = $administrator . 'line';
$route['administrator/get_line_by_area']            = $administrator . 'get_line_by_area';
$route['administrator/add_line']                    = $administrator . 'add_line';
$route['administrator/check_code_line']             = $administrator . 'check_code_line';
$route['administrator/save_line']                   = $administrator . 'save_line';
$route['administrator/update_line']                 = $administrator . 'update_line';
$route['administrator/delete_line']                 = $administrator . 'delete_line';

$route['administrator/machine']                     = $administrator . 'machine';
$route['administrator/get_machine_by_line']         = $administrator . 'get_machine_by_line';
$route['administrator/add_machine']                 = $administrator . 'add_machine';
$route['administrator/check_code_machine']          = $administrator . 'check_code_machine';
$route['administrator/save_machine']                = $administrator . 'save_machine';
$route['administrator/save_update_machine']         = $administrator . 'save_update_machine';
$route['administrator/update_machine/(:any)']       = $administrator . 'update_machine/$1';
$route['administrator/delete_machine']              = $administrator . 'delete_machine';
$route['administrator/upload_machine']              = $administrator . 'upload_excel_machine';

$route['administrator/uom']                         = $administrator . 'uom';
$route['administrator/add_uom']                     = $administrator . 'add_uom';
$route['administrator/check_code_uom']              = $administrator . 'check_code_uom';
$route['administrator/save_uom']                    = $administrator . 'save_uom';
$route['administrator/update_uom']                  = $administrator . 'update_uom';
$route['administrator/delete_uom']                  = $administrator . 'delete_uom';

$route['administrator/location']                    = $administrator . 'location';
$route['administrator/add_location']                = $administrator . 'add_location';
$route['administrator/check_code_location']         = $administrator . 'check_code_location';
$route['administrator/save_location']               = $administrator . 'save_location';
$route['administrator/update_location']             = $administrator . 'update_location';
$route['administrator/delete_location']             = $administrator . 'delete_location';
$route['administrator/upload_location']             = $administrator . 'upload_excel_location';
$route['administrator/delete_location_batch']       = $administrator . 'delete_location_batch';


$route['administrator/detail_material_list']        = $administrator . 'detail_material_list';

$route['administrator/goods_receive']               = $administrator . 'goods_receive';
$route['administrator/add_goods_receive']           = $administrator . 'add_goods_receive';
$route['administrator/update_goods_receive']        = $administrator . 'update_goods_receive';
$route['administrator/save_good_receive']           = $administrator . 'save_good_receive';
$route['administrator/delete_transaction']          = $administrator . 'delete_transaction';
$route['administrator/goods_issue']                 = $administrator . 'goods_issue';
$route['administrator/add_goods_issue']             = $administrator . 'add_goods_issue';
$route['administrator/update_goods_issue']          = $administrator . 'update_goods_issue';
$route['administrator/save_good_issue']             = $administrator . 'save_goods_issue';
$route['administrator/history_transaction']         = $administrator . 'history_transaction';
$route['administrator/search_filter']               = $administrator . 'search_filter';
$route['administrator/delete_history_batch']        = $administrator . 'delete_history_batch';


$route['administrator/req_order']                   = $administrator . 'req_order';
$route['administrator/generate_no_ppbj']            = $administrator . 'generate_no_ppbj';
$route['administrator/check_register_no']           = $administrator . 'check_register_no';
$route['administrator/add_req_order']               = $administrator . 'add_req_order';
$route['administrator/update_req_order/(:any)']     = $administrator . 'update_req_order/$1';
$route['administrator/save_update_req_order']       = $administrator . 'save_update_req_order';
$route['administrator/save_req_order']              = $administrator . 'save_req_order';
$route['administrator/delete_req_order']            = $administrator . 'delete_req_order';
$route['administrator/add_material_for_req_order']  = $administrator . 'add_material_for_req_order';
$route['administrator/posttoprintreqorder']         = $administrator . 'post_to_print_req_order';
$route['administrator/print_req_order/(:any)']      = $administrator . 'print_req_order/$1';
$route['administrator/get_req_order_by_register_no'] = $administrator . 'get_req_order_by_register_no';
$route['administrator/get_list_material_req_order_by_regist_no']    = $administrator . 'get_list_material_req_order_by_regist_no';

$route['administrator/update_no_status']            = $administrator . 'update_no_status';
$route['administrator/update_ppbj']                 = $administrator . 'update_ppbj';
$route['administrator/update_sr']                   = $administrator . 'update_sr';
$route['administrator/update_pr']                   = $administrator . 'update_pr';
$route['administrator/update_po']                   = $administrator . 'update_po';
$route['administrator/update_jugdment']             = $administrator . 'update_jugdment';


$route['administrator/manage_user']                 = $administrator . 'manage_user';
$route['administrator/check_username']              = $administrator . 'check_username';
$route['administrator/save_data_users']             = $administrator . 'save_data_users';
$route['administrator/update_data_users']           = $administrator . 'update_data_users';
$route['administrator/delete_users']                = $administrator . 'delete_users';
$route['administrator/reset_password_users']        = $administrator . 'reset_password_users';
$route['administrator/change_password']             = $administrator . 'change_password';
$route['administrator/save_change_password']        = $administrator . 'save_change_password';
//------------------------------------------------- ADMINISTRATOR -------------------------------------------------\\



//------------------------------------------------- ADMIN -------------------------------------------------\\
$route['admin/dashboard']                   = $admin . 'dashboard';

$route['admin/material_list']               = $admin . 'material_list';
$route['admin/get_category']                = $admin . 'get_category';
$route['admin/generate_material_code']      = $admin . 'generate_material_code';
$route['admin/add_material_list']           = $admin . 'add_material_list';
$route['admin/save_material']               = $admin . 'save_material';
$route['admin/save_update_material']        = $admin . 'save_update_material';
$route['admin/delete_material']             = $admin . 'delete_material';
$route['admin/update_material_list/(:any)'] = $admin . 'update_material/$1';
$route['admin/upload_material']             = $admin . 'upload_excel_material';
$route['admin/posttopdf']                   = $admin . 'post_to_pdf';
$route['admin/print_label_pdf']             = $admin . 'print_label_pdf';
$route['admin/material_list_pdf']           = $admin . 'material_list_pdf';
$route['admin/delete_material_batch']       = $admin . 'delete_material_batch';
$route['admin/get_material_by_code_material'] = $admin . 'get_material_by_code_material';

$route['admin/category']                    = $admin . 'category';
$route['admin/add_category']                = $admin . 'add_category';
$route['admin/check_code_category']         = $admin . 'check_code_category';
$route['admin/save_category']               = $admin . 'save_category';
$route['admin/update_category']             = $admin . 'update_category';
$route['admin/delete_category']             = $admin . 'delete_category';
$route['admin/upload_category']             = $admin . 'upload_category';

$route['admin/area']                        = $admin . 'area';
$route['admin/get_area']                    = $admin . 'get_area';
$route['admin/add_area']                    = $admin . 'add_area';
$route['admin/check_code_area']             = $admin . 'check_code_area';
$route['admin/save_area']                   = $admin . 'save_area';
$route['admin/update_area']                 = $admin . 'update_area';
$route['admin/delete_area']                 = $admin . 'delete_area';

$route['admin/line']                        = $admin . 'line';
$route['admin/get_line_by_area']            = $admin . 'get_line_by_area';
$route['admin/add_line']                    = $admin . 'add_line';
$route['admin/check_code_line']             = $admin . 'check_code_line';
$route['admin/save_line']                   = $admin . 'save_line';
$route['admin/update_line']                 = $admin . 'update_line';
$route['admin/delete_line']                 = $admin . 'delete_line';

$route['admin/machine']                     = $admin . 'machine';
$route['admin/get_machine_by_line']         = $admin . 'get_machine_by_line';
$route['admin/add_machine']                 = $admin . 'add_machine';
$route['admin/check_code_machine']          = $admin . 'check_code_machine';
$route['admin/save_machine']                = $admin . 'save_machine';
$route['admin/save_update_machine']         = $admin . 'save_update_machine';
$route['admin/update_machine/(:any)']       = $admin . 'update_machine/$1';
$route['admin/delete_machine']              = $admin . 'delete_machine';
$route['admin/upload_machine']              = $admin . 'upload_excel_machine';

$route['admin/uom']                         = $admin . 'uom';
$route['admin/add_uom']                     = $admin . 'add_uom';
$route['admin/check_code_uom']              = $admin . 'check_code_uom';
$route['admin/save_uom']                    = $admin . 'save_uom';
$route['admin/update_uom']                  = $admin . 'update_uom';
$route['admin/delete_uom']                  = $admin . 'delete_uom';

$route['admin/location']                    = $admin . 'location';
$route['admin/add_location']                = $admin . 'add_location';
$route['admin/check_code_location']         = $admin . 'check_code_location';
$route['admin/save_location']               = $admin . 'save_location';
$route['admin/update_location']             = $admin . 'update_location';
$route['admin/delete_location']             = $admin . 'delete_location';
$route['admin/upload_location']             = $admin . 'upload_excel_location';

$route['admin/detail_material_list']        = $admin . 'detail_material_list';

$route['admin/goods_receive']               = $admin . 'goods_receive';
$route['admin/add_goods_receive']           = $admin . 'add_goods_receive';
$route['admin/update_goods_receive']        = $admin . 'update_goods_receive';
$route['admin/save_good_receive']           = $admin . 'save_good_receive';
$route['admin/delete_transaction']          = $admin . 'delete_transaction';
$route['admin/goods_issue']                 = $admin . 'goods_issue';
$route['admin/add_goods_issue']             = $admin . 'add_goods_issue';
$route['admin/update_goods_issue']          = $admin . 'update_goods_issue';
$route['admin/save_good_issue']             = $admin . 'save_goods_issue';
$route['admin/history_transaction']         = $admin . 'history_transaction';
$route['admin/search_filter']               = $admin . 'search_filter';

$route['admin/req_order']                   = $admin . 'req_order';
$route['admin/generate_no_ppbj']            = $admin . 'generate_no_ppbj';
$route['admin/check_register_no']           = $admin . 'check_register_no';
$route['admin/add_req_order']               = $admin . 'add_req_order';
$route['admin/update_req_order/(:any)']     = $admin . 'update_req_order/$1';
$route['admin/save_update_req_order']       = $admin . 'save_update_req_order';
$route['admin/save_req_order']              = $admin . 'save_req_order';
$route['admin/delete_req_order']            = $admin . 'delete_req_order';
$route['admin/print_req_order']             = $admin . 'print_Req_order';
$route['admin/add_material_for_req_order']  = $admin . 'add_material_for_req_order';
$route['admin/posttoprintreqorder']         = $admin . 'post_to_print_req_order';
$route['admin/print_req_order/(:any)']      = $admin . 'print_req_order/$1';
$route['admin/get_req_order_by_register_no'] = $admin . 'get_req_order_by_register_no';
$route['admin/get_list_material_req_order_by_regist_no'] = $admin . 'get_list_material_req_order_by_regist_no';

$route['admin/update_no_status']            = $admin . 'update_no_status';
$route['admin/update_ppbj']                 = $admin . 'update_ppbj';
$route['admin/update_sr']                   = $admin . 'update_sr';
$route['admin/update_pr']                   = $admin . 'update_pr';
$route['admin/update_po']                   = $admin . 'update_po';
$route['admin/update_jugdment']             = $admin . 'update_jugdment';

$route['admin/change_password']             = $admin . 'change_password';
$route['admin/save_change_password']        = $admin . 'save_change_password';
//------------------------------------------------- ADMIN -------------------------------------------------\\



//------------------------------------------------- USERS -------------------------------------------------\\
$route['users/get_csrf_token']              = $users . 'get_csrf_token';

$route['users/dashboard']                   = $users . 'dashboard';

$route['users/material_list']               = $users . 'material_list';
$route['users/get_category']                = $users . 'get_category';
$route['users/generate_material_code']      = $users . 'generate_material_code';
$route['users/add_material_list']           = $users . 'add_material_list';
$route['users/save_material']               = $users . 'save_material';
$route['users/upload_material']             = $users . 'upload_excel_material';
$route['users/posttopdf']                   = $users . 'post_to_pdf';
$route['users/print_label_pdf']             = $users . 'print_label_pdf';
$route['users/material_list_pdf']           = $users . 'material_list_pdf';
$route['users/get_material_by_code_material'] = $users . 'get_material_by_code_material';

$route['users/category']                    = $users . 'category';
$route['users/add_category']                = $users . 'add_category';
$route['users/check_code_category']         = $users . 'check_code_category';
$route['users/save_category']               = $users . 'save_category';
$route['users/upload_category']             = $users . 'upload_category';

$route['users/area']                        = $users . 'area';
$route['users/get_area']                    = $users . 'get_area';
$route['users/add_area']                    = $users . 'add_area';
$route['users/check_code_area']             = $users . 'check_code_area';
$route['users/save_area']                   = $users . 'save_area';
$route['users/update_area']                 = $users . 'update_area';
$route['users/delete_area']                 = $users . 'delete_area';

$route['users/line']                        = $users . 'line';
$route['users/get_line_by_area']            = $users . 'get_line_by_area';
$route['users/add_line']                    = $users . 'add_line';
$route['users/check_code_line']             = $users . 'check_code_line';
$route['users/save_line']                   = $users . 'save_line';
$route['users/update_line']                 = $users . 'update_line';
$route['users/delete_line']                 = $users . 'delete_line';

$route['users/machine']                     = $users . 'machine';
$route['users/get_machine_by_line']         = $users . 'get_machine_by_line';
$route['users/add_machine']                 = $users . 'add_machine';
$route['users/check_code_machine']          = $users . 'check_code_machine';
$route['users/save_machine']                = $users . 'save_machine';
$route['users/save_update_machine']         = $users . 'save_update_machine';
$route['users/update_machine/(:any)']       = $users . 'update_machine/$1';
$route['users/delete_machine']              = $users . 'delete_machine';
$route['users/upload_machine']              = $users . 'upload_excel_machine';

$route['users/uom']                         = $users . 'uom';
$route['users/add_uom']                     = $users . 'add_uom';
$route['users/check_code_uom']              = $users . 'check_code_uom';
$route['users/save_uom']                    = $users . 'save_uom';
$route['users/update_uom']                  = $users . 'update_uom';
$route['users/delete_uom']                  = $users . 'delete_uom';

$route['users/location']                    = $users . 'location';
$route['users/add_location']                = $users . 'add_location';
$route['users/check_code_location']         = $users . 'check_code_location';
$route['users/save_location']               = $users . 'save_location';
$route['users/update_location']             = $users . 'update_location';
$route['users/delete_location']             = $users . 'delete_location';
$route['users/upload_location']             = $users . 'upload_excel_location';

$route['users/detail_material_list']        = $users . 'detail_material_list';

$route['users/goods_receive']               = $users . 'goods_receive';
$route['users/add_goods_receive']           = $users . 'add_goods_receive';
$route['users/update_goods_receive']        = $users . 'update_goods_receive';
$route['users/save_good_receive']           = $users . 'save_good_receive';
$route['users/delete_transaction']          = $users . 'delete_transaction';
$route['users/goods_issue']                 = $users . 'goods_issue';
$route['users/add_goods_issue']             = $users . 'add_goods_issue';
$route['users/update_goods_issue']          = $users . 'update_goods_issue';
$route['users/save_good_issue']             = $users . 'save_goods_issue';
$route['users/history_transaction']         = $users . 'history_transaction';
$route['users/search_filter']               = $users . 'search_filter';

$route['users/req_order']                   = $users . 'req_order';
$route['users/generate_no_ppbj']            = $users . 'generate_no_ppbj';
$route['users/check_register_no']           = $users . 'check_register_no';
$route['users/add_req_order']               = $users . 'add_req_order';
$route['users/update_req_order/(:any)']     = $users . 'update_req_order/$1';
$route['users/save_update_req_order']       = $users . 'save_update_req_order';
$route['users/save_req_order']              = $users . 'save_req_order';
$route['users/delete_req_order']            = $users . 'delete_req_order';
$route['users/add_material_for_req_order']  = $users . 'add_material_for_req_order';
$route['users/print_req_order/(:any)']      = $users . 'print_req_order/$1';
$route['users/get_req_order_by_register_no'] = $users . 'get_req_order_by_register_no';




$route['users/change_password']             = $users . 'change_password';
$route['users/save_change_password']        = $users . 'save_change_password';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    ///check login
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }


    ///index 
    public function index()
    {

        $data = array();
        $title['title'] = 'Users Management';
        $page = 'admin/users';
        if (isset($_SESSION['search_users']) && ($_SESSION['search_users'] == "Some")) {  
            array_push($_SESSION['users_fields'], 'user_id1');
            array_push($_SESSION['users_fields'], 'user_id');
            $data['fields'] = $_SESSION['users_fields'];   
            $exclude = array('name', 'location', 'phone');
            $select = array_diff($_SESSION['users_fields'], $exclude);
            $data['users'] = getByWhere('user', $select); 
        } else { 

            $select = array('user_id1','user_id','email','password','device_type','created_date','is_active');
            $data['users'] = getByWhere('user', $select);
            $fields=array('email','password','name','phone','location','device_type','created_date','is_active'); 
            $data['fields'] = $fields;
            
        }  
        AdminView($page, $data, $title);
    }

    ///New Users
    public function AddNewUser()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);


            //             Array
            // (
            //     [user_id1] => 88
            //     [user_id] => 88603663667f5355211329451c88
            //     [social_media_type] => email
            //     [social_id] => 
            //     [email] => lok099@yopmail.com
            //     [salt] => 3126641902163196
            //     [password] => VlM2anNKYVNTZ0dmZEpVZnFGK01aQT09
            //     [auth_token] => 7909fee78ea095908fde5fd69278381a9e9f418b79bcafd8945a0a5663a898a588603663667f5355211329451c88
            //     [access_token] => 
            //     [verify_forgot_code] => 
            //     [badge] => 0
            //     [device_type] => android
            //     [user_time_zone] => Asia/Kolkata
            //     [is_admin] => 0
            //     [created_date] => 2021-02-24 14:32:06
            //     [updated_date] => 0000-00-00 00:00:00
            //     [is_active] => 1
            //     [is_deleted] => 0
            // )
            ///check form validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_id', 'User ID', 'required');
            $this->form_validation->set_rules('social_media_type', 'Social Media Type', 'required');
            $this->form_validation->set_rules('email', 'Eamil', 'required');
            $this->form_validation->set_rules('badge', 'badge', 'required');
            $this->form_validation->set_rules('user_time_zone', 'user_time_zone', 'required');
            $this->form_validation->set_rules('is_admin', 'id_admin', 'required');



            if ($this->form_validation->run() == TRUE) {

                $postData = array();
                $postData['user_id'] = $user_id;
                $postData['social_media_type'] = $social_media_type;
                $postData['social_id'] = $social_id;
                $postData['email'] = $email;
                $postData['salt'] = $salt;
                $postData['password'] = $password;
                $postData['auth_token'] = $auth_token;
                $postData['access_token'] = $access_token;
                $postData['verify_forgot_code'] = $verify_forgot_code;
                $postData['badge'] = $badge;
                $postData['device_type'] = $device_type;
                $postData['user_time_zone'] = $user_time_zone;
                $postData['is_admin'] = $is_admin;
                $postData['created_date'] = $created_date;
                $postData['updated_date'] = $updated_date;
                $postData['is_active'] = $is_active;
                $postData['is_deleted'] = $is_deleted;


                ////findData
                $findData = getByWhere('user', '*', array('email' => $email));
                if (empty($findData)) {
                    addNew('user', $postData);
                    $data = array('code' => 'success', 'message' => 'New Record Has Been Added!');
                    echo json_encode($data);
                    die;
                } else {
                    ///Success
                    $data = array('code' => 'warning', 'message' => 'Record Already Exists!');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///validation errors
                $error_array = array();
                foreach ($_POST as $key => $value) {
                    if (form_error($key)) {
                        $error_array[] = array($key, form_error($key, null, null));
                    }
                }
                $data = array('code' => 'error', 'message' => $error_array);
                echo json_encode($data);
                die;
            }
        }
    }

    ///UpdateUser
    public function UpdateUser()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            ///check form validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required');


            if ($this->form_validation->run() == TRUE) {

                $postData = array();
                $postData['email'] = $email;
                if (!empty($password)) {
                    $encryptdata = encryptData($password);
                    $postData['password'] = $encryptdata['enc_text'];
                    $postData['salt'] = $encryptdata['salt'];
                }

                ////findData
                $findData = getByWhere('user', '*', array('user_id' => $user_id));
                if ($findData) {
                    $update = updateByWhere('user', $postData, array('user_id' => $user_id));
                    if ($update) {
                        $postData = array();
                        $postData['contact_email'] = $email;
                        updateByWhere('service_provider_info', $postData, array('user_id' => $user_id));
                        ///Success
                        $data = array('code' => 'success', 'message' => 'Updated User Record');
                        echo json_encode($data);
                        die;
                    }
                } else {
                    $data = array('code' => 'warning', 'message' => 'Username Not Exists!');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///validation errors
                $error_array = array();
                foreach ($_POST as $key => $value) {
                    if (form_error($key)) {
                        $error_array[] = array($key, form_error($key, null, null));
                    }
                }
                $data = array('code' => 'error', 'message' => $error_array);
                echo json_encode($data);
                die;
            }
        }
    }

    ///GetUsersTableRecordById
    public function GetUsersTableRecordById()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $findData = getByWhere('user', '*', array('user_id1' => $user_id1));
            if ($findData) {
                ///Success
                $data = array('code' => 'success', 'data' => $findData);
                echo json_encode($data);
                die;
            } else {
                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Record Not Found!');
                echo json_encode($data);
                die;
            }
        }
    }
}

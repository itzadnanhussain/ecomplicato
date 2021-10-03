<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Providers extends CI_Controller
{
    ///check login
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
        $this->load->library('csvimport');
        $this->load->library('ObjectIdFactory');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }


    ///index 
    public function index()
    {
        $data = array();
        $title['title'] = 'Providers Management';
        $page = 'admin/providers';

        ///search filters
        if (isset($_SESSION['profile_search']) && ($_SESSION['profile_search'] == "in_completed_profile")) {
            $where = array('complete !=' => 1);
        } else {
            $where = array('complete' => 1 );
        }


        ////columns filters 
        if (isset($_SESSION['search_providers']) && ($_SESSION['search_providers'] == "Some")) {
            array_push($_SESSION['providers_fields'], 'service_provider_info_id');
            array_push($_SESSION['providers_fields'], 'user_id');
            $data['fields'] = $_SESSION['providers_fields'];
            $exclude = array('account_email', 'password', 'likes', 'contacts', 'profession');
            $select = array_diff($_SESSION['providers_fields'], $exclude);
            $data['providers'] = getByWhere('service_provider_info', $select, $where);
        } else {

            $_SESSION['search_providers'] = 'All';
            $select = array('service_provider_info_id', 'user_id', 'business_name', 'professional_field', 'address_text', 'unit_suite', 'city', 'state', 'contact_name', 'contact_email', 'contact_phone_number', 'website', 'incorrect_data', 'created_date', 'hourly_rate_id', 'is_active', 'is_paid');
            $data['providers'] = getByWhere('service_provider_info', $select, $where);
            $fields = array();
            $fields = array('account_email', 'business_name', 'password', 'professional_field', 'profession', 'address_text', 'unit_suite', 'city', 'state', 'contact_name', 'contact_email', 'contact_phone_number', 'website', 'incorrect_data', 'created_date', 'hourly_rate_id', 'is_active', 'likes', 'contacts', 'is_paid');
            $data['fields'] = $fields;
        }

       

        // echo '<pre>';
        // print_r($data['fields']);
        // echo '</pre>';
        // die;

        ///
        $data['professional_field'] = getByWhere('professional_field');
        $data['hourly_rate'] = getByWhere('hourly_rate');


        AdminView($page, $data, $title);
    }

    ///New providers
    public function AddNewProvider()
    {
        if ($this->input->is_ajax_request()) {

            extract($_POST);
            ///check form validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('account_name', 'Account Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('account_email', 'Account Email', 'required');
            $this->form_validation->set_rules('account_phone', 'Account Phone Number', 'required');
            $this->form_validation->set_rules('business_email', 'Business Email', 'required');
            $this->form_validation->set_rules('contact_name', 'Contact Name', 'required');
            $this->form_validation->set_rules('contact_email', 'Contact Email', 'required');
            $this->form_validation->set_rules('contact_phone', 'Contact Phone', 'required');
            $this->form_validation->set_rules('industry', 'Industry', 'required');
            $this->form_validation->set_rules('profession', 'Profession', 'required');
            $this->form_validation->set_rules('street', 'Street', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');

            if ($this->form_validation->run() == TRUE) {

                $postData = array();
                $postData['account_name'] = $account_name;
                $postData['username'] = $username;
                $postData['account_email'] = $account_email;
                $postData['account_phone'] = $account_phone;
                $postData['business_email'] = $business_email;
                $postData['contact_name'] = $contact_name;
                $postData['contact_email'] = $contact_email;
                $postData['contact_phone'] = $contact_phone;
                $postData['industry'] = $industry;
                $postData['profession'] = $profession;
                $postData['street'] = $street;
                $postData['city'] = $city;
                $postData['state'] = $state;
                ////findData
                $findData = getByWhere('providers', '*', array('username' => $username));
                if (empty($findData)) {
                    addNew('providers', $postData);
                    ///Success
                    $data = array('code' => 'success', 'message' => 'Added New Providers Successfully!');
                    echo json_encode($data);
                    die;
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Username Already Exists!');
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
    public function UpdateProvider()
    {

        if ($this->input->is_ajax_request()) {

            extract($_POST);

            ///check form validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contact_name', 'contact_name', 'required');
            $this->form_validation->set_rules('contact_phone_number', 'contact_phone_number', 'required');
            $this->form_validation->set_rules('address_text', 'address_text', 'required');
            $this->form_validation->set_rules('city', 'city', 'required');
            $this->form_validation->set_rules('state', 'state', 'required');
            // $this->form_validation->set_rules('hourly_rate_id', 'hourly_rate_id', 'required');
            // $this->form_validation->set_rules('professional_field', 'professional_field', 'required');


            if ($this->form_validation->run() == TRUE) {

                $postData = array();
                $postData['contact_name'] = $contact_name;
                $postData['contact_phone_number'] = $contact_phone_number;

                ///call Google Api 
                $input = $address_text . ' ' . $city . ' ' . $state;


                $res = LatitudeAndLangitude($input);

                if (isset($res) && !empty($res->candidates)) {
                    $postData['address_text'] = $res->candidates[0]->formatted_address;
                    $postData['address_lat'] = $res->candidates[0]->geometry->location->lat;
                    $postData['address_lng'] = $res->candidates[0]->geometry->location->lng;
                } else {
                    $postData['address_text'] = $address_text;
                }

                $postData['city'] = $city;
                $postData['state'] = $state;
                $postData['is_paid'] = $is_paid;
                $postData['complete'] = $complete;

                if (isset($hourly_rate_id)) {
                    $postData['hourly_rate_id'] = $hourly_rate_id;
                }
                if (isset($professional_field)) {
                    $postData['professional_field'] = $professional_field;
                }



                ////findData
                $findData = getByWhere('service_provider_info', '*', array('service_provider_info_id' => $service_provider_info_id));
                if ($findData) {
                    updateByWhere('service_provider_info', $postData, array('service_provider_info_id' => $service_provider_info_id));

                    ///check hourly rate
                    if (isset($professional_field) && !empty($professional_field)) {
                        $this->findProfessionId('service_provider_info', $service_provider_info_id, $professional_field);
                    }
                    if (isset($hourly_rate_id) && !empty($hourly_rate_id)) {
                        $this->findHourlyRate('service_provider_info', $service_provider_info_id, $hourly_rate_id);
                    }
                    ///check profession id
                    ///Success
                    $data = array('code' => 'success', 'message' => 'Providers Updated Successfully!');
                    echo json_encode($data);
                    die;
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Not Provider Updated');
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

    ///GetprovidersTableRecordById
    public function GetprovidersTableRecordById()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $findData = getByWhere('service_provider_info', '*', array('service_provider_info_id' => $service_provider_info_id));
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


    ///GetAvailbilityTableRecordById
    public function GetAvailbilityTableRecordById()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $findData = getByWhere($table, '*', array('service_provider_availability_id' => $service_provider_availability_id));
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


    ///GetProfessionTableRecordById
    public function GetProfessionTableRecordById()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $findData = getByWhere($table, '*', array('service_provider_profession_id' => $service_provider_profession_id));
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


    ///GetContactTableRecordById
    public function GetContactTableRecordById()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $findData = getByWhere($table, '*', array('service_provider_contact_id' => $service_provider_contact_id));
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

    ///GetProviderDetails
    public function GetProviderDetails()
    {


        $user_id = $this->uri->segment(3);
        $user_id =  base64_decode(urldecode($user_id));
        $data = array();
        $data['availbility'] = getByWhere('service_provider_availability', '*', array('user_id' => $user_id));
        $data['profession'] = getByWhere('service_provider_profession', '*', array('user_id' => $user_id));
        $data['contact'] = getByWhere('service_provider_contact', '*', array('user_id' => $user_id));
        $data['professional_list'] = getByWhere('professional_field');

        $data['user_id'] = $user_id;


        $title['title'] = 'Providers Management';
        $page = 'admin/providers_details';
        AdminView($page, $data, $title);
    }



    ///UpdateAvailbility
    public function UpdateAvailbility()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $update = updateByWhere('service_provider_availability', $data, array('service_provider_availability_id' => $service_provider_availability_id));
            if ($update) {
                ///Success
                $data = array('code' => 'success', 'message' => 'Record Updated!');
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


    ///UpdateProfession
    public function UpdateProfession()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $data['profession_id'] = $profession_id;
            $check = getByWhere('service_provider_profession', '*', array('profession_id' => $profession_id, 'user_id' => $user_id));
            if (empty($check)) {
                $update = updateByWhere('service_provider_profession', $data, array('service_provider_profession_id' => $service_provider_profession_id));
                ///Success
                $data = array('code' => 'success', 'message' => 'Record Updated!');
                echo json_encode($data);
                die;
            } else {
                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Record Already Exists');
                echo json_encode($data);
                die;
            }
        }
    }


    ///AddNewProfessionName
    public function AddNewProfessionName()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);



            $data['profession_id'] = $profession_id;
            $data['user_id'] = $user_id;
            $findData = getByWhere('service_provider_profession', '*', array('profession_id' => $profession_id, 'user_id' => $user_id));


            if (empty($findData)) {

                addNew('service_provider_profession', $data);
                $res = $this->findProfession('service_provider_info', $user_id);
                if ($res == 1) {
                    ///Success
                    $data = array('code' => 'success-1', 'message' => 'Record Added!');
                    echo json_encode($data);
                    die;
                }
            } else {

                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Record Already Exists!');
                echo json_encode($data);
                die;
            }
        }
    }
    
    ///AddNewContact
    public function AddNewContact()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            $postData['user_id'] = $user_id;
            $postData['contact_name'] = $contact_name;
            $postData['contact_email'] = $contact_email;
            $postData['contact_phone_number'] = $contact_phone_number;

            $findData = getByWhere('service_provider_contact', '*', array('user_id' => $user_id, 'contact_email' => $contact_email, 'contact_phone_number' => $contact_phone_number));
            if (empty($findData)) {
                addNew('service_provider_contact', $postData);
                $res = $this->findContact('service_provider_info', $user_id);
                ///Success
                if ($res == 1) {
                    ///Success
                    $data = array('code' => 'success-1', 'message' => 'Record Added!');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Record Already Exists!');
                echo json_encode($data);
                die;
            }
        }
    }


    ///AddNewAvailbility
    public function AddNewAvailbility()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $postData['week_day'] = $week_day;
            $postData['start_time'] = $start_time;
            $postData['end_time'] = $end_time;
            $postData['user_id'] = $user_id;

            $findData = getByWhere('service_provider_availability', '*', array('user_id' => $user_id, 'week_day' => $week_day));
            if (empty($findData)) {
                addNew('service_provider_availability', $postData);
                $res = $this->findAvailbility('service_provider_info', $user_id);
                ///Success
                if ($res == 1) {
                    ///Success
                    $data = array('code' => 'success-1', 'message' => 'Record Added!');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Record Already Exists!');
                echo json_encode($data);
                die;
            }
        }
    }


    ///UpdateProfession
    public function UpdateContact()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            $data['contact_email'] = $contact_email;
            $data['contact_name'] = $contact_name;
            $data['contact_phone_number'] = $contact_phone_number;
            $update = updateByWhere('service_provider_contact', $data, array('service_provider_contact_id' => $service_provider_contact_id));

            if ($update) {
                ///Success
                $data = array('code' => 'success', 'message' => 'Record Updated!');
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

    ///GetProfessionByParentProfessional
    public function GetProfessionByParentProfessional()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $findData = getByWhere($table, '*', array('professional_field_id' => $professional_field_id));
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

    ///import_provider
    public function import_provider()
    {
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);

        // echo '<pre>';
        // print_r($file_data);
        // echo '</pre>';
        // die;

        $old_users = array();

        foreach ($file_data as $row) {

            // if ($row['email'] == 'NorthwesternMutual@test.com') { 

                if (isset($row['email']) && !empty($row['email'])) {
                    ///step one check email 
                    $email_data = getByWhere('user', '*', array('email' => $row['email']));
                    if (empty($email_data)) {



                        // echo 'step one';
                        // die;

                        ///Set Flag 
                        $incorrectData = array();

                        ///Add New User
                        $postData = array();
                        $postData['email'] = $row['email'];
                        $postData['user_type'] = 'Provider';

                        //Get Salt And Password 
                        $encryptdata = $this->encryptData($this->getRandomString());
                        $postData['password'] = $encryptdata['enc_text'];
                        $postData['salt'] = $encryptdata['salt'];
                        $postData['created_date'] = date('Y-m-d h:i:s');
                        $last_id = addNew('user', $postData);
                        $user_id = $this->objectidfactory->getNewId($last_id);
                        $postData['auth_token'] = base64_encode($user_id . time());
                        $user_id = $last_id . $user_id . $last_id;


                        updateByWhere('user', array('user_id' => $user_id, 'auth_token' => $postData['auth_token']), array('user_id1' => $last_id));



                        /// step two check parent profession
                        $row_professional_field  = str_replace('_', ' ', $row['professional_parent']);


                        $find_professional_parrent = getByWhere('professional_field', '*', array('professional_field_value' => strtolower($row_professional_field)));

                        if (empty($find_professional_parrent)) {
                            ///Set Flag 
                            array_push($incorrectData, 'professional_field');
                            array_push($incorrectData, 'profession');
                        }



                        /// step 3 create array for child
                        if (empty(in_array('professional_field', $incorrectData))) {
                            if (!empty($row['profession_child'])) {
                                $profession_child = explode(',', $row['profession_child']); 
                                foreach ($profession_child as $key => $value) {
                                    $value = str_replace(' ', "_", $value); 
                                    $find_professional_child = getByWhere('profession', '*', array('professional_field_id' => $find_professional_parrent[0]->professional_field_id, 'profession_field_value' => strtolower($value)));
                                   
                                    
                                    if (empty($find_professional_child)) {
                                        ///Set Flag 
                                        array_push($incorrectData, 'profession');
                                    }
                                }
                            }
                        }



                        ///step 4 post data to service_info table
                        $service_provider_info = array();
                        $service_provider_info['user_id'] = $user_id;
                        $service_provider_info['profile_photo'] = (isset($row['profile_photo'])) ? $row['profile_photo'] : '';
                        $service_provider_info['business_name'] = $row['business_name'];
                        $service_provider_info['unit_suite'] = $row['unit_suite'];
                        $service_provider_info['city'] = $row['city'];
                        $service_provider_info['state'] = $row['state'];
                        $service_provider_info['website'] = (isset($row['website'])) ? $row['website'] : '';
                        $service_provider_info['created_date'] = date('Y-m-d h:i:s');


                        ///call Google Api 
                        $input = $row['address_text'] . ' ' . $row['city'] . ' ' . $row['state'];
                        $res = LatitudeAndLangitude($input);

                        if (isset($res) && !empty($res->candidates)) {
                            $service_provider_info['address_text'] = $res->candidates[0]->formatted_address;
                            $service_provider_info['address_lat'] = $res->candidates[0]->geometry->location->lat;
                            $service_provider_info['address_lng'] = $res->candidates[0]->geometry->location->lng;
                        } else {
                            $service_provider_info['address_text'] = $row['address_text'];
                            $service_provider_info['address_lat'] = $row['address_lat'];
                            $service_provider_info['address_lng'] = $row['address_lng'];
                        }


                        // if (findHourlyRate($row['hourly_rate_id']) == 0) {
                        //     array_push($incorrectData, 'hour_rate');
                        // }

                        $service_provider_info['hourly_rate_id'] = findHourlyRate($row['hourly_rate_id']);
                        $service_provider_info['contact_name'] = $row['main_contact_name'];
                        $service_provider_info['incorrect_data'] = implode(',', $incorrectData);
                        $service_provider_info['contact_email'] = $row['main_contact_email'];
                        $service_provider_info['contact_phone_number'] = $row['main_contact_phone'];
                        if (empty(in_array('professional_field', $incorrectData))) {
                            $service_provider_info['professional_field'] = $find_professional_parrent[0]->professional_field_value;
                        }

                        /// step 6 check email from table 
                        $find_user_from_service_provice_info_table = getByWhere('service_provider_info', '*', array('user_id' => $user_id));

                        //$find_user_from_service_provice_info_table = getByWhere('service_provider_info', '*', array('user_id' => 'admin@test.com'));

                        if (empty($find_user_from_service_provice_info_table)) {



                            addNew('service_provider_info', $service_provider_info);

                            /// step 7 post data to availability 
                            if (!empty($row['availability'])) {
                                $availability = explode(',', $row['availability']);
                                foreach ($availability as $key => $value) {
                                    $sub_availability = array();
                                    $sub_availability = explode('~', trim(preg_replace('/\s\s+/', ' ', $value)));
                                    $post_availbility = array();
                                    $post_availbility['user_id'] = $user_id;
                                    $post_availbility['week_day'] = (isset($sub_availability[0]) && !empty($sub_availability[0]) ? $sub_availability[0] : '');
                                    $post_availbility['start_time'] = (isset($sub_availability[1]) && !empty($sub_availability[1]) ? $sub_availability[1] : '');
                                    $post_availbility['end_time'] = (isset($sub_availability[2]) && !empty($sub_availability[2]) ? $sub_availability[2] : '');
                                    $post_availbility['created_date'] = date('Y-m-d h:i:s');
                                    addNew('service_provider_availability', $post_availbility);
                                }
                            }
                            // else {
                            //     array_push($incorrectData, 'availability');
                            // }



                            /// step 8 post data to contact 
                            if (!empty($row['additional_contact_info'])) {
                                $contact = explode(',', $row['additional_contact_info']);

                                foreach ($contact as $key => $value) {
                                    $sub_contact = array();
                                    $sub_contact = explode('~', trim(preg_replace('/\s\s+/', ' ', $value)));
                                    $post_contact = array();
                                    $post_contact['user_id'] = $user_id;
                                    $post_contact['contact_name'] = (isset($sub_contact[0]) && !empty($sub_contact[0]) ? $sub_contact[0] : '');
                                    $post_contact['contact_email'] = (isset($sub_contact[1]) && !empty($sub_contact[0]) ? $sub_contact[1] : '');;
                                    $post_contact['contact_phone_number'] = (isset($sub_contact[2]) && !empty($sub_contact[0]) ? $sub_contact[2] : '');
                                    $post_contact['created_date'] = date('Y-m-d h:i:s');

                                    addNew('service_provider_contact', $post_contact);
                                }
                            }
                            // else {
                            //     array_push($incorrectData, 'contact');
                            // }

                            ///step 9 profession table
                            if (empty(in_array('professional_field', $incorrectData))) {
                                foreach ($profession_child as $key => $value) {
                                    $value = str_replace(' ', "_", $value);
                                    $find_professional_id = getByWhere('profession', '*', array('professional_field_id' => $find_professional_parrent[0]->professional_field_id, 'profession_field_value' => strtolower($value)));
                                    if ($find_professional_id) {
                                        $profession = array();
                                        $profession['user_id'] = $user_id;
                                        $profession['profession_id'] = $find_professional_id[0]->profession_id;
                                        $profession['created_date'] = date('Y-m-d h:i:s');

                                        addNew('service_provider_profession', $profession);
                                    }
                                }
                            }

                            ///update service provider info table
                            if(empty($incorrectData))
                            {
                                updateByWhere('service_provider_info', array('incorrect_data' => implode(',', $incorrectData),'complete' => 1), array('user_id' => $user_id));

                            }else
                            { 
                                updateByWhere('service_provider_info', array('incorrect_data' => implode(',', $incorrectData)), array('user_id' => $user_id));
                                
                            }
                        }
                    } else {
                        array_push($old_users, $row['email']);
                    }
                } else {
                    ///Success
                    $data = array('code' => 'warning', 'message' => 'Please Check File Format');
                    echo json_encode($data);
                    die;
                }

            //     echo 'wait';
            //     die;
            // }
        }




        if (!empty($old_users)) {
            ///Success
            $data = array('code' => 'success', 'message' => 'Some Users Already Exists!');
            echo json_encode($data);
            die;
        } else {
            ///Success
            $data = array('code' => 'success', 'message' => 'File Has Been Imported');
            echo json_encode($data);
            die;
        }
    }


    function encryptData($plaintext)
    {
        $password = "yEfHZ18ly"; //$this->objDefaultVariable->VAR_PASSWORD_CRYPTO_KEY;
        //$password = $this->objDefaultVariable->VAR_PASSWORD_CRYPTO_KEY;

        $rand_IV = date('His', time()) . mt_rand();
        $rand_IV = str_shuffle($rand_IV);



        $encrypt_method = "AES-256-CBC";
        $secret_key = $password;

        $secret_iv = $rand_IV;
        $secret_iv_first = strrev(substr($secret_iv, 0, 5));
        $secret_iv_last = strrev(substr($secret_iv, -5));
        $secret_iv = $secret_iv_last . '9' . $secret_iv_first;
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_encrypt($plaintext, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        $d["enc_text"] = $output;
        $d["salt"] = $rand_IV;
        return $d;
    }

    function decryptData($string, $salt)
    {
        $password = "yEfHZ18ly"; //$this->objDefaultVariable->VAR_PASSWORD_CRYPTO_KEY;
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = $password;
        $secret_iv = $salt;

        $secret_iv_first = strrev(substr($secret_iv, 0, 5));
        $secret_iv_last = strrev(substr($secret_iv, -5));
        $secret_iv = $secret_iv_last . '9' . $secret_iv_first;

        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }

    function findHourlyRate($table, $service_provider_info_id, $hourly_rate_id)
    {
        $find_id = getByWhere('hourly_rate', '*', array('hourly_rate_id' => $hourly_rate_id));
        if ($find_id) {
            $findData = getByWhere('service_provider_info', '*', array('service_provider_info_id' => $service_provider_info_id));
            if ($findData) {

                $string = $findData[0]->incorrect_data;
                //
                $string = explode(',', $string);
                if (in_array('hour_rate', $string)) {

                    if (sizeof($string) == 1) {
                        $arr = array_pop($string);
                        $string = implode(',', $arr);
                    } else {
                        $arr = array_diff($string, array('hour_rate'));
                        $string = implode(',', $arr);
                    }
                    updateByWhere('service_provider_info', array('incorrect_data' => $string), array('service_provider_info_id' => $service_provider_info_id));
                }
            }
        }
    }


    function findProfessionId($table, $service_provider_info_id, $professional_field)
    {

        $find_id = getByWhere('professional_field', '*', array('professional_field_value' => $professional_field));


        if ($find_id) {
            $findData = getByWhere('service_provider_info', '*', array('service_provider_info_id' => $service_provider_info_id));
            if ($findData) {
                $string = $findData[0]->incorrect_data;
                //
                $string = explode(',', $string);
                if (in_array('professional_field', $string)) {
                    if (sizeof($string) == 1) {
                        $arr = array_pop($string);
                        $string = implode(',', $arr);
                    } else {
                        $arr = array_diff($string, array('professional_field'));
                        $string = implode(',', $arr);
                    }
                    updateByWhere('service_provider_info', array('incorrect_data' => $string), array('service_provider_info_id' => $service_provider_info_id));
                }
            }
        }
    }


    function findProfession($table, $user_id)
    {
        $findData = getByWhere($table, '*', array('user_id' => $user_id));
        if ($findData) {

            $string = $findData[0]->incorrect_data;
            //
            $string = explode(',', $string);
            if (in_array('profession', $string)) {
                if (sizeof($string) == 1) {
                    $arr = array_pop($string);
                    $string = implode(',', $arr);
                } else {
                    $arr = array_diff($string, array('profession'));
                    $string = implode(',', $arr);
                }
                updateByWhere('service_provider_info', array('incorrect_data' => $string), array('user_id' => $user_id));
            }

            return 1;
        }
    }

    function findAvailbility($table, $user_id)
    {
        $findData = getByWhere($table, '*', array('user_id' => $user_id));
        if ($findData) {

            $string = $findData[0]->incorrect_data;

            //
            $string = explode(',', $string);
            if (in_array('availability', $string)) {
                if (sizeof($string) == 1) {
                    $arr = array_pop($string);
                    $string = implode(',', $arr);
                } else {
                    $arr = array_diff($string, array('availability'));
                    $string = implode(',', $arr);
                }
                updateByWhere('service_provider_info', array('incorrect_data' => $string), array('user_id' => $user_id));
            }
        }

        return 1;
    }

    function findContact($table, $user_id)
    {
        $findData = getByWhere($table, '*', array('user_id' => $user_id));
        if ($findData) {

            $string = $findData[0]->incorrect_data;
            //
            $string = explode(',', $string);
            if (in_array('contact', $string)) {
                if (sizeof($string) == 1) {
                    $arr = array_pop($string);
                    $string = implode(',', $arr);
                } else {
                    $arr = array_diff($string, array('contact'));
                    $string = implode(',', $arr);
                }
                updateByWhere('service_provider_info', array('incorrect_data' => $string), array('user_id' => $user_id));
            }
        }

        return 1;
    }


    function GetProvidersPasswords($id)
    {
        $findData = getByWhere('user', '*', array('user_id' => $id));
        if ($findData) {
            $string = $findData[0]->password;
            $salt = $findData[0]->salt;
            $decryptData = $this->decryptData($string, $salt);
            echo '<pre>';
            print_r($decryptData);
            echo '</pre>';
            die;
        } else {
            return 'No Passwords';
        }
    }

    function getRandomString($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

}

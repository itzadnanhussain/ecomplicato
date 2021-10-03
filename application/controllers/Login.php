<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{

    ///Load Helper
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->library('ObjectIdFactory');
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
    }

    ///Login Page View
    public function index()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            ///check validation 
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            //run validation 
            if ($this->form_validation->run()) {

                //  ///Add New User
                //  $postData = array();
                //  $postData['email'] = $email;
                //  $postData['user_type'] = 'Provider';
 
                //  //Get Salt And Password 
                //  $encryptdata = $this->encryptData($password);
                //  $postData['password'] = $encryptdata['enc_text'];
                //  $postData['salt'] = $encryptdata['salt'];
                //  $postData['created_date'] = date('Y-m-d h:i:s');
                //  $last_id = addNew('user', $postData);
                // $user_id = $this->objectidfactory->getNewId($last_id);
                // $postData['auth_token'] = base64_encode($user_id . time());
                // $user_id = $last_id . $user_id . $last_id;

                
                // updateByWhere('user', array('user_id' => $user_id, 'auth_token' => $postData['auth_token']), array('user_id1' => $last_id));



                //  echo 'wait';
                //  die;

                
 

                $findData = getByWhere('user', '*', array('email' => $email));
                if ($findData) {
                    $database_pass = $this->decryptData($findData[0]->password, $findData[0]->salt);
                   


                    if ($password == $database_pass) {
                        ///set session
                        $newdata = array(
                            'user_id'  => $findData[0]->user_id,
                            'email'     => $findData[0]->email,
                            'user_type' => 'admin',
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($newdata);

                        ///users session data extra
                        //  $_SESSION['profile_search'] == 'completed_profile';



                        ///Success
                        $data = array('code' => 'success', 'message' => 'Logged in');
                        echo json_encode($data);
                        die;
                    } else {
                        ///credential not correct
                        $data = array('code' => 'warning', 'message' => 'Sorry Password Not Match');
                        echo json_encode($data);
                        die;
                    }
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Record Not Found!');
                    echo json_encode($data);
                    die;
                }
            } else {

                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Sorry some inputs are missing');
                echo json_encode($data);
                die;
                // ///validation errors
                // $error_array = array();
                // foreach ($_POST as $key => $value) {
                //     if (form_error($key)) {
                //         $error_array[] = array($key, form_error($key, null, null));
                //     }
                // }
                // $data = array('code' => 'error', 'message' => $error_array);
                // echo json_encode($data);
                // die;
            }
        } else {

            $data = array();
            $data['title'] = 'Login Page';
            $page = 'login';
            $this->load->view($page, $data);
        }
    }

    ///ForgotPassword
    public function ForgotPassword()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            ///check validation 
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('cpassword', 'Password', 'required');

            //run validation 
            if ($this->form_validation->run()) {
                if ($password == $cpassword) {
                    $findData = getByWhere('user', '*', array('email' => $email));
                    if ($findData) {

                        //Get Salt And Password 
                        $encryptdata = $this->encryptData($password);
                        $updateData['password'] = $encryptdata['enc_text'];
                        $updateData['salt'] = $encryptdata['salt']; 
                        updateByWhere('user',$updateData, array('email' => $email)); 
                         ///Success
                        $data = array('code' => 'success', 'page' => 'login', 'message' => 'Password Has Been Changed!');
                        echo json_encode($data);
                        die;
                    } else {
                        ///credential not correct
                        $data = array('code' => 'warning', 'message' => 'email Not Found!');
                        echo json_encode($data);
                        die;
                    }
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Passwords Not Match');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///credential not correct
                $data = array('code' => 'warning', 'message' => 'Sorry some inputs are missing');
                echo json_encode($data);
                die;
            }
        }
    }

    ///
    function getRandomString($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
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
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');


/////Helper Function For Login Views//////
if (!function_exists('AdminView')) {
    function AdminView($page, $data = array(), $title = array())
    {
        $thiz = &get_instance();
        $thiz->load->view('templates/ad_header', $title);
        $thiz->load->view($page, $data);
        $thiz->load->view('templates/ad_footer');
        // $thiz->load->view('templates/ad_footer',array('ad_scriptfile'=>basename($page))); 
    }
}


/////ProfessionalName//////
if (!function_exists('ProfessionalName')) {
    function ProfessionalName($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('profession', '*', array('profession_id' => $id));
        if ($findData) {
            return $findData[0]->profession_field_title;
        } else {
            return 'No Field';
        }
    }
}


/////GetProfessionalFieldId//////
if (!function_exists('GetProfessionalFieldId')) {
    function GetProfessionalFieldId($title)
    {
        $thiz = &get_instance();
        $title = strtolower($title);
        $findData = getByWhere('professional_field', '*', array('professional_field_value' => $title));
        if ($findData) {
            return $findData[0]->professional_field_id;
        } else {
            return 0;
        }
    }
}

/////ProfessionalFieldsTitle//////
if (!function_exists('ProfessionalFieldsTitle')) {
    function ProfessionalFieldsTitle($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('professional_field', '*', array('professional_field_id' => $id));
        if ($findData) {
            return $findData[0]->professional_field_title;
        } else {
            return 'No Field';
        }
    }
}


/////GetProvidersProfession//////
if (!function_exists('GetProvidersProfession')) {
    function GetProvidersProfession($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('service_provider_profession', '*', array('user_id' => $id));
        if ($findData) {
            $profession_name = array();
            foreach ($findData as $key => $value) {
                array_push($profession_name, ProfessionalName($value->profession_id));
            }

            $string = implode("~\n", $profession_name);
            return $string;
        } else {
            return 'No Profession';
        }
    }
}


/////GetProvidersPasswords//////
if (!function_exists('GetProvidersPasswords')) {
    function GetProvidersPasswords($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('user', '*', array('user_id' => $id));
        if ($findData) {
            $string = $findData[0]->password;
            $salt = $findData[0]->salt;
            $decryptData = decryptData($string, $salt);
            return $decryptData;
        } else {
            return 'No Passwords';
        }
    }
}


/////GetProvidersLikes//////
if (!function_exists('GetProvidersLikes')) {
    function GetProvidersLikes($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('tracking', 'cnt_like', array('provider_user_id' => $id));
        if ($findData) { 
            return $findData[0]->cnt_like; 
        } else {
            return  0;
        }
    }
}


/////GetProviderContactCount//////
if (!function_exists('GetProviderContactCount')) {
    function GetProviderContactCount($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('tracking', 'cnt_phone', array('provider_user_id' => $id));
        if ($findData) { 
            return $findData[0]->cnt_phone; 
        } else {
            return  0;
        }
    }
}


/////GetPaidFlag//////
if (!function_exists('GetPaidFlag')) {
    function GetPaidFlag($value)
    {
        if($value == 1)
        {
            return 'True';
        }
        else
        {
            return 'False';
        }
    }
}


/////GetProvidersAccountEmail//////
if (!function_exists('GetProvidersAccountEmail')) {
    function GetProvidersAccountEmail($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('user', '*', array('user_id' => $id));
        if ($findData) {
            return  $findData[0]->email;
        } else {
            return 'No Email';
        }
    }
}


/////GetProviderName//////
if (!function_exists('GetProviderName')) {
    function GetProviderName($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('service_provider_info', '*', array('user_id' => $id));
        if ($findData) {
            return  $findData[0]->contact_name;
        } else {
            return 'No Record';
        }
    }
}

/////GetProviderContact//////
if (!function_exists('GetProviderContact')) {
    function GetProviderContact($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('service_provider_info', '*', array('user_id' => $id));
        if ($findData) {
            return  $findData[0]->contact_phone_number;
        } else {
            return 'No Record';
        }
    }
}


/////GetProviderAddress//////
if (!function_exists('GetProviderAddress')) {
    function GetProviderAddress($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('service_provider_info', '*', array('user_id' => $id));
        if ($findData) {
            return  $findData[0]->address_text;
        } else {
            return 'No Record';
        }
    }
}


/////GetUserEmail//////
if (!function_exists('GetUserEmail')) {
    function GetUserEmail($id)
    {
        $thiz = &get_instance();
        $findData = getByWhere('user', '*', array('user_id' => $id)); 
        if ($findData) {
            return $findData[0]->email;
        } else {
            return 'No Email';
        }
    }
}


/////GetUserIdByEmail//////
if (!function_exists('GetUserIdByEmail')) {
    function GetUserIdByEmail($email)
    {
        $thiz = &get_instance();
        $findData = getByWhere('user', '*', array('email' => $email)); 
        if ($findData) {
            return $findData[0]->user_id;
        } else {
            return 'No Provider';
        }
    }
}


/////findHourlyRate//////
if (!function_exists('findHourlyRate')) {
    function findHourlyRate($rate_label)
    {
        $thiz = &get_instance();
        $findData = getByWhere('hourly_rate', '*', array('rate_label' => $rate_label));
        if ($findData) {
            return $findData[0]->hourly_rate_id;
        } else {
            return  0;
        }
    }
}

/////decryptData//////
if (!function_exists('decryptData')) {
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


////encryptData
if (!function_exists('encryptData')) {
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
}

///LatitudeAndLangitude
if (!function_exists('LatitudeAndLangitude')) {

    function LatitudeAndLangitude($input)
    {
        
        //  $input='3058 Mt Pleasant St NW, Washington, D.C., DC, USA DC DC';
        $input = str_replace(" ", "%20", $input);
        $input = str_replace("'", "%20", $input);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=' . $input . '&inputtype=textquery&fields=formatted_address,geometry&key=AIzaSyBf70DV8Km0joXYOGmzXR-jOWoZz3QstUY',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8',
                'Accept: application/json; charset=utf-8',
                'Content-Length: 0',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data;

        ////Needed Data Print
        // $address_lat=$data->candidates[0]->geometry->location->lat;
        // echo '<pre>';
        // print_r($address_lat);
        // echo '</pre>';
        // die;




    }
}

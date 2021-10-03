<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sql_script extends CI_Controller
{
      ///check login
      function __construct()
      {
          parent::__construct();
          
          ///load Helper
          $this->load->helper('functions_helper');
          $this->load->helper('queries_helper'); 
      }

    /// convert incomplete profile to complete  process
    public function Convert_incomplete_to_complete_profile()
    {
        //for all users except admin 
        // $getData = getByWhere('service_provider_info', 'user_id', array('incorrect_data !=' => ''));
         
        ///for all users except admin
        $getData = getByWhere('user', 'user_id', array('user_id !=' => '38060c9f52223384248a700017c380'));
        // $getData = getByWhere('user', 'user_id', array('user_id !=' => '760d0d6450d519723c20000077'));
       
       
        if($getData)
        {
            foreach ($getData as $key => $value) {

                deleteRecordWhere('user',array('user_id' => $value->user_id));
                deleteRecordWhere('service_provider_info',array('user_id' => $value->user_id));
                deleteRecordWhere('service_provider_availability',array('user_id' => $value->user_id));
                deleteRecordWhere('service_provider_contact',array('user_id' => $value->user_id));
                deleteRecordWhere('service_provider_profession',array('user_id' => $value->user_id));
            }
        }

        echo 'deleted';
        die;
    }
}

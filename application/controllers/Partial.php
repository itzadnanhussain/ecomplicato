<?php defined('BASEPATH') or exit('No direct script access allowed');

class Partial extends CI_Controller
{
    ///load assential things
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
    }  
    ///DeleteRecord
    public function DeleteRecord()
    {
        $table = $this->uri->segment(2);
        $field = $this->uri->segment(3);
        $value = $this->uri->segment(4);

        $check = deleteRecordWhere($table, array($field => $value));
        if ($check) {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    ///DeleteByAjax
    public function DeleteByAjax()
    {
        extract($_POST);
        $check = deleteRecordWhere($table, array($field => $value));
        if ($check == 1) {
            ///Success
            $data = array('code' => 'success');
            echo json_encode($data);
            die;
        } else {
            ///credential not correct
            $data = array('code' => 'warning');
            echo json_encode($data);
            die;
        }
    }

    ///SearchTableFieldsFilters
    public function SearchTableFieldsFiltersUsers()
    {
        extract($_POST); 
        if ($condition == 'All') {
            unset($_SESSION['search_users']); 
            $_SESSION['search_users'] = 'All';
        } else if ($condition == 'Some') {
            unset($_SESSION['search_users']);
            unset($_SESSION['users_fields']);
            $_SESSION['search_users'] = 'Some';
            $_SESSION['users_fields'] = $fields;
        } 
        ///Success
        $data=array('code'=>'success','message'=>'Record Searched!');
        echo json_encode($data);
        die;
    } 

    ///SearchTableFieldsArticles
    public function SearchTableFieldsFiltersArticles()
    {
        extract($_POST); 
        if ($condition == 'All') {
            unset($_SESSION['search_articles']);
            $_SESSION['search_articles'] = 'All';
        } else if ($condition == 'Some') {
            unset($_SESSION['search_articles']);
            unset($_SESSION['articles_fields']);
            $_SESSION['search_articles'] = 'Some';
            $_SESSION['articles_fields'] = $fields;
        } 
        ///Success
        $data=array('code'=>'success','message'=>'Record Searched!');
        echo json_encode($data);
        die;
    } 

    ///SearchTableFieldsArticles
    public function SearchTableFieldsFiltersProviders()
    {
        extract($_POST); 
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // die;

        if($profile_search == 'completed_profile')
        {
            $_SESSION['profile_search'] = 'completed_profile';

        }else
        {
            $_SESSION['profile_search'] = 'in_completed_profile';
        }


        if ($condition == 'All') {
            unset($_SESSION['search_providers']);
            $_SESSION['search_providers'] = 'All';
        } else if ($condition == 'Some') {
            unset($_SESSION['search_providers']);
            unset($_SESSION['providers_fields']);
            $_SESSION['search_providers'] = 'Some';
            $_SESSION['providers_fields'] = $fields;
        } 
        ///Success
        $data=array('code'=>'success','message'=>'Record Searched!');
        echo json_encode($data);
        die;
    }
}

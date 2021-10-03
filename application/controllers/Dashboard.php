<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    ///check login
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
    }

    ///dashboard
    public function index()
    {
        
        $data = array();
        $title['title'] = 'Dashboard';
        $page = 'admin/dashboard';
        $data['user']=getByWhere('user'); 
        $data['article']=getByWhere('article'); 
        $data['provider']=getByWhere('service_provider_info'); 
        AdminView($page, $data, $title);
    }



    ////Logout
    public function Logout()
    {
        session_destroy();
        redirect('login');
    }
}

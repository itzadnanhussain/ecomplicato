<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Articles extends CI_Controller
{

    ///check login
    function __construct()
    {
        parent::__construct();
        ///load Helper
        $this->load->helper('functions_helper');
        $this->load->helper('queries_helper');
        $this->load->library('csvimport');
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
    }


    ///index 
    public function index()
    {
        $data = array();
        $title['title'] = 'Articles Management';
        $page = 'admin/articles';
        if (isset($_SESSION['search_articles']) && ($_SESSION['search_articles'] == "Some")) {
            $select = array('article_id ');
            foreach ($_SESSION['articles_fields'] as $key => $value) {
                array_push($select, $value);
            }
            $data['fields_head'] = $select;
            $data['articles'] = getByWhere('article', $select);
        } else {
            $data['articles'] = getByWhere('article');
            $data['fields_head'] = $this->db->list_fields('article');
            // array_push($data['fields_head'], 'Email');

        }
        $fields = $this->db->list_fields('article');
        array_splice($fields, 0, 1); //remove second element, re-index array
        $data['fields'] = $fields;
        $data['users'] = getByWhere('user');
        $data['professional_list'] = getByWhere('professional_field');



        AdminView($page, $data, $title);
    }



    ///New Articles
    public function AddNewArticles()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);

            

            ///check form validation
            $this->load->library('form_validation');
            // $this->form_validation->set_rules('user_id', 'user_id', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_rules('link', 'link', 'required');
            $this->form_validation->set_rules('professional_field_id', 'professional_field_id', 'required');

            // if (empty($_FILES['photo']['name'])) {
            //     $this->form_validation->set_rules('photo', 'Document', 'required');
            // }


            if ($this->form_validation->run() == TRUE) {
                $postData = array();
                
               

                $postData['user_id'] = $this->session->userdata('user_id');
                $postData['title'] = $title;
                $postData['description'] = $description;
                $postData['link'] = $link;
                $postData['professional_field_id'] = $professional_field_id;
                $postData['is_admin'] = 1;

                ///image 
                // if (isset($_FILES['photo']) && $_FILES['photo']['name'] != "") {
                //     $path = 'assets/articles/';
                //     if (!is_dir($path)) {
                //         mkdir($path, 0777, true);
                //     }
                //     $config['upload_path'] = FCPATH . $path;
                //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //     $this->load->library('upload', $config);
                //     if (!$this->upload->do_upload('photo')) {
                //         $error = array('error' => $this->upload->display_errors());
                //         echo $error;
                //         die;
                //     } else {
                //         $data1 = $this->upload->data();
                //         $postData['photo'] = $path . $data1['file_name'];
                //     }
                // }




                ////findData
                $findData = getByWhere('article', '*', array('article_id' => 0));
                if (empty($findData)) {
                    addNew('article', $postData);
                    ///Success
                    $data = array('code' => 'success', 'message' => 'Added New Account Successfully!');
                    echo json_encode($data);
                    die;
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Account Already Exists!');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///validation errors
                $error_array = array();
                foreach (array_merge($_POST, $_FILES) as $key => $value) {
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
    public function UpdateArticles()
    {

        if ($this->input->is_ajax_request()) {
            extract($_POST);
           


            ///check form validation
            $this->load->library('form_validation');
            // $this->form_validation->set_rules('user_id', 'user_id', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_rules('link', 'link', 'required');
            $this->form_validation->set_rules('professional_field_id', 'professional_field_id', 'required');

            // if (empty($_FILES['photo']['name'])) {
            //     $this->form_validation->set_rules('photo', 'Document', 'required');
            // }


            if ($this->form_validation->run() == TRUE) {
                $postData = array();

                //  $postData['user_id'] = $user_id;
                $postData['title'] = $title;
                $postData['description'] = $description;
                $postData['link'] = $link;
                $postData['professional_field_id'] = $professional_field_id;

                ///image 
                // if (isset($_FILES['photo']) && $_FILES['photo']['name'] != "") {
                //     $path = 'assets/articles/';
                //     if (!is_dir($path)) {
                //         mkdir($path, 0777, true);
                //     }
                //     $config['upload_path'] = FCPATH . $path;
                //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //     $this->load->library('upload', $config);
                //     if (!$this->upload->do_upload('photo')) {
                //         $error = array('error' => $this->upload->display_errors());
                //         echo $error;
                //         die;
                //     } else {
                //         $data1 = $this->upload->data();
                //         $postData['photo'] = $path . $data1['file_name'];
                //     }
                // }




                ////findData
                $findData = getByWhere('article', '*', array('article_id' => $article_id));
                if ($findData) {
                    updateByWhere('article', $postData, array('article_id' => $article_id));
                    ///Success
                    $data = array('code' => 'success', 'message' => 'Record Updated Successfully!');
                    echo json_encode($data);
                    die;
                } else {
                    ///credential not correct
                    $data = array('code' => 'warning', 'message' => 'Record Not Exists!');
                    echo json_encode($data);
                    die;
                }
            } else {
                ///validation errors
                $error_array = array();
                foreach (array_merge($_POST, $_FILES) as $key => $value) {
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

    ///GetArticlesTableRecordById
    public function GetArticlesTableRecordById()
    {
        if ($this->input->is_ajax_request()) {
            extract($_POST);
            $findData = getByWhere('article', '*', array('article_id' => $article_id));

            if ($findData) {

                ///Success
                $data = array('code' => 'success', 'data' => $findData, 'professional_field_id' => ProfessionalName($findData[0]->professional_field_id));
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
    public function import_article()
    {
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
         
        
       
        $items = ''; 
        $items_flag = FALSE;
        foreach ($file_data as $row) { 
            ///Add New User
            $postData = array(); 
            $user_id = GetUserIdByEmail($row['Provider_Email']); 
            if($user_id != 'No Provider')
            {  
                $postData['user_id'] = $user_id;
                $postData['title'] = $row['title'];
                $postData['description'] = $row['description'];
                $postData['photo'] = $row['photo'];
                $postData['link'] = $row['link'];
                $postData['is_admin'] = 1;
                $postData['professional_field_id'] = GetProfessionalFieldId($row['professional_field_id']);
                
                addNew('article',$postData); 
            }
            else
            {
                $items = $items . '<li>'.$row['Provider_Email'].'</li>'; 
                $items_flag = TRUE;

            }
            
        }

       

        if($items_flag == FALSE)
        { 
            ///Success
            $data=array('code'=>'success','message'=>'File Data Has Been Imported!');
            echo json_encode($data);
            die;
        }
        else
        {  
            ///Success
            $data=array('code'=>'success','message'=>'some users not registered in the system');
            echo json_encode($data);
            die;
        }
    }
}

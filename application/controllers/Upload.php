<?php

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper('date');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function do_upload()
    {
        $config=array();
        $config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'zip';
        $config['file_name']            = $_FILES['userfile']['name'];

        $this->upload->initialize( $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {

            $data = $this->upload->data();
            $this->load->library('image_lib');
            $config=array();
            $config['image_library']  = 'GD2';
            $config['source_image']   = 'upload/'.$data['file_name'];
            $config['create_thumb']   = false;
            $config['maintain_ratio'] = true;
            $config['quality']        = 70;
            $config['width']          = 500;

            $this->image_lib->initialize($config);
            $thumb_image = $this->image_lib->resize();
            $this->load->model('upload_model');
            $this->upload_model->insert_data($config);
                        // if ($thumb_image) {
                        //         $this->load->library('image_lib');
                        //         $config=array();
                        //         $config['image_library']  = 'GD2';
                        //         $config['source_image']   = 'upload/'.$data['file_name'];
                        //         $config['create_thumb']   = true;
                        //         $config['maintain_ratio'] = true;
                        //         $config['quality']        = 90;
                        //         $config['new_image']      = 'thumbs/';
                        //         $config['width']          = 200;
                        //         $this->image_lib->initialize($config);
                        //         $this->image_lib->resize();
                        // }

            $this->session->set_flashdata('msg', 'Image Upload Success');
            $error = array('error' => 'Image Upload successfull!');
            $this->load->view('upload_form',$error);

        }

    }
    public function show_image()
    {
        $this->load->model('upload_model');
        $data['images'] = $this->upload_model->view_image();
        $this->load->view('upload_success',$data);
    }
    public function download($token)
    {       
            $user_id = $this->input->post('user_id');
            $product_id = $this->input->post('product_id');
            $expiry_date = $this->input->post(' expiry_date');
            $this->load->model('download');
            $this->download->insert_info($user_id,$product_id,$token,$expiry_date);

            if ( $this->session->userdata('email') != '') {
                $this->load->helper('download');
                $this->db->select('filepath');
                $this->db->from('download_log');
                $this->db->where('user_id',$user_id);
                $this->db->where('token',$token);
                $this->db->where('product_id',$product_id);
                $query = $this->db->get();
                $file = $query->row();
                force_download($file->filepath, NULL);
                redirect(base_url('show-image'));
            }
            else{
                  redirect(base_url());
            }      
        

    }
    public function login()
    {
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->model('login_model');
        $user = $this->login_model->check_validity($email,$password);
         
        if ($user) {
            $data= array(
                   'id' => $user->id,
                   'email' => $user->email
                   
            );

            $this->session->set_userdata($data);
            
           redirect(base_url('home'));

        }else{
            redirect(base_url());
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id');
        redirect(base_url());
    }
    public function home()
    {
        $this->load->view('upload_form', array('error' => '' ));
    }
}
?>
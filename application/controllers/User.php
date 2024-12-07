<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('string');
    }

    public function index()
    {
    	$data['captcha'] = $this->create_captcha();
        $this->load->view('add_user',$data);
    }

    public function save_user()
    {
    	
       	if ($this->input->post($this->security->get_csrf_token_name()) !== $this->security->get_csrf_hash()) {
            show_error('CSRF token mismatch. Please try again.', 400);
            return;
        }
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pin', 'PIN', 'trim|required|exact_length[6]|numeric');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_check_captcha');

        if ($this->form_validation->run() == FALSE) {
        	$data['captcha'] = $this->create_captcha();
        	$this->load->view('add_user',$data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'dob' => $this->input->post('dob'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'pin' => $this->input->post('pin')
            );
            $results = $this->user_model->insert_user($data);
            if (!empty($results)) {
                $this->session->set_flashdata('success', 'Data has been successfully inserted!');
            	redirect(base_url());
            }else{
            	$this->session->set_flashdata('error', 'There was a problem inserting the data.');
            	redirect(base_url());
            }
            
        }
    }


    

    public function check_captcha($captcha)
    {

    	$captcha_word = $this->session->userdata('captcha_word');
        // Validate CAPTCHA
        if ($captcha != $captcha_word['word']) {
            $this->form_validation->set_message('check_captcha', 'Captcha is incorrect');
            return FALSE;
        }
        return TRUE;
    }

    public function refresh_captcha()
    {
        $captcha = $this->create_captcha();
        echo json_encode([
            'captcha_image' => $captcha['image'],
            'captcha_word' => $captcha['word']
        ]);
    }

    private  function create_captcha(){
    	$img_path = './assets/captcha/';
        $img_url = base_url() . 'assets/captcha/';
        $font_path = './system/fonts/texb.ttf';  
        
        if (!is_dir($img_path)) {
            mkdir($img_path, 0777, true); 
        }
        $captcha = create_captcha('',$img_path,$img_url,$font_path);  
        $this->session->set_userdata('captcha_word', $captcha);  
        return $captcha;
    }


    public function user_list()
    {
       	$data['results'] = $this->user_model->get_user_data();
        $this->load->view('user_list',$data);
    }

}

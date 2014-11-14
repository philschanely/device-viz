<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

        
    public function __construct()
    {
        parent::__construct();
        ENVIRONMENT == 'development' ? $this->output->enable_profiler(TRUE) : TRUE;
        $this->load->model('user_model');
    }    
        
    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        $this->user_model->check_for_auth(FALSE);
        show_view('temporary', $this->dso->all);
    }
    
    public function create()
    {
        if ($this->input->post('submit-createuser'))
        {
            $this->user_model->create();
        }
        show_view('user/create', $this->dso->all);
    }
    
    public function disabled()
    {
        $this->user_model->check_for_auth(FALSE);
        show_view('user/disabled', $this->dso->all);
    }
    
    public function login()
    {
        if ($this->input->post('submit-login'))
        {
            $this->user_model->login();
        }
        else
        {
            $this->dso->show_login = FALSE;
        }
        $this->dso->returnto = ($this->input->get('returnto')) ? $this->input->get('returnto') : '';
        show_view('user/login', $this->dso->all);
    }
    
    public function logout()
    {
        $this->session->set_userdata('user', NULL);
        redirect(base_url() . URL_LOGIN);
    }
    
    public function pending()
    {
        show_view('user/pending', $this->dso->all);
    }
    
    public function resend_verification()
    {
        show_view('user/resend_verification', $this->dso->all);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
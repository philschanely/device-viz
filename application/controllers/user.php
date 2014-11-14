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
        $this->user_model->check_for_auth();
        $this->dso->page_title = 'User Information';
        show_view('temporary', $this->dso->all);
    }
    
    /** TEMPORARY
     * Delete a user
     * @param int $user_id
     * @param string $code
     
    public function delete($user_id, $code)
    {
        $this->dso->page_title = 'Delete a user';
        if (md5($code) == 'ec5287c45f0e70ec22d52e8bcbeeb640')
        {
            ep('Deleteing user: ' . $user_id);
            $this->user_model->delete($user_id);
        }
    }
     * 
     */
    
    public function disabled()
    {
        $this->user_model->check_for_auth(FALSE);
        $this->dso->page_title = 'User disabled';
        show_view('user/disabled', $this->dso->all);
    }
    
    public function login()
    {
        $this->load->library('form_validation');
        $this->dso->page_title = 'Log in';
        $this->dso->show_login = FALSE;
        $this->dso->returnto = ($this->input->get('returnto')) ? $this->input->get('returnto') : '';
               
        if ($this->form_validation->run() == FALSE)
        {
            show_view('user/login', $this->dso->all);
        }
        else
        {
           $logged_in = $this->user_model->login();
           if (!$logged_in)
           {
               show_view('user/login', $this->dso->all);
           }
        }
    }
    
    public function logout()
    {
        $this->session->set_userdata('user', NULL);
        $this->dso->page_title = 'Log out';
        redirect(base_url() . URL_LOGIN);
    }
    
    public function pending()
    {
        $this->user_model->check_for_auth(FALSE);
        $this->dso->page_title = 'Pending verification';
        
        show_view('user/pending', $this->dso->all);
    }
    
    public function resend_verification($user_id)
    {
        $this->dso->page_title = 'Resend verification';
        $user = $this->user_model->get($user_id);
        $this->_send_verification_email($user);
        
        show_view('user/resend_verification', $this->dso->all);
    }
    
    public function signup()
    {
        $this->load->library('form_validation');
        $this->dso->page_title = 'Sign up for a free account';
            
        if ($this->form_validation->run() == FALSE)
        {
            show_view('user/signup', $this->dso->all);
        }
        else
        {
            $user = $this->user_model->signup();
            
            if ($user)
            {
                $this->_send_verification_email($user);
                show_view('user/pending', $this->dso->all);
            }
            else
            {
                add_feedback('Invalid account details. Please try again.', 'error');
                show_view('user/signup', $this->dso->all);
            }
        }
    }
    
    public function verify($user_id, $code)
    {
        $this->dso->page_title = 'Verify your account';
        $verified = $this->user_model->verify($user_id, $code);
        if ($verified)
        {
            redirect(base_url() . URL_DASHBOARD);
        } 
        else
        {
            redirect(base_url() . URL_PENDING);
        }
    }
    
    private function _send_verification_email($user)
    {
        $this->dso->user = $user;
        $this->dso->code = $user->action_code;

        $view_stack = array();
        $view_stack[] = 'email/head';
        $view_stack[] = 'email/verify';
        $view_stack[] = 'email/foot';

        $message = show_view($view_stack, $this->dso->all, FALSE, FALSE, TRUE);

        $this->load->library('email');

        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('service@philschanely.com', 'DeviceViz Administrator');
        $this->email->to($user->email);
        $this->email->subject('DeviceViz Account Verification');
        $this->email->message($message);
        $this->email->send();
        
        #echo $this->email->print_debugger();
        
        return TRUE;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
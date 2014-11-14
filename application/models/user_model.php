<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Access Level Model
 *
 * Details to come.
 *
 * @package    Thorin
 * @subpackage Models
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        if ($email && $password)
        {
            $data = array(
                'email'=>$email,
                'password'=>md5($password)
            );
            $this->db->where($data);
            $valid_user = checkForResults($this->db->get('user'), 'row');
            
            if ($valid_user)
            {
                $this->dso->message .= 'Valid user!';
                $this->db->where('user_id', $valid_user->user_id);
                $user = checkForResults($this->db->get('user_details'), 'row');
                $this->session->set_userdata('user', $user);
                $this->check_for_auth();
            }
            else
            {
                $this->dso->message .= 'Invalid username or password. Please try again.';
            } 
        }
        else
        {
            $this->dso->message .= 'Please provide both your email address and your password.';
        }
    }
    
    public function get()
    {
        return TRUE;
    }
    
    public function check_for_auth($force=TRUE)
    {
        // If user is in session assign to DSO for access
        if ($this->session->userdata('user'))
        {
            $user = $this->session->userdata('user');
            $this->dso->user = $user;
            switch ($user->status_id)
            {
                case STATUS_OK:
                    $this->dso->auth = TRUE;
                    $this->dso->show_login = FALSE;
                    $this->dso->show_acct_options = TRUE;
                    if ($this->input->post('returnto'))
                    {
                        redirect(base_url() . $this->input->post('returnto'));
                    }
                    elseif (uri_string() == URL_LOGIN)
                    {
                        redirect(base_url() . URL_DASHBOARD);
                    }
                    break;
                case STATUS_PENDING:
                    if (uri_string() != URL_PENDING) redirect(base_url() . URL_PENDING);
                    break;
                case STATUS_DISABLED:
                default:
                    if (uri_string() != URL_DISABLED) redirect(base_url() . URL_DISABLED);
                    break;
            }
        }
        // Redirect if user is not authenticated and force is set
        if (!$this->dso->auth && $force)
        {
            redirect(base_url() . URL_LOGIN);
        }
    }
}
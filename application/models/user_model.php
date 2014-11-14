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
                    if (uri_string() != URL_PENDING && $force) redirect(base_url() . URL_PENDING);
                    break;
                case STATUS_DISABLED:
                default:
                    if (uri_string() != URL_DISABLED && $force) redirect(base_url() . URL_DISABLED);
                    break;
            }
        }
        // Redirect if user is not authenticated and force is set
        if (!$this->dso->auth && $force)
        {
            redirect(base_url() . URL_LOGIN);
        }
    }
    
    public function delete($user_id)
    {
        switch ($user_id)
        {
            case 'all':
                $this->db->where('user_id > 1');
                break;
            default:
                $this->db->where('user_id', $user_id);
                break;
        }
        $this->db->delete('User');
    }
    
    public function get($user_id)
    {
        $this->db->where('user_id', $user_id);
        $user = checkForResults($this->db->get('User_Details'), 'row');
        return $user;
    }
    
    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        if ($email && $password)
        {
            $this->db->select('user_id');
            $data = array(
                'email'=>$email,
                'password'=>md5($password)
            );
            $this->db->where($data);
            $valid_user = checkForResults($this->db->get('User'), 'row');
            
            if ($valid_user)
            {
                $user = $this->get($valid_user->user_id);
                $this->session->set_userdata('user', $user);
                $this->check_for_auth();
                return TRUE;
            }
            else
            {
                add_feedback('Invalid username or password. Please try again.', 'error');
                return FALSE;
            } 
        }
        else
        {
            add_feedback('Please provide both your email address and your password.', 'error');
            return FALSE;
        }
    }
    
    public function reset_action_code($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('User', array(
            'action_code'=>generate_hash()
        ));
        
        return $this->get($user_id);
    }
    
    public function set_status($user_id, $status_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('User', array('status'=>$status_id));
        
        return $this->get($user_id);
    }
    
    public function signup()
    {
        $signup_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'action_code' => generate_hash()
        );
        
        $this->db->insert('User', $signup_data);
        $user_id = $this->db->insert_id();
        
        if ($user_id)
        {
            return $this->get($user_id);
        }
        else
        {
            return FALSE;
        }
    }
    
    public function verify($user_id, $code)
    {
        $user = $this->get($user_id);
        $this->reset_action_code($user_id);
        if ($user->action_code == $code)
        {
            $user = $this->set_status($user_id, STATUS_OK);
            $this->session->set_userdata('user', $user);
            return TRUE;
        }
        else
        {
            $this->session->set_userdata('user', $user);
            return FALSE;
        }
    }
        
}
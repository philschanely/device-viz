<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 *
 * Details to come.
 *
 * @package    DeviceViz
 * @subpackage Models
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function change_info()
    {
        $user_id = $this->input->post('user_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $this->db->where('user_id', $user_id);
        $this->db->update('User', array(
            'name'=>$name,
            'email'=>$email
        ));
        add_feedback('Your account information has been updated.', 'success');
        $user = $this->update_persisting_user($user_id);
        return $user;
    }
    
    public function change_password($redirect_aftewards=FALSE)
    {
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $this->db->where('user_id', $user_id);
        $this->db->update('User', array(
            'password'=>md5($password)
        ));
        add_feedback('Your password has been changed.', 'success', $redirect_aftewards);
        $user = $this->update_persisting_user($user_id);
        return $user;
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
                    $url = $this->input->post('returnto') 
                        ? base_url() . $this->input->post('returnto')
                            : ($force && uri_string() == URL_LOGIN) 
                                ? base_url() . URL_DASHBOARD
                                : NULL;
                    break;
                case STATUS_PENDING:
                    $url = (uri_string() != URL_PENDING) 
                        ? base_url() . URL_PENDING 
                        : NULL;
                    break;
                case STATUS_DISABLED:
                default:
                    $url = (uri_string() != URL_DISABLED)
                        ? base_url() . URL_DISABLED
                        : NULL;
                    break;
            }
            if ($force & $url !== NULL)
            {
                redirect($url);
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
                $this->update_persisting_user($valid_user->user_id, TRUE);
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
        $user = $this->update_persisting_user($user_id);
        return $user;
    }
    
    public function reset_password()
    {
        $action_code = $this->input->post('action_code');
        $user_id = $this->input->post('user_id');
        $user = $this->get($user_id);
        $this->reset_action_code($user_id);
        if ($user->action_code == $action_code)
        {
            $user = $this->change_password(TRUE);
            return $user;
        }
        else
        {
            add_feedback('Your request to reset your password was invalid. Please try again.', 'error', TRUE);
            return FALSE;
        }
    }
    
    public function set_status($user_id, $status_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('User', array(
            'status'=>$status_id
        ));
        $user = $this->update_persisting_user($user_id);
        return $user;
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
    
    public function update_persisting_user($user_id, $force=FALSE)
    {
        $user = $this->get($user_id);
        $this->session->set_userdata('user', $user);
        $this->check_for_auth($force);
        return $user;
    }
    
    public function validate_email()
    {
        $email = $this->input->post('email');
        $this->db->where('email', $email);
        $user = checkForResults($this->db->get('User'), 'row');
        return $user;
    }
    
    public function verify($user_id, $code)
    {
        $user = $this->get($user_id);
        $this->reset_action_code($user_id);
        if ($user->status_id == STATUS_OK) 
        {
            add_feedback('Your account is already verified.', 'success', TRUE);
            return TRUE;
        } 
        elseif($user->action_code == $code)
        {
            add_feedback('Your account has been verified!', 'success', TRUE);
            $user = $this->set_status($user_id, STATUS_OK);
            return TRUE;
        }
        else
        {
            add_feedback(
                'Your account cannot be verified at this time. Please request a new verification email.', 
                'error', 
                TRUE
            );
            return FALSE;
        }
    }
        
}
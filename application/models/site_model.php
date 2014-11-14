<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Site Model
 *
 * Details to come.
 *
 * @package    DeviceViz
 * @subpackage Models
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class Site_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function check_permission($site_id, $user_id)
    {
        $site = $this->get($site_id);
        if ($site->owner == $user_id)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function get($site_id=0)
    {
        $site = array();
        if ($site_id > 0)
        {
            $this->db->where('site_id', $site_id);
            $site = checkForResults($this->db->get('Site_Profile'), 'row');
            return $site;
        }
        else
        {
            $fields = $this->db->list_fields('Site_Profile');
            foreach ($fields as $field)
            {
                $site[$field] = '';
            }
        }
        return (object) $site;
    }
    
    public function get_users_own($user_id, $format='result')
    {
        $this->db->where('owner', $user_id);
        $sites = checkForResults($this->db->get('Site_Profile'), $format);
        return $sites;
    }
    
    public function save()
    {
        $site_id = (int) $this->input->post('site_id');
        $user_id = (int) $this->input->post('user_id');
        $name = $this->input->post('name');
        $url = $this->input->post('url');
        $description = $this->input->post('description');
        
        $form_data = array(
            'name'=>$name,
            'url'=>$url,
            'description'=>$description
        );
        
        if ($site_id > 0)
        {
            // Ensure user has permission to edit this site
            if ($this->check_permission($site_id, $user_id))
            {
                $this->db->where('site_id', $site_id);
                $this->db->update('Site_Profile', $form_data);
                add_feedback('Saved changes to the Site Profile.', 'success', TRUE);
                $site = $this->get($site_id);
            }
            else
            {
                add_feedback('You are not allowed to edit this site profile.', 'error', TRUE);
                $site = FALSE;
            }
        }
        else
        {
            $form_data['owner'] = $user_id;
            $this->db->insert('Site_Profile', $form_data);
            $site_id = $this->db->insert_id();
            $site = $this->get($site_id);
            add_feedback('Site profile was created successfully.', 'success', TRUE);
        }
        
        return $site;
    }
        
}
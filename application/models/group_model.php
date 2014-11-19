<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Device Group Model
 *
 * Details to come.
 *
 * @package    DeviceViz
 * @subpackage Models
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class Group_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function check_permission($group_id, $user_id)
    {
        $group = $this->get($group_id);
        #if ($site->owner == $user_id)
        #{
            return TRUE;
        #}
        #else
        #{
            #return FALSE;
        #}
    }
    
    public function prepare_set($filter='', $sortby='') {}
    
    public function get($group_id=0, $site_id=0)
    {
        $group = array();
        if ($group_id > 0)
        {
            $this->db->where('group_id', $group_id);
            $group = checkForResults($this->db->get('Device_Group'), 'row');
        }
        else
        {
            $fields = $this->db->list_fields('Device_Group');
            foreach ($fields as $field)
            {
                switch ($field)
                {
                    case 'site':
                        $group[$field] = $site_id;
                        break;
                    case 'order':
                        $group[$field] = 1;
                        break;
                    default:
                        $group[$field] = '';
                        break;
                }
            }
        }
        return (object) $group;
    }
    
    public function get_for_data($data_width, $site_id)
    {
        $this->db->select('icon');
        $this->db->where("min_width <= {$data_width}");
        $this->db->where("max_width >= {$data_width}");
        $this->db->where("site = {$site_id}");
        $result = checkForResults($this->db->get('Device_Group'), 'row');
        return $result;
    }
    
    public function get_for_site($site_id)
    {
        $this->db->where('site', $site_id);
        return $this->get_set();
    }
    
    public function get_set()
    {
        $groups = checkForResults($this->db->get('Device_Group'), 'result');
        return $groups;
    }
    
    public function save()
    {
        $group_id = (int) $this->input->post('group_id');
        $user_id = (int) $this->input->post('user_id');
        
        $site = (int) $this->input->post('site');
        $name = $this->input->post('name');
        $icon = (int) $this->input->post('icon');
        $min_width = (int) $this->input->post('min_width');
        $max_width = (int) $this->input->post('max_width');
        $order = (int) $this->input->post('order');
        $allow_portrait = (boolean) $this->input->post('allow_portrait');
        
        $form_data = array(
            'site'=>$site,
            'name'=>$name,
            'icon'=>$icon,
            'min_width'=>$min_width,
            'max_width'=>$max_width,
            'order'=>$order,
            'allow_portrait'=>$allow_portrait
        );
        
        if ($group_id > 0)
        {
            // Ensure user has permission to edit this site
            if ($this->check_permission($group_id, $user_id))
            {
                $this->db->where('group_id', $group_id);
                $this->db->update('Device_Group', $form_data);
                add_feedback('Saved changes to the device group.', 'success', TRUE);
                $group = $this->get($group_id);
            }
            else
            {
                add_feedback('You are not allowed to edit this device group.', 'error', TRUE);
                $group = FALSE;
            }
        }
        else
        {
            $this->db->insert('Device_Group', $form_data);
            $group_id = $this->db->insert_id();
            $group = $this->get($group_id);
            add_feedback('Device group was created successfully.', 'success', TRUE);
        }
        
        return $group;
    }    
}
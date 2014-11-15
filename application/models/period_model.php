<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Data Period Model
 *
 * Details to come.
 *
 * @package    DeviceViz
 * @subpackage Models
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class Period_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function check_permission($period_id, $user_id)
    {
        $period = $this->get($period_id);
        if ($period->author == $user_id)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function prepare_set($filter='', $sortby='') {}
    
    public function get($period_id=0, $site_id=0, $user_id=0)
    {
        $period = array();
        if ($period_id > 0)
        {
            $this->db->where('period_id', $period_id);
            $period = checkForResults($this->db->get('Data_Period'), 'row');
        }
        else
        {
            $fields = $this->db->list_fields('Data_Period');
            foreach ($fields as $field)
            {
                switch ($field)
                {
                    case 'site':
                        $period[$field] = $site_id;
                        break;
                    case 'author':
                        $period[$field] = $user_id;
                        break;
                    default:
                        $period[$field] = '';
                        break;
                }
                    
            }
        }
        return (object) $period;
    }
    
    public function get_for_site($site_id)
    {
        $this->db->where('site', $site_id);
        return $this->get_set();
    }
    
    public function get_set()
    {
        $periods = checkForResults($this->db->get('Data_Period'), 'result');
        return $periods;
    }
    
    public function save()
    {
        $period_id = (int) $this->input->post('period_id');
        
        $site = (int) $this->input->post('site');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $user_id = $this->input->post('user_id');
        
        $form_data = array(
            'site'=>$site,
            'start_date'=>$start_date,
            'end_date'=>$end_date
        );
        
        if ($period_id > 0)
        {
            // Ensure user has permission to edit this site
            if ($this->check_permission($period_id, $user_id))
            {
                $this->db->where('period_id', $period_id);
                $this->db->update('Data_Period', $form_data);
                add_feedback('Saved changes to the data period.', 'success', TRUE);
                $period = $this->get($period_id);
            }
            else
            {
                add_feedback('You are not allowed to edit this data period.', 'error', TRUE);
                $period = FALSE;
            }
        }
        else
        {
            $form_data['author'] = $user_id;
            $this->db->insert('Data_Period', $form_data);
            $period_id = $this->db->insert_id();
            $period = $this->get($period_id);
            add_feedback('Data period was created successfully.', 'success', TRUE);
        }
        
        return $period;
    }    
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Device Data Model
 *
 * Details to come.
 *
 * @package    DeviceViz
 * @subpackage Models
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class Data_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('period_model');
    }
    /*
    public function check_permission($period_id, $user_id)
    {
        $period = $this->period_model->get($period_id);
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
    */
    public function get($data_id=0, $period_id=0)
    {
        $data = array();
        if ($data_id > 0)
        {
            $this->db->where('data_point_id', $data_id);
            $data = checkForResults($this->db->get('Data_Point'), 'row');
        }
        else
        {
            $fields = $this->db->list_fields('Data_Point');
            foreach ($fields as $field)
            {
                switch ($field)
                {
                    case 'data_point_id':
                        $data[$field] = 0;
                        break;
                    case 'period':
                        $data[$field] = $period_id;
                        break;
                    case 'width':
                    case 'height':
                    case 'sessions':
                        $data[$field] = 1;
                        break;
                    case 'avg_duration':
                        $data[$field] = '00:00:00';
                        break;
                    case 'avg_pages':
                        $data[$field] = '1.00';
                        break;
                    default:
                        $data[$field] = '';
                        break;
                }
                    
            }
        }
        return (object) $data;
    }
    
    public function get_for_period($period_id)
    {
        $this->db->where('period', $period_id);
        return $this->get_set();
    }
    
    public function get_set()
    {
        $data = checkForResults($this->db->get('Data_Point'), 'result');
        return $data;
    }
    
    public function save()
    {
        $data_id = (int) $this->input->post('data_point_id');
        $period_id = (int) $this->input->post('period_id');
        $user_id = $this->input->post('user_id');
        
        $width = (int) $this->input->post('width');
        $height = (int) $this->input->post('height');
        $url = $this->input->post('url');
        $sessions = (int) $this->input->post('sessions');
        $avg_duration = (float) $this->input->post('avg_duration');
        $avg_pages = (float) $this->input->post('avg_pages');
        
        $form_data = array(
            'width' => $width,
            'height' => $height,
            'url' => $url,
            'sessions' => $sessions,
            'avg_duration' => $avg_duration,
            'avg_pages' => $avg_pages
        );
        
        if ($data_id > 0)
        {
            // Ensure user has permission to edit this site
            if ($this->check_permission($period_id, $user_id))
            {
                $this->db->where('data_point_id', $data_id);
                $this->db->update('Data_Point', $form_data);
                add_feedback('Saved changes to the device data.', 'success', TRUE);
                $data = $this->get($data_id);
            }
            else
            {
                add_feedback('You are not allowed to edit this device data.', 'error', TRUE);
                $data = FALSE;
            }
        }
        else
        {
            $form_data['period'] = $period_id;
            $this->db->insert('Data_Point', $form_data);
            $data_id = $this->db->insert_id();
            $data = $this->get($data_id);
            add_feedback('Device data was created successfully.', 'success', TRUE);
        }
        
        return $data;
    }   
}   
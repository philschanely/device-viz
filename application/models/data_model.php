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
    
    public function clear($period_id)
    {
        $this->db->where('period', $period_id);
        $this->db->delete('Data_Point');
        return TRUE;
    }
    
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
    
    public function get($data_id=0, $period_id=0)
    {
        $data = array();
        if ($data_id > 0)
        {
            $this->db->where('data_point_id', $data_id);
            $data = checkForResults($this->db->get('Data_Info'), 'row');
        }
        else
        {
            $fields = $this->db->list_fields('Data_Info');
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
    
    public function get_for_period($period_id, $aggregate=FALSE)
    {
        if ($aggregate)
        {
            $query = "SELECT width, height, site, period, device, global_device,
                    SUM(sessions) as sessions 
                    FROM Data_Info WHERE period = {$period_id}";
            $data = checkForResults($this->db->query($query));
        } 
        else 
        {
            $this->db->where('period', $period_id);
            $data = $this->get_set();
        }
        return $data;
    }
    
    public function get_for_site($site_id, $aggregate=FALSE)
    {
        if ($aggregate)
        {
            $query = "SELECT width, height, site, period, device, global_device,
                    SUM(sessions) as sessions 
                    FROM Data_Info WHERE site = {$site_id} GROUP BY device ORDER BY sessions DESC";
            $data = checkForResults($this->db->query($query));
        } 
        else 
        {
            $this->db->where('site', $site_id);
            $data = $this->get_set();
        }
        return $data;
    }
    
    public function get_set()
    {
        $data = checkForResults($this->db->get('Data_Info'), 'result');
        return $data;
    }
    
    public function get_total_sessions($filter_key='site', $key)
    {
        switch ($filter_key)
        {
            case 'period':
                $this->db->where('period', $key);
                break;
            case 'site':
            default:
                $this->db->where('site', $key);
                break;
        }
        $this->db->select("SUM(sessions) as total_sessions, "
                . "MAX(width) as max_width, "
                . "MAX(height) as max_height, "
                . "MAX(sessions) as max_sessions ");
        $result = checkForResults($this->db->get('Data_Info'), 'row');
        return $result;
    }
    
    public function render($data, $data_id=0)
    {
        $device_view = '';
        
        if (empty($data))
        {
            if ($data_id > 1)
            {
                ep('Trying to load data manually');
                $data = $this->get($data_id);
            }
            else
            {
                add_feedback('A data set could not be retrieved.', 'error');
                return NULL;
            }
        }
        
        // Load the device group
        $this->load->model('group_model');
        $device_group = $this->group_model->get_for_data($data->width, $data->site);
        
        if ($device_group)
        {
            $this->load->library('device');

            switch ($device_group->icon)
            {
                case DEVICE_ICON_SMARTPHONE:
                case DEVICE_ICON_TABLET:
                    $this->load->library('device_mobile');
                    $this->device_mobile->configure($data->width, $data->height);
                    $device_view = $this->device_mobile->display();
                    break;
                case DEVICE_ICON_LAPTOP:
                    $this->load->library('device_laptop');
                    $this->device_laptop->configure($data->width, $data->height);
                    $device_view = $this->device_laptop->display();
                    break;
                case DEVICE_ICON_DESKTOP:
                default:
                    $this->load->library('device_desktop');
                    $this->device_desktop->configure($data->width, $data->height);
                    $device_view = $this->device_desktop->display();
                    break;
            }
        }
        else
        {
            add_feedback('A device could not be found for this data set. Device: ' . $data->device, 'error');
            return NULL;
        }
        
        return $device_view;
    }
    
    public function render_set($set, $totals=NULL)
    {
        $sets = array();
        if (!empty($set) && !empty($totals))
        {
            $show_percentage = $totals->total_sessions > 0;
        
            foreach ($set as $data_point)
            {
                $show_url = isset($data_point->url);
                $sets[] = array(
                    'device' => $this->render($data_point),
                    'width' => $data_point->width,
                    'height' => $data_point->height,
                    'sessions' => $data_point->sessions,
                    'raw_percentage' => $show_percentage 
                        ? $data_point->sessions/$totals->total_sessions
                        : NULL,
                    'percentage' => $show_percentage 
                        ? round($data_point->sessions/$totals->total_sessions * 100, 1)
                        : NULL,
                    'show_percentage' => $show_percentage,
                    'url' => $show_url ? $data_point->url : '',
                    'show_url' => $show_url,
                    'width_percent' => round($data_point->width / $totals->max_width * 100, 4),
                    'height_percent' => round($data_point->height / $totals->max_height * 100, 4),
                    'session_raw_percentage' => round(MAX_ONION_OPACITY * $data_point->sessions / $totals->max_sessions, 7)
                );
            }
        }
        return $sets;
    }
    
    public function prepare_onionskin($set, $max_width, $max_height, $max_sessions)
    {
        foreach ($set as $set)
        {
            $set['width_percentage'] = $set['width'] / $max_width;
            $set['height_percentage'] = $set['height'] / $max_height;
            $set['session_raw_percentage'] = $set['sessions'] / $max_sessions;
        }
    }
    
    public function save($data_id=-1, $form_data=array(), $show_feedback=TRUE)
    {
        if ($data_id===-1)
        {
            $data_id = (int) $this->input->post('data_id');
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
        }
        
        if ($data_id > 0)
        {
            // Ensure user has permission to edit this site
            if ($this->check_permission($period_id, $user_id))
            {
                $this->db->where('data_point_id', $data_id);
                $this->db->update('Data_Point', $form_data);
                if ($show_feedback) add_feedback('Saved changes to the device data.', 'success', TRUE);
                $data = $this->get($data_id);
            }
            else
            {
                if ($show_feedback) add_feedback('You are not allowed to edit this device data.', 'error', TRUE);
                $data = FALSE;
            }
        }
        else
        {
            if (!array_key_exists('period', $form_data)) 
            {
                $form_data['period'] = $period_id;
            }
            $this->db->insert('Data_Point', $form_data);
            $data_id = $this->db->insert_id();
            $data = $this->get($data_id);
            if ($show_feedback) add_feedback('Device data was created successfully.', 'success', TRUE);
        }
        
        return $data;
    }   
}   
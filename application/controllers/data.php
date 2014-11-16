<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user_model->check_for_auth();
        $this->load->model(array('data_model','period_model'));
        $this->dso->show_breadcrumbs = TRUE;
    }
    
    public function index($period_id)
    {
        $period = $this->period_model->get($period_id);
        $this->dso->period = $period;
        $data = $this->data_model->get_for_period($period_id);
        prep_view_results($data, 'device_data');
        
        $this->dso->add_to('breadcrumbs', base_url('site/manage/' . $period->site), 'Manage site');
        $this->dso->add_to('breadcrumbs', base_url('data/index/' . $period_id), 'Manage data');
        
        show_view('data/index', $this->dso->all);
    }
    
    public function edit($data_point_id=0, $period_id=0)
    {
        $this->load->library('form_validation');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->dso->page_title = 'Edit Device Data';
            $data = $this->data_model->get(
                $data_point_id,
                $period_id
            );
            $this->dso->device_data = $data;
            
            $period = $this->period_model->get($period_id);
        
            $this->dso->add_to('breadcrumbs', base_url('site/manage/' . $period->site), 'Manage site');
            $this->dso->add_to('breadcrumbs', base_url('data/index/' . $period_id), 'Manage data');
            $this->dso->add_to('breadcrumbs', base_url('data/edit/' . $data_point_id), 'Edit data');

            show_view('data/edit', $this->dso->all);
        }
        else
        {
            $data = $this->data_model->save();
            redirect(base_url() . 'data/index/' . $data->period);
        }
    }
    
    public function import($period_id)
    {
        $this->load->library('form_validation');
        $period = $this->period_model->get($period_id);
        $this->dso->period = $period;
        $this->dso->add_to('breadcrumbs', base_url('site/manage/' . $period->site), 'Manage site');
        $this->dso->add_to('breadcrumbs', base_url('data/index/' . $period_id), 'Manage data');
        $this->dso->add_to('breadcrumbs', base_url('data/import/' . $period_id), 'Import data');
        
        if (!$this->input->post('submit-data-import'))
        {
            $this->dso->page_title = 'Import Device Data';
            show_view('data/import', $this->dso->all);
        }
        else
        {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size']	= '10000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('csvfile'))
            {
                $feedback = $this->upload->display_errors();
                $data = $this->upload->data();
                add_feedback($feedback, 'error', TRUE);
                redirect(base_url() . 'data/index/' . $period_id);
            }
            else
            {
                $data = $this->upload->data();
                $this->load->helper('file');
                $path_to_file = $config['upload_path'] . $data['file_name'];
                $file = file($path_to_file);
                $insert_count = 0;
                foreach ($file as $row)
                {
                    $data = explode(',', $row);
                    $matches = array();
                    $has_device_data = preg_match('/^\d+x\d+/', $data[0], $matches);
                    if (count($data) > 1 && $has_device_data)
                    {
                        $dimensions = explode('x', $data[0]);
                        $row_data = array(
                            'period'=>$period_id,
                            'width'=>$dimensions[0],
                            'height'=>$dimensions[1],
                            'url'=>$data[1],
                            'sessions'=>$data[2],
                            'avg_pages'=>$data[6],
                            'avg_duration'=>$data[7]
                        );
                        $saved_data = $this->data_model->save(0, $row_data, FALSE);
                        if ($saved_data)
                        {
                            $insert_count++;
                        }
                    }
                }
                unlink($path_to_file);
                if ($insert_count>0)
                {
                    add_feedback($insert_count . ' sets of device data were imported.', 'success', TRUE);
                }
                else
                {
                    add_feedback('No data was imported. Try importing again and ensure you set up the file correctly.', 'error', TRUE);
                }
                
                redirect(base_url() . 'data/index/' . $period_id);
            }
        }
    }
    
    public function clear($period_id, $confirmed=0)
    {
        $period = $this->period_model->get($period_id);
        $this->dso->period = $period;
        $this->dso->add_to('breadcrumbs', base_url('site/manage/' . $period->site), 'Manage site');
        $this->dso->add_to('breadcrumbs', base_url('data/index/' . $period_id), 'Manage data');
        $this->dso->add_to('breadcrumbs', base_url('data/clear/' . $period_id), 'Clear data');
        
        if ($confirmed)
        {
            $this->data_model->clear($period_id);
            redirect(base_url() . 'data/index/' . $period_id);
        }
        else
        {
            show_view('data/clear');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
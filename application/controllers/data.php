<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user_model->check_for_auth();
        $this->load->model(array('data_model','period_model'));
    }
    
    public function index($period_id)
    {
        $period = $this->period_model->get($period_id);
        $this->dso->period = $period;
        $data = $this->data_model->get_for_period($period_id);
        prep_view_results($data, 'device_data');
        
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

            if ( ! $this->upload->do_upload('csvfile'))
            {
                $feedback = $this->upload->display_errors();
                $data = $this->upload->data();
                add_feedback($feedback, 'error', TRUE);
                dv($feedback);
                dv($data);
                #redirect(base_url() . 'data/index/' . $period_id);
            }
            else
            {
                $data = $this->upload->data();
                dv($data);
                
                $this->load->helper('file');
                $file = read_file($config['upload_path'] . $data['file_name']);
                dv($file);
                #redirect(base_url() . 'data/index/' . $period_id);
            }
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
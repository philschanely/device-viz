<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Period extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('period_model');
        $this->user_model->check_for_auth();
        $this->dso->show_breadcrumbs = TRUE;
    }
    
    public function edit($period_id=0, $site_id=0)
    {
        $this->load->library('form_validation');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->dso->page_title = 'Edit a Data Period';
            $period = $this->period_model->get(
                $period_id, 
                $site_id, 
                $this->dso->user->user_id
            );
            $this->dso->period = $period;
            
            $this->dso->add_to('breadcrumbs', base_url('site/manage/' . $site_id), 'Manage site');
            $this->dso->add_to('breadcrumbs', base_url('period/edit/' . $period_id), 'Edit data period');

            show_view('period/edit', $this->dso->all);
        }
        else
        {
            $period = $this->period_model->save();
            redirect(base_url() . 'site/manage/' . $period->site);
        }
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
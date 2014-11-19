<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('site_model');
        $this->user_model->check_for_auth();
        $this->dso->show_breadcrumbs = TRUE;
    }
    /**
     * Index Page for this controller.
     *
     */
    public function index($site_id)
    {
        $this->load->model('data_model');
        
        $this->dso->add_to(
            'breadcrumbs', 
            base_url() . 'site/index/' . $site_id, 'Visualize site'
        );
        $this->dso->page_title = 'Site Data Visualization';
        
        $site = $this->site_model->get($site_id);
        
        $set = $this->data_model->get_for_site($site_id, TRUE);
        $total_sessions = $this->data_model->get_total_sessions('site', $site_id);
        $devices = $this->data_model->render_set($set, $total_sessions);
        $this->dso->devices = $devices; 
        
        $this->dso->site = $site;
        show_view('site/index', $this->dso->all);
    }
    
    public function edit($site_id=0)
    {
        $this->dso->add_to('breadcrumbs', base_url() . 'site/edit/' . $site_id, 'Edit a site');
        $this->load->library('form_validation');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->dso->page_title = 'Edit a Site';
            $site = $this->site_model->get($site_id);
            $this->dso->site = $site;
            show_view('site/edit', $this->dso->all);
        }
        else
        {
            $site = $this->site_model->save();
            $url = $this->input->get('returnto') 
                ? $this->input->get('returnto')
                : 'site/manage/' . $site->site_id; 
            redirect(base_url() . $url);
        }
        
    }
    
    public function manage($site_id)
    {
        $this->load->model(array('group_model','period_model'));
        
        $site = $this->site_model->get($site_id);
        $this->dso->site = $site;
        
        $this->dso->page_title = 'Managing ' . $site->name;
        $this->dso->add_to('breadcrumbs', base_url() . 'site/manage/' . $site_id, 'Manage a site');
        
        $periods = $this->period_model->get_for_site($site_id);
        prep_view_results($periods, 'periods');
        
        $groups = $this->group_model->get_for_site($site_id);
        prep_view_results($groups, 'groups');
        
        show_view('site/manage', $this->dso->all);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
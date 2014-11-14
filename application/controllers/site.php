<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('site_model');
        $this->user_model->check_for_auth();
    }
    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        $this->dso->page_title = 'Site Data Visualization';
        show_view('site/index', $this->dso->all);
    }
    
    public function edit($site_id=0)
    {
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
        $this->dso->page_title = 'Site Data Visualization';
        show_view('site/manage', $this->dso->all);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
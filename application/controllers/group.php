<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('group_model');
        $this->user_model->check_for_auth();
        $this->dso->show_breadcrumbs = TRUE;
    }
    
    public function edit($group_id=0, $site_id=0)
    {
        $this->load->library('form_validation');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->dso->page_title = 'Edit a Device Group';
            $group = $this->group_model->get($group_id, $site_id);
            $this->dso->group = $group;
            
            $this->dso->add_to('breadcrumbs', base_url('site/manage/' . $site_id), 'Manage site');
            $this->dso->add_to('breadcrumbs', base_url('group/edit/' . $group_id), 'Edit device group');

            show_view('group/edit', $this->dso->all);
        }
        else
        {
            $group = $this->group_model->save();
            redirect(base_url() . 'site/manage/' . $group->site);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
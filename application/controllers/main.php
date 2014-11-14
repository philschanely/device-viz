<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        $this->user_model->check_for_auth(FALSE);
        $this->dso->page_title = 'Introducing DeviceViz: Data visualization for device access';
        $this->dso->page_class = '';
        show_view('index', $this->dso->all);
    }
    
    public function dashboard()
    {
        $this->user_model->check_for_auth();
        $this->dso->page_title = 'Dashboard';
        show_view('dashboard', $this->dso->all);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
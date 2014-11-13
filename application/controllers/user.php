<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        show_view('temp', $this->dso->all);
    }
    
    public function login()
    {
        show_view('user/login', $this->dso->all);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
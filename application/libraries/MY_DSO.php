<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * DSO extension
 *
 * Local wrapper for DSO. Details coming soon...
 *
 * @package    PodioTest
 * @subpackage Library
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class MY_DSO extends CI_DSO {
    
    public function load_defaults()
    {
        $this->page_title = 'Visualize your device data';
        $this->page_id = 'page-default';
        $this->page_class = 'no-bleed ';
        $this->base_url = base_url();
        $this->user = NULL;
        $this->auth = FALSE;
        $this->show_login = TRUE;
        $this->show_acct_options = FALSE;
    }
}

/* End of file PODIOTEST_DSO.php */
/* Location: ./application/libraries/PODIOTEST_DSO.php */

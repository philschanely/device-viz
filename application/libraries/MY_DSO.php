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
        $this->page_title = 'Default Podio Test Page';
        $this->page_id = 'page-unknown';
        $this->base_url = base_url();
    }
}

/* End of file PODIOTEST_DSO.php */
/* Location: ./application/libraries/PODIOTEST_DSO.php */

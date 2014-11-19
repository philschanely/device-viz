<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Device {

    private $CI;
    public $corner_radius;

    public function __construct()
    {
    	$this->CI =& get_instance();
		$this->CI->load->helper('common');
        
        $this->corner_radius = 5;
    }
	
    public function configure($width, $height, $scale)
    {
        $this->width = $width;
        $this->height = $height;
        $this->scale = $scale;
        $this->width_dif = 10;
        $this->height_dif = $this->width_dif;
        $this->arc_radius = 20;
        $this->corner_height = $this->height_dif + $this->arc_radius;
        $this->corner_width = $this->width_dif + $this->arc_radius;
        $this->outer_width = $this->width + (2 * $this->width_dif);
        $this->outer_height = $this->height + (2 * $this->height_dif);
        $this->total_height = $this->height + ($this->corner_height * 2);
        $this->total_width = $this->width + ($this->corner_width * 2);
        $this->half_width = $this->total_width / 2;
        $this->scale_total_width = $this->total_width * $this->scale;
        $this->scale_total_height = $this->total_height * $this->scale;
        
        $this->config['viewbox'] = "0 0 {$this->total_width} {$this->total_height}";
        $this->config['scale'] = "$this->scale";        
        $this->config['scale-total-width'] = $this->scale_total_width;
        $this->config['scale-total-height'] = $this->scale_total_height;
        $this->config['start-point'] = "{$this->arc_radius},0";
        $this->config['width'] = $this->width;
        $this->config['width-dif'] = $this->width_dif;
        $this->config['height'] = $this->height;
        $this->config['height-dif'] = $this->height_dif;
        $this->config['radius'] = $this->arc_radius;
        $this->config['corner-height'] = $this->corner_height;
        $this->config['corner-width'] = $this->corner_width;
        $this->config['outer-width'] = $this->outer_width;
        $this->config['outer-height'] = $this->outer_height;
        $this->config['outer-edge-bezier-top-right'] = "{$this->arc_radius},0 {$this->arc_radius},{$this->arc_radius}";
        $this->config['outer-edge-bezier-bottom-right'] = "0,{$this->arc_radius} -{$this->arc_radius},{$this->arc_radius}";
        $this->config['outer-edge-bezier-bottom-left'] = "-{$this->arc_radius},0 -{$this->arc_radius},-{$this->arc_radius}";
        $this->config['outer-edge-bezier-top-left'] = "0,-{$this->arc_radius} {$this->arc_radius},-{$this->arc_radius}"; 
    }

    public function display()
    {
        return '';
    }
}

/* End of file Device_phone.php */
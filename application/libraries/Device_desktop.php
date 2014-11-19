<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Device_desktop extends Device {

    public $var;

    public function configure($width=1920, $height=1080, $scale=0.1)
    {
        parent::configure($width, $height, $scale);
        
        $base_width = $this->width / 3;
        $base_half_width = $base_width / 2;
        $base_top_width = $this->width_dif * 4;
        $stand_slope_width = $this->width_dif * 2;
        $stand_start_x = $this->half_width - $base_half_width + $base_top_width + $stand_slope_width;
        $stand_height = $this->height_dif * 4;
        $stand_slope_height = $this->arc_radius * 2;
        
        $total_height_w_base = $this->total_height + ($stand_height * 2) + $stand_slope_height;
        $scale_total_height = $total_height_w_base * $scale;
        
        $this->config['viewbox'] = "0,0,{$this->total_width},{$total_height_w_base}";
        $this->config['total-height'] = $total_height_w_base;
        $this->config['scale-total-height'] = $scale_total_height;
        $this->config['stand-start-point'] = "{$stand_start_x},{$this->total_height}";
        $this->config['stand-height'] = $stand_height;
        $this->config['stand-slope-height'] = $stand_slope_height;
        $this->config['stand-slope-width'] = $stand_slope_width;
        $this->config['stand-base-top-width'] = $base_top_width;
        $this->config['stand-base-width'] = $base_width;      
    }
    
    public function display()
    {
        return show_view('device/desktop', $this->config, FALSE, FALSE, TRUE);
    }
}

/* End of file Device_desktop.php */
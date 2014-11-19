<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Device_laptop extends Device {

    public $var;

    public function configure($width=1366, $height=768, $scale=0.1)
    {
        parent::configure($width, $height, $scale);
        
        $outer_height = $this->height + $this->corner_radius + ($this->height_dif * 2);
        
        $base_width_offset = 40 + $this->corner_width;
        $base_width = $this->width + ($base_width_offset*2) + ($this->width_dif * 2);
        $base_height = 40;
        
        $total_width = $base_width + (2 * $this->corner_width);
        $total_height = $outer_height + $base_height + ($this->corner_height * 2);
        
        $scale_total_width = $total_width * $this->scale;
        $scale_total_height = $total_height * $this->scale;
        
        $this->config['outer-height'] = $outer_height;
        $this->config['base-width-offset'] = $base_width_offset;
        $this->config['base-height'] = $base_height;
        $this->config['base-width'] = $base_width;
        $this->config['scale-total-width'] = $scale_total_width;
        $this->config['scale-total-height'] = $scale_total_height;
        $this->config['viewbox'] = "0, 0, {$total_width}, {$total_height}";
        
    }
    
    public function display()
    {
        return show_view('device/laptop', $this->config, FALSE, FALSE, TRUE);
    }
}

/* End of file Device_desktop.php */
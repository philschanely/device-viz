<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Device_mobile extends Device {

    public $var;

    public function configure($width=768, $height=1024, $scale=0.1, $portrait=TRUE)
    {
        parent::configure($width, $height, $scale);
        $button_radius = $this->arc_radius * 1.5;
        $button_offset = $this->corner_height + 20;
        $outer_height = $this->outer_height - $this->corner_height + ($button_offset * 2) + ($button_radius * 2);
        $total_height = $outer_height + ($this->corner_height*2);
        $scale_total_height = $total_height * $scale;
        
        $this->config['outer-height'] = $outer_height;
        $this->config['scale-total-height'] = $scale_total_height;
        $this->config['half-outer-width'] = $this->outer_width / 2;
        $this->config['viewbox'] = "0, 0, {$this->total_width}, {$total_height}";
        $this->config['button-offset'] = $button_offset;
        $this->config['button-bezier'] = "{$button_radius},0 {$button_radius},-{$button_radius} -{$button_radius},-{$button_radius} -{$button_radius},{$button_radius} {$button_radius},{$button_radius}";
        $this->config['button-bezier-bottom-right'] = "{$button_radius},0 {$button_radius},-{$button_radius}";
        $this->config['button-bezier-top-right'] = "0,-{$button_radius} -{$button_radius},-{$button_radius}";
        $this->config['button-bezier-top-left'] = "-{$button_radius},0 -{$button_radius},{$button_radius}";
        $this->config['button-bezier-bottom-left'] = "0,{$button_radius} {$button_radius},{$button_radius}";
        
    }
    
    public function display()
    {
        return show_view('device/mobile', $this->config, FALSE, FALSE, TRUE);
    }
}

/* End of file Device_desktop.php */
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Parser extension
 *
 * Local wrapper for Parser. Details coming soon...
 *
 * @package    PodioTest
 * @subpackage Library
 * @author     Phil Schanely <philschanely@cedarville.edu>
 */
class MY_Parser extends CI_Parser {
    
    // --------------------------------------------------------------------

	/**
	 *  Override for Parse a template
	 *
	 * Same as original, but adds exception for objects
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */ 
	function _parse($template, $data, $return = FALSE)
	{
            if ($template == '')
            {
                return FALSE;
            }

            foreach ($data as $key => $val)
            {
                if (is_array($val))
                {
                    $template = $this->_parse_pair($key, $val, $template);
                }
                /* CTL CUSTOMIZATION START */
                elseif (is_object($val))
                {
                    $template = $this->_parse_obj($key, $val, $template);
                }
                elseif (is_bool($val))
                {
                    $template = $this->_parse_boolean_pair($key, $val, $template);
                }
                /* CTL CUSTOMIZATION END */
                else
                {
                    $template = $this->_parse_single($key, (string)$val, $template);
                }
            }

            if ($return == FALSE)
            {
                    $CI =& get_instance();
                    $CI->output->append_output($template);
            }

            return $template;
	}
    
    // --------------------------------------------------------------------

	/**
	 *  Parse a tag pair
	 *
	 * Parses tag pairs:  {some_tag} string... {/some_tag}
	 *
	 * @access	private
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
	function _parse_pair($variable, $data, $string)
	{
		// First check to see if a subview is called with this variable
        if (FALSE !== ($match = $this->_match_subview_call($string, $variable)))
        {
            // Load the subview found in $match[1]
            $subview_result = $this->parse($match[1], $data, TRUE);
            $string = str_replace(
                $match[0], 
                $subview_result, 
                $string
            );
            return $string;
        }
        else 
        {
            if (FALSE === ($match = $this->_match_pair($string, $variable)))
            {
                // Modify code here to look for and retrieve
                // TODO: Finish this someday.
                #ep('No pair match found; ');
                // Pause here and look for this array and a potential value call like in the object
                $string = $this->_parse_obj($variable, $data, $string);
                
                return $string;
            }

            $str = '';
            foreach ($data as $row)
            {
                $temp = $match['1'];
                foreach ($row as $key => $val)
                {
                    /* CTL CUSTOMIZATION START */
                    if (is_array($val))
                    {
                        $temp = $this->_parse_pair($key, $val, $temp);
                    }
                    elseif (is_object($val))
                    {
                        $temp = $this->_parse_obj($key, $val, $temp);
                    }
                    elseif (is_bool($val))
                    {
                        $temp = $this->_parse_boolean_pair($key, $val, $temp);
                    }
                    else
                    {
                        $temp = $this->_parse_single($key, (string)$val, $temp);
                    }
                    /* CTL CUSTOMIZATION END */
                }

                $str .= $temp;
            }

            return str_replace($match['0'], $str, $string);
        }
	}
    
    // --------------------------------------------------------------------

	/**
	 *  Parse a tag pair
	 *
	 * Parses tag pairs:  {some_tag} string... {/some_tag}
	 *
	 * @access	private
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
	function _parse_boolean_pair($variable_name, $value, $string)
	{
		
        while($match = $this->_match_conditional_pair($string, $variable_name))
		{
			// Hide or clean up template based on value of boolean
            if ($value)
            {
                $string = str_replace($match[0], $match[1], $string);
            }
            else
            {
                $string = str_replace($match[0], '', $string);
            }
		}
        
		return $string;
	}
    
    // --------------------------------------------------------------------

	/**
	 *  Parse a tag object in dot notation
	 *
	 * Parses tag as obj:  {some_tag.property}
	 *
	 * @access	private
	 * @param	string
	 * @param	object
	 * @param	string
	 * @return	string
	 */
	function _parse_obj($variable, $data, $string)
	{
		// First check to see if a subview is called with this variable
        if (FALSE !== ($match = $this->_match_subview_call($string, $variable)))
        {
            // Load the subview found in $match[1]
            $subview_result = $this->parse($match[1], $data, TRUE);
            $string = str_replace(
                $match[0], 
                $subview_result, 
                $string
            );
        }
        else 
        {
            // Otherwise parse as a normal simplge value with dot notation
            foreach ($data as $key => $val)
            {
                // Only works on simple values
                if (is_string($val) || is_int($val) || is_float($val))
                {
                    // $temp = $this->_parse_single($key, $val, $temp);
                    $string = str_replace(
                        $this->l_delim . $variable . '.' . $key . $this->r_delim, 
                        $val, 
                        $string
                    );
                }
                else
                {
                    // Passively skip this property as it is not a string
                }
            }
        }
		return $string;
	}
    
    // --------------------------------------------------------------------

	/**
	 *  Matches a variable pair
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @return	mixed
	 */
	function _match_conditional_pair($string, $variable)
	{
        $pattern = "|" . preg_quote($this->l_delim) . $variable . '\?' . preg_quote($this->r_delim) 
                 . "(.+?)" 
                 . preg_quote($this->l_delim) . '/' . $variable . '\?' . preg_quote($this->r_delim) . "|s";
        $preg_match = preg_match($pattern, $string, $match);
		
        if ( ! $preg_match)
		{
			return FALSE;
		}
        
        return $match;
	}
    
    // --------------------------------------------------------------------

	/**
	 *  Matches a subview call
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @return	mixed
	 */
	function _match_subview_call($string, $variable)
	{
        $pattern = "|" . preg_quote($this->l_delim) . $variable . '~~>'
                 . "(.+?)" . preg_quote($this->r_delim) . "|s";
        $preg_match = preg_match($pattern, $string, $match);
		
        if ( ! $preg_match)
		{
            #ep('No subview call. ' . $variable);
			return FALSE;
		}
        else
        {
            #ep('Subview call. ' . $variable);
        }
        
        return $match;
	}
}

/* End of file PODIOTEST_Parser.php */
/* Location: ./application/libraries/PODIOTEST_Parser.php */
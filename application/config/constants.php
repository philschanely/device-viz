<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


define('URL_LOGIN', 'user/login');
define('URL_DASHBOARD', 'main/dashboard');
define('URL_DISABLED', 'user/disabled');
define('URL_PENDING', 'user/pending');
define('ACCESSLEVEL_ADMIN', 1);
define('STATUS_OK', 1);
define('STATUS_PENDING', 2);
define('STATUS_DISABLED', 3);

define('DEVICE_ICON_SMARTPHONE', 1);
define('DEVICE_ICON_TABLET', 2); 
define('DEVICE_ICON_LAPTOP', 3); 
define('DEVICE_ICON_DESKTOP', 4);


/* End of file constants.php */
/* Location: ./application/config/constants.php */
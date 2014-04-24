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

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| My Constants
|--------------------------------------------------------------------------
|
| User Types
|
*/

define('ADMIN_TYPE','admin');
define('TEACHER_TYPE','teacher');
define('STUDENT_TYPE','student');
define('GUARDIAN_TYPE','guardian');

define('PRV_ADMIN',99);
define('PRV_HEAD_TEACHER',82);
define('PRV_GFM_TEACHER',81);
define('PRV_GEN_TEACHER',80);
define('PRV_ACCOUNTS_HEAD',35);
define('PRV_ACCOUNTS_CLERK',30);
define('PRV_GUARDIAN',8);
define('PRV_STUDENT',4);
define('PRV_ALUMNI',2);

/* End of file constants.php */
/* Location: ./application/config/constants.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

$absPath = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "nuvest.sarasolutions.in"){
  
	define('ROUTE_STIE_PATH','https://nuvest.sarasolutions.in/');
}else{
  $absPath = $absPath.'/ping';
	define('ROUTE_STIE_PATH','http://[::1]/ping/');
}
//cash related table
/*
cash
cashdetail
cash_apyment
cash_apyment_date
fund_history
*/

//table
define('TBL_ADMINLOGIN','adminlogin');
define('TBL_USER','user');
define('TBL_PLAN','plan');
define('TBL_FUND','fund');
define('TBL_FUNDTYPE', 'fundtype');
define('TBL_USERPIN','userpin');
define('TBL_PAYMENTTYPE','paymenttype');
define('TBL_PAYMENTDURATION','paymentduration');
define('TBL_PLANPAYMENTTYPE','plan_payment_type');
define('TBL_PLANPAYMENTDURATION','plan_payment_duration');
define('TBL_INVESTMENTS','investments');
define('TBL_INVESTMENTDETAIL','investment_detail');
define('TBL_LOAN','loan');
define('TBL_LOANDETAIL','loan_detail');
define('TBL_LOAN_APPLY','loan_apply');
define('TBL_BANK','bank');
define('TBL_NIF','nif');
define('TBL_OTP','tbl_otp');
define('TBL_USER_DERMALOG','user_dermalog');
define('TBL_REFERFRIEND','refre_friend');
define('TBL_CASH','cash');
define('TBL_CASHDETAIL','cash_detail');
define('TBL_NOTIFICATION','notification');
define('TBL_USER_DEVICE','user_device');
define('TBL_PLAN_CATEGORY','tbl_plan_category');
define('TBL_FUND_HISTORY','fund_history');
define('TBL_LOAN_SCRAP','loan_scrap');
define('TBL_LOAN_SCRAP_DETAIL','loan_scrap_detail');
define('TBL_CARD','card');
define('TBL_CASHOUT_TYPE','cashout_type');
define('TBL_WALLET','wallet');
define('TBL_CASHOUT','cashout');
define('TBL_ADMIN_MODULE','admin_module');
define('TBL_ADMIN_PERMISSION','admin_permission');
define('TBL_AGENT','agent');
define('TBL_AGENTFUND','agent_fund');
define('TBL_CASH_PAYMENT_DATE','cash_payment_date');
define('TBL_INVESTMENT_PAYMENT_DATE','investment_payment_date');
define('TBL_LOAN_PAYMENT_DATE','loan_payment_date');
define('TBL_CASH_PAYMENT','cash_payment');
define('TBL_INVESTMENT_PAYMENT', 'investment_payment');
define('TBL_LOAN_PAYMENT', 'loan_payment');
define('TBL_AMOUNT_COMES_FROM','amount_comes_from');
define('TBL_EARNED_INTEREST','earned_interest');
define('TBL_CMS','cms');
define('TBL_FRIENDS','tbl_friends');
define('TBL_VERIFY_DOCS','verified_docs');
define('TBL_CONFIG','config');
define('TBL_LOAN_HISTORY','loan_history');




//other thing
define('ACCOUNT_REPORT_TITLE','Here you will find your account statement in the link below.');
define('MAILFROMEMAIL','smith@nuvest.com');
define('MAILFROMNAME','SMITH');
define('CURRENCY','HTG');
define('SITE_NAME','Ping');
define('JWTSECRETKEY','NUVEST');
define('MAINPLAN', array(
  'CASH' => 'Cash',
  "INVESTMENT" => "Investment",
  "LOAN" => "Loan",
));
//image
define('ALLOWED_IMAGE_EXTENSION','jpg|jpeg|png|gif');
define('USER_IMAGE_MAX_SIZE','5000');
define('DEFAULT_IMAGE_MAX_WIDTH','5000'); 
define('DEFAULT_IMAGE_MAX_HEIGHT','5000'); 
define('USER_IMAGE_THUMB_SIZE','160X160');
define('THUMB_WIDTH','160');
define('THUMB_HEIGHT','160');

//avatar image
define('SHOW_AVATAR_IMAGE',ROUTE_STIE_PATH.'/assets/Image/avatar5.png');

//fund path
define('UPLOAD_FUND_IMAGE_ORIGINAL',$absPath.'/assets/Image/fund/original/');
define('UPLOAD_FUND_IMAGE_THUMB',$absPath.'/assets/Image/fund/thumb/');
define('SHOW_FUND_IMAGE_ORIGINAL',ROUTE_STIE_PATH.'/assets/Image/fund/original/');
define('SHOW_FUND_IMAGE_THUMB',ROUTE_STIE_PATH.'/assets/Image/fund/thumb/');

//user image path
define('UPLOAD_USER_IMAGE_ORIGINAL',$absPath.'/assets/Image/user/original/');
define('UPLOAD_USER_IMAGE_THUMB',$absPath.'/assets/Image/user/thumb/');
define('SHOW_USER_IMAGE_ORIGINAL',ROUTE_STIE_PATH.'assets/Image/user/original/');
define('SHOW_USER_IMAGE_THUMB',ROUTE_STIE_PATH.'assets/Image/user/thumb/');

//nif image
define('UPLOAD_NIF_IMAGE_ORIGINAL',$absPath.'/assets/Image/nif/original/');
define('UPLOAD_NIF_IMAGE_THUMB',$absPath.'/assets/Image/nif/thumb/');
define('SHOW_NIF_IMAGE_ORIGINAL',ROUTE_STIE_PATH.'/assets/Image/nif/original/');
define('SHOW_NIF_IMAGE_THUMB',ROUTE_STIE_PATH.'/assets/Image/nif/thumb/');

//Dermalog
define('UPLOAD_DERMALOG_IMAGE_ORIGINAL',$absPath.'/assets/Image/dermalog/original/');
define('UPLOAD_DERMALOG_IMAGE_THUMB',$absPath.'/assets/Image/dermalog/thumb/');
define('SHOW_DERMALOG_IMAGE_ORIGINAL',ROUTE_STIE_PATH.'/assets/Image/dermalog/original/');
define('SHOW_DERMALOG_IMAGE_THUMB',ROUTE_STIE_PATH.'/assets/Image/dermalog/thumb/');

//agent fund

define('UPLOAD_AGENTFUND_IMAGE_ORIGINAL',$absPath.'/assets/Image/agentfund/original/');
define('UPLOAD_AGENTFUND_IMAGE_THUMB',$absPath.'/assets/Image/agentfund/thumb/');
define('SHOW_AGENTFUND_IMAGE_ORIGINAL',ROUTE_STIE_PATH.'/assets/Image/agentfund/original/');
define('SHOW_AGENTFUND_IMAGE_THUMB',ROUTE_STIE_PATH.'/assets/Image/agentfund/thumb/');


define('OTP', array(
  'VERIFYCONTACT'=>'VERIFYCONTACT'
));

define('NIF', array(
  '0'=>'Inserted',
  '1'=>'Pending',
  '2'=> 'Verify'
));
define('verify_darmalog', array(
  '0'=>'Inserted',
  '1'=>'Pending',
  '2'=> 'Verify'
));



//Notification message

//cash 
define("NOTIFICATION", array(
  'customer'=>array(
    'dermalogUpload'=>'Dermalog document has been uploaded.',
    'dermalogUploadTitle'=>'Dermalog document',
    'dermalogStatusTitle'=>'Dermalog Status',
    'dermalogStatus'=>'Your Dermalog Document has been {STATUS}.',
    'nifUpload'=>'Nif document has been uploaded.',
    'nifUploadTitle'=>'Nif document',
    'nifStatusTitle'=>'Nif Status',
    'nifStatus'=>'Your Nif Document has been {STATUS}.',
    'signin'=>array(
      'title'=>'Sign In',
      'message'=> 'Sign In successfully'
    ),
    'profileUpdateTitle'=>'Profile',
    'profileUpdate'=>'Your profile has been updated successfully',
    'banktitle'=> 'Bank',
    'bankmessage'=>'Bank {BANKNAME} has been added successfully',
    'tofatitle'=>'Add 2FA',
    'tofamessage'=>'Add 2FA is {STATUS}',
    'contactnumbertitle'=>'Contact Number',
    'contactnumbermessage'=>'Your contact number has been verified successfully',
    'emailtitle'=>'Email',
    'emailmessage'=>'Your email has been verified successfully',
  ),  
  'savecash'=>array(
              'message'=>'{PLANNAME} has been generated {CURRENCY} {AMOUNT} {PAYMENTTYPE}. For activate please contact admin',
              'title'=>'Cash Succesfully.'
    ),
  'statuscash'=>array(
      'message'=> '{PLANNAME} has been {STATUS} {CURRENCY} {AMOUNT} {PAYMENTTYPE}',
      'title'=>'Cash status successfully.'
  ),
  'cashpaid'=>array(
    'message'=> '{CURRENCY} {AMOUNT} has been paid successfully.',
    'title'=>'Cash paid successfully.'
  ),
  'cashinterest'=>array(
    'message'=> 'Interest {CURRENCY} {AMOUNT}  has been added!',
    'title'=>'Interest has been added.'
  ),

  'saveinvestment'=>array(
    'message'=>'{PLANNAME} has been generated {CURRENCY} {AMOUNT} {PAYMENTTYPE}. For activate please contact admin',
    'title'=>'Investment Succesfully.'
  ),
  'statusinvestment'=>array(
  'message'=> '{PLANNAME} has been {STATUS} {CURRENCY} {AMOUNT} {PAYMENTTYPE}',
  'title'=>'Investment status successfully.'
  ),
  'investmentpaid'=>array(
  'message'=> '{CURRENCY} {AMOUNT} has been paid successfully.',
  'title'=>'Investment paid successfully.'
  ),
  'investmentinterest'=>array(
  'message'=> 'Interest {CURRENCY} {AMOUNT}  has been added.',
  'title'=>'Interest has been added'
  ),
  'investmentmatured'=>array(
    'message'=> 'Matured amount {CURRENCY} {AMOUNT}  has been added.',
    'title'=>'Matured amount has been added'
    ),
  'cashoutpaid'=>array(
    'message'=> '{CURRENCY} {AMOUNT} has been cashout successfully.',
    'title'=>'Cashout successfully.'
    ),

  'addfund'=>array(
    'message'=>"{FUNDTYPE} {CURRENCY} {AMOUNT} successfully. For activate Please contact to admin",
    'title'=>'Fund Added successfully'
  ),  
  'statusfund'=>array(
    'message'=>"{FUNDTYPE} {CURRENCY} {AMOUNT} is {STATUS}",
    'title'=>'Fund status successfully'
  ),
  'createloan'=>array(
    'message'=>"Your {LOANPLAN} loan {CURRENCY} {AMOUNT} for {LOANDURATION} is generated. For activate Please contact to admin.",
    'title'=>'Loan successfully'
  ), 
  'loanstatus'=>array(
    'message'=>"Your {LOANPLAN} loan {CURRECNY} {AMOUNT} is {STATUS}",
    'title'=>'Loan Status successfully'
  ),  
  'loanpaid'=>array(
    'message'=> '{CURRENCY} {AMOUNT} has been paid successfully.',
    'title'=>'Loan paid successfully.'
    ),
    'loaninterest'=>array(
    'message'=> 'Interest {CURRENCY} {AMOUNT}  has been deducted.',
    'title'=>'Interest has been deducted'
    ),
    'cashout'=>array(
      'message'=> '{CURRENCY} {AMOUNT} has been transfered to {TRANSFERED}.',
      'title'=>'Loan amount transfer successfully.'
    ) 
));

define('DERMALOG',array(
'0' => 'Pending',
'1' => 'Refused',
'2' => 'Verified',
'3' => 'Requested'
));
define('NIFDOC',array(
  '0' => 'Pending',
  '1' => 'Refused',
  '2' => 'Verified',
  '3' => 'Requested'
  ));
define('NOTIFICATION_ICON',array(
  'check'=>'fas fa-credit-card',
  'cash' > 'fas fa-file-invoice-dollar',
  'fund'=>"fas fa-file-invoice-dollar",
  'profile'=>'fas fa-cloud-upload-alt',
  'investment'=>'fas fa-business-time',
  'NIF'=>'fas fa-clipboard-check'
));
define('API_ACCESS_KEY','AAAA6d881Jc:APA91bGDuu83Y16KlNtkdlQOj1P8qVh37ugGuRjjbgPNCjm3aMRnNbaY7n52mwHxZdnzV6qd7JcOvL7Nmy5xthcrz8UqIsUmQU9DJTzpOwGb-WR9eApxnSnl6skBgM3fQubEOSsZyYAO');
<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// image
define('PATH_FILE_IMAGE', 'data/img/');

// redirect verify email


// Temple category
define('TEMPLE_CATE', array('1' => 'วัดในโครงการ', '2' => 'เว็ปไซต์วัด ICT', '3' => 'วัดพื้นที่การเรียนรู้'));

// Knowledge category
define('KNOWLEDGE_CATE', array(
  // '1' => 'การออกแบบวัด',
  // '2' => 'การออกแบบกิจกรรม',
  // '3' => 'การจัดการ',
  // '4' => 'หลักสูตร',
  // '5' => 'ถอดบทเรียน/งานวิจัย',
  // '6' => 'ICT เพื่อการเผยแผ่ธรรม',

  '1' => 'การออกแบบอาคารในวัด',
  '2' => 'การออกแบบและจัดทำนิทรรศการในวัด',
  '3' => 'การจัดการน้ำในวัด',
  '4' => 'การออกแบบผังแม่บท',
  '5' => 'การออกแบบและปรับปรุงวัดโบราณสถาน',
  '6' => 'การปรับภูมิทัศน์ของวัด',
  '7' => 'การออกแบบผังแม่บท (งานวิจัย)',
  '8' => 'งานวิจัยฉบับอ่านง่าย',
  '9' => 'การส่งเสริมพื้นที่สุขภาวะสร้างารรค์ในวัด',
  
  
));

define('NEW_ACTIVITY_CATE', array(
  '1' => 'กิจกรรมส่งเสริมสุขภาวะทางกาย ใจ สังคม ปัญญา > กิจกรรมเด็ก',
  '2' => 'กิจกรรมส่งเสริมสุขภาวะทางกาย ใจ สังคม ปัญญา > กิจกรรมผู้สูงอายุ',
  '3' => 'กิจกรรมส่งเสริมสุขภาวะทางกาย ใจ สังคม ปัญญา > กิจกรรมคนวัยทํางาน',
  '4' => 'กิจกรรมจิตอาสา',
  '5' => 'กิจกรรมถวายความรู้พระสงฆ์ > กิจกรรมดูงานวัดนําร่อง/พื้นที่การเรียนรู้',
  '6' => 'กิจกรรมถวายความรู้พระสงฆ์ > กิจกรรมอบรม',
  '7' => 'กิจกรรมแรกเปลี่ยนการเรียนรู้ > ฟอรั่มวัดบันดาลใจ',
  '8' => 'กิจกรรมแรกเปลี่ยนการเรียนรู้ > งานเสวนา',
));

// media
define('MEDIA_CATE', array(
  '1' => 'วิดีโอ',
  '2' => 'รูปภาพ',
  '3' => 'เสียง',
  '4' => 'อีบุ๊ค'
));

define('MEDIA_CATE_NEW', array(
  '1' => 'วัดบันดาลใจ The Series',
  '2' => 'หลักสูตรวัดบันดาลใจ',
  '3' => 'Talk/Forum',
  '4' => 'วัดในโครงการ',
  '5' => 'Inspiration',
  '6' => 'อื่นๆ'
));

define('MEDIA_PHOTO_CATE', array(
  '1' => 'ภาพวัดในโครงการ',
  '2' => 'ภาพกิจกรรม',
  '3' => 'ภาพกระบวนการทำงาน',
));

define('ACTIVITY_CATE', array(
  '1' => 'กิจกรรมของโครงการ',
  '2' => 'กิจกรรมวัด ICT ',
  '3' => 'ข่าวสารและการประชาสัมพันธ์'
));

define('ACTIVITY_CATE_SUB', array(
  '2' => 'กิจกรรมวัด ICT ',
  '3' => 'ข่าวสารและการประชาสัมพันธ์'
));

define('TEMPLE_ZONE', array(
  '1' => 'ภาคเหนือ',
  '2' => 'ภาคกลาง',
  '4' => 'ภาคตะวันออกเฉียงเหนือ',
  '5' => 'ภาคใต้',
  '6' => 'สาธารณรัฐประชาธิปไตยประชาชนลาว'
));


define('REGISTER1', array(
  '1' => 'ทำความสะอาด',
  '2' => 'งานช่าง / ซ่อมบำรุงวัด',
  '3' => 'นำสวดมนต์',
  '4' => 'จัดสถานที่ / จัดสถานที่ทำกิจกรรม',
  '5' => 'จัดหนังสือในห้องสมุด'
));
define('REGISTER2', array(
  '1' => 'ปลูกต้นไม้',
  '2' => 'ดูแลสวน',
  '3' => 'ดูแลตกแต่งต้นไม้',
  '4' => 'รุกขกร'
));
define('REGISTER3', array(
  '1' => 'การติดต่อประสานงาน',
  '2' => 'จัดระบบแยกขยะ',
  '3' => 'จัดระบบล้างจาน',
  '4' => 'อำนวนความสะดวกและการจัดการโรงทาน',
  '5' => 'ลงทะเบียนและจัดกิจกรรม'

));

define('REGISTER4', array(
  '1' => 'เก็บข้อมูลวัด',
  '2' => 'มัคคุเทศก์',
  '3' => 'แปลภาษาต่างประเทศ',
  '4' => 'สอนศิลปะในวัด',
  '5' => 'สอนหนังสือเด็ก',
  '6' => 'พิมพ์งาน ถอดเทป',
  '7' => 'เขียนบทความ',
  '8' => 'ออกแบบประชาสัมพันธ์วัด',
  '9' => 'สอนคอมพิวเตอร์',
  '10' => 'ทำสื่อสร้างสรรค์',
  '11' => 'พัฒนาแอพพลิเคชั่น',
  '12' => 'ออกแบบกราฟฟิค',
  '13' => 'อินโฟกราฟฟิค',
  '14' => 'ออกแบบโปสเตอร์',
  '15' => 'ถ่ายวีดิโอ/ถ่ายภาพ',
  '16' => 'โดรน',

));

define('REGISTER_WAT_1', array(
  '1' => 'เผยแพร่หลักธรรม คำสั่งสอนแก่ฆราวาส',
  '2' => 'ส่งเสริมการปฏิบัติธรรม',
  '3' => 'เป็นโรงเรียนพระปริยติธรรม',
  '4' => 'เป็นศูนย์รวมของชุมชนมาประกอบพิธีกรรมทางศาสนา/กิจกรรมทางวัฒนธรรม',
  '5' => 'บทบาทด้านสังคมสงเคราะห์ การพัฒนาชุมชน/ผู้ด้อยโอกาส',
  '6' => 'ส่งเสริมการเรียนรู้/การศึกษาทางโลก เช่น การพัฒนาวิชาชีพ อนามัย การเกษตร การออมทรัพย์ ฯลฯ',
  '7' => 'บทบาทด้านการอนุรักษ์สิ่งแวดล้อม ดูแลรักษาป่่า',
  '8' => 'เป็นโบราณสถานที่สำคัญ',
  '9' => 'เป็นสถานที่ท่องเที่ยวทางศาสนา/ประวัติศาสตร์ วัฒนธรรม',
  '10' => 'เป็นสถานที่ร่มรื่น ให้ชุมชนมาพักผ่อน หาความสงบ',
  '11' => 'อื่นๆ โปรดระบุ'
));

define('REGISTER_WAT_2', array(
  '1' => 'การออกแบบวัด',
  '2' => 'การออกแบบกิจกรรม',
  '3' => 'การจัดการ/ระบบ ICT ในวัด',
  '4' => 'หลักสูตรวัดบันดาลใจ',
  '5' => 'อื่นๆโปรดระบุ'
));

define('REGISTER_WAT_3', array(
  '1' => 'รับข่าวสารโครางการทางอีเมล์',
  '2' => 'แจ้งเตือนกิจกรรมที่สมัครผ่านทางอีเมล์',
  '3' => 'ติดต่อผ่านทางอีเมลเมื่อมีงานอาสาที่เหมาะกับท่าน',
  '4' => 'โทรติดต่อเมื่อมีงานอาสาที่เหมาะสมกับท่าน'
));

define('VOLUNTEERCOM_CATE', array(
  '1' => 'ภูมิสถาปนิก',
  '2' => 'สถาปนิก',
  '3' => 'วิศวกร',
  '4' => 'อื่นๆ'
));

define('SLIDE_CATE', array(
  '1' => 'หน้าแรก',
  '2' => 'เกี่ยวกับเรา 1',
  '3' => 'เกี่ยวกับเรา 2',
  '4' => 'สื่อของโครงการ'
));



define('TEMPLENEW_REGION', array(
  'northern' => 'ภาคเหนือ',
  'northeastern' => 'ภาคตะวันออกเฉียงเหนือ',
  'central' => 'ภาคกลาง',
  'southern' => 'ภาคใต้'
));

// Land
define('FAQ_CATE', array(
  '1' => 'Cate 1',
  '2' => 'Cate 2',
  '3' => 'Cate 3',
));

define('COUNTRY_CATE', array(
  '1' => 'Thailand',
  '2' => 'Indonesia',
  '3' => 'Malaysia',
));

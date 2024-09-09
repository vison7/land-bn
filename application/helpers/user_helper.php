<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Code Igniter User info Helpers
 *
 * encrypt/decrypt cookie
 * please define constant ENCRYPTION_KEY
 * example: define('ENCRYPTION_KEY','a658260cfc28121371f552f78d460d3c');
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category        Helpers
 * @author       vison sunon < gangzaa@gmail.com >
 */
// ------------------------------------------------------------------------

/**
 * get user info login Helper
 *
 * Helps get user info.
 *
 * @access        public
 * @return        array    user info
 */
if (!function_exists('get_user_login')) {

    function get_user_login()
    {
        $userinfo = new stdClass();
        if (isset($_COOKIE['userinfo']) and !empty($_COOKIE['userinfo'])) {
            $cookies = string_decrypt($_COOKIE['userinfo']);
            $userinfo = json_decode($cookies);
        }
        return $userinfo;
    }

}
if (!function_exists('member_check_access')) {

    function member_check_access()
    {
        $u = get_user_login();
        if (!isset($u->id) || empty($u->id)) {
            redirect('/');
        }

    }

}

/**
 * user check access control Helper
 *
 * Helps check access control
 *
 * @access        public
 * @return        boolean
 */
if (!function_exists('acl_user_auth')) {

    function acl_user_auth($user_id = '')
    {
        if (@get_user_login()->id == '') {
            $CI = &get_instance();
            $str = $CI->load->view('notallow', null, true);
            print($str);
            exit;
        }
    }

}

/**
 * get admin info login Helper
 *
 * Helps get admin info.
 *
 * @access        public
 * @return        array    admin info
 */
if (!function_exists('get_admin_login')) {

    function get_admin_login()
    {
        $u = new stdClass();

        $CI = &get_instance();
        $key = $CI->config->item('encryption_key');

        if (isset($_COOKIE['admininfo']) and !empty($_COOKIE['admininfo'])) {
            $cookies = string_decrypt($_COOKIE['admininfo'], $key);

            $u = json_decode($cookies);
        }
        return $u;
    }

}

if (!function_exists('admin_get_temple')) {

    function admin_get_temple()
    {
        $u = get_admin_login();
        if ($u->is_level != '1') {
            if ($u->is_level == '2' && $u->temple_id == '0') {
                return '';
            } else {
                return (string) $u->temple_id;
            }
        } else {
            return '';
        }
    }

}
/**
 * get admin info login Helper
 *
 * Helps get admin info.
 *
 * @access        public
 * @return        array    admin info
 */
if (!function_exists('admin_check_access')) {

    function admin_check_access()
    {
        $u = get_admin_login();
        if (!isset($u->id) || empty($u->id)) {
            redirect('/');
        }

    }

}

/**
 * get admin info login Helper
 *
 * Helps get admin info.
 *
 * @access        public
 * @return        array    admin info
 */
if (!function_exists('admin_check_level')) {

    function admin_check_level($levels = array())
    {
        $u = get_admin_login();
        if (isset($u->is_level) || !empty($u->is_level)) {

            if (in_array(trim($u->is_level), $levels)) {

            } else {
                echo "Not allow";
                exit;
            }
        } else {
            redirect('/');
        }
    }

}

/**
 * Basic encryption Helper
 *
 * @access        public
 * @param        string    encryption string
 * @param        string    encryption key
 * @return        string    encryption string
 */
if (!function_exists('string_encrypt')) {

    function string_encrypt($string)
    {
        $CI = &get_instance();
        $key = $CI->config->item('encryption_key');

        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }

}

/**
 * Basic decryption Helper
 *
 * @access        public
 * @param        string    decryption string
 * @param        string    decryption key
 * @return        string    decryption string
 */
if (!function_exists('string_decrypt')) {

    function string_decrypt($string)
    {
        $CI = &get_instance();
        $key = $CI->config->item('encryption_key');

        $result = '';
        $string = base64_decode($string);

        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }

}

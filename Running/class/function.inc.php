<?php

class Functions {

    function disable_error() {
        error_reporting(0);
    }

// end function disable_error

    function session_enable() {
        ob_start();
        session_start();
    }

//end of function session_enable

    function session_disable() {
        session_unset();
    }

// end function session_disable

    function page_redirect($pagename) {
        echo '<script type="text/javascript">';
        echo 'window.location = "' . $pagename . '"';
        echo '</script>';
    }

// end function page_redirect

    function page_redirect_msg($pagename, $msg) {
        echo '<script type="text/javascript">';
        echo 'window.location = "' . $pagename . '?msg=' . $msg . '"';
        echo '</script>';
    }

// end function page_redirect
    function set_timezone() {
        date_default_timezone_set(validate(TIMEZONE));
    }

// end function page_redirect
    function display_date() {
        echo date("d-m-Y");
    }

    function return_date() {
        return date("d-m-Y");
    }

    function display_date_time() {
        echo date("d-m-Y H:i:s");
    }

    function return_date_time() {
        return date("d-m-Y H:i:s");
    }

    function return_time() {
        return date("h:i A");
    }

// end function page_redirect
}

// end class Functions
?>
<?php

/*
Plugin Name: Saternus email cheat
Plugin URI:  http://robertsaternus.pl
Description: Plugin zapisujący email do pliku? **TYLKO DLA VERSJI DEV*!!!
Version:     1.0
Author:      Robert Saternus
Author URI:  http://robertsaternus.pl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

//require_once('dev-utils.php');


if ( !function_exists( 'wp_mail' ) ) :

    function wp_mail( $to, $subject, $message, $headers = '', $attachments = array() ) {

        $date = date('Y-m-d H:i:s');
        $mail_log = "##Email ({$date}) ## \nTo: {$to} \nSubject: {$subject} \nMessage: {$message}\n";
        $filename = __DIR__.DIRECTORY_SEPARATOR.'emial.log';

        file_put_contents($filename, $mail_log, FILE_APPEND);

    }
endif;


//wp_mail('robert.saternus@gmail.com', 'temat', 'nowy komentarz' );
<?php

/*
Plugin Name: Plugin copyrights
Plugin URI:  http://robertsaternus.pl
Description: Plugin dodający notkę po załadowaniu contentu wpisu
Version:     1.0
Author:      Robert Saternus
Author URI:  http://robertsaternus.pl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

//require_once('dev-utils.php');


function saternus_copyrights($content){

    $copyrights = "<p class='copyrights'>Written by: Robert Saternus &copy</p>";
    $content = $content.' <br /> <br /> '.$copyrights;
    return $content;
}

add_filter( 'the_content', 'saternus_copyrights' );

function copyrights_add_style(){

    echo '<style>
        p.copyrights{
            background: orange;
            padding: 10px;
            color: #fff;
        }
        
    </style>';

}

add_action('wp_head', 'copyrights_add_style');

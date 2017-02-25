<?php

/*
Plugin Name: Love to eat - cytaty
Plugin URI:  http://robertsaternus.pl
Description: Cytaty które się przeładowują przy odświerzaniu strony
Version:     1.0
Author:      Robert Saternus
Author URI:  http://robertsaternus.pl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

require_once('dev-utils.php');


function saternus_plugin_get_cytaty(){

    $quotes = [
        'Cytay 1',
        'Cytat 2',
        'Cytat 3',
        'Cytay 4',
        'Cytat 5'
    ];

    return $quotes[rand(0, (count($quotes) - 1))];

}

function saternus_plugin_cytaty(){
    $quote = saternus_plugin_get_cytaty();
    my_log($quote);
    echo '<p> "'.$quote.'"</p>';
}
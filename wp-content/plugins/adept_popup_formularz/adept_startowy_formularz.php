<?php

/*
Plugin Name: Adept: Startowy formularz
Plugin URI:  http://robertsaternus.pl
Description: Dedykowana wtyczka dla strony uwodzenie.org z formularzem pop-up na stronie startowej
Version:     1.0
Author:      Robert Saternus
Author URI:  http://robertsaternus.pl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


function adept_form_on_first_visit(){

    $cookie_name = "cookie_form";
    $cookie_value = "adept_form_on_start_page";
    setcookie($cookie_name, $cookie_value, 0, "/");

    if(!isset($_COOKIE[$cookie_name])) {
        echo adept_show_form();
    } else {
//        echo "Modal box is not showing";
//        echo adept_show_form();
    }

};

add_action( 'init', 'adept_form_on_first_visit' );


function adept_add_my_stylesheet() {
    wp_register_style( 'adept_style', plugins_url('/css/style.css', __FILE__) );
    wp_enqueue_style( 'adept_style' );
}

add_action( 'wp_enqueue_scripts', 'adept_add_my_stylesheet' );


function adept_show_form(){

$modal_box = '    

    <div id="szabelski_startowa" class="modal_box">
        
        <a href = "javascript:void(0)" onclick = "document.getElementById(\'szabelski_startowa\').style.display=\'none\';">
            <img class="close_button" src="http://uwodzenie.org/1366820978_Close.png" alt="close_buton" />
        </a>
        
        <div class="info_box">
        
            <h2>Formuła Seksualnej Atrakcyjności</h2>
            <h3>„Gotowe Teksty – Jak Rozmawiać z Kobietami, <br /> Aby Stać Się Ich Fantazją”</h3>
            <h5>Wpisz Adres E-mail, Na Który Otrzymasz Ebook:</h5>
            
            <script language="javascript"> 
            
                function SprawdzFormularz(f) { 
                    if (f.email.value==\'\') 
                        { alert(\'Nie podałeś/aś adresu e-mail.\'); 
                        return false; 
                    } 
                    
                    if ( ((f.email.value.indexOf(\'@\',1))==-1)||(f.email.value.indexOf(\'.\',1))==-1 ) { 
                        alert(\'Podałeś/aś błędny adres e-mail\'); 
                        return false; 
                    } 
                    else { 
                        return true; 
                    } 
                } 
            </script> 
            
            <form target="_blank" action="http://www.uwodzenie.org/get.php" name="impleBOT.pl" method="post" onsubmit="return SprawdzFormularz(this)"> 
                <input name="uid" type="hidden" value="67931"> 
                <input name="zrodlo" type="hidden" value="startowa_div">

                <input class="email-input" name="email" type="email">
                
                <input class="submit_input" type="submit" value="POBIERZ EBOOK"> 
                
            </form>
        
        </div>
    </div>
';

    if(!is_admin()){
        return $modal_box;
    }
    else{
        return '';
    }

}



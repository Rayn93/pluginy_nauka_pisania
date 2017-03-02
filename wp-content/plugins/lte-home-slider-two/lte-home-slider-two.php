<?php

/*
Plugin Name: Love To Eat Home Slider 2
Plugin URI:  http://robertsaternus.pl
Description: Dynamiczny slajder na stronie głównej
Version:     1.0
Author:      Robert Saternus
Author URI:  http://robertsaternus.pl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

require_once 'libs/LTEHomesSlider_Model.php';
require_once 'libs/Request.php';


class LTE_home_slider{

    private static $plugin_id = 'saternus-home-slider';
    private $plugin_version = '1.0.0';
    private $model;
    private $capability = 'manage_options';

    function __construct(){

        $this->model = new LTE_Homes_Slider_Model();

        //Urachamianie podczas aktywacji pluginu
        register_activation_hook(__FILE__, array($this, 'onActivate'));

        //Rejestracja admin menu dla wtyczki
        add_action('admin_menu', array($this, 'create_admin_menu') );

        //Dodawanie stylów css i skryotów js dla admina
        add_action('admin_enqueue_scripts', array($this, 'add_admin_page_scripts') );

        //Podpięcie AJAX
        add_action('wp_ajax_checkValidPosition', array($this, 'check_valid_position'));
        add_action('wp_ajax_getLastFreePosition', array($this, 'show_last_position'));


        //DEBUGING
        //var_dump($this->model->get_last_free_position());

    }

    function add_admin_page_scripts(){

        wp_register_script('lte-script', plugins_url('/js/scripts.js', __FILE__), array('jquery', 'media-upload', 'thickbox'));

        if(get_current_screen()->id == 'toplevel_page_'.static::$plugin_id){

            wp_enqueue_script('jquery');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('lte-script');

        }

    }

    function onActivate(){

        $ver_opt = static::$plugin_id.'-version';
        $installed_ver = get_option($ver_opt, NULL);

        if($installed_ver == NULL){
            $this->model->createDBtable();
            update_option($ver_opt, $this->plugin_version);
        }
        else{

            switch (version_compare($installed_ver, $this->plugin_version)){

                case 0:
                    //ZAINSTALOWANA VERSJ JEST IDENTYCZNA
                    break;

                case 1:
                    //ZAINSTALOWANA WERSJA JEST NOWASZA
                    break;

                case -1:
                    //ZAINSTALOWANA WERSJA JEST STARSZA
                    break;
            }
        }
    }


    function home_slider_menu_page(){

        $request = Request::instance();
        $view = $request->getQuerySingleParam('view', 'index');

        switch ($view){
            case 'index':
                $this->render('index');
                break;

            case 'form':
                $this->render('form');
                break;
            default:
                $this->render('404');

        }
    }


    function check_valid_position(){

        $position = isset($_POST['position']) ? (int)$_POST['position'] : 0;

        $massage = '';

        if($position < 1){
            $massage = 'Podana wartość jest niepoprawna. Podana liczba musi być liczbą większą od 0';
        }
        else{

            if(!$this->model->is_empty_position($position)){
                $massage = 'Podana przez Ciebie pozycja jest już zajeta';
            }
            else{
                $massage = 'Ta pozycja jest wolna';
            }
        }

        echo $massage;
        die;
    }

    function show_last_position(){

        echo $this->model->get_last_free_position();
        die;

    }



    function create_admin_menu(){
        add_menu_page( 'LTE home slider', 'Home slider', $this->capability, static::$plugin_id, array($this, 'home_slider_menu_page' ));
    }

    private function render($view){

        $theme_path = plugin_dir_path(__FILE__).'themes/';

        $view = $theme_path.$view.'.php';

        require_once $theme_path.'layout.php';
    }


}

$LTE_Home_Slider = new LTE_home_slider();


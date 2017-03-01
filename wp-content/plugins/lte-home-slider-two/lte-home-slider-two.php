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


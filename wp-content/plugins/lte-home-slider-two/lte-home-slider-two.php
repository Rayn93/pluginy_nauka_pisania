<?php
ob_start();
session_start();

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
require_once 'libs/LTE_SlideEntity.php';
require_once 'libs/Pagination.php';
require_once 'libs/Request.php';
require_once 'libs/functions.php';


//Główna klasa wtyczki - kontroler wtyczki
class LTE_home_slider{

    private static $plugin_id = 'saternus-home-slider';
    private $plugin_version = '1.0.0';
    private $model;
    private $capability = 'manage_options';

    private $action_token = 'lte-hs-action';
    private $pagination_limit = 5;

    function __construct(){

        $this->model = new LTE_Homes_Slider_Model();

        //Urachamianie podczas aktywacji pluginu
        register_activation_hook(__FILE__, array($this, 'onActivate'));

        //Uruchamiany podczas desinstalacji pluginu
        register_activation_hook(__FILE__, array('LTE_home_slider', 'onUninstall'));

        //Rejestracja admin menu dla wtyczki
        add_action('admin_menu', array($this, 'create_admin_menu') );

        //Dodawanie stylów css i skryotów js dla admina
        add_action('admin_enqueue_scripts', array($this, 'add_admin_page_scripts') );

        //Podpięcie AJAX
        add_action('wp_ajax_checkValidPosition', array($this, 'check_valid_position'));
        add_action('wp_ajax_getLastFreePosition', array($this, 'show_last_position'));



        //DEBUGING
//        $slide_entry = new LTE_SlideEntity();
//        var_dump($this->model->fetch_row(3));

    }

    //Dodawanie styli css i skryptów js do widoku pluginu
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

    //Funkcja odpalana przy aktywacji pluginu (tworzy tabelę w bazie, sprawdza versję pluginu)
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

    static function onUninstall(){

        $model = new LTE_Homes_Slider_Model();
        $model->drop_table();
        $ver_opt = static::$plugin_id.'-version';
        delete_option($ver_opt);

    }



    //Mechanizm routingu + obsługa poszczególnych widoków Główny kontroler pluginu
    function home_slider_menu_page(){

        $request = Request::instance();
        $view = $request->getQuerySingleParam('view', 'index');
        $action = $request->getQuerySingleParam('action');
        $slideid = (int)$request->getQuerySingleParam('slideid');

        switch ($view){
            case 'index':

                $curr_page = (int)$request->getQuerySingleParam('paged', 1);
                $order_by = $request->getQuerySingleParam('orderby', 'id');
                $order_dir = $request->getQuerySingleParam('orderdir', 'asc');



                $pagination = $this->model->get_pagination($curr_page, $this->pagination_limit, $order_by, $order_dir );
                
                if($action == 'delete' ){

                    $token_name = $this->action_token.'_'.$slideid;
                    $wp_nonce = $request->getQuerySingleParam('_wpnonce', NULL);

                    if(wp_verify_nonce($wp_nonce, $token_name)){
                        if($this->model->delete_slajd($slideid)){
                            $this->set_flash_msg('Poprawnie usunięto wpis o id = '.$slideid);
                            $this->redirect($this->get_admin_url());
                        }
                        else{
                            $this->set_flash_msg('Błąd podczas usuwania slajdu z bazy. Spróbuj później');
                            $this->redirect($this->get_admin_url());
                        }
                    }
                    else{
                        $this->set_flash_msg('Niepoprawny token!');
                        $this->redirect($this->get_admin_url());
                    }
                }

                elseif($action == 'bulk'){

                    $token_name = $this->action_token.'bulk';

                    if( $request->isMethod('POST') && check_admin_referer($token_name)){

                        $bulk_action = (isset($_POST['bulkaction']) ? $_POST['bulkaction'] : NULL);
                        $bulk_checked = (isset($_POST['bulkcheck']) ? $_POST['bulkcheck'] : array());

                        if(count($bulk_checked) < 1){
                            $this->set_flash_msg('Brak slajdów do zmiany.', 'error');
                        }
                        elseif($bulk_action == 'delete'){

                            if($this->model->bulk_delete($bulk_checked) != FALSE){
                                $this->set_flash_msg('Poprawnie usunięto zaznaczone wpisy');
                            }
                            else{
                                $this->set_flash_msg('Nie udało się usunąć wpisów', 'error');
                            }

                        }
                        elseif ($bulk_action == 'public' || $bulk_action == 'private'){

                            if($this->model->bulk_change_visibility($bulk_checked, $bulk_action) != FALSE){
                                $this->set_flash_msg('Poprawnie zmieniono status slajdów na'.$bulk_action.'.');
                            }
                            else{
                                $this->set_flash_msg('Nie zmieniono statusu slajdów', 'error');
                            }

                        }
                    }
                    $this->redirect($this->get_admin_url());

                }

                $this->render('index', array(
                    'Pagination' => $pagination
                ));
                break;

            case 'form':

                if($slideid > 0){
                    $slide_entry = new LTE_SlideEntity($slideid);

                    if(!$slide_entry->exist()){
                        $this->set_flash_msg('Podany slajd nie istnieje', 'error');
                        //przekierowanie na index
                        $this->redirect($this->get_admin_url());
                    }

                }
                else{
                    $slide_entry = new LTE_SlideEntity();
                }


                if($action == 'save' && $request->isMethod('POST') && isset($_POST['entry'])){

                    if( check_admin_referer($this->action_token)){
                        $slide_entry->set_fields($_POST['entry']);

                        if($slide_entry->validate()){

                            $entry_id = $this->model->save_entry($slide_entry);

                            if($entry_id !== FALSE){
                                if($slide_entry->has_id()){
                                    $this->set_flash_msg('Poprawnie zmodyfikowano slajd');
                                }
                                else{
                                    $this->set_flash_msg('Poprawnie dodano nowy slajd');
                                    $this->redirect($this->get_admin_url(array('view' => 'form', 'slideid' => $entry_id)));
                                }

                            }
                            else{
                                $this->set_flash_msg('Wystąpił błąd z zapisem do bazy danych. Skontaktuj się z developerem wtyczki', 'error');
                            }
                        }
                        else{
                            $this->set_flash_msg('Niepoprawnie wypełniłeś formularz. Popraw błędy w formularzu i wyślij ponownie', 'error');
                        }
                    }
                    else{

                        $this->set_flash_msg('Błędny token formularza', 'error');

                    }


                }

                $this->render('form', array(
                    'slide' => $slide_entry
                ));

                break;
            default:
                $this->render('404');

        }
    }

    //Sprawdzenie poprawności pola 'position' w formularzu
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

    //Zwraca ostatnią wolną pozycję slajdu dla formularza
    function show_last_position(){

        echo $this->model->get_last_free_position();
        die;
    }

    //Tworzy menu dla wtyczki w kokpicie
    function create_admin_menu(){
        add_menu_page( 'LTE home slider', 'Home slider', $this->capability, static::$plugin_id, array($this, 'home_slider_menu_page' ));
    }

    //Mechanizm routingu - renderuje odpowiedni widok
    private function render($view, array $args = array()){

        extract($args);
        $theme_path = plugin_dir_path(__FILE__).'themes/';
        $view = $theme_path.$view.'.php';
        require_once $theme_path.'layout.php';
    }

    //Zwraca url wtyczki wraz z odpowiednimi parametrami (view i action)
    public function get_admin_url(array $params = array()){

        $admin_url = admin_url().'admin.php?page='.static::$plugin_id;
        $admin_url = add_query_arg($params, $admin_url);

        return $admin_url;
    }


    //Wiadomości i statusy flesh zwracane przy wysyłaniu formularza
    public function set_flash_msg($massage, $status = 'updated'){

        $_SESSION[__CLASS__]['massage'] = $massage;
        $_SESSION[__CLASS__]['status'] = $status;

    }

    public function get_flash_msg(){

        if(isset($_SESSION[__CLASS__]['massage'])){
            $msg = $_SESSION[__CLASS__]['massage'];
            unset($_SESSION[__CLASS__]);
            return $msg;
        }
        else{
            return NULL;
        }
    }

    public function get_flash_status(){

        if(isset($_SESSION[__CLASS__]['status'])){
            return $_SESSION[__CLASS__]['status'];
        }
        else{
            return NULL;
        }
    }

    public function has_flash_msg(){
        return (isset($_SESSION[__CLASS__]['massage']));
    }


    public function redirect($location){
        wp_safe_redirect($location);
        die;
    }


}

$LTE_Home_Slider = new LTE_home_slider();

ob_flush();
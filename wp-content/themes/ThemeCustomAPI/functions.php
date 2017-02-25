<?php

    //https://codex.wordpress.org/Theme_Customization_API
    //http://wp.tutsplus.com/tutorials/theme-development/digging-into-the-theme-customizer-overview/

    class Edu_TCA {

        function __construct() {
            
            add_action('customize_register', array($this, 'register'));
            
            add_action('wp_head', array($this, 'generate_output'));
        }
        

        function register($wp_customize) {
            
            $wp_customize->add_section('tcapi_moja_sekcja', array(
                'title' => 'Moja Nowa Sekcja'
            ));

            
            //zmiana koloru nagłówków
            $wp_customize->add_setting('tcapi_header_textcolor', array(
                'default' => '#000'
            ));
            
            $wp_ccc = new WP_Customize_Color_Control($wp_customize, 'tcapi_hcolor', array(
                'label' => 'Ustaw kolor nagłówków',
                'section' => 'tcapi_moja_sekcja',
                'settings' => 'tcapi_header_textcolor'
            ));
            
            $wp_customize->add_control($wp_ccc);
            
            
            //zmiana koloru tła
            $wp_customize->add_setting('tcapi_bg_color', array(
                'default' => '#ccc'
            ));
            
            $wp_ccc = new WP_Customize_Color_Control($wp_customize, 'tcapi_bgcolor', array(
                'label' => 'Ustaw kolor tła',
                'section' => 'tcapi_moja_sekcja',
                'settings' => 'tcapi_bg_color'
            ));
            
            $wp_customize->add_control($wp_ccc);
        }
        
        
        function generate_output(){
            ?>
            <style>
                <?php $this->generate_css('h1, h2, h3', 'color', 'tcapi_header_textcolor'); ?>
                <?php $this->generate_css('body', 'background-color', 'tcapi_bg_color'); ?>
            </style>
            <?php
        }
        
        private function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true) {
            $return = '';
            $mod = get_theme_mod($mod_name);
            if (!empty($mod)) {
                $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
                );

                if ($echo) {
                    echo $return;
                }
            }
            return $return;
        }

    }

    $Edu_TCA = new Edu_TCA();
    
    
?>
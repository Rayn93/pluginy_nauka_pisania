<?php

class LTE_SlideEntity{

    private $id = NULL;
    private $slide_url = NULL;
    private  $title = NULL;
    private $caption = NULL;
    private $read_more_url = NULL;
    private  $position = NULL;
    private  $published = 'yes';

    private  $errors = array();



    function get_field($field){

        if(isset($this->{$field})){
            return $this->{$field};
        }
        return NULL;
    }

    function set_fields($fields){
        foreach ($fields as $key => $val){
            $this->{$key} = $val;
        }
    }

    function setError($field, $error){
        $this->errors[$field] = $error;
    }

    function getError($field){
        if(isset($this->errors[$field])){
            return $this->errors[$field];
        }

        return NULL;
    }

    function hasError($field){
        return isset($this->errors[$field]);
    }

    function hasErrors(){
        return (count($this->errors) > 0);
    }

    function is_published(){
        return ($this->published == 'yes');
    }


    function validate(){

        /*
         * slide_url:
         * - nie może być puste
         * - musi być poprawnym URL'em
         * - po oczyszczeniu url nie może być dłuższy niż 255 znaków
         */
        if(empty($this->slide_url)){
            $this->setError('slide_url', 'To pole nie może być puste');
        }else
            if(!filter_var($this->slide_url, FILTER_VALIDATE_URL)){
                $this->setError('slide_url', 'To pole musi być poprawnym adresem URL');
            }else
                if(strlen($this->slide_url) > 255){
                    $this->setError('slide_url', 'To pole nie może być dłuższe niż 255 znaków.');
                }


        /*
         * pole title:
         * - nie może być puste
         * - maksymalna długość 255 znaków
         */
        if(empty($this->title)){
            $this->setError('title', 'To pole nie może być puste');
        }else
            if(strlen($this->title) > 255){
                $this->setError('title', 'To pole nie może być dłuższe niż 255 znaków.');
            }



        /*
         * pole caption:
         * - może być puste
         * - jeżeli nie puste:
         *      - usuń niebezpieczny html (zostaw tylko strong i b)
         *      - maksymalna długość to 255 znaków
         *
         */
        if(!empty($this->caption)){
            $allowed_tags = array(
                'strong' => array(),
                'b' => array()
            );

            $this->caption = wp_kses($this->caption, $allowed_tags);

            if(strlen($this->caption) > 255){
                $this->setError('caption', 'To pole nie może być dłuższe niż 255 znaków.');
            }
        }



        /*
         * pole read_more_url:
         * - może być puste
         * - jeżeli nie puste:
         *      - po wyczyszczeniu url nie może być dłuższy niż 255 znaków
         */
        if(!empty($this->read_more_url)){

            $this->read_more_url = esc_url($this->read_more_url);

            if(strlen($this->read_more_url) > 255){
                $this->setError('read_more_url', 'To pole nie może być dłuższe niż 255 znaków.');
            }

        }



        /*
         * pole position:
         * - pole wymagane, nie moze być puste
         * - rzutowanie wartości do integera
         * - musi być to liczba większa od 0
         */
        if(empty($this->position)){
            $this->setError('position', 'To pole nie może być puste.');
        }else{
            $this->position = (int)$this->position;
            if($this->position < 1){
                $this->setError('position', 'To pole musi być liczbą większą od 0.');
            }
        }



        /*
         * pole published:
         * - musi zostać ustawione na 'yes' lub 'no'
         */
        if(isset($this->published) && $this->published == 'yes'){
            $this->published = 'yes';
        }else{
            $this->published = 'no';
        }


        return (!$this->hasErrors());
    }




}
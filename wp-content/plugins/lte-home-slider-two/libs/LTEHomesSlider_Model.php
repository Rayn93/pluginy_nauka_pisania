<?php

class LTE_Homes_Slider_Model{

    private $table = 'lte_home_slider';
    private $wpbd;

    function __construct(){

        global $wpdb;
        $this->wpbd = $wpdb;
    }

    function getTableName(){
        return $this->wpbd->prefix.$this->table;
    }

    function createDBtable(){

        $table_name = $this->getTableName();

        $sql = '
            CREATE TABLE '.$table_name.' (
            id INT NOT NULL AUTO_INCREMENT,
            slide_url varchar(255) NOT NULL,
            title varchar(255) NOT NULL,
            caption varchar(255) DEFAULT NULL,
            read_more_url varchar(255) DEFAULT NULL,
            position INT NOT NULL,
            published enum("yes", "no") NOT NULL DEFAULT "yes",
            PRIMARY KEY  (id)
	        ) ENGINE = InnoDB DEFAULT CHARSET = utf8';

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

    }

    function is_empty_position($position){

        $position = (int)$position;
        $table_name = $this->getTableName();

        $sql = "SELECT COUNT(*) FROM {$table_name} WHERE position = %d ";

        $prep = $this->wpbd->prepare($sql, $position);
        $count = (int)$this->wpbd->get_var($prep);

        return ($count < 1);
    }

    function get_last_free_position(){
        $table_name = $this->getTableName();

        $sql = "SELECT MAX(position) FROM {$table_name}";

        $result = (int)$this->wpbd->get_var($sql);

        return ($result+1);


    }

}
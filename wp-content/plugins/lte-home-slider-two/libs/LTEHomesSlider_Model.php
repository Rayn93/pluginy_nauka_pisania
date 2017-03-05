<?php


//Klasa odpowiadająca za komunikację z bazą danych
class LTE_Homes_Slider_Model{

    private $table = 'home_slider';
    private $wpbd;

    function __construct(){

        global $wpdb;
        $this->wpbd = $wpdb;
    }

    //Zwraca nazwę tabeli (z prefiksem)
    function getTableName(){
        return $this->wpbd->prefix.$this->table;
    }

    //Tworzenie nowej tabeli w bazie danych
    function createDbTable(){

        $table_name = $this->getTableName();

        $sql = '
            CREATE TABLE IF NOT EXISTS '.$table_name.'(
                id INT NOT NULL AUTO_INCREMENT,
                slide_url VARCHAR(255) NOT NULL,
                title VARCHAR(255) NOT NULL,
                caption VARCHAR(255) DEFAULT NULL,
                read_more_url VARCHAR(255) DEFAULT NULL,
                position INT NOT NULL,
                published enum("yes", "no") NOT NULL DEFAULT "yes",
                PRIMARY KEY(id)
            )ENGINE=InnoDB DEFAULT CHARSET=utf8';

        require_once ABSPATH.'wp-admin/includes/upgrade.php';

        dbDelta($sql);
    }

    //Sprawdza czy podana przez użytkownika pozycja slajdu jest wolna w bazie
    function is_empty_position($position){

        $position = (int)$position;
        $table_name = $this->getTableName();

        $sql = "SELECT COUNT(*) FROM {$table_name} WHERE position = %d ";

        $prep = $this->wpbd->prepare($sql, $position);
        $count = (int)$this->wpbd->get_var($prep);

        return ($count < 1);
    }

    //Zwraca ostatnią wolną pozycję slajdu (dla przycisku w formularzu)
    function get_last_free_position(){
        $table_name = $this->getTableName();

        $sql = "SELECT MAX(position) FROM {$table_name}";

        $result = (int)$this->wpbd->get_var($sql);

        return ($result+1);
    }

    //Funkcja odpowiadająca za zapis instancjo entry do bazy danych
    function save_entry(LTE_SlideEntity $entry){

        $toSave = array(
            'slide_url' => $entry->get_field('slide_url'),
            'title' => $entry->get_field('title'),
            'caption' => $entry->get_field('caption'),
            'read_more_url' => $entry->get_field('read_more_url'),
            'position' => $entry->get_field('position'),
            'published' => $entry->get_field('published'),
        );

        $mapped = array('%s', '%s', '%s', '%s', '%d', '%s');

        $table_name = $this->getTableName();

        if($entry->has_id()){
            if($this->wpbd->update( $table_name, $toSave, array('id' => $entry->get_field('id')), $mapped, '%d' )){
                return $entry->get_field('id');
            }
            else{
                return FALSE;
            }
        }

        else{
            if($this->wpbd->insert($table_name, $toSave, $mapped)){

                return ($this->wpbd->insert_id);

            }
            else{
                return FALSE;
            }
        }
    }

    //pobranie danych o konkretnym id z bazy danych
    function fetch_row($id){

        $table_name = $this->getTableName();

        $sql = "SELECT * FROM {$table_name} WHERE id = %d";
        $prep = $this->wpbd->prepare($sql, $id);
        $result = $this->wpbd->get_row($prep);

        return $result;
    }

    //PAGINACJA NAS STRONIE Z TABELKĄ SLAJDÓW
    function get_pagination($curr_page, $limit = 10, $order_by = 'id', $order_dir = 'asc'){

        $table_name = $this->getTableName();

        $curr_page = (int)$curr_page;
        if($curr_page < 1){
            $curr_page = 1;
        }

        $order_by_opts = static::get_order_by_opts();
        $order_by = (in_array($order_by, $order_by_opts)) ? $order_by : 'id';

        $order_dir = (in_array($order_dir, array('asc', 'desc'))) ? $order_dir : 'asc';

        $offset = ($curr_page-1)*$limit;

        $count_sql = "SELECT COUNT(*) FROM {$table_name} ";

        $total_slides = $this->wpbd->get_var($count_sql);
        $last_page = ceil($total_slides/$limit);

        $sql = "SELECT * FROM {$table_name} ORDER BY {$order_by} {$order_dir} LIMIT {$offset} , {$limit}";

        $slide_list = $this->wpbd->get_results($sql);

        $Pagination = new Pagination($slide_list, $order_by, $order_dir, $limit, $total_slides, $curr_page, $last_page);

        return $Pagination;
    }

    static function get_order_by_opts(){
        return array(
            'ID' => 'id',
            'Pozycja' => 'position',
            'Widoczność' => 'published',
            'Tytuł' => 'title',
        );
    }

    public function delete_slajd($slide_id){
        $slide_id = (int)$slide_id;
        $table_name = $this->getTableName();

        return ($this->wpbd->delete( $table_name, array( 'id' => $slide_id ) ));
    }

    public function bulk_delete(array $ids){
        $ids = array_map('intval', $ids);
        $table_name = $this->getTableName();

        $ids_str = implode(',', $ids);

        $sql = "DELETE FROM {$table_name} WHERE id IN ({$ids_str})";

        return ($this->wpbd->query($sql));

    }

    public function bulk_change_visibility(array $ids, $status){
        $ids = array_map('intval', $ids);
        $table_name = $this->getTableName();
        $ids_str = implode(',', $ids);
        $changeTo = '';

        switch ($status){
            case 'public':
                $changeTo = 'yes';
                break;
            case 'private':
                $changeTo = 'no';
                break;
        };

        $sql = "UPDATE {$table_name} SET published = '{$changeTo}' WHERE id IN ({$ids_str})";

        return ($this->wpbd->query($sql));

    }


    public function get_slides(){

        $table_name = $this->getTableName();

        $sql = "SELECT * FROM {$table_name} WHERE published = 'yes' ORDER BY position";

        $all_slides = $this->wpbd->get_results($sql);

        return $all_slides;
    }

    public function drop_table(){

        $table_name = $this->getTableName();
        $sql = "DROP TABLE {$table_name}";

        return ($this->wpbd->query($sql));


    }

}
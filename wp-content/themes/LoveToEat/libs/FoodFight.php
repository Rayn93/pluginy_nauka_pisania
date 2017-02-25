<?php

class FoodFight{
    private $tytul;
    private $tresc;
    private $wyroznij;
    private $dobry;
    private $zly;

    function __construct($post_row) {

        $this->tytul = $post_row->post_title;
        $this->wyroznij = get_post_meta($post_row->ID, 'ff.dane.wyroznij', TRUE);
        $this->tresc = $post_row->post_content;

        $this->dobry = new FoodFight_Item(
                    $this,
                    get_post_meta($post_row->ID, 'ff.dobry.dane', TRUE),
                    get_post_meta($post_row->ID, 'ff.dobry.nazwa', TRUE),
                    get_post_meta($post_row->ID, 'ff.dobry.grafika', TRUE)
                );

        $this->zly = new FoodFight_Item(
                    $this,
                    get_post_meta($post_row->ID, 'ff.zly.dane', TRUE),
                    get_post_meta($post_row->ID, 'ff.zly.nazwa', TRUE),
                    get_post_meta($post_row->ID, 'ff.zly.grafika', TRUE)
                );
    }

    public function getTytul($part = 0) {
        $part = (int)$part;
        if($part == 1 || $part == 2){
            $tmp = explode('vs', $this->tytul);
            return trim($tmp[$part-1]);
        }
        return $this->tytul;
    }

    public function getWyroznij() {
        return $this->wyroznij;
    }

    /**
     * @return FoodFight_Item
     */
    public function getDobry() {
        return $this->dobry;
    }

    /**
     * @return FoodFight_Item
     */
    public function getZly() {
        return $this->zly;
    }
    
    public function getTresc() {
        return $this->tresc;
    }

}
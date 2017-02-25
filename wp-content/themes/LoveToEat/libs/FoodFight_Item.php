<?php

class FoodFight_Item{
    /**
     * @var FoodFight
     */
    private $foodfight;
    private $dane;
    private $nazwa;
    private $grafika;

    function __construct(FoodFight $foodfight, $dane, $nazwa, $grafika) {
        $this->foodfight = $foodfight;
        $this->nazwa = $nazwa;
        $this->grafika = $grafika;

        $this->dane = array();
        if(!empty($dane)){
            $dane_rows = explode("\n", $dane);
            foreach($dane_rows as $row){
                $parts = explode(':', $row);
                $this->dane[trim($parts[0])] = trim($parts[1]);
            }
        }
    }

    public function getDane() {
        return $this->dane;
    }

    public function getWyroznione(){
        $wyroznij = $this->foodfight->getWyroznij();
        if(isset($this->dane[$wyroznij])){
            return $this->dane[$wyroznij];
        }

        return NULL;
    }

    public function getNazwa() {
        return $this->nazwa;
    }

    public function getGrafika() {
        return $this->grafika;
    }

}

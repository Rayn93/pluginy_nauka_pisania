<?php


class Pagination {

    private $items;

    private $order_by;
    private $order_dir;

    private $limit;
    private $total_slides;

    private $curr_page;
    private $last_page;

    /**
     * Pagination constructor.
     * @param $items
     * @param $order_by
     * @param $order_dir
     * @param $limit
     * @param $total_slides
     * @param $curr_page
     * @param $last_page
     */
    public function __construct($items, $order_by, $order_dir, $limit, $total_slides, $curr_page, $last_page)
    {
        $this->items = $items;
        $this->order_by = $order_by;
        $this->order_dir = $order_dir;
        $this->limit = $limit;
        $this->total_slides = $total_slides;
        $this->curr_page = $curr_page;
        $this->last_page = $last_page;
    }


    public function hasItems(){
        return (!empty($this->items));
    }


    public function getItems() {
        return $this->items;
    }

    public function getOrderBy() {
        return $this->order_by;
    }

    public function getOrderDir() {
        return $this->order_dir;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getTotalSlides() {
        return $this->total_slides;
    }

    public function getCurrPage() {
        return $this->curr_page;
    }

    public function getLastPage() {
        return $this->last_page;
    }

}

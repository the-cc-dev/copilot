<?php


class Pagination {

    protected $total;
    protected $limit;
    protected $pages;
    protected $current;
    protected $offset;

	public function __construct($total, $limit, $current = 1) {

       $this->total   = intval($total);
       $this->limit   = intval($limit);
       $this->current = intval($current);
       $this->pages   = ceil($this->total / $this->limit);
       $this->offset  = ($this->current-1) * $this->limit;
    }

    public function total() {
        return $this->total;
    }

    public function pages() {
        return $this->pages;
    }

    public function current() {
        return $this->current;
    }

    public function offset() {
        return $this->offset;
    }

    public function limit() {
        return $this->limit;
    }

    public function first() {
        return $this->total ? 1:null;
    }

    public function last() {
        return $this->total ? $this->pages:null;
    }

    public function range($range=5) {

        if ($this->pages <= $range) {
            return range(1, $this->pages);
        }

        $start = $this->current - floor($range/2);
        $end   = $this->current + floor($range/2);

        if ($start <= 0) {
            $end  += abs($start)+1;
            $start = 1;
        }

        if ($end > $this->pages) {
            $start -= $end - $this->pages;
            $end    = $this->pages;
        }

        return range($start,$end);
    }

}

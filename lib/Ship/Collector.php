<?php

/**
 * Набор кораблей для игрового поля
 *
 * @author Ушаков Денис. Тестовое задание.
 */
class Ship_Collector implements Iterator
{
    private $position = 0;
    
    private $ships = array();
    private $ships_count = 0;
    
  
    public function addShip(Ship $Ship) {
        $this->ships[$this->ships_count++] = $Ship;
    }
    
    
    public function __construct() {
        $this->position = 0;
    }

    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->ships[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return (isset($this->ships[$this->position]) && $this->position < $this->ships_count);
    }
}

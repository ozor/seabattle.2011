<?php

/**
 * Корабль
 *
 * @author Ушаков Денис. Тестовое задание.
 */
class Ship
{
  private $id;
  private $num_boards;
  
  public function  __construct($num_boards) {
    $this->num_boards = (int)$num_boards;
  }

  /**
   * Число палуб
   * 
   * @return integer
   */
  public function  getNumBoards() {
    return $this->num_boards;
  }

  public function  getId() {
    return $this->id;
  }

  public function  setFieldId($field_id) {
    $this->field_id = (int)$field_id;
  }
}

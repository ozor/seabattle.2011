<?php

/**
 * Класс, управляющий процессом генерации поля и кораблей, и расставлением кораблей на поле
 *
 * @author Ушаков Денис. Тестовое задание.
 */
class Generator
{
    // Переменная для хранения объекта, создающего поле и корабли на нём
    private $Builder;
    
    // Переменная для объекта, коллекционера кораблей
    private $Collector;
    
    /**
     * Генерация игрового поля.
     * 
     * $board_count = array(
     *     '<(int)Число_палуб>' => <(int)Количество_кораблей>, 
     *     ...
     * )
     * 
     * @param array $board_count
     * @param array $field_size
     */
    public function __construct($board_count, Field $Field) {
        $this->Builder = new Field_Builder($Field);
        $this->Collector = new Ship_Collector();
    
        // Наполняем коллекционера
        foreach ($board_count as $num_boards => $count) {
            for($i = 0; $i < $count; $i++) {
                $this->Collector->addShip(new Ship($num_boards));
            }
        }
        
        // Создаём и наполняем игровое поле
        $this->Builder->build($this->Collector);
    }

  
    public function getMatrix() {
        return $this->Builder->getMatrix();
    }
  
    public function getMatrixBusy() {
        return $this->Builder->getMatrixBusy();
    }
}


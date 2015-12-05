<?php

/**
 * Расстановщик кораблей на игровом поле
 *
 * @author Ушаков Денис. Тестовое задание.
 */
class Field_Builder
{
    private $Collector, $Ship, $Field;
    
    private $start_position = array(); 
    private $directions = array('Top', 'Bottom', 'Right', 'Left');
    
    public function  __construct(Field $Field) {
        $this->Field = $Field;
    }

    /**
     * С этого метода начинается построение и расстановка кораблей на поле
     *
     * @param Ship_Collector $Collector
     */
    public function build(Ship_Collector $Collector) {
        $this->Collector = $Collector;
    
        foreach ($this->Collector as $Ship) {
            $this->Ship = $Ship;
            $this->_applyShipToField();
        }
    }

    /**
     * Инициализирует и запускает построение корабля на поле
     * 
     * @return boolean
     */
    private function _applyShipToField() {
        if (!count($this->start_position)) {
            $this->_initDrawing();
        }

        $y = $this->start_position['y'];
        $x = $this->start_position['x'];
        
        if (count($this->directions) > 0) {
            shuffle($this->directions);
            $direction = array_pop($this->directions);
            
            if ($result = $this->_buildShipDirection($y, $x, $direction)) {
                return $result;
            } else {
                return $this->_applyShipToField();
            }
        }
        else {
            $this->_initDrawing();
            return $this->_applyShipToField();
        }
    }
    
    /**
     * Построение корабля в заданном направлении
     *
     * @param int $y
     * @param int $x
     * @param string $direction
     * @return boolean
     */
    private function _buildShipDirection($y, $x, $direction) {
        $field_matrix = $this->getMatrix();
        $field_matrix_busy = $this->getMatrixBusy();
        
        // Выстраиваем корабль в указанном направлении
        for ($i = 0; $i < $this->Ship->getNumBoards(); $i++) {
            // Выбранная "клетка" занята
            if ($field_matrix_busy[$y][$x] == 1) {
                return false;
            }
            else {
                // Занимаем "клетку"
                $field_matrix[$y][$x] = 1;
                // Перекрываем соседние клетки
                $this->_setFieldsAreaBusy($y, $x, $field_matrix_busy);
                // Сдвигаем координату
                $this->_getNextDirectionIteration($y, $x, $direction);
            }
        }
        $this->Field->setMatrix($field_matrix);

        $this->_prepareBusyMatrixToUpdate($field_matrix_busy);
        $this->Field->setMatrixBusy($field_matrix_busy);

        return true;
    }


    private function _prepareBusyMatrixToUpdate(&$matrix) {
        foreach ($matrix as $rkey => $row) {
            foreach ($row as $ckey => $cell) {
                $matrix[$rkey][$ckey] = intval(str_replace('2', '1', $matrix[$rkey][$ckey]));
            }
        }
    }
    
    /**
     * Генерация координаты следующей "клетки" для корабля
     *
     * @param int $y
     * @param int $x
     * @param string $direction
     * @return void
     */
    private function _getNextDirectionIteration(&$y, &$x, &$direction) {
        switch ($direction) {
            case 'Top':
                if ($y == $this->Field->getHeight()) {
                    $y = $this->start_position['y'];
                    $direction = 'Bottom';
                    return $this->_getNextDirectionIteration($y, $x, $direction);
                }
                $y++;
                break;
            case 'Bottom':
                if ($y == 1) {
                    $y = $this->start_position['y'];
                    $direction = 'Top';
                    return $this->_getNextDirectionIteration($y, $x, $direction);
                }
                $y--;
                break;
            case 'Right':
                if ($x == $this->Field->getWidth()) {
                    $x = $this->start_position['x'];
                    $direction = 'Left';
                    return $this->_getNextDirectionIteration($y, $x, $direction);
                }
                $x++;
                break;
            case 'Left':
                if ($x == 1) {
                    $x = $this->start_position['x'];
                    $direction = 'Right';
                    return $this->_getNextDirectionIteration($y, $x, $direction);
                }
                $x--;
                break;
        }
    }

    /**
     * Метка "клеток", на которые нельзя ставить корабли
     *
     * @param int $y
     * @param int $x
     * @param array $field_matrix_busy
     */
    private function _setFieldsAreaBusy($y, $x, &$field_matrix_busy) {
        $x_range = $this->_getRange($x, $this->Field->getWidth());
        $y_range = $this->_getRange($y, $this->Field->getHeight());

        foreach ($y_range as $_y) {
            foreach ($x_range as $_x) {
                if (0 == $field_matrix_busy[$_y][$_x]) $field_matrix_busy[$_y][$_x] = 2;
            }
        }
    }

    private function _getRange($num, $max) {
        $min = (($num-1) >= 1) ? ($num-1) : $num;
        $max = (($num+1) <= $max) ? ($num+1) : $num;

        return range($min, $max);
    }

  
    private function _initDrawing() {
        $rand_y = rand(1, $this->Field->getHeight());
        $rand_x = rand(1, $this->Field->getWidth());
      
        // Определяем стартовую "клетку" для построения. 1 - занята, 0 - свободна
        if ($this->getCell($rand_y, $rand_x) != 0) return $this->_initDrawing();
        else {
            $this->start_position = array('y' => $rand_y, 'x' => $rand_x);
            $this->directions = array('Top', 'Bottom', 'Right', 'Left');
        }
    }


    public function getCell($y, $x) {
        $field_matrix = $this->getMatrix();
        return (int)$field_matrix[$y][$x];
    }

    public function getMatrix() {
        return $this->Field->getMatrix();
    }

    public function getMatrixBusy() {
        return $this->Field->getMatrixBusy();
    }
}




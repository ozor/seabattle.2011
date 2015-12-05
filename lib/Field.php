<?php

/**
 * Игровое поле. 
 * Его объекты хранят в себе матрицу "ячеек", в которые вписываются корабли
 *
 * @author Ушаков Денис. Тестовое задание.
 */
class Field 
{
    private $id;
  
    // Длина и высота поля
	private $width, $height;
  
    // Реальная расстановка ячеек на поле
    private $field_matrix = array();
  
    // Расстановка ячеек на поле, куда нельзя ставить корабли
    private $field_matrix_busy = array();


    public function  __construct($field_size = array(), $id = 0) {
        $db = DB::get();

        // Генерация нового поля
        if (0 == $id) {
            $this->setWidth((isset ($field_size[0]) ? (int)$field_size[0] : 10));
            $this->setHeight((isset ($field_size[1]) ? (int)$field_size[1] : 10));

            $db->query("
                    INSERT INTO field (width, height, created_at)
                    VALUES ('{$field_size[0]}', '{$field_size[1]}', NOW())
                ");
            $this->id = $db->lastInsertId();
            
            for ($y = 1; $y <= $this->getHeight(); $y++)
            {
                $this->field_matrix[$y] = array();
                $this->field_matrix_busy[$y] = array();

                for ($x = 1; $x <= $this->getWidth(); $x++) {
                    $this->field_matrix[$y][$x] = 0;
                    $db->insert('field_matrix',
                            array('field_id' => $this->id, 'x' => $x, 'y' => $y, 'status' => 0)
                         );
                    $this->field_matrix_busy[$y][$x] = 0;
                    $db->insert('field_matrix_busy',
                            array('field_id' => $this->id, 'x' => $x, 'y' => $y, 'status' => 0)
                         );
                }
            }
        }
        // Восстановление сохраненного ранее поля
        else {
            $this->id = (int)$id;

            $result = $db->fetchRow(
                          "SELECT width, height FROM field WHERE id = :id",
                          array('id' => $this->id)
                      );
            $this->setWidth($result->width);
            $this->setHeight($result->height);

            $result = $db->fetchAll(
                          "SELECT y, x, status FROM field_matrix WHERE field_id = :id",
                          array('id' => $this->id)
                      );
            foreach ($result as $row) {
                $this->field_matrix[$row->y][$row->x] = $row->status;
            }
            
            $result = $db->fetchAll(
                          "SELECT y, x, status FROM field_matrix_busy WHERE field_id = :id",
                          array('id' => $this->id)
                      );
            foreach ($result as $row) {
                $this->field_matrix_busy[$row->y][$row->x] = $row->status;
            }
        }
    }


    public function setWidth($width) {
		$this->width = (int)$width;
	}
	
	public function getWidth() {
		return $this->width;
	}
	
	public function setHeight($height) {
		$this->height = (int)$height;
	}
	
	public function getHeight() {
		return $this->height;
	}

    
    public function  getId() {
        return $this->id;
    }

    public function  setId($id) {
        $this->id = (int)$id;
    }
    
    
    public function getMatrix() {
        return $this->field_matrix;
    }

    public function setMatrix($field_matrix, $update_to_db = true) {
        $this->field_matrix = $field_matrix;
        if ($update_to_db) $this->_updateMatrix ($field_matrix, 'field_matrix');
    }

    public function getMatrixBusy() {
        return $this->field_matrix_busy;
    }

    public function setMatrixBusy($field_matrix_busy, $update_to_db = true) {
        $this->field_matrix_busy = $field_matrix_busy;
        if ($update_to_db) $this->_updateMatrix ($field_matrix_busy, 'field_matrix_busy');
    }

    private function _updateMatrix($field_matrix, $table) {
        foreach ($field_matrix as $y => $row) {
            foreach ($row as $x => $status) {
                DB::get()->update($table,
                        array('status' => $status),
                        "y = '$y' AND x = '$x' AND field_id = '$this->id'"
                     );
            }
        }
    }
}

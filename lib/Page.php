<?php

/**
 * Класс, который отвечает за отображение страницы
 *
 * @author Ушаков Денис. Тестовое задание.
 */
class Page 
{
    private $Field;

    // URL для AJAX запросов
    const AJAX_SCRIPT = 'index.php?ajax_request=true';

    public function  __construct(Field $Field) {
        $this->Field = $Field;
    }

    public function drawPage() {
        include_once 'layout.php';
    }

    public function getAjaxResult() {
        $this->_header();
        $this->drawField();
    }

    public function drawField() {
        $field_matrix = $this->Field->getMatrix();
        include 'field_matrix_table.php';
    }

    private function _header()
    {
        header('Content-Type: text/html; charset=UTF-8');

        header("Expires: Thu, 19 Feb 1998 13:24:18 GMT");
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Cache-control: max-age=0");
        header("Pragma: no-cache");
    }
}

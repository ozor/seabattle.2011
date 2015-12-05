<?php

include_once dirname(__FILE__) . '/inc/config.php';

$Field = new Field(array(10, 10), $ID);

if (0 == $ID) {
    $Generator = new Generator(array(
        '4' => 1,
        '3' => 2,
        '2' => 3,
        '1' => 4
    ), $Field);
}

$Page = new Page($Field);

isset($_GET['ajax_request']) ? $Page->getAjaxResult() : $Page->drawPage();

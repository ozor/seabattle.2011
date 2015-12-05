<?php

// Функции для отладки приложения.
// При необходимости можно подключить этот файл к конфигу.
// В релизе необходимости в нём нет




/**
 * Полезная функция при отладке.
 */
function debug($what, $is_die = true)
{
	print '<pre>';
		print_r($what);
	print '</pre>';

	if ($is_die) die();
}

/**
 * Функция тоже для отладки. Рисует игровое поле в упрощенном виде
 */
function draw($field)
{
    foreach ($field as $row) {
        foreach ($row as $cell) {
            echo $cell . '&nbsp;';
        }
        echo '<br/>';
    }

    echo '<br/><br/>';
}

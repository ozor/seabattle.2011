ЗАДАНИЕ 

1) Запрограммировать генератор координат кораблей для игры «Морской бой». Генератор должен в квадрате 10x10 размещать
  1 корабль — ряд из 4 клеток,
  2 корабля — ряд из 3 клеток,
  3 корабля — ряд из 2 клеток,
  4 корабля — 1 клетка.
Корабли не могут касаться друг друга. Каждый корабль надо строить «в линейку» вертикально или горизонтально.

2) Написать скрипт, который будет визуализировать полученные от   генератора координаты. Скрипт должен генерировать html страницу с   игровым полем и расставленными на нем кораблями. Так же на странице   должна быть кнопка "Обновить", которая перезагружает страницу, тем самым   обновляя игровое поле.

3) Дополнительно предлагается сделать обновление игрового поля при помощи ajax. По клику на кнопку "Обновить" сама страница не   перезагружается, а лишь обновляется игровое поле.

4) Запоминать сгенерированные расстановки (координаты) в базе данных (чтобы по id можно было восстановить расположение кораблей). Сделать так, что бы при запросе http://localhost/ID генерировалась страница с расстановкой кораблей из бд с id=ID.
  
ИНСТРУКЦИЯ К УСТАНОВКЕ
  
1) Перенести содержимое папки www в директорию тестового сайта
2) Внести необходимые изменения в файле inc/config.php А именно, указать параметры соединения с БД.
3) Импортировать в БД файл dump.sql в БД.

Работоспособность скрипта протестирована на платформе PHP 5.2 + MySQL 5.0

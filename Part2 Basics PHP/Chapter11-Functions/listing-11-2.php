<?php
    // Возврат массива
    function silly()
    {
        return [1, 2, 3];
    }
    // присваивает массиву значение array (1,2,3)
    $arr = silly();
    var_dump($arr);     // Выводим массив
    // Присваиваем переменным $a, $b, $c первые значения массива из списка
    list($a, $b, $c) = silly();
    // Начиная с РНР 5.3 допустимо:
    echo silly()[2];    // выведет 3


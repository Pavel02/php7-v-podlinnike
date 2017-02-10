<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пример функции и ее использования</title>
</head>
<body>
<?php
    // Функция принимает ассоциативный массив и создает несколько
    // тегов <options value="$key">$value, где $key - очередной
    // ключ массива, а $value - очередное значение. Если задан
    // такж и второй параметр, то у соответствущего тега options
    // проставляется атрибут selected
    function selectItems($items, $selected = 0)
    {
        $text ="";
        foreach ($items as $k => $v) {
            if ($k === $selected)
                $ch = " selected";
            else
                $ch = "";
            $text .= "<option$ch value='$k'>$v</option>\n";
        }
        return $text;
    }
    // предположим, у нас есть массив имен и фамилий.
    $names = [
        "Weaving" => "Hugo",
        "Goddard" => "Paul",
        "Taylor" => "Robert",
    ];
    // Если был выбран элемент, вывести информацию
    if (isset($_REQUEST['surname'])) {
        $name = $names[$_REQUEST['surname']];
        echo "Вы выбрали: {$_REQUEST['surname']}, {$name}";
    }
?>
<!-- Форма для выбора имени человека -->
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST">
    Выберите имя:
    <select name="surname">
        <?=selectItems($names, $_REQUEST['surname'])?>
    </select><br />
    <input type="submit" value="Узнать фамилию">
</form>
</body>
</html>
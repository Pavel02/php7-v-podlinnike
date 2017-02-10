<?php
/**
 * Оригинальные листинги от автора в подкаталоге func
 *
 *
 * Синтаксис описания функций на РНР прост и изящен:
 *  - Вы можете использовать параметры по умолчанию (а значит, функции с переменным
 *     числом параметров).
 *  - Каждая функция имеет свой контекст (область видимости) переменных, которая уничтожается при выходе из нее.
 *  - Функция return позволяет вернтуь результат вычисления из функции в вызывающую программу.
 *  - Тип возвращаемого значения может быть любым.
 *  - При описании методов классов для параметров и возвращаемого значения функций возможно указание
 *     их типа с принудительной проверкой при вызове.
 *  - Допускается содание анонимных функций.
 *
 *      listing-11-1    // Пример функции, берет значения из массива и подставляет в список <select>
 *
 *                          Общий синтаксис определения функции.
 *      function имяФункции(арг1[=зн1], арг2[=зн2].....)
 *      {
 *          операторы_тела_функции;
 *      }
 *
 * 1. Имя функции не зависит от регистра (MyFunction и myfunction одна и та же функция)
 * 2. имя должно быть уникальным (нельзя переопределить уже имеющуюся функцию - будет ошибка)
 * 
 * 
 *                          Инструкция return.
 * В РНР можно использовать return абсолютно для любых объектов (какими бы большими они не были)
 * Сразу несколько значений фукция вернуть не может. Если это надо, то можно вернуть ассоциативный массив.
 *      listing-11-2    // Возврат массива
 *
 * Если функция не возвращает никакого значения, т.е. инструкция return в ней отсутствует, то 
 *  считается, что функция вернула   null.
 *      listing-11-3    // неявный возврат null
 *
 *                          Объявление и вызов ункции
 * Фазы трансляции и исполнения разделены в PHP, поэтому можно объявлять функцию
 *  в других конструкциях. А также вызывать выше в программе, а объявлять ниже.
 *
 *                          Параметры по умолчанию.
 * Можем в описанни функции установить значение передаваемым параметрам по умолчанию.
 *
 *                          Передача параметров по ссылке. &
 *      func arg(&$a) {.....}
 *      listing-11-4    // Пример изменения локальной переменной внутри функции не влияет на переменную
 *      listing-11-5    // Переменная передается в функцию по ссылке (не создается ее копия)
 * 
 *                          Переменное число параметров.
 * Ситуация когда заранее неизвестно, сколько параметров будет принимать функция.
 *      listing-11-6        // Описан устаревший способ
 * 
 *      int func_num_args();     // Возвращает  общее  число аргументов, переданных ф-ции при вызове.
 *      mixed func_num_arg(int $num);   // Возвращает значение аргумента с номером $num.
 *      list func_get_args();           // возвращает список всех аргументов, указанных при вызове функции
 * 
 *      listing-11-7        // Использование функции func_get_args()
 *
 * с РНР 5.6 организация переменного числа параметров функции ставим ... (многоточие перед параметром).
 *  внутри функции такой параметр рассматривается, как массив, содержащий все остальные параметры.
 *      listing-11-8        // исплльзование ... при передаче перменного числа параметров в функцию.
 *
 * Оператор ... может быть использован и при вызове с массивом. Это позволяет 
 *  осуществить "развертывание" массива в параметры функции.
 *      listing-11-9        // пример с ...
 * 
 *
 *                          Типы аргументов и возвращаемого значения.
 * с РНР 5 допускается указывать типы аргументов (объекты, масивы, интерфейсы, функции обратного вызова).
 * с РНР 7 допустимы типы расширили (+ bool, int, float, string).
 * с РНР 7 доускается задавать тип возвращаемого функцией значения. (:int Перед телом фукции)
 *      listing-11-10       // приведение типов автоматически
 * Жесткий режим типизации включается режимом   declare(strict_types = 1)
 * с PHP 7 в жестком режиме генерируется исключение TypeError, которое можно перехватить.
 * до РНР 7  раньше было сообщение об ошибки и остановка скрипта
 *      listing-11-11
 *
 *
 *                          Локальные переменные.
 * При передаче аргументов по значению, создаются копии (как некие временные объекты создаются
 *  в момент вызова функции и исчезают после окончания).
 * Передача по ссылке происходит без создания копии аргумента.
 * ОБЛАСТЬ ВИДИМОСТИ - совокупность аргументов и других переменных инициализируемых и
 *  используемы внутри функции (также контекст функции).
 *      listing-11-12
 *
 *
 *                          Глобальные переменные.
 *      global $variable;       // Инструкция в описанни функции.
 *      listing-11-13           // пример  global
 *
 *                          Массив $GLOBALS.
 * Массив $GLOBALS это глобальный массив, доступный из любого места в программе (в том числе и
 *  из тела функции) и его не надо дополнительно объявлять.
 * Массив $GLOBALS это массив, ключи которого это имена глобальных переменных, а значения - их величины.
 * Пример из листинга 11-13 можно переписать:
 *      // Возвращение название месяца по его номеру. Нумерация начинается с 1!
 *      function getMonthName($n) { return $GLOBALS["monthes"][$n]; }
 *
 * Массив $GLOBALS - глобален для все прогораммы.
 * Ограничения: 1.Нельзя присвоить массив $GLOBALS какой-либо переменной целиком с помощью оператора =.
 *              2. Нельзя массив $GLOBALS передавать по значению - можно передавать только по ссылке.
 *
 * Добавление новой переменной в массив $GLOBALS это равносильно созданию новой переменной.
 * Массив $GLOBALS  всегда содержит  глобальную переменную  GLOBALS.
 *
 *                                Как работает инструкция global?
 * Конструкция global создает ссылку
 *      function test()
 *      {
 *          $a = &$GLOBALS['a'];        // равосильно  global $a;
 *          $a = 10;
 *      }
 *
 *      listing-11-14       // оператор  unset() в теле функции не уничтожает глоабальную переменную.
 * 
 * Для удаления глобальной переменной из тела функции, нужно удалить $GLOBALS['a']
 *      function deleter() { unset($GLOBALS['a']); }
 *      $a = 100;
 *      deleter();
 *      echo $a;        // Предупреждение: переменная $a не определена!
 * 
 *
 *                                  Статические переменные.
 * Конструкция  static  сообщает компилятору, что не надо уничтожать указанную переменную между вызовами функции.
 *      listing-11-15-static
 * 
 *
 *                                  Рекурсия.
 * Рекурсия - вызов функции самой себя.
 * Бывает удобно для задач обхода всего дерева каталогов вашего сервера (с целью подсчета суммарного объема, который занимают все файлы).
 *
 *
 *                                  Факториал.
 * Стандартный пример рекурсиной функции, это расчет  n!
 *      function factor($n)
 *      {
 *          if ($n <= 0) return 1;
 *          else return $n * factor($n-1);
 *      )
 *      echo factor(20);
 *
 *                                  Функция  dumper().
 * В отладочных целях бывает нужно посмотреть, что содержит та или иная переменная.
 * В случае, если переменная массив, то вывод на экран возможен при помощи:
 *  print_r();    var_dump();
 *      listing-11-16-dumper        // Реализация функции dumper для вывода на экран любых даже сложных переменных
 *      listing-11-17               // Пример использования функции dumper()
 *
 *
 *                                  Вложенные функции.
 * Переменные внутри тела функций ограничены обалстью видимости,
 *  а вот вложенные функии доступны для всей части программы, с того момента когда функция родитель будет вызвана.
 *      listing-11-18       // пример вложенной функции
 * В РНР пока что нет такого понятия как локальная функция.
 * Функция может быть определена в любой части программы (в том числе в теле другой функции).
 * Когда функция фиксируется во внутренней таблице функций РНР, когда управление доходит до участка программы,
 *  содержащего определение этой функции.
 *
 *
 *                                  Условно определяемые функции.
 * WINDOWS не поддерживает POSIX-соглашения для файловой системы.
 *      if (PHP_OS == "WINNT") {
 *          // Функция заглушка
 *          function myChown($fname, attr) {
 *              // Ничего не делает
 *              return 1;
 *          }
 *      } else {
 *          // Передаем вызов настоящей chown()
 *          function myChown($fname, $attr) {
 *              return chown($fname, $attr);
 *          }
 *      }
 * Для WIN вернет 1, а для UNIX вызовет оригинальную chown().
 *
 *                                  Эмулящия функции  virtual().
 * см. книгу стр. 227
 *
 *
 *                                  Передача функции по ссылке.
 * 
 *
 *
 *
 *
 *                                  Анонимные функции.
 * с РНР 5.3 доступны функции без имени
 *      listing-11-21
 * 
 * Также анонимные функции допускается передавать другим функциям в качестве параметра
 *      listing-11-22
 * 
 *
 *                                  Замыкания.
 * Замыкание - это фнукция, которая запоминает состояние окружения в момент своего создания.
 * Даже если это состояние изменится, замыкание содержит в себе первоначальное состояние.
 *      listing-11-23
 *      // В листинге 11-23 создается анонимная йункция-замыкание
 * Основное назначение замыканий - замена глобальных переменных.
 *
 *
 *                                  Возврат функцией ссылки.
 * через функцию и инструкцию   return   возвращаются определенные значения - копии величин.
 * Если нужно, чтобы функция возвращала ссылку на на переменную, то:
 *      listing-11-25 
 *
 *                                  Технология отложенного копирования переменных.
 *
 *
 *                                  РЕЗЮМЕ
 * Создавайте функции не более 20-30 строк, по возможности независимые и полезные сами по себе.
 * Прежде, чем писать функцию, сверьтесь сдокументацией, возможна она уже реализована.
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 * 
 *
 *
 * 
 */
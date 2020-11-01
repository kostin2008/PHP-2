<?php

class Product{ // класс товара со свойствами цены и названия, к которым нельзя обратиться извне объекта.
    // Для установки цены используется метод setPrice
    protected $name;
    protected $price;
    public static $quantity = 0;

    public function __construct($name = "Новый Товар", $price = 1) // конструктор
    {
        $this->name = $name;
        $this->price = $price;
        echo("Создан товар <b>{$this->name}</b> <br>");
        self::$quantity++;
    }
    public function getPrice(){ // геттер цены
        return $this->price;
    }
    public function getName(){ // геттер названия
        return $this->name;
    }
    public function setPrice($price = 0){ // сеттер цены
        if(is_numeric($price) && $price > 0){
            $this->price = $price;
            echo "Новая цена товара {$this->name} - {$this->price} рублей <br>";
        } else {
            echo "Неверный формат цены <br>";
        }
    }
    static public function howManyProducts(){ // статический метод для вывода количества всех Товаров
        echo "Создано всего товаров - " . self::$quantity . "<br><br>";
    }
}

class Laptop extends Product{ // класс "Ноутбук" - наследник класса "Продукт"
    protected $category; // новое свойство - Категория
    public static $quantity = 0;

    public function __construct($name = "Новый Ноутбук", $price = 1) // конструктов
    {
        parent::__construct($name, $price); // конструктор родителя
        $this->category = "Ноутбуки";
        self::$quantity++;
    }
    public function getCategory(){ // геттер категории
        echo "Категория товара - {$this->category} <br>";
    }
    static public function howManyLaptop(){ // статический метод для вывода количества созданных объектов "Ноутбук"
        echo "Создано всего Ноутбуков - " . self::$quantity . "<br><br>";
    }
}

class Telephone extends Product{ // класс "Телефон" - наследник класса "Товары"
    protected $category;
    public static $quantity = 0;

    public function __construct($name = "Новый Телефон", $price = 1)
    {
        parent::__construct($name, $price);
        $this->category = "Телефоны";
        self::$quantity++;
    }
    public function getCategory(){
        echo "Категория товара - {$this->category} <br><br>";
    }
    static public function howManyTelephones(){
        echo "Создано всего Телефонов - " . self::$quantity . "<br><br><hr>";
    }
}
// Тесты
$good1 = new Product("Планшет", 33350); // создаем новый Товар
echo ("Название товара - {$good1->getName()} <br>"); // выводим название
echo ("Цена товара - {$good1->getPrice()} рублей <br>"); // выводим цену
$good1->setPrice(29900); // устанавливаем новую цену
echo ("Всего было создано товаров - " . Product::$quantity . "<br><br>"); // выводим количество созданных Товаров через статическое свойство

$good2 = new Product("Телевизор", 35400); // создаем новый Товар
echo ("Цена товара - {$good2->getPrice()} рублей <br>");
Product::howManyProducts();

// создаем экземпляр класса-наследника
$good3 = new Laptop("Ноутбук ASUS", 44500); // создаем новый Ноутбук
echo ("Цена товара - {$good3->getPrice()} рублей <br>");
$good3->getCategory();
Product::howManyProducts();
Laptop::howManyLaptop();

$good4 = new Telephone("Телефон Phone", 74000); // создаем новый Телефон
echo ("Цена товара - {$good4->getPrice()} рублей <br>");
$good4->getCategory();

$good5 = new Laptop("Ноутбук Sony", 101000); // создаем новый Ноутбук
Product::howManyProducts();
Laptop::howManyLaptop();
Telephone::howManyTelephones();

// 5. Что выведет код на каждом шаге? Почему?
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A(); // первый объект класса А
$a2 = new A(); // второй объект класса А
$a1->foo(); // $x = 1. вызов метода, который прибавит СТАТИЧЕСКОЙ переменной класса единицу
$a2->foo(); // $x = 2. так как переменная $x - статическая, каждый вызов функции foo() из любого объекта класса A будет прибавлять единицу к $x
$a1->foo(); // $x = 3.
$a2->foo(); // $x = 4.
echo "<br>";
// 6. Если изменить код:
class C {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class D extends C {
}
$a1 = new C(); // объект класса C
$b1 = new D(); // объект класса D
// при вызове foo() из разных класов создаётся переменная $x для каждого класса
$a1->foo(); // вызов метода foo() объекта класса C. $x класса C = 1
$b1->foo(); // вызов метода foo() объекта класса D. $x класса D = 1
$a1->foo(); // вызов метода foo() объекта класса C. $x класса C = 2
$b1->foo(); // вызов метода foo() объекта класса D. $x класса D = 2
echo "<br>";
// 7. Что изменится в этом случае?
// По сравнению с заданием 6 не изменится ничего, так как единственная разница в том, что объекты создаются без скобок из классов.
// Такая запись допустима, если в конструктор класса не передаются переменные.
class E {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class F extends E {
}
$a1 = new E;
$b1 = new F;
$a1->foo(); // $x класса E = 1
$b1->foo(); // $x класса F = 1
$a1->foo(); // $x класса E = 2
$b1->foo(); // $x класса F = 2
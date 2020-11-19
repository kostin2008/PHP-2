<?php


use Phinx\Seed\AbstractSeed;

class ShopSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $sql = 'TRUNCATE products';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE cart';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE feedback';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE orders';
        $this->adapter->query($sql);


        $products = [
            [
                'name' => 'Ноутбук Lenovo',
                'description' => 'Описание этого товара временно отсутствует.',
                'price' => 91410,
                'image' => 'Lenovo.jpg',
            ],
            [
                'name' => 'Телевизор LED',
                'description' => 'Hyundai 40" H-LED40ET3000 Metal черный/FULL HD/60Hz/DVB-T2/DVB-C/DVB-S2/USB (RUS) (H-LED40ET3000)',
                'price' => 17290,
                'image' => 'Hyundai.jpg',
            ],
            [
                'name' => 'Смарт-часы',
                'description' => 'Smarterra Chronos X 1.54" TFT золото розовое (SM-UC101LRG) (SM-UC101LRG)',
                'price' => 1410,
                'image' => 'Smarterra.jpg',
            ],
            [
                'name' => 'Фотоаппарат',
                'description' => 'Зеркальный Canon EOS 2000D черный 24.1Mpix 18-55mm f/3.5-5.6 III 3" 1080p Full HD SDXC Li-ion (с объективом) (2728C002)',
                'price' => 35750,
                'image' => 'Canon.jpg',
            ],
            [
                'name' => 'Видеокамера',
                'description' => 'IP Digma DiVision 201 2.8-2.8мм',
                'price' => 23900,
                'image' => 'Digma.jpg',
            ],
        ];

        $this->table('products')->insert($products)->save();

        $sql = 'TRUNCATE users';
        $this->adapter->query($sql);


        $users = [
            [
                'login' => 'admin',
                'pass' => password_hash('123', PASSWORD_DEFAULT),
                'role' => 1,
            ],
            [
                'login' => 'user',
                'pass' => password_hash('123', PASSWORD_DEFAULT),
                'role' => 2,
            ]
        ];

        $this->table('users')->insert($users)->save();
    }
}

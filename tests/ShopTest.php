<?php


class ShopTest extends \PHPUnit\Framework\TestCase
{
    public function testFirst() {
        $x = 1;
        $y = 2;
        $this->assertEquals(3, $x + $y);
    }

    public function testSub() {
        $x = 3;
        $y = 2;
        $this->assertEquals(1, $x - $y);
    }

}
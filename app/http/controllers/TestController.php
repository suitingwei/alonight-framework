<?php
namespace App\Http\Controllers;

use App\Tests\Foo;

class TestController
{
    public function classObjectPropertyCache()
    {
        $foo = new Foo();

        $foo->transform('123');
        $foo->transform('1a23');
        $foo->transform('qwe23');
        $foo->transform('1qe3');
        $foo->transform('1qw23');
        $foo->transform('1qw2');

        $bar = new Foo();
        $bar->transform('www');
        $bar->transform('aaa');
        $bar->transform('eee');

    }
}
